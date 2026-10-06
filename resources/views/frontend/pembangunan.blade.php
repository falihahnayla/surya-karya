@extends('layouts.app')

@section('title', 'Pembangunan | Surya Karya')

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
    $hero = \App\Models\HeroTitle::getForPage('pembangunan');
    $heroTitleText = ($hero && !empty($hero->title)) ? $hero->title : 'PEMBANGUNAN';
    $heroDeskripsiText = ($hero && !empty($hero->deskripsi)) ? $hero->deskripsi : 'Wujudkan hunian impian dari fondasi hingga atap dengan manajemen konstruksi transparan, presisi teknis, dan material berstandar SNI.';
    $heroImage = ($hero && !empty($hero->image_url)) ? $hero->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDRDob8yilUEeRQmJjXPk81hxd8AKaU_Yd_HDzX5bzhqTpFvbQNKdihbpj8tXcfrna1Hwwf69KE2S0S5hSt1DRvimu_koDBDlpNH_SO-NM3hR9t3gux6TPvNjw-rO1uyp2elUSlZkNsSwzx4BeYxlhwwprtejSV0KbUSQ7adZZYRpvmxnoY8tTHSzfHEK7i-irp6AwcMcjNfekjVW8p7lFhcFMM8fxbdOBkVZRxzmR_W79ICjeFf76-03m2OrzeRRf4gMElYeI1FR1mWQ';
@endphp
<section class="relative text-white py-28 md:py-36 lg:py-44 px-6 sm:px-10 lg:px-16 border-b border-slate-700/30 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
        style="background-image: url('{{ $heroImage }}'); background-position: center 30%;">
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

<!-- BEGIN: ConstructionScopeSection -->
<main class="max-w-6xl mx-auto px-6 py-16 md:py-24 w-full overflow-x-hidden">

    <!-- Section Intro Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 lg:mb-16 gap-6 animate-left">
        <div>
            <h2 class="font-serif-heading text-3xl sm:text-4xl md:text-5xl font-semibold text-[#0b192c] tracking-tight">
                Spesifikasi Ruang Lingkup Konstruksi
            </h2>
        </div>
        <p class="text-slate-600 text-sm sm:text-base max-w-md leading-relaxed font-normal">
            Dirancang dengan sistem pengawasan bertingkat untuk menjamin akurasi elevasi, kekuatan mekanikal tanah, dan estetika arsitektur berkelas.
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
        <!-- CARD 1: Rumah Tinggal Baru -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-left">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h3 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-3">
                    Rumah Tinggal Baru
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Pembangunan rumah baru dari nol mulai dari perencanaan desain, pematangan lahan, hingga serah terima kunci.
                </p>
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Perencanaan Arsitektur &amp; Denah 3D Komprehensif</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Pengurusan IMB / PBG dan Dokumen Legalitas</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Pembangunan Struktur, Finis Interior &amp; Eksterior</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Garansi Pemeliharaan &amp; Retensi Pasca Konstruksi</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- CARD 2: Ruko & Gedung Komersial -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-right">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h3 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-3">
                    Ruko &amp; Gedung Komersial
                </h3>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Konstruksi bangunan komersial yang mengutamakan ketahanan struktur, utilitas tinggi, dan efisiensi ruang usaha.
                </p>
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Struktur Beton Bertulang Mutu Tinggi (K-250 s/d K-350)</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Desain Fasad Modern &amp; Representasi Brand Bisnis</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Instalasi Elektrikal, Plumbing, &amp; Jalur Evakuasi Standar</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Pengerjaan Tepat Waktu Sesuai Target Operasional</span>
                    </li>
                </ul>
            </div>
        </div>
        @endforelse
    </div>

    <!-- BEGIN: 3 Photo Showcase Grid -->
    <div class="mt-16 lg:mt-24 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        @forelse($photos as $index => $photo)
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
        @empty
        <!-- Showcase Photo 1 -->
        <div class="relative overflow-hidden rounded-xl group shadow-sm animate-up">
            <img class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700" alt="Pembesian Sesuai Gambar Kerja" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCH-rNSzviMG69-3LuIn5YoUjktFIW-pkdqZHxrBKho4_zdcu27QQHnStqIVCbIF3zMR3NYnBs6KsdJv2qej2fwKWwPFU4kW1hBe76ehzySHA_mJXOupX6c9nALQ2LGloiRm-ogQvdsiCEAWeOarDBOQdmvZ2MeGSEmJ2RVgn8x3dRc03kvdTsrWCauWCVw9jQGfImDRicpAdNyhuZXFLvh3I2spgQd8eelz_9je2HjnWIerx9kr7zz">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b192c]/90 via-[#0b192c]/20 to-transparent flex items-end p-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest uppercase text-[#d4af37] mb-1 block">
                        KEKUATAN FONDASI
                    </span>
                    <p class="font-serif-heading text-2xl font-semibold text-white">
                        Pembesian Sesuai Gambar Kerja
                    </p>
                </div>
            </div>
        </div>

        <!-- Showcase Photo 2 -->
        <div class="relative overflow-hidden rounded-xl group shadow-sm animate-up" style="transition-delay: 150ms;">
            <img class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700" alt="Fasad Tropis Kontemporer" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA1JC3xhhH1bA-HrOvRfSKostvLNzIFRdANBDxtl2nJ-TGWobYRXWrsJl5JsUszn8cb3K4X8pvizpT9SRaX_DttKecpDMBOaPXdeDB07P71renGiuO4MVMoF0bhUHn2naZj-e5R-XJx8s4wSf2cMsegTYegrIZeIGiZkRsKZs9yTw5QCkGKJ54TMol6lE9ER88iRDSS861KkLpgf9eHIt1VZoHdaYD75Q_s9rcvdtblHoPoIF1R7Nap">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b192c]/90 via-[#0b192c]/20 to-transparent flex items-end p-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest uppercase text-[#d4af37] mb-1 block">
                        FINISHING EKSTERIOR
                    </span>
                    <p class="font-serif-heading text-2xl font-semibold text-white">
                        Fasad Tropis Kontemporer
                    </p>
                </div>
            </div>
        </div>

        <!-- Showcase Photo 3 -->
        <div class="relative overflow-hidden rounded-xl group shadow-sm animate-up" style="transition-delay: 300ms;">
            <img class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700" alt="Pengawasan Tenaga Ahli" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-KKDqp_Zi4TUy3yUjgzz5_ZfxauvjgHkp-ozIjGVZ9MK5oZEIDyqk1bSdOZhAwKT44yF2_3g6XpDSaOVu3K8S7BpbUNwoa4qj2ZrQipAkF9CJU1-FF6BxZ8h6HhqoYQfmG4AxeG3zR2i49EvBydob-Bwf8Lkv2nDn7MvKZMVSO_WP_0QpyiGH7Ia8Y3Yb_2Y6AcFNxINy5QNQFnbCylhIvKJv9BTJ3sZn1NCKVpqpqlaT5VFECnrf">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0b192c]/90 via-[#0b192c]/20 to-transparent flex items-end p-6">
                <div>
                    <span class="text-xs font-semibold tracking-widest uppercase text-[#d4af37] mb-1 block">
                        SUPERVISI KETAT
                    </span>
                    <p class="font-serif-heading text-2xl font-semibold text-white">
                        Pengawasan Tenaga Ahli
                    </p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    <!-- END: 3 Photo Showcase Grid -->

</main>
<!-- END: ConstructionScopeSection -->

<!-- BEGIN: CallToAction -->
<section class="bg-[#0b192c] text-white py-20 px-6 w-full animate-up" id="konsultasi">
    <div class="max-w-3xl mx-auto text-center">
        <!-- CTA Title -->
        <h2 class="font-serif-heading text-3xl sm:text-4xl md:text-[42px] font-semibold tracking-wide text-white mb-4 leading-tight">
            Mulai Rencana Pembangunan Anda
        </h2>
        <!-- CTA Subtitle -->
        <p class="text-slate-300 text-sm sm:text-base mb-8 max-w-xl mx-auto leading-relaxed font-normal">
            Diskusikan visi desain, kebutuhan luasan, dan estimasi anggaran pembangunan hunian Anda bersama tim arsitek kami.
        </p>
        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#d4af37] hover:bg-[#c19b2e] text-[#0b192c] font-semibold text-xs sm:text-sm px-7 py-3.5 rounded shadow-lg hover:shadow-[#d4af37]/20 transition-all duration-300 tracking-wide hover:-translate-y-0.5 active:translate-y-0" href="{{ route('frontend.form-pesanan') }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>FORM PEMESANAN PEMBANGUNAN</span>
            </a>
            <a class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#1a2b42] hover:bg-[#253954] text-white border border-slate-700/50 font-semibold text-xs sm:text-sm px-7 py-3.5 rounded shadow transition-all duration-300 tracking-wide hover:-translate-y-0.5 active:translate-y-0" href="https://wa.me/6281239401899" rel="noopener noreferrer" target="_blank">
                <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                </svg>
                <span>WHATSAPP QUICK DESK</span>
            </a>
        </div>
    </div>
</section>
<!-- END: CallToAction -->

@endsection
