<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public const STATUSES = [
        'pending' => 'Pending',
        'deal'    => 'Deal',
        'cancel'  => 'Ditolak',
    ];

    protected $fillable = [
        'order_code', 'name', 'company_name', 'email', 'phone', 'address',
        'layanan_id', 'building_area', 'land_area', 'building_position',
        'project_detail', 'denah_image', 'lahan_image', 'notes',
        'total', 'termin_1', 'termin_2', 'termin_3', 'status', 'seen_at',
    ];

    protected $casts = [
        'total'    => 'decimal:2',
        'termin_1' => 'decimal:2',
        'termin_2' => 'decimal:2',
        'termin_3' => 'decimal:2',
        'seen_at'  => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->order_code)) {
                $order->order_code = static::generateCode();
            }
        });
    }

    /**
     * Kode otomatis: SK-{tahun}-{urutan 4 digit}, contoh SK-2026-0089.
     * Panggil di dalam DB::transaction agar lockForUpdate efektif.
     */
    public static function generateCode(): string
    {
        $prefix = 'SK-' . now()->year . '-';

        $last = static::where('order_code', 'like', $prefix . '%')
            ->lockForUpdate()
            ->orderByDesc('order_code')
            ->value('order_code');

        $next = $last ? ((int) substr($last, strlen($prefix))) + 1 : 1;

        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    /* ---------- Accessors ---------- */

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'deal'   => 'bg-emerald-100 text-emerald-700',
            'cancel' => 'bg-rose-100 text-rose-700',
            default  => 'bg-amber-100 text-amber-700',
        };
    }

    public function getDenahUrlAttribute(): ?string
    {
        return $this->denah_image ? asset('storage/' . $this->denah_image) : null;
    }

    public function getLahanUrlAttribute(): ?string
    {
        return $this->lahan_image ? asset('storage/' . $this->lahan_image) : null;
    }

    public function getTerminTotalAttribute(): float
    {
        return (float) $this->termin_1 + (float) $this->termin_2 + (float) $this->termin_3;
    }

    /** Link WhatsApp ke pemesan (08xxx -> 628xxx). */
    public function getCustomerWhatsappUrlAttribute(): string
    {
        $number = preg_replace('/\D+/', '', $this->phone);
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }
        return 'https://wa.me/' . $number;
    }

    /* ---------- WhatsApp ke admin ---------- */

    public function whatsappMessage(): string
    {
        $dash = fn ($v) => filled($v) ? $v : '-';
        $company = strtoupper(\App\Models\Setting::first()?->company ?? 'SURYA KARYA');

        $lines = [
            '*PESANAN BARU - ' . $company . '*',
            'Kode Pesanan: ' . $this->order_code,
            '',
            '*Identitas*',
            'Nama: ' . $this->name,
            'Perusahaan: ' . $dash($this->company_name),
            '',
            '*Kontak*',
            'WhatsApp: ' . $this->phone,
            'Email: ' . $dash($this->email),
            '',
            '*Alamat Proyek*',
            $this->address,
            '',
            '*Detail Pemesanan*',
            'Layanan: ' . ($this->layanan?->title ?? '-'),
            'Luas Bangunan: ' . ($this->building_area ? $this->building_area . ' m²' : '-'),
            'Luas Lahan: ' . ($this->land_area ? $this->land_area . ' m²' : '-'),
            'Posisi Bangunan: ' . $dash($this->building_position),
            'Kebutuhan Proyek: ' . $this->project_detail,
            '',
            '*Catatan Tambahan*',
            $dash($this->notes),
            '',
            '*Lampiran*',
            'Denah: ' . ($this->denah_url ?? '-'),
            'Lahan: ' . ($this->lahan_url ?? '-'),
        ];

        return implode("\n", $lines);
    }

    public function adminWhatsappUrl(): string
    {
        return 'https://wa.me/' . config('services.whatsapp_admin')
            . '?text=' . rawurlencode($this->whatsappMessage());
    }
}