@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Tambah Genre</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.genre.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Genre</label>
                <input type="text" name="nama_genre" class="form-control" required>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.genre.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
