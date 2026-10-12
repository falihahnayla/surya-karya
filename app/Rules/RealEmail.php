<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RealEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email  = strtolower(trim((string) $value));
        $domain = substr(strrchr($email, '@') ?: '', 1);

        if ($domain === '') {
            $fail('Format email tidak valid.');
            return;
        }

        if (in_array($domain, config('disposable_domains', []), true)) {
            $fail('Email sementara/sekali pakai tidak diperbolehkan. Gunakan email aktif Anda.');
            return;
        }

        if (!@checkdnsrr($domain . '.', 'MX') && !@checkdnsrr($domain . '.', 'A')) {
            $fail('Domain email tidak ditemukan. Mohon gunakan email yang aktif.');
        }
    }
}
