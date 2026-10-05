<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    /** Nomor cadangan terakhir jika admin & config sama-sama kosong */
    public const WA_FALLBACK = '62895635040947';

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
     * Nomor WhatsApp format internasional tanpa "+" (contoh: 62895635040947).
     * Prioritas: Admin (tabel settings) -> config/.env -> konstanta di kode.
     */
    public static function whatsappNumber(): string
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }

        $raw = null;
        try {
            $raw = static::query()->value('whatsapp');
        } catch (\Throwable $e) {
            // tabel belum ada / belum migrate -> lanjut ke fallback
        }

        $number = preg_replace('/\D+/', '', (string) $raw);

        if ($number === '') {
            $number = preg_replace('/\D+/', '', (string) config('services.whatsapp_admin', self::WA_FALLBACK));
        }

        if ($number === '') {
            $number = self::WA_FALLBACK;
        }

        // 08xxx -> 628xxx, 8xxx -> 628xxx
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        } elseif (str_starts_with($number, '8')) {
            $number = '62' . $number;
        }

        return $cache = $number;
    }

    /** Format tampilan: 0895 6350 40947 */
    public static function whatsappDisplay(): string
    {
        $n = static::whatsappNumber();
        $local = str_starts_with($n, '62') ? '0' . substr($n, 2) : $n;

        return trim(chunk_split($local, 4, ' '));
    }
}