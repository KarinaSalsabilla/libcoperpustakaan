@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Genre</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.genre.update', $genre->id_genre) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Genre</label>
        <input type="text" name="nama_genre"
               value="{{ $genre->nama_genre }}"
               class="form-control" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.genre.index') }}" class="btn btn-secondary">Kembali</a>
</form>
    </div>
</div>
@endsection
