@extends('layouts.app')

@section('title', 'Pembangunan & Renovasi | Surya Karya')

@push('styles')
<link href="{{ asset('css/standar-spesifikasi.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="split-panel-selection w-full grid grid-cols-1 lg:grid-cols-2 relative">

    <!-- LEFT PANEL: Pembangunan -->
    <section
        aria-label="Pembangunan"
        class="split-panel split-panel-left group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer"
        onclick="window.location.href='{{ route('pembangunan') }}'"
    >

        <!-- Hover Overlay -->
        <div class="split-panel-overlay"></div>

        <!-- Top Eyebrow -->
        <div class="relative z-10">
            <span class="inline-block text-[11px] sm:text-xs font-semibold tracking-[0.25em] text-[#d1b181] uppercase mb-4">
                PEMBANGUNAN HUNIAN &amp; PROPERTI
            </span>
        </div>

        <!-- Content -->
        <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

            <h1 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                <a href="{{ route('pembangunan') }}" class="hover:underline">
                    Pembangunan <span class="gold-italic-accent">Bangunan</span>
                </a>
            </h1>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                Layanan pembangunan hunian dan properti dengan perencanaan
                matang, material berkualitas, serta pengerjaan yang terukur
                untuk menghasilkan bangunan yang kokoh, nyaman, dan sesuai kebutuhan.
            </p>

        </div>

        <!-- Button -->
        <div class="relative z-10 pt-4">
            <a
                aria-label="Lihat detail Pembangunan"
                class="split-panel-button w-14 h-14 rounded-full bg-[#d1b181] text-[#071120] flex items-center justify-center shadow-lg shadow-black/30"
                href="{{ route('pembangunan') }}"
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


    <!-- CENTER DIVIDER -->
    <div class="split-panel-divider hidden lg:block"></div>


    <!-- RIGHT PANEL: Renovasi -->
    <section
        aria-label="Renovasi"
        class="split-panel split-panel-right group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer"
        onclick="window.location.href='{{ route('renovasi') }}'"
    >

        <!-- Hover Overlay -->
        <div class="split-panel-overlay"></div>

        <!-- Top Eyebrow -->
        <div class="relative z-10">
            <span class="inline-block text-[11px] sm:text-xs font-semibold tracking-[0.25em] text-[#d1b181] uppercase mb-4">
                RENOVASI &amp; PENINGKATAN BANGUNAN
            </span>
        </div>

        <!-- Content -->
        <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

            <h2 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                <a href="{{ route('renovasi') }}" class="hover:underline">
                    Renovasi <span class="gold-italic-accent">Bangunan</span>
                </a>
            </h2>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                Solusi renovasi untuk memperbarui, memperbaiki, dan meningkatkan
                fungsi bangunan dengan proses kerja yang terencana tanpa
                mengesampingkan kualitas, keamanan, dan estetika.
            </p>

        </div>

        <!-- Button -->
        <div class="relative z-10 pt-4">
            <a
                aria-label="Lihat detail Renovasi"
                class="split-panel-button split-panel-button-outline w-14 h-14 rounded-full border border-white/30 text-white flex items-center justify-center shadow-lg"
                href="{{ route('renovasi') }}"
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