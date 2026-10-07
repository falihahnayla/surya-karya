    @php
        $sidebarSetting = \App\Models\Setting::first();
        $sidebarCompany = filled($sidebarSetting?->company) ? $sidebarSetting->company : 'SURYA KARYA';
        $sidebarLogo = asset('images/logo.jpg');
        if (filled($sidebarSetting?->logo)) {
            $sidebarLogo = (str_starts_with($sidebarSetting->logo, 'http://') || str_starts_with($sidebarSetting->logo, 'https://')) ? $sidebarSetting->logo : asset($sidebarSetting->logo);
        }
    @endphp
    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 h-screen w-72 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-50 flex flex-col justify-between overflow-y-auto">
        <!-- Sidebar Brand Header -->
        <div class="p-6 pb-4 flex items-center gap-3 border-b border-surface-container-high shrink-0">
            <div class="w-10 h-10 rounded-full overflow-hidden shrink-0 border border-slate-200 shadow-sm flex items-center justify-center bg-white">
                <img src="{{ $sidebarLogo }}" alt="{{ $sidebarCompany }} Logo" class="w-full h-full object-cover">
            </div>
            <div class="flex flex-col">
                <span class="text-base font-bold tracking-wider text-[#0a369d] leading-none uppercase" style="font-family: 'Cormorant Garamond', serif;">{{ $sidebarCompany }}</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex flex-col gap-1 px-4 py-3 flex-1 overflow-y-auto" style="font-family: 'Inter', sans-serif;">
            
            <!-- Dashboard -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->routeIs('admin.dashboard') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.dashboard') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect height="7" rx="1" width="7" x="3" y="3"></rect><rect height="7" rx="1" width="7" x="14" y="3"></rect><rect height="7" rx="1" width="7" x="14" y="14"></rect><rect height="7" rx="1" width="7" x="3" y="14"></rect></svg>
                <span>Dashboard</span>
            </a>

            <!-- Order -->
        <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/orders*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.orders.index') }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" x2="8" y1="13" y2="13"></line><line x1="16" x2="8" y1="17" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            <span>Order</span>
        </a>

            <!-- Pengaturan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/settings*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.settings.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span>Pengaturan</span>
            </a>

            <!-- Home -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/home*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.home.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M5 10v10a1 1 0 0 0 1 1h3v-6h6v6h3a1 1 0 0 0 1-1V10"></path></svg>
                <span>Home</span>
            </a>

           <!-- Visi & Misi -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/visi-misi*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.visi-misi.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                <span>Visi &amp; Misi</span>
            </a>

            <!-- Quick Links -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/quick-links*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.quick-links.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path stroke-linecap="round" stroke-linejoin="round" d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                <span>Quick Links</span>
            </a>

            <!-- Service -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/service*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.service.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0 1 12 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2m4 6h.01M5 20h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"></path></svg>
                <span>Service</span>
            </a>

            <!-- Layanan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/layanan*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.layanan.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                <span>Layanan</span>
            </a>

            <!-- Pembangunan -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/pembangunan*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.pembangunan.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path><path d="M9 9h1"></path><path d="M9 13h1"></path><path d="M9 17h1"></path><path d="M14 9h1"></path><path d="M14 13h1"></path><path d="M14 17h1"></path></svg>
                <span>Pembangunan</span>
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
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/alur-kerja*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors"
            href="{{ route('admin.alur-kerja.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    <polyline points="16 11 18 13 22 9"></polyline>
                </svg>
                <span>Alur Kerja sama</span>
            </a>

            <!-- Portofolio (Kategori & Karya) -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/portofolio*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.portofolio.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><rect height="18" rx="2" width="18" x="3" y="3"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                <span>Portofolio</span>
            </a>

            <!-- Hero Title -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/hero-title*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors" href="{{ route('admin.hero-title.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"></path><line x1="4" x2="4" y1="22" y2="15"></line></svg>
                <span>Hero Title</span>
            </a>

           <!-- FAQ -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/faqs*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors"
            href="{{ route('admin.faqs.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" x2="12.01" y1="17" y2="17"></line>
                </svg>
                <span>FAQ</span>
            </a>

            <!-- Kategori FAQ -->
            <a class="flex items-center gap-3 px-3.5 py-2.5 rounded-DEFAULT {{ request()->is('admin/faq_categories*') ? 'bg-[#0a2569] text-white font-medium' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-50 font-normal' }} text-sm transition-colors"
            href="{{ route('admin.faq_categories.index') }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path d="M4 6h16"></path>
                    <path d="M4 12h16"></path>
                    <path d="M4 18h16"></path>
                </svg>
                <span>Kategori FAQ</span>
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
