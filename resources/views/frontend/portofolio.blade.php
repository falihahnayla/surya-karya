@extends('layouts.app')

@section('title', 'Portofolio Proyek | Surya Karya Pembangunan & Renovasi')

@push('styles')
<style>
    .font-serif-heading {
        font-family: 'Cormorant Garamond', Georgia, serif;
        letter-spacing: 0.02em;
    }

    .card-gradient-overlay {
        background: linear-gradient(180deg, rgba(6, 16, 30, 0.02) 0%, rgba(6, 16, 30, 0.45) 50%, rgba(6, 16, 30, 0.94) 100%);
    }

    /* Staggered Entrance Delays */
    .card-delay-1 { transition-delay: 40ms !important; }
    .card-delay-2 { transition-delay: 80ms !important; }
    .card-delay-3 { transition-delay: 120ms !important; }
    .card-delay-4 { transition-delay: 160ms !important; }
    .card-delay-5 { transition-delay: 200ms !important; }
    .card-delay-6 { transition-delay: 240ms !important; }
    .card-delay-7 { transition-delay: 280ms !important; }
    .card-delay-8 { transition-delay: 320ms !important; }

    /* Ultra-Smooth 3D Floating Portfolio Card Base */
    #portfolio-grid {
        perspective: 1200px;
    }

    .portfolio-card {
        transform-style: preserve-3d;
        backface-visibility: hidden;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), 
                    box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: transform, box-shadow;
    }

    .portfolio-card:hover {
        box-shadow: 0 25px 50px -12px rgba(6, 16, 30, 0.35), 0 0 25px rgba(212, 175, 55, 0.12);
    }

    .portfolio-card img {
        transition: transform 0.7s cubic-bezier(0.16, 1, 0.3, 1), filter 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: transform, filter;
        backface-visibility: hidden;
    }

    .portfolio-card:hover img {
        transform: scale(1.07);
        filter: brightness(1.06);
    }

    /* Smooth Filtering Tab Transitions */
    .portfolio-item {
        transition: opacity 0.45s cubic-bezier(0.16, 1, 0.3, 1), 
                    transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .portfolio-item.hide-item {
        opacity: 0;
        transform: perspective(1000px) translate3d(0, 20px, -30px) scale(0.92);
        pointer-events: none;
        position: absolute;
        width: 0;
        height: 0;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }
</style>
@endpush

@section('content')

<!-- BEGIN: HeroPortfolioIntro -->
<section class="pt-14 pb-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-purpose="portfolio-intro">
    <!-- Section Tag / Eyebrow -->
    <p class="text-[11px] font-semibold tracking-[0.25em] text-gray-500 uppercase mb-3 animate-up">
        GALERI &amp; DOKUMENTASI PROYEK
    </p>

    <!-- Big Editorial Headline -->
    <h1 class="font-serif-heading text-5xl sm:text-6xl lg:text-7xl font-semibold tracking-tight text-[#0a192f] uppercase mb-5 leading-none animate-up">
        PORTOFOLIO
    </h1>

    <!-- Architectural Narrative Subtext -->
    <p class="max-w-3xl text-sm sm:text-base leading-relaxed text-gray-600 font-normal animate-up">
        Jelajahi dedikasi kami dalam mewujudkan rancang bangun bernilai tinggi. Setiap proyek mencerminkan ketelitian struktural, material pilihan SNI, serta estetika arsitektur residensial modern yang dirancang untuk bertahan lintas generasi.
    </p>

    <!-- Category Filter Tabs -->
    <div class="mt-10 border-b border-gray-200 animate-up">
        <div class="flex items-center space-x-6 sm:space-x-10 overflow-x-auto no-scrollbar py-2 text-xs font-semibold tracking-wider uppercase" id="portfolio-tabs">
            <button class="tab-btn pb-3 text-[#0a192f] border-b-2 border-[#0a192f] font-bold whitespace-nowrap" data-filter="all" type="button">
                Semua
            </button>
            <button class="tab-btn pb-3 text-gray-500 hover:text-[#0a192f] border-b-2 border-transparent transition-colors whitespace-nowrap" data-filter="pembangunan" type="button">
                Pembangunan
            </button>
            <button class="tab-btn pb-3 text-gray-500 hover:text-[#0a192f] border-b-2 border-transparent transition-colors whitespace-nowrap" data-filter="renovasi" type="button">
                Renovasi
            </button>
            <button class="tab-btn pb-3 text-gray-500 hover:text-[#0a192f] border-b-2 border-transparent transition-colors whitespace-nowrap" data-filter="rumah" type="button">
                Rumah
            </button>
            <button class="tab-btn pb-3 text-gray-500 hover:text-[#0a192f] border-b-2 border-transparent transition-colors whitespace-nowrap" data-filter="interior" type="button">
                Interior
            </button>
            <button class="tab-btn pb-3 text-gray-500 hover:text-[#0a192f] border-b-2 border-transparent transition-colors whitespace-nowrap" data-filter="eksterior" type="button">
                Eksterior
            </button>
        </div>
    </div>
</section>
<!-- END: HeroPortfolioIntro -->

<!-- BEGIN: PortfolioGalleryGrid -->
<section class="pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-purpose="portfolio-grid-section">
    <!-- 4-Column Responsive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="portfolio-grid">

        <!-- Card 1: Villa Modern Canggu -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-1" data-category="pembangunan rumah eksterior">
            <img alt="Villa Modern Canggu" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCjIKJgz3fjGmyD5EU8Eltw6EcrbkV6IM4LKeaQUZk1r_eJYHi-q89urM0y6YdjJ3ErB0y1shYXpUAoD5HiUce1aH4WPLd5EIZMGwnc1hb82hMlLpPgR9YAkeNfTnTStUFD2h3oHVpcf9gMZ3JOf_r-Cy6dIN60SXrX2eA3CRRMdzVl-8wANvvWrQ-WiFq2sdikQ1WyVyzkApoWhjMANMPxRBmjNbgR7urELwiT665GrGizd3cKzUAr">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>
            
            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Pembangunan Baru</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Villa Modern Canggu
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Hunian 2 lantai 420 m², fasad kaca lebar dengan struktur beton ekspos minimalis modern.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Badung, Bali</span>
                    </span>
                    <a aria-label="Lihat detail Villa Modern Canggu" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 2: Kitchen / Dining Interior Showpiece -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-2" data-category="interior">
            <img alt="Interior Dapur & Ruang Makan Elegan Surya Karya" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCs49-ebZsBtKhxpY5Dod4k0ulIFANn6AE1-mi4bfON_yFOjnxVTE_lA77rDTGHTj0sk5mOk5giCHg-Q_Fru1JGUv5kccQRt1G-Axy2djs5QfJ-RSaAJnIXO2__uzRns22hzwuCJCdZNqRri04oHJFjKPdocJylncmgIfSr1sc4jhd5ib9_DLBqsYjoA-i1IVoBfvjkW7PH-aTZHm0O4rqVOncB6gCq7xRB6cl-ZFyFuO1Zz_omx5I">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Interior &amp; Kitchen</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Dapur &amp; Ruang Makan Elegan
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Konsep open-plan dengan island marble premium, cabinetry kayu rekayasa, dan downlight warm.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Jakarta Selatan</span>
                    </span>
                    <a aria-label="Lihat detail Interior Dapur" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 3: Paviliun Menteng -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-3" data-category="renovasi rumah">
            <img alt="Paviliun Menteng - Renovasi Rumah Kolonial Heritage" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCx7IMckJgvCSKrifF6cAwnu5SHCk8c_fQHKGNlX_sASWHp996ciGlMnGwdUCRr0L6PcspLX67yJE66VB6qAovwizZxLTtlzYhfqIf_nOo6Qzcx9EiYfbfX1pl5D2BUln-_FJw8CnBBaw89HjhC0nvENsjkmAqMmAw1R3fMB26hDvgFrIhHOXTvytFnhSvXl_Eyf4v6kn3Lu7GGuBfmHrouBu33kr_X7nEAuEvq_HY37ougLaKJEeLu">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Renovasi Total</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Paviliun Menteng
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Revitalisasi rumah cagar budaya kolonial dengan perkuatan bore pile dan interior kontemporer.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Menteng, Jakarta Pusat</span>
                    </span>
                    <a aria-label="Lihat detail Paviliun Menteng" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 4: Multi-Story Residential Facade -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-4" data-category="pembangunan eksterior">
            <img alt="Proyek Hunian Bertingkat Eksklusif Surya Karya" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAUM6ebrWgmHazERXSijlCE-wfzWMQ95b35y7U9Zu0wsQr8XI0SKfxGZxRGLVrYw90mYgdSTFQCnQRSkCePkrPwLIjmPgSz2EhHdqJjy7kx50gnWj4TYW1vIupCHYiel3_BvmtevGrPzyrW9tKzODPiuaf9T_IScFETZZT01uFwVEWqoGIqklf4JT8zyrXiapGBs6zbXoz82IDGaKgfwE6trODnNfs05FyWP2WdpwY6ZD0NGJ6a-wfE">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Pembangunan High-Rise</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Hunian Bertingkat Eksklusif
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Struktur beton bertulang K-350 presisi tinggi dengan fasad modern &amp; lanskap hijau.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Kuningan, Jakarta</span>
                    </span>
                    <a aria-label="Lihat detail Hunian Bertingkat Eksklusif" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 5: Modern Tropical Villa with Reflecting Pool -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-5" data-category="pembangunan eksterior rumah">
            <img alt="Tropical Villa dengan Timber Louver dan Kolam Renang" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbqNzn3XyzpCsM9qX2-4Q4iF44b2IayfNYBdAASp70_2WchpDmi_z5Z24I0jkQ6C7vSeQfh7zKC0oWNMq4QDo2g7kwJEMYSs1CylMctEcDdoUvbGo-6qZoQmX0D1q9wmqtGwIzUFc4kDvXk4-3LTMDFrkPZcrGFNreJpTmkOJ6rRTKsba4J3O6X2Xl6k_WIO5cJHUupGrdSJg887rVUk1s-Lf37lB3-XDdsdKPoceZDJhaAzsoIayw">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Eksterior &amp; Lanskap</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Tropical Resort Villa
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Lanskap villa tropis dengan timber louver, kolam renang infinity, dan batu alam lokal.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Ubud, Bali</span>
                    </span>
                    <a aria-label="Lihat detail Tropical Resort Villa" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 6: Kediaman Senopati -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-6" data-category="interior rumah">
            <img alt="Kediaman Senopati - Interior & Void 2 Lantai" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCj-K4UjNMHXjMIZDRVYio6ByFDkzOPn0vQZMfGvf0oxxtdUccdk03pQnpNHa8MOjnGwuEmo6RH5ODA51OC916f3jku0-zv3Bu8xJHUOBt0pL8tavGpCkzv_pYymRN0QMHBl6l5u-K5Ru9rSbaDELgQiViu3WLAb6lTg9BBYQ8-6lGFUBSOmKVwwd1t28pqdNTanRAAuGz2wxNjNcXjVM-qfkA87-l5fI1n1MRMoRJjQ6HpaTwnQLK-">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Interior &amp; Ruang Keluarga</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Kediaman Senopati
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Harmonisasi open-plan microcement, void 2 lantai, dan pencahayaan aksen natural.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Kebayoran Baru, Jakarta</span>
                    </span>
                    <a aria-label="Lihat detail Kediaman Senopati" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 7: Floating Wooden Staircase Architectural Detail -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-7" data-category="interior">
            <img alt="Detail Tangga Kayu Minimalis dan Handrail Custom Surya Karya" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDIutYZVIDdb3tmEhhuc0qalJ8m1tJO32n2MKhDITkGv4jZpEl8mYQzdfwJfHyi1tYjlbvhT6Eou2s3_Zl5Btu-Ip4hunJMG71va3i9Y1g_Sht-mx7ZduBMZkA7b_GXbjyNNI8vkAdz9gihGxMPWRj7PBhktAe7ZFn2aCAyNXxzbwM5JbvYPSBGiqfcahrclUTQ3SMTebPpIpOAssl59Ry0xDUt58ir2xVxJ3LEyf6HzaRByKLt3Xj7">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Detail Interior</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Tangga Floating Minimalis
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Detail craftsmanship kayu jati presisi dengan struktur cantilever baja tersembunyi.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Pondok Indah, Jakarta</span>
                    </span>
                    <a aria-label="Lihat detail Tangga Floating Minimalis" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        <!-- Card 8: Bintaro Private House -->
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-8" data-category="pembangunan rumah eksterior">
            <img alt="Bintaro Private House - Fasad Kayu & Kanopi Baja" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIWFslpsE9hROROi8NOtMfDFRpLAF9pQSEam0cWdlNJivITjuPG4SnuUkqcbNhHDCcAqIdBBw_XLvgUiemPUeyAZhHwkyzON9izPYLUZG0QqeDs95bH0c3l8rCbB-1Gq-TEeQBuIXPM9s2n6xim89OsNil7OYpEpP8t5-mjOJacpQvkac1uoJrEbcvJio0V1QxgJrG_IoYURQKSzviBKtxZ_qZJOggoAxdop9tCeM6SKmxe4pzdSVi">
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">Pembangunan Rumah</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    Bintaro Private House
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    Hunian bertingkat 3 lantai dengan kanopi baja H-beam dan sirkulasi udara cross-ventilation.
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>Tangerang Selatan</span>
                    </span>
                    <a aria-label="Lihat detail Bintaro Private House" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

    </div>

    <!-- Load More Action -->
    <div class="mt-12 text-center animate-up">
        <button class="inline-block border border-gray-400 hover:border-[#0a192f] text-gray-800 hover:text-[#0a192f] bg-white/80 hover:bg-white px-8 py-3.5 rounded text-xs font-semibold tracking-widest uppercase transition-all duration-200 shadow-sm" type="button">
            Muat Lebih Banyak Portofolio
        </button>
    </div>
</section>
<!-- END: PortfolioGalleryGrid -->

<!-- BEGIN: CallToActionSection -->
<section class="bg-[#0b192c] text-white py-20 px-6 w-full animate-up" id="hubungi-kami">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Headline -->
        <h2 class="font-serif-heading text-4xl sm:text-5xl lg:text-6xl font-normal leading-tight text-white mb-6">
            Tertarik dengan Hasil Kerja Kami?
        </h2>
        <!-- Subheading description -->
        <p class="text-sm sm:text-base text-gray-300 max-w-2xl mx-auto font-light leading-relaxed mb-10">
            Konsultasikan visi hunian atau rencana renovasi rumah Anda bersama tim arsitek dan kontraktor berlisensi Surya Karya. Dapatkan survei lokasi awal dan rancangan anggaran biaya transparan.
        </p>
        <!-- CTA Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-6">
            <a class="w-full sm:w-auto inline-flex items-center justify-center space-x-2.5 bg-[#d4af37] hover:bg-[#c19b2e] text-[#0b192c] font-semibold px-7 py-3.5 rounded text-xs uppercase tracking-widest transition-all duration-150 shadow-md" href="https://wa.me/6281239401899" rel="noopener noreferrer" target="_blank">
                <svg class="w-4 h-4 text-[#0b192c]" fill="currentColor" viewBox="0 0 20 20">
                    <path clip-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zm-4 0h-2v2h2V9z" fill-rule="evenodd"></path>
                </svg>
                <span>Konsultasi Sekarang</span>
            </a>
            <a class="w-full sm:w-auto inline-flex items-center justify-center border border-slate-600 hover:border-white text-gray-200 hover:text-white px-7 py-3.5 rounded text-xs font-semibold uppercase tracking-widest transition-all duration-150 bg-[#14263e]" href="{{ route('alur-kerja') }}">
                Pelajari Alur Kerja
            </a>
        </div>
    </div>
</section>
<!-- END: CallToActionSection -->

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabBtns = document.querySelectorAll('#portfolio-tabs .tab-btn');
        const items = document.querySelectorAll('#portfolio-grid .portfolio-item');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter');

                // Update active tab style
                tabBtns.forEach(b => {
                    b.classList.remove('text-[#0a192f]', 'border-[#0a192f]', 'font-bold');
                    b.classList.add('text-gray-500', 'border-transparent');
                });
                this.classList.remove('text-gray-500', 'border-transparent');
                this.classList.add('text-[#0a192f]', 'border-[#0a192f]', 'font-bold');

                // Filter items
                items.forEach(item => {
                    const categories = item.getAttribute('data-category').split(' ');
                    if (filter === 'all' || categories.includes(filter)) {
                        item.classList.remove('hide-item');
                    } else {
                        item.classList.add('hide-item');
                    }
                });
            });
        });

        // Interactive Smooth 3D Floating Tilt on Hover
        const cards = document.querySelectorAll('.portfolio-card');
        cards.forEach(card => {
            card.addEventListener('mousemove', function (e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;

                const rotateX = (y / (rect.height / 2)) * -6;
                const rotateY = (x / (rect.width / 2)) * 6;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translate3d(0, -10px, 15px) scale(1.02)`;
            });

            card.addEventListener('mouseleave', function () {
                card.style.transform = '';
            });
        });
    });
</script>
@endpush
