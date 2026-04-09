<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libco</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

    <!-- Alpine -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Anti flicker & Load theme sebelum render -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

   
    <style>
        html {
            scroll-behavior: auto;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-300">

<header x-data="{ 
    open: false,
    darkMode: localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),
    
    toggleDarkMode() {
        this.darkMode = !this.darkMode;
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
    }
}"
class="sticky top-0 z-50 bg-white/80 backdrop-blur-md shadow-sm dark:bg-gray-800/90 dark:shadow-lg">

    <div class="container mx-auto px-6 lg:px-12 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="images/libco.png" alt="Logo"
                    class="scale-192 h-16 w-auto object-contain transition-transform duration-300 cursor-pointer" />
            </div>

            <nav class="hidden md:flex items-center gap-8 text-lg font-medium">
                <a href="#home" class="text-blue-600 hover:text-blue-700 transition font-semibold dark:text-blue-400 dark:hover:text-blue-500">Home</a>
                <a href="#koleksi" class="text-gray-700 hover:text-blue-600 transition dark:text-gray-300 dark:hover:text-blue-400">Koleksi Buku</a>
                <a href="#fitur" class="text-gray-700 hover:text-blue-600 transition dark:text-gray-300 dark:hover:text-blue-400">Fitur Unggulan</a>
                <a href="#tentangkami" class="text-gray-700 hover:text-blue-600 transition dark:text-gray-300 dark:hover:text-blue-400">Tentang Kami</a>
                <a href="#kontak" class="text-gray-700 hover:text-blue-600 transition dark:text-gray-300 dark:hover:text-blue-400">Kontak</a>
            </nav>

            <div class="flex items-center gap-4">
                <button @click="toggleDarkMode()"
                    class="p-2.5 rounded-full text-gray-700 bg-gray-100 hover:bg-gray-200 transition dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    
                    <svg x-show="darkMode" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.354 15.354A9 9 0 018.646 3.646
                               9.003 9.003 0 0012 21
                               a9.003 9.003 0 008.354-5.646z" />
                    </svg>

                    <svg x-show="!darkMode" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m9-9h-1M4 12H3
                               m15.364 6.364l-.707-.707
                               M6.343 6.343l-.707-.707
                               m12.728 0l-.707.707
                               M6.343 17.657l-.707.707
                               M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <a href="/login"
                    class="hidden md:block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-7 py-3 rounded-full shadow-lg hover:shadow-xl transition transform hover:scale-105 text-base font-medium">
                    Masuk
                </a>
            </div>

            <button @click="open = !open"
                class="md:hidden text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition dark:text-gray-300 dark:hover:bg-gray-700">
                <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-transition class="md:hidden mt-4 pb-4 space-y-2">
            <a href="#home" class="block py-2 text-blue-600 font-semibold dark:text-blue-400">Home</a>
            <a href="#koleksi" class="block py-2 text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Koleksi Buku</a>
            <a href="#fitur" class="block py-2 text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Fitur Unggulan</a>
            <a href="#tentangkami" class="block py-2 text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Tentang Kami</a>
            <a href="#kontak" class="block py-2 text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-400">Kontak</a>
            <a href="/login" class="block mt-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-full text-center">Masuk</a>
        </div>
    </div>
</header>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const target = document.querySelector(this.getAttribute('href'));
            if (!target) return;

            const headerOffset = 96; // tinggi header sticky
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerOffset;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            const duration = 1500; // 🔥 MAKIN BESAR = MAKIN SLOW
            let start = null;

            function animation(currentTime) {
                if (start === null) start = currentTime;
                const timeElapsed = currentTime - start;
                const progress = Math.min(timeElapsed / duration, 1);

                window.scrollTo(0, startPosition + distance * easeInOut(progress));

                if (timeElapsed < duration) {
                    requestAnimationFrame(animation);
                }
            }

            function easeInOut(t) {
                return t < 0.5
                    ? 4 * t * t * t
                    : 1 - Math.pow(-2 * t + 2, 3) / 2;
            }

            requestAnimationFrame(animation);
        });
    });
</script>

</body>
</html>
