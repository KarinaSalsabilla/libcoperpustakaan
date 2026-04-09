@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('main-class', '')

@section('content')
<div class="w-full">

    <!-- Alert: ada peminjaman lewat tenggat -->
    @if($lewatTenggat > 0)
    <div class="alert-dashboard alert-dashboard-warning mb-4">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <strong>{{ $lewatTenggat }} peminjaman</strong> sudah melewati tenggat waktu dan belum dikembalikan.
        <a href="{{ route('admin.transaksi.index', ['status' => 'pinjam']) }}" class="alert-link ms-2">
            Lihat Transaksi →
        </a>
    </div>
    @endif

    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="welcome-text">
                        <div class="welcome-icon">
                            <i class="fas fa-hand-sparkles"></i>
                        </div>
                        <div>
                            <h2 class="mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                            <p class="mb-0">Kelola perpustakaan digital Anda dengan mudah dan efisien</p>
                        </div>
                    </div>
                    <div class="welcome-date">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span id="currentDate"></span>
                    </div>
                </div>
                <div class="welcome-decoration">
                    <i class="fas fa-books"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-card-primary" data-aos="fade-up" data-aos-delay="0">
                <div class="stats-icon-wrapper">
                    <div class="stats-icon"><i class="fas fa-book-open"></i></div>
                </div>
                <div class="stats-content">
                    <h6 class="stats-label">Total E-Book</h6>
                    <h2 class="stats-value" data-count="{{ $totalEbook }}">0</h2>
                    <div class="stats-footer">
                        <span class="stats-badge badge-success">
                            <i class="fas fa-arrow-up me-1"></i> Aktif
                        </span>
                    </div>
                </div>
                <div class="stats-bg-icon"><i class="fas fa-book-open"></i></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-card-success" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-icon-wrapper">
                    <div class="stats-icon"><i class="fas fa-users"></i></div>
                </div>
                <div class="stats-content">
                    <h6 class="stats-label">Total Anggota</h6>
                    <h2 class="stats-value" data-count="{{ $totalAnggota }}">0</h2>
                    <div class="stats-footer">
                        <span class="stats-badge badge-info">
                            <i class="fas fa-user-check me-1"></i> Terdaftar
                        </span>
                    </div>
                </div>
                <div class="stats-bg-icon"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-card-warning" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-icon-wrapper">
                    <div class="stats-icon"><i class="fas fa-exchange-alt"></i></div>
                </div>
                <div class="stats-content">
                    <h6 class="stats-label">Sedang Dipinjam</h6>
                    <h2 class="stats-value" data-count="{{ $sedangDipinjam }}">0</h2>
                    <div class="stats-footer">
                        <span class="stats-badge badge-warning">
                            <i class="fas fa-clock me-1"></i> Aktif
                        </span>
                    </div>
                </div>
                <div class="stats-bg-icon"><i class="fas fa-exchange-alt"></i></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stats-card stats-card-info" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-icon-wrapper">
                    <div class="stats-icon"><i class="fas fa-tags"></i></div>
                </div>
                <div class="stats-content">
                    <h6 class="stats-label">Total Kategori</h6>
                    <h2 class="stats-value" data-count="{{ $totalKategori }}">0</h2>
                    <div class="stats-footer">
                        <span class="stats-badge badge-primary">
                            <i class="fas fa-layer-group me-1"></i> Tersedia
                        </span>
                    </div>
                </div>
                <div class="stats-bg-icon"><i class="fas fa-tags"></i></div>
            </div>
        </div>
    </div>

    <!-- Mini Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="mini-stats-card mini-stats-purple" data-aos="fade-up" data-aos-delay="0">
                <div class="mini-stats-icon"><i class="fas fa-book-reader"></i></div>
                <div class="mini-stats-content">
                    <h4 data-count="{{ $totalStok }}">0</h4>
                    <p>Total Stok</p>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="mini-stats-card mini-stats-blue" data-aos="fade-up" data-aos-delay="50">
                <div class="mini-stats-icon"><i class="fas fa-layer-group"></i></div>
                <div class="mini-stats-content">
                    <h4 data-count="{{ $stokTinggi }}">0</h4>
                    <p>Stok Tinggi</p>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="mini-stats-card mini-stats-green" data-aos="fade-up" data-aos-delay="100">
                <div class="mini-stats-icon"><i class="fas fa-check-double"></i></div>
                <div class="mini-stats-content">
                    <h4 data-count="{{ $ebookAktif }}">0</h4>
                    <p>E-Book Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="mini-stats-card mini-stats-orange" data-aos="fade-up" data-aos-delay="150">
                <div class="mini-stats-icon"><i class="fas fa-star"></i></div>
                <div class="mini-stats-content">
                    <h4 data-count="{{ $bukuBaru }}">0</h4>
                    <p>Buku Baru</p>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="mini-stats-card mini-stats-pink" data-aos="fade-up" data-aos-delay="200">
                <div class="mini-stats-icon"><i class="fas fa-times-circle"></i></div>
                <div class="mini-stats-content">
                    <h4 data-count="{{ $stokHabis }}">0</h4>
                    <p>Stok Habis</p>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6">
            <div class="mini-stats-card mini-stats-teal" data-aos="fade-up" data-aos-delay="250">
                <div class="mini-stats-icon"><i class="fas fa-exchange-alt"></i></div>
                <div class="mini-stats-content">
                    <h4 data-count="{{ $sedangDipinjam }}">0</h4>
                    <p>Dipinjam Kini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Quick Actions -->
    <div class="row g-4 mb-4">
        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-6">
            <div class="quick-actions-card" data-aos="fade-up">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Aksi Cepat</h5>
                </div>
                <div class="card-body-custom">
                    <div class="quick-action-grid">
                        <a href="{{ route('admin.buku.create') }}" class="quick-action-item quick-action-primary">
                            <div class="quick-action-icon"><i class="fas fa-plus"></i></div>
                            <span>Tambah Buku</span>
                        </a>
                        <a href="{{ route('admin.buku.index') }}" class="quick-action-item quick-action-success">
                            <div class="quick-action-icon"><i class="fas fa-book"></i></div>
                            <span>Lihat Buku</span>
                        </a>
                        <a href="{{ route('admin.anggota.index') }}" class="quick-action-item quick-action-warning">
                            <div class="quick-action-icon"><i class="fas fa-users"></i></div>
                            <span>Anggota</span>
                        </a>
                        <a href="{{ route('admin.transaksi.index') }}" class="quick-action-item quick-action-info">
                            <div class="quick-action-icon"><i class="fas fa-exchange-alt"></i></div>
                            <span>Transaksi</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Distribution Chart -->
        <div class="col-xl-8 col-lg-6">
            <div class="chart-card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Distribusi Stok Buku</h5>
                        <div class="chart-type-switcher">
                            <button class="chart-btn active" data-chart="doughnut">
                                <i class="fas fa-chart-pie"></i>
                            </button>
                            <button class="chart-btn" data-chart="bar">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body-custom">
                    <div class="chart-container">
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Peminjaman Aktif + Kategori -->
    <div class="row g-4 mb-4">

        <div class="col-xl-6">
            <div class="table-card" data-aos="fade-up">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0">
                            <i class="fas fa-clock me-2"></i>
                            Peminjaman Aktif
                            @if($sedangDipinjam > 0)
                                <span class="badge-count ms-2">{{ $sedangDipinjam }}</span>
                            @endif
                        </h5>
                        <a href="{{ route('admin.transaksi.index', ['status' => 'pinjam']) }}"
                           class="btn btn-gradient-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i> Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body-custom p-0">
                    @if($peminjamanAktif->isEmpty())
                        <div class="empty-state-sm">
                            <i class="fas fa-check-circle text-success"></i>
                            <p>Tidak ada peminjaman aktif saat ini.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-modern mb-0">
                                <thead>
                                    <tr>
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th class="text-center">Tenggat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($peminjamanAktif as $t)
                                    @php
                                        $sisa = \Carbon\Carbon::today()->diffInDays(
                                            \Carbon\Carbon::parse($t->tanggal_batas), false
                                        );
                                    @endphp
                                    <tr>
                                        <td>
                                            <span style="font-weight:600;font-size:.85rem;">
                                                {{ $t->user->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span style="font-size:.83rem;color:var(--text-secondary);">
                                                {{ \Illuminate\Support\Str::limit($t->ebook->judul_buku ?? '-', 28) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if($sisa < 0)
                                                <span class="stock-badge stock-empty">
                                                    Lewat {{ abs($sisa) }}h
                                                </span>
                                            @elseif($sisa <= 2)
                                                <span class="stock-badge stock-medium">
                                                    {{ $sisa }} hari lagi
                                                </span>
                                            @else
                                                <span class="stock-badge stock-high">
                                                    {{ $sisa }} hari lagi
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <form method="POST"
                                                  action="{{ route('admin.transaksi.kembalikan', $t->id_peminjam) }}"
                                                  onsubmit="return confirm('Kembalikan buku ini?')">
                                                @csrf
                                                <button type="submit"
                                                        class="btn-action-mini btn-action-return"
                                                        title="Kembalikan">
                                                    <i class="fas fa-undo-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Distribusi Kategori -->
        <div class="col-xl-6">
            <div class="category-card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-layer-group me-2"></i>Distribusi Kategori</h5>
                </div>
                <div class="card-body-custom">
                    <div class="category-list">
                        @foreach($categories as $category)
                        @php
                            $percentage = $totalEbook > 0
                                ? ($category->ebooks_count / $totalEbook * 100)
                                : 0;
                        @endphp
                        <div class="category-item" data-aos="fade-right" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="category-info">
                                <div class="category-icon"><i class="fas fa-bookmark"></i></div>
                                <div class="category-details">
                                    <h6>{{ $category->nama_kategori }}</h6>
                                    <small>{{ $category->ebooks_count }} buku</small>
                                </div>
                            </div>
                            <div class="category-progress">
                                <div class="progress-bar-custom">
                                    <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="percentage-text">{{ number_format($percentage, 1) }}%</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru + Buku Terbaru -->
    <div class="row g-4 mb-4">
        <!-- Activity Timeline -->
        <div class="col-xl-5">
            <div class="activity-card" data-aos="fade-up">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Aktivitas Terbaru</h5>
                </div>
                <div class="card-body-custom">
                    <div class="timeline">
                        @foreach($recentBooks as $book)
                        <div class="timeline-item" data-aos="fade-left" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="timeline-marker"></div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <span class="timeline-icon"><i class="fas fa-plus-circle"></i></span>
                                    <span class="timeline-title">Buku Ditambahkan</span>
                                    <span class="timeline-date">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $book->created_at ? $book->created_at->diffForHumans() : '-' }}
                                    </span>
                                </div>
                                <div class="timeline-body">
                                    <strong>{{ $book->judul_buku }}</strong>
                                    <p class="mb-0">Oleh: {{ $book->pengarang }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Buku Terbaru -->
        <div class="col-xl-7">
            <div class="table-card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0"><i class="fas fa-sparkles me-2"></i>E-Book Terbaru</h5>
                        <a href="{{ route('admin.buku.index') }}" class="btn btn-gradient-primary btn-sm">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body-custom p-0">
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th style="width:40px;">No</th>
                                    <th>Judul Buku</th>
                                    <th>Kategori</th>
                                    <th style="width:90px;">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestBooks as $index => $book)
                                <tr class="table-row-hover">
                                    <td><span class="row-number">{{ $index + 1 }}</span></td>
                                    <td>
                                        <div class="book-title-cell">
                                            <i class="fas fa-book text-primary me-2"></i>
                                            <div>
                                                <strong style="font-size:.88rem;">{{ $book->judul_buku }}</strong>
                                                <div class="author-text" style="font-size:.75rem;">{{ $book->pengarang }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-category-modern">
                                            <i class="fas fa-tag me-1"></i>
                                            {{ $book->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($book->jumlah_ebook > 10)
                                            <span class="stock-badge stock-high">
                                                <i class="fas fa-check-circle me-1"></i>{{ $book->jumlah_ebook }}
                                            </span>
                                        @elseif($book->jumlah_ebook > 0)
                                            <span class="stock-badge stock-medium">
                                                <i class="fas fa-exclamation-triangle me-1"></i>{{ $book->jumlah_ebook }}
                                            </span>
                                        @else
                                            <span class="stock-badge stock-empty">
                                                <i class="fas fa-times-circle me-1"></i>Habis
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- /.w-full -->

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    /* ══ ALERT DASHBOARD ══ */
    .alert-dashboard {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        border-radius: 12px;
        font-size: 0.88rem;
        font-weight: 500;
    }
    .alert-dashboard-warning {
        background: linear-gradient(135deg, #fff8ed, #fff0d8);
        border: 1px solid #f0c08a;
        border-left: 4px solid #b5651d;
        color: #7a4010;
    }
    .alert-dashboard-warning .alert-link {
        color: #b5651d;
        font-weight: 700;
        text-decoration: none;
    }
    .alert-dashboard-warning .alert-link:hover { text-decoration: underline; }

    /* ══ BADGE COUNT ══ */
    .badge-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 800;
        padding: 2px 9px;
        min-width: 24px;
    }

    /* ══ EMPTY STATE SMALL ══ */
    .empty-state-sm {
        text-align: center;
        padding: 32px 20px;
        color: var(--text-secondary);
        font-size: 0.88rem;
    }
    .empty-state-sm i { font-size: 2rem; display: block; margin-bottom: 10px; }

    /* ══ RETURN BUTTON ══ */
    .btn-action-return {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    /* ═══ BASE STYLES ═══ */
    .w-full { width: 100% !important; }
    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl {
        max-width: 100% !important;
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
    }
    .row { margin-left: -0.75rem !important; margin-right: -0.75rem !important; }
    [class*="col-"] { padding-left: 0.75rem !important; padding-right: 0.75rem !important; }

    :root {
        --bg-primary: #f8f9fa; --bg-secondary: #ffffff; --text-primary: #2d3748;
        --text-secondary: #718096; --border-color: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0,0,0,.12); --shadow-md: 0 4px 6px rgba(0,0,0,.1);
        --shadow-lg: 0 10px 25px rgba(0,0,0,.15); --shadow-xl: 0 20px 40px rgba(0,0,0,.2);
        --gradient-primary: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
        --gradient-success: linear-gradient(135deg,#11998e 0%,#38ef7d 100%);
        --gradient-warning: linear-gradient(135deg,#f093fb 0%,#f5576c 100%);
        --gradient-info: linear-gradient(135deg,#36d1dc 0%,#5b86e5 100%);
        --gradient-danger: linear-gradient(135deg,#fa709a 0%,#fee140 100%);
        --hover-bg: #f7fafc;
    }
    [data-theme="dark"] {
        --bg-primary: #1a202c; --bg-secondary: #2d3748; --text-primary: #f7fafc;
        --text-secondary: #a0aec0; --border-color: #4a5568; --hover-bg: #374151;
        --shadow-sm: 0 1px 3px rgba(0,0,0,.3); --shadow-md: 0 4px 6px rgba(0,0,0,.4);
        --shadow-lg: 0 10px 25px rgba(0,0,0,.5); --shadow-xl: 0 20px 40px rgba(0,0,0,.6);
    }
    body { background-color: var(--bg-primary); color: var(--text-primary); transition: background-color .3s,color .3s; padding: 0; }

    .welcome-card { background:var(--gradient-primary); border-radius:20px; padding:2rem; position:relative; overflow:hidden; box-shadow:var(--shadow-xl); animation:slideInDown .6s ease; }
    @keyframes slideInDown { from{opacity:0;transform:translateY(-30px)} to{opacity:1;transform:translateY(0)} }
    .welcome-content { position:relative; z-index:2; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem; }
    .welcome-text { display:flex; align-items:center; gap:1.5rem; color:white; }
    .welcome-icon { width:70px; height:70px; background:rgba(255,255,255,.2); border-radius:15px; display:flex; align-items:center; justify-content:center; font-size:32px; backdrop-filter:blur(10px); }
    .welcome-text h2 { font-size:1.8rem; font-weight:700; margin:0; color:white; }
    .welcome-text p { font-size:1rem; opacity:.9; }
    .welcome-date { background:rgba(255,255,255,.2); padding:.75rem 1.5rem; border-radius:50px; color:white; font-weight:600; backdrop-filter:blur(10px); }
    .welcome-decoration { position:absolute; right:-50px; top:50%; transform:translateY(-50%); font-size:250px; opacity:.1; color:white; }

    .stats-card { background:var(--bg-secondary); border-radius:20px; padding:1.75rem; position:relative; overflow:hidden; box-shadow:var(--shadow-md); transition:all .4s cubic-bezier(.175,.885,.32,1.275); border:1px solid var(--border-color); height:100%; }
    .stats-card:hover { transform:translateY(-10px); box-shadow:var(--shadow-xl); }
    .stats-card::before { content:''; position:absolute; top:0; left:0; width:100%; height:4px; transition:height .3s; }
    .stats-card-primary::before { background:var(--gradient-primary); }
    .stats-card-success::before { background:var(--gradient-success); }
    .stats-card-warning::before { background:var(--gradient-warning); }
    .stats-card-info::before    { background:var(--gradient-info); }
    .stats-card:hover::before   { height:8px; }
    .stats-icon-wrapper { margin-bottom:1.5rem; }
    .stats-icon { width:65px; height:65px; border-radius:15px; display:flex; align-items:center; justify-content:center; font-size:28px; color:white; transition:transform .3s; }
    .stats-card:hover .stats-icon { transform:scale(1.1) rotate(5deg); }
    .stats-card-primary .stats-icon { background:var(--gradient-primary); }
    .stats-card-success .stats-icon { background:var(--gradient-success); }
    .stats-card-warning .stats-icon { background:var(--gradient-warning); }
    .stats-card-info .stats-icon    { background:var(--gradient-info); }
    .stats-label { color:var(--text-secondary); font-size:.9rem; font-weight:600; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.5rem; }
    .stats-value { font-size:2.5rem; font-weight:800; color:var(--text-primary); margin-bottom:1rem; line-height:1; }
    .stats-footer { margin-top:1rem; }
    .stats-badge { display:inline-flex; align-items:center; padding:.4rem 1rem; border-radius:50px; font-size:.8rem; font-weight:600; }
    .badge-success { background:linear-gradient(135deg,rgba(17,153,142,.2),rgba(56,239,125,.2)); color:#11998e; }
    .badge-info    { background:linear-gradient(135deg,rgba(54,209,220,.2),rgba(91,134,229,.2)); color:#36d1dc; }
    .badge-warning { background:linear-gradient(135deg,rgba(240,147,251,.2),rgba(245,87,108,.2)); color:#f5576c; }
    .badge-primary { background:linear-gradient(135deg,rgba(102,126,234,.2),rgba(118,75,162,.2)); color:#667eea; }
    .stats-bg-icon { position:absolute; right:-20px; bottom:-20px; font-size:150px; opacity:.05; color:var(--text-primary); transform:rotate(-15deg); }

    .mini-stats-card { background:var(--bg-secondary); border-radius:15px; padding:1.25rem; display:flex; align-items:center; gap:1rem; box-shadow:var(--shadow-md); transition:all .3s; border:1px solid var(--border-color); position:relative; overflow:hidden; }
    .mini-stats-card::before { content:''; position:absolute; top:0; left:0; width:4px; height:100%; transition:width .3s; }
    .mini-stats-card:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); }
    .mini-stats-card:hover::before { width:100%; opacity:.1; }
    .mini-stats-purple::before { background:var(--gradient-primary); }
    .mini-stats-blue::before   { background:var(--gradient-info); }
    .mini-stats-green::before  { background:var(--gradient-success); }
    .mini-stats-orange::before { background:linear-gradient(135deg,#fa8c16,#ffc53d); }
    .mini-stats-pink::before   { background:var(--gradient-warning); }
    .mini-stats-teal::before   { background:linear-gradient(135deg,#0ba360,#3cba92); }
    .mini-stats-icon { width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:22px; color:white; transition:transform .3s; flex-shrink:0; }
    .mini-stats-card:hover .mini-stats-icon { transform:scale(1.15) rotate(10deg); }
    .mini-stats-purple .mini-stats-icon { background:var(--gradient-primary); }
    .mini-stats-blue .mini-stats-icon   { background:var(--gradient-info); }
    .mini-stats-green .mini-stats-icon  { background:var(--gradient-success); }
    .mini-stats-orange .mini-stats-icon { background:linear-gradient(135deg,#fa8c16,#ffc53d); }
    .mini-stats-pink .mini-stats-icon   { background:var(--gradient-warning); }
    .mini-stats-teal .mini-stats-icon   { background:linear-gradient(135deg,#0ba360,#3cba92); }
    .mini-stats-content h4 { font-size:1.75rem; font-weight:800; color:var(--text-primary); margin:0; line-height:1; }
    .mini-stats-content p  { font-size:.8rem; color:var(--text-secondary); margin:.25rem 0 0; font-weight:600; }

    .quick-actions-card,.chart-card,.table-card,.category-card,.activity-card { background:var(--bg-secondary); border-radius:20px; box-shadow:var(--shadow-md); overflow:hidden; border:1px solid var(--border-color); height:100%; }
    .card-header-custom { padding:1.5rem; border-bottom:2px solid var(--border-color); background:var(--bg-secondary); }
    .card-header-custom h5 { color:var(--text-primary); font-weight:700; }
    .card-body-custom { padding:1.5rem; }
    .quick-action-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1rem; }
    .quick-action-item { display:flex; flex-direction:column; align-items:center; gap:.75rem; padding:1.5rem; border-radius:15px; text-decoration:none; transition:all .3s; border:2px solid var(--border-color); background:var(--bg-secondary); }
    .quick-action-item:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); }
    .quick-action-icon { width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:22px; color:white; transition:transform .3s; }
    .quick-action-item:hover .quick-action-icon { transform:scale(1.15) rotate(10deg); }
    .quick-action-primary .quick-action-icon { background:var(--gradient-primary); }
    .quick-action-success .quick-action-icon { background:var(--gradient-success); }
    .quick-action-warning .quick-action-icon { background:var(--gradient-warning); }
    .quick-action-info .quick-action-icon    { background:var(--gradient-info); }
    .quick-action-item span { color:var(--text-primary); font-weight:600; font-size:.9rem; }
    .quick-action-primary:hover { border-color:#667eea; }
    .quick-action-success:hover { border-color:#11998e; }
    .quick-action-warning:hover { border-color:#f5576c; }
    .quick-action-info:hover    { border-color:#36d1dc; }

    .chart-container { position:relative; height:300px; }
    .chart-type-switcher { display:flex; gap:.5rem; background:var(--bg-primary); padding:.4rem; border-radius:10px; }
    .chart-btn { width:40px; height:40px; border:none; background:transparent; color:var(--text-secondary); border-radius:8px; cursor:pointer; transition:all .3s; display:flex; align-items:center; justify-content:center; }
    .chart-btn:hover  { background:var(--bg-secondary); color:var(--text-primary); }
    .chart-btn.active { background:var(--gradient-primary); color:white; }

    .btn-gradient-primary { background:var(--gradient-primary); border:none; color:white; font-weight:600; padding:.6rem 1.5rem; border-radius:10px; transition:all .3s; }
    .btn-gradient-primary:hover { transform:translateY(-2px); box-shadow:var(--shadow-lg); color:white; }

    .table-modern { color:var(--text-primary); }
    .table-modern thead { background:linear-gradient(135deg,rgba(102,126,234,.1),rgba(118,75,162,.1)); }
    .table-modern thead th { border:none; font-weight:700; text-transform:uppercase; font-size:.75rem; letter-spacing:.5px; padding:1rem; color:var(--text-primary); }
    .table-modern tbody tr { border-bottom:1px solid var(--border-color); transition:all .3s; }
    .table-modern tbody tr:hover { background:var(--hover-bg); }
    .table-modern tbody td { padding:1rem; vertical-align:middle; }
    .row-number { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; background:var(--gradient-primary); color:white; border-radius:8px; font-weight:700; font-size:.85rem; }
    .book-title-cell { display:flex; align-items:center; color:var(--text-primary); }
    .author-text { color:var(--text-secondary); font-size:.9rem; }
    .badge-category-modern { display:inline-flex; align-items:center; padding:.5rem 1rem; background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.15)); color:#667eea; border-radius:20px; font-size:.85rem; font-weight:600; }
    .stock-badge { display:inline-flex; align-items:center; padding:.4rem .9rem; border-radius:20px; font-weight:700; font-size:.82rem; }
    .stock-high   { background:linear-gradient(135deg,rgba(17,153,142,.2),rgba(56,239,125,.2)); color:#11998e; }
    .stock-medium { background:linear-gradient(135deg,rgba(240,147,251,.2),rgba(245,87,108,.2)); color:#f5576c; }
    .stock-empty  { background:linear-gradient(135deg,rgba(250,112,154,.2),rgba(254,225,64,.2)); color:#fa709a; }
    .btn-action-mini { width:36px; height:36px; border-radius:10px; border:none; display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transition:all .3s; text-decoration:none; }
    .btn-action-view   { background:var(--gradient-info); color:white; }
    .btn-action-return { background:var(--gradient-success); color:white; }
    .btn-action-mini:hover { transform:translateY(-3px); box-shadow:var(--shadow-md); }

    .category-list { display:flex; flex-direction:column; gap:1.25rem; }
    .category-item { display:flex; justify-content:space-between; align-items:center; gap:1rem; padding:1rem; background:var(--bg-primary); border-radius:12px; transition:all .3s; }
    .category-item:hover { transform:translateX(5px); box-shadow:var(--shadow-sm); }
    .category-info { display:flex; align-items:center; gap:1rem; flex:1; }
    .category-icon { width:45px; height:45px; background:var(--gradient-primary); border-radius:10px; display:flex; align-items:center; justify-content:center; color:white; font-size:18px; flex-shrink:0; }
    .category-item:nth-child(1) .category-icon { background:var(--gradient-primary); }
    .category-item:nth-child(2) .category-icon { background:var(--gradient-success); }
    .category-item:nth-child(3) .category-icon { background:var(--gradient-info); }
    .category-item:nth-child(4) .category-icon { background:var(--gradient-warning); }
    .category-item:nth-child(5) .category-icon { background:var(--gradient-danger); }
    .category-details h6 { margin:0; color:var(--text-primary); font-weight:700; font-size:.95rem; }
    .category-details small { color:var(--text-secondary); font-size:.8rem; }
    .category-progress { display:flex; align-items:center; gap:.75rem; min-width:150px; }
    .progress-bar-custom { flex:1; height:8px; background:var(--border-color); border-radius:10px; overflow:hidden; }
    .progress-fill { height:100%; background:var(--gradient-primary); border-radius:10px; transition:width 1s; }
    .category-item:nth-child(1) .progress-fill { background:var(--gradient-primary); }
    .category-item:nth-child(2) .progress-fill { background:var(--gradient-success); }
    .category-item:nth-child(3) .progress-fill { background:var(--gradient-info); }
    .category-item:nth-child(4) .progress-fill { background:var(--gradient-warning); }
    .category-item:nth-child(5) .progress-fill { background:var(--gradient-danger); }
    .percentage-text { font-weight:700; color:var(--text-primary); font-size:.9rem; min-width:50px; text-align:right; }

    .timeline { position:relative; padding-left:2rem; }
    .timeline::before { content:''; position:absolute; left:8px; top:0; bottom:0; width:2px; background:var(--border-color); }
    .timeline-item { position:relative; padding-bottom:1.5rem; }
    .timeline-item:last-child { padding-bottom:0; }
    .timeline-marker { position:absolute; left:-2rem; top:5px; width:18px; height:18px; border-radius:50%; background:var(--gradient-primary); border:3px solid var(--bg-secondary); box-shadow:0 0 0 3px var(--border-color); z-index:1; }
    .timeline-item:nth-child(2) .timeline-marker { background:var(--gradient-success); }
    .timeline-item:nth-child(3) .timeline-marker { background:var(--gradient-info); }
    .timeline-item:nth-child(4) .timeline-marker { background:var(--gradient-warning); }
    .timeline-item:nth-child(5) .timeline-marker { background:var(--gradient-danger); }
    .timeline-content { background:var(--bg-primary); padding:1rem; border-radius:12px; transition:all .3s; }
    .timeline-content:hover { transform:translateX(5px); box-shadow:var(--shadow-sm); }
    .timeline-header { display:flex; align-items:center; gap:.5rem; margin-bottom:.5rem; flex-wrap:wrap; }
    .timeline-icon { width:28px; height:28px; background:var(--gradient-primary); border-radius:8px; display:flex; align-items:center; justify-content:center; color:white; font-size:12px; }
    .timeline-item:nth-child(2) .timeline-icon { background:var(--gradient-success); }
    .timeline-item:nth-child(3) .timeline-icon { background:var(--gradient-info); }
    .timeline-item:nth-child(4) .timeline-icon { background:var(--gradient-warning); }
    .timeline-item:nth-child(5) .timeline-icon { background:var(--gradient-danger); }
    .timeline-title { font-weight:700; color:var(--text-primary); font-size:.9rem; }
    .timeline-date  { font-size:.75rem; color:var(--text-secondary); margin-left:auto; }
    .timeline-body  { padding-left:2rem; }
    .timeline-body strong { color:var(--text-primary); font-size:.95rem; }
    .timeline-body p { color:var(--text-secondary); font-size:.85rem; margin-top:.25rem; }

    @media(max-width:768px) {
        .welcome-text { flex-direction:column; align-items:flex-start; }
        .welcome-text h2 { font-size:1.5rem; }
        .welcome-decoration { font-size:150px; right:-30px; }
        .stats-value { font-size:2rem; }
        .quick-action-grid { grid-template-columns:1fr; }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, easing: 'ease-in-out', once: true });

    document.addEventListener('DOMContentLoaded', function () {

        // ── Tanggal ──────────────────────────────────────────
        document.getElementById('currentDate').textContent =
            new Date().toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });

        // ── Counter animation ────────────────────────────────
        document.querySelectorAll('.stats-value, .mini-stats-content h4').forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count')) || 0;
            if (target === 0) return;
            const increment = target / (2000 / 16);
            let current = 0;
            const update = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.floor(current);
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target;
                }
            };
            new IntersectionObserver((entries) => {
                entries.forEach(e => { if (e.isIntersecting) update(); });
            }).observe(counter);
        });

        // ── Chart ─────────────────────────────────────────────
        const ctx       = document.getElementById('stockChart');
        const isDark    = document.documentElement.getAttribute('data-theme') === 'dark';
        const chartData = [{{ $chartStokTinggi }}, {{ $chartStokRendah }}, {{ $chartStokHabis }}];

        function buildChart(type) {
            return new Chart(ctx, {
                type: type,
                data: {
                    labels: ['Stok Tinggi (>10)', 'Stok Rendah (1-10)', 'Stok Habis (0)'],
                    datasets: [{
                        label: 'Jumlah Buku',
                        data: chartData,
                        backgroundColor: ['rgba(17,153,142,.8)', 'rgba(245,87,108,.8)', 'rgba(250,112,154,.8)'],
                        borderColor:     ['rgba(17,153,142,1)',  'rgba(245,87,108,1)',  'rgba(250,112,154,1)'],
                        borderWidth: 2,
                        borderRadius: type === 'bar' ? 10 : 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20, font: { size: 13, weight: '600' },
                                color: isDark ? '#f7fafc' : '#2d3748',
                                usePointStyle: true, pointStyle: 'circle'
                            }
                        },
                        tooltip: { backgroundColor: 'rgba(0,0,0,.8)', padding: 12 }
                    },
                    scales: type === 'bar' ? {
                        y: {
                            beginAtZero: true,
                            grid: { color: isDark ? 'rgba(255,255,255,.1)' : 'rgba(0,0,0,.1)' },
                            ticks: { color: isDark ? '#f7fafc' : '#2d3748' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: isDark ? '#f7fafc' : '#2d3748' }
                        }
                    } : {}
                }
            });
        }

        window.stockChart = buildChart('doughnut');

        document.querySelectorAll('.chart-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.chart-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                window.stockChart.destroy();
                window.stockChart = buildChart(this.getAttribute('data-chart'));
            });
        });
    });
</script>
@endpush
@endsection