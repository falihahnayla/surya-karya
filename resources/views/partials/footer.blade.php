{{-- Data dari Admin > Pengaturan. Jika kosong, dipakai data cadangan di kode. --}}
@php
  $st = \App\Models\Setting::first();

  // Quick Links dari Admin > Quick Links
  $quickLinks = \App\Models\QuickLink::orderBy('id')->get();

  $companyName = filled($st?->company) ? $st->company : 'Surya Karya';
  $description = filled($st?->description)
      ? $st->description
      : 'Pembangunan & Renovasi Rumah Berkualitas. Menghadirkan kekokohan struktur dan keindahan arsitektur modern dalam satu visi konstruksi terpercaya.';

  $phone        = filled($st?->phone) ? $st->phone : '+62 21 5550 8889';
  $phoneHref    = preg_replace('/[^\d+]/', '', $phone);

  $email        = filled($st?->email) ? $st->email : 'info@suryakarya.com';

  $website      = filled($st?->website) ? $st->website : 'www.suryakarya.com';
  $websiteHref  = preg_match('#^https?://#i', $website) ? $website : 'https://' . $website;
  $websiteLabel = preg_replace('#^https?://#i', '', $website);

  $address      = filled($st?->address)
      ? $st->address
      : 'Jl. Arsitektur No. 88, Kawasan Bisnis Terpadu, Jakarta, Indonesia';

  $footerText   = filled($st?->footer_text)
      ? $st->footer_text
      : '© ' . date('Y') . ' ' . $companyName . '. All Rights Reserved.';

  // Logo: dari admin (URL penuh atau path di folder public), cadangan: logo lama
  $logoDefault = 'https://lh3.googleusercontent.com/aida-public/AB6AXuAgb-mvC7ZmEqj9a5VnworSJL-Om492-eA4mNMwkY9UpkZv_1tiXNIKrcIsOUFa1I8IFUTHlUK7HJ9fyw6M1yGzMUeuvSP2uLbdt02Wx70RveLYkJJHzny-ou4PyWAlNOw-gt6L0_S7zScY8_1h5gCo5P8ZvQrGGTxaISefIpB72n7sIhjpw_KQueYHHqj6L5jybS3D01l_X5xXrquZ05q7xkhgpkUom5Sjpkxsui-5LRx2yfwZeI7B51_Rjxdgdcsh3g';
  $logoUrl = $logoDefault;
  if (filled($st?->logo)) {
      $logoUrl = preg_match('#^https?://#i', $st->logo) ? $st->logo : asset($st->logo);
  }
@endphp

<!-- BEGIN: Footer -->
<footer class="bg-[#0b1424] text-slate-300 pt-16 pb-12 border-t border-slate-800" id="kontak">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Top Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8 mb-16">

      <!-- Col 1: Brand & Credibility Info -->
      <div class="sm:col-span-2 lg:col-span-1 space-y-4">
        <div class="flex items-center gap-3.5">
          <img alt="{{ $companyName }} Logo" class="w-10 h-10 object-cover rounded-full ring-1 ring-slate-700/80 shadow-inner" src="{{ $logoUrl }}"/>
          <span class="heading-serif text-2xl font-semibold text-white tracking-tight">{{ $companyName }}</span>
        </div>
        <p class="text-xs text-slate-400 leading-relaxed pr-6">
          {{ $description }}
        </p>
        <div class="flex items-center gap-6 pt-2 text-xs font-medium text-slate-300">
          <span class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
            </svg>
            Berizin Resmi
          </span>
          <span class="flex items-center gap-1.5">
            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"></path>
            </svg>
            Transparan
          </span>
        </div>
      </div>

      <!-- Col 2: Navigation Links (dari Admin > Quick Links) -->
      <div>
        <h4 class="text-xs uppercase tracking-widest font-semibold text-white mb-4">HOME PAGE</h4>
        <ul class="space-y-2.5 text-xs text-slate-400">
          @forelse($quickLinks as $link)
            <li>
              <a class="hover:text-white transition"
                 href="{{ $link->href }}"
                 @if($link->is_external) target="_blank" rel="noopener noreferrer" @endif>{{ $link->title }}</a>
            </li>
          @empty
            {{-- Cadangan jika belum ada data Quick Links --}}
            <li><a class="hover:text-white transition" href="#beranda">Beranda</a></li>
            <li><a class="hover:text-white transition" href="#layanan">Layanan</a></li>
            <li><a class="hover:text-white transition" href="#portofolio">Portofolio</a></li>
            <li><a class="hover:text-white transition" href="#faq">FAQ</a></li>
          @endforelse
        </ul>
      </div>

      <!-- Col 3: Contact Details & Social Media -->
      <div>
        <h4 class="text-xs uppercase tracking-widest font-semibold text-white mb-4">KONTAK</h4>
        <ul class="space-y-2.5 text-xs text-slate-400">

          <!-- Telepon -->
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-phone text-slate-400 w-4"></i>
            <a href="tel:{{ $phoneHref }}" class="hover:text-white transition">{{ $phone }}</a>
          </li>

          <!-- WhatsApp (dari Admin > Pengaturan, cadangan: .env / kode) -->
          <li class="flex items-center gap-2">
            <i class="fa-brands fa-whatsapp text-slate-400 w-4"></i>
            <a href="{{ $siteWa['url'] }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">
              {{ $siteWa['display'] }}
            </a>
          </li>

          <!-- Email -->
          <li class="flex items-center gap-2">
            <i class="fa-regular fa-envelope text-slate-400 w-4"></i>
            <a href="mailto:{{ $email }}" class="hover:text-white transition">{{ $email }}</a>
          </li>

          <!-- Website -->
          <li class="flex items-center gap-2">
            <i class="fa-solid fa-globe text-slate-400 w-4"></i>
            <a href="{{ $websiteHref }}" target="_blank" rel="noopener noreferrer" class="hover:text-white transition">{{ $websiteLabel }}</a>
          </li>

        </ul>

        <div class="mt-4 pt-2">
          <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400 block mb-2">SOSIAL MEDIA</span>
          <div class="flex items-center space-x-3 text-slate-400">
            <a href="#" aria-label="Facebook" class="hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram" class="hover:text-white transition"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn" class="hover:text-white transition"><i class="fab fa-linkedin-in"></i></a>
            <a href="#" aria-label="TikTok" class="hover:text-white transition"><i class="fab fa-tiktok"></i></a>
          </div>
        </div>
      </div>

      <!-- Col 4: Location Address -->
      <div>
        <h4 class="text-xs uppercase tracking-widest font-semibold text-white mb-4">LOKASI</h4>
        <p class="text-xs text-slate-400 leading-relaxed">
          {{ $address }}
        </p>
      </div>
    </div>

    <!-- Bottom Copyright Line -->
    <div class="pt-8 border-t border-slate-800/80 text-center sm:text-left text-xs text-slate-400">
      <p>{{ $footerText }}</p>
    </div>

  </div>
</footer>
<!-- END: Footer -->