<!-- BEGIN: MainHeader -->
<header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">

    <!-- Brand Logo & Name -->
    <a class="flex items-center gap-3.5 group" href="{{ route('home') }}">
      <img
        alt="Surya Karya Logo"
        class="w-11 h-11 object-cover rounded-full shadow-sm ring-1 ring-slate-200/80 group-hover:scale-105 transition-transform"
        src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2KLbLTxsEJf3LH3g7OCe1Q9xsz15bakNmmuzw7uFHTpFd6k0-TeLTj2GP9BNIIEf3bmhsRRyp_-yLtzeYVIz8AqLQ8RcxkN8bmNeAD2ExnOpix2Gc-BBuqPtnPxG-4TAGVfZW9Uj_dpEZI4tlIwDV7mjPi_xsGES1kOGE11UHOwLERF57omZMgcuiz4u3PA1xBu3EutZpQrTjRbcvKzMT_kw3AbzL2yOoN_m0Br0ykTSUduAOqCnmCm7dW3M0XCECUA"
      />

      <span class="heading-serif text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 group-hover:text-[#d4af37] transition-colors">
        Surya Karya
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

      <!-- Kontak -->
      <a
        href="#kontak"
        class="transition-colors hover:text-[#d4af37]"
      >
        Kontak
      </a>

    </nav>

    <!-- Right Action & Language -->
    <div class="flex items-center space-x-4">

      <!-- Language Icon -->
      <button
        aria-label="Language selector"
        class="text-slate-600 hover:text-[#d4af37] p-1.5 rounded-full hover:bg-slate-100 transition"
        type="button"
      >
        <i class="fa-solid fa-globe text-[18px]"></i>
      </button>

      <!-- CTA Button -->
      <a
        href="{{ route('frontend.form-pesanan') }}"
        class="inline-flex items-center justify-center px-5 py-2.5 text-xs sm:text-sm font-semibold tracking-wide text-white bg-[#0d1c31] hover:bg-[#d4af37] rounded-full transition shadow-sm active:scale-95"
      >
        Konsultasi
      </a>

    </div>
  </div>
</header>
<!-- END: MainHeader -->
