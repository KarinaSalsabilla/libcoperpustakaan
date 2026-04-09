@extends('layouts.admin')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle"></i> Informasi Kategori
                </h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>ID Kategori</th>
                        <td>: {{ $kategori->id_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Nama Kategori</th>
                        <td>: <strong>{{ $kategori->nama_kategori }}</strong></td>
                    </tr>
                    <tr>
                        <th>Jumlah E-Book</th>
                        <td>: <span class="badge bg-success">{{ $kategori->ebooks->count() }} E-Book</span></td>
                    </tr>
                </table>

                <div class="d-flex gap-2 mt-3">
                    <a href="{{ route('admin.kategori.edit', $kategori->id_kategori) }}" 
                       class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.kategori.index') }}" 
                       class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-book"></i> Daftar E-Book dalam Kategori Ini
                </h5>
            </div>
            <div class="card-body">
                @if($kategori->ebooks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul E-Book</th>
                                    <th>Penulis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategori->ebooks as $ebook)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ebook->judul ?? 'N/A' }}</td>
                                        <td>{{ $ebook->penulis ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                        <p>Belum ada e-book dalam kategori ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection