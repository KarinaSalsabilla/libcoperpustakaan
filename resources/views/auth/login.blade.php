<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Libco</title>

    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>

    <!-- Lottie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>

    <!-- Load theme sebelum render -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        * { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center px-4 sm:px-6 py-8 text-gray-800 dark:text-gray-100">

    <div class="w-full max-w-6xl bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden grid lg:grid-cols-2">

        <!-- LEFT = Form + Judul -->
        <div class="p-6 sm:p-10 lg:p-14 flex flex-col justify-center">

            <!-- Logo & Back -->
            <div class="mb-6 sm:mb-8">
                <a href="/" class="flex items-center gap-2 font-semibold">
                    <img src="https://dummyimage.com/40x40/4f46e5/ffffff&text=L" class="h-9 w-9 sm:h-10 sm:w-10 rounded-lg" alt="Libco">
                    <span class="text-lg sm:text-xl dark:text-white">Libco</span>
                </a>

                <a href="/" class="inline-flex items-center gap-1 mt-3 text-sm text-gray-500 dark:text-gray-400 hover:text-indigo-500 dark:hover:text-indigo-400 transition">
                    ← Kembali ke Beranda
                </a>
            </div>

            <!-- Lottie (mobile only) -->
            <div class="flex lg:hidden justify-center mb-6">
                <div id="lottie-login-mobile" class="w-40 h-40 sm:w-52 sm:h-52"></div>
            </div>

            <!-- Title -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold dark:text-white">
                    Selamat Datang Kembali
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 sm:mt-3 text-sm sm:text-base">
                    Masuk untuk melanjutkan perjalanan membaca buku digital favoritmu.
                </p>
            </div>

            <!-- Form -->
            <form method="POST" action="/login" class="space-y-4 sm:space-y-5" x-data="loginForm()">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">Email</label>
                    <input type="email" name="email" x-model="email" @blur="touched.email = true"
                        class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition text-sm sm:text-base"
                        placeholder="email@contoh.com">
                    <p x-show="touched.email && email === ''" class="mt-1 text-xs sm:text-sm text-red-500">Email wajib diisi</p>
                    <p x-show="touched.email && email && !email.includes('@')" class="mt-1 text-xs sm:text-sm text-red-500">Format email tidak valid</p>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium text-gray-600 dark:text-gray-300">Password</label>
                    <input type="password" name="password" x-model="password" @blur="touched.password = true"
                        class="w-full mt-2 px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none transition text-sm sm:text-base"
                        autocomplete="off" placeholder="Minimal 6 karakter">
                    <p x-show="touched.password && password === ''" class="mt-1 text-xs sm:text-sm text-red-500">Password wajib diisi</p>
                    <p x-show="password && password.length < 6" class="mt-1 text-xs sm:text-sm text-red-500">Password minimal 6 karakter</p>
                </div>

                <button type="submit"
                    class="w-full py-3 sm:py-4 mt-2 bg-gradient-to-r from-blue-600 to-teal-600 text-white rounded-xl font-semibold text-base sm:text-lg hover:scale-[1.02] active:scale-[0.98] transition shadow-lg">
                    Masuk Sekarang
                </button>
            </form>

            <p class="text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-6 sm:mt-8">
                Belum punya akun?
                <a href="/register" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline">Daftar di sini</a>
            </p>
        </div>

        <!-- RIGHT = Lottie (desktop only) -->
        <div class="hidden lg:flex items-center justify-center bg-gradient-to-br from-blue-600 to-teal-600 p-10">
            <div id="lottie-login" class="w-full max-w-md"></div>
        </div>
    </div>

    <script>
        function loginForm() {
            return {
                email: '',
                password: '',
                touched: {
                    email: false,
                    password: false
                }
            }
        }

        // Lottie - desktop
        lottie.loadAnimation({
            container: document.getElementById('lottie-login'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('lottie/login.json') }}'
        });

        // Lottie - mobile
        lottie.loadAnimation({
            container: document.getElementById('lottie-login-mobile'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('lottie/login.json') }}'
        });
    </script>
</body>
</html>