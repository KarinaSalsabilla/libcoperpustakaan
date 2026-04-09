@extends('layouts.admin')

@section('page-title', 'Manajemen Anggota')

@section('main-class', '')

@section('content')
    <div class="w-full">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header-card" data-aos="fade-down">
                    <div class="page-header-content">
                        <div class="page-header-text">
                            <div class="page-header-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h2 class="mb-2">Manajemen Anggota</h2>
                                <p class="mb-0">Kelola data anggota perpustakaan digital</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-gradient-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="stats-card stats-card-primary" data-aos="fade-up" data-aos-delay="0">
                    <div class="stats-icon-wrapper">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stats-content">
                        <h6 class="stats-label">Total Anggota</h6>
                        <h2 class="stats-value" data-count="{{ $totalAnggota }}">0</h2>
                        <div class="stats-footer">
                            <span class="stats-badge badge-success">
                                <i class="fas fa-user-check me-1"></i> Terdaftar
                            </span>
                        </div>
                    </div>
                    <div class="stats-bg-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stats-card stats-card-success" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-icon-wrapper">
                        <div class="stats-icon">
                            <i class="fas fa-venus"></i>
                        </div>
                    </div>
                    <div class="stats-content">
                        <h6 class="stats-label">Anggota Perempuan</h6>
                        <h2 class="stats-value" data-count="{{ $totalPerempuan }}">0</h2>
                        <div class="stats-footer">
                            <span class="stats-badge badge-info">
                                <i class="fas fa-female me-1"></i> {{ number_format(($totalPerempuan / max($totalAnggota, 1)) * 100, 1) }}%
                            </span>
                        </div>
                    </div>
                    <div class="stats-bg-icon">
                        <i class="fas fa-venus"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stats-card stats-card-info" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-icon-wrapper">
                        <div class="stats-icon">
                            <i class="fas fa-mars"></i>
                        </div>
                    </div>
                    <div class="stats-content">
                        <h6 class="stats-label">Anggota Laki-laki</h6>
                        <h2 class="stats-value" data-count="{{ $totalLakiLaki }}">0</h2>
                        <div class="stats-footer">
                            <span class="stats-badge badge-primary">
                                <i class="fas fa-male me-1"></i> {{ number_format(($totalLakiLaki / max($totalAnggota, 1)) * 100, 1) }}%
                            </span>
                        </div>
                    </div>
                    <div class="stats-bg-icon">
                        <i class="fas fa-mars"></i>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="stats-card stats-card-warning" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-icon-wrapper">
                        <div class="stats-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    <div class="stats-content">
                        <h6 class="stats-label">Anggota Baru</h6>
                        <h2 class="stats-value" data-count="{{ $anggotaBaru }}">0</h2>
                        <div class="stats-footer">
                            <span class="stats-badge badge-warning">
                                <i class="fas fa-calendar me-1"></i> 30 Hari Terakhir
                            </span>
                        </div>
                    </div>
                    <div class="stats-bg-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Search Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="filter-card" data-aos="fade-up">
                    <div class="card-body-custom">
                        <form action="{{ route('admin.anggota.index') }}" method="GET" class="filter-form">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label-custom">
                                        <i class="fas fa-search me-2"></i>Pencarian
                                    </label>
                                    <input type="text" name="search" class="form-control-custom" 
                                           placeholder="Cari nama, no HP, atau kota..." 
                                           value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-custom">
                                        <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin
                                    </label>
                                    <select name="jenis_kelamin" class="form-control-custom">
                                        <option value="">Semua</option>
                                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label-custom">
                                        <i class="fas fa-city me-2"></i>Kota
                                    </label>
                                    <select name="kota" class="form-control-custom">
                                        <option value="">Semua Kota</option>
                                        @foreach($kotaList as $kota)
                                            <option value="{{ $kota }}" {{ request('kota') == $kota ? 'selected' : '' }}>
                                                {{ $kota }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-gradient-primary w-100">
                                        <i class="fas fa-filter me-2"></i>Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Members Table -->
        <div class="row">
            <div class="col-12">
                <div class="table-card" data-aos="fade-up">
                    <div class="card-header-custom">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <h5 class="mb-0">
                                <i class="fas fa-list me-2"></i>
                                Daftar Anggota
                                <span class="badge-count">{{ $anggotas->total() }}</span>
                            </h5>
                            <div class="d-flex gap-2">
                                <button class="btn btn-gradient-success btn-sm" onclick="window.print()">
                                    <i class="fas fa-print me-2"></i>
                                    Cetak
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body-custom p-0">
                        <div class="table-responsive">
                            <table class="table table-modern mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kota</th>
                                        <th>Agama</th>
                                        <th>Tempat, Tgl Lahir</th>
                                        <th style="width: 150px;" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($anggotas as $index => $anggota)
                                        <tr class="table-row-hover">
                                            <td>
                                                <span class="row-number">{{ $anggotas->firstItem() + $index }}</span>
                                            </td>
                                            <td>
                                                <div class="member-info">
                                                    <div class="member-avatar">
                                                        @if($anggota->jenis_kelamin == 'L')
                                                            <i class="fas fa-user-tie"></i>
                                                        @else
                                                            <i class="fas fa-user"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <strong class="member-name">{{ $anggota->nama }}</strong>
                                                        <small class="member-id">ID: {{ $anggota->id_user }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="contact-badge">
                                                    <i class="fas fa-phone me-1"></i>
                                                    {{ $anggota->nohp ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($anggota->jenis_kelamin == 'L')
                                                    <span class="gender-badge gender-male">
                                                        <i class="fas fa-mars me-1"></i>
                                                        Laki-laki
                                                    </span>
                                                @elseif($anggota->jenis_kelamin == 'P')
                                                    <span class="gender-badge gender-female">
                                                        <i class="fas fa-venus me-1"></i>
                                                        Perempuan
                                                    </span>
                                                @else
                                                    <span class="gender-badge">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="location-badge">
                                                    <i class="fas fa-map-marker-alt me-1"></i>
                                                    {{ $anggota->kota ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="religion-badge">
                                                    <i class="fas fa-mosque me-1"></i>
                                                    {{ $anggota->agama ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="birth-info">
                                                    <small>{{ $anggota->tempat_lahir ?? '-' }}</small>
                                                    <small class="text-muted">
                                                        {{ $anggota->tgl_lahir ? date('d/m/Y', strtotime($anggota->tgl_lahir)) : '-' }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.anggota.show', $anggota->id_user) }}" 
                                                       class="btn-action-mini btn-action-view" 
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.anggota.edit', $anggota->id_user) }}" 
                                                       class="btn-action-mini btn-action-edit" 
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.anggota.destroy', $anggota->id_user) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn-action-mini btn-action-delete" 
                                                                title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <div class="empty-state">
                                                    <i class="fas fa-users-slash"></i>
                                                    <h5>Tidak ada data anggota</h5>
                                                    <p>Belum ada anggota yang terdaftar</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if($anggotas->hasPages())
                            <div class="card-footer-custom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="pagination-info">
                                        Menampilkan {{ $anggotas->firstItem() }} - {{ $anggotas->lastItem() }} 
                                        dari {{ $anggotas->total() }} anggota
                                    </div>
                                    {{ $anggotas->links() }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <style>
            :root {
                --bg-primary: #f8f9fa;
                --bg-secondary: #ffffff;
                --text-primary: #2d3748;
                --text-secondary: #718096;
                --border-color: #e2e8f0;
                --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
                --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
                --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.2);
                --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --gradient-secondary: linear-gradient(135deg, #6c757d 0%, #495057 100%);
                --gradient-success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
                --gradient-warning: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                --gradient-info: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);
                --gradient-danger: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
                --hover-bg: #f7fafc;
            }

            [data-theme="dark"] {
                --bg-primary: #1a202c;
                --bg-secondary: #2d3748;
                --text-primary: #f7fafc;
                --text-secondary: #a0aec0;
                --border-color: #4a5568;
                --hover-bg: #374151;
            }

            body {
                background-color: var(--bg-primary);
                color: var(--text-primary);
            }

            .w-full {
                width: 100% !important;
            }

            /* Page Header Card */
            .page-header-card {
                background: var(--gradient-primary);
                border-radius: 20px;
                padding: 2rem;
                box-shadow: var(--shadow-xl);
                margin-bottom: 2rem;
            }

            .page-header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .page-header-text {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                color: white;
            }

            .page-header-icon {
                width: 70px;
                height: 70px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                backdrop-filter: blur(10px);
            }

            .page-header-text h2 {
                font-size: 1.8rem;
                font-weight: 700;
                margin: 0;
                color: white;
            }

            .page-header-text p {
                font-size: 1rem;
                opacity: 0.9;
            }

            .btn-gradient-secondary {
                background: var(--gradient-secondary);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.6rem 1.5rem;
                border-radius: 10px;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
            }

            .btn-gradient-secondary:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
                color: white;
            }

            /* Stats Cards */
            .stats-card {
                background: var(--bg-secondary);
                border-radius: 20px;
                padding: 1.75rem;
                position: relative;
                overflow: hidden;
                box-shadow: var(--shadow-md);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                border: 1px solid var(--border-color);
                height: 100%;
            }

            .stats-card:hover {
                transform: translateY(-10px);
                box-shadow: var(--shadow-xl);
            }

            .stats-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 4px;
                background: var(--gradient-primary);
                transition: height 0.3s ease;
            }

            .stats-card-primary::before {
                background: var(--gradient-primary);
            }

            .stats-card-success::before {
                background: var(--gradient-success);
            }

            .stats-card-warning::before {
                background: var(--gradient-warning);
            }

            .stats-card-info::before {
                background: var(--gradient-info);
            }

            .stats-card:hover::before {
                height: 8px;
            }

            .stats-icon-wrapper {
                margin-bottom: 1.5rem;
            }

            .stats-icon {
                width: 65px;
                height: 65px;
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 28px;
                color: white;
                transition: transform 0.3s ease;
            }

            .stats-card:hover .stats-icon {
                transform: scale(1.1) rotate(5deg);
            }

            .stats-card-primary .stats-icon {
                background: var(--gradient-primary);
            }

            .stats-card-success .stats-icon {
                background: var(--gradient-success);
            }

            .stats-card-warning .stats-icon {
                background: var(--gradient-warning);
            }

            .stats-card-info .stats-icon {
                background: var(--gradient-info);
            }

            .stats-content {
                position: relative;
                z-index: 2;
            }

            .stats-label {
                color: var(--text-secondary);
                font-size: 0.9rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 0.5rem;
            }

            .stats-value {
                font-size: 2.5rem;
                font-weight: 800;
                color: var(--text-primary);
                margin-bottom: 1rem;
                line-height: 1;
            }

            .stats-footer {
                margin-top: 1rem;
            }

            .stats-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.4rem 1rem;
                border-radius: 50px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .badge-success {
                background: linear-gradient(135deg, rgba(17, 153, 142, 0.2) 0%, rgba(56, 239, 125, 0.2) 100%);
                color: #11998e;
            }

            .badge-info {
                background: linear-gradient(135deg, rgba(54, 209, 220, 0.2) 0%, rgba(91, 134, 229, 0.2) 100%);
                color: #36d1dc;
            }

            .badge-warning {
                background: linear-gradient(135deg, rgba(240, 147, 251, 0.2) 0%, rgba(245, 87, 108, 0.2) 100%);
                color: #f5576c;
            }

            .badge-primary {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
                color: #667eea;
            }

            .stats-bg-icon {
                position: absolute;
                right: -20px;
                bottom: -20px;
                font-size: 150px;
                opacity: 0.05;
                color: var(--text-primary);
                transform: rotate(-15deg);
            }

            /* Filter Card */
            .filter-card {
                background: var(--bg-secondary);
                border-radius: 20px;
                box-shadow: var(--shadow-md);
                overflow: hidden;
                border: 1px solid var(--border-color);
            }

            .card-body-custom {
                padding: 1.5rem;
            }

            .form-label-custom {
                font-weight: 600;
                color: var(--text-primary);
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
                display: block;
            }

            .form-control-custom {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid var(--border-color);
                border-radius: 10px;
                background: var(--bg-primary);
                color: var(--text-primary);
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .form-control-custom:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            /* Table Card */
            .table-card {
                background: var(--bg-secondary);
                border-radius: 20px;
                box-shadow: var(--shadow-md);
                overflow: hidden;
                border: 1px solid var(--border-color);
            }

            .card-header-custom {
                padding: 1.5rem;
                border-bottom: 2px solid var(--border-color);
                background: var(--bg-secondary);
            }

            .card-header-custom h5 {
                color: var(--text-primary);
                font-weight: 700;
                display: flex;
                align-items: center;
            }

            .badge-count {
                background: var(--gradient-primary);
                color: white;
                padding: 0.3rem 0.8rem;
                border-radius: 20px;
                font-size: 0.85rem;
                margin-left: 0.5rem;
            }

            .btn-gradient-primary {
                background: var(--gradient-primary);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.6rem 1.5rem;
                border-radius: 10px;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
            }

            .btn-gradient-primary:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
                color: white;
            }

            .btn-gradient-success {
                background: var(--gradient-success);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.6rem 1.5rem;
                border-radius: 10px;
                transition: all 0.3s ease;
            }

            .btn-gradient-success:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
                color: white;
            }

            /* Table */
            .table-modern {
                color: var(--text-primary);
            }

            .table-modern thead {
                background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            }

            .table-modern thead th {
                border: none;
                font-weight: 700;
                text-transform: uppercase;
                font-size: 0.75rem;
                letter-spacing: 0.5px;
                padding: 1.25rem 1rem;
                color: var(--text-primary);
            }

            .table-modern tbody tr {
                border-bottom: 1px solid var(--border-color);
                transition: all 0.3s ease;
            }

            .table-modern tbody tr:hover {
                background: var(--hover-bg);
                transform: scale(1.01);
            }

            .table-modern tbody td {
                padding: 1.25rem 1rem;
                vertical-align: middle;
            }

            .row-number {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                background: var(--gradient-primary);
                color: white;
                border-radius: 8px;
                font-weight: 700;
                font-size: 0.85rem;
            }

            /* Member Info */
            .member-info {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            .member-avatar {
                width: 45px;
                height: 45px;
                background: var(--gradient-primary);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 18px;
                flex-shrink: 0;
            }

            .member-name {
                color: var(--text-primary);
                font-size: 0.95rem;
                display: block;
            }

            .member-id {
                color: var(--text-secondary);
                font-size: 0.75rem;
                display: block;
            }

            /* Badges */
            .contact-badge,
            .location-badge,
            .religion-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.4rem 0.9rem;
                background: var(--bg-primary);
                color: var(--text-secondary);
                border-radius: 10px;
                font-size: 0.85rem;
                font-weight: 600;
            }

            .gender-badge {
                display: inline-flex;
                align-items: center;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-weight: 700;
                font-size: 0.85rem;
            }

            .gender-male {
                background: linear-gradient(135deg, rgba(54, 209, 220, 0.2) 0%, rgba(91, 134, 229, 0.2) 100%);
                color: #36d1dc;
            }

            .gender-female {
                background: linear-gradient(135deg, rgba(240, 147, 251, 0.2) 0%, rgba(245, 87, 108, 0.2) 100%);
                color: #f5576c;
            }

            .birth-info {
                display: flex;
                flex-direction: column;
                gap: 0.25rem;
            }

            .birth-info small {
                color: var(--text-secondary);
                font-size: 0.85rem;
            }

            /* Action Buttons */
            .action-buttons {
                display: flex;
                gap: 0.5rem;
                justify-content: center;
            }

            .btn-action-mini {
                width: 36px;
                height: 36px;
                border-radius: 10px;
                border: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .btn-action-view {
                background: var(--gradient-info);
                color: white;
            }

            .btn-action-edit {
                background: var(--gradient-warning);
                color: white;
            }

            .btn-action-delete {
                background: var(--gradient-danger);
                color: white;
            }

            .btn-action-mini:hover {
                transform: translateY(-3px);
                box-shadow: var(--shadow-md);
            }

            /* Empty State */
            .empty-state {
                padding: 3rem 1rem;
            }

            .empty-state i {
                font-size: 4rem;
                color: var(--text-secondary);
                opacity: 0.5;
                margin-bottom: 1rem;
            }

            .empty-state h5 {
                color: var(--text-primary);
                margin-bottom: 0.5rem;
            }

            .empty-state p {
                color: var(--text-secondary);
                margin-bottom: 1rem;
            }

            /* Pagination */
            .card-footer-custom {
                padding: 1.5rem;
                border-top: 2px solid var(--border-color);
                background: var(--bg-secondary);
            }

            .pagination-info {
                color: var(--text-secondary);
                font-size: 0.9rem;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .page-header-text {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .page-header-text h2 {
                    font-size: 1.5rem;
                }

                .stats-value {
                    font-size: 2rem;
                }

                .action-buttons {
                    flex-direction: column;
                }

                .filter-form .row > div {
                    margin-bottom: 1rem;
                }
            }

            /* Print Styles */
            @media print {
                .btn,
                .action-buttons,
                .filter-card,
                .page-header-card .btn-gradient-secondary {
                    display: none !important;
                }

                .table-card {
                    box-shadow: none;
                    border: 1px solid #000;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <script>
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            // Counter Animation
            document.addEventListener('DOMContentLoaded', function() {
                const counters = document.querySelectorAll('.stats-value');
                
                counters.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    const duration = 2000;
                    const increment = target / (duration / 16);
                    let current = 0;

                    const updateCounter = () => {
                        current += increment;
                        if (current < target) {
                            counter.textContent = Math.floor(current);
                            requestAnimationFrame(updateCounter);
                        } else {
                            counter.textContent = target;
                        }
                    };

                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                updateCounter();
                                observer.disconnect();
                            }
                        });
                    });

                    observer.observe(counter);
                });
            });
        </script>
    @endpush
@endsection