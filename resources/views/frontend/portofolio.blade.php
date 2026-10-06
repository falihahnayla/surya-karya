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
<section class="pt-28 pb-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-purpose="portfolio-intro">
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
            @foreach($categories as $cat)
            <button class="tab-btn pb-3 text-gray-500 hover:text-[#0a192f] border-b-2 border-transparent transition-colors whitespace-nowrap" data-filter="cat-{{ $cat->id }}" type="button">
                {{ $cat->title }}
            </button>
            @endforeach
        </div>
    </div>
</section>
<!-- END: HeroPortfolioIntro -->

<!-- BEGIN: PortfolioGalleryGrid -->
<section class="pb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-purpose="portfolio-grid-section">
    <!-- 4-Column Responsive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="portfolio-grid">

        @forelse($portofolios as $index => $project)
        <article class="portfolio-item portfolio-card relative group rounded-xl overflow-hidden bg-[#06101e] aspect-[3/4] sm:aspect-auto sm:h-[420px] shadow-sm flex flex-col justify-end p-5 animate-up card-delay-{{ ($index % 8) + 1 }}" data-category="cat-{{ $project->category_id }}">
            @if(!empty($project->image))
            <img alt="{{ $project->title }}" class="absolute inset-0 w-full h-full object-cover object-center brightness-[0.85]" src="{{ (str_starts_with($project->image, 'http://') || str_starts_with($project->image, 'https://')) ? $project->image : asset($project->image) }}">
            @endif
            <div class="absolute inset-0 card-gradient-overlay pointer-events-none"></div>
            
            <div class="relative z-10">
                <div class="flex items-center space-x-2 mb-2.5">
                    <span class="w-1.5 h-3.5 bg-[#d4af37] rounded-xs inline-block"></span>
                    <span class="text-[10px] font-bold tracking-[0.18em] uppercase text-white/90">{{ $project->category->title ?? 'PORTOFOLIO' }}</span>
                </div>
                <h2 class="font-serif-heading text-2xl font-bold text-white leading-tight mb-2">
                    {{ $project->title }}
                </h2>
                <p class="text-xs text-gray-200/90 line-clamp-2 leading-relaxed font-light mb-4">
                    {{ $project->description ?? '-' }}
                </p>
                <div class="flex items-center justify-between pt-2 border-t border-white/15">
                    <span class="flex items-center text-[11px] text-gray-300 font-medium space-x-1.5">
                        <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                        </svg>
                        <span>{{ $project->location ?? 'Indonesia' }}</span>
                    </span>
                    <a aria-label="Lihat detail {{ $project->title }}" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white text-white hover:text-[#06101e] backdrop-blur-sm flex items-center justify-center transition-all duration-200 shadow" href="#">
                        <svg class="w-3.5 h-3.5 -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </article>
        @empty
        <div class="col-span-full text-center py-16 bg-white/50 rounded-xl border border-dashed border-gray-300">
            <p class="text-gray-500 text-sm font-medium">Belum ada portofolio yang ditampilkan saat ini.</p>
        </div>
        @endforelse

    </div>

    @if($portofolios->count() > 8)
    <!-- Load More Action -->
    <div class="mt-12 text-center animate-up">
        <button class="inline-block border border-gray-400 hover:border-[#0a192f] text-gray-800 hover:text-[#0a192f] bg-white/80 hover:bg-white px-8 py-3.5 rounded text-xs font-semibold tracking-widest uppercase transition-all duration-200 shadow-sm" type="button">
            Muat Lebih Banyak Portofolio
        </button>
    </div>
    @endif
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

<!-- BEGIN: Portfolio Lightbox Modal -->
<div id="portfolio-lightbox" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-black/90 backdrop-blur-md transition-all duration-300 opacity-0 pointer-events-none">

    <!-- Close Button -->
    <button id="lightbox-close" type="button" aria-label="Tutup Tampilan Penuh" class="absolute top-6 right-6 z-50 w-11 h-11 rounded-full bg-white/10 hover:bg-white text-white hover:text-black flex items-center justify-center backdrop-blur-md transition-all shadow-lg border border-white/20 hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Modal Card Container -->
    <div id="lightbox-container" class="relative max-w-5xl w-full max-h-[85vh] rounded-2xl overflow-hidden shadow-2xl bg-[#06101e] border border-white/15 flex flex-col justify-end transform scale-95 transition-all duration-500 ease-out">
        
        <!-- Expanded High-Res Image -->
        <img id="lightbox-img" src="" alt="Portofolio Fullscreen" class="w-full h-full object-cover max-h-[80vh] min-h-[400px] object-center">
        
        <!-- Gradient Overlay over Image for Readability -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#06101e] via-[#06101e]/60 to-transparent pointer-events-none"></div>

        <!-- Animated Text & Meta Content Overlay -->
        <div id="lightbox-content" class="absolute bottom-0 left-0 right-0 p-6 sm:p-10 z-10 space-y-3 transform translate-y-6 opacity-0 transition-all duration-500 delay-150">
            <!-- Category Tag & Location -->
            <div class="flex flex-wrap items-center gap-3">
                <span id="lightbox-category" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-[#d4af37] text-[#06101e]">
                    Pembangunan Baru
                </span>
                <span id="lightbox-location" class="flex items-center text-xs text-gray-300 font-medium space-x-1.5 bg-black/40 px-3.5 py-1 rounded-full backdrop-blur-sm border border-white/10">
                    <svg class="w-3.5 h-3.5 text-[#d4af37] shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" fill-rule="evenodd"></path>
                    </svg>
                    <span id="lightbox-location-text">Badung, Bali</span>
                </span>
            </div>

            <!-- Title -->
            <h2 id="lightbox-title" class="font-serif-heading text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                Villa Modern Canggu
            </h2>

            <!-- Description -->
            <p id="lightbox-description" class="text-sm sm:text-base text-gray-200/90 font-light leading-relaxed max-w-3xl">
                Hunian 2 lantai 420 m², fasad kaca lebar dengan struktur beton ekspos minimalis modern.
            </p>
        </div>
    </div>
</div>
<!-- END: Portfolio Lightbox Modal -->

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

        // Fullscreen Portfolio Lightbox Trigger Logic
        const lightbox = document.getElementById('portfolio-lightbox');
        const lightboxContainer = document.getElementById('lightbox-container');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCategory = document.getElementById('lightbox-category');
        const lightboxLocationText = document.getElementById('lightbox-location-text');
        const lightboxTitle = document.getElementById('lightbox-title');
        const lightboxDesc = document.getElementById('lightbox-description');
        const lightboxContent = document.getElementById('lightbox-content');
        const lightboxClose = document.getElementById('lightbox-close');

        function openLightbox(card) {
            const img = card.querySelector('img');
            const categorySpan = card.querySelector('.text-\\[10px\\]');
            const title = card.querySelector('h2');
            const desc = card.querySelector('p');
            const locationSpan = card.querySelector('.border-t span span');

            if (img) {
                lightboxImg.src = img.src;
                lightboxImg.alt = img.alt || 'Detail Portofolio';
            }
            if (categorySpan) {
                lightboxCategory.textContent = categorySpan.textContent.trim();
            }
            if (title) {
                lightboxTitle.textContent = title.textContent.trim();
            }
            if (desc) {
                lightboxDesc.textContent = desc.textContent.trim();
            }
            if (locationSpan) {
                lightboxLocationText.textContent = locationSpan.textContent.trim();
            }

            lightbox.classList.remove('hidden', 'pointer-events-none');
            requestAnimationFrame(() => {
                lightbox.classList.remove('opacity-0');
                lightboxContainer.classList.remove('scale-95');
                lightboxContainer.classList.add('scale-100');
                lightboxContent.classList.remove('translate-y-6', 'opacity-0');
            });
        }

        function closeLightbox() {
            lightboxContent.classList.add('translate-y-6', 'opacity-0');
            lightboxContainer.classList.remove('scale-100');
            lightboxContainer.classList.add('scale-95');
            lightbox.classList.add('opacity-0');

            setTimeout(() => {
                lightbox.classList.add('hidden', 'pointer-events-none');
            }, 300);
        }

        // Bind click event to arrow navigation buttons inside cards
        document.querySelectorAll('.portfolio-card a[aria-label^="Lihat detail"]').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const card = this.closest('.portfolio-card');
                if (card) {
                    openLightbox(card);
                }
            });
        });

        if (lightboxClose) {
            lightboxClose.addEventListener('click', closeLightbox);
        }

        if (lightbox) {
            lightbox.addEventListener('click', function (e) {
                if (e.target === lightbox) {
                    closeLightbox();
                }
            });
        }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox && !lightbox.classList.contains('hidden')) {
                closeLightbox();
            }
        });
    });
</script>
@endpush
