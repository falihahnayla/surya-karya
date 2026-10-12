<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\EmailOtpMail;
use App\Rules\RealEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    private const TTL_MIN    = 10;  // masa berlaku kode (menit)
    private const COOLDOWN_S = 60;  // jeda kirim ulang (detik)
    private const MAX_TRIES  = 5;   // maksimal salah input

    public function send(Request $request)
    {
        $request->merge(['email' => strtolower(trim((string) $request->email))]);
        $request->validate(['email' => ['required', 'email:rfc', 'max:100', new RealEmail]]);

        $email  = $request->email;
        $otpKey = 'otp:' . sha1($email);
        $cdKey  = 'otp_cd:' . sha1($email . '|' . $request->ip());

        if (Cache::has($cdKey)) {
            return response()->json(['message' => 'Mohon tunggu 1 menit sebelum meminta kode lagi.'], 429);
        }

        $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        Cache::put($otpKey, ['hash' => Hash::make($code), 'tries' => 0], now()->addMinutes(self::TTL_MIN));
        Cache::put($cdKey, 1, now()->addSeconds(self::COOLDOWN_S));

        try {
            Mail::to($email)->send(new EmailOtpMail($code, self::TTL_MIN));
        } catch (\Throwable $e) {
            report($e);
            Cache::forget($otpKey);
            Cache::forget($cdKey);
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

        $otpKey = 'otp:' . sha1($request->email);
        $data   = Cache::get($otpKey);

        if (!$data) {
            return response()->json(['message' => 'Kode kedaluwarsa atau belum diminta. Silakan kirim kode lagi.'], 422);
        }

        if ($data['tries'] >= self::MAX_TRIES) {
            Cache::forget($otpKey);
            return response()->json(['message' => 'Terlalu banyak percobaan salah. Silakan minta kode baru.'], 429);
        }

        if (!Hash::check($request->code, $data['hash'])) {
            $data['tries']++;
            Cache::put($otpKey, $data, now()->addMinutes(self::TTL_MIN));
            return response()->json(['message' => 'Kode salah. Sisa percobaan: ' . (self::MAX_TRIES - $data['tries']) . '.'], 422);
        }

        Cache::forget($otpKey);
        session([
            'verified_email'    => $request->email,
            'verified_email_at' => now()->timestamp,
        ]);

        return response()->json(['message' => 'Email berhasil diverifikasi.']);
    }
}
