@extends('layouts.app')

@section('title', 'Form Pemesanan Jasa | Surya Karya')

@push('styles')
<link href="{{ asset('css/form-pemesanan.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/form-pemesanan.js') }}"></script>
@endpush

@section('content')



<!-- BEGIN: MainContent -->
<main class="flex-grow py-10 sm:py-16 px-4 sm:px-6">
<div class="max-w-3xl mx-auto">
<!-- Logo Badge Above Title -->
<div class="flex justify-center mb-6 pt-12 sm:pt-7" data-purpose="brand-badge">
<div class="w-20 h-20 sm:w-24 sm:h-24 rounded-full overflow-hidden shadow-sm border border-stone-200 bg-white p-1">
<img alt="Logo Surya Karya" class="w-full h-full object-cover rounded-full" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD84MJEp_1egsg2rnf-vVxJV9z8tO1tgHfHQX1KWTK3zDNY3_i7GJA8u1hH2jDkGL06Qwjs7oN6f7Oe-aLhPU3c2j1wAA6UtUdJaKNd6GHU0XVtMJfon55Oetdw5hzBUwHcpXFo468l5UfatJHMaB_GeLufABzBVZa3wJZxpEJsZI2pbC6COC7lx1z2aDNgBPeyAvukC2WJc3A5N3s5Y3IAknwJ2Rwdj9ewP8v9ALIGCeck6J5ROPs50tcp-7vCD_d2IQ"/>
</div>
</div>
<!-- Page Title & Tagline -->
<div class="text-center mb-10 sm:mb-12">
<h1 class="font-serif text-3xl sm:text-5xl font-semibold tracking-tight text-navy-900 mb-3">
          Form Pemesanan Jasa
        </h1>
<p class="text-slate-600 text-sm sm:text-base font-normal max-w-lg mx-auto">
          Ceritakan kebutuhan pembangunan atau renovasi Anda kepada kami.
        </p>
</div>
<!-- BEGIN: OrderFormCard -->
<section class="bg-white rounded-2xl shadow-sm border border-stone-200/90 p-6 sm:p-10 md:p-12">
<form id="order-form" onsubmit="handleFormSubmit(event)">
<!-- SECTION 1: Identitas -->
<div class="mb-10" data-purpose="section-identitas">
<h2 class="font-serif text-xl sm:text-2xl font-semibold text-slate-800 pb-2 border-b border-stone-200 mb-6">
              Identitas
            </h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
<!-- Nama Lengkap -->
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="nama_lengkap">
                  Nama Lengkap <span class="text-rose-600">*</span>
</label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap Anda" required="" type="text"/>
</div>
<!-- Nama Perusahaan -->
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="nama_perusahaan">
                  Nama Perusahaan (Opsional)
                </label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="nama_perusahaan" name="nama_perusahaan" placeholder="Nama perusahaan / instansi (jika ada)" type="text"/>
</div>
</div>
</div>
<!-- SECTION 2: Kontak -->
<div class="mb-10" data-purpose="section-kontak">
<h2 class="font-serif text-xl sm:text-2xl font-semibold text-slate-800 pb-2 border-b border-stone-200 mb-6">
              Kontak
            </h2>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
<!-- Nomor WhatsApp -->
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="nomor_whatsapp">
                  Nomor WhatsApp <span class="text-rose-600">*</span>
</label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="nomor_whatsapp" name="nomor_whatsapp" placeholder="Contoh: 08123456789" required="" type="tel"/>
</div>
<!-- Email -->
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="email">
                  Email (Opsional)
                </label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="email" name="email" placeholder="alamat.email@domain.com" type="email"/>
</div>
</div>
</div>
<!-- SECTION 3: Alamat Proyek -->
<div class="mb-10" data-purpose="section-alamat">
<h2 class="font-serif text-xl sm:text-2xl font-semibold text-slate-800 pb-2 border-b border-stone-200 mb-6">
              Alamat Proyek
            </h2>
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="alamat_proyek">
                Alamat Lokasi Proyek <span class="text-rose-600">*</span>
</label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="alamat_proyek" name="alamat_proyek" placeholder="Masukkan alamat lengkap lokasi proyek, kota, dan patokan" required="" type="text"/>
</div>
</div>
<!-- SECTION 4: Detail Pemesanan -->
<div class="mb-10" data-purpose="section-detail-pemesanan">
<h2 class="font-serif text-xl sm:text-2xl font-semibold text-slate-800 pb-2 border-b border-stone-200 mb-6">
              Detail Pemesanan
            </h2>
<!-- Row 1: Jenis Layanan & Luas Bangunan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-6">
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="jenis_layanan">
                  Jenis Layanan <span class="text-rose-600">*</span>
</label>
<div class="relative">
<select class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900 appearance-none cursor-pointer" id="jenis_layanan" name="jenis_layanan" required="">
<option class="text-slate-400" disabled="" selected="" value="">Pilih Layanan</option>
<option value="Pembangunan Rumah Baru">Pembangunan Rumah Baru</option>
<option value="Renovasi Rumah Total">Renovasi Rumah Total</option>
<option value="Renovasi Parsial / Interior">Renovasi Parsial / Interior</option>
<option value="Desain Arsitektur &amp; Struktur">Desain Arsitektur &amp; Struktur</option>
</select>
</div>
</div>
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="luas_bangunan">
                  Luas Bangunan (m²)
                </label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="luas_bangunan" name="luas_bangunan" placeholder="Contoh: 250" type="number"/>
</div>
</div>
<!-- Row 2: Luas Lahan & Arah Bangunan -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-6">
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="luas_lahan">
                  Luas Lahan (m²)
                </label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="luas_lahan" name="luas_lahan" placeholder="Contoh: 400" type="number"/>
</div>
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="posisi_bangunan">
                  Arah atau Posisi Bangunan
                </label>
<input class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="posisi_bangunan" name="posisi_bangunan" placeholder="Contoh: Menghadap Selatan / Posisi Hook" type="text"/>
</div>
</div>
<!-- Kebutuhan Proyek -->
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="kebutuhan_proyek">
                Jenis/Kebutuhan Proyek <span class="text-rose-600">*</span>
</label>
<textarea class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="kebutuhan_proyek" name="kebutuhan_proyek" placeholder="Ceritakan detail kebutuhan renovasi atau pembangunan hunian Anda..." required="" rows="3"></textarea>
</div>
</div>
<!-- SECTION 5: Upload Berkas / Gambar -->
<div class="mb-10" data-purpose="section-upload">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
<!-- Card 1: Denah -->
<div>
<span class="font-serif text-lg font-medium text-slate-800 block mb-2">Gambar Denah</span>
<label class="group flex flex-col items-center justify-center p-6 border-2 border-dashed border-stone-300 rounded-xl bg-stone-50/50 hover:bg-stone-50 hover:border-slate-400 cursor-pointer transition-all duration-200 relative min-h-[160px]">
<!-- Default State UI -->
<div class="flex flex-col items-center justify-center" id="denah-default-ui">
<div class="mb-2 text-slate-500 group-hover:text-navy-900 transition-colors">
<!-- Document / Upload Icon -->
<svg class="w-8 h-8 stroke-[1.4]" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
<polyline points="14 2 14 8 20 8"></polyline>
<line x1="12" x2="12" y1="18" y2="12"></line>
<polyline points="9 15 12 12 15 15"></polyline>
</svg>
</div>
<span class="text-xs sm:text-sm font-semibold text-slate-800 text-center mb-1" id="denah-label">Upload Denah / Foto</span>
<span class="text-[11px] text-slate-400 text-center">JPG, PNG, PDF maks 10MB</span>
</div>
<!-- Preview Container -->
<div class="hidden flex flex-col items-center justify-center w-full" id="denah-preview-container">
<img alt="Preview Gambar Denah" class="hidden max-h-36 max-w-full rounded-lg object-contain shadow-sm border border-stone-200 mb-2" id="denah-preview-img" src=""/>
<div class="flex items-center gap-2 mb-1" id="denah-file-icon-box">
<svg class="w-7 h-7 text-navy-900 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
</div>
<span class="text-xs font-semibold text-slate-800 text-center break-all px-2" id="denah-filename"></span>
<span class="text-[10px] text-emerald-600 font-medium mt-1">Klik untuk mengganti gambar</span>
</div>
<input accept=".jpg,.jpeg,.png,.pdf" class="hidden" id="file_denah" onchange="previewUploadFile(this, 'denah')" type="file"/>
</label>
</div>
<!-- Card 2: Lahan -->
<div>
<span class="font-serif text-lg font-medium text-slate-800 block mb-2">Gambar Lahan</span>
<label class="group flex flex-col items-center justify-center p-6 border-2 border-dashed border-stone-300 rounded-xl bg-stone-50/50 hover:bg-stone-50 hover:border-slate-400 cursor-pointer transition-all duration-200 relative min-h-[160px]">
<!-- Default State UI -->
<div class="flex flex-col items-center justify-center" id="lahan-default-ui">
<div class="mb-2 text-slate-500 group-hover:text-navy-900 transition-colors">
<!-- Image / Landscape Icon -->
<svg class="w-8 h-8 stroke-[1.4]" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<rect height="18" rx="2" ry="2" width="18" x="3" y="3"></rect>
<circle cx="8.5" cy="8.5" r="1.5"></circle>
<polyline points="21 15 16 10 5 21"></polyline>
<line x1="19" x2="19" y1="5" y2="9"></line>
<line x1="17" x2="21" y1="7" y2="7"></line>
</svg>
</div>
<span class="text-xs sm:text-sm font-semibold text-slate-800 text-center mb-1" id="lahan-label">Upload Foto Lahan</span>
<span class="text-[11px] text-slate-400 text-center">JPG, PNG, PDF maks 10MB</span>
</div>
<!-- Preview Container -->
<div class="hidden flex flex-col items-center justify-center w-full" id="lahan-preview-container">
<img alt="Preview Gambar Lahan" class="hidden max-h-36 max-w-full rounded-lg object-contain shadow-sm border border-stone-200 mb-2" id="lahan-preview-img" src=""/>
<div class="flex items-center gap-2 mb-1" id="lahan-file-icon-box">
<svg class="w-7 h-7 text-navy-900 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect height="18" rx="2" ry="2" width="18" x="3" y="3"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
</div>
<span class="text-xs font-semibold text-slate-800 text-center break-all px-2" id="lahan-filename"></span>
<span class="text-[10px] text-emerald-600 font-medium mt-1">Klik untuk mengganti gambar</span>
</div>
<input accept=".jpg,.jpeg,.png,.pdf" class="hidden" id="file_lahan" onchange="previewUploadFile(this, 'lahan')" type="file"/>
</label>
</div>
</div>
</div>
<!-- SECTION 6: Catatan Tambahan -->
<div class="mb-10" data-purpose="section-catatan">
<h2 class="font-serif text-xl sm:text-2xl font-semibold text-slate-800 pb-2 border-b border-stone-200 mb-6">
              Catatan Tambahan
            </h2>
<div>
<label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 mb-1.5" for="catatan_tambahan">
                Catatan Tambahan
              </label>
<textarea class="input-borderless border-0 border-transparent bg-slate-50 focus:bg-white focus:outline-none focus:ring-1 focus:ring-navy-900" id="catatan_tambahan" name="catatan_tambahan" placeholder="Tambahkan catatan khusus atau preferensi lainnya..." rows="2"></textarea>
</div>
</div>
<!-- SECTION 7: Submit Button -->
<div class="pt-2">
<button class="w-full bg-[#0d1e38] hover:bg-[#071324] text-white font-medium text-sm tracking-wider uppercase py-4 px-6 rounded-lg transition-all duration-200 shadow hover:shadow-md flex items-center justify-center gap-2" type="submit">
<span>Ajukan / Pesan Jasa</span>
</button>
</div>
</form>
</section>
<!-- END: OrderFormCard -->
</div>
</main>
<!-- END: MainContent -->
<!-- BEGIN: SuccessModal -->
<div class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4" id="success-modal">
<div class="bg-white rounded-2xl max-w-md w-full p-6 sm:p-8 text-center shadow-xl border border-stone-200 animate-in fade-in zoom-in duration-200">
<div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto mb-4">
<svg class="w-8 h-8" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
<path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</div>
<h3 class="font-serif text-2xl font-semibold text-navy-900 mb-2">Pengajuan Berhasil Dikirim!</h3>
<p class="text-slate-600 text-sm mb-6 leading-relaxed">
        Terima kasih telah mempercayakan proyek Anda. Surya Karya akan segera meninjau data Anda dan menghubungi melalui WhatsApp.
      </p>
<div class="space-y-3">
<a id="btn-whatsapp-modal" class="w-full inline-flex items-center justify-center bg-[#25D366] hover:bg-[#20b858] text-white font-medium py-3 px-4 rounded-lg text-sm shadow transition-colors gap-2" href="https://wa.me/62895635040947" rel="noopener noreferrer" target="_blank">
<svg class="w-5 h-5 fill-current" viewbox="0 0 24 24">
<path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"></path>
</svg>
          Chat WhatsApp (0895 6350 40947)
        </a>
<button class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-lg text-sm transition-colors" onclick="closeModal()" type="button">
          Tutup
        </button>
</div>
</div>
</div>
<!-- END: SuccessModal -->

 @endsection