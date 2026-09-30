<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Portal - Surya Karya')</title>

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
    </style>
    @stack('styles')
</head>
<body class="bg-background font-body-base text-body-base text-on-surface antialiased selection:bg-primary-container selection:text-on-primary">
    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-screen w-72 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-50 flex flex-col justify-between overflow-y-auto">
        <!-- Sidebar Brand Header -->
        <div class="p-6 pb-4 flex items-center gap-3 border-b border-surface-container-high shrink-0">
            <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-slate-200 shadow-sm flex items-center justify-center bg-white">
                <img src="{{ asset('images/logo.jpg') }}" alt="Surya Karya Logo" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col">
                <span class="text-base font-bold tracking-wider text-[#0a369d] leading-none uppercase" style="font-family: 'Cormorant Garamond', serif;">SURYA KARYA</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex flex-col gap-1 px-4 py-3 flex-1 overflow-y-auto" style="font-family: 'Inter', sans-serif;">
            
            <!-- Dashboard -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/dashboard') || request()->is('admin') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ url('/admin/dashboard') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect height="7" rx="1" width="7" x="3" y="3"></rect><rect height="7" rx="1" width="7" x="14" y="3"></rect><rect height="7" rx="1" width="7" x="14" y="14"></rect><rect height="7" rx="1" width="7" x="3" y="14"></rect></svg>
                <span>Dashboard</span>
            </a>

            <!-- Pesanan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/pesanan*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="#">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" x2="8" y1="13" y2="13"></line><line x1="16" x2="8" y1="17" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span>Pesanan</span>
            </a>

            <!-- Pengaturan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/settings*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.settings.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span>Pengaturan</span>
            </a>

            <!-- Layanan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/layanan*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="#">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                <span>Layanan</span>
            </a>

            <!-- Bangunan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/pembangunan*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.pembangunan.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path><path d="M9 9h1"></path><path d="M9 13h1"></path><path d="M9 17h1"></path><path d="M14 9h1"></path><path d="M14 13h1"></path><path d="M14 17h1"></path></svg>
                <span>Bangunan</span>
            </a>

            <!-- Renovasi -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/renovasi*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.renovasi.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                <span>Renovasi</span>
            </a>

            <!-- Spesifikasi -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/spesifikasi-bangunan*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.spesifikasi-bangunan.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect height="18" rx="2" width="18" x="3" y="3"></rect><line x1="3" x2="21" y1="9" y2="9"></line><line x1="9" x2="9" y1="21" y2="9"></line></svg>
                <span>Spesifikasi</span>
            </a>

            <!-- Standar Mutu -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/standar-mutu*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.standar-mutu.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>
                <span>Standar Mutu</span>
            </a>

            <!-- Alur Kerja sama -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/alur-kerjasama*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="#">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><polyline points="16 11 18 13 22 9"></polyline></svg>
                <span>Alur Kerja sama</span>
            </a>

            <!-- Portofolio -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/portofolio') || request()->is('admin/portofolio/*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.portofolio.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect height="18" rx="2" width="18" x="3" y="3"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                <span>Portofolio</span>
            </a>

            <!-- Kategori Portofolio -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/portofolio-category*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.portofolio-category.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                <span>Kategori Portofolio</span>
            </a>

            <!-- Hero Title -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/hero-title*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.hero-title.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" x2="4" y1="22" y2="15"></line></svg>
                <span>Hero Title</span>
            </a>

            <!-- FAQ -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/faq*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="#">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" x2="12.01" y1="17" y2="17"></line></svg>
                <span>FAQ</span>
            </a>

            <!-- Sosial Media -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/media*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.media.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line></svg>
                <span>Sosial Media</span>
            </a>
        </nav>

        <div class="p-4 px-6 border-t border-surface-container-high shrink-0">
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT text-rose-600 hover:bg-rose-50 font-medium text-sm transition-colors" href="#">
                <svg class="w-5 h-5 shrink-0 text-rose-600" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="pl-72">
        <!-- Header Topbar (Clean layout without text/avatar) -->
        <header class="fixed top-0 left-72 right-0 h-20 bg-surface/80 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40 flex items-center justify-between px-space-xl">
            <div class="flex items-center gap-4">
            </div>
            <div class="flex items-center gap-6" style="font-family: 'Inter', sans-serif;">
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="w-full pt-20 px-space-xl pb-space-3xl min-h-screen bg-background">
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
</body>
</html>
