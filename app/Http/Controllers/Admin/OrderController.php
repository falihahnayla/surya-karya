<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Order;
use App\Rules\ValidEmailDns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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

        $items    = $query->paginate(10)->withQueryString();
        $selected = $request->filled('selected')
            ? Order::with('layanan')->find($request->selected)
            : null;
        $selected = $selected ?? $items->first();
        $totalAll = Order::count();

        // Tandai order yang sedang dibuka sebagai sudah dilihat (toBase = tidak mengubah updated_at)
        if ($selected && is_null($selected->seen_at)) {
            Order::whereKey($selected->id)->whereNull('seen_at')->toBase()->update(['seen_at' => now()]);
        }

        return view('admin.orders.index', compact('items', 'selected', 'totalAll'));
    }

    public function create()
    {
        $layanan = Layanan::orderBy('id')->get();
        return view('admin.orders.create', compact('layanan'));
    }

    public function store(Request $request)
    {
        $this->sanitizeAndNormalizeInput($request);

        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        $this->validateTerminSum($validator, $request);
        $data = $validator->validate();

        $data['denah_image'] = $request->file('denah_image')?->store('orders/denah', 'public');
        $data['lahan_image'] = $request->file('lahan_image')?->store('orders/lahan', 'public');

        // Order buatan admin sendiri langsung dianggap sudah dilihat
        $data['seen_at'] = now();

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
        $this->sanitizeAndNormalizeInput($request);

        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        $this->validateTerminSum($validator, $request);
        $data = $validator->validate();

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

    private function sanitizeAndNormalizeInput(Request $request): void
    {
        $cleanText = function (?string $v): ?string {
            if ($v === null) {
                return null;
            }
            $t = trim(strip_tags($v));
            return $t === '' ? null : $t;
        };

        $cleanNominal = function ($v): float {
            if ($v === null || $v === '') {
                return 0.0;
            }
            $digits = preg_replace('/\D+/', '', (string) $v);
            return $digits === '' ? 0.0 : (float) $digits;
        };

        $phone = $request->phone;
        if (is_string($phone)) {
            $phone = preg_replace('/\D+/', '', $phone);
        }

        $email = $request->email;
        if (is_string($email)) {
            $email = strtolower(trim(strip_tags($email)));
            $email = $email === '' ? null : $email;
        }

        $request->merge([
            'name'              => $cleanText($request->name),
            'company_name'      => $cleanText($request->company_name),
            'phone'             => $phone ?: null,
            'email'             => $email,
            'address'           => $cleanText($request->address),
            'building_position' => $cleanText($request->building_position),
            'project_detail'    => $cleanText($request->project_detail),
            'notes'             => $cleanText($request->notes),
            'building_area'     => filled($request->building_area) ? (int) $request->building_area : null,
            'land_area'         => filled($request->land_area) ? (int) $request->land_area : null,
            'total'             => $cleanNominal($request->total),
            'termin_1'          => $cleanNominal($request->termin_1),
            'termin_2'          => $cleanNominal($request->termin_2),
            'termin_3'          => $cleanNominal($request->termin_3),
        ]);
    }

    private function validateTerminSum($validator, Request $request): void
    {
        $validator->after(function ($v) use ($request) {
            $total     = (float) $request->input('total', 0);
            $terminSum = (float) $request->input('termin_1', 0)
                       + (float) $request->input('termin_2', 0)
                       + (float) $request->input('termin_3', 0);

            if ($total > 0 && $terminSum > $total) {
                $v->errors()->add(
                    'total',
                    'Jumlah termin (Termin 1 + 2 + 3: Rp ' . number_format($terminSum, 0, ',', '.') .
                    ') tidak boleh melebihi Total nilai pesanan (Rp ' . number_format($total, 0, ',', '.') . ').'
                );
            }
        });
    }

    private function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\.\,\'\-]+$/u'],
            'company_name'      => ['nullable', 'string', 'max:100', 'regex:/^[\pL0-9\s\.\,\&\-\(\)]+$/u'],
            'email'             => ['nullable', 'string', 'max:100', new ValidEmailDns()],
            'phone'             => ['required', 'regex:/^(62|0)8[0-9]{8,12}$/', 'max:15'],
            'address'           => ['required', 'string', 'min:10', 'max:500'],
            'layanan_id'        => ['required', 'integer', 'exists:layanan,id'],
            'building_area'     => ['nullable', 'integer', 'min:1', 'max:1000000'],
            'land_area'         => ['nullable', 'integer', 'min:1', 'max:1000000'],
            'building_position' => ['nullable', 'string', 'max:100'],
            'project_detail'    => ['required', 'string', 'min:10', 'max:2000'],
            'denah_image'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'mimetypes:image/jpeg,image/png,application/pdf', 'max:10240'],
            'lahan_image'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'mimetypes:image/jpeg,image/png,application/pdf', 'max:10240'],
            'notes'             => ['nullable', 'string', 'max:1000'],
            'total'             => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
            'termin_1'          => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
            'termin_2'          => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
            'termin_3'          => ['nullable', 'numeric', 'min:0', 'max:999999999999'],
            'status'            => ['required', Rule::in(array_keys(Order::STATUSES))],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required'             => 'Nama pemesan wajib diisi.',
            'name.min'                  => 'Nama pemesan minimal 3 karakter.',
            'name.max'                  => 'Nama pemesan maksimal 100 karakter.',
            'name.regex'                => 'Nama hanya boleh berisi huruf, spasi, titik, koma, tanda petik, dan tanda hubung.',
            'company_name.max'          => 'Nama perusahaan maksimal 100 karakter.',
            'company_name.regex'        => 'Nama perusahaan hanya boleh berisi huruf, angka, spasi, dan karakter aman (.,&-()).',
            'phone.required'            => 'Nomor WhatsApp wajib diisi.',
            'phone.regex'               => 'Format nomor WhatsApp tidak valid. Gunakan format nomor Indonesia diawali 08 atau 628 (10–15 digit, contoh: 08123456789 atau 628123456789).',
            'phone.max'                 => 'Nomor WhatsApp maksimal 15 digit.',
            'email.max'                 => 'Email maksimal 100 karakter.',
            'address.required'          => 'Alamat proyek wajib diisi.',
            'address.min'               => 'Alamat proyek minimal 10 karakter.',
            'address.max'               => 'Alamat proyek maksimal 500 karakter.',
            'layanan_id.required'       => 'Jenis layanan wajib dipilih.',
            'layanan_id.exists'         => 'Jenis layanan yang dipilih tidak valid.',
            'building_area.integer'     => 'Luas bangunan harus berupa angka bulat.',
            'building_area.min'         => 'Luas bangunan minimal 1 m².',
            'building_area.max'         => 'Luas bangunan maksimal 1.000.000 m².',
            'land_area.integer'         => 'Luas lahan harus berupa angka bulat.',
            'land_area.min'             => 'Luas lahan minimal 1 m².',
            'land_area.max'             => 'Luas lahan maksimal 1.000.000 m².',
            'building_position.max'     => 'Posisi bangunan maksimal 100 karakter.',
            'project_detail.required'   => 'Kebutuhan proyek wajib diisi.',
            'project_detail.min'        => 'Kebutuhan proyek minimal 10 karakter.',
            'project_detail.max'        => 'Kebutuhan proyek maksimal 2000 karakter.',
            'notes.max'                 => 'Catatan tambahan maksimal 1000 karakter.',
            'denah_image.mimes'         => 'File denah harus berformat JPG, JPEG, PNG, atau PDF.',
            'denah_image.mimetypes'     => 'File denah harus berformat JPG, JPEG, PNG, atau PDF.',
            'denah_image.max'           => 'Ukuran file denah maksimal 10MB.',
            'lahan_image.mimes'         => 'File lahan harus berformat JPG, JPEG, PNG, atau PDF.',
            'lahan_image.mimetypes'     => 'File lahan harus berformat JPG, JPEG, PNG, atau PDF.',
            'lahan_image.max'           => 'Ukuran file lahan maksimal 10MB.',
            'total.numeric'             => 'Total nilai pesanan harus berupa angka.',
            'termin_1.numeric'          => 'Nominal Termin 1 harus berupa angka.',
            'termin_2.numeric'          => 'Nominal Termin 2 harus berupa angka.',
            'termin_3.numeric'          => 'Nominal Termin 3 harus berupa angka.',
            'status.required'           => 'Status pesanan wajib dipilih.',
            'status.in'                 => 'Status pesanan tidak valid.',
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