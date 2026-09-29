<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Surya Karya')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#0B192C',
                            navyDeep: '#06101e',
                            dark: '#071324',

                            royalBlue: '#0a369d',

                            gold: '#d4af37',
                            tan: '#D8C7A5',

                            cream: '#f5efe6',
                            sand: '#e7d8c9',
                            sandLight: '#f9f6f0',
                            bgLight: '#faf9f6',

                            charcoal: '#1f2937',
                            muted: '#64748b',
                            grayLight: '#f3f4f6',

                            borderGold: '#d4af37',

                            navy: {
                                800: '#0F284E',
                                900: '#0A192F',
                                950: '#071224',
                            },

                            warm: {
                                50: '#FAF9F6',
                                100: '#F6F5F2',
                                200: '#EEECE7',
                            }
                        }
                    },
                    fontFamily: {
                        serif: ['Cormorant Garamond', 'Georgia', 'serif'],
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="{{ asset('css/scroll-animation.css') }}" rel="stylesheet"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1f2937;
        }

        .heading-serif,
        .font-cormorant {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }

        .hero-gradient {
            background: linear-gradient(
                90deg,
                rgba(2, 6, 23, 0.90) 0%,
                rgba(2, 6, 23, 0.65) 45%,
                rgba(2, 6, 23, 0.20) 100%
            );
        }

        .card-watermark {
            position: absolute;
            right: -20px;
            bottom: -35px;
            font-size: 140px;
            line-height: 1;
            font-family: 'Cormorant Garamond', serif;
            color: rgba(15, 23, 42, 0.035);
            pointer-events: none;
        }

        .bg-grid-pattern {
            background-size: 32px 32px;
            background-image:
                linear-gradient(to right, rgba(14, 30, 56, 0.035) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(14, 30, 56, 0.035) 1px, transparent 1px);
        }

        details summary::-webkit-details-marker {
            display: none;
        }

        details summary {
            list-style: none;
        }

        details[open] summary .chevron-icon {
            transform: rotate(180deg);
        }
    </style>

    @stack('styles')
</head>

<body class="antialiased overflow-x-hidden">

    <!-- BEGIN: Page Loader - The Architectural Blueprint Reveal -->
    <div id="sk-page-loader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-[#06101e] text-white transition-opacity duration-500 ease-out">
        <div class="flex flex-col items-center text-center px-6">
            <!-- Logo Emblem with Golden Ring Pulse -->
            <div class="relative mb-5">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2KLbLTxsEJf3LH3g7OCe1Q9xsz15bakNmmuzw7uFHTpFd6k0-TeLTj2GP9BNIIEf3bmhsRRyp_-yLtzeYVIz8AqLQ8RcxkN8bmNeAD2ExnOpix2Gc-BBuqPtnPxG-4TAGVfZW9Uj_dpEZI4tlIwDV7mjPi_xsGES1kOGE11UHOwLERF57omZMgcuiz4u3PA1xBu3EutZpQrTjRbcvKzMT_kw3AbzL2yOoN_m0Br0ykTSUduAOqCnmCm7dW3M0XCECUA" 
                     alt="Surya Karya Emblem" 
                     class="w-16 h-16 rounded-full object-cover shadow-2xl ring-2 ring-[#d4af37]/70 p-0.5">
                <div class="absolute inset-0 rounded-full border border-[#d4af37]/40 animate-ping opacity-35"></div>
            </div>

            <!-- Brand Serif Title -->
            <h2 class="heading-serif text-3xl sm:text-4xl font-semibold tracking-wider uppercase text-white leading-none mb-2">
                Surya Karya
            </h2>

            <!-- Subtitle Eyebrow -->
            <span class="text-[10px] sm:text-xs font-semibold tracking-[0.3em] uppercase text-[#d4af37]">
                Technical Specifications &amp; Construction
            </span>

            <!-- Minimalist Gold Progress Bar -->
            <div class="w-44 h-[2px] bg-white/10 rounded-full overflow-hidden mt-6 relative">
                <div id="sk-loader-bar" class="h-full bg-gradient-to-r from-[#dfcfb9] via-[#d4af37] to-[#dfcfb9] rounded-full w-0 transition-all duration-300 ease-out"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Loader -->

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
        <script src="/js/scroll-animation.js"></script>
    @stack('scripts')

    <!-- BEGIN: Realistic Minimalist Floating Consultation Avatar CTA -->
    <div class="fixed bottom-6 right-6 sm:bottom-8 sm:right-8 z-50">
        <a href="https://wa.me/6281239401899?text=Halo%20Surya%20Karya,%20saya%20ingin%20konsultasi%20mengenai%20proyek%20pembangunan/renovasi"
           target="_blank"
           rel="noopener noreferrer"
           aria-label="Konsultasi Tim Arsitek via WhatsApp"
           class="group relative flex items-center gap-3.5 bg-[#06101e]/90 hover:bg-[#0b192c] text-white p-2 pr-5 rounded-full border border-slate-700/60 hover:border-[#d4af37]/70 shadow-2xl backdrop-blur-xl transition-all duration-300 transform hover:-translate-y-1 active:scale-95">
            
            <!-- Avatar Container with 3D Ring & Online Status -->
            <div class="relative shrink-0">
                <img src="{{ asset('images/consultant_avatar.jpg') }}" 
                     alt="Konsultan Arsitek Surya Karya" 
                     class="w-11 h-11 sm:w-12 sm:h-12 rounded-full object-cover shadow-md ring-2 ring-[#d4af37]/60 group-hover:scale-105 transition-transform duration-300">
                
                <!-- Minimalist Green Status Dot -->
                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-[#06101e] rounded-full shadow-sm"></span>
            </div>

            <!-- Typography & Text Details -->
            <div class="flex flex-col text-left">
                <div class="flex items-center space-x-1.5 mb-0.5">
                    <span class="text-[10px] font-semibold tracking-[0.2em] uppercase text-[#d4af37]">KONSULTASI</span>
                    <span class="w-1 h-1 bg-emerald-400 rounded-full inline-block"></span>
                </div>
                <span class="text-xs sm:text-sm font-medium text-slate-100 group-hover:text-white transition-colors leading-tight">
                    Tim Perencana
                </span>
            </div>

            <!-- Discreet 3D Floating WhatsApp Icon Badge -->
            <div class="w-7 h-7 rounded-full bg-white/10 group-hover:bg-[#d4af37] text-slate-300 group-hover:text-[#06101e] flex items-center justify-center transition-all duration-300 ml-1 shrink-0">
                <i class="fa-brands fa-whatsapp text-sm"></i>
            </div>
        </a>
    </div>
    <!-- END: Realistic Minimalist Floating Consultation Avatar CTA -->

    <script>
        (function () {
            const loader = document.getElementById('sk-page-loader');
            const loaderBar = document.getElementById('sk-loader-bar');

            function startLoader() {
                if (loaderBar) {
                    loaderBar.style.transition = 'width 0.4s ease-out';
                    loaderBar.style.width = '75%';
                }
                if (loader) {
                    loader.classList.remove('opacity-0', 'pointer-events-none');
                }
            }

            function finishLoader() {
                if (loaderBar) {
                    loaderBar.style.width = '100%';
                }
                setTimeout(function () {
                    if (loader) {
                        loader.classList.add('opacity-0', 'pointer-events-none');
                    }
                }, 350);
            }

            if (loaderBar) {
                setTimeout(function () { loaderBar.style.width = '45%'; }, 50);
                setTimeout(function () { loaderBar.style.width = '85%'; }, 200);
            }

            window.addEventListener('load', finishLoader);
            setTimeout(finishLoader, 1500);

            document.addEventListener('click', function (e) {
                const link = e.target.closest('a');
                if (!link) return;

                const href = link.getAttribute('href');
                const target = link.getAttribute('target');

                if (!href || href.startsWith('#') || href.startsWith('javascript:') || href.startsWith('tel:') || href.startsWith('mailto:') || target === '_blank') {
                    return;
                }

                startLoader();
            });

            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    finishLoader();
                }
            });
        })();
    </script>

</body>
</html>