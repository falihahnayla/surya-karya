<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal - Surya Karya')</title>

    @php
        $siteSetting = \App\Models\Setting::first();
        $favIconUrl = ($siteSetting && !empty($siteSetting->favicon)) ? (str_starts_with($siteSetting->favicon, 'http') ? $siteSetting->favicon : asset($siteSetting->favicon)) : asset('images/favicon.ico');
    @endphp
    <link rel="icon" href="{{ $favIconUrl }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100..900&family=Space+Grotesk:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN with Design System Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "surface-tint": "#3757bd",
                    "tertiary-fixed-dim": "#bcc7de",
                    "on-primary-fixed": "#00154f",
                    "on-tertiary-fixed": "#111c2d",
                    "secondary-fixed": "#dae2fd",
                    "on-secondary-fixed": "#131b2e",
                    "on-error-container": "#93000a",
                    "primary-fixed-dim": "#b6c4ff",
                    "error": "#ba1a1a",
                    "inverse-surface": "#303033",
                    "surface-bright": "#fbf8fc",
                    "tertiary-fixed": "#d8e3fb",
                    "outline-variant": "#c4c5d5",
                    "primary-container": "#0a369d",
                    "surface-container-highest": "#e4e1e6",
                    "on-secondary-fixed-variant": "#3f465c",
                    "surface-container-low": "#f6f2f7",
                    "on-primary-container": "#91a8ff",
                    "surface-dim": "#dcd9dd",
                    "outline": "#747684",
                    "surface-container-high": "#eae7eb",
                    "on-error": "#ffffff",
                    "primary": "#002271",
                    "background": "#fbf8fc",
                    "on-tertiary": "#ffffff",
                    "error-container": "#ffdad6",
                    "on-primary": "#ffffff",
                    "on-surface": "#1b1b1e",
                    "inverse-on-surface": "#f3f0f4",
                    "tertiary": "#202b3d",
                    "secondary": "#565e74",
                    "secondary-fixed-dim": "#bec6e0",
                    "on-background": "#1b1b1e",
                    "secondary-container": "#dae2fd",
                    "surface-container-lowest": "#ffffff",
                    "on-surface-variant": "#444653",
                    "surface-variant": "#e4e1e6",
                    "tertiary-container": "#364154",
                    "on-secondary-container": "#5c647a",
                    "on-primary-fixed-variant": "#173da4",
                    "on-secondary": "#ffffff",
                    "primary-fixed": "#dce1ff",
                    "on-tertiary-container": "#a2adc4",
                    "inverse-primary": "#b6c4ff",
                    "surface": "#fbf8fc",
                    "surface-container": "#f0edf1",
                    "on-tertiary-fixed-variant": "#3c475a"
                },
                borderRadius: {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
                spacing: {
                    "space-xs": "0.5rem",
                    "space-sm": "0.75rem",
                    "space-2xs": "0.25rem",
                    "space-md": "1rem",
                    "space-4xl": "6.5rem",
                    "space-lg": "1.5rem",
                    "gutter-mobile": "1.25rem",
                    "gutter-desktop": "2rem",
                    "space-3xl": "4.5rem",
                    "space-xl": "2rem",
                    "container-max": "1320px",
                    "space-2xl": "3rem"
                },
                fontFamily: {
                    "display-hero-mobile": ["Space Grotesk"],
                    "body-sm": ["Plus Jakarta Sans"],
                    "headline-lg": ["Space Grotesk"],
                    "headline-xl-mobile": ["Space Grotesk"],
                    "body-base": ["Plus Jakarta Sans"],
                    "label-editorial": ["Plus Jakarta Sans"],
                    "subheading": ["Plus Jakarta Sans"],
                    "headline-md": ["Space Grotesk"],
                    "display-hero": ["Space Grotesk"],
                    "label-action": ["Plus Jakarta Sans"],
                    "headline-xl": ["Space Grotesk"],
                    "body-lg": ["Plus Jakarta Sans"]
                }
            }
        }
    };
    </script>
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }

        /* Seamless Responsive Mobile & Tablet Off-canvas Sidebar */
        @media (max-width: 1023.98px) {
            #sk-admin-sidebar {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                bottom: 0 !important;
                width: 18rem !important;
                max-width: 82vw !important;
                transform: translateX(-100%) !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                z-index: 50 !important;
                box-shadow: none !important;
            }
            #sk-admin-sidebar.sidebar-open {
                transform: translateX(0) !important;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 8px 10px -6px rgba(0, 0, 0, 0.2) !important;
            }
            .admin-layout-wrapper {
                padding-left: 0 !important;
            }
            .admin-topbar {
                left: 0 !important;
            }
        }
        @media (min-width: 1024px) {
            #sk-admin-sidebar {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 18rem !important;
                transform: translateX(0) !important;
            }
            .admin-layout-wrapper {
                padding-left: 18rem !important;
            }
            .admin-topbar {
                left: 18rem !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background font-body-base text-body-base text-on-surface antialiased selection:bg-primary-container selection:text-on-primary">

    @php
        $adminLogoSetting = \App\Models\Setting::first();
        $adminLogoUrl = asset('images/logo.jpg');
        if (filled($adminLogoSetting?->logo)) {
            $adminLogoUrl = (str_starts_with($adminLogoSetting->logo, 'http://') || str_starts_with($adminLogoSetting->logo, 'https://')) ? $adminLogoSetting->logo : asset($adminLogoSetting->logo);
        }
        $adminCompany = filled($adminLogoSetting?->company) ? $adminLogoSetting->company : 'Surya Karya';
    @endphp
    <!-- BEGIN: Page Loader -->
    <div id="sk-page-loader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-[#06101e] text-white transition-opacity duration-500 ease-out">
        <div class="flex flex-col items-center text-center px-6">
            <!-- Logo Emblem with Golden Ring Pulse -->
            <div class="relative mb-5">
                <img src="{{ $adminLogoUrl }}" 
                     alt="{{ $adminCompany }} Emblem" 
                     class="w-16 h-16 rounded-full object-cover shadow-2xl ring-2 ring-[#d4af37]/70 p-0.5">
                <div class="absolute inset-0 rounded-full border border-[#d4af37]/40 animate-ping opacity-35"></div>
            </div>

            <!-- Brand Serif Title -->
            <h2 class="heading-serif text-3xl sm:text-4xl font-semibold tracking-wider uppercase text-white leading-none mb-2" style="font-family: 'Cormorant Garamond', Georgia, serif;">
                {{ $adminCompany }}
            </h2>

            <!-- Subtitle Eyebrow -->
            <span class="text-[10px] sm:text-xs font-semibold tracking-[0.3em] uppercase text-[#d4af37]">
                Admin Management Portal
            </span>

            <!-- Minimalist Gold Progress Bar -->
            <div class="w-44 h-[2px] bg-white/10 rounded-full overflow-hidden mt-6 relative">
                <div id="sk-loader-bar" class="h-full bg-gradient-to-r from-[#dfcfb9] via-[#d4af37] to-[#dfcfb9] rounded-full w-0 transition-all duration-300 ease-out"></div>
            </div>
        </div>
    </div>
    <!-- END: Page Loader -->

    <!-- Sidebar Partial -->
    @include('partials.sidebar')

    <!-- Sidebar Mobile Backdrop -->
    <div id="sk-sidebar-backdrop" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden lg:hidden opacity-0 transition-opacity duration-300 ease-in-out" aria-hidden="true"></div>

    <!-- Content Wrapper -->
    <div class="admin-layout-wrapper pl-0 lg:pl-72 transition-[padding] duration-300 min-h-screen flex flex-col">
        <!-- Header Topbar -->
        <header class="admin-topbar fixed top-0 left-0 lg:left-72 right-0 h-16 sm:h-20 bg-surface/85 backdrop-blur-xl border-b border-surface-container-high/60 shadow-[0_1px_8px_rgba(0,0,0,0.03)] z-30 flex items-center justify-between px-4 sm:px-6 lg:px-space-xl transition-[left] duration-300">
            <div class="flex items-center gap-3">
                <!-- Hamburger Button (Mobile & Tablet) -->
                <button id="sk-sidebar-toggle" type="button" class="lg:hidden p-2 rounded-DEFAULT text-slate-700 hover:text-primary hover:bg-slate-100 transition-colors focus:outline-none focus:ring-2 focus:ring-[#0a2569]" aria-label="Buka Menu Navigasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="flex items-center gap-2.5 lg:hidden">
                    <img src="{{ $adminLogoUrl }}" alt="{{ $adminCompany }}" class="w-7 h-7 rounded-full object-cover border border-slate-200">
                    <span class="text-sm font-bold tracking-wider text-[#0a369d] uppercase truncate max-w-[160px] sm:max-w-xs" style="font-family: 'Cormorant Garamond', serif;">{{ $adminCompany }}</span>
                </div>
            </div>
            <div class="flex items-center gap-4" style="font-family: 'Inter', sans-serif;">
                <span class="hidden sm:inline-block text-xs uppercase tracking-wider text-outline font-medium">Portal Admin</span>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="w-full pt-20 sm:pt-24 px-4 sm:px-6 lg:px-space-xl pb-space-3xl min-h-screen bg-background">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-DEFAULT bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between" style="font-family: 'Inter', sans-serif;">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-DEFAULT bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between" style="font-family: 'Inter', sans-serif;">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')

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
            setTimeout(finishLoader, 1200);

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

            document.addEventListener('submit', function (e) {
                startLoader();
            });

            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    finishLoader();
                }
            });
        })();

        // Seamless Responsive Mobile & Tablet Sidebar Toggle
        (function () {
            const sidebar = document.getElementById('sk-admin-sidebar');
            const toggleBtn = document.getElementById('sk-sidebar-toggle');
            const closeBtn = document.getElementById('sk-sidebar-close');
            const backdrop = document.getElementById('sk-sidebar-backdrop');

            if (!sidebar) return;

            function openSidebar() {
                sidebar.classList.add('sidebar-open');
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                if (backdrop) {
                    backdrop.classList.remove('hidden');
                    requestAnimationFrame(function () {
                        backdrop.classList.remove('opacity-0');
                        backdrop.classList.add('opacity-100');
                    });
                }
                document.body.classList.add('overflow-hidden');
            }

            function closeSidebar() {
                sidebar.classList.remove('sidebar-open');
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                if (backdrop) {
                    backdrop.classList.remove('opacity-100');
                    backdrop.classList.add('opacity-0');
                    setTimeout(function () {
                        backdrop.classList.add('hidden');
                    }, 300);
                }
                document.body.classList.remove('overflow-hidden');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                openSidebar();
            });
            if (closeBtn) closeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                closeSidebar();
            });
            if (backdrop) backdrop.addEventListener('click', closeSidebar);

            // Close on escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && sidebar.classList.contains('sidebar-open')) {
                    closeSidebar();
                }
            });

            // Auto close when any link in sidebar is clicked on mobile/tablet
            sidebar.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (window.innerWidth < 1024) {
                        closeSidebar();
                    }
                });
            });

            // Reset when resized to desktop (>= 1024px)
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 1024) {
                    closeSidebar();
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
