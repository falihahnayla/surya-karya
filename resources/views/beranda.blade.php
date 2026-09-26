<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Surya Karya - Pembangunan &amp; Renovasi Rumah</title>
    
    <!-- Tailwind CSS v3 CDN with plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
    <!-- Google Fonts: Cormorant Garamond & Inter -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
    
    <script>
        tailwind.config = {
          theme: {
            extend: {
              fontFamily: {
                serif: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                sans: ['"Inter"', 'sans-serif'],
              },
              colors: {
                navy: {
                  800: '#14213d',
                  900: '#0d182b',
                  950: '#07101e',
                },
                royal: {
                  700: '#103778',
                  800: '#0c2856',
                  900: '#081c3c',
                },
                sand: {
                  50: '#faf9f5',
                  100: '#f5f3ec',
                  200: '#e7e3d6',
                }
              }
            }
          }
        }
    </script>
    
    <!-- Typography & Global styles -->
    <style data-purpose="typography">
        body {
          font-family: 'Inter', sans-serif;
          color: #1f2937;
          background-color: #ffffff;
          -webkit-font-smoothing: antialiased;
        }
        .heading-serif {
          font-family: 'Cormorant Garamond', Georgia, serif;
          letter-spacing: -0.01em;
        }
    </style>
    
    <!-- Custom Decorative Styles -->
    <style data-purpose="decorations">
        .hero-gradient {
          background: radial-gradient(circle at 50% 30%, rgba(30, 58, 95, 0.75) 0%, rgba(13, 27, 42, 0.95) 100%);
        }
        .card-watermark {
          position: absolute;
          right: 1.5rem;
          top: 1rem;
          font-family: 'Cormorant Garamond', serif;
          font-size: 5rem;
          line-height: 1;
          font-weight: 500;
          color: rgba(203, 213, 225, 0.35);
          user-select: none;
          pointer-events: none;
        }
    </style>
</head>
<body class="antialiased text-slate-800 bg-[#fbfbfb]">

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
                <a class="text-slate-900 font-semibold border-b-2 border-slate-900 pb-1" href="#beranda">Beranda</a>
                <a class="hover:text-slate-900 transition-colors" href="#layanan">Layanan</a>
                <a class="hover:text-slate-900 transition-colors" href="#portofolio">Portofolio</a>
                <a class="hover:text-slate-900 transition-colors" href="#faq">FAQ</a>
                <a class="hover:text-slate-900 transition-colors" href="#get-in-touch">Kontak</a>
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
                <a class="inline-flex items-center justify-center px-5 py-2.5 text-xs sm:text-sm font-semibold tracking-wide text-white bg-[#0d1c31] hover:bg-[#142d50] rounded-full transition shadow-sm active:scale-95" href="#get-in-touch">
                  Konsultasi
                </a>
            </div>
        </div>
    </header>
    <!-- END: MainHeader -->

    <!-- BEGIN: HeroSection -->
    <section class="relative min-h-[600px] lg:min-h-[700px] flex items-center justify-center text-center px-4 py-24 sm:py-32 overflow-hidden bg-slate-900" id="beranda">
        <!-- Atmospheric architectural background image with deep moody overlay -->
        <div class="absolute inset-0 z-0">
            <img alt="Modern Luxury Residence Blueprint and Architecture" class="w-full h-full object-cover object-center opacity-30 brightness-75 filter contrast-125" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEmAJlEszPG3P3R2DGhATkxADa1zefFNHUQg7z7wTIR3jvBRAh-P_-U01P9UKdGH1FRdneGvoUAGbeo63g_lbX0UbLrlB2o7waivWz-wYWTa_8y3nDWFIIMIq1v-E4hoDud10u48GOcIVVh2aOsNV9sqvGgY75sriQVXc0eN5zIT33ZkA2ge2ZcxNDloizwxlnbqPrm_P55zlGbeZqHvFovXfVVl18utIZ33_r73ET6yEDQDOLr_-R"/>
            <div class="absolute inset-0 bg-gradient-to-b from-[#101e33]/90 via-[#0d182b]/85 to-[#0b1424]/95 mix-blend-multiply"></div>
        </div>
        
        <!-- Hero Content Container -->
        <div class="relative z-10 max-w-4xl mx-auto flex flex-col items-center">
            <!-- Eyebrow Tag -->
            <span class="text-[11px] sm:text-xs uppercase tracking-[0.25em] font-medium text-slate-300 mb-4 block">
              SURYA KARYA
            </span>
            <!-- Primary Serif Headline -->
            <h1 class="heading-serif text-4xl sm:text-6xl lg:text-7xl font-semibold text-white uppercase tracking-normal leading-[1.1] max-w-3xl">
              PEMBANGUNAN &amp;<br/>RENOVASI RUMAH
            </h1>
            <!-- Supporting Tagline -->
            <p class="mt-6 text-sm sm:text-base lg:text-lg text-slate-300 font-light max-w-2xl leading-relaxed">
              Solusi pembangunan dan renovasi rumah dengan proses yang profesional, transparan, dan berorientasi pada kualitas.
            </p>
            <!-- Action Buttons -->
            <div class="mt-10 flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto">
                <a class="w-full sm:w-auto px-8 py-3.5 text-xs sm:text-sm font-semibold tracking-wide text-white bg-[#0d1c31] border border-blue-900/60 hover:bg-[#152742] rounded-md transition shadow-md" href="#get-in-touch">
                  Konsultasi
                </a>
                <a class="w-full sm:w-auto px-8 py-3.5 text-xs sm:text-sm font-semibold tracking-wide text-slate-200 border border-slate-400/50 hover:bg-white/10 hover:text-white rounded-md transition backdrop-blur-sm" href="#portofolio">
                  Lihat Portofolio
                </a>
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
                        <img alt="Proyek Konstruksi dan Pembangunan Surya Karya" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaVISVOE0HiYxrVbfBKu7qNuCkFrQ85oCaltnzEk1VThaOmYn935JMGSieA0Dxg_oXpAHqMLQ44eNOZ5S0xoDTBs8Cw0krzOlzHvn0jr0h1RevSiKR01HFUhFe81bqFm2TS4BqIPEs-4S_-VLv3zX7YKeFNdeoYwm_F2GsParqe0BkRYnUQ8Z9PX7yYCPFinRL-yBbDktuqKGMO-mRoRmE3c6nQB38hCE8yYIM-neD02s-fCvyeKJE"/>
                        <!-- Bottom Left Badge Overlay -->
                        <div class="absolute bottom-5 left-5 right-5 sm:right-auto sm:max-w-xs bg-white/95 backdrop-blur-md p-4 rounded-lg shadow-lg border border-slate-100">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-slate-500 block mb-1">
                              KOMITMEN PRESISI &amp; KONSTRUKSI
                            </span>
                            <p class="text-xs text-slate-800 leading-snug font-medium">
                              Standar material premium dengan eksekusi teknik arsitektural modern.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Right: Brand Narrative & Technical Excellence Description -->
                <div class="lg:col-span-6 flex flex-col justify-center">
                    <h2 class="heading-serif text-3xl sm:text-5xl font-normal text-slate-900 tracking-tight mb-6">
                      Surya Karya
                    </h2>
                    <div class="border-l-2 border-slate-200 pl-6 space-y-4 text-slate-600 text-sm sm:text-base leading-relaxed text-justify">
                        <p>
                          Surya Karya hadir sebagai mitra terpercaya Anda dalam mewujudkan hunian impian. Kami menggabungkan keahlian teknis teruji dengan pendekatan estetika modern untuk menghasilkan struktur yang tidak hanya kokoh dan tahan lama, tetapi juga mencerminkan karakter serta gaya hidup Anda.
                        </p>
                        <p>
                          Dedikasi kami pada detail, integritas struktural, transparansi manajemen biaya, dan craftsmanship terkurasi memastikan setiap proyek berjalan lancar dari konsepsi desain awal hingga serah terima kunci.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: AboutSection -->

    <!-- BEGIN: VisionMissionSection -->
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
                <div class="bg-[#0f1d30] text-white p-8 sm:p-10 rounded-2xl shadow-xl relative overflow-hidden flex flex-col justify-between group hover:shadow-2xl transition duration-300">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-[1.5px] bg-slate-400"></span>
                            <span class="text-[10px] tracking-[0.2em] uppercase font-semibold text-slate-300">ARAH &amp; CITA-CITA</span>
                        </div>
                        <h3 class="heading-serif text-3xl font-bold tracking-wider mb-4 text-white">VISI</h3>
                        <p class="text-sm text-slate-300 leading-relaxed font-light">
                          Menjadi mitra konstruksi terdepan yang mendefinisikan ulang standar kualitas hunian melalui inovasi struktural, estetika arsitektural, dan pelayanan yang transparan.
                        </p>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
                </div>
                <!-- MISI Card -->
                <div class="bg-[#0f1d30] text-white p-8 sm:p-10 rounded-2xl shadow-xl relative overflow-hidden flex flex-col justify-between group hover:shadow-2xl transition duration-300">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-[1.5px] bg-slate-400"></span>
                            <span class="text-[10px] tracking-[0.2em] uppercase font-semibold text-slate-300">TANGGUNG JAWAB NYATA</span>
                        </div>
                        <h3 class="heading-serif text-3xl font-bold tracking-wider mb-4 text-white">MISI</h3>
                        <p class="text-sm text-slate-300 leading-relaxed font-light">
                          Memberikan hasil karya berkualitas tinggi dengan presisi teknis, efisiensi manajemen waktu dan biaya, serta komunikasi yang jujur dan profesional pada setiap tahap.
                        </p>
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
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
                      Standar Eksekusi Terbaik
                    </h2>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 max-w-md leading-relaxed md:text-right">
                  Prinsip kerja profesional yang diterapkan di setiap proyek demi ketahanan dan kenyamanan tinggal Anda.
                </p>
            </div>
            <!-- 3 Pillars Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 01 -->
                <div class="relative bg-white border border-slate-200 p-8 rounded-xl flex flex-col justify-between hover:border-slate-400 transition group shadow-sm hover:shadow-md">
                    <span class="card-watermark group-hover:text-slate-300/60 transition-colors">01</span>
                    <div class="relative z-10 pt-4">
                        <h3 class="heading-serif text-2xl sm:text-3xl font-semibold text-slate-900 mb-4 pr-12">
                          Pembangunan &amp; Renovasi
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                          Layanan menyeluruh dari pembangunan rumah baru hingga renovasi parsial atau total, dikerjakan oleh tim berpengalaman untuk hasil optimal.
                        </p>
                    </div>
                </div>
                <!-- Card 02 -->
                <div class="relative bg-white border border-slate-200 p-8 rounded-xl flex flex-col justify-between hover:border-slate-400 transition group shadow-sm hover:shadow-md">
                    <span class="card-watermark group-hover:text-slate-300/60 transition-colors">02</span>
                    <div class="relative z-10 pt-4">
                        <h3 class="heading-serif text-2xl sm:text-3xl font-semibold text-slate-900 mb-4 pr-12">
                          Spesifikasi Bangunan &amp; Standar Mutu
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                          Kami menjamin penggunaan material berkualitas dan penerapan standar konstruksi yang ketat demi keamanan dan keawetan bangunan Anda.
                        </p>
                    </div>
                </div>
                <!-- Card 03 -->
                <div class="relative bg-white border border-slate-200 p-8 rounded-xl flex flex-col justify-between hover:border-slate-400 transition group shadow-sm hover:shadow-md">
                    <span class="card-watermark group-hover:text-slate-300/60 transition-colors">03</span>
                    <div class="relative z-10 pt-4">
                        <h3 class="heading-serif text-2xl sm:text-3xl font-semibold text-slate-900 mb-4 pr-12">
                          Alur Kerja Sama Kontraktor
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                          Proses kerja sama yang jelas, terstruktur, dan transparan, memastikan Anda selalu mendapat informasi terkini mengenai perkembangan proyek.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: ExecutionStandardsSection -->

    <!-- BEGIN: FeaturedProjectsSection -->
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
                <!-- Project 1 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Villa Modern Canggu" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCcCxX3w64aPb3I7M_Jv3zwPP9XjGuj8m8FQW5En5L2l1_s5TJL2sp-4tnf1uJhh1GJuk90IeIvaBuJ079LQGSyz3GvGH62nKf8rCd0eTS9QGFmg2Swa--nQ51HaSluPMtT3syMnXEY1LyX13LV1DphULaokyD6Uum_SmSCiJ66nMcTRWcoJwYgJPnXXbPVTLnYVdcWwu83Lxn3v-roSlF8JMLMMD8HzRRlIxcXPOyjd6JnLPzUoHsG"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">PEMBANGUNAN BARU</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Villa Modern Canggu</h3>
                    </div>
                </div>
                <!-- Project 2 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Kediaman Senopati" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCxulc2Skb4zSNRaaJSzajyewjkdi1qQQntzVhkJ7XRN-1d1b7rTgNOqz6vg1pVxZ2lugMTVKZBGKUTu0rI-KtMgrV4hDOffOf7BWh-Gqy1yubZx_uIHEQ5fkugySmlJfn7_S36JFTuo3KrgHajIg14DMCJp0zxvT0v7_4StRsgZTLup5j6G1gSA25SMcW9jfMHpfs5Qwdz4xi5mdAKAgqprXgIbCxeOf_RuPgMheQBM7mfJFAztMbf"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">RENOVASI &amp; INTERIOR</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Kediaman Senopati</h3>
                    </div>
                </div>
                <!-- Project 3 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Paviliun Menteng" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBicQbFlJ2T28Uc8cxgyySGusyy_lGD8gGHQwRylLat0G1Rt__xi5UksYgVRBLJbEjUE8TOPZ_ehbZJXWaK-80nG64rXyOjb_ymQ6X5QhoF6UfW9-0XXTI7mYhJMUFmDL0PUgnoeeY1hjfQNdVN1BTAfKeLXLplf7tUegNPFw_5xjteE2dJOD_GRJX6rppZaPySOMN-wvHZQuMzP_abOYDtphdZ7QgEKmKbmbhUJ91tQarZw0jvDUVj"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">ARSITEKTUR TROPIS MODERN</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Paviliun Menteng</h3>
                    </div>
                </div>
                <!-- Project 4 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Bintaro Private House" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmqg2rq1sRbxq-3pYbrDSwVVehokQHS6y8o-KhA5uLHYod2fMYVUkjc8maY1lkHT25XRGJgxVW8Jki_94Pj0SttWKLYczZZmTMQu13gn28GLghgw2UOJkiqV4zIaYsE61UygOFfNNIbWUVxdzjjBWOw8LCxud4rSmHQOgHR3NXO8zwVPs3MnAmQG3Z6y9vTfiRcCitqiTcMOi0zW0vjgqMwv3WSfYdmLNxlcbpzOPYf04dYYHulgol"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">KONSTRUKSI STRUKTURAL</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Bintaro Private House</h3>
                    </div>
                </div>
                <!-- Project 5 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Dharmawangsa Residence" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDE_I_8ZYPj-6SbGMh_arrP_KEN8pclTtjxcxgS9DJzHcfdlHLVXkNlrloGrNq7TN4DIRqvP-9U6xJcC8XHi2vbLTrNhM1OpJiBXayWUzPRrzcWSzInG7wZvmetti5ZW8dP5kGly1lHZwZBXca_h4OwLSKAkqeSpKiwTp7hG_ZIPLvHXWSseB_wPUiFMTuYyEUP6PasrQk57Foy5lZ-ihHMbt4dl76TtnDFNkwseEN0ce_lG62k7j4S"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">INTERIOR &amp; EKSTERIOR</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Dharmawangsa Residence</h3>
                    </div>
                </div>
                <!-- Project 6 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Pondok Indah Mansion" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuARYNPwnx97jSMr6ivdDLX6tTeqwrFDFAlGkpdxABfp9wjB5wOZ_M_x31VrW8jZtTzVoGKDdrABbQTaifqskXFBuLRx3xwWqlldsYnZDGrJCnE_K21orGndTHNbDjY5MIIF2JRZARKVJ5lQ6eoc1Z9k7xxLkc1_3hXb3hFPUkYEa4b9ZO6p7i0t_j6eRxhpday14mwyMAs6KStBv7YUqgFto65ReQomL-SXXidrm-dd3b_ile3zgpHo"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">PEMBANGUNAN MEWAH</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Pondok Indah Mansion</h3>
                    </div>
                </div>
                <!-- Project 7 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Kemang Living Space" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIe-ZaL4SBEQZtJYvot1-Kp_0Fgy1ZaT7t4BWN9SdyCsA28Nsch19zOr1mXd6usTv6EO_m6abUq5Ca5GnztCuYIhV5m9DgI7Mp9IvR7IEx1qsZViYDGenXYx-GMKRsqyLzhS9p9vaOPDx6cs1LFZwgU5qb7LQAezXpLMLilcwV2iiPuCZr7MUI9c8242FTrHxKiWaedHV1U1mbqP0cTdujAV5Oos079kTY1q9GTYOg2BF8sHT6YWgd"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">RENOVASI TOTAL</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Kemang Living Space</h3>
                    </div>
                </div>
                <!-- Project 8 -->
                <div class="group relative overflow-hidden rounded-xl aspect-[3/4] bg-slate-200 shadow-md">
                    <img alt="Citra Garden Villa" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" src="https://lh3.googleusercontent.com/aida-public/AB6AXuApJ6J7qBMEZp6cHsfqW0omzgbxc4D73ZvBRASS-EcnzpETV_FYSukFONgVlNGDPLscD2IXVYlsarnRKSJDpgwWbgazNA7yPs4w4qtupJEaiwg_KkcI2TlDcA-d1POWC1Lw-oWesxql9XZADarVDNvnAqhkbxhMeSW87fWmS6mcnNmsvbi94fBp9da0OimXf2WTFWKGZkiFbsfKClx-AKkdIPOXJ59odXtTvXoGv75oq0os4jrccZFW"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity"></div>
                    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-slate-300 block mb-1">FASAD &amp; LANDSCAPING</span>
                        <h3 class="heading-serif text-xl font-medium text-white tracking-wide">Citra Garden Villa</h3>
                    </div>
                </div>
            </div>
            <!-- View All Portfolio Button -->
            <div class="mt-14 text-center">
                <a class="inline-block px-10 py-3.5 border border-slate-700 hover:border-slate-900 text-slate-800 text-xs font-semibold tracking-widest uppercase rounded-sm hover:bg-slate-900 hover:text-white transition duration-200" href="#portofolio">
                  LIHAT SEMUA PORTOFOLIO
                </a>
            </div>
        </div>
    </section>
    <!-- END: FeaturedProjectsSection -->

    <!-- BEGIN: CallToActionSection -->
    <section class="relative py-28 lg:py-36 overflow-hidden bg-slate-900 flex items-center justify-center text-center" id="get-in-touch">
        <!-- Atmospheric Night Villa / Pool Lounge Background -->
        <div class="absolute inset-0 z-0">
            <img alt="Surya Karya Luxury Night Villa and Pool Background" class="w-full h-full object-cover object-center brightness-50 contrast-125" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkjTUvhvPCI6BfQxEEwvNqvrAmqozh9dLGhJ_LomcyJDbFh7_8fbqhalZRqcdS6YO_LL5wpCys92SUNoez5ZxtipY7Fsl1V2wMLdOJRDwci3G36KGrPlEQcR2-15utKzMMXdEVedeA5fAWBSV6_lCcuEaixwMAZJAtf4DYMSvqseC1ua6K8GJ-uFsVPuRyEiIwGaG1ZtuHbUnoRI8ol-tL8HzndKKtlZNsoRGfR0BbW5-jwHdqFPk_"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#081323] via-[#091b33]/85 to-[#081323]/90"></div>
        </div>
        <!-- Centered CTA Content -->
        <div class="relative z-10 max-w-3xl mx-auto px-4 sm:px-6">
            <h2 class="heading-serif text-3xl sm:text-5xl lg:text-6xl font-normal text-white uppercase tracking-tight leading-tight mb-8">
              SIAP MEMBANGUN ATAU MERENOVASI RUMAH ANDA?
            </h2>
            <div>
                <a class="inline-flex items-center justify-center px-9 py-3 bg-[#e8dfcf] hover:bg-[#dfd4c1] text-slate-900 text-xs font-bold uppercase tracking-[0.2em] rounded-full transition shadow-lg active:scale-95" href="#kontak">
                  GET IN TOUCH
                </a>
            </div>
        </div>
    </section>
    <!-- END: CallToActionSection -->

    <!-- Global Footer Component -->
    <x-footer />

</body>
</html>

</body>
</html>
