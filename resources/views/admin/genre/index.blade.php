@extends('layouts.admin')

@section('page-title', 'Genre')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Data Genre</h5>
            <a href="{{ route('admin.genre.create') }}" class="btn btn-primary">
                + Tambah Genre
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Genre</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $genre->nama_genre }}</td>
                            <td>
                                <a href="{{ route('admin.genre.edit', $genre) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.genre.destroy', $genre) }}" method="POST" class="d-inline">

                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus genre?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection