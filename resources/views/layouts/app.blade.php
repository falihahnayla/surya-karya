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

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
        <script src="/js/scroll-animation.js"></script>
    @stack('scripts')

</body>
</html>