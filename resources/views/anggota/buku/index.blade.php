@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Daftar Buku</h1>

    <!-- Filter (sama seperti public) -->
    <!-- ... copy dari public/index.blade.php ... -->

    <!-- Daftar Buku -->
    <div class="row">
        @forelse($ebooks as $ebook)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <!-- Cover (sama seperti public) -->
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ Str::limit($ebook->judul, 50) }}</h5>
                        <p class="card-text">
                            <small class="text-muted">{{ $ebook->penulis }}</small><br>
                            <span class="badge bg-primary">{{ $ebook->nama_kategori }}</span>
                        </p>
                    </div>
                    <div class="card-footer">
                        {{-- <a href="{{ route('anggota.buku.show', $ebook->id_ebook) }}"  --}}
                           class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-book me-1"></i>Pinjam Buku
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada buku tersedia.</div>
            </div>
        @endforelse
    </div>

    {{ $ebooks->links() }}
</div>
@endsectioni