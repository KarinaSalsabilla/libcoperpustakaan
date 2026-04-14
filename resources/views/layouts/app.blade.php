<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="KnkSdrRC2Xpfhw7n2LcjJmTAt0p22ttk9PJw_vpHTyc" />
    <title>Libco-perpustakaan digital</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Mengaktifkan dark mode berdasarkan class 'dark' pada tag <html>
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        .hover-scale {
            transition: transform 0.3s ease;
        }

        .hover-scale:hover {
            transform: translateY(-5px);
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 80px;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .feature-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.4s ease;
        }

        /* Dark mode */
        .dark .feature-card {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(148, 163, 184, 0.15);
        }

        /* Glow gradient background */
        .feature-card::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg,
                    rgba(59, 130, 246, 0.15),
                    rgba(168, 85, 247, 0.15),
                    rgba(249, 115, 22, 0.15));
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        /* Hover effect */
        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 0 40px rgba(99, 102, 241, 0.25);
        }
    </style>
    @endif
</head>

<body
    x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true', 
        toggleDarkMode() { 
            this.darkMode = !this.darkMode; 
            localStorage.setItem('darkMode', this.darkMode); 
        } 
    }"
    x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark'))"
    class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:bg-gray-900 dark:text-gray-200">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- ISI HALAMAN --}}
    <main>
        @yield(section: 'content')
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>
