@extends('layouts.app')

@section('title', 'Renovasi Bangunan | Surya Karya')

@push('styles')
<style>
    .font-serif-heading {
        font-family: 'Cormorant Garamond', Georgia, serif;
        letter-spacing: 0.02em;
    }

    /* Architectural Blueprint Grid and Overlay Pattern */
    .blueprint-bg {
        background-color: #0b1e36;
        background-image: 
            radial-gradient(circle at center, rgba(16, 42, 77, 0.45) 0%, rgba(7, 18, 36, 0.92) 100%),
            linear-gradient(to right, rgba(255, 255, 255, 0.04) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.04) 1px, transparent 1px),
            linear-gradient(to right, rgba(255, 255, 255, 0.015) 10px, transparent 10px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.015) 10px, transparent 10px);
        background-size: 100% 100%, 80px 80px, 80px 80px, 16px 16px, 16px 16px;
        position: relative;
    }

    .blueprint-bg::before {
        content: "";
        position: absolute;
        inset: 0;
        background: 
            repeating-linear-gradient(45deg, transparent, transparent 40px, rgba(255, 255, 255, 0.015) 40px, rgba(255, 255, 255, 0.015) 41px),
            radial-gradient(ellipse at 50% 20%, rgba(30, 64, 115, 0.5) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Hardware-Accelerated 3D Floating Side Entrance Animation */
    .animate-left {
        opacity: 0;
        transform: perspective(1000px) rotateY(-8deg) translate3d(-70px, 15px, -20px) scale(0.96);
        transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), 
                    transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }

    .animate-right {
        opacity: 0;
        transform: perspective(1000px) rotateY(8deg) translate3d(70px, 15px, -20px) scale(0.96);
        transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), 
                    transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }

    .animate-left.is-visible,
    .animate-right.is-visible {
        opacity: 1;
        transform: perspective(1000px) rotateY(0deg) translate3d(0, 0, 0) scale(1);
    }

    /* Spec Card Premium Micro-Interactions & Bento Curved Corner */
    .spec-card {
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), 
                    box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                    border-color 0.5s ease,
                    filter 0.5s ease;
        position: relative;
        overflow: hidden;
    }

    .spec-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #d4af37, #f5efe6, #d4af37);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .spec-card:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 25px 45px -12px rgba(11, 25, 44, 0.1), 0 0 30px rgba(212, 175, 55, 0.18);
        border-color: rgba(212, 175, 55, 0.4);
    }

    .spec-card:hover::after {
        transform: scaleX(1);
    }

    /* Bento Curved Top-Right Corner Motif */
    .card-corner-shape {
        position: absolute;
        top: 0;
        right: 0;
        width: 8rem;
        height: 8rem;
        background-color: rgba(11, 25, 44, 0.035);
        border-bottom-left-radius: 9999px;
        pointer-events: none;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.5s ease;
    }

    .spec-card:hover .card-corner-shape {
        transform: scale(1.18);
        background-color: rgba(212, 175, 55, 0.08);
    }

    /* Plus icon badge animation */
    .plus-badge {
        display: inline-block;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.3s ease;
    }

    .spec-card:hover .plus-badge {
        transform: scale(1.35) rotate(90deg);
        color: #c49a26;
    }
</style>
@endpush

@section('content')

<!-- BEGIN: HeroSection -->
@php
    $hero = \App\Models\HeroTitle::getForPage('renovasi');
    $heroTitleText = ($hero && !empty($hero->title)) ? $hero->title : 'RENOVASI';
    $heroDeskripsiText = ($hero && !empty($hero->deskripsi)) ? $hero->deskripsi : 'Revitalisasi estetika dan peremajaan struktur hunian Anda dengan ketepatan teknis, efisiensi waktu, dan hasil bergaransi.';
    $heroImage = ($hero && !empty($hero->image_url)) ? $hero->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuBEJ38MBqOwfXulF1m9ktJQLpRGNVXbbD7QJeRHwIkBk30DGYnjyvdBnPJade1qlJ4csz1Paq_6Mym_cek3aOTzNJxd_K6zb77LZuuuwNfHPJE12ElWxTFHZstiufztqG_UZrhv7g8PlEo-rrVt5vSymA8fyj9h8crzHbuKhvDX5c4xgDXi21cBMAaA6bqYmF6kdXnwnEkDZWTZny_Se8BL1LcmpfuOqcxtmKVvswfpe7MvF5WFWjQe_vYlBVADSJs0ZADurpzAlGb2PA';
@endphp
<section class="relative text-white py-28 md:py-36 lg:py-44 px-6 sm:px-10 lg:px-16 border-b border-slate-700/30 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
        style="background-image: url('{{ $heroImage }}'); background-position: center 40%;">
    </div>

    <!-- Semi-Transparent Navy Color Overlay -->
    <div class="absolute inset-0 bg-[#0b192c]/80 mix-blend-multiply"></div>

    <!-- Gradient Dark Overlay for Readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#06101e]/95 via-[#0b192c]/80 to-[#0b192c]/40"></div>

    <div class="max-w-6xl mx-auto text-left relative z-10">
        <!-- Architectural Heading (Rata Kiri) -->
        <h1 class="font-serif-heading text-4xl sm:text-5xl md:text-[56px] font-semibold tracking-wider uppercase leading-tight mb-6 text-left animate-left">
            {{ $heroTitleText }}
        </h1>
        <!-- Description Subtitle (Rata Kiri) -->
        <p class="text-slate-200 text-sm sm:text-base font-normal max-w-2xl leading-relaxed tracking-normal text-left animate-left">
            {{ $heroDeskripsiText }}
        </p>
    </div>
</section>
<!-- END: HeroSection -->

<!-- BEGIN: RenovationCategorySection -->
<main class="max-w-6xl mx-auto px-6 py-16 md:py-24 w-full overflow-x-hidden">

    <!-- Section Intro Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 lg:mb-16 gap-6 animate-left">
        <div>
            <span class="inline-block text-xs font-semibold tracking-[0.25em] text-[#d4af37] uppercase mb-3">
                CAKUPAN REKAYASA &amp; PERBAIKAN
            </span>
            <h2 class="font-serif-heading text-3xl sm:text-4xl md:text-5xl font-semibold text-[#0b192c] uppercase tracking-tight">
                Kategori Spesifikasi Renovasi
            </h2>
        </div>
        <p class="text-slate-600 text-sm sm:text-base max-w-md leading-relaxed font-normal">
            Empat pilar layanan komprehensif untuk menjawab setiap skala perubahan ruang mulai dari rekonstruksi menyeluruh hingga penyempurnaan area fungsional.
        </p>
    </div>

    <!-- 2x2 Bento-Style Service Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
        @forelse($cards as $index => $card)
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] {{ $index % 2 == 0 ? 'animate-left' : 'animate-right' }}">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h3 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-3">
                    {{ $card->title }}
                </h3>
                @if($card->content)
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    {{ $card->content }}
                </p>
                @endif
                <!-- Checklist items -->
                @if(count($card->checklist_items) > 0)
                <ul class="space-y-3.5 text-sm text-slate-700">
                    @foreach($card->checklist_items as $item)
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        @empty
        <!-- CARD 1: Renovasi Total (Overhaul) -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-left">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h3 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-3">
                    Renovasi Total (Overhaul)
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Peremajaan menyeluruh bangunan lama menjadi hunian bernilai estetika modern dengan perkuatan struktur utama.
                </p>
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Audit Kelayakan Struktur Eksisting &amp; Kekuatan Fondasi</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Perombakan Tata Ruang &amp; Layout Interior Lebih Fungsional</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Pembaruan Fasad Luar Menjadi Modern Minimalis</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Penyesuaian Ulang Jalur Sanitasi &amp; Kelistrikan Total</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- CARD 2: Penambahan Lantai / Ruang -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-right">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h3 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-3">
                    Penambahan Lantai / Ruang
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Perluasan kapasitas hunian baik secara vertikal (lantai 2/3) maupun penambahan ruangan secara horizontal.
                </p>
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Suntik Pondasi &amp; Footplat Tambahan Tanpa Merusak Struktur Lama</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Dak Beton Bondek / Cor Presisi Anti-Bocor</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Pembangunan Kamar Tidur, Ruang Kerja, atau Rooftop</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Perhitungan Beban Struktur Bersertifikasi Teknik Sipil</span>
                    </li>
                </ul>
            </div>
        </div>
        @endforelse
    </div>

    @if($photos->isNotEmpty())
    <!-- BEGIN: Photo Showcase Grid -->
    <div class="mt-16 lg:mt-24 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        @foreach($photos as $index => $photo)
        <div class="relative overflow-hidden rounded-xl group shadow-sm animate-up" style="transition-delay: {{ $index * 150 }}ms;">
            @if(!empty($photo->image))
            <img class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700" alt="{{ $photo->title }}" src="{{ (str_starts_with($photo->image, 'http://') || str_starts_with($photo->image, 'https://')) ? $photo->image : asset($photo->image) }}">
            @else
            <div class="w-full h-80 bg-slate-800"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b192c]/90 via-[#0b192c]/20 to-transparent flex items-end p-6">
                <div>
                    @if(!empty($photo->tag))
                    <span class="text-xs font-semibold tracking-widest uppercase text-[#d4af37] mb-1 block">
                        {{ $photo->tag }}
                    </span>
                    @endif
                    <p class="font-serif-heading text-2xl font-semibold text-white">
                        {{ $photo->title }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- END: Photo Showcase Grid -->
    @endif

    <!-- BEGIN: 4-Step Process Section -->
    <div class="mt-20 lg:mt-28 border-t border-gray-100 pt-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Step 1 -->
            <div class="animate-up">
                <span class="font-serif-heading text-4xl font-bold text-[#0b192c] block mb-2">01</span>
                <h4 class="text-xs font-semibold tracking-wider uppercase text-[#d4af37] mb-2">
                    SURVEY &amp; AUDIT FISIK
                </h4>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Inspeksi komprehensif struktur eksisting dan pengukuran akurat di lokasi.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="animate-up" style="transition-delay: 150ms;">
                <span class="font-serif-heading text-4xl font-bold text-[#0b192c] block mb-2">02</span>
                <h4 class="text-xs font-semibold tracking-wider uppercase text-[#d4af37] mb-2">
                    DESAIN &amp; RAB TERBUKA
                </h4>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Visualisasi layout baru disertai rincian estimasi biaya material tanpa biaya tersembunyi.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="animate-up" style="transition-delay: 300ms;">
                <span class="font-serif-heading text-4xl font-bold text-[#0b192c] block mb-2">03</span>
                <h4 class="text-xs font-semibold tracking-wider uppercase text-[#d4af37] mb-2">
                    EKSEKUSI SIPIL DISIPLIN
                </h4>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Proses konstruksi dengan pengawasan ketat dan laporan progres mingguan berkala.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="animate-up" style="transition-delay: 450ms;">
                <span class="font-serif-heading text-4xl font-bold text-[#0b192c] block mb-2">04</span>
                <h4 class="text-xs font-semibold tracking-wider uppercase text-[#d4af37] mb-2">
                    SERAH TERIMA &amp; GARANSI
                </h4>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Pemeriksaan bersama, penandatanganan BAST, dan penyerahan sertifikat retensi resmi.
                </p>
            </div>

        </div>
    </div>
    <!-- END: 4-Step Process Section -->

</main>
<!-- END: RenovationCategorySection -->

<!-- BEGIN: CallToAction -->
<section class="bg-[#0b192c] text-white py-20 px-6 w-full animate-up" id="konsultasi">
    <div class="max-w-3xl mx-auto text-center">
        <!-- CTA Title -->
        <h2 class="font-serif-heading text-3xl sm:text-4xl md:text-[42px] font-semibold tracking-wide text-white mb-4 leading-tight uppercase">
            Mulai Rencana Renovasi Anda
        </h2>
        <!-- CTA Subtitle -->
        <p class="text-slate-300 text-sm sm:text-base mb-8 max-w-xl mx-auto leading-relaxed font-normal">
            Konsultasikan kebutuhan peremajaan, perubahan tata ruang, atau penambahan lantai rumah Anda dengan tim spesialis kami.
        </p>
        <!-- CTA Button -->
        <a class="inline-flex items-center justify-center gap-2 bg-[#d4af37] hover:bg-[#c19b2e] text-[#0b192c] font-semibold text-xs sm:text-sm px-8 py-3.5 rounded shadow-lg hover:shadow-[#d4af37]/20 transition-all duration-300 tracking-wide hover:-translate-y-0.5 active:translate-y-0" href="{{ route('frontend.form-pesanan') }}">
            <span>FORM PEMESANAN RENOVASI</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </svg>
        </a>
    </div>
</section>
<!-- END: CallToAction -->

@endsection
