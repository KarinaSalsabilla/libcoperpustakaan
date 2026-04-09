<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Libco</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>

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

        /* Password strength bar */
        .strength-bar { height: 4px; border-radius: 2px; transition: all .3s; }

        /* Input focus ring custom */
        input:focus { box-shadow: 0 0 0 3px rgba(99,102,241,.18); }

        /* Smooth card shadow on mobile */
        @media (max-width: 640px) {
            .register-card { box-shadow: 0 8px 40px rgba(99,102,241,.12); }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50
             dark:from-gray-900 dark:via-gray-900 dark:to-gray-800
             flex items-center justify-center
             px-4 py-8 sm:px-6 sm:py-10
             text-gray-800 dark:text-gray-100">

    <div class="register-card w-full max-w-5xl bg-white dark:bg-gray-800 rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden
                grid lg:grid-cols-2">

        <!-- ══ LEFT — Form ══ -->
        <div class="p-6 sm:p-8 md:p-10 lg:p-12 flex flex-col justify-center">

            <!-- Logo & Back -->
            <div class="mb-6 sm:mb-8">
                <a href="/" class="inline-flex items-center gap-2 font-semibold">
                    <img src="https://dummyimage.com/40x40/4f46e5/ffffff&text=L"
                         class="h-9 w-9 sm:h-10 sm:w-10 rounded-lg" alt="Libco">
                    <span class="text-lg sm:text-xl dark:text-white">Libco</span>
                </a>
                <a href="/"
                   class="flex items-center gap-1 mt-2 text-xs sm:text-sm text-gray-500 dark:text-gray-400
                          hover:text-indigo-500 dark:hover:text-indigo-400 transition w-fit">
                    ← Kembali ke Beranda
                </a>
            </div>

            <!-- Title -->
            <div class="mb-6 sm:mb-7">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold dark:text-white leading-tight">
                    Buat Akun Baru
                </h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm sm:text-base">
                    Daftar sekarang dan nikmati akses ribuan buku digital favoritmu.
                </p>
            </div>

            <!-- Error dari Laravel -->
            @if($errors->any())
            <div class="mb-4 p-3 sm:p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800
                        rounded-xl text-sm text-red-600 dark:text-red-400">
                <ul class="space-y-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5" x-data="registerForm()">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-1.5">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" x-model="name" @blur="touched.name = true"
                           value="{{ old('name') }}"
                           class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-gray-200 dark:border-gray-600
                                  bg-white dark:bg-gray-700 dark:text-white text-sm sm:text-base
                                  focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition"
                           placeholder="Nama kamu">
                    <p x-show="touched.name && name === ''"
                       class="mt-1 text-xs sm:text-sm text-red-500">Nama wajib diisi</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-1.5">
                        Email
                    </label>
                    <input type="email" name="email" x-model="email" @blur="touched.email = true"
                           value="{{ old('email') }}"
                           class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border border-gray-200 dark:border-gray-600
                                  bg-white dark:bg-gray-700 dark:text-white text-sm sm:text-base
                                  focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition"
                           placeholder="email@contoh.com">
                    <p x-show="touched.email && email === ''"
                       class="mt-1 text-xs sm:text-sm text-red-500">Email wajib diisi</p>
                    <p x-show="touched.email && email && !email.includes('@')"
                       class="mt-1 text-xs sm:text-sm text-red-500">Format email tidak valid</p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-1.5">
                        Password
                    </label>
                    <div class="relative">
                        <input :type="showPass ? 'text' : 'password'"
                               name="password" x-model="password" @blur="touched.password = true"
                               class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 pr-11 rounded-xl border border-gray-200 dark:border-gray-600
                                      bg-white dark:bg-gray-700 dark:text-white text-sm sm:text-base
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition"
                               placeholder="Minimal 8 karakter">
                        <button type="button" @click="showPass = !showPass"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600
                                       dark:hover:text-gray-300 transition text-sm">
                            <span x-text="showPass ? '🙈' : '👁️'"></span>
                        </button>
                    </div>
                    <!-- Strength indicator -->
                    <div class="mt-2 flex gap-1" x-show="password.length > 0">
                        <div class="strength-bar flex-1 rounded"
                             :class="strength >= 1 ? 'bg-red-400' : 'bg-gray-200 dark:bg-gray-600'"></div>
                        <div class="strength-bar flex-1 rounded"
                             :class="strength >= 2 ? 'bg-yellow-400' : 'bg-gray-200 dark:bg-gray-600'"></div>
                        <div class="strength-bar flex-1 rounded"
                             :class="strength >= 3 ? 'bg-green-400' : 'bg-gray-200 dark:bg-gray-600'"></div>
                        <div class="strength-bar flex-1 rounded"
                             :class="strength >= 4 ? 'bg-green-600' : 'bg-gray-200 dark:bg-gray-600'"></div>
                    </div>
                    <p class="mt-1 text-xs text-gray-400 dark:text-gray-500" x-show="password.length > 0"
                       x-text="['','Terlalu lemah','Lemah','Cukup kuat','Kuat! 💪'][strength]"></p>
                    <p x-show="touched.password && password === ''"
                       class="mt-1 text-xs sm:text-sm text-red-500">Password wajib diisi</p>
                    <p x-show="touched.password && password.length > 0 && password.length < 8"
                       class="mt-1 text-xs sm:text-sm text-red-500">Password minimal 8 karakter</p>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300 mb-1.5">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input :type="showConfirm ? 'text' : 'password'"
                               name="password_confirmation" x-model="confirm" @blur="touched.confirm = true"
                               class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 pr-11 rounded-xl border border-gray-200 dark:border-gray-600
                                      bg-white dark:bg-gray-700 dark:text-white text-sm sm:text-base
                                      focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition"
                               :class="confirm && confirm !== password ? 'border-red-400' : (confirm && confirm === password ? 'border-green-400' : '')"
                               placeholder="Ulangi password">
                        <button type="button" @click="showConfirm = !showConfirm"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600
                                       dark:hover:text-gray-300 transition text-sm">
                            <span x-text="showConfirm ? '🙈' : '👁️'"></span>
                        </button>
                        <!-- Checkmark when match -->
                        <span x-show="confirm && confirm === password"
                              class="absolute right-9 top-1/2 -translate-y-1/2 text-green-500 text-sm">✓</span>
                    </div>
                    <p x-show="touched.confirm && confirm === ''"
                       class="mt-1 text-xs sm:text-sm text-red-500">Konfirmasi password wajib diisi</p>
                    <p x-show="touched.confirm && confirm !== '' && confirm !== password"
                       class="mt-1 text-xs sm:text-sm text-red-500">Password tidak sama</p>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 sm:py-3.5 mt-1 bg-gradient-to-r from-indigo-600 to-purple-600
                               text-white rounded-xl font-semibold text-sm sm:text-base
                               hover:from-indigo-700 hover:to-purple-700
                               hover:scale-[1.02] active:scale-[0.98]
                               transition-all shadow-lg shadow-indigo-200 dark:shadow-indigo-900/30">
                    Daftar Sekarang 🚀
                </button>
            </form>

            <!-- Login link -->
            <p class="text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-6">
                Sudah punya akun?
                <a href="/login" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">
                    Masuk di sini
                </a>
            </p>

            <!-- Divider + social hint (opsional) -->
            <div class="flex items-center gap-3 mt-5">
                <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
                <span class="text-xs text-gray-400">atau</span>
                <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
            </div>
            <p class="text-center text-xs text-gray-400 dark:text-gray-500 mt-3">
                Dengan mendaftar, kamu menyetujui
                <a href="#" class="text-indigo-500 hover:underline">Syarat & Ketentuan</a> kami.
            </p>
        </div>

        <!-- ══ RIGHT — Lottie (hidden on mobile) ══ -->
        <div class="hidden lg:flex flex-col items-center justify-center
                    bg-gradient-to-br from-indigo-600 to-purple-700
                    p-10 gap-8">
            <div id="lottie-register" class="w-full max-w-sm"></div>
            <div class="text-center text-white">
                <h3 class="text-xl font-bold mb-2">Selamat Datang di Libco</h3>
                <p class="text-indigo-200 text-sm leading-relaxed max-w-xs">
                    Akses ribuan buku digital, baca kapan saja & di mana saja, gratis!
                </p>
                <div class="flex justify-center gap-6 mt-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold">10K+</div>
                        <div class="text-indigo-300 text-xs mt-1">Buku</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">50K+</div>
                        <div class="text-indigo-300 text-xs mt-1">Pengguna</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">4.9★</div>
                        <div class="text-indigo-300 text-xs mt-1">Rating</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function registerForm() {
            return {
                name: '',
                email: '',
                password: '',
                confirm: '',
                showPass: false,
                showConfirm: false,
                touched: { name: false, email: false, password: false, confirm: false },
                get strength() {
                    const p = this.password;
                    if (!p) return 0;
                    let s = 0;
                    if (p.length >= 8) s++;
                    if (/[A-Z]/.test(p)) s++;
                    if (/[0-9]/.test(p)) s++;
                    if (/[^A-Za-z0-9]/.test(p)) s++;
                    return s;
                }
            }
        }
    </script>

    <script>
        lottie.loadAnimation({
            container: document.getElementById('lottie-register'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '{{ asset('lottie/register.json') }}'
        });
    </script>

</body>
</html>