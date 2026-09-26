<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>

    <title>@yield('title', 'Surya Karya')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #1f2937;
        }

        .heading-serif {
            font-family: 'Cormorant Garamond', serif;
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
    </style>

    @stack('styles')
</head>

<body class="antialiased">

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')


    @stack('scripts')
</body>
</html>