<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - Perpustakaan Digital</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @php
        $tema = \App\Models\AppSetting::get('tema', 'libco');
        $sidebarStyle = \App\Models\AppSetting::get('sidebar_style', 'solid');

        $temaVars = [
            'libco' => [
                'sidebar-bg' => 'linear-gradient(180deg, #4f46e5, #7c3aed)',
                'sidebar-text' => '#e0e7ff',
                'sidebar-act' => 'rgba(255,255,255,.18)',
                'top-bg' => '#ffffff',
                'accent' => '#4f46e5',
            ],
            'warm' => [
                'sidebar-bg' => 'linear-gradient(180deg, #2b1d0e, #3d2910)',
                'sidebar-text' => '#f7f0e3',
                'sidebar-act' => 'rgba(200,131,42,.25)',
                'top-bg' => '#ffffff',
                'accent' => '#c8832a',
            ],
            'dark' => [
                'sidebar-bg' => 'linear-gradient(180deg, #0f0f0f, #1a1a1a)',
                'sidebar-text' => '#e5e7eb',
                'sidebar-act' => 'rgba(99,102,241,.2)',
                'top-bg' => '#111111',
                'accent' => '#6366f1',
            ],
            'sage' => [
                'sidebar-bg' => 'linear-gradient(180deg, #2d4a3e, #1e3329)',
                'sidebar-text' => '#d1fae5',
                'sidebar-act' => 'rgba(74,158,125,.25)',
                'top-bg' => '#ffffff',
                'accent' => '#4a9e7d',
            ],
            'slate' => [
                'sidebar-bg' => 'linear-gradient(180deg, #1e2a3a, #162032)',
                'sidebar-text' => '#dbeafe',
                'sidebar-act' => 'rgba(74,127,181,.25)',
                'top-bg' => '#ffffff',
                'accent' => '#4a7fb5',
            ],
        ];

        $vars = $temaVars[$tema] ?? $temaVars['libco'];

        $sidebarOverride = '';
        if ($sidebarStyle === 'glass') {
            $sidebarOverride = '
                                .sidebar {
                                    backdrop-filter: blur(16px) !important;
                                    background: rgba(0,0,0,.35) !important;
                                    border-right: 1px solid rgba(255,255,255,.08) !important;
                                }
                            ';
        } elseif ($sidebarStyle === 'minimal') {
            $sidebarOverride = '
                                .sidebar {
                                    background: #ffffff !important;
                                    border-right: 1px solid #e5e7eb !important;
                                    box-shadow: none !important;
                                }
                                .sidebar .menu-link { color: #374151 !important; }
                                .sidebar .menu-link.active {
                                    background: #f3f4f6 !important;
                                    color: ' . $vars['accent'] . ' !important;
                                }
                                .sidebar .menu-link:hover {
                                    background: #f3f4f6 !important;
                                    color: ' . $vars['accent'] . ' !important;
                                }
                            ';
        }
    @endphp

    <style>
        /* ── CSS Variables Tema ── */
        :root {
            --sidebar-bg:
                {{ $vars['sidebar-bg'] }}
            ;
            --sidebar-text:
                {{ $vars['sidebar-text'] }}
            ;
            --sidebar-act:
                {{ $vars['sidebar-act'] }}
            ;
            --top-bg:
                {{ $vars['top-bg'] }}
            ;
            --accent:
                {{ $vars['accent'] }}
            ;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            overflow-x: hidden;
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            color: #fff;
            margin: 0;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: -.01em;
        }

        .sidebar-header h4 span {
            background: linear-gradient(90deg, #a5f3fc, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-header p {
            color: rgba(255, 255, 255, .55);
            font-size: 0.78rem;
            margin-top: 4px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            margin: 3px 12px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 11px 15px;
            color: var(--sidebar-text) !important;
            text-decoration: none !important;
            border-radius: 10px;
            transition: all 0.25s;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .menu-link:hover {
            background: var(--sidebar-act) !important;
            color: #ffffff !important;
            padding-left: 20px;
        }

        .menu-link.active {
            background: var(--sidebar-act) !important;
            color: #ffffff !important;
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
        }

        .menu-link i {
            width: 22px;
            margin-right: 11px;
            font-size: 0.9rem;
            opacity: .85;
        }

        .menu-link.active i,
        .menu-link:hover i {
            opacity: 1;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            width: calc(100% - 260px);
        }

        /* ================= TOP NAVBAR ================= */
        .top-navbar {
            background: var(--top-bg);
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .navbar-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #1e1b4b;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.92rem;
            color: #1e1b4b;
        }

        .user-role {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--sidebar-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 2px 8px rgba(79, 70, 229, .3);
        }

        /* ── Tombol ── */
        .btn-primary {
            background: var(--accent) !important;
            border-color: var(--accent) !important;
        }

        .btn-primary:hover {
            opacity: .88 !important;
        }

        /* ================= CONTENT ================= */
        .content-area {
            padding: 30px;
        }

        /* ================= MOBILE ================= */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .3s;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        {!! $sidebarOverride !!}
    </style>

    @stack('styles')
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration:none;">
                <h4>
                    <i class="fas fa-book-open me-2"></i>
                    <span>Lib</span>Co
                </h4>
            </a>
            <p>Digital Library System</p>
        </div>

        <nav class="sidebar-menu">
            @php
                $route = Route::currentRouteName() ?? '';
            @endphp

            <div class="menu-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-link {{ $route === 'admin.dashboard' ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.buku.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.buku.') ? 'active' : '' }}">
                    <i class="fas fa-book"></i> Manajemen E-Book
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.anggota.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.anggota.') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Manajemen Anggota
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.transaksi.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.transaksi.') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt"></i> Peminjaman
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.kategori.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.kategori.') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.genre.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.genre.') ? 'active' : '' }}">
                    <i class="fas fa-list-ul"></i> Genre
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.karya.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.karya.') ? 'active' : '' }}">
                    <i class="fas fa-feather-alt"></i> Karya Pengguna
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.laporan.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.laporan.') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </div>

            <div class="menu-item">
                <a href="{{ route('admin.pengaturan.index') }}"
                    class="menu-link {{ Str::startsWith($route, 'admin.pengaturan.') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger w-100" style="border-radius:8px;font-weight:600;">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
        <nav class="top-navbar">
            <h1 class="navbar-title">@yield('page-title', 'Dashboard')</h1>

            <div class="navbar-user">
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->nama_user ?? 'Admin' }}</div>
                    <div class="user-role">Administrator</div>
                </div>
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->nama_user ?? 'A', 0, 1)) }}
                </div>
            </div>
        </nav>

        <div class="content-area">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>