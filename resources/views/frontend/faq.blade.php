@extends('layouts.app')

@section('title', 'FAQ | Surya Karya')

@section('content')

<!-- BEGIN: PageHero -->

<section class="relative border-b border-slate-800/80 py-28 md:py-36 lg:py-44 px-6 sm:px-10 lg:px-16 overflow-hidden bg-brand-dark bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(7, 19, 36, 0.92), rgba(11, 25, 44, 0.85)), url(&quot;https://lh3.googleusercontent.com/aida-public/AB6AXuCeVbtNJiJuL00yT332BB87i6eGfIlEL-L_LdxKGSFd1Z1mfnTd3bZdOiyT88tu5L-T1dLtUlK2F8Sp8iWG-L1ZMCxzwC9bROyNihL-_pLkwPPeksOBvW6K8rNbXGLX0l7AhO4I8QZSAKgpizo8EcD7Ubl45jNNMN5IIhWdxqVVhl3xArBWUMccQsLabranZYvDMaEzvuaWRrqYM94q10omSYxM23s6vYlVswuYr8DQDHaRF0IHTIcK&quot;);">
 <div class="animate-left">
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"><div class="max-w-3xl"><h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-white font-normal tracking-tight leading-[1.15]">Pertanyaan yang Sering Diajukan</h1><p class="mt-5 text-base sm:text-lg text-slate-300 font-light leading-relaxed max-w-2xl">Temukan jawaban komprehensif seputar layanan, transparansi rancang bangun, estimasi RAB, dan alur kerja sama bersama Surya Karya.</p></div></div></div></section>

<!-- END: PageHero -->
<!-- BEGIN: MainContent -->
<main class="py-14 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
<!-- BEGIN: LeftSidebar -->
<aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">
<!-- Category Navigation Card -->
<div class="bg-white border border-slate-200 rounded-sm p-6 shadow-sm">
<h2 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6">
            KATEGORI INFORMASI
          </h2>
<ul class="space-y-1 text-sm font-medium">
<li class="">
<a class="flex items-center justify-between p-3 rounded-sm bg-slate-50 text-brand-navy font-semibold hover:bg-slate-100 transition" href="#kategori-layanan">
<span class="flex items-center gap-2.5">
<span class="w-1.5 h-1.5 rounded-full bg-brand-navy category-indicator"></span>
                  Layanan
                </span>

</a>
</li>
<li class="">
<a class="flex items-center justify-between p-3 rounded-sm text-slate-600 hover:text-brand-navy hover:bg-slate-50 transition" href="#kategori-proses">
<span class="flex items-center gap-2.5">
<span class="w-1.5 h-1.5 rounded-full bg-slate-300 category-indicator"></span>
                  Proses &amp; Konsultasi
                </span>

</a>
</li>
<li class="">
<a class="flex items-center justify-between p-3 rounded-sm text-slate-600 hover:text-brand-navy hover:bg-slate-50 transition" href="#kategori-estimasi">
<span class="flex items-center gap-2.5">
<span class="w-1.5 h-1.5 rounded-full bg-slate-300 category-indicator"></span>
                  Estimasi &amp; Dokumen
                </span>

</a>
</li>
<li class="">
<a class="flex items-center justify-between p-3 rounded-sm text-slate-600 hover:text-brand-navy hover:bg-slate-50 transition" href="#kategori-garansi">
<span class="flex items-center gap-2.5">
<span class="w-1.5 h-1.5 rounded-full bg-slate-300 category-indicator"></span>
                  Garansi &amp; Legalitas
                </span>

</a>
</li>
</ul>
</div>
<!-- Consultation Promo Card -->
<div class="text-white rounded-sm p-7 shadow-md relative overflow-hidden" style="background-color: #0B192C;">
  <!-- Subtle corner accent -->
  <div class="absolute -right-8 -top-8 w-28 h-28 bg-white/5 rounded-full pointer-events-none"></div>

  <h3 class="font-serif text-2xl leading-snug font-semibold text-white mb-2">
    Konsultasi Gratis 
  </h3>

  <p class="text-xs sm:text-sm text-slate-300 font-light leading-relaxed mb-6">
    Butuh kalkulasi awal atau telaah denah? Diskusikan langsung dengan tim perencana kami.
  </p>

  <!-- WhatsApp Button -->
  <a class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#c7ab7c] hover:bg-[#bfa06d] text-slate-900 text-xs font-bold uppercase tracking-wider rounded-sm shadow transition"
     href="https://wa.me/6281239401899"
     rel="noopener noreferrer"
     target="_blank">

    <i class="fa-brands fa-whatsapp text-base"></i>

    CHAT VIA WHATSAPP
  </a>

  <!-- Direct Line & Hours -->
  <div class="mt-6 pt-5 border-t border-white/15 space-y-2 text-xs text-slate-300">

    <div class="flex items-center gap-2.5">
      <i class="fa-solid fa-phone w-4 text-center text-amber-200/90"></i>
      <span class="font-semibold text-white">0812 3940 1899</span>
    </div>

    <div class="flex items-center gap-2.5 text-slate-300">
      <i class="fa-regular fa-clock w-4 text-center text-amber-200/90"></i>
      <span>Senin – Sabtu: 08.00 – 17.00 WIB</span>
    </div>

  </div>
</div>
</aside>
<!-- END: LeftSidebar -->
<!-- BEGIN: RightAccordionContent -->
<section class="lg:col-span-8 space-y-12">
<!-- Category 1: Layanan -->
<div class="scroll-mt-28 space-y-4" id="kategori-layanan">
<h2 class="font-serif text-3xl font-medium text-brand-navy pb-3 border-b border-slate-200">
            Layanan
          </h2>
<div class="divide-y divide-slate-200">
<!-- Layanan Item 1 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Apa saja layanan konstruksi yang ditawarkan Surya Karya?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Surya Karya melayani pembangunan rumah baru dari tahap pondasi hingga finishing, perombakan total maupun parsial (renovasi), perencanaan desain arsitektur &amp; struktur lengkap dengan perhitungan RAB terperinci, interior fit-out, serta pengawasan mutu teknis konstruksi di lapangan.
              </div>
</details>
<!-- Layanan Item 2 (Expanded by default) -->
<details class="group py-4" open="">
<summary class="flex justify-between items-center cursor-pointer text-slate-900 font-bold text-base hover:text-brand-navy select-none">
<span class="">Apa perbedaan mendasar antara layanan Pembangunan dan Renovasi?</span>
<svg class="chevron-icon w-5 h-5 text-slate-600 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-6 bg-slate-50/75 p-4 rounded-sm border-l-2 border-brand-navy">
                Layanan <strong class="font-semibold text-slate-900">Pembangunan Baru</strong> dilakukan dari lahan kosong (greenfield) dengan perhitungan struktural menyeluruh dari tiang pancang/pondasi hingga atap tanpa batasan elemen eksisting. Sementara itu, <strong class="font-semibold text-slate-900">Renovasi</strong> berfokus pada pemugaran, penambahan ruang, atau perkuatan struktur bangunan lama yang memerlukan audit beban eksisting, analisa kelayakan struktur, dan integrasi utilitas yang presisi agar selaras tanpa merusak bangunan utama.
              </div>
</details>
</div>
</div>
<!-- Category 2: Proses & Konsultasi -->
<div class="scroll-mt-28 space-y-4 pt-4" id="kategori-proses">
<h2 class="font-serif text-3xl font-medium text-brand-navy pb-3 border-b border-slate-200">
            Proses &amp; Konsultasi
          </h2>
<div class="divide-y divide-slate-200">
<!-- Proses Item 1 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Bagaimana alur proses konsultasi awal?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Konsultasi awal dapat dilakukan secara daring melalui chat WhatsApp atau tatap muka di studio kami. Tim perencana akan mengumpulkan parameter kebutuhan ruangan, preferensi gaya arsitektur, estimasi luas lahan, serta kisaran anggaran yang Anda siapkan.
              </div>
</details>
<!-- Proses Item 2 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Apakah tersedia layanan survei lokasi langsung?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Ya, kami menyediakan layanan survei lokasi langsung oleh tim teknis untuk mengukur luasan faktual, mengecek kondisi kontur tanah, mengevaluasi utilitas sekitar (listrik, saluran drainase, akses material), serta mengkaji aspek legal lingkungan tapak proyek.
              </div>
</details>
<!-- Proses Item 3 (Expanded by default) -->
<details class="group py-4" open="">
<summary class="flex justify-between items-center cursor-pointer text-slate-900 font-bold text-base hover:text-brand-navy select-none">
<span class="">Bagaimana tata cara pengajuan jasa pembangunan atau renovasi?</span>
<svg class="chevron-icon w-5 h-5 text-slate-600 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed bg-slate-50/75 p-4 rounded-sm border-l-2 border-brand-navy">
<p class="mb-2 font-medium text-slate-800">Proses pengajuan terbagi dalam 4 tahap sederhana:</p>
<ol class="list-decimal list-inside space-y-1.5 pl-1">
<li class=""><strong class="font-semibold text-slate-800">Pengisian formulir kebutuhan</strong> melalui web atau chat perwakilan kami.</li>
<li class=""><strong class="font-semibold text-slate-800">Konfirmasi detail &amp; konsultasi konsep</strong> bersama representatif teknis.</li>
<li class=""><strong class="font-semibold text-slate-800">Penjadwalan survei lapangan</strong> untuk verifikasi dimensi fisik dan tanah.</li>
<li class=""><strong class="font-semibold text-slate-800">Penerbitan proposal penawaran RAB &amp; draf kontrak SPK resmi</strong> sebelum konstruksi dimulai.</li>
</ol>
</div>
</details>
<!-- Proses Item 4 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Bagaimana sistem pemantauan dan komunikasi selama proyek berlangsung?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Kami menyediakan Site Supervisor berlisensi di setiap lokasi proyek, dilengkapi sistem laporan berkala (mingguan dan bulanan) berisi kurva S progres pekerjaan, dokumentasi foto/video detail, serta grup koordinasi khusus agar pemilik rumah selalu terinformasi dengan transparan.
              </div>
</details>
</div>
</div>
<!-- Category 3: Estimasi & Dokumen -->
<div class="scroll-mt-28 space-y-4 pt-4" id="kategori-estimasi">
<h2 class="font-serif text-3xl font-medium text-brand-navy pb-3 border-b border-slate-200">
            Estimasi &amp; Dokumen
          </h2>
<div class="divide-y divide-slate-200">
<!-- Estimasi Item 1 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Bagaimana estimasi biaya dan anggaran (RAB) disusun?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Penyusunan RAB dilakukan berbasis bill of quantity (BOQ) presisi mengacu pada gambar kerja teknis. Setiap item pekerjaan dirinci harga satuan upah dan materialnya, tanpa mark-up terselubung, sehingga klien mendapatkan rincian anggaran yang wajar dan dapat dipertanggungjawabkan.
              </div>
</details>
<!-- Estimasi Item 2 (Expanded by default) -->
<details class="group py-4" open="">
<summary class="flex justify-between items-center cursor-pointer text-slate-900 font-bold text-base hover:text-brand-navy select-none">
<span class="">Apa itu RAB dan mengapa dokumen ini sangat penting?</span>
<svg class="chevron-icon w-5 h-5 text-slate-600 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed bg-slate-50/75 p-4 rounded-sm border-l-2 border-brand-navy">
<p class="">
<strong class="font-semibold text-slate-900">Rencana Anggaran Biaya (RAB)</strong> adalah cetak biru finansial proyek konstruksi. Dokumen ini krusial karena merinci volume pasti kebutuhan bahan bangunan, mutu spesifikasi yang disepakati, tahapan termin pembayaran berbasis progres fisik, serta menjadi landasan hukum perikatan kerja sama kedua belah pihak.
                </p>
</div>
</details>
<!-- Estimasi Item 3 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Apa saja dokumen atau berkas denah yang perlu disiapkan klien?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Klien cukup menyiapkan fotokopi/scan sertifikat tanah atau bukti kepemilikan lahan, IMB/PBG bila sudah ada, serta gambar arsitektur eksisting jika proyek berupa renovasi. Jika belum memiliki gambar arsitektur, tim Surya Karya akan merancangnya dari awal.
              </div>
</details>
<!-- Estimasi Item 4 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Berapa lama estimasi durasi pengerjaan pembangunan atau renovasi?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Durasi bergantung pada luas lantai dan tingkat kerumitan arsitektur. Secara umum, renovasi skala menengah berkisar 1 - 3 bulan, sedangkan pembangunan rumah tinggal 1-2 lantai umumnya memerlukan waktu 4 - 8 bulan kalender sesuai kesepakatan jadwal pada kurva S.
              </div>
</details>
</div>
</div>
<!-- Category 4: Garansi & Legalitas -->
<div class="scroll-mt-28 space-y-4 pt-4" id="kategori-garansi">
<h2 class="font-serif text-3xl font-medium text-brand-navy pb-3 border-b border-slate-200">
            Garansi &amp; Legalitas
          </h2>
<div class="divide-y divide-slate-200">
<!-- Garansi Item 1 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Apakah ada jaminan garansi setelah pekerjaan selesai?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Tentu saja. Kami memberikan sertifikat garansi pemeliharaan resmi hingga 6 bulan pasca-serah terima pertama (PHO) untuk cacat mutu pengerjaan non-struktural, serta jaminan struktur utama jangka panjang yang tercantum resmi dalam Kontrak Kerja Konstruksi (SPK).
              </div>
</details>
<!-- Garansi Item 2 (Collapsed) -->
<details class="group py-4">
<summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">
<span class="">Bagaimana cara cepat menghubungi tim manajemen Surya Karya?</span>
<svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
</svg>
</summary>
<div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                Anda dapat langsung menghubungi hotline WhatsApp di <strong>0812 3940 1899</strong> atau mengirimkan surel ke <strong>kontak@suryakarya.co.id</strong>. Tim representatif kami akan menanggapi permohonan Anda dalam waktu maksimal 1x24 jam pada hari kerja operasional.
              </div>
</details>
</div>
</div>
</section>
<!-- END: RightAccordionContent -->
</div>
</main>
<!-- END: MainContent -->
@endsection

@push('scripts')
<script src="/js/faq.js"></script>
@endpush