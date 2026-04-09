@extends('layouts.admin')

@section('page-title', 'Manajemen E-Book')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <h2 class="mb-1 fw-bold">Manajemen E-Book</h2>
                        <p class="text-muted mb-0">
                            <i class="fas fa-info-circle me-1"></i>
                            Kelola koleksi e-book perpustakaan digital
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.buku.create') }}" class="btn btn-gradient-primary btn-lg shadow-sm">
                    <i class="fas fa-plus me-2"></i> Tambah Buku Baru
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stats-card stats-card-primary">
                <div class="stats-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stats-content">
                    <h3 class="mb-0">{{ $books->total() }}</h3>
                    <p class="mb-0">Total E-Book</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stats-card stats-card-success">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3 class="mb-0">{{ $books->where('jumlah_ebook', '>', 10)->count() }}</h3>
                    <p class="mb-0">Stok Tinggi</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stats-card stats-card-warning">
                <div class="stats-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-content">
                    <h3 class="mb-0">{{ $books->whereBetween('jumlah_ebook', [1, 10])->count() }}</h3>
                    <p class="mb-0">Stok Rendah</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stats-card stats-card-danger">
                <div class="stats-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stats-content">
                    <h3 class="mb-0">{{ $books->where('jumlah_ebook', 0)->count() }}</h3>
                    <p class="mb-0">Stok Habis</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3 fs-4"></i>
                <div>
                    <strong>Berhasil!</strong>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="main-card">
        <div class="card-header-custom">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list me-2"></i> Daftar E-Book
                    </h5>
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <form class="search-form">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari judul, pengarang, ISBN...">
                            <button class="btn btn-outline-primary" type="submit">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card-body-custom p-0">
            <div class="table-responsive">
                <table class="table table-custom mb-0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 90px;">Cover</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Kategori</th>
                            <th style="width: 80px;">Tahun</th>
                            <th style="width: 90px;">Stok</th>
                            <th style="width: 160px;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                        <tr class="book-row">
                            <td class="fw-semibold">{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                            <td>
                                @if($book->cover)
                                    <div class="book-cover-wrapper">
                                        <img src="{{ asset('storage/'.$book->cover) }}" 
                                             class="book-cover" 
                                             alt="Cover"
                                             data-bs-toggle="modal" 
                                             data-bs-target="#coverModal{{ $book->id_buku }}">
                                        <div class="cover-overlay">
                                            <i class="fas fa-search-plus"></i>
                                        </div>
                                    </div>
                                @else
                                    <div class="no-cover">
                                        <i class="fas fa-book"></i>
                                        <span>No Cover</span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="book-title-wrapper">
                                    <strong class="book-title">{{ $book->judul_buku }}</strong>
                                    @if($book->sinopsis)
                                        <small class="book-synopsis d-block mt-1">
                                            {{ Str::limit($book->sinopsis, 60) }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="author-name">
                                    <i class="fas fa-user-edit me-1"></i>
                                    {{ $book->pengarang }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-category">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $book->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge-year">{{ $book->tahun_terbit }}</span>
                            </td>
                            <td>
                                @if($book->jumlah_ebook > 10)
                                    <span class="badge-stock badge-stock-high">
                                        <i class="fas fa-check-circle me-1"></i>
                                        {{ $book->jumlah_ebook }}
                                    </span>
                                @elseif($book->jumlah_ebook > 0)
                                    <span class="badge-stock badge-stock-medium">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        {{ $book->jumlah_ebook }}
                                    </span>
                                @else
                                    <span class="badge-stock badge-stock-low">
                                        <i class="fas fa-times-circle me-1"></i>
                                        0
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if($book->file_ebook)
                                        <button class="btn-action btn-action-info" 
                                                onclick="window.open('{{ asset('storage/'.$book->file_ebook) }}', '_blank')"
                                                title="Lihat PDF">
                                            <i class="fas fa-file-pdf"></i>
                                        </button>
                                    @endif
                                    
                                    <a href="{{ route('admin.buku.edit', $book->id_buku) }}" 
                                       class="btn-action btn-action-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <button type="button"
                                            class="btn-action btn-action-danger" 
                                            title="Hapus"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $book->id_buku }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Cover -->
                        @if($book->cover)
                        <div class="modal fade" id="coverModal{{ $book->id_buku }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content modal-custom">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-bold">
                                            <i class="fas fa-image me-2"></i>
                                            {{ $book->judul_buku }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center p-4">
                                        <img src="{{ asset('storage/'.$book->cover) }}" 
                                             class="img-fluid rounded shadow-lg" 
                                             alt="Cover"
                                             style="max-height: 600px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteModal{{ $book->id_buku }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content modal-custom">
                                    <div class="modal-header modal-header-danger">
                                        <h5 class="modal-title">
                                            <i class="fas fa-exclamation-triangle me-2"></i>
                                            Konfirmasi Hapus
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <p class="mb-3">Apakah Anda yakin ingin menghapus buku ini?</p>
                                        <div class="alert-delete-info">
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-book fa-2x me-3 text-danger"></i>
                                                <div>
                                                    <strong class="d-block">{{ $book->judul_buku }}</strong>
                                                    <small class="text-muted">Oleh: {{ $book->pengarang }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="alert-warning-custom">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <span>Data yang sudah dihapus tidak dapat dikembalikan!</span>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i> Batal
                                        </button>
                                        <form action="{{ route('admin.buku.destroy', $book->id_buku) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-custom">
                                                <i class="fas fa-trash me-2"></i> Ya, Hapus!
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="fas fa-book-open"></i>
                                    </div>
                                    <h5 class="mt-4 mb-2">Belum Ada Data Buku</h5>
                                    <p class="text-muted mb-4">Silakan tambahkan buku baru untuk memulai</p>
                                    <a href="{{ route('admin.buku.create') }}" class="btn btn-gradient-primary">
                                        <i class="fas fa-plus me-2"></i> Tambah Buku Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($books->hasPages())
        <div class="card-footer-custom">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="pagination-info mb-2 mb-md-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Menampilkan <strong>{{ $books->firstItem() }}</strong> - <strong>{{ $books->lastItem() }}</strong> 
                    dari <strong>{{ $books->total() }}</strong> data
                </div>
                <div>
                    {{ $books->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    :root {
        --bg-primary: #f8f9fa;
        --bg-secondary: #ffffff;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.15);
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --gradient-success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --gradient-warning: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --gradient-danger: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        --hover-bg: #f7fafc;
    }

    [data-theme="dark"] {
        --bg-primary: #1a202c;
        --bg-secondary: #2d3748;
        --text-primary: #f7fafc;
        --text-secondary: #a0aec0;
        --border-color: #4a5568;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.4);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.5);
        --hover-bg: #374151;
    }

    body {
        background-color: var(--bg-primary);
        color: var(--text-primary);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* Page Header */
    .page-header {
        padding: 1.5rem 0;
    }

    .icon-wrapper {
        width: 70px;
        height: 70px;
        background: var(--gradient-primary);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-md);
    }

    .icon-wrapper i {
        font-size: 32px;
        color: white;
    }

    .page-header h2 {
        color: var(--text-primary);
    }

    /* Gradient Button */
    .btn-gradient-primary {
        background: var(--gradient-primary);
        border: none;
        color: white;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .btn-gradient-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    /* Statistics Cards */
    .stats-card {
        background: var(--bg-secondary);
        border-radius: 15px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .stats-card-primary .stats-icon { background: var(--gradient-primary); }
    .stats-card-success .stats-icon { background: var(--gradient-success); }
    .stats-card-warning .stats-icon { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stats-card-danger .stats-icon  { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

    .stats-content h3 {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        color: var(--text-primary);
    }

    .stats-content p {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    /* Alert Custom */
    .alert-success-custom {
        background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
        border: 2px solid #11998e;
        border-radius: 12px;
        padding: 1.25rem;
        color: var(--text-primary);
    }

    .alert-success-custom i { color: #11998e; }

    /* Main Card */
    .main-card {
        background: var(--bg-secondary);
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .card-header-custom {
        background: var(--bg-secondary);
        padding: 1.5rem;
        border-bottom: 2px solid var(--border-color);
    }

    .card-header-custom h5 { color: var(--text-primary); }

    /* Search Form */
    .search-form .input-group-text {
        background: var(--bg-secondary);
        border-color: var(--border-color);
        color: var(--text-secondary);
    }

    .search-form .form-control {
        background: var(--bg-secondary);
        border-color: var(--border-color);
        color: var(--text-primary);
    }

    .search-form .form-control:focus {
        background: var(--bg-secondary);
        border-color: #667eea;
        color: var(--text-primary);
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    /* Table Custom */
    .table-custom { color: var(--text-primary); }

    .table-custom thead {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    }

    .table-custom thead th {
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        color: var(--text-primary);
    }

    .table-custom tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .table-custom tbody tr:hover {
        background: var(--hover-bg);
        transform: scale(1.01);
    }

    .table-custom tbody td {
        padding: 1rem;
        vertical-align: middle;
    }

    /* Book Cover */
    .book-cover-wrapper {
        position: relative;
        width: 60px;
        height: 85px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        box-shadow: var(--shadow-sm);
    }

    .book-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .book-cover-wrapper:hover .book-cover { transform: scale(1.1); }

    .cover-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .book-cover-wrapper:hover .cover-overlay { opacity: 1; }
    .cover-overlay i { color: white; font-size: 20px; }

    .no-cover {
        width: 60px;
        height: 85px;
        background: linear-gradient(135deg, #cbd5e0 0%, #a0aec0 100%);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        color: white;
        font-size: 0.65rem;
    }

    .no-cover i { font-size: 20px; }

    /* Book Title */
    .book-title { color: var(--text-primary); font-size: 0.95rem; line-height: 1.4; }
    .book-synopsis { color: var(--text-secondary); font-size: 0.8rem; line-height: 1.3; }

    /* Author */
    .author-name { color: var(--text-secondary); font-size: 0.9rem; }

    /* Badges */
    .badge-category {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, rgba(102,126,234,0.2) 0%, rgba(118,75,162,0.2) 100%);
        color: #667eea;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-year {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        background: var(--bg-primary);
        color: var(--text-secondary);
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge-stock {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 0.9rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    .badge-stock-high {
        background: linear-gradient(135deg, rgba(17,153,142,0.2) 0%, rgba(56,239,125,0.2) 100%);
        color: #11998e;
    }

    .badge-stock-medium {
        background: linear-gradient(135deg, rgba(240,147,251,0.2) 0%, rgba(245,87,108,0.2) 100%);
        color: #f5576c;
    }

    .badge-stock-low {
        background: linear-gradient(135deg, rgba(250,112,154,0.2) 0%, rgba(254,225,64,0.2) 100%);
        color: #fa709a;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: white;
        font-size: 14px;
        text-decoration: none;
    }

    .btn-action-info    { background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%); }
    .btn-action-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .btn-action-danger  { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }

    .btn-action:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    /* Modal Custom */
    .modal-custom {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
    }

    .modal-custom .modal-header { background: var(--bg-secondary); color: var(--text-primary); }
    .modal-custom .modal-body   { background: var(--bg-secondary); color: var(--text-primary); }

    .modal-header-danger {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }

    .alert-delete-info {
        background: var(--bg-primary);
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 1rem;
    }

    .alert-warning-custom {
        background: linear-gradient(135deg, rgba(240,147,251,0.1) 0%, rgba(245,87,108,0.1) 100%);
        border: 2px solid #f5576c;
        padding: 1rem;
        border-radius: 10px;
        color: #f5576c;
        font-weight: 600;
    }

    .btn-secondary-custom {
        background: var(--bg-primary);
        color: var(--text-primary);
        border: 2px solid var(--border-color);
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover { background: var(--hover-bg); transform: translateY(-2px); }

    .btn-danger-custom {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-danger-custom:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

    /* Empty State */
    .empty-state { padding: 3rem 1rem; }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0.2;
    }

    .empty-icon i { font-size: 60px; color: white; }

    /* Card Footer */
    .card-footer-custom {
        background: var(--bg-secondary);
        padding: 1.5rem;
        border-top: 2px solid var(--border-color);
    }

    .pagination-info { color: var(--text-secondary); font-size: 0.9rem; }

    /* Responsive */
    @media (max-width: 768px) {
        .icon-wrapper { width: 50px; height: 50px; }
        .icon-wrapper i { font-size: 24px; }
        .page-header h2 { font-size: 1.5rem; }
        .stats-card { padding: 1rem; }
        .stats-icon { width: 50px; height: 50px; font-size: 20px; }
        .stats-content h3 { font-size: 1.5rem; }
    }
</style>
@endpush
@endsection