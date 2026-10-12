@extends('layouts.app')

@section('title', 'Form Pemesanan Jasa | ' . ($siteSetting->company ?? 'Surya Karya'))

@push('styles')
<link href="{{ asset('css/form-pemesanan.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/form-pemesanan.js') }}"></script>
<script>
  // Tutup modal sukses
  function closeModal() {
    document.getElementById('success-modal')?.classList.add('hidden');
    document.getElementById('success-modal')?.classList.remove('flex');
  }

  @if (session('wa_url'))
    // Arahkan otomatis ke WhatsApp dengan pesan yang sudah terisi
    setTimeout(function () {
      window.location.href = @json(session('wa_url'));
    }, 2000);
  @endif
</script>
@endpush

@section('content')
@php
  $inputClass = 'input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900';
  $labelClass = 'block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5';
  $h2Class    = 'font-serif text-xl sm:text-2xl font-semibold text-slate-800 pb-2 border-b border-stone-200 mb-6';
  $emailVerified = old('email') && strtolower(old('email')) === session('verified_email');
@endphp

<main class="flex-grow py-10 sm:py-16 px-4 sm:px-6">
  <div class="max-w-3xl mx-auto">

    <!-- Logo -->
    <div class="flex justify-center mb-6 pt-12 sm:pt-7">
      <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden shadow-sm border border-stone-200 bg-white p-1">
        <img alt="Logo {{ $siteSetting->company ?? 'Surya Karya' }}" class="w-full h-full object-cover rounded-full"
             src="https://lh3.googleusercontent.com/aida-public/AB6AXuD84MJEp_1egsg2rnf-vVxJV9z8tO1tgHfHQX1KWTK3zDNY3_i7GJA8u1hH2jDkGL06Qwjs7oN6f7Oe-aLhPU3c2j1wAA6UtUdJaKNd6GHU0XVtMJfon55Oetdw5hzBUwHcpXFo468l5UfatJHMaB_GeLufABzBVZa3wJZxpEJsZI2pbC6COC7lx1z2aDNgBPeyAvukC2WJc3A5N3s5Y3IAknwJ2Rwdj9ewP8v9ALIGCeck6J5ROPs50tcp-7vCD_d2IQ"/>
      </div>
    </div>

    <!-- Judul -->
    <div class="text-center mb-10 sm:mb-12">
      <h1 class="font-serif text-3xl sm:text-5xl font-semibold tracking-tight text-navy-900 mb-3">Form Pemesanan Jasa</h1>
      <p class="text-slate-600 text-sm sm:text-base font-normal max-w-lg mx-auto">
        Ceritakan kebutuhan pembangunan atau renovasi Anda kepada kami.
      </p>
    </div>

    <!-- Ringkasan error -->
    @if ($errors->any())
      <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 px-5 py-4 text-sm text-rose-700" role="alert">
        <p class="font-semibold mb-1">Mohon periksa kembali isian Anda:</p>
        <ul class="list-disc pl-5 space-y-0.5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <section class="bg-white rounded-2xl shadow-sm border border-stone-200/90 p-6 sm:p-10 md:p-12">
      <form id="order-form" method="POST" action="{{ route('frontend.form-pesanan.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Honeypot bot protection (hidden from humans) --}}
        <div class="hidden" style="display: none;" aria-hidden="true">
          <label for="website_hp">Biarkan field ini kosong jika Anda manusia</label>
          <input type="text" id="website_hp" name="website_hp" tabindex="-1" autocomplete="off" value="">
        </div>

        <!-- 1. Identitas -->
        <div class="mb-10">
          <h2 class="{{ $h2Class }}">Identitas</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
            <div>
              <label class="{{ $labelClass }}" for="nama_lengkap">Nama Lengkap <span class="text-rose-600">*</span></label>
              <input class="{{ $inputClass }}" id="nama_lengkap" name="nama_lengkap" type="text" maxlength="100" required
                     value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap Anda">
              @error('nama_lengkap') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="{{ $labelClass }}" for="nama_perusahaan">Nama Perusahaan (Opsional)</label>
              <input class="{{ $inputClass }}" id="nama_perusahaan" name="nama_perusahaan" type="text" maxlength="100"
                     value="{{ old('nama_perusahaan') }}" placeholder="Nama perusahaan / instansi (jika ada)">
              @error('nama_perusahaan') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
          </div>
        </div>

        <!-- 2. Kontak -->
        <div class="mb-10">
          <h2 class="{{ $h2Class }}">Kontak</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
            <div>
              <label class="{{ $labelClass }}" for="nomor_whatsapp">Nomor WhatsApp <span class="text-rose-600">*</span></label>
              <input class="{{ $inputClass }}" id="nomor_whatsapp" name="nomor_whatsapp" type="tel" inputmode="numeric"
                     maxlength="15" required
                     value="{{ old('nomor_whatsapp') }}" placeholder="Contoh: 08123456789">
              <p id="whatsapp-inline-error" class="hidden mt-1 text-xs text-rose-600"></p>
              @error('nomor_whatsapp') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div id="email-wrap" data-verified="{{ $emailVerified ? '1' : '0' }}"
                 data-send-url="{{ route('frontend.email.send') }}"
                 data-verify-url="{{ route('frontend.email.verify') }}">
              <label class="{{ $labelClass }}" for="email">Email (Opsional)</label>

              <div class="flex gap-2">
                <input class="{{ $inputClass }} flex-1" id="email" name="email" type="email" maxlength="100"
                       value="{{ old('email') }}" placeholder="alamat.email@domain.com" autocomplete="email">
                <button type="button" id="btn-send-otp"
                        class="shrink-0 px-4 rounded-lg bg-[#0d1e38] hover:bg-[#071324] text-white text-xs font-semibold uppercase tracking-wider disabled:opacity-50 disabled:cursor-not-allowed">
                  Kirim Kode
                </button>
              </div>

              <div id="otp-box" class="hidden mt-3 flex gap-2">
                <input id="otp-code" type="text" inputmode="numeric" maxlength="6" placeholder="6 digit kode"
                       class="{{ $inputClass }} flex-1 tracking-[0.4em] text-center">
                <button type="button" id="btn-verify-otp"
                        class="shrink-0 px-4 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold uppercase tracking-wider disabled:opacity-50">
                  Verifikasi
                </button>
              </div>

              <p id="email-inline-error" class="hidden mt-1 text-xs text-rose-600"></p>
              <p id="email-inline-ok" class="{{ $emailVerified ? '' : 'hidden' }} mt-1 text-xs text-emerald-600 font-medium">✓ Email terverifikasi</p>
              <p class="mt-1 text-[11px] text-slate-400">Jika diisi, email wajib diverifikasi dengan kode yang dikirim ke inbox Anda.</p>
              @error('email') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
          </div>
        </div>

        <!-- 3. Alamat -->
        <div class="mb-10">
          <h2 class="{{ $h2Class }}">Alamat Proyek</h2>
          <div>
            <label class="{{ $labelClass }}" for="alamat_proyek">Alamat Lokasi Proyek <span class="text-rose-600">*</span></label>
            <textarea class="{{ $inputClass }}" id="alamat_proyek" name="alamat_proyek" rows="2" maxlength="500" required
                      placeholder="Masukkan alamat lengkap lokasi proyek, kota, dan patokan">{{ old('alamat_proyek') }}</textarea>
            @error('alamat_proyek') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
          </div>
        </div>

        <!-- 4. Detail Pemesanan -->
        <div class="mb-10">
          <h2 class="{{ $h2Class }}">Detail Pemesanan</h2>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-6">
            <div>
              <label class="{{ $labelClass }}" for="layanan_id">Jenis Layanan <span class="text-rose-600">*</span></label>
              <select class="{{ $inputClass }} appearance-none cursor-pointer" id="layanan_id" name="layanan_id" required>
                <option value="" disabled {{ old('layanan_id') ? '' : 'selected' }}>Pilih Layanan</option>
                @foreach ($layanan as $item)
                  <option value="{{ $item->id }}" {{ (string) old('layanan_id') === (string) $item->id ? 'selected' : '' }}>
                    {{ $item->title }}
                  </option>
                @endforeach
              </select>
              @error('layanan_id') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="{{ $labelClass }}" for="luas_bangunan">Luas Bangunan (m²)</label>
              <input class="{{ $inputClass }}" id="luas_bangunan" name="luas_bangunan" type="number" min="1" max="1000000" step="1" inputmode="numeric"
                     value="{{ old('luas_bangunan') }}" placeholder="Contoh: 250">
              @error('luas_bangunan') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-6">
            <div>
              <label class="{{ $labelClass }}" for="luas_lahan">Luas Lahan (m²)</label>
              <input class="{{ $inputClass }}" id="luas_lahan" name="luas_lahan" type="number" min="1" max="1000000" step="1" inputmode="numeric"
                     value="{{ old('luas_lahan') }}" placeholder="Contoh: 400">
              @error('luas_lahan') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
            <div>
              <label class="{{ $labelClass }}" for="posisi_bangunan">Arah atau Posisi Bangunan</label>
              <input class="{{ $inputClass }}" id="posisi_bangunan" name="posisi_bangunan" type="text" maxlength="100"
                     value="{{ old('posisi_bangunan') }}" placeholder="Contoh: Menghadap Selatan / Posisi Hook">
              @error('posisi_bangunan') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label class="{{ $labelClass }}" for="kebutuhan_proyek">Jenis/Kebutuhan Proyek <span class="text-rose-600">*</span></label>
            <textarea class="{{ $inputClass }}" id="kebutuhan_proyek" name="kebutuhan_proyek" rows="3" maxlength="2000" required
                      placeholder="Ceritakan detail kebutuhan renovasi atau pembangunan hunian Anda...">{{ old('kebutuhan_proyek') }}</textarea>
            @error('kebutuhan_proyek') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
          </div>
        </div>

        <!-- 5. Upload -->
        <div class="mb-10">
          <h2 class="{{ $h2Class }}">Berkas Pendukung (Opsional)</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

            <!-- Denah -->
            <div>
              <span class="font-serif text-lg font-medium text-slate-800 block mb-2">Gambar Denah</span>
              <label class="group flex flex-col items-center justify-center p-6 border-2 border-dashed border-stone-300 rounded-xl bg-stone-50/50 hover:bg-stone-50 hover:border-slate-400 cursor-pointer transition-all duration-200 relative min-h-[160px]">
                <div class="flex flex-col items-center justify-center" id="denah-default-ui">
                  <div class="mb-2 text-slate-500 group-hover:text-navy-900 transition-colors">
                    <svg class="w-8 h-8 stroke-[1.4]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                      <line x1="12" x2="12" y1="18" y2="12"></line>
                      <polyline points="9 15 12 12 15 15"></polyline>
                    </svg>
                  </div>
                  <span class="text-xs sm:text-sm font-semibold text-slate-800 text-center mb-1" id="denah-label">Upload Denah / Foto</span>
                  <span class="text-[11px] text-slate-400 text-center">JPG, PNG, PDF maks 10MB</span>
                </div>
                <div class="hidden flex-col items-center justify-center w-full" id="denah-preview-container">
                  <img alt="Preview Gambar Denah" class="hidden max-h-36 max-w-full rounded-lg object-contain shadow-sm border border-stone-200 mb-2" id="denah-preview-img" src=""/>
                  <div class="flex items-center gap-2 mb-1" id="denah-file-icon-box">
                    <svg class="w-7 h-7 text-navy-900 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                  </div>
                  <span class="text-xs font-semibold text-slate-800 text-center break-all px-2" id="denah-filename"></span>
                  <span class="text-[10px] text-emerald-600 font-medium mt-1">Klik untuk mengganti gambar</span>
                </div>
                <input accept=".jpg,.jpeg,.png,.pdf" class="hidden" id="file_denah" name="file_denah" type="file" onchange="previewUploadFile(this, 'denah')"/>
              </label>
              @error('file_denah') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>

            <!-- Lahan -->
            <div>
              <span class="font-serif text-lg font-medium text-slate-800 block mb-2">Gambar Lahan</span>
              <label class="group flex flex-col items-center justify-center p-6 border-2 border-dashed border-stone-300 rounded-xl bg-stone-50/50 hover:bg-stone-50 hover:border-slate-400 cursor-pointer transition-all duration-200 relative min-h-[160px]">
                <div class="flex flex-col items-center justify-center" id="lahan-default-ui">
                  <div class="mb-2 text-slate-500 group-hover:text-navy-900 transition-colors">
                    <svg class="w-8 h-8 stroke-[1.4]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <rect height="18" rx="2" ry="2" width="18" x="3" y="3"></rect>
                      <circle cx="8.5" cy="8.5" r="1.5"></circle>
                      <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                  </div>
                  <span class="text-xs sm:text-sm font-semibold text-slate-800 text-center mb-1" id="lahan-label">Upload Foto Lahan</span>
                  <span class="text-[11px] text-slate-400 text-center">JPG, PNG, PDF maks 10MB</span>
                </div>
                <div class="hidden flex-col items-center justify-center w-full" id="lahan-preview-container">
                  <img alt="Preview Gambar Lahan" class="hidden max-h-36 max-w-full rounded-lg object-contain shadow-sm border border-stone-200 mb-2" id="lahan-preview-img" src=""/>
                  <div class="flex items-center gap-2 mb-1" id="lahan-file-icon-box">
                    <svg class="w-7 h-7 text-navy-900 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect height="18" rx="2" ry="2" width="18" x="3" y="3"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                  </div>
                  <span class="text-xs font-semibold text-slate-800 text-center break-all px-2" id="lahan-filename"></span>
                  <span class="text-[10px] text-emerald-600 font-medium mt-1">Klik untuk mengganti gambar</span>
                </div>
                <input accept=".jpg,.jpeg,.png,.pdf" class="hidden" id="file_lahan" name="file_lahan" type="file" onchange="previewUploadFile(this, 'lahan')"/>
              </label>
              @error('file_lahan') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
            </div>
          </div>
        </div>

        <!-- 6. Catatan -->
        <div class="mb-10">
          <h2 class="{{ $h2Class }}">Catatan Tambahan</h2>
          <label class="{{ $labelClass }}" for="catatan_tambahan">Catatan Tambahan</label>
          <textarea class="{{ $inputClass }}" id="catatan_tambahan" name="catatan_tambahan" rows="2" maxlength="1000"
                    placeholder="Tambahkan catatan khusus atau preferensi lainnya...">{{ old('catatan_tambahan') }}</textarea>
          @error('catatan_tambahan') <p class="mt-1 text-xs text-rose-600">{{ $message }}</p> @enderror
        </div>

        <!-- 7. Submit -->
        <div class="pt-2">
          <button id="btn-submit" type="submit"
                  class="w-full bg-[#0d1e38] hover:bg-[#071324] text-white font-medium text-sm tracking-wider uppercase py-4 px-6 rounded-lg transition-all duration-200 shadow hover:shadow-md flex items-center justify-center gap-2">
            <span>Ajukan / Pesan Jasa</span>
          </button>
        </div>
      </form>
    </section>
  </div>
</main>

<!-- Modal sukses: tampil hanya jika controller redirect dengan session('success') -->
<div id="success-modal"
     class="fixed inset-0 z-50 {{ session('success') ? 'flex' : 'hidden' }} bg-slate-900/60 backdrop-blur-sm items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="success-title">
  <div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 text-center shadow-xl border border-stone-200">
    <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-4">
      <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
      </svg>
    </div>
    <h3 id="success-title" class="font-serif text-2xl font-semibold text-navy-900 mb-2">Pengajuan Berhasil Dikirim!</h3>
    <p class="text-slate-600 text-sm mb-6 leading-relaxed">
      Terima kasih telah mempercayakan proyek Anda. {{ $siteSetting->company ?? 'Surya Karya' }} akan segera meninjau data Anda.
      @if (session('wa_url'))
        <br><span class="font-medium text-slate-800">Anda akan diarahkan ke WhatsApp, cukup tekan kirim pada pesan yang sudah terisi.</span>
      @endif
    </p>
    <div class="space-y-3">
      <a id="btn-whatsapp-modal"
         href="{{ session('wa_url', $siteWa['url']) }}"
         target="_self" rel="noopener noreferrer"
         class="w-full inline-flex items-center justify-center bg-[#25D366] hover:bg-[#20b858] text-white font-medium py-3 px-4 rounded-lg text-sm shadow transition-colors gap-2">
        {{ session('wa_url') ? 'Buka WhatsApp Sekarang' : 'Chat WhatsApp (' . $siteWa['display'] . ')' }}
      </a>
      <button type="button" onclick="closeModal()"
              class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-lg text-sm transition-colors">
        Tutup
      </button>
    </div>
  </div>
</div>
@endsection