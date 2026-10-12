<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        /*
         * Satu query agregat untuk semua angka dashboard.
         *
         * - Kartu status (pengajuan / pending / deal / cancel) tetap menghitung
         *   semua order, karena memang hitungan per status.
         * - SEMUA penjumlahan nilai & pembayaran (total nilai, termin 1-3,
         *   jumlah yang sudah bayar) hanya dihitung dari order berstatus 'deal'.
         *   Order pending / cancel tidak ikut dihitung.
         * - Aturan "sudah bayar": nominal termin > 0
         *   (termin diisi admin setelah klien membayar, default 0).
         */
        $s = Order::query()->selectRaw("
            COUNT(*) AS total_pesanan,
            COALESCE(SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END), 0) AS pending,
            COALESCE(SUM(CASE WHEN status = 'deal'    THEN 1 ELSE 0 END), 0) AS deal,
            COALESCE(SUM(CASE WHEN status = 'cancel'  THEN 1 ELSE 0 END), 0) AS cancel,

            COALESCE(SUM(CASE WHEN status = 'deal' THEN total    ELSE 0 END), 0) AS total_nilai,
            COALESCE(SUM(CASE WHEN status = 'deal' THEN termin_1 ELSE 0 END), 0) AS nominal_1,
            COALESCE(SUM(CASE WHEN status = 'deal' THEN termin_2 ELSE 0 END), 0) AS nominal_2,
            COALESCE(SUM(CASE WHEN status = 'deal' THEN termin_3 ELSE 0 END), 0) AS nominal_3,

            COALESCE(SUM(CASE WHEN status = 'deal' AND termin_1 > 0 THEN 1 ELSE 0 END), 0) AS paid_1,
            COALESCE(SUM(CASE WHEN status = 'deal' AND termin_2 > 0 THEN 1 ELSE 0 END), 0) AS paid_2,
            COALESCE(SUM(CASE WHEN status = 'deal' AND termin_3 > 0 THEN 1 ELSE 0 END), 0) AS paid_3
        ")->first();

        $totalPesanan = (int) $s->total_pesanan;
        $totalDeal    = (int) $s->deal;
        $totalNilai   = (float) $s->total_nilai;
        $totalTermin  = (float) $s->nominal_1 + (float) $s->nominal_2 + (float) $s->nominal_3;
        $outstanding  = $totalNilai - $totalTermin;

        $pct = fn ($a, $b) => $b > 0 ? round($a / $b * 100, 1) : 0;

        // Kartu per termin (persentase dihitung terhadap jumlah order deal)
        $termin = [];
        foreach ([1, 2, 3] as $i) {
            $nominal = (float) $s->{"nominal_$i"};
            $paid    = (int) $s->{"paid_$i"};

            $termin[$i] = [
                'short'   => $this->rupiahShort($nominal),
                'full'    => $this->rupiah($nominal),
                'paid'    => $paid,
                'percent' => $pct($paid, $totalDeal),
            ];
        }

        // Tabel termin: 4 pesanan DEAL yang terakhir diedit/diupdate
        $pesanan = Order::with('layanan')
            ->where('status', 'deal')
            ->latest('updated_at')
            ->limit(4)
            ->get();

        return view('admin.dashboard', [
            // Kartu status
            'totalPengajuan' => $totalPesanan,
            'totalPending'   => (int) $s->pending,
            'totalDeal'      => $totalDeal,
            'totalCancel'    => (int) $s->cancel,

            // Ringkasan pembayaran (hanya order deal)
            'totalNilaiProyek'     => $this->rupiahShort($totalNilai),
            'totalNilaiProyekFull' => $this->rupiah($totalNilai),
            'outstanding'          => $this->rupiahShort($outstanding),
            'outstandingFull'      => $this->rupiah($outstanding),
            'outstandingPercent'   => max(0, $pct($outstanding, $totalNilai)),
            'totalTermin'          => $this->rupiahShort($totalTermin),
            'totalTerminPercent'   => min(100, $pct($totalTermin, $totalNilai)),

            // 3 kartu termin + tabel
            'termin'  => $termin,
            'pesanan' => $pesanan,
        ]);
    }

    private function rupiah(float $v): string
    {
        return 'Rp ' . number_format($v, 0, ',', '.');
    }

    /** 14850000000 -> "Rp 14,85 M", 350000000 -> "Rp 350,00 Jt" */
    private function rupiahShort(float $v): string
    {
        $abs = abs($v);

        if ($abs >= 1_000_000_000) {
            return 'Rp ' . number_format($v / 1_000_000_000, 2, ',', '.') . ' M';
        }
        if ($abs >= 1_000_000) {
            return 'Rp ' . number_format($v / 1_000_000, 2, ',', '.') . ' Jt';
        }

        return $this->rupiah($v);
    }
}