<!-- BEGIN: MainHeader -->
@php
  $siteSetting = \App\Models\Setting::first();
  $companyName = filled($siteSetting?->company) ? $siteSetting->company : 'Surya Karya';
  $logoDefault = 'https://lh3.googleusercontent.com/aida-public/AB6AXuD2KLbLTxsEJf3LH3g7OCe1Q9xsz15bakNmmuzw7uFHTpFd6k0-TeLTj2GP9BNIIEf3bmhsRRyp_-yLtzeYVIz8AqLQ8RcxkN8bmNeAD2ExnOpix2Gc-BBuqPtnPxG-4TAGVfZW9Uj_dpEZI4tlIwDV7mjPi_xsGES1kOGE11UHOwLERF57omZMgcuiz4u3PA1xBu3EutZpQrTjRbcvKzMT_kw3AbzL2yOoN_m0Br0ykTSUduAOqCnmCm7dW3M0XCECUA';
  $logoUrl = $logoDefault;
  if (filled($siteSetting?->logo)) {
      $logoUrl = (str_starts_with($siteSetting->logo, 'http://') || str_starts_with($siteSetting->logo, 'https://')) ? $siteSetting->logo : asset($siteSetting->logo);
  }
@endphp
<header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

    <!-- Brand Logo & Name -->
    <a class="flex items-center gap-3.5 group" href="{{ route('home') }}">
      <img
        alt="{{ $companyName }} Logo"
        class="w-11 h-11 object-cover rounded-full shadow-sm ring-1 ring-slate-200/80 group-hover:scale-105 transition-transform"
        src="{{ $logoUrl }}"
      />

      <span class="heading-serif text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 group-hover:text-[#d4af37] transition-colors">
        {{ $companyName }}
      </span>
    </a>

    <!-- Desktop Navigation Menu Links -->
    <nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">

      <!-- Beranda -->
      <a
        href="{{ route('home') }}"
        class="transition-colors hover:text-[#d4af37] {{ request()->routeIs('home') ? 'text-slate-900 font-semibold' : '' }}"
      >
        Beranda
      </a>

      <!-- Layanan Dropdown -->
      <div class="relative group">
        <button
          type="button"
          class="flex items-center gap-2 transition-colors hover:text-[#d4af37] {{ request()->routeIs('pembangunan-renovasi', 'spesifikasi-standar', 'alur-kerja') ? 'text-slate-900 font-semibold' : '' }}"
        >
          Layanan
          <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
        </button>

        <div class="absolute left-0 top-full pt-3 hidden group-hover:block">
          <div class="w-64 bg-white rounded-xl shadow-lg border border-gray-100 py-2">

            <!-- Pembangunan & Renovasi -->
            <a
              href="{{ route('pembangunan-renovasi') }}"
              class="block px-5 py-3 text-sm transition-colors hover:bg-slate-50 hover:text-[#d4af37] {{ request()->routeIs('pembangunan-renovasi') ? 'text-[#d4af37] font-semibold' : 'text-slate-600' }}"
            >
              Pembangunan & Renovasi
            </a>

            <!-- Spesifikasi Bangunan -->
            <a
              href="{{ route('spesifikasi-standar') }}"
              class="block px-5 py-3 text-sm transition-colors hover:bg-slate-50 hover:text-[#d4af37] {{ request()->routeIs('spesifikasi-standar') ? 'text-[#d4af37] font-semibold' : 'text-slate-600' }}"
            >
              Spesifikasi Bangunan & Standar Mutu
            </a>

            <!-- Alur Kerja -->
            <a
              href="{{ route('alur-kerja') }}"
              class="block px-5 py-3 text-sm transition-colors hover:bg-slate-50 hover:text-[#d4af37] {{ request()->routeIs('alur-kerja') ? 'text-[#d4af37] font-semibold' : 'text-slate-600' }}"
            >
              Alur Kerja Sama Kontraktor
            </a>

          </div>
        </div>
      </div>

      <!-- Portofolio -->
      <a
        href="{{ route('portofolio') }}"
        class="transition-colors hover:text-[#d4af37] {{ request()->routeIs('portofolio') ? 'text-slate-900 font-semibold' : '' }}"
      >
        Portofolio
      </a>

      <!-- FAQ -->
      <a
        href="{{ route('faq') }}"
        class="transition-colors hover:text-[#d4af37] {{ request()->routeIs('faq') ? 'text-slate-900 font-semibold' : '' }}"
      >
        FAQ
      </a>
    </nav>

    <!-- Right Action & Language & Mobile Hamburger -->
    <div class="flex items-center space-x-3 sm:space-x-4">

      <!-- Language Icon -->
      <button
        aria-label="Language selector"
        class="text-slate-600 hover:text-[#d4af37] p-1.5 rounded-full hover:bg-slate-100 transition"
        type="button"
      >
        <i class="fa-solid fa-globe text-[18px]"></i>
      </button>

      <!-- CTA Button (Desktop/Tablet) -->
      <a
        href="{{ route('frontend.form-pesanan') }}"
        class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 text-xs sm:text-sm font-semibold tracking-wide text-white bg-[#0d1c31] hover:bg-[#d4af37] rounded-full transition shadow-sm active:scale-95"
      >
        Get In Touch 
      </a>

      <!-- Mobile/Tablet Hamburger Button -->
      <button
        id="mobile-menu-btn"
        aria-label="Toggle Navigation Menu"
        type="button"
        class="md:hidden p-2 rounded-lg text-slate-700 hover:text-[#d4af37] hover:bg-slate-100 transition focus:outline-none"
      >
        <i id="menu-icon-bars" class="fa-solid fa-bars text-xl"></i>
        <i id="menu-icon-x" class="fa-solid fa-xmark text-xl hidden"></i>
      </button>

    </div>
  </div>

  <!-- Mobile / Tablet Drawer Menu -->
  <div id="mobile-menu-drawer" class="hidden md:hidden bg-white/98 border-b border-slate-200 px-6 py-5 shadow-xl space-y-4">
    <div class="flex flex-col space-y-3 text-base font-medium text-slate-700">
      
      <!-- Beranda -->
      <a href="{{ route('home') }}" class="py-2 hover:text-[#d4af37] transition-colors {{ request()->routeIs('home') ? 'text-[#d4af37] font-semibold' : '' }}">
        Beranda
      </a>

      <!-- Layanan Accordion for Mobile -->
      <div class="border-y border-slate-100 py-2">
        <button id="mobile-layanan-btn" type="button" class="w-full flex items-center justify-between py-1 text-left font-medium hover:text-[#d4af37] transition-colors">
          <span>Layanan</span>
          <i id="mobile-layanan-icon" class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
        </button>

        <div id="mobile-layanan-sub" class="hidden pl-4 pt-2 space-y-2 text-sm text-slate-600">
          <a href="{{ route('pembangunan-renovasi') }}" class="block py-1.5 hover:text-[#d4af37] transition-colors">
            Pembangunan &amp; Renovasi
          </a>
          <a href="{{ route('spesifikasi-standar') }}" class="block py-1.5 hover:text-[#d4af37] transition-colors">
            Spesifikasi Bangunan &amp; Standar Mutu
          </a>
          <a href="{{ route('alur-kerja') }}" class="block py-1.5 hover:text-[#d4af37] transition-colors">
            Alur Kerja Sama Kontraktor
          </a>
        </div>
      </div>

      <!-- Portofolio -->
      <a href="{{ route('portofolio') }}" class="py-2 hover:text-[#d4af37] transition-colors {{ request()->routeIs('portofolio') ? 'text-[#d4af37] font-semibold' : '' }}">
        Portofolio
      </a>

      <!-- FAQ -->
      <a href="{{ route('faq') }}" class="py-2 hover:text-[#d4af37] transition-colors {{ request()->routeIs('faq') ? 'text-[#d4af37] font-semibold' : '' }}">
        FAQ
      </a>

      <!-- Mobile Get In Touch CTA -->
      <div class="pt-3">
        <a href="{{ route('frontend.form-pesanan') }}" class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-semibold tracking-wide text-white bg-[#0d1c31] hover:bg-[#d4af37] rounded-full transition shadow-sm">
          Get In Touch
        </a>
      </div>

    </div>
  </div>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menuDrawer = document.getElementById('mobile-menu-drawer');
    const iconBars = document.getElementById('menu-icon-bars');
    const iconX = document.getElementById('menu-icon-x');

    const layananBtn = document.getElementById('mobile-layanan-btn');
    const layananSub = document.getElementById('mobile-layanan-sub');
    const layananIcon = document.getElementById('mobile-layanan-icon');

    if (menuBtn && menuDrawer) {
      menuBtn.addEventListener('click', function () {
        menuDrawer.classList.toggle('hidden');
        iconBars.classList.toggle('hidden');
        iconX.classList.toggle('hidden');
      });
    }

    if (layananBtn && layananSub) {
      layananBtn.addEventListener('click', function () {
        layananSub.classList.toggle('hidden');
        if (layananIcon) {
          layananIcon.classList.toggle('rotate-180');
        }
      });
    }
  });
</script>
<!-- END: MainHeader -->
