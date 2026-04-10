<?php

namespace App\Http\Controllers;

use App\Models\EBook;
use App\Models\Genre;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EBookController extends Controller
{
    public function adminIndex()
    {
        $books = EBook::orderBy('id_buku', 'desc')->paginate(10);
        return view('admin.buku.index', compact('books'));
    }

    public function index()
    {
        $books = EBook::orderBy('id_buku', 'desc')->paginate(10);
        return view('admin.buku.index', compact('books'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $genres    = Genre::orderBy('nama_genre')->get();
        return view('admin.buku.create', compact('kategoris', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_buku'   => 'required|string|max:40',
            'pengarang'    => 'required|string|max:50',
            'penerbit'     => 'nullable|string|max:30',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'id_kategori'  => 'required|exists:kategori,id_kategori',
            'id_genre'     => 'nullable|array|max:3',
            'id_genre.*'   => 'exists:genres,id_genre',
            'sinopsis'     => 'nullable|string',
            'jumlah_ebook' => 'required|integer|min:1',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'file_ebook'   => 'nullable|mimes:pdf|max:51200',
        ]);

        $data = $request->only([
            'judul_buku',
            'pengarang',
            'penerbit',
            'tahun_terbit',
            'id_kategori',
            'sinopsis',
            'jumlah_ebook',
        ]);

        $data['id_genre'] = null;
        if ($request->filled('id_genre')) {
            $data['id_genre'] = implode(',', array_slice($request->id_genre, 0, 3));
        }

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'supabase');
        }

        if ($request->hasFile('file_ebook')) {
            $data['file_ebook'] = $request->file('file_ebook')->store('ebooks', 'supabase');
        }

        EBook::create($data);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show($id)
    {
        $book = EBook::findOrFail($id);
        return view('admin.buku.show', compact('book'));
    }

    public function showAnggota($id)
    {
        $ebook = EBook::with('kategori')->findOrFail($id);

        $sudahPinjam = \App\Models\Transaksi::where('id_user', auth()->id())
            ->where('id_buku', $id)
            ->where('status_peminjam', 'pinjam')
            ->exists();

        $related = EBook::with('kategori')
            ->where('id_kategori', $ebook->id_kategori)
            ->where('id_buku', '!=', $id)
            ->take(4)
            ->get();

        return view('anggota.buku.show', compact('ebook', 'sudahPinjam', 'related'));
    }

    public function edit($id)
    {
        $book      = EBook::findOrFail($id);
        $kategoris = Kategori::all();
        $genres    = Genre::orderBy('nama_genre')->get();
        return view('admin.buku.edit', compact('book', 'kategoris', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $book = EBook::findOrFail($id);

        $request->validate([
            'judul_buku'   => 'required|string|max:40',
            'pengarang'    => 'required|string|max:50',
            'penerbit'     => 'nullable|string|max:30',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'id_kategori'  => 'required|exists:kategori,id_kategori',
            'id_genre'     => 'nullable|array|max:3',
            'id_genre.*'   => 'exists:genres,id_genre',
            'sinopsis'     => 'nullable|string',
            'jumlah_ebook' => 'required|integer|min:1',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'file_ebook'   => 'nullable|mimes:pdf|max:51200',
        ]);

        $data = $request->only([
            'judul_buku',
            'pengarang',
            'penerbit',
            'tahun_terbit',
            'id_kategori',
            'sinopsis',
            'jumlah_ebook',
        ]);

        $data['id_genre'] = null;
        if ($request->filled('id_genre')) {
            $data['id_genre'] = implode(',', array_slice($request->id_genre, 0, 3));
        }

        if ($request->hasFile('cover')) {
            if ($book->cover) Storage::disk('supabase')->delete($book->cover);
            $data['cover'] = $request->file('cover')->store('covers', 'supabase');
        }

        if ($request->hasFile('file_ebook')) {
            if ($book->file_ebook) Storage::disk('supabase')->delete($book->file_ebook);
            $data['file_ebook'] = $request->file('file_ebook')->store('ebooks', 'supabase');
        }

        $book->update($data);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy($id)
    {
        $book = EBook::findOrFail($id);

        if ($book->cover)      Storage::disk('supabase')->delete($book->cover);
        if ($book->file_ebook) Storage::disk('supabase')->delete($book->file_ebook);

        $book->delete();

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil dihapus!');
    }

    public function koleksiSaya()
    {
        $books     = EBook::with('kategori')->orderBy('id_buku', 'desc')->paginate(24);
        $kategoris = Kategori::withCount('ebooks')->get();
        return view('anggota.koleksi_saya', compact('books', 'kategoris'));
    }
}