@extends('layouts.app')

@section('title', 'Spesifikasi Bangunan & Standar Mutu | Surya Karya')

@push('styles')
<link href="{{ asset('css/standar-spesifikasi.css') }}" rel="stylesheet">
@endpush

@section('content')

@php
    $panelSpesifikasi = \App\Models\ServicePanel::getForKey('spesifikasi_bangunan');
    $spesifikasiEyebrow = ($panelSpesifikasi && !empty($panelSpesifikasi->eyebrow)) ? $panelSpesifikasi->eyebrow : 'STANDAR MATERIAL & STRUKTUR';
    $spesifikasiTitle = ($panelSpesifikasi && !empty($panelSpesifikasi->title)) ? $panelSpesifikasi->formatted_title : 'Spesifikasi <span class="italic font-light text-[#dfcfb9]">Bangunan</span>';
    $spesifikasiDeskripsi = ($panelSpesifikasi && !empty($panelSpesifikasi->deskripsi)) ? $panelSpesifikasi->deskripsi : 'Panduan komprehensif pemilihan material berstandar SNI, spesifikasi teknis fondasi, dinding, atap, serta instalasi utilitas premium untuk ketahanan hunian jangka panjang.';
    $spesifikasiImage = ($panelSpesifikasi && !empty($panelSpesifikasi->image_url)) ? $panelSpesifikasi->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAUM6ebrWgmHazERXSijlCE-wfzWMQ95b35y7U9Zu0wsQr8XI0SKfxGZxRGLVrYw90mYgdSTFQCnQRSkCePkrPwLIjmPgSz2EhHdqJjy7kx50gnWj4TYW1vIupCHYiel3_BvmtevGrPzyrW9tKzODPiuaf9T_IScFETZZT01uFwVEWqoGIqklf4JT8zyrXiapGBs6zbXoz82IDGaKgfwE6trODnNfs05FyWP2WdpwY6ZD0NGJ6a-wfE';

    $panelStandar = \App\Models\ServicePanel::getForKey('standar_mutu');
    $standarEyebrow = ($panelStandar && !empty($panelStandar->eyebrow)) ? $panelStandar->eyebrow : 'JAMINAN KUALITAS & PRESISI TEKNIK';
    $standarTitle = ($panelStandar && !empty($panelStandar->title)) ? $panelStandar->formatted_title : 'Standar <span class="italic font-light text-[#dfcfb9]">Mutu</span>';
    $standarDeskripsi = ($panelStandar && !empty($panelStandar->deskripsi)) ? $panelStandar->deskripsi : 'Protokol kendali mutu berjenjang, supervisi ketat tim ahli arsitek & mandor, serta jaminan garansi pemeliharaan struktural demi kepuasan dan ketenangan sejati Anda.';
    $standarImage = ($panelStandar && !empty($panelStandar->image_url)) ? $panelStandar->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuDIutYZVIDdb3tmEhhuc0qalJ8m1tJO32n2MKhDITkGv4jZpEl8mYQzdfwJfHyi1tYjlbvhT6Eou2s3_Zl5Btu-Ip4hunJMG71va3i9Y1g_Sht-mx7ZduBMZkA7b_GXbjyNNI8vkAdz9gihGxMPWRj7PBhktAe7ZFn2aCAyNXxzbwM5JbvYPSBGiqfcahrclUTQ3SMTebPpIpOAssl59Ry0xDUt58ir2xVxJ3LEyf6HzaRByKLt3Xj7';
@endphp

<div class="split-panel-selection w-full grid grid-cols-1 lg:grid-cols-2 relative">

    <!-- LEFT PANEL: Spesifikasi Bangunan -->
    <div class="animate-left h-full w-full flex flex-col">
    <section
        aria-label="Spesifikasi Bangunan"
        class="split-panel split-panel-left group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer h-full flex-1"
        onclick="window.location.href='{{ route('spesifikasi-bangunan') }}'"
    >
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-105"
            style="background-image: url('{{ $spesifikasiImage }}'); background-position: center;">
        </div>

        <!-- Color Overlay -->
        <div class="absolute inset-0 bg-[#0b1f3b]/75 mix-blend-multiply transition-opacity duration-300 group-hover:bg-[#0b1f3b]/65"></div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#06101e]/90 via-[#0a192f]/40 to-[#071527]/50"></div>

        <!-- Hover Overlay -->
        <div class="split-panel-overlay"></div>

        <!-- Top Eyebrow -->
        <div class="relative z-10 pt-24 lg:pt-28">
            <span class="inline-block text-[11.5px] sm:text-xs font-semibold tracking-[0.25em] text-[#dfcfb9] uppercase font-sans">
                {{ $spesifikasiEyebrow }}
            </span>
        </div>

        <!-- Content -->
        <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

            <h1 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                <a href="{{ route('spesifikasi-bangunan') }}" class="hover:underline">
                    {!! $spesifikasiTitle !!}
                </a>
            </h1>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                {{ $spesifikasiDeskripsi }}
            </p>

        </div>

        <!-- Button -->
        <div class="relative z-10 pt-4">
            <a
                aria-label="Lihat detail Spesifikasi Bangunan"
                class="split-panel-button w-14 h-14 rounded-full bg-[#dfcfb9] text-[#071120] flex items-center justify-center shadow-lg shadow-black/30"
                href="{{ route('spesifikasi-bangunan') }}"
            >
                <svg
                    class="w-6 h-6 stroke-[1.8]"
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
    <div class="animate-right h-full w-full flex flex-col">
    <section
        aria-label="Standar Mutu"
        class="split-panel split-panel-right group relative flex flex-col justify-between p-8 sm:p-14 lg:p-20 xl:p-24 transition-all duration-500 overflow-hidden cursor-pointer h-full flex-1"
        onclick="window.location.href='{{ route('standar-mutu') }}'"
    >
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 ease-out group-hover:scale-105"
            style="background-image: url('{{ $standarImage }}'); background-position: center;">
        </div>

        <!-- Color Overlay -->
        <div class="absolute inset-0 bg-[#070e17]/85 mix-blend-multiply transition-opacity duration-300 group-hover:bg-[#070e17]/75"></div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#050a11]/95 via-[#081320]/60 to-[#070e17]/70"></div>

        <!-- Hover Overlay -->
        <div class="split-panel-overlay"></div>

        <!-- Top Eyebrow -->
        <div class="relative z-10 pt-24 lg:pt-28">
            <span class="inline-block text-[11.5px] sm:text-xs font-semibold tracking-[0.25em] text-[#cbb493] uppercase font-sans">
                {{ $standarEyebrow }}
            </span>
        </div>

        <!-- Content -->
        <div class="relative z-10 my-auto py-12 lg:py-20 max-w-xl">

            <h2 class="font-cormorant text-5xl sm:text-6xl md:text-7xl font-normal text-white leading-[1.08] tracking-tight mb-6">
                <a href="{{ route('standar-mutu') }}" class="hover:underline">
                    {!! $standarTitle !!}
                </a>
            </h2>

            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-light pr-4 max-w-lg">
                {{ $standarDeskripsi }}
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
                    class="w-6 h-6 stroke-[1.8]"
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