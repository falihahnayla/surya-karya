@extends('layouts.app')

@section('title', 'Beranda | Surya Karya')

@section('content')

<!-- BEGIN: HeroSection -->

<section class="relative min-h-[600px] lg:min-h-[700px] flex items-center justify-center text-center px-4 py-24 sm:py-32 overflow-hidden bg-slate-900" id="beranda">
<!-- Atmospheric architectural background image with deep moody overlay -->
<div class="absolute inset-0 z-0">
<img alt="Modern Luxury Residence Blueprint and Architecture" class="w-full h-full object-cover object-center opacity-30 brightness-75 filter contrast-125" src="{{ $home->image_bg ? asset($home->image_bg) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuAEmAJlEszPG3P3R2DGhATkxADa1zefFNHUQg7z7wTIR3jvBRAh-P_-U01P9UKdGH1FRdneGvoUAGbeo63g_lbX0UbLrlB2o7waivWz-wYWTa_8y3nDWFIIMIq1v-E4hoDud10u48GOcIVVh2aOsNV9sqvGgY75sriQVXc0eN5zIT33ZkA2ge2ZcxNDloizwxlnbqPrm_P55zlGbeZqHvFovXfVVl18utIZ33_r73ET6yEDQDOLr_-R' }}"/>
<div class="absolute inset-0 bg-gradient-to-b from-[#101e33]/90 via-[#0d182b]/85 to-[#0b1424]/95 mix-blend-multiply"></div>
</div>
<!-- Hero Content Container -->
 <div class="animate-up">
<div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center ">
<!-- Eyebrow Tag -->
<span class="text-[11px] sm:text-xs uppercase tracking-[0.25em] font-medium text-slate-300 mb-4 block">
  {{ strtoupper($setting->company ?? ($siteSetting->company ?? 'Surya Karya')) }}
</span>
<!-- Primary Serif Headline -->
<h1 class="heading-serif text-4xl sm:text-6xl lg:text-7xl font-semibold text-white uppercase tracking-normal leading-[1.1] max-w-3xl">
        {!! nl2br(e($home->title ?? "PEMBANGUNAN &\nRENOVASI RUMAH")) !!}
      </h1>
<!-- Supporting Tagline -->
<p class="mt-6 text-sm sm:text-base lg:text-lg text-slate-300 font-light max-w-2xl leading-relaxed">
        {{ $home->subtitle ?? 'Solusi pembangunan dan renovasi rumah dengan proses yang profesional, transparan, dan berorientasi pada kualitas.' }}
      </p>
<!-- Action Buttons -->
<div class="mt-10 flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
<a class="w-full sm:w-auto px-8 py-3.5 text-xs sm:text-sm font-semibold tracking-wide text-white bg-[#0d1c31] border border-blue-900/60 hover:bg-[#152742] rounded-md transition shadow-md"
   href="https://wa.me/6281239401899"
   target="_blank"
   rel="noopener noreferrer">
  Konsultasi
</a>
<a class="w-full sm:w-auto px-8 py-3.5 text-xs sm:text-sm font-semibold tracking-wide text-slate-200 border border-slate-400/50 hover:bg-white/10 hover:text-white rounded-md transition backdrop-blur-sm" href="{{ route('portofolio') }}">
          Lihat Portofolio
        </a>
</div>
</div>
</div>
</section>

<!-- END: HeroSection -->
<!-- BEGIN: AboutSection -->
<section class="py-20 lg:py-28 bg-white border-b border-gray-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
<!-- Left: Project Under Construction Image with Info Card -->
<div class="lg:col-span-6 relative">
<div class="relative overflow-hidden rounded-2xl shadow-xl aspect-[4/3] bg-slate-100 group">
<img alt="Proyek Konstruksi dan Pembangunan Surya Karya" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700" src="{{ $home->image_about ? asset($home->image_about) : 'https://lh3.googleusercontent.com/aida-public/AB6AXuCaVISVOE0HiYxrVbfBKu7qNuCkFrQ85oCaltnzEk1VThaOmYn935JMGSieA0Dxg_oXpAHqMLQ44eNOZ5S0xoDTBs8Cw0krzOlzHvn0jr0h1RevSiKR01HFUhFe81bqFm2TS4BqIPEs-4S_-VLv3zX7YKeFNdeoYwm_F2GsParqe0BkRYnUQ8Z9PX7yYCPFinRL-yBbDktuqKGMO-mRoRmE3c6nQB38hCE8yYIM-neD02s-fCvyeKJE' }}"/>
<!-- Bottom Left Badge Overlay -->
<div class="absolute bottom-5 left-5 right-5 sm:right-auto sm:max-w-xs bg-white/95 backdrop-blur-md p-4 rounded-lg shadow-lg border border-slate-100">
<span class="text-[10px] uppercase font-bold tracking-wider text-slate-500 block mb-1">
                KOMITMEN PRESISI &amp; KONSTRUKSI
              </span>
<p class="text-xs text-slate-800 leading-snug font-medium">
                {{ $home->img_desc ?? 'Standar material premium dengan eksekusi teknik arsitektural modern.' }}
              </p>
</div>
</div>
</div>
<!-- Right: Brand Narrative & Technical Excellence Description -->
<div class="lg:col-span-6 flex flex-col justify-center">
<h2 class="heading-serif text-3xl sm:text-5xl font-normal text-slate-900 tracking-tight mb-6">
            {{ $setting->company ?? ($siteSetting->company ?? 'Surya Karya') }}
          </h2>
<div class="border-l-2 border-slate-200 pl-6 space-y-4 text-slate-600 text-sm sm:text-base leading-relaxed text-justify">
<p class="">
              {{ $home->content_about ?? 'Surya Karya hadir sebagai mitra terpercaya Anda dalam mewujudkan hunian impian. Kami menggabungkan keahlian teknis teruji dengan pendekatan estetika modern untuk menghasilkan struktur yang tidak hanya kokoh dan tahan lama, tetapi juga mencerminkan karakter serta gaya hidup Anda.' }}
            </p>
<p class="">
              Dedikasi kami pada detail, integritas struktural, transparansi manajemen biaya, dan craftsmanship terkurasi memastikan setiap proyek berjalan lancar dari konsepsi desain awal hingga serah terima kunci.
            </p>
</div>
</div>
</div>
</div>
</section>
<!-- END: AboutSection -->

<!-- BEGIN: VisionMissionSection -->
@php
    $visiMisi = \App\Models\VisiMisi::first();
@endphp
<section class="py-20 lg:py-24 bg-[#f8f9fa] border-b border-gray-200">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<!-- Section Header -->
<div class="text-center max-w-2xl mx-auto mb-14">
<h2 class="heading-serif text-3xl sm:text-5xl font-normal text-slate-900 tracking-tight">
          Visi &amp; Misi
        </h2>
<p class="mt-3 text-sm sm:text-base text-slate-500">
          Arah pandang dan nilai dasar yang memandu setiap karya pembangunan kami.
        </p>
</div>
<!-- Visi & Misi Dual Cards Container -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 max-w-5xl mx-auto">
<!-- VISI Card -->
 <div class="animate-left">
<div class="bg-[#0f1d30] text-white p-8 sm:p-10 rounded-2xl shadow-xl relative overflow-hidden flex flex-col justify-between group hover:shadow-2xl transition duration-300">
<div class="relative z-10">
<!-- Label Tag -->
<div class="flex items-center gap-2 mb-3">
<span class="w-6 h-[1.5px] bg-slate-400"></span>
<span class="text-[10px] tracking-[0.2em] uppercase font-semibold text-slate-300">ARAH &amp; CITA-CITA</span>
</div>
<h3 class="heading-serif text-3xl font-bold tracking-wider mb-4 text-white">{{ $visiMisi->visi_title ?? 'VISI' }}</h3>
<p class="text-sm text-slate-300 leading-relaxed font-light">
              {{ $visiMisi->visi_content ?? 'Menjadi mitra konstruksi terdepan yang mendefinisikan ulang standar kualitas hunian melalui inovasi struktural, estetika arsitektural, dan pelayanan yang transparan.' }}
            </p>
</div>
<div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
</div>
</div>
<!-- MISI Card -->
 <div class="animate-right">
<div class="bg-[#0f1d30] text-white p-8 sm:p-10 rounded-2xl shadow-xl relative overflow-hidden flex flex-col justify-between group hover:shadow-2xl transition duration-300">
<div class="relative z-10">
<!-- Label Tag -->
<div class="flex items-center gap-2 mb-3">
<span class="w-6 h-[1.5px] bg-slate-400"></span>
<span class="text-[10px] tracking-[0.2em] uppercase font-semibold text-slate-300">TANGGUNG JAWAB NYATA</span>
</div>
<h3 class="heading-serif text-3xl font-bold tracking-wider mb-4 text-white">{{ $visiMisi->misi_title ?? 'MISI' }}</h3>
<p class="text-sm text-slate-300 leading-relaxed font-light">
              {{ $visiMisi->misi_content ?? 'Memberikan hasil karya berkualitas tinggi dengan presisi teknis, efisiensi manajemen waktu dan biaya, serta komunikasi yang jujur dan profesional pada setiap tahap.' }}
            </p>
</div>
<div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
</div>
</div>
</div>
</div>
</section>
<!-- END: VisionMissionSection -->

<!-- BEGIN: ExecutionStandardsSection -->
<section class="py-20 lg:py-28 bg-white border-b border-gray-100" id="layanan">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section Top Header Bar -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 pb-6 border-b border-slate-100 gap-4">
      <div>
        <h2 class="heading-serif text-3xl sm:text-5xl text-slate-900 tracking-tight font-normal">
          {{ $home->service_title ?? 'Standar Eksekusi Terbaik' }}
        </h2>
      </div>

      <p class="text-xs sm:text-sm text-slate-500 max-w-md leading-relaxed md:text-right">
        {{ $home->service_desc ?? 'Prinsip kerja profesional yang diterapkan di setiap proyek demi ketahanan dan kenyamanan tinggal Anda.' }}
      </p>
    </div>

    <!-- 3 Pillars Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      @foreach($services as $service)
      <!-- Card {{ sprintf('%02d', $loop->iteration) }} -->
        <div class="{{ ['animate-left', 'animate-up', 'animate-right'][$loop->index % 3] }}">
      <div class="relative bg-white border border-slate-200 p-8 rounded-xl flex flex-col justify-between hover:border-slate-400 transition group shadow-sm hover:shadow-md">
        <span class="card-watermark group-hover:text-slate-300/60 transition-colors">{{ sprintf('%02d', $loop->iteration) }}</span>

        <div class="relative z-10 pt-4">
          <h3 class="heading-serif text-2xl sm:text-3xl font-semibold text-slate-900 mb-4 pr-12">
            {{ $service->title }}
          </h3>

          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
            {{ $service->content }}
          </p>
        </div>
      </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
<!-- END: ExecutionStandardsSection -->
@php
$featuredProjects = \App\Models\Portofolio::with('category')
    ->where('status', 'Show')
    ->where('is_featured', true)
    ->latest()
    ->take(8)
    ->get();
@endphp
<!-- BEGIN: FeaturedProjectsSection -->
@if($featuredProjects->isNotEmpty())
<section class="py-20 lg:py-28 bg-[#fbfbfb]" id="portofolio">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<!-- Section Title Header -->
<div class="text-center max-w-3xl mx-auto mb-14">
<span class="text-xs uppercase tracking-[0.25em] font-semibold text-slate-500 block mb-2">
          PORTOFOLIO TERPILIH
        </span>
<h2 class="heading-serif text-3xl sm:text-5xl font-normal text-slate-900 tracking-tight mb-4">
          Proyek Unggulan
        </h2>
<p class="text-sm sm:text-base text-slate-500 font-light">
          Koleksi hunian eksklusif dan renovasi modern yang dieksekusi dengan integritas material prima dan presisi tanpa kompromi.
        </p>
</div>
<!-- 8-Project Portfolio Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 sm:gap-6">
@foreach($featuredProjects as $project)
<div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
@if(!empty($project->image))
<img alt="{{ $project->title }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="{{ (str_starts_with($project->image, 'http://') || str_starts_with($project->image, 'https://')) ? $project->image : asset($project->image) }}"/>
@endif
<div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
<div class="absolute bottom-0 inset-x-0 p-5 text-white">
<span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">{{ $project->category->title ?? 'PORTOFOLIO' }}</span>
<h3 class="heading-serif text-xl font-medium text-white tracking-wide">{{ $project->title }}</h3>
</div>
</div>
@endforeach
</div>
<!-- View All Portfolio Button -->
<div class="mt-14 text-center">
<a class="inline-block px-10 py-3.5 border border-slate-700 hover:border-slate-900 text-slate-800 text-xs font-semibold tracking-widest uppercase rounded-sm hover:bg-slate-900 hover:text-white transition duration-200" href="{{ route('portofolio') }}">
          LIHAT SEMUA PORTOFOLIO
        </a>
</div>
</div>
</section>
@endif
<!-- END: FeaturedProjectsSection -->

@endsection