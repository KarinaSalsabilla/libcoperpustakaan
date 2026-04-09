@extends('layouts.admin')

@section('page-title', 'Edit E-Book')

@section('content')
<div class="container-fluid px-4">
    <div class="mb-4">
        <h2>Edit E-Book</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.buku.index') }}">E-Book</a></li>
                <li class="breadcrumb-item active">Edit: {{ $book->judul_buku }}</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.buku.update', $book->id_buku) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- ══ KOLOM KIRI ══ --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                            <input type="text" name="judul_buku"
                                   class="form-control @error('judul_buku') is-invalid @enderror"
                                   value="{{ old('judul_buku', $book->judul_buku) }}"
                                   maxlength="40" required>
                            @error('judul_buku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="pengarang"
                                   class="form-control @error('pengarang') is-invalid @enderror"
                                   value="{{ old('pengarang', $book->pengarang) }}"
                                   maxlength="50" required>
                            @error('pengarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="penerbit"
                                   class="form-control @error('penerbit') is-invalid @enderror"
                                   value="{{ old('penerbit', $book->penerbit) }}"
                                   maxlength="30">
                            @error('penerbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                                    <input type="number" name="tahun_terbit"
                                           class="form-control @error('tahun_terbit') is-invalid @enderror"
                                           value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                                           min="1900" max="{{ date('Y') }}" required>
                                    @error('tahun_terbit')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Stok <span class="text-danger">*</span></label>
                                    <input type="number" name="jumlah_ebook"
                                           class="form-control @error('jumlah_ebook') is-invalid @enderror"
                                           value="{{ old('jumlah_ebook', $book->jumlah_ebook) }}"
                                           min="1" required>
                                    @error('jumlah_ebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sinopsis</label>
                            <textarea name="sinopsis"
                                      class="form-control @error('sinopsis') is-invalid @enderror"
                                      rows="5">{{ old('sinopsis', $book->sinopsis) }}</textarea>
                            @error('sinopsis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- ══ KOLOM KANAN ══ --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="id_kategori"
                                    class="form-select @error('id_kategori') is-invalid @enderror"
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id_kategori }}"
                                        {{ old('id_kategori', $book->id_kategori) == $kategori->id_kategori ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- ══ GENRE CHIP SELECTOR ══ --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Genre
                                <span class="text-muted" style="font-weight:400;font-size:.85rem;">
                                    (pilih maksimal 3)
                                </span>
                            </label>

                            @php $selectedGenreIds = old('id_genre', $book->genre_ids); @endphp

                            <div id="genreContainer"
                                 style="display:flex;flex-wrap:wrap;gap:8px;padding:12px;
                                        border:1px solid #dee2e6;border-radius:8px;
                                        background:#f8f9fa;min-height:52px;">
                                @foreach($genres as $genre)
                                    @php $active = in_array($genre->id_genre, $selectedGenreIds); @endphp
                                    <label class="genre-chip {{ $active ? 'genre-chip-active' : '' }}"
                                           style="display:inline-flex;align-items:center;gap:6px;
                                                  padding:6px 14px;border-radius:50px;cursor:pointer;
                                                  border:1.5px solid {{ $active ? '#667eea' : '#dee2e6' }};
                                                  background:{{ $active ? 'linear-gradient(135deg,#667eea,#764ba2)' : '#fff' }};
                                                  color:{{ $active ? 'white' : '#495057' }};
                                                  font-size:.82rem;font-weight:600;
                                                  transition:all .2s;user-select:none;margin:0;">
                                        <input type="checkbox"
                                               name="id_genre[]"
                                               value="{{ $genre->id_genre }}"
                                               {{ $active ? 'checked' : '' }}
                                               style="display:none;"
                                               onchange="handleGenreChange(this)">
                                        {{ $genre->nama_genre }}
                                        <span class="genre-check"
                                              style="display:{{ $active ? 'inline' : 'none' }};font-size:.7rem;">✓</span>
                                    </label>
                                @endforeach
                            </div>

                            <small id="genreCounter"
                                   style="color:{{ count($selectedGenreIds) === 3 ? '#667eea' : '#6c757d' }};">
                                {{ count($selectedGenreIds) }}/3 genre dipilih
                            </small>

                            @error('id_genre')
                                <div style="color:#dc3545;font-size:.85rem;margin-top:4px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cover Buku</label>
                            @if($book->cover)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$book->cover) }}"
                                         width="100" class="img-thumbnail">
                                </div>
                            @endif
                            <input type="file" name="cover"
                                   class="form-control @error('cover') is-invalid @enderror"
                                   accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                            @error('cover')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File E-Book (PDF)</label>
                            @if($book->file_ebook)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/'.$book->file_ebook) }}"
                                       target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> Lihat PDF
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="file_ebook"
                                   class="form-control @error('file_ebook') is-invalid @enderror"
                                   accept=".pdf">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah file PDF</small>
                            @error('file_ebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
.genre-chip:hover {
    border-color: #667eea !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(102,126,234,.2);
}
.genre-chip-active {
    box-shadow: 0 2px 10px rgba(102,126,234,.35) !important;
}
</style>
@endpush

@push('scripts')
<script>
function handleGenreChange(checkbox) {
    const allBoxes  = document.querySelectorAll('input[name="id_genre[]"]');
    const checked   = Array.from(allBoxes).filter(b => b.checked);
    const counter   = document.getElementById('genreCounter');
    const label     = checkbox.closest('label');

    // Batalkan jika sudah 3 dan mau tambah lagi
    if (checkbox.checked && checked.length > 3) {
        checkbox.checked = false;
        counter.style.color    = '#dc3545';
        counter.textContent    = 'Maksimal 3 genre saja!';
        setTimeout(() => {
            const nowChecked = Array.from(allBoxes).filter(b => b.checked).length;
            counter.style.color = nowChecked === 3 ? '#667eea' : '#6c757d';
            counter.textContent = nowChecked + '/3 genre dipilih';
        }, 2000);
        return;
    }

    // Update tampilan chip
    if (checkbox.checked) {
        label.style.background  = 'linear-gradient(135deg,#667eea,#764ba2)';
        label.style.color       = 'white';
        label.style.borderColor = '#667eea';
        label.querySelector('.genre-check').style.display = 'inline';
        label.classList.add('genre-chip-active');
    } else {
        label.style.background  = '#fff';
        label.style.color       = '#495057';
        label.style.borderColor = '#dee2e6';
        label.querySelector('.genre-check').style.display = 'none';
        label.classList.remove('genre-chip-active');
    }

    // Update counter
    const nowChecked = Array.from(allBoxes).filter(b => b.checked).length;
    counter.style.color = nowChecked === 3 ? '#667eea' : '#6c757d';
    counter.textContent = nowChecked + '/3 genre dipilih';
}
</script>
@endpush

@endsection