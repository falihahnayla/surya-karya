<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'company',
        'address',
        'phone',
        'email',
        'website',
        'whatsapp',
        'favicon',
        'description',
        'logo',
        'footer_text',
    ];

    /**
     * Helper normalisasi nomor WhatsApp / telepon:
     * - Hapus spasi, tanda +, tanda -, tanda kurung, dan karakter non-digit lainnya
     * - Ubah awalan '0' menjadi '62' (misal: 0812... -> 62812...)
     * - Ubah awalan '8' menjadi '628' (misal: 812... -> 62812...)
     * - Mengembalikan null jika input kosong atau tidak ada digit
     */
    public static function normalizeWhatsapp(?string $raw): ?string
    {
        if ($raw === null) {
            return null;
        }

        $number = preg_replace('/\D+/', '', $raw);

        if ($number === '') {
            return null;
        }

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        } elseif (str_starts_with($number, '8')) {
            $number = '62' . $number;
        }

        return $number;
    }

    /**
     * Nomor WhatsApp format internasional tanpa "+" (contoh: 628123456789).
     * HANYA diambil dari tabel settings kolom whatsapp, TIDAK ADA fallback nomor di kode.
     * Mengembalikan null jika di backoffice kosong.
     */
    public static function whatsappNumber(): ?string
    {
        $raw = null;
        try {
            $raw = static::query()->value('whatsapp');
        } catch (\Throwable $e) {
            // tabel belum ada atau error koneksi
        }

        return static::normalizeWhatsapp($raw);
    }

    /**
     * Helper URL WhatsApp (https://wa.me/62...(?text=...)).
     * Mengembalikan null jika nomor WhatsApp di backoffice kosong.
     */
    public static function whatsappUrl(?string $text = null): ?string
    {
        $number = static::whatsappNumber();
        if (!$number) {
            return null;
        }

        $url = 'https://wa.me/' . $number;
        if ($text !== null && $text !== '') {
            $url .= '?text=' . rawurlencode($text);
        }

        return $url;
    }

    /**
     * Format tampilan: 0812 3456 7890 (atau null jika nomor kosong)
     */
    public static function whatsappDisplay(): ?string
    {
        $n = static::whatsappNumber();
        if (!$n) {
            return null;
        }

        $local = str_starts_with($n, '62') ? '0' . substr($n, 2) : $n;

        return trim(chunk_split($local, 4, ' '));
    }
}