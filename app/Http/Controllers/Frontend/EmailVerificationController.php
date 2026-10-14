<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtpMail;
use App\Rules\RealEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class EmailVerificationController extends Controller
{
    private const TTL_MIN              = 10;   // masa berlaku kode (menit)
    private const MAX_SEND_PER_HOUR    = 5;    // batas maksimal pengiriman per email dalam 1 jam
    private const SEND_WINDOW_S        = 3600; // periode reset pengiriman (1 jam = 3600 detik)
    private const MAX_VERIFY_TRIES     = 5;    // batas maksimal salah input kode verifikasi
    private const CACHE_STORAGE_HOURS  = 2;    // durasi penyimpanan data di cache

    public function send(Request $request)
    {
        $request->merge(['email' => strtolower(trim((string) $request->email))]);
        $request->validate(['email' => ['required', 'email:rfc', 'max:100', new RealEmail]]);

        $email       = $request->email;
        $sendRateKey = 'otp_send_limit:' . sha1($email);
        $otpKey      = 'otp:' . sha1($email);

        // 1. Batas maksimal 5 kali pengiriman per alamat email dalam periode 1 jam (tetap dipertahankan)
        if (RateLimiter::tooManyAttempts($sendRateKey, self::MAX_SEND_PER_HOUR)) {
            $seconds = RateLimiter::availableIn($sendRateKey);
            $minutes = max(1, (int) ceil($seconds / 60));
            return response()->json([
                'message' => "Batas pengiriman kode untuk email ini telah tercapai (maksimal 5 kali per jam). Silakan coba lagi dalam {$minutes} menit.",
            ], 429);
        }

        $code      = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $now       = now();
        $expiresAt = $now->copy()->addMinutes(self::TTL_MIN);

        // Simpan data OTP dengan expires_at eksplisit (Unix timestamp server) & raw code
        Cache::put($otpKey, [
            'email'      => $email,
            'code'       => $code,
            'hash'       => Hash::make($code),
            'tries'      => 0,
            'created_at' => $now->timestamp,
            'expires_at' => $expiresAt->timestamp,
        ], now()->addHours(self::CACHE_STORAGE_HOURS));

        RateLimiter::hit($sendRateKey, self::SEND_WINDOW_S);
        session(['pending_otp_email' => $email]);

        try {
            Mail::to($email)->send(new EmailOtpMail($code, self::TTL_MIN));
        } catch (\Throwable $e) {
            report($e);
            Cache::forget($otpKey);
            RateLimiter::clear($sendRateKey);
            return response()->json(['message' => 'Kode tidak dapat dikirim ke email tersebut. Pastikan alamat email benar dan aktif.'], 422);
        }

        return response()->json(['message' => 'Kode verifikasi telah dikirim ke ' . $email . '. Cek inbox atau folder spam.']);
    }

    public function verify(Request $request)
    {
        $request->merge(['email' => strtolower(trim((string) $request->email))]);
        $request->validate([
            'email' => ['required', 'email:rfc', 'max:100'],
            'code'  => ['required', 'digits:6'],
        ], ['code.digits' => 'Kode harus 6 digit angka.']);

        $email  = $request->email;
        $otpKey = 'otp:' . sha1($email);

        // 1. Jika email ini sudah terverifikasi di session atau cache, langsung anggap berhasil
        $isAlreadyVerified = (
            session('verified_email') === $email
            && (now()->timestamp - (int) session('verified_email_at', 0)) <= 1800
        ) || Cache::has('otp_verified:' . sha1($email));

        if ($isAlreadyVerified) {
            session([
                'verified_email'    => $email,
                'verified_email_at' => now()->timestamp,
            ]);
            return response()->json(['message' => 'Email berhasil diverifikasi.']);
        }

        $data = Cache::get($otpKey);

        if (!$data) {
            return response()->json(['message' => 'Kode verifikasi belum diminta. Silakan kirim kode terlebih dahulu.'], 422);
        }

        // 3. Cek masa berlaku berdasarkan server timestamp
        if (now()->timestamp > (int) ($data['expires_at'] ?? 0)) {
            return response()->json(['message' => 'Kode verifikasi telah kedaluwarsa. Silakan minta kode baru.'], 422);
        }

        // 4. Cek apakah batas salah percobaan memasukkan kode sudah tercapai
        if (($data['tries'] ?? 0) >= self::MAX_VERIFY_TRIES) {
            return response()->json(['message' => 'Terlalu banyak percobaan salah. Silakan minta kode baru.'], 429);
        }

        // 5. Verifikasi kode (dukung hash bcrypt dan raw code fallback)
        $isMatch = Hash::check($request->code, $data['hash'] ?? '')
            || (isset($data['code']) && hash_equals((string) $data['code'], (string) $request->code));

        if (!$isMatch) {
            $data['tries'] = ($data['tries'] ?? 0) + 1;
            Cache::put($otpKey, $data, now()->addHours(self::CACHE_STORAGE_HOURS));

            $remaining = max(0, self::MAX_VERIFY_TRIES - $data['tries']);
            return response()->json(['message' => 'Kode salah. Sisa percobaan: ' . $remaining . '.'], 422);
        }

        // 6. Verifikasi berhasil
        Cache::forget($otpKey);
        // Simpan flag terverifikasi di cache selama 30 menit sebagai pengaman
        Cache::put('otp_verified:' . sha1($email), now()->timestamp, now()->addMinutes(30));

        session([
            'verified_email'    => $email,
            'verified_email_at' => now()->timestamp,
        ]);
        session()->forget('pending_otp_email');

        return response()->json(['message' => 'Email berhasil diverifikasi.']);
    }
}
