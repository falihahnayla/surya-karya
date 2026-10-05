<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('layanan')->latest();

        if ($request->filled('status') && array_key_exists($request->status, Order::STATUSES)) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where('name', 'like', "%{$q}%")
                  ->orWhere('order_code', 'like', "%{$q}%")
                  ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        $items    = $query->paginate(15)->withQueryString();
        $selected = $request->filled('selected')
            ? Order::with('layanan')->find($request->selected)
            : null;
        $selected = $selected ?? $items->first();
        $totalAll = Order::count();

        return view('admin.orders.index', compact('items', 'selected', 'totalAll'));
    }

    public function create()
    {
        $layanan = Layanan::orderBy('id')->get();
        return view('admin.orders.create', compact('layanan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        $data['denah_image'] = $request->file('denah_image')?->store('orders/denah', 'public');
        $data['lahan_image'] = $request->file('lahan_image')?->store('orders/lahan', 'public');

        DB::transaction(fn () => Order::create($this->normalize($data)));

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function edit(Order $order)
    {
        $layanan = Layanan::orderBy('id')->get();
        return view('admin.orders.edit', compact('order', 'layanan'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate($this->rules());

        foreach (['denah_image' => 'orders/denah', 'lahan_image' => 'orders/lahan'] as $field => $dir) {
            if ($request->hasFile($field)) {
                if ($order->$field) {
                    Storage::disk('public')->delete($order->$field);
                }
                $data[$field] = $request->file($field)->store($dir, 'public');
            } else {
                unset($data[$field]);
            }
        }

        $order->update($this->normalize($data));

        return redirect()->route('admin.orders.index', ['selected' => $order->id])
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => ['required', Rule::in(array_keys(Order::STATUSES))]]);
        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index', ['selected' => $order->id])
            ->with('success', 'Status pesanan diperbarui.');
    }

    public function destroy(Order $order)
    {
        foreach (['denah_image', 'lahan_image'] as $field) {
            if ($order->$field) {
                Storage::disk('public')->delete($order->$field);
            }
        }
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * Tampilkan file denah/lahan langsung dari disk "public"
     * tanpa memerlukan symbolic link (php artisan storage:link).
     */
    public function file(Order $order, string $type)
    {
        abort_unless(in_array($type, ['denah', 'lahan'], true), 404);

        $path = $order->{$type . '_image'};
        $disk = Storage::disk('public');

        abort_unless($path && $disk->exists($path), 404);

        return $disk->response($path, null, [
            'Cache-Control' => 'private, max-age=3600',
        ]);
    }

    private function rules(): array
    {
        return [
            'name'              => 'required|string|max:255',
            'company_name'      => 'nullable|string|max:255',
            'email'             => 'nullable|email|max:255',
            'phone'             => 'required|string|max:50',
            'address'           => 'required|string',
            'layanan_id'        => 'required|exists:layanan,id',
            'building_area'     => 'nullable|integer|min:0',
            'land_area'         => 'nullable|integer|min:0',
            'building_position' => 'nullable|string|max:255',
            'project_detail'    => 'required|string',
            'denah_image'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'lahan_image'       => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'notes'             => 'nullable|string',
            'total'             => 'nullable|numeric|min:0',
            'termin_1'          => 'nullable|numeric|min:0',
            'termin_2'          => 'nullable|numeric|min:0',
            'termin_3'          => 'nullable|numeric|min:0',
            'status'            => ['required', Rule::in(array_keys(Order::STATUSES))],
        ];
    }

    /** Angka kosong -> 0 agar tidak error di kolom decimal NOT NULL. */
    private function normalize(array $data): array
    {
        foreach (['total', 'termin_1', 'termin_2', 'termin_3'] as $f) {
            $data[$f] = $data[$f] ?? 0;
        }
        return $data;
    }
}