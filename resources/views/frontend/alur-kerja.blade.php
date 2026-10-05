@extends('layouts.app')

@section('title', 'Alur Kerja Sama Konstruksi | Surya Karya')

@push('styles')
<link href="{{ asset('css/alur-kerja.css') }}" rel="stylesheet">
@endpush

@section('content')

<section class="relative pt-24 pb-24 md:pt-32 md:pb-32 overflow-hidden bg-brand-navy text-white">
    <div class="absolute inset-0 z-0">
        <img
            alt="Architectural Plan and Construction"
            class="w-full h-full object-cover object-center filter brightness-[0.6] contrast-[1.1]"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGm0ulHQ0lBqq0fHtOHN2MPUpqdGLeEr7qeHdJ0pOCBfuQ00DhnO_DGKIkUgMDilRhQu_u485FeizWRyUsxlxgQiyJbiNeASq1zqm9kenrPu2MgnlLHnuz0VNrPRcptNvboS8RdM-_5u7Pgj8uzSV8lCNYs3E0B8VIm2Kdt2earzo2ONq0UFen9sGfqRzRb77qqSFktTAe3b5dc7fSgoD2LBOXZJlBHbGUSJgKdN4mbJDld0Nqqk8o"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-[#0b192c]/95 via-[#0b192c]/90 to-[#1e3a8a]/75 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-[#0b192c]/40"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-left">
        <div class="max-w-3xl">
            <div class="animate-left">
                <div class="flex items-center gap-3 mb-5">
                    <span class="inline-block w-8 h-[1px] bg-brand-borderGold"></span>
                    <span class="text-xs tracking-widest uppercase font-semibold text-brand-sand">
                        Surya Karya Standar Kerja
                    </span>
                </div>

                <h1 class="font-serif-cormorant text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-semibold tracking-tight text-white leading-[1.1] uppercase">
                    Alur Kerja Sama<br>Kontraktor
                </h1>

                <p class="mt-6 sm:mt-8 text-base sm:text-lg text-[#e7d8c9]/90 font-normal leading-relaxed max-w-2xl">
                    Proses kerja sama yang jelas, transparan, dan terstruktur dari awal pengajuan hingga hunian siap dihuni. Kami menjaga presisi teknis dan ketepatan timeline di setiap fase.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="relative py-24 sm:py-32 bg-[#faf8f5]/50" id="alur-proses">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="timeline-spine left-6 md:left-1/2 md:-ml-[1px]"></div>

        <div class="space-y-20 sm:space-y-32 relative">

            @forelse($items as $index => $item)

                @php
                    $isEven = $index % 2 === 0;
                @endphp

                <div class="animate-up">
                    <div class="reveal-step relative flex flex-col md:flex-row items-center gap-8 md:gap-0">

                        @if($isEven)

                            {{-- TEXT LEFT --}}
                            <div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 text-left md:text-right order-2 md:order-1">

                                <span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
                                    Langkah {{ str_pad($item->no, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
                                    {{ $item->title }}
                                </h2>

                                <p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md ml-0 md:ml-auto">
                                    {{ $item->content }}
                                </p>

                            </div>

                            {{-- CENTRAL ICON --}}
                            <div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
                                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
                                    <span class="font-serif-cormorant text-lg md:text-xl font-bold">
                                        {{ str_pad($item->no, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </div>

                            {{-- IMAGE RIGHT --}}
                            <div class="w-full md:w-1/2 pl-12 md:pl-14 order-1 md:order-2">
                                <div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
                                    <img
                                        alt="{{ $item->title }}"
                                        class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500"
                                        src="{{ asset($item->image) }}"
                                    >
                                </div>
                            </div>

                        @else

                            {{-- IMAGE LEFT --}}
                            <div class="w-full md:w-1/2 pl-12 md:pl-0 md:pr-14 order-1">
                                <div class="overflow-hidden rounded-xl border border-stone-200 shadow-sm bg-white p-1.5 group">
                                    <img
                                        alt="{{ $item->title }}"
                                        class="w-full h-56 sm:h-64 md:h-72 object-cover rounded-lg group-hover:scale-[1.02] transition-transform duration-500"
                                        src="{{ asset($item->image) }}"
                                    >
                                </div>
                            </div>

                            {{-- CENTRAL ICON --}}
                            <div class="absolute left-6 md:left-1/2 transform -translate-x-1/2 flex items-center justify-center z-20">
                                <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-brand-sand border-2 border-stone-800 shadow-md flex items-center justify-center text-stone-900 bg-[#e7d8c9]">
                                    <span class="font-serif-cormorant text-lg md:text-xl font-bold">
                                        {{ str_pad($item->no, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </div>

                            {{-- TEXT RIGHT --}}
                            <div class="w-full md:w-1/2 pl-12 md:pl-14 text-left order-2">

                                <span class="inline-block px-3 py-1 bg-brand-sand/50 border border-brand-borderGold/50 text-[11px] font-semibold tracking-wider text-stone-800 uppercase rounded mb-3">
                                    Langkah {{ str_pad($item->no, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <h2 class="font-serif-cormorant text-2xl sm:text-3xl font-bold tracking-normal text-brand-navy uppercase mb-3">
                                    {{ $item->title }}
                                </h2>

                                <p class="text-sm sm:text-base text-stone-600 leading-relaxed max-w-md mr-auto">
                                    {{ $item->content }}
                                </p>

                            </div>

                        @endif

                    </div>
                </div>

            @empty

                <div class="text-center py-16">
                    <h2 class="font-serif-cormorant text-3xl text-brand-navy mb-3">
                        Alur Kerja Sama Belum Tersedia
                    </h2>
                    <p class="text-stone-600">
                        Informasi alur kerja sama sedang dipersiapkan.
                    </p>
                </div>

            @endforelse

        </div>
    </div>
</section>

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
                <a
                    class="w-full sm:w-auto px-8 py-3.5 bg-[#e5d5c5] hover:bg-[#d8c5b3] text-[#0b192c] text-xs font-semibold uppercase tracking-widest rounded shadow transition-all duration-200"
                    href="https://wa.me/6281239401899"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    Mulai Konsultasi
                </a>
            </div>

        </div>
    </div>
</section>

@endsection