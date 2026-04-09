<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page-title', 'Admin') | LibCo</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            },
            corePlugins: { preflight: false }
        }
    </script>

    <script>
        if (localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-theme', 'light');
        }
    </script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; margin: 0; padding: 0; overflow-x: hidden; }

        .admin-layout {
            display: flex;
            min-height: 100vh;
            margin: 0; padding: 0; width: 100%;
        }

        .admin-sidebar {
            width: 256px;
            position: fixed;
            left: 0; top: 0;
            height: 100vh;
            z-index: 1000;
            flex-shrink: 0;
            overflow-y: auto;
        }

        .admin-main-wrapper {
            margin-left: 256px;
            width: calc(100% - 256px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            position: sticky;
            top: 0;
            z-index: 999;
            width: 100%;
        }

        .admin-content {
            flex: 1;
            width: 100%;
            margin: 0; padding: 0;
        }

        .admin-content .container,
        .admin-content .container-fluid,
        .admin-content .container-lg,
        .admin-content .container-md,
        .admin-content .container-sm,
        .admin-content .container-xl,
        .admin-content > div {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /*
         * PENTING: Nama class ini sengaja .sidebar-link bukan .nav-item
         * karena Bootstrap 5 sudah punya .nav-item sendiri dan akan
         * meng-override styling kita, menyebabkan warna active muncul
         * di semua item atau tidak sesuai.
         */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 10px;
            text-decoration: none !important;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
            color: #94a3b8 !important;
            margin-bottom: 2px;
        }

        .sidebar-link:hover {
            background-color: rgba(100, 116, 139, 0.3);
            color: #ffffff !important;
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .sidebar-link.active i,
        .sidebar-link:hover i {
            color: #ffffff !important;
        }

        .sidebar-link i {
            width: 20px;
            text-align: center;
            font-size: 0.95rem;
        }

        /* Theme Toggle */
        .theme-toggle-btn {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.3);
        }

        .theme-toggle-btn:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .theme-toggle-btn:active {
            transform: translateY(0) scale(0.98);
        }

        .theme-toggle-btn i {
            font-size: 20px;
            color: white;
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .theme-toggle-btn {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 4px 6px rgba(240, 147, 251, 0.3);
        }

        [data-theme="dark"] .theme-toggle-btn:hover {
            box-shadow: 0 8px 15px rgba(240, 147, 251, 0.4);
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .admin-sidebar.mobile-open { transform: translateX(0); }
            .admin-main-wrapper { margin-left: 0; width: 100%; }
            .theme-toggle-btn { width: 45px; height: 45px; }
            .theme-toggle-btn i { font-size: 18px; }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100" style="margin:0;padding:0;">

<div x-data="{
    dark: localStorage.theme === 'dark',
    mobileMenuOpen: false,
    toggleTheme() {
        this.dark = !this.dark;
        localStorage.theme = this.dark ? 'dark' : 'light';
        document.documentElement.classList.toggle('dark');
        document.documentElement.setAttribute('data-theme', this.dark ? 'dark' : 'light');
        window.dispatchEvent(new Event('storage'));
    }
}" class="admin-layout">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar bg-gradient-to-b from-slate-800 to-slate-900 shadow-2xl flex flex-col"
           :class="{ 'mobile-open': mobileMenuOpen }">

        <!-- Logo -->
        <div class="p-6 border-b border-slate-700/50">
            <div class="flex items-center gap-3">
                <div class="text-4xl">📚</div>
                <div>
                    <h1 class="text-white font-bold text-xl">LibCo</h1>
                    <p class="text-slate-400 text-xs">Digital Library System</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="px-3 py-4 flex-1 overflow-y-auto space-y-1">

            @php
                $currentRoute = Route::currentRouteName() ?? '';
            @endphp

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ $currentRoute === 'admin.dashboard' ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.buku.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.buku.') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span>Manajemen E-Book</span>
            </a>

            <a href="{{ route('admin.anggota.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.anggota.') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Manajemen Anggota</span>
            </a>

            <a href="{{ route('admin.transaksi.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.transaksi.') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i>
                <span>Peminjaman</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.kategori.') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.genre.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.genre.') ? 'active' : '' }}">
                <i class="fas fa-list-ul"></i>
                <span>Genre</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.laporan.') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.pengaturan.index') }}"
               class="sidebar-link {{ Str::startsWith($currentRoute, 'admin.pengaturan.') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>

        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-slate-700/50">
            <form action="/logout" method="POST">
                @csrf
                <button class="w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg transition-all font-medium">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="admin-main-wrapper">

        <!-- HEADER -->
        <header class="admin-header bg-white dark:bg-gray-800 shadow-sm">
            <div class="px-6 py-4 flex justify-between items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 dark:text-gray-300">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <h1 class="font-semibold text-2xl text-gray-800 dark:text-white">@yield('page-title', 'Dashboard')</h1>

                <div class="flex items-center gap-4">
                    <button @click="toggleTheme()" class="theme-toggle-btn" title="Toggle Theme">
                        <i :class="dark ? 'fas fa-sun' : 'fas fa-moon'"></i>
                    </button>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-800 dark:text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Administrator</p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="admin-content bg-gray-50 dark:bg-gray-900">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

@stack('scripts')
</body>
</html>