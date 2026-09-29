@extends('layouts.app')

@section('title', 'Spesifikasi Bangunan | Surya Karya')

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
<section class="relative text-white py-28 md:py-36 lg:py-44 px-6 sm:px-10 lg:px-16 border-b border-slate-700/30 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAUM6ebrWgmHazERXSijlCE-wfzWMQ95b35y7U9Zu0wsQr8XI0SKfxGZxRGLVrYw90mYgdSTFQCnQRSkCePkrPwLIjmPgSz2EhHdqJjy7kx50gnWj4TYW1vIupCHYiel3_BvmtevGrPzyrW9tKzODPiuaf9T_IScFETZZT01uFwVEWqoGIqklf4JT8zyrXiapGBs6zbXoz82IDGaKgfwE6trODnNfs05FyWP2WdpwY6ZD0NGJ6a-wfE'); background-position: center 35%;">
    </div>

    <!-- Semi-Transparent Navy Color Overlay -->
    <div class="absolute inset-0 bg-[#0b192c]/80 mix-blend-multiply"></div>

    <!-- Gradient Dark Overlay for Readability -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#06101e]/95 via-[#0b192c]/80 to-[#0b192c]/40"></div>

    <div class="max-w-6xl mx-auto text-left relative z-10">
        <!-- Architectural Heading (Rata Kiri) -->
        <h1 class="font-serif-heading text-4xl sm:text-5xl md:text-[56px] font-semibold tracking-wider uppercase leading-tight mb-6 text-left animate-left">
            SPESIFIKASI BANGUNAN
        </h1>
        <!-- Description Subtitle (Rata Kiri) -->
        <p class="text-slate-200 text-sm sm:text-base font-normal max-w-2xl leading-relaxed tracking-normal text-left animate-left">
            Komitmen Surya Karya terhadap keunggulan teknis dan material berkualitas tinggi pada setiap tahap pembangunan.
        </p>
    </div>
</section>
<!-- END: HeroSection -->

<!-- BEGIN: SpecificationsGrid -->
<main class="max-w-6xl mx-auto px-6 py-16 md:py-24 w-full overflow-x-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
        
        <!-- Spec Card 1: Pondasi (Mengambang Masuk dari Kiri) -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-left">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h2 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-4 flex items-center justify-between">
                    Pondasi
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Pondasi dirancang untuk stabilitas jangka panjang sesuai dengan kondisi tanah setempat.
                </p>
                <!-- Checklist items -->
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Batu Kali belah kualitas terbaik</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Cakar Ayam / Footplat beton bertulang (K-225/K-250)</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Strauss Pile / Tiang Pancang (Untuk tanah berisiko)</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Spec Card 2: Struktur Bangunan (Mengambang Masuk dari Kanan) -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-right">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h2 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-4">
                    Struktur Bangunan
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Sistem rangka struktural menggunakan beton bertulang berstandar tinggi.
                </p>
                <!-- Checklist items -->
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Besi beton SNI (Toleransi minimal)</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Sloof, Kolom, dan Ring Balok proporsional</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Mutu beton ready mix K-225 hingga K-300</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Spec Card 3: Dinding (Mengambang Masuk dari Kiri) -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-left">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h2 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-4">
                    Dinding
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Dinding kokoh dengan insulasi termal dan akustik yang optimal.
                </p>
                <!-- Checklist items -->
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Bata Merah press mesin / Bata Ringan (Hebel)</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Plesteran dengan semen berkualitas (Semen Tiga Roda/Gresik)</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Acian halus khusus dinding untuk hasil pengecatan sempurna</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Spec Card 4: Atap (Mengambang Masuk dari Kanan) -->
        <div class="spec-card bg-white rounded-xl p-8 md:p-10 border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] animate-right">
            <div class="card-corner-shape"></div>
            <div class="relative z-10">
                <h2 class="font-serif-heading text-3xl font-semibold text-[#0b192c] mb-4">
                    Atap
                </h2>
                <p class="text-slate-600 text-sm leading-relaxed mb-6 font-normal">
                    Struktur atap presisi tinggi dengan pelapis anti bocor.
                </p>
                <!-- Checklist items -->
                <ul class="space-y-3.5 text-sm text-slate-700">
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Rangka Atap Baja Ringan (Zincalume ketebalan 0.75mm - 1mm)</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Genteng Keramik (Kanmuri/M-Class) atau Genteng Beton</span>
                    </li>
                    <li class="flex items-start group/item">
                        <span class="plus-badge text-[#d4af37] mr-3 text-base leading-none font-bold select-none">+</span>
                        <span class="group-hover/item:text-[#0b192c] transition-colors">Aluminium Foil Woven Double Sided untuk insulasi panas</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</main>
<!-- END: SpecificationsGrid -->

<!-- BEGIN: CallToAction -->
<section class="bg-[#0b192c] text-white py-20 px-6 w-full animate-up" id="konsultasi">
    <div class="max-w-3xl mx-auto text-center">
        <!-- CTA Title -->
        <h2 class="font-serif-heading text-3xl sm:text-4xl md:text-[42px] font-semibold tracking-wide text-white mb-4 leading-tight">
            Mulai Rencana Pembangunan Anda
        </h2>
        <!-- CTA Subtitle -->
        <p class="text-slate-300 text-sm sm:text-base mb-8 max-w-xl mx-auto leading-relaxed">
            Diskusikan kebutuhan spesifikasi teknis dan standar mutu proyek Anda dengan tim ahli kami.
        </p>
        <!-- CTA Button -->
        <a class="inline-block bg-[#d4af37] hover:bg-[#c19b2e] text-[#0b192c] font-semibold text-xs sm:text-sm px-8 py-3.5 rounded shadow-lg hover:shadow-[#d4af37]/20 transition-all duration-300 tracking-wide hover:-translate-y-0.5 active:translate-y-0" href="{{ route('frontend.form-pesanan') }}">
            Jadwalkan Konsultasi
        </a>
    </div>
</section>
<!-- END: CallToAction -->

@endsection
