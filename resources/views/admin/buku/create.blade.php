@extends('layouts.admin')
@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,600;0,700;1,400&display=swap');

  :root {
    --indigo:    #4f46e5;
    --indigo-d:  #3730a3;
    --violet:    #7c3aed;
    --violet-d:  #6d28d9;
    --fuchsia:   #a855f7;
    --grad:      linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%);
    --grad-soft: linear-gradient(135deg, rgba(79,70,229,.08) 0%, rgba(124,58,237,.08) 100%);
    --surface:   #ffffff;
    --surface2:  #f5f3ff;
    --border:    rgba(124,58,237,.15);
    --border2:   rgba(124,58,237,.3);
    --ink:       #1e1b4b;
    --ink2:      #4338ca;
    --muted:     #6b7280;
    --radius:    14px;
    --shadow:    0 4px 24px rgba(79,70,229,.12);
    --shadow-lg: 0 12px 48px rgba(79,70,229,.18);
  }

  .eb-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 2rem 2.5rem 4rem;
    max-width: 1100px;
    margin: 0 auto;
  }

  /* ── HEADER ── */
  .eb-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 2.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 1rem;
  }
  .eb-header-left { display: flex; align-items: center; gap: 1rem; }
  .eb-header-icon {
    width: 52px; height: 52px; border-radius: 14px;
    background: var(--grad);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; color: white;
    box-shadow: 0 4px 16px rgba(124,58,237,.35);
    flex-shrink: 0;
  }
  .eb-title {
    font-family: 'Fraunces', serif;
    font-size: 1.75rem; font-weight: 700;
    color: var(--ink); line-height: 1.1; margin: 0;
  }
  .eb-breadcrumb {
    font-size: .78rem; color: var(--muted); margin-top: 3px;
    display: flex; align-items: center; gap: 6px;
  }
  .eb-breadcrumb a { color: var(--indigo); text-decoration: none; font-weight: 600; }
  .eb-breadcrumb a:hover { color: var(--violet); }
  .eb-breadcrumb-sep { opacity: .4; }
  .btn-back {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 20px; border-radius: 50px;
    border: 1.5px solid var(--border2);
    background: transparent; color: var(--indigo);
    font-size: .82rem; font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer; text-decoration: none; transition: all .2s;
  }
  .btn-back:hover {
    background: var(--grad-soft); border-color: var(--indigo);
    transform: translateX(-2px); color: var(--indigo);
  }

  /* ── CARD ── */
  .eb-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 22px;
    box-shadow: var(--shadow);
    overflow: hidden;
    animation: slideUp .45s ease both;
  }
  @keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .eb-card-header {
    background: var(--grad);
    padding: 1.4rem 2rem;
    display: flex; align-items: center; gap: 10px;
  }
  .eb-card-header-title {
    font-family: 'Fraunces', serif;
    font-size: 1.1rem; font-style: italic;
    font-weight: 600; color: white;
  }
  .eb-card-header-sub {
    font-size: .75rem; color: rgba(255,255,255,.65);
    margin-top: 1px;
  }
  .eb-card-header i { color: rgba(255,255,255,.8); font-size: .9rem; }

  .eb-card-body { padding: 2rem 2rem 2.5rem; }

  /* ── SECTION DIVIDER ── */
  .eb-section {
    margin-bottom: 2rem;
    animation: slideUp .4s ease both;
  }
  .eb-section:nth-child(2) { animation-delay: .06s; }
  .eb-section:nth-child(3) { animation-delay: .12s; }
  .eb-section:nth-child(4) { animation-delay: .18s; }

  .eb-section-label {
    font-size: .62rem; font-weight: 800;
    text-transform: uppercase; letter-spacing: .12em;
    color: var(--violet); margin-bottom: 1rem;
    display: flex; align-items: center; gap: 8px;
  }
  .eb-section-label::after {
    content: ''; flex: 1; height: 1px;
    background: linear-gradient(90deg, var(--border2), transparent);
  }

  /* ── GRID ── */
  .eb-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .eb-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px; }
  .eb-grid-full { display: grid; grid-template-columns: 1fr; }

  /* ── FORM GROUPS ── */
  .eb-group { display: flex; flex-direction: column; gap: 6px; }
  .eb-label {
    font-size: .72rem; font-weight: 700; color: var(--ink);
    text-transform: uppercase; letter-spacing: .06em;
    display: flex; align-items: center; gap: 5px;
  }
  .eb-label .req { color: #e11d48; font-size: .75rem; }
  .eb-input, .eb-select, .eb-textarea {
    width: 100%; padding: 11px 14px;
    border: 1.5px solid var(--border);
    border-radius: var(--radius);
    background: var(--surface2);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .88rem; color: var(--ink);
    outline: none; transition: border-color .2s, box-shadow .2s, background .2s;
    appearance: none; -webkit-appearance: none;
  }
  .eb-input:focus, .eb-select:focus, .eb-textarea:focus {
    border-color: var(--violet);
    box-shadow: 0 0 0 3px rgba(124,58,237,.12);
    background: white;
  }
  .eb-input:hover, .eb-select:hover { border-color: var(--border2); }
  .eb-textarea { resize: vertical; min-height: 110px; line-height: 1.6; }
  .eb-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' fill='none'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%237c3aed' stroke-width='1.5' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
  }
  .eb-input.is-invalid, .eb-select.is-invalid { border-color: #e11d48; }
  .eb-feedback { font-size: .75rem; color: #e11d48; margin-top: 2px; }

  /* ── FILE INPUT ── */
  .eb-file-wrap {
    position: relative;
    border: 1.5px dashed var(--border2);
    border-radius: var(--radius);
    background: var(--grad-soft);
    padding: 18px 16px;
    text-align: center; cursor: pointer;
    transition: border-color .2s, background .2s;
  }
  .eb-file-wrap:hover { border-color: var(--violet); background: rgba(124,58,237,.06); }
  .eb-file-wrap input[type=file] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
  }
  .eb-file-icon { font-size: 1.6rem; margin-bottom: 6px; color: var(--violet); opacity: .7; }
  .eb-file-text { font-size: .8rem; font-weight: 600; color: var(--indigo); }
  .eb-file-sub  { font-size: .7rem; color: var(--muted); margin-top: 2px; }
  .eb-file-preview {
    display: none; align-items: center; gap: 10px;
    padding: 8px 12px; background: white;
    border: 1px solid var(--border2); border-radius: 10px; margin-top: 8px;
  }
  .eb-file-preview.show { display: flex; }
  .eb-file-preview i { color: var(--violet); }
  .eb-file-preview span { font-size: .78rem; color: var(--ink); font-weight: 600; flex: 1; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

  /* ── GENRE CHIPS ── */
  .eb-genre-wrap {
    display: flex; flex-wrap: wrap; gap: 8px;
    padding: 14px; border: 1.5px solid var(--border);
    border-radius: var(--radius); background: var(--surface2);
    min-height: 56px; transition: border-color .2s;
  }
  .eb-genre-wrap:focus-within { border-color: var(--violet); }
  .genre-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 15px; border-radius: 50px; cursor: pointer;
    border: 1.5px solid rgba(124,58,237,.25);
    background: white; color: var(--ink);
    font-size: .8rem; font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .18s; user-select: none; margin: 0;
  }
  .genre-pill:hover { border-color: var(--violet); color: var(--violet); transform: translateY(-1px); box-shadow: 0 3px 10px rgba(124,58,237,.15); }
  .genre-pill.active {
    background: var(--grad); color: white;
    border-color: transparent;
    box-shadow: 0 3px 12px rgba(124,58,237,.3);
  }
  .genre-pill input[type=checkbox] { display: none; }
  .genre-check { font-size: .65rem; opacity: .85; }
  .genre-counter {
    font-size: .75rem; font-weight: 700; margin-top: 7px;
    display: flex; align-items: center; gap: 6px;
  }
  .counter-bar {
    display: flex; gap: 4px;
  }
  .counter-dot {
    width: 24px; height: 5px; border-radius: 50px;
    background: var(--border); transition: background .25s;
  }
  .counter-dot.filled { background: var(--grad); }
  .counter-text { font-size: .72rem; color: var(--muted); }

  /* ── SUBMIT AREA ── */
  .eb-actions {
    display: flex; align-items: center; gap: 12px;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
    margin-top: 2rem;
    flex-wrap: wrap;
  }
  .btn-submit {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 32px; border-radius: 50px;
    background: var(--grad); color: white; border: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .88rem; font-weight: 700; cursor: pointer;
    box-shadow: 0 4px 18px rgba(124,58,237,.35);
    transition: all .25s;
  }
  .btn-submit:hover { filter: brightness(1.08); transform: translateY(-2px); box-shadow: 0 8px 28px rgba(124,58,237,.4); }
  .btn-submit:active { transform: translateY(0); }
  .btn-cancel {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 12px 24px; border-radius: 50px;
    background: transparent; color: var(--muted);
    border: 1.5px solid var(--border);
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: .88rem; font-weight: 700;
    cursor: pointer; text-decoration: none; transition: all .2s;
  }
  .btn-cancel:hover { border-color: #e11d48; color: #e11d48; background: rgba(225,29,72,.05); }

  /* ── RESPONSIVE ── */
  @media (max-width: 768px) {
    .eb-page { padding: 1rem 1rem 3rem; }
    .eb-grid-2, .eb-grid-3 { grid-template-columns: 1fr; }
    .eb-card-body { padding: 1.25rem; }
  }
</style>

<div class="eb-page">

  {{-- HEADER --}}
  <div class="eb-header">
    <div class="eb-header-left">
      <div class="eb-header-icon"><i class="fas fa-book-medical"></i></div>
      <div>
        <h1 class="eb-title">Tambah E-Book</h1>
        <div class="eb-breadcrumb">
          <a href="{{ route('admin.buku.index') }}">E-Book</a>
          <span class="eb-breadcrumb-sep">›</span>
          <span>Tambah Buku Baru</span>
        </div>
      </div>
    </div>
    <a href="{{ route('admin.buku.index') }}" class="btn-back">
      <i class="fas fa-arrow-left" style="font-size:.75rem;"></i> Kembali
    </a>
  </div>

  {{-- FORM CARD --}}
  <div class="eb-card">
    <div class="eb-card-header">
      <i class="fas fa-pen-nib"></i>
      <div>
        <div class="eb-card-header-title">Informasi E-Book</div>
        <div class="eb-card-header-sub">Lengkapi semua data di bawah ini</div>
      </div>
    </div>

    <div class="eb-card-body">
      <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data" id="ebForm">
        @csrf

        {{-- ── SEKSI 1: Identitas Buku ── --}}
        <div class="eb-section">
          <div class="eb-section-label"><i class="fas fa-bookmark" style="font-size:.65rem;"></i> Identitas Buku</div>
          <div class="eb-grid-2" style="margin-bottom:16px;">
            <div class="eb-group">
              <label class="eb-label">Judul Buku <span class="req">*</span></label>
              <input type="text" name="judul_buku" class="eb-input @error('judul_buku') is-invalid @enderror"
                     value="{{ old('judul_buku') }}" maxlength="40" required placeholder="Masukkan judul buku...">
              @error('judul_buku')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="eb-group">
              <label class="eb-label">Penulis <span class="req">*</span></label>
              <input type="text" name="pengarang" class="eb-input @error('pengarang') is-invalid @enderror"
                     value="{{ old('pengarang') }}" maxlength="50" required placeholder="Nama pengarang...">
              @error('pengarang')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="eb-grid-3">
            <div class="eb-group">
              <label class="eb-label">Penerbit</label>
              <input type="text" name="penerbit" class="eb-input @error('penerbit') is-invalid @enderror"
                     value="{{ old('penerbit') }}" maxlength="30" placeholder="Nama penerbit...">
              @error('penerbit')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="eb-group">
              <label class="eb-label">Tahun Terbit <span class="req">*</span></label>
              <input type="number" name="tahun_terbit" class="eb-input @error('tahun_terbit') is-invalid @enderror"
                     value="{{ old('tahun_terbit') }}" min="1900" max="{{ date('Y') }}" required placeholder="{{ date('Y') }}">
              @error('tahun_terbit')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="eb-group">
              <label class="eb-label">Jumlah Stok <span class="req">*</span></label>
              <input type="number" name="jumlah_ebook" class="eb-input @error('jumlah_ebook') is-invalid @enderror"
                     value="{{ old('jumlah_ebook', 1) }}" min="1" required>
              @error('jumlah_ebook')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>

        {{-- ── SEKSI 2: Klasifikasi ── --}}
        <div class="eb-section">
          <div class="eb-section-label"><i class="fas fa-tags" style="font-size:.65rem;"></i> Klasifikasi</div>
          <div class="eb-grid-2" style="margin-bottom:16px;">
            <div class="eb-group">
              <label class="eb-label">Kategori <span class="req">*</span></label>
              <select name="id_kategori" class="eb-select @error('id_kategori') is-invalid @enderror" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                  <option value="{{ $kategori->id_kategori }}"
                    {{ old('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                  </option>
                @endforeach
              </select>
              @error('id_kategori')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="eb-group">
              <label class="eb-label" style="margin-bottom:2px;">
                Genre
                <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--muted);font-size:.7rem;">
                  — pilih maks. 3
                </span>
              </label>
              @php $selectedGenreIds = old('id_genre', []); @endphp
              <div class="eb-genre-wrap" id="genreWrap">
                @foreach($genres as $genre)
                  @php $active = in_array($genre->id_genre, $selectedGenreIds); @endphp
                  <label class="genre-pill {{ $active ? 'active' : '' }}">
                    <input type="checkbox" name="id_genre[]"
                           value="{{ $genre->id_genre }}"
                           {{ $active ? 'checked' : '' }}
                           onchange="handleGenreChange(this)">
                    {{ $genre->nama_genre }}
                    <span class="genre-check">{{ $active ? '✓' : '' }}</span>
                  </label>
                @endforeach
              </div>
              <div class="genre-counter" id="genreCounterWrap">
                <div class="counter-bar">
                  <div class="counter-dot {{ count($selectedGenreIds) >= 1 ? 'filled' : '' }}" id="dot1"></div>
                  <div class="counter-dot {{ count($selectedGenreIds) >= 2 ? 'filled' : '' }}" id="dot2"></div>
                  <div class="counter-dot {{ count($selectedGenreIds) >= 3 ? 'filled' : '' }}" id="dot3"></div>
                </div>
                <span class="counter-text" id="genreCounterText">{{ count($selectedGenreIds) }}/3 dipilih</span>
              </div>
              @error('id_genre')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>

        {{-- ── SEKSI 3: Media ── --}}
        <div class="eb-section">
          <div class="eb-section-label"><i class="fas fa-photo-video" style="font-size:.65rem;"></i> Media & File</div>
          <div class="eb-grid-2">
            <div class="eb-group">
              <label class="eb-label">Cover Buku</label>
              <div class="eb-file-wrap" id="coverWrap">
                <input type="file" name="cover" accept="image/*"
                       onchange="previewFile(this,'coverPreview','coverName','coverWrap')">
                <div class="eb-file-icon">🖼</div>
                <div class="eb-file-text">Klik atau seret gambar ke sini</div>
                <div class="eb-file-sub">JPG, PNG, GIF — maks. 2MB</div>
              </div>
              <div class="eb-file-preview" id="coverPreview">
                <i class="fas fa-image"></i>
                <span id="coverName"></span>
              </div>
              @error('cover')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="eb-group">
              <label class="eb-label">File E-Book (PDF)</label>
              <div class="eb-file-wrap" id="pdfWrap">
                <input type="file" name="file_ebook" accept=".pdf"
                       onchange="previewFile(this,'pdfPreview','pdfName','pdfWrap')">
                <div class="eb-file-icon">📄</div>
                <div class="eb-file-text">Klik atau seret file PDF ke sini</div>
                <div class="eb-file-sub">PDF — maks. 10MB</div>
              </div>
              <div class="eb-file-preview" id="pdfPreview">
                <i class="fas fa-file-pdf" style="color:#e11d48;"></i>
                <span id="pdfName"></span>
              </div>
              @error('file_ebook')<div class="eb-feedback">{{ $message }}</div>@enderror
            </div>
          </div>
        </div>

        {{-- ── SEKSI 4: Sinopsis ── --}}
        <div class="eb-section">
          <div class="eb-section-label"><i class="fas fa-align-left" style="font-size:.65rem;"></i> Sinopsis</div>
          <div class="eb-group">
            <textarea name="sinopsis" class="eb-textarea @error('sinopsis') is-invalid @enderror"
                      placeholder="Tulis sinopsis buku di sini...">{{ old('sinopsis') }}</textarea>
            @error('sinopsis')<div class="eb-feedback">{{ $message }}</div>@enderror
          </div>
        </div>

        {{-- ── ACTIONS ── --}}
        <div class="eb-actions">
          <button type="submit" class="btn-submit">
            <i class="fas fa-save" style="font-size:.8rem;"></i> Simpan E-Book
          </button>
          <a href="{{ route('admin.buku.index') }}" class="btn-cancel">
            <i class="fas fa-times" style="font-size:.75rem;"></i> Batal
          </a>
        </div>

      </form>
    </div>
  </div>
</div>

<script>
/* ── GENRE ── */
function handleGenreChange(cb) {
  const all     = document.querySelectorAll('input[name="id_genre[]"]');
  const checked = [...all].filter(b => b.checked);
  const label   = cb.closest('label');
  const checkEl = label.querySelector('.genre-check');

  if (cb.checked && checked.length > 3) {
    cb.checked = false;
    flashCounter('Maksimal 3 genre!', '#e11d48');
    return;
  }

  if (cb.checked) {
    label.classList.add('active');
    checkEl.textContent = '✓';
  } else {
    label.classList.remove('active');
    checkEl.textContent = '';
  }

  const n = [...all].filter(b => b.checked).length;
  updateDots(n);
  document.getElementById('genreCounterText').textContent = n + '/3 dipilih';
  document.getElementById('genreCounterText').style.color = n === 3 ? 'var(--violet)' : 'var(--muted)';
}

function updateDots(n) {
  [1,2,3].forEach(i => {
    document.getElementById('dot'+i).classList.toggle('filled', i <= n);
  });
}

function flashCounter(msg, color) {
  const el = document.getElementById('genreCounterText');
  const prev = el.textContent;
  el.textContent = msg; el.style.color = color;
  setTimeout(() => {
    const n = [...document.querySelectorAll('input[name="id_genre[]"]')].filter(b => b.checked).length;
    el.textContent = n + '/3 dipilih';
    el.style.color = n === 3 ? 'var(--violet)' : 'var(--muted)';
  }, 2000);
}

/* ── FILE PREVIEW ── */
function previewFile(input, previewId, nameId, wrapId) {
  if (!input.files || !input.files[0]) return;
  const file = input.files[0];
  const preview = document.getElementById(previewId);
  const nameEl  = document.getElementById(nameId);
  nameEl.textContent = file.name;
  preview.classList.add('show');
}
</script>

@endsection