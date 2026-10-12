<?php

namespace App\Http\Requests;

use App\Rules\ValidEmailDns;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $sanitizeText = function (?string $value): ?string {
            if ($value === null) {
                return null;
            }
            $clean = trim(strip_tags($value));
            return $clean === '' ? null : $clean;
        };

        $phone = $this->nomor_whatsapp;
        if (is_string($phone)) {
            $phone = preg_replace('/\D+/', '', $phone);
        }

        $email = $this->email;
        if (is_string($email)) {
            $email = strtolower(trim(strip_tags($email)));
            $email = $email === '' ? null : $email;
        }

        $this->merge([
            'nama_lengkap'     => $sanitizeText($this->nama_lengkap),
            'nama_perusahaan'  => $sanitizeText($this->nama_perusahaan),
            'nomor_whatsapp'   => $phone ?: null,
            'email'            => $email,
            'alamat_proyek'    => $sanitizeText($this->alamat_proyek),
            'posisi_bangunan'  => $sanitizeText($this->posisi_bangunan),
            'kebutuhan_proyek' => $sanitizeText($this->kebutuhan_proyek),
            'catatan_tambahan' => $sanitizeText($this->catatan_tambahan),
            'luas_bangunan'    => filled($this->luas_bangunan) ? (int) $this->luas_bangunan : null,
            'luas_lahan'       => filled($this->luas_lahan) ? (int) $this->luas_lahan : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'website_hp'       => ['nullable', 'max:0'],
            'nama_lengkap'     => ['required', 'string', 'min:3', 'max:100', 'regex:/^[\pL\s\.\,\'\-]+$/u'],
            'nama_perusahaan'  => ['nullable', 'string', 'max:100', 'regex:/^[\pL0-9\s\.\,\&\-\(\)]+$/u'],
            'nomor_whatsapp'   => ['required', 'regex:/^(62|0)8[0-9]{8,12}$/', 'max:15'],
            'email'            => ['nullable', 'string', 'max:100', new ValidEmailDns()],
            'alamat_proyek'    => ['required', 'string', 'min:10', 'max:500'],
            'layanan_id'       => ['required', 'integer', 'exists:layanan,id'],
            'luas_bangunan'    => ['nullable', 'integer', 'min:1', 'max:1000000'],
            'luas_lahan'       => ['nullable', 'integer', 'min:1', 'max:1000000'],
            'posisi_bangunan'  => ['nullable', 'string', 'max:100'],
            'kebutuhan_proyek' => ['required', 'string', 'min:10', 'max:2000'],
            'catatan_tambahan' => ['nullable', 'string', 'max:1000'],
            'file_denah'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'mimetypes:image/jpeg,image/png,application/pdf', 'max:10240'],
            'file_lahan'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'mimetypes:image/jpeg,image/png,application/pdf', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'website_hp.max'            => 'Permintaan tidak valid (terdeteksi spam bot).',
            'nama_lengkap.required'     => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min'          => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.max'          => 'Nama lengkap maksimal 100 karakter.',
            'nama_lengkap.regex'        => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, koma, tanda petik, dan tanda hubung.',
            'nama_perusahaan.max'       => 'Nama perusahaan maksimal 100 karakter.',
            'nama_perusahaan.regex'     => 'Nama perusahaan hanya boleh berisi huruf, angka, spasi, dan karakter aman (.,&-()).',
            'nomor_whatsapp.required'   => 'Nomor WhatsApp wajib diisi.',
            'nomor_whatsapp.regex'      => 'Format nomor WhatsApp tidak valid. Gunakan format nomor Indonesia diawali 08 atau 628 (10–15 digit, contoh: 08123456789 atau 628123456789).',
            'nomor_whatsapp.max'        => 'Nomor WhatsApp maksimal 15 digit.',
            'email.max'                 => 'Email maksimal 100 karakter.',
            'alamat_proyek.required'    => 'Alamat proyek wajib diisi.',
            'alamat_proyek.min'         => 'Alamat proyek minimal 10 karakter.',
            'alamat_proyek.max'         => 'Alamat proyek maksimal 500 karakter.',
            'layanan_id.required'       => 'Silakan pilih jenis layanan.',
            'layanan_id.exists'         => 'Jenis layanan yang dipilih tidak valid.',
            'luas_bangunan.integer'     => 'Luas bangunan harus berupa angka bulat.',
            'luas_bangunan.min'         => 'Luas bangunan minimal 1 m².',
            'luas_bangunan.max'         => 'Luas bangunan maksimal 1.000.000 m².',
            'luas_lahan.integer'        => 'Luas lahan harus berupa angka bulat.',
            'luas_lahan.min'            => 'Luas lahan minimal 1 m².',
            'luas_lahan.max'            => 'Luas lahan maksimal 1.000.000 m².',
            'posisi_bangunan.max'       => 'Posisi bangunan maksimal 100 karakter.',
            'kebutuhan_proyek.required' => 'Kebutuhan proyek wajib diisi.',
            'kebutuhan_proyek.min'      => 'Kebutuhan proyek minimal 10 karakter.',
            'kebutuhan_proyek.max'      => 'Kebutuhan proyek maksimal 2000 karakter.',
            'catatan_tambahan.max'      => 'Catatan tambahan maksimal 1000 karakter.',
            'file_denah.mimes'          => 'File denah harus berformat JPG, JPEG, PNG, atau PDF.',
            'file_denah.mimetypes'      => 'File denah harus berformat JPG, JPEG, PNG, atau PDF.',
            'file_denah.max'            => 'Ukuran file denah maksimal 10MB.',
            'file_lahan.mimes'          => 'File lahan harus berformat JPG, JPEG, PNG, atau PDF.',
            'file_lahan.mimetypes'      => 'File lahan harus berformat JPG, JPEG, PNG, atau PDF.',
            'file_lahan.max'            => 'Ukuran file lahan maksimal 10MB.',
        ];
    }
}
