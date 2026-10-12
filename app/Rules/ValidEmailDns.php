<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class ValidEmailDns implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_string($value) || trim($value) === '') {
            return;
        }

        $email = trim($value);

        // 1. Format RFC & spoof check
        $rule = extension_loaded('intl') ? 'email:rfc,spoof' : 'email:rfc';
        $validator = Validator::make(
            [$attribute => $email],
            [$attribute => $rule]
        );

        if ($validator->fails()) {
            $fail('Format email tidak valid.');
            return;
        }

        // 2. DNS/MX domain check
        $domain = substr(strrchr($email, '@'), 1);
        if ($domain) {
            try {
                $hasMx = @checkdnsrr($domain, 'MX') || @checkdnsrr($domain, 'A');
                if (!$hasMx) {
                    // Cek apakah DNS server bisa meresolusi domain umum (misal google.com)
                    // Jika iya berarti jaringan normal dan domain email memang fiktif
                    $dnsAlive = @checkdnsrr('google.com', 'MX') || @checkdnsrr('google.com', 'A');
                    if ($dnsAlive) {
                        $fail('Email tidak valid atau domain email tidak ditemukan. Mohon gunakan email yang aktif.');
                    }
                }
            } catch (\Throwable $e) {
                // Fallback aman: jika ada masalah lookup jaringan/DNS server, jangan tolak pengguna
            }
        }
    }
}
