
@extends('layouts.app')

@section('title', 'Pembangunan & Renovasi | Surya Karya')

@push('styles')
<link href="{{ asset('css/standar-spesifikasi.css') }}" rel="stylesheet">
@endpush

@section('content')

<div class="split-panel-selection w-full grid grid-cols-1 lg:grid-cols-2 relative">

    {{-- PEMBANGUNAN --}}
    <div class="animate-left h-full w-full flex flex-col">
        <section aria-label="Pembangunan"
            class="split-panel split-panel-left group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer h-full flex-1"
            onclick="window.location.href='{{ route('pembangunan') }}'">

            {{-- Background Image --}}
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-105"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDRDob8yilUEeRQmJjXPk81hxd8AKaU_Yd_HDzX5bzhqTpFvbQNKdihbpj8tXcfrna1Hwwf69KE2S0S5hSt1DRvimu_koDBDlpNH_SO-NM3hR9t3gux6TPvNjw-rO1uyp2elUSlZkNsSwzx4BeYxlhwwprtejSV0KbUSQ7adZZYRpvmxnoY8tTHSzfHEK7i-irp6AwcMcjNfekjVW8p7lFhcFMM8fxbdOBkVZRxzmR_W79ICjeFf76-03m2OrzeRRf4gMElYeI1FR1mWQ'); background-position: 25% center;">
            </div>

            {{-- Color Overlay --}}
            <div class="absolute inset-0 bg-[#0b1f3b]/75 mix-blend-multiply transition-opacity duration-300 group-hover:bg-[#0b1f3b]/65"></div>

            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#06101e]/90 via-[#0a192f]/40 to-[#071527]/50"></div>

            <div class="split-panel-overlay"></div>

            {{-- Eyebrow --}}
            <div class="relative z-10 pt-24 lg:pt-28">
                <span class="inline-block text-[11.5px] sm:text-xs font-semibold tracking-[0.25em] text-[#dfcfb9] uppercase font-sans">
                    PEMBANGUNAN HUNIAN &amp; PROPERTI
                </span>
            </div>

            {{-- Content --}}
            <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

                <h1 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                    <a href="{{ route('pembangunan') }}" class="hover:underline">
                        Pembang<span class="italic font-light text-[#dfcfb9]">unan</span>
                    </a>
                </h1>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                    Layanan pembangunan hunian dan properti dengan perencanaan matang, material berkualitas, serta pengerjaan yang terukur untuk menghasilkan bangunan yang kokoh, nyaman, dan sesuai kebutuhan.
                </p>

            </div>

            {{-- Button --}}
            <div class="relative z-10 pt-4">
                <a aria-label="Lihat detail Pembangunan"
                    class="split-panel-button w-14 h-14 rounded-full bg-[#dfcfb9] text-[#071120] flex items-center justify-center shadow-lg shadow-black/30"
                    href="{{ route('pembangunan') }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>

                </a>
            </div>

        </section>
    </div>

    {{-- Divider --}}
    <div class="split-panel-divider hidden lg:block"></div>

    {{-- RENOVASI --}}
    <div class="animate-right h-full w-full flex flex-col">
        <section aria-label="Renovasi"
            class="split-panel split-panel-right group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer h-full flex-1"
            onclick="window.location.href='{{ route('renovasi') }}'">

            {{-- Background Image --}}
            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-105"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBEJ38MBqOwfXulF1m9ktJQLpRGNVXbbD7QJeRHwIkBk30DGYnjyvdBnPJade1qlJ4csz1Paq_6Mym_cek3aOTzNJxd_K6zb77LZuuuwNfHPJE12ElWxTFHZstiufztqG_UZrhv7g8PlEo-rrVt5vSymA8fyj9h8crzHbuKhvDX5c4xgDXi21cBMAaA6bqYmF6kdXnwnEkDZWTZny_Se8BL1LcmpfuOqcxtmKVvswfpe7MvF5WFWjQe_vYlBVADSJs0ZADurpzAlGb2PA'); background-position: 75% center;">
            </div>

            {{-- Color Overlay --}}
            <div class="absolute inset-0 bg-[#070e17]/85 mix-blend-multiply transition-opacity duration-300 group-hover:bg-[#070e17]/75"></div>

            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#050a11]/95 via-[#081320]/60 to-[#070e17]/70"></div>

            <div class="split-panel-overlay"></div>

            {{-- Eyebrow --}}
            <div class="relative z-10 pt-24 lg:pt-28">
                <span class="inline-block text-[11.5px] sm:text-xs font-semibold tracking-[0.25em] text-[#cbb493] uppercase font-sans">
                    RENOVASI &amp; PENINGKATAN BANGUNAN
                </span>
            </div>

            {{-- Content --}}
            <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

                <h2 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                    <a href="{{ route('renovasi') }}" class="hover:underline">
                        Reno<span class="italic font-light text-[#dfcfb9]">vasi</span>
                    </a>
                </h2>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                    Solusi renovasi untuk memperbarui, memperbaiki, dan meningkatkan fungsi bangunan dengan proses kerja yang terencana tanpa mengesampingkan kualitas, keamanan, dan estetika.
                </p>

            </div>

            {{-- Button --}}
            <div class="relative z-10 pt-4">
                <a aria-label="Lihat detail Renovasi"
                    class="split-panel-button split-panel-button-outline w-14 h-14 rounded-full border border-white/30 text-white flex items-center justify-center shadow-lg"
                    href="{{ route('renovasi') }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>

                </a>
            </div>

        </section>
    </div>

</div>

@endsection

