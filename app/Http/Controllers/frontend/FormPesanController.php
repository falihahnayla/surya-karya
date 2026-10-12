<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Layanan;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormPesanController extends Controller
{
    public function index()
    {
        $layanan = Layanan::orderBy('id')->get();

        return view()->first(
            ['frontend.form-pemesanan', 'form-pemesanan', 'pages.form-pemesanan'],
            compact('layanan')
        );
    }

    public function store(StoreOrderRequest $request)
    {
        $v = $request->validated();

        $order = DB::transaction(function () use ($request, $v) {
            return Order::create([
                'name'              => $v['nama_lengkap'],
                'company_name'      => $v['nama_perusahaan'] ?? null,
                'phone'             => $v['nomor_whatsapp'],
                'email'             => $v['email'] ?? null,
                'address'           => $v['alamat_proyek'],
                'layanan_id'        => $v['layanan_id'],
                'building_area'     => $v['luas_bangunan'] ?? null,
                'land_area'         => $v['luas_lahan'] ?? null,
                'building_position' => $v['posisi_bangunan'] ?? null,
                'project_detail'    => $v['kebutuhan_proyek'],
                'notes'             => $v['catatan_tambahan'] ?? null,
                'denah_image'       => $request->file('file_denah')?->store('orders/denah', 'public'),
                'lahan_image'       => $request->file('file_lahan')?->store('orders/lahan', 'public'),
                'total'             => 0,
                'termin_1'          => 0,
                'termin_2'          => 0,
                'termin_3'          => 0,
                'status'            => 'pending',
            ]);
        });

        $layanan = Layanan::find($v['layanan_id']);
        $waUrl   = $this->buildWhatsappUrl($v, $layanan?->title, $order->order_code ?? null);

        session()->forget(['verified_email', 'verified_email_at']);

        return redirect()
            ->route('frontend.form-pesanan')
            ->with('success', true)
            ->with('wa_url', $waUrl);
    }

    private function buildWhatsappUrl(array $v, ?string $layananTitle, ?string $orderCode): string
    {
        $dash = fn ($val, $suffix = '') => filled($val) ? $val . $suffix : '-';
        $companyName = strtoupper(Setting::first()?->company ?? 'SURYA KARYA');
        $lines = ['*PEMESANAN JASA - ' . $companyName . '*'];

        if ($orderCode) {
            $lines[] = 'Kode Pesanan: #' . $orderCode;
        }

        $lines = array_merge($lines, [
            '',
            '*IDENTITAS*',
            'Nama Lengkap: ' . $v['nama_lengkap'],
            'Perusahaan: ' . $dash($v['nama_perusahaan'] ?? null),
            '',
            '*KONTAK*',
            'WhatsApp: ' . $v['nomor_whatsapp'],
            'Email: ' . $dash($v['email'] ?? null),
            '',
            '*ALAMAT PROYEK*',
            $v['alamat_proyek'],
            '',
            '*DETAIL PEMESANAN*',
            'Jenis Layanan: ' . $dash($layananTitle),
            'Luas Bangunan: ' . $dash($v['luas_bangunan'] ?? null, ' m²'),
            'Luas Lahan: ' . $dash($v['luas_lahan'] ?? null, ' m²'),
            'Arah/Posisi Bangunan: ' . $dash($v['posisi_bangunan'] ?? null),
            '',
            '*KEBUTUHAN PROYEK*',
            $v['kebutuhan_proyek'],
            '',
            '*CATATAN TAMBAHAN*',
            $dash($v['catatan_tambahan'] ?? null),
            '',
            'Mohon informasi dan tindak lanjutnya. Terima kasih.',
        ]);

        return 'https://wa.me/' . Setting::whatsappNumber() . '?text=' . rawurlencode(implode("\n", $lines));
    }
}