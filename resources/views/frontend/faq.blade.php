@extends('layouts.app')

@section('title', 'FAQ | Surya Karya')

@section('content')

@php
    $hero = \App\Models\HeroTitle::getForPage('faq');
    $heroTitleText = ($hero && !empty($hero->title)) ? $hero->title : 'Pertanyaan yang Sering Diajukan';
    $heroDeskripsiText = ($hero && !empty($hero->deskripsi)) ? $hero->deskripsi : 'Temukan jawaban komprehensif seputar layanan, transparansi rancang bangun, estimasi RAB, dan alur kerja sama bersama Surya Karya.';
    $heroImage = ($hero && !empty($hero->image_url)) ? $hero->image_url : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCeVbtNJiJuL00yT332BB87i6eGfIlEL-L_LdxKGSFd1Z1mfnTd3bZdOiyT88tu5L-T1dLtUlK2F8Sp8iWG-L1ZMCxzwC9bROyNihL-_pLkwPPeksOBvW6K8rNbXGLX0l7AhO4I8QZSAKgpizo8EcD7Ubl45jNNMN5IIhWdxqVVhl3xArBWUMccQsLabranZYvDMaEzvuaWRrqYM94q10omSYxM23s6vYlVswuYr8DQDHaRF0IHTIcK';

    // Kontak dari Setting
    $waRaw   = $setting?->whatsapp ?? '';
    $waDigit = preg_replace('/\D+/', '', $waRaw);
    if (str_starts_with($waDigit, '0')) {
        $waDigit = '62' . substr($waDigit, 1);
    }
    $waLink       = $waDigit ? 'https://wa.me/' . $waDigit : null;
    $phoneDisplay = ($setting?->phone ?: $waRaw);
@endphp
<section class="relative border-b border-slate-800/80 py-28 md:py-36 lg:py-44 px-6 sm:px-10 lg:px-16 overflow-hidden bg-brand-dark bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(7, 19, 36, 0.92), rgba(11, 25, 44, 0.85)), url('{{ $heroImage }}');">
    <div class="animate-left">
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-white font-normal tracking-tight leading-[1.15]">
                    {{ $heroTitleText }}
                </h1>
                <p class="mt-5 text-base sm:text-lg text-slate-300 font-light leading-relaxed max-w-2xl">
                    {{ $heroDeskripsiText }}
                </p>
            </div>
        </div>
    </div>
</section>

<main class="py-14 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">

        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-28">

            <div class="bg-white border border-slate-200 rounded-sm p-6 shadow-sm">
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6">
                    KATEGORI INFORMASI
                </h2>

                <ul class="space-y-1 text-sm font-medium">
                    @forelse($categories as $category)
                        <li>
                            <a href="#kategori-{{ $category->id }}"
                               class="flex items-center justify-between p-3 rounded-sm text-slate-600 hover:text-brand-navy hover:bg-slate-50 transition">
                                <span class="flex items-center gap-2.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300 category-indicator"></span>
                                    {{ $category->title }}
                                </span>
                            </a>
                        </li>
                    @empty
                        <li class="text-sm text-slate-400">
                            Belum ada kategori FAQ.
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="text-white rounded-sm p-7 shadow-md relative overflow-hidden" style="background-color: #0B192C;">
                <div class="absolute -right-8 -top-8 w-28 h-28 bg-white/5 rounded-full pointer-events-none"></div>

                <h3 class="font-serif text-2xl leading-snug font-semibold text-white mb-2">
                    Konsultasi Gratis
                </h3>

                <p class="text-xs sm:text-sm text-slate-300 font-light leading-relaxed mb-6">
                    Butuh kalkulasi awal atau telaah denah? Diskusikan langsung dengan tim perencana kami.
                </p>

                @if($waLink)
                    <a class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#c7ab7c] hover:bg-[#bfa06d] text-slate-900 text-xs font-bold uppercase tracking-wider rounded-sm shadow transition"
                       href="{{ $waLink }}"
                       rel="noopener noreferrer"
                       target="_blank">

                        <i class="fa-brands fa-whatsapp text-base"></i>

                        CHAT VIA WHATSAPP
                    </a>
                @endif

                <div class="mt-6 pt-5 border-t border-white/15 space-y-2 text-xs text-slate-300">

                    @if($phoneDisplay)
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone w-4 text-center text-amber-200/90"></i>
                            <span class="font-semibold text-white">{{ $phoneDisplay }}</span>
                        </div>
                    @endif

                    <div class="flex items-center gap-2.5 text-slate-300">
                        <i class="fa-regular fa-clock w-4 text-center text-amber-200/90"></i>
                        <span>Senin – Sabtu: 08.00 – 17.00 WIB</span>
                    </div>

                </div>
            </div>

        </aside>

        <section class="lg:col-span-8 space-y-12">

            @forelse($categories as $category)

                <div class="scroll-mt-28 space-y-4 pt-4" id="kategori-{{ $category->id }}">

                    <h2 class="font-serif text-3xl font-medium text-brand-navy pb-3 border-b border-slate-200">
                        {{ $category->title }}
                    </h2>

                    <div class="divide-y divide-slate-200">

                        @forelse($category->faqs as $faq)

                            <details class="group py-4">

                                <summary class="flex justify-between items-center cursor-pointer text-slate-800 font-medium text-base hover:text-brand-navy select-none">

                                    <span>
                                        {{ $faq->question }}
                                    </span>

                                    <svg class="chevron-icon w-5 h-5 text-slate-400 group-hover:text-brand-navy transition-transform duration-200 shrink-0 ml-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path d="M19 9l-7 7-7-7"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2">
                                        </path>

                                    </svg>

                                </summary>

                                <div class="mt-3 text-sm text-slate-600 leading-relaxed pr-8">
                                    {{ $faq->answer }}
                                </div>

                            </details>

                        @empty

                            <p class="py-4 text-sm text-slate-400">
                                Belum ada FAQ pada kategori ini.
                            </p>

                        @endforelse

                    </div>

                </div>

            @empty

                <div class="py-12 text-center text-slate-400">
                    Belum ada data FAQ.
                </div>

            @endforelse

        </section>

    </div>
</main>

@endsection

@push('scripts')
<script src="/js/faq.js"></script>
@endpush