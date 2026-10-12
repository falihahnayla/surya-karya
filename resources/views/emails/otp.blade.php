@php
    $companyName = \App\Models\Setting::first()?->company ?? 'Surya Karya';
@endphp
<div style="font-family: Arial, sans-serif; max-width: 440px; margin: auto; padding: 28px; border: 1px solid #e2e8f0; border-radius: 12px; background-color: #ffffff; color: #1e293b;">
  <h2 style="margin: 0 0 12px; color: #0d1e38; font-size: 20px;">Verifikasi Email &mdash; {{ $companyName }}</h2>
  <p style="color: #475569; font-size: 14px; line-height: 1.5; margin: 0 0 20px;">
    Terima kasih telah mengisi formulir pemesanan. Masukkan kode verifikasi berikut untuk mengonfirmasi email Anda:
  </p>
  <div style="font-size: 32px; letter-spacing: 8px; font-weight: 700; color: #0d1e38; background: #f1f5f9; padding: 16px; text-align: center; border-radius: 8px; margin-bottom: 20px;">
    {{ $code }}
  </div>
  <p style="color: #64748b; font-size: 12px; line-height: 1.5; margin: 0;">
    Kode berlaku <strong>{{ $minutes }} menit</strong>. Jangan bagikan kode ini kepada siapa pun. Jika Anda tidak merasa mengajukan pemesanan ini, silakan abaikan email ini.
  </p>
</div>
