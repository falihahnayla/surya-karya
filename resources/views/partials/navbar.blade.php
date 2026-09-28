<!-- BEGIN: MainHeader -->
<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
<!-- Brand Logo & Name -->
<a class="flex items-center gap-3.5 group" href="#">
<img alt="Surya Karya Logo" class="w-11 h-11 object-cover rounded-full shadow-sm ring-1 ring-slate-200/80 group-hover:scale-105 transition-transform" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD2KLbLTxsEJf3LH3g7OCe1Q9xsz15bakNmmuzw7uFHTpFd6k0-TeLTj2GP9BNIIEf3bmhsRRyp_-yLtzeYVIz8AqLQ8RcxkN8bmNeAD2ExnOpix2Gc-BBuqPtnPxG-4TAGVfZW9Uj_dpEZI4tlIwDV7mjPi_xsGES1kOGE11UHOwLERF57omZMgcuiz4u3PA1xBu3EutZpQrTjRbcvKzMT_kw3AbzL2yOoN_m0Br0ykTSUduAOqCnmCm7dW3M0XCECUA"/>
<span class="heading-serif text-2xl sm:text-3xl font-semibold tracking-tight text-slate-900 group-hover:text-blue-900 transition-colors">
          Surya Karya
        </span>
</a>
<!-- Desktop Navigation Menu Links -->
<nav class="hidden md:flex items-center space-x-8 text-sm font-medium text-slate-600">
<a class="text-slate-900 font-semibold  pb-1" href="{{ route('home') }}">Beranda</a>

<div class="relative group">
    <button class="flex items-center gap-1 hover:text-slate-900 transition-colors" type="button">
        Layanan
        <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewbox="0 0 24 24">
            <path d="M6 9l6 6 6-6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>

    <div class="absolute left-0 top-full pt-3 hidden group-hover:block">
        <div class="w-64 bg-white rounded-xl shadow-lg border border-gray-100 py-2">
            <a href="{{ route('pembangunan-renovasi') }}" class="block px-5 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                Pembangunan & Renovasi
            </a>

            <a href="{{ route('spesifikasi-standar') }}" class="block px-5 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                Spesifikasi Bangunan & Standar Mutu
            </a>

            <a href="{{ route('alur-kerja') }}
            " class="block px-5 py-3 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors">
                Alur Kerja Sama Kontraktor
            </a>
        </div>
    </div>
</div>

<a class="hover:text-slate-900 transition-colors {{ request()->routeIs('portofolio') ? 'text-slate-900 font-semibold border-b-2 border-slate-900 pb-1' : '' }}" href="{{ route('portofolio') }}">Portofolio</a>
<a class="hover:text-slate-900 transition-colors" href="{{ route('faq') }}">FAQ</a>
<a class="hover:text-slate-900 transition-colors" href="#kontak">Kontak</a>

</nav>
<!-- Right Action & Language Indicator -->
<div class="flex items-center space-x-4">
<!-- Global/Language Icon -->
<button aria-label="Language selector" class="text-slate-600 hover:text-slate-900 p-1.5 rounded-full hover:bg-slate-100 transition" type="button">
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
<circle cx="12" cy="12" r="10" stroke-width="1.6"></circle>
<line stroke-width="1.6" x1="2" x2="22" y1="12" y2="12"></line>
<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" stroke-width="1.6"></path>
</svg>
</button>
<!-- CTA Button -->
<a class="inline-flex items-center justify-center px-5 py-2.5 text-xs sm:text-sm font-semibold tracking-wide text-white bg-[#0d1c31] hover:bg-[#142d50] rounded-full transition shadow-sm active:scale-95" href="#kontak">
          Konsultasi
        </a>
</div>
</div>
</header>
<!-- END: MainHeader -->