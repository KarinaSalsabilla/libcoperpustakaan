<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::latest()->get();
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_genre' => 'required|unique:genres,nama_genre'
        ]);

        Genre::create($request->all());

        return redirect()
            ->route('admin.genre.index')
            ->with('success', 'Genre berhasil ditambahkan');
    }

   public function edit(Genre $genre)
{
    return view('admin.genre.edit', compact('genre'));
}

public function update(Request $request, Genre $genre)
{
    $request->validate([
        'nama_genre' => 'required|string|max:255'
    ]);

    $genre->update($request->only('nama_genre'));

    return redirect()->route('admin.genre.index')
                    ->with('success', 'Genre berhasil diupdate');
}

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()
            ->route('admin.genre.index')
            ->with('success', 'Genre berhasil dihapus');
    }
}
