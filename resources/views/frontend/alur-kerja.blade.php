@extends('layouts.app')

@section('title', 'Alur Kerja Sama Konstruksi | Surya Karya')
@push('styles')
<link href="{{ asset('css/alur-kerja.css') }}" rel="stylesheet">
@endpush

@section('content')

<!-- BEGIN: HeroSection -->
<section class="relative pt-24 pb-24 md:pt-32 md:pb-32 overflow-hidden bg-brand-navy text-white">
<!-- Architectural Construction Background Image with Deep Blue Overlay -->
<div class="absolute inset-0 z-0">
<img alt="Architectural Plan and Construction" class="w-full h-full object-cover object-center filter brightness-[0.6] contrast-[1.1]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGm0ulHQ0lBqq0fHtOHN2MPUpqdGLeEr7qeHdJ0pOCBfuQ00DhnO_DGKIkUgMDilRhQu_u485FeizWRyUsxlxgQiyJbiNeASq1zqm9kenrPu2MgnlLHnuz0VNrPRcptNvboS8RdM-_5u7Pgj8uzSV8lCNYs3E0B8VIm2Kdt2earzo2ONq0UFen9sGfqRzRb77qqSFktTAe3b5dc7fSgoD2LBOXZJlBHbGUSJgKdN4mbJDld0Nqqk8o"/>
<div class="absolute inset-0 bg-gradient-to-r from-[#0b192c]/95 via-[#0b192c]/90 to-[#1e3a8a]/75 mix-blend-multiply"></div>
<div class="absolute inset-0 bg-[#0b192c]/40"></div>
</div>
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-left">
<div class="max-w-3xl">
<!-- Eyebrow with tasteful line accent -->
 <div class="animate-left">
<div class="flex items-center gap-3 mb-5">
<span class="inline-block w-8 h-[1px] bg-brand-borderGold"></span>
<span class="text-xs tracking-widest uppercase font-semibold text-brand-sand">Surya Karya Standar Kerja</span>
</div>
<h1 class="font-serif-cormorant text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-semibold tracking-tight text-white leading-[1.1] uppercase">
        Alur Kerja Sama<br/>Kontraktor
      </h1>
<p class="mt-6 sm:mt-8 text-base sm:text-lg text-[#e7d8c9]/90 font-normal leading-relaxed max-w-2xl">
        Proses kerja sama yang jelas, transparan, dan terstruktur dari awal pengajuan hingga hunian siap dihuni. Kami menjaga presisi teknis dan ketepatan timeline di setiap fase.
      </p>
</div>
</div>
</div>
</section>
<!-- END: HeroSection -->
<!-- BEGIN: TimelineSection -->
<section class="relative py-24 sm:py-32 bg-[#faf8f5]/50" id="alur-proses">
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
<!-- Central Architectural Vertical Spine (Desktop center, mobile left) -->
<div class="timeline-spine left-6 md:left-1/2 md:-ml-[1px]"></div>
<div class="space-y-20 sm:space-y-32 relative">
<!-- STEP 01 (Text Left, Image Right) -->
 <div class="animate-up">
<div class="relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 text-left md:text-right order-2 md:order-1">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 01
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Pengajuan Kebutuhan Jasa
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md ml-0 md:ml-auto">
            Mengisi formulir singkat terkait kebutuhan pembangunan atau renovasi, estimasi luasan area, dan preferensi desain yang diinginkan untuk penelaahan awal tim arsitektur kami.
          </p>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 order-1 md:order-2">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Pengajuan Kebutuhan Jasa - Konsultasi &amp; Formulir" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4eewAF3w5ERtiy4ppw5ArS7txJ6dqAX3MYQCVG7l1TElLk3dT6FJP33zNyjy7BaaqOiPFrJGONVUb2sAjmJuluWVqi-9O1NCoe0cVQ8Ee4vBE_5hRIziNYfTUgieWjTkArWM19j5ColtaRrSHF6sQ_BNQreRcpMlF6aMOiyoy6dCfSU_ikEpzwmKrbY35iUEyPL62EeCMX7VvMWl8FdrExbHPbC2LFAp9eUNxqYLiV3FCNGDQy7Os"/>
</div>
</div>
</div>
</div>
<!-- STEP 02 (Image Left, Text Right) -->
 <div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 order-1">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Konfirmasi Melalui WhatsApp - Diskusi Arsitektur" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCeMOXXKIX9xRSVnK7IASuEsDGmXYG1N0TPlvhT4Ggy-bmLBDxarTxbREMUYZ5JgFh96Yxn9tMaNLKVA9CCM8ip1l_qpEgBHWDsXRC5FWCkeAZtmTVxsE5a_XBZTFJmWNPiJofsnyBNUhbYlj4r5mfF4LT8HgZRCVc_K3QSXUzA4-Ohiqg6MkrKT5RbffCJAebreeHjZpXyy09u_VGNmsSIEQaIMF_ajKqepsuCPsvgliHNKX5nOr3a"/>
</div>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 text-left order-2">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 02
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Konfirmasi Melalui WhatsApp
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md mr-auto">
            Tim arsitek kami menghubungi Anda via WhatsApp resmi dalam 1×24 jam untuk mendiskusikan kebutuhan awal, menjawab pertanyaan fundamental, dan menentukan jadwal survei.
          </p>
</div>
</div>
</div>
<!-- STEP 03 (Text Left, Image Right) -->
 <div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 text-left md:text-right order-2 md:order-1">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 03
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Survei Lokasi / Pembahasan
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md ml-0 md:ml-auto">
            Kunjungan lapangan langsung untuk pengukuran akurat, analisa kontur tanah &amp; kondisi eksisting, serta diskusi mendalam demi akurasi rancang bangun bebas risiko.
          </p>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 order-1 md:order-2">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Survei Lokasi / Pembahasan - Pengukuran Lapangan Arsitektur" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrqpxt3pirTUZP5V3QJBAm-vwjWvI8cGdelfUF2U_VrEQfL6P5-Q7mbSQa2HlguEY92i3E3gEx4cI9jjQAEJ4stfchoCmA5PU5LO-7p1v8nGUUCcDixGQmcMrzg8WBaofLg-nlSIpfuyLHVboTPt4babKabqbidXWc5Uu4kWfGRsNvX6rDSSh4TUtpU1Rdx4qDr-8QiqlcmiMLm_-MA131_xihTBj56BT6mQjsexCcq8aGqKiq7uL_"/>
</div>
</div>
</div>
</div>
<!-- STEP 04 (Image Left, Text Right) -->
 <div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 order-1">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Penawaran / RAB - Blueprint &amp; Estimasi Biaya" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2DnltOo2sAwgmszoohAFtCnBsO17U04_RfhnFdfJNPyxrETKmsTy1dhaJgULFroj1e9gBGfkjIxnSpY87xdS65atmalCwocQk7UDHIfy4uq9jTbWrk0zxpoY6TJFiFyXUuPvr9d94141_0T9iOhTwqMe2Rghumg623Kp5zqzZLot-MGfNzXkfAdf9kLwxR0TEqTNCoFmT_CVJgsg2TLTNHhuxEYY624farbKf8yI1jxX4Y4JYo8e3"/>
</div>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 text-left order-2">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 04
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Penawaran / RAB
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md mr-auto">
            Penyusunan Rencana Anggaran Biaya (RAB) transparan, terperinci per item pekerjaan, spesifikasi material, dan timeline. Tidak ada biaya siluman tersembunyi.
          </p>
</div>
</div>
</div>
<!-- STEP 05 (Text Left, Image Right) -->
 <div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 text-left md:text-right order-2 md:order-1">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 05
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Persetujuan &amp; Kesepakatan
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md ml-0 md:ml-auto">
            Penandatanganan Surat Perjanjian Kerja (SPK) mengikat secara legal profesional demi kenyamanan, kepastian hukum, dan garansi pelaksanaan bagi kedua belah pihak.
          </p>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 order-1 md:order-2">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Persetujuan &amp; Kesepakatan - SPK Kontrak Kerja" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAZnjAROxAyW5YkX_sbcRiHTArBph-5k1nsCytuTdI-sNdyXkI0YKjWo6PvZ0O05A88PTF6i6-GS5iS9BJcw3TuN_Q7EixpKpDDunAoTKNDAsh9e0vbQ9PC1yJvCc2CCjUFmKHtFPBGh5Dc4SmIeBtrGnyVCSuQyP7Na91DJ1l0fuF12qefmWT8EanbCOkWCFjh8u_UOVCZnx-yH4pi0tTgE79b3ZuggHxI6rFErDrdCuyPYzMAgKsU"/>
</div>
</div>
</div>
<!-- STEP 06 (Image Left, Text Right) -->
<div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 order-1">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Pengerjaan Proyek - Konstruksi Bangunan" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxOKrctIcVMq2LksNpqlagWOuTw-irg4ud8jOPLwljaKlQhA5PzBbvYYtOIKKCex7YvUg9JxZ_Fsm9eNR3UwDdfo8fuwXwy2rqPobIvtG44aOoKQoy35P_0i5L_IyG3LN47Dy82v1UoEabfmxGEhvMFGLcBOmFEKp0-tnuUtVI-nBfWQVRmjY2RPM0zqaee8EFXzARvYhEl_3le629ieFxPbKdFHU4l2rpIHp2xpbFj2FU1hjammQ1"/>
</div>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 text-left order-2">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 06
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Pengerjaan Proyek
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md mr-auto">
            Pelaksanaan konstruksi di lapangan oleh tim tukang berpengalaman di bawah pengawasan harian arsitek dan mandor ahli dengan standar presisi tinggi.
          </p>
</div>
</div>
</div>
<!-- STEP 07 (Text Left, Image Right) -->
 <div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 text-left md:text-right order-2 md:order-1">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 07
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Monitoring Komunikasi &amp; Progress
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md ml-0 md:ml-auto">
            Laporan progres berkala mingguan berupa foto detail, dan video lapangan yang dikirimkan langsung sehingga Anda selalu terinfo transparan tanpa repot.
          </p>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 order-1 md:order-2">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Monitoring Komunikasi &amp; Progress - Inspeksi Lapangan" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC6R51kllE1sqOQb8EE1u8ArkXqP0QzPoHzka_vwtnLzWB61gJ68nRJWWrAK8eUF_dr1xbtJ0ZoimVRZZ1xHj7uZagotoTItE5MUkYgJGokpsWVQJ55OByPkYTmxWksralrlYE8fxgYw7L1Ob7pXFZirt8cRbggbkOuEEluBkUWaZq7YyKoZpmI6ksInYgLD6Vbt9NLejjpPMgYa6r6NPbDqQ3OYZbiFHum6785hVbcthjwwByxIxUf"/>
</div>
</div>
</div>
<!-- STEP 08 (Image Left, Text Right) -->
 <div class="animate-up">
<div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">
<!-- Desktop Left: Contextual Image -->
<div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 order-1">
<div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
<img alt="Serah Terima Proyek - Hunian Jadi Siap Huni" class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9yuh57mn0zDTBHVUqfoN8yOxAE86IWSxAyyjxh-5PVu-R3Aoga-C9TQMqjU3PVLDs1I7cRQkGYpGC8Pw49OYeAvr3y3BOpYvJxCPfKWG-4Gw59a7qL6I-JOf35iezW0QbvI308IArW3Ua7JhURPwMGwoV94xQ-SR0Yl6Y871-_GJL9addOmbPm9m-uxOal-MDlYwtftnmPgIU66uid9cArnruTE3zRcu82cO_Il0za_09mDHm3NsR"/>
</div>
</div>
<!-- Central Icon Node -->
<div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
<div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
<svg class="w-5 h-5 md:w-6 md:h-6 stroke-stone-900" fill="none" stroke-width="1.8" viewbox="0 0 24 24">
<path d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>
</div>
</div>
<!-- Desktop Right: Text Content -->
<div class="w-full md:w-1/2 pl-12 md:pl-14 text-left order-2">
<span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
            Langkah 08
          </span>
<h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
            Serah Terima Proyek
          </h2>
<p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md mr-auto">
            Inspeksi akhir bersama klien, checklist kepuasan, penyerahan kunci, dan aktivasi garansi retensi pasca konstruksi untuk ketenangan sejati Anda.
          </p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- END: TimelineSection -->
<!-- BEGIN: CallToActionSection -->
<section class="relative py-24 sm:py-28 bg-[#0b192c] text-white overflow-hidden" id="konsultasi-cta">
  <div class="animate-up">
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
<p class="text-xs sm:text-sm font-semibold tracking-widest text-[#d6c7b2] uppercase mb-4">
        Langkah Pertama Menuju Hunian Idaman
      </p>
<h2 class="font-serif-cormorant text-3xl sm:text-4xl md:text-5xl font-normal tracking-wide text-white leading-tight">
        Siap Membangun Bersama Surya Karya?
      </h2>
<div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
<a class="w-full sm:w-auto px-8 py-3.5 bg-[#e5d5c5] hover:bg-[#d8c5b3] text-[#0b192c] text-xs font-semibold uppercase tracking-widest rounded shadow transition-all duration-200" href="https://wa.me/6281239401899" rel="noopener noreferrer" target="_blank">
          Mulai Konsultasi
        </a>
</div>
</div>
</div>
</section>
<!-- END: CallToActionSection -->
 @endsection