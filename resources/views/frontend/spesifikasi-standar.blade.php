@extends('layouts.app')

@section('title', 'Spesifikasi Bangunan & Standar Mutu | Surya Karya')

@push('styles')
<link href="{{ asset('css/standar-spesifikasi.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="split-panel-selection w-full grid grid-cols-1 lg:grid-cols-2 relative">

    <!-- LEFT PANEL: Spesifikasi Bangunan -->
    <div class="animate-left">
    <section
        aria-label="Spesifikasi Bangunan"
        class="split-panel split-panel-left group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer"
        onclick="window.location.href='{{ route('spesifikasi-bangunan') }}'"
    >

        <!-- Hover Overlay -->
        <div class="split-panel-overlay"></div>

        <!-- Top Eyebrow -->
        <div class="relative z-10">
            <span class="inline-block text-[11px] sm:text-xs font-semibold tracking-[0.25em] text-[#d1b181] uppercase mb-4">
                STANDAR MATERIAL &amp; STRUKTUR
            </span>
        </div>

        <!-- Content -->
        <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

            <h1 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                <a href="{{ route('spesifikasi-bangunan') }}" class="hover:underline">
                    Spesifikasi <span class="gold-italic-accent">Bangunan</span>
                </a>
            </h1>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                Panduan komprehensif pemilihan material berstandar SNI,
                spesifikasi teknis fondasi, dinding, atap, serta instalasi
                utilitas premium untuk ketahanan hunian jangka panjang.
            </p>

        </div>

        <!-- Button -->
        <div class="relative z-10 pt-4">
            <a
                aria-label="Lihat detail Spesifikasi Bangunan"
                class="split-panel-button w-14 h-14 rounded-full bg-[#d1b181] text-[#071120] flex items-center justify-center shadow-lg shadow-black/30"
                href="{{ route('spesifikasi-bangunan') }}"
            >
                <svg
                    class="w-6 h-6 stroke-[2.2]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M14 5l7 7m0 0l-7 7m7-7H3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                </svg>
            </a>
        </div>

    </section>
</div>

    <!-- CENTER DIVIDER -->
    <div class="split-panel-divider hidden lg:block"></div>


    <!-- RIGHT PANEL: Standar Mutu -->
     <div class="animate-right">
    <section
        aria-label="Standar Mutu"
        class="split-panel split-panel-right group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer"
        onclick="window.location.href='{{ route('standar-mutu') }}'"
    >

        <!-- Hover Overlay -->
        <div class="split-panel-overlay"></div>

        <!-- Top Eyebrow -->
        <div class="relative z-10">
            <span class="inline-block text-[11px] sm:text-xs font-semibold tracking-[0.25em] text-[#d1b181] uppercase mb-4">
                JAMINAN KUALITAS &amp; PRESISI TEKNIK
            </span>
        </div>

        <!-- Content -->
        <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

            <h2 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                <a href="{{ route('standar-mutu') }}" class="hover:underline">
                    Standar <span class="gold-italic-accent">Mutu</span>
                </a>
            </h2>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                Protokol kendali mutu berjenjang, supervisi ketat tim ahli
                arsitek &amp; mandor, serta jaminan garansi pemeliharaan
                struktural demi kepuasan dan ketenangan sejati Anda.
            </p>

        </div>

        <!-- Button -->
        <div class="relative z-10 pt-4">
            <a
                aria-label="Lihat detail Standar Mutu"
                class="split-panel-button split-panel-button-outline w-14 h-14 rounded-full border border-white/30 text-white flex items-center justify-center shadow-lg"
                href="{{ route('standar-mutu') }}"
            >
                <svg
                    class="w-6 h-6 stroke-[2.2]"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M14 5l7 7m0 0l-7 7m7-7H3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                </svg>
            </a>
        </div>

    </section>

</div>

@endsection