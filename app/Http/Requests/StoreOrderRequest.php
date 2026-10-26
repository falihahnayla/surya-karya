<?php

namespace App\Http\Requests;

use App\Models\Layanan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    /*
     * Whitelist karakter. Simbol seperti !@#$%^&*()_+=[]{}<>|\~` TIDAK diizinkan.
     * Setiap pola juga mewajibkan minimal 1 huruf/angka (lookahead),
     * sehingga input seperti "..." atau "---" ditolak.
     */
    private const RX_NAME     = '/^(?=.*\p{L})[\p{L}\p{M} .\'\-]+$/us';
    private const RX_COMPANY  = '/^(?=.*[\p{L}\p{N}])[\p{L}\p{M}\p{N} .,\'\-]+$/us';
    private const RX_ADDRESS  = '/^(?=.*[\p{L}\p{N}])[\p{L}\p{M}\p{N} \r\n.,\'\-\/]+$/us';
    private const RX_POSITION = '/^(?=.*[\p{L}\p{N}])[\p{L}\p{M}\p{N} .,\'\-\/]+$/us';
    private const RX_TEXT     = '/^(?=.*[\p{L}\p{N}])[\p{L}\p{M}\p{N} \r\n.,\'\-\/:?]+$/us';

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Rapikan input sebelum divalidasi (nomor_whatsapp & email SENGAJA tidak disentuh).
     */
    protected function prepareForValidation(): void
    {
        $clean = function ($value, bool $multiline = false) {
            if (!is_string($value)) {
                return $value;
            }

            $v = str_replace(["\r\n", "\r"], "\n", $value);

            // Buang karakter kontrol / tak terlihat (kecuali newline)
            $v = preg_replace('/[^\P{C}\n]+/u', '', $v) ?? $v;

            if ($multiline) {
                $v = preg_replace('/[ \t]+/u', ' ', $v) ?? $v;
                $v = preg_replace("/\n{3,}/", "\n\n", $v) ?? $v;
            } else {
                $v = preg_replace('/\s+/u', ' ', $v) ?? $v;
            }

            return trim($v);
        };

        $data = [];

        foreach (['nama_lengkap', 'nama_perusahaan', 'posisi_bangunan'] as $field) {
            if ($this->has($field)) {
                $data[$field] = $clean($this->input($field));
            }
        }

        foreach (['alamat_proyek', 'kebutuhan_proyek', 'catatan_tambahan'] as $field) {
            if ($this->has($field)) {
                $data[$field] = $clean($this->input($field), true);
            }
        }

        if ($this->has('email') && $this->input('email') !== null) {
            $cleanEmail = strtolower(trim((string) $this->input('email')));
            $data['email'] = $cleanEmail === '' ? null : $cleanEmail;
        }

        $this->merge($data);
    }

    public function rules(): array
    {
        return [
            // Honeypot: harus kosong. Bot yang mengisinya akan ditolak.
            'website_hp' => ['prohibited'],

            'nama_lengkap'    => ['required', 'string', 'min:3', 'max:100', 'regex:' . self::RX_NAME],
            'nama_perusahaan' => ['nullable', 'string', 'max:100', 'regex:' . self::RX_COMPANY],

            'nomor_whatsapp' => ['required', 'regex:/^(62|0)8[0-9]{8,12}$/', 'max:15'],
            'email'          => [
                'nullable',
                'max:100',
                'regex:/^[a-zA-Z0-9._\-+@]+$/',
                'email:rfc',
            ],

            'alamat_proyek' => ['required', 'string', 'min:10', 'max:500', 'regex:' . self::RX_ADDRESS],

            'layanan_id' => ['required', 'integer', Rule::exists(Layanan::class, 'id')],

            'luas_bangunan' => ['nullable', 'integer', 'min:1', 'max:1000000', 'regex:/^[0-9]{1,7}$/'],
            'luas_lahan'    => ['nullable', 'integer', 'min:1', 'max:1000000', 'regex:/^[0-9]{1,7}$/'],

            'posisi_bangunan'  => ['nullable', 'string', 'max:100', 'regex:' . self::RX_POSITION],
            'kebutuhan_proyek' => ['required', 'string', 'min:10', 'max:2000', 'regex:' . self::RX_TEXT],
            'catatan_tambahan' => ['nullable', 'string', 'max:1000', 'regex:' . self::RX_TEXT],

            'file_denah' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
            'file_lahan' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'website_hp.prohibited' => 'Pengiriman ditolak.',

            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'      => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.regex'    => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, apostrof, dan tanda hubung (-).',

            'nama_perusahaan.regex' => 'Nama perusahaan hanya boleh berisi huruf, angka, spasi, titik, koma, apostrof, dan tanda hubung (-).',

            'nomor_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'nomor_whatsapp.regex'    => 'Format nomor WhatsApp tidak valid. Gunakan format nomor Indonesia diawali 08 atau 628 (10–15 digit, contoh: 08123456789 atau 628123456789).',
            'nomor_whatsapp.max'      => 'Nomor WhatsApp maksimal 15 digit.',

            'email.regex' => 'Email hanya boleh berisi huruf, angka, dan karakter . _ - + @.',
            'email.email' => 'Format email tidak valid. Pastikan penulisan alamat email benar.',
            'email.max'   => 'Email maksimal 100 karakter.',

            'alamat_proyek.required' => 'Alamat proyek wajib diisi.',
            'alamat_proyek.min'      => 'Alamat proyek minimal 10 karakter.',
            'alamat_proyek.regex'    => 'Alamat hanya boleh berisi huruf, angka, spasi, titik, koma, apostrof, tanda hubung (-), dan garis miring (/).',

            'layanan_id.required' => 'Pilih jenis layanan.',
            'layanan_id.exists'   => 'Jenis layanan tidak valid.',

            'luas_bangunan.integer' => 'Luas bangunan harus berupa angka bulat.',
            'luas_bangunan.regex'   => 'Luas bangunan hanya boleh berisi angka.',
            'luas_lahan.integer'    => 'Luas lahan harus berupa angka bulat.',
            'luas_lahan.regex'      => 'Luas lahan hanya boleh berisi angka.',

            'posisi_bangunan.regex' => 'Arah/posisi bangunan hanya boleh berisi huruf, angka, spasi, titik, koma, apostrof, tanda hubung (-), dan garis miring (/).',

            'kebutuhan_proyek.required' => 'Kebutuhan proyek wajib diisi.',
            'kebutuhan_proyek.min'      => 'Kebutuhan proyek minimal 10 karakter.',
            'kebutuhan_proyek.regex'    => 'Kebutuhan proyek hanya boleh berisi huruf, angka, spasi, titik, koma, apostrof, tanda hubung (-), garis miring (/), titik dua (:), dan tanda tanya (?).',

            'catatan_tambahan.regex' => 'Catatan hanya boleh berisi huruf, angka, spasi, titik, koma, apostrof, tanda hubung (-), garis miring (/), titik dua (:), dan tanda tanya (?).',

            'file_denah.mimes' => 'Gambar denah harus berformat JPG, PNG, atau PDF.',
            'file_denah.max'   => 'Ukuran gambar denah maksimal 10MB.',
            'file_lahan.mimes' => 'Gambar lahan harus berformat JPG, PNG, atau PDF.',
            'file_lahan.max'   => 'Ukuran gambar lahan maksimal 10MB.',
        ];
    }
}