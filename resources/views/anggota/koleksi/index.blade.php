<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LibCo — Koleksi Buku</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root,[data-theme="light"]{
      --blue-50:#eff6ff;--blue-100:#dbeafe;--blue-500:#3b82f6;--blue-600:#2563eb;--blue-700:#1d4ed8;
      --purple-50:#faf5ff;--purple-100:#ede9fe;--purple-500:#8b5cf6;--purple-600:#7c3aed;
      --ink:#111827;--ink2:#374151;--muted:#6b7280;--border:#e5e7eb;
      --body-bg:#f0f4ff;--card-bg:#ffffff;--nav-bg:rgba(255,255,255,.93);
      --search-bg:#ffffff;
      --grad-hero:linear-gradient(135deg,#1d4ed8 0%,#7c3aed 60%,#9333ea 100%);
      --grad-btn:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 100%);
      --grad-body:linear-gradient(135deg,#eff6ff 0%,#ede9fe 50%,#faf5ff 100%);
      --shadow-sm:0 1px 3px rgba(0,0,0,.06);--shadow-md:0 4px 16px rgba(37,99,235,.10);
      --shadow-lg:0 12px 40px rgba(37,99,235,.15);--shadow-xl:0 24px 60px rgba(37,99,235,.18);
      --modal-bg:#ffffff;--modal-overlay:rgba(17,24,39,.65);
    }
    [data-theme="dark"]{
      --ink:#f1f5f9;--ink2:#cbd5e1;--muted:#94a3b8;--border:#1e293b;
      --body-bg:#0f172a;--card-bg:#1e293b;--nav-bg:rgba(15,23,42,.95);
      --search-bg:#1e293b;
      --grad-hero:linear-gradient(135deg,#1d4ed8 0%,#6d28d9 60%,#7e22ce 100%);
      --grad-btn:linear-gradient(135deg,#2563eb 0%,#7c3aed 100%);
      --grad-body:linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#150e2b 100%);
      --shadow-sm:0 1px 3px rgba(0,0,0,.3);--shadow-md:0 4px 16px rgba(0,0,0,.3);
      --shadow-lg:0 12px 40px rgba(0,0,0,.4);--shadow-xl:0 24px 60px rgba(0,0,0,.5);
      --modal-bg:#1e293b;--modal-overlay:rgba(0,0,0,.8);
      --blue-50:rgba(59,130,246,.1);--blue-100:rgba(59,130,246,.15);
      --purple-50:rgba(139,92,246,.08);--purple-100:rgba(139,92,246,.15);
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--grad-body);background-attachment:fixed;color:var(--ink);min-height:100vh;transition:background .4s,color .4s}
    .topnav{position:sticky;top:0;z-index:200;background:var(--nav-bg);backdrop-filter:blur(20px);border-bottom:1px solid var(--border);height:64px;display:flex;align-items:center;padding:0 32px;gap:16px}
    .nav-logo{font-family:'Fraunces',serif;font-size:1.75rem;font-weight:700;background:var(--grad-btn);-webkit-background-clip:text;-webkit-text-fill-color:transparent;text-decoration:none}
    .nav-links{display:flex;gap:2px}
    .nav-link{display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;font-size:.82rem;font-weight:600;color:var(--muted);text-decoration:none}
    .nav-link.active{background:var(--grad-btn);color:white}
    .nav-search-wrap{flex:1;max-width:400px;margin:0 auto}
    .nav-search-box{display:flex;align-items:center;gap:8px;background:var(--search-bg);border:1.5px solid var(--border);border-radius:50px;padding:7px 16px}
    .nav-search-box input{flex:1;border:none;background:transparent;outline:none;color:var(--ink)}
    .nav-right{margin-left:auto;display:flex;align-items:center;gap:10px}
    .theme-toggle{width:56px;height:30px;border-radius:50px;background:var(--blue-50);border:1.5px solid var(--border);position:relative;cursor:pointer;display:flex;align-items:center;padding:2px}
    .toggle-thumb{width:24px;height:24px;border-radius:50%;background:var(--grad-btn);display:flex;align-items:center;justify-content:center;transition:transform .38s}
    [data-theme="dark"] .toggle-thumb{transform:translateX(26px)}
    .nav-avatar{width:36px;height:36px;border-radius:50%;background:var(--grad-btn);color:white;display:flex;align-items:center;justify-content:center;text-decoration:none}
    .page{max-width:1320px;margin:0 auto;padding:28px 32px 80px}
    .flash{display:flex;align-items:center;gap:10px;padding:11px 16px;border-radius:12px;margin-bottom:18px}
    .flash-success{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:#15803d}
    .flash-error{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#dc2626}
    .page-header{background:var(--grad-hero);border-radius:24px;padding:40px 52px;margin-bottom:28px;display:flex;align-items:center;justify-content:space-between}
    .ph-title{font-family:'Fraunces',serif;font-size:clamp(1.8rem,3vw,2.8rem);font-weight:600;color:white}
    .ph-title em{font-style:italic;color:#fde68a}
    .ph-stats{display:flex;gap:12px}
    .ph-stat{background:rgba(255,255,255,.1);border-radius:16px;padding:18px 24px;text-align:center}
    .ph-stat-num{font-family:'Fraunces',serif;font-size:2rem;font-weight:700;color:white}
    .filter-bar{background:var(--card-bg);border:1px solid var(--border);border-radius:18px;padding:14px 20px;margin-bottom:20px;display:flex;align-items:center;gap:12px;flex-wrap:wrap}
    .cat-chips{display:flex;gap:6px;flex-wrap:wrap;flex:1}
    .cat-chip,.avail-chip{display:inline-flex;align-items:center;gap:4px;padding:5px 13px;border-radius:50px;font-size:.75rem;font-weight:600;background:var(--body-bg);border:1.5px solid var(--border);color:var(--muted);cursor:pointer}
    .cat-chip.active,.avail-chip.active{background:var(--grad-btn);color:white;border-color:transparent}
    .toolbar{display:flex;align-items:center;gap:10px;margin-bottom:16px;flex-wrap:wrap}
    .result-info{flex:1;font-size:.8rem;color:var(--muted)}
    .sort-select{background:var(--card-bg);border:1.5px solid var(--border);border-radius:50px;padding:7px 30px 7px 14px;color:var(--ink)}
    .view-btn{width:34px;height:34px;border-radius:9px;border:1.5px solid var(--border);background:var(--card-bg);cursor:pointer;color:var(--ink)}
    .view-btn.active{background:var(--grad-btn);color:white;border-color:transparent}
    .reset-btn{padding:6px 12px;border-radius:50px;border:1.5px solid var(--border);background:var(--card-bg);cursor:pointer;color:var(--ink)}
    .book-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(155px,1fr));gap:22px}
    .book-grid.list-view{grid-template-columns:1fr;gap:8px}

    /* Grid card — no buttons */
    .book-card{text-decoration:none;color:inherit;display:block;cursor:pointer}
    .book-cover-wrap{position:relative;width:100%;aspect-ratio:2/3;border-radius:4px 12px 12px 4px;overflow:hidden;box-shadow:-3px 5px 18px rgba(37,99,235,.15);margin-bottom:10px;transition:transform .2s,box-shadow .2s}
    .book-card:hover .book-cover-wrap{transform:translateY(-4px);box-shadow:-3px 10px 28px rgba(37,99,235,.25)}
    .book-cover-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
    .book-cover-ph{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:2rem}
    .avail-dot{position:absolute;top:8px;right:8px;width:9px;height:9px;border-radius:50%;border:2px solid rgba(255,255,255,.8)}
    .avail-dot.ok{background:#4ade80}
    .avail-dot.none{background:#f87171}
    .book-name{font-size:.84rem;font-weight:700;color:var(--ink)}
    .book-author{font-size:.7rem;color:var(--muted);margin-top:2px}
    .book-footer{display:flex;align-items:center;gap:6px;margin-top:6px;flex-wrap:wrap}
    .book-kat{font-size:.6rem;font-weight:700;color:var(--purple-600);background:var(--purple-100);padding:2px 7px;border-radius:4px}
    .book-stok{font-size:.62rem;font-weight:600;color:#16a34a}
    .book-stok.habis{color:#dc2626}

    /* List card — with buttons */
    .list-item{display:none}
    .list-card{background:var(--card-bg);border:1px solid var(--border);border-radius:16px;padding:14px 16px;display:flex;gap:14px;align-items:center;text-decoration:none;color:inherit;cursor:pointer;transition:box-shadow .2s}
    .list-card:hover{box-shadow:var(--shadow-md)}
    .lc-cover{width:50px;height:74px;flex-shrink:0;border-radius:3px 8px 8px 3px;overflow:hidden;position:relative;background:linear-gradient(135deg,#3b82f6,#8b5cf6)}
    .lc-cover img{width:100%;height:100%;object-fit:cover}
    .lc-cover-ph{display:flex;align-items:center;justify-content:center;height:100%;font-size:1.4rem}
    .lc-info{flex:1;min-width:0}
    .lc-title{font-size:.88rem;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .lc-author{font-size:.71rem;color:var(--muted);margin-top:2px}
    .lc-kat{font-size:.6rem;font-weight:700;color:var(--purple-600);background:var(--purple-100);padding:2px 7px;border-radius:4px;display:inline-block;margin-top:5px}
    .lc-actions{display:flex;gap:7px;align-items:center;flex-shrink:0}
    .lc-stok{font-size:.7rem;font-weight:600}
    .lc-stok.ok{color:#16a34a}
    .lc-stok.none{color:#dc2626}
    .lc-btn{padding:7px 14px;border-radius:50px;font-size:.73rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:5px;white-space:nowrap}
    .lc-btn-ghost{background:var(--card-bg);border:1.5px solid var(--border);color:var(--ink2)}
    .lc-btn-pinjam{background:var(--grad-btn);color:white;border:none}
    .lc-btn-habis{background:#6b7280;color:white;border:none;opacity:.7;cursor:not-allowed}

    .empty-wrap{display:none;text-align:center;padding:64px 20px;grid-column:1/-1;color:var(--muted)}
    .empty-wrap.show{display:block}
    .pagination-wrap{margin-top:28px;display:flex;justify-content:center}

    /* Modal */
    .modal-overlay{display:none;position:fixed;inset:0;z-index:500;background:var(--modal-overlay);backdrop-filter:blur(10px);align-items:center;justify-content:center;padding:16px}
    .modal-overlay.show{display:flex}
    .modal-box{background:var(--modal-bg);border-radius:24px;max-width:580px;width:100%;max-height:90vh;overflow-y:auto;box-shadow:var(--shadow-xl)}
    .modal-inner{display:flex;gap:24px;padding:28px}
    .modal-cover{width:128px;height:188px;border-radius:4px 12px 12px 4px;overflow:hidden;position:relative;flex-shrink:0;background:linear-gradient(135deg,#3b82f6,#8b5cf6)}
    .modal-cover img{width:100%;height:100%;object-fit:cover}
    .modal-cover-ph{display:flex;align-items:center;justify-content:center;height:100%;font-size:3rem}
    .modal-info{flex:1}
    .modal-title{font-size:1.15rem;font-weight:800;line-height:1.3}
    .modal-meta{color:var(--muted);margin:8px 0;font-size:.82rem}
    .modal-sinopsis{font-size:.8rem;color:var(--ink2);margin:12px 0;line-height:1.6}
    .modal-btns{display:flex;gap:9px;margin-top:16px}
    .modal-btn{padding:10px 16px;border-radius:50px;font-size:.79rem;font-weight:700;text-decoration:none;text-align:center;flex:1;display:inline-block}
    .mb-outline{border:1.5px solid var(--border);background:var(--card-bg);color:var(--ink)}
    .mb-fill{background:var(--grad-btn);color:white;border:none}
    .mb-habis{background:#6b7280;color:white;border:none;opacity:.7;cursor:not-allowed}

    @media(max-width:768px){
      .topnav{padding:0 16px}
      .page{padding:20px 16px}
      .modal-inner{flex-direction:column;align-items:center}
      .nav-links{display:none}
    }
  </style>
</head>
<body>

<nav class="topnav">
  <a href="{{ route('anggota.dashboard') }}" class="nav-logo">LibCo</a>
  <div class="nav-links">
    <a href="{{ route('anggota.dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
    <a href="{{ route('anggota.buku.index') }}" class="nav-link active"><i class="fas fa-book-open"></i> Koleksi</a>
    <a href="{{ route('anggota.riwayat_saya') }}" class="nav-link"><i class="fas fa-history"></i> Riwayat</a>
    <a href="{{ route('anggota.profile.show') }}" class="nav-link"><i class="fas fa-user"></i> Profil</a>
  </div>
  <div class="nav-search-wrap">
    <div class="nav-search-box">
      <i class="fas fa-search" style="color:var(--muted)"></i>
      <input type="text" id="navSearch" placeholder="Cari judul atau penulis…">
    </div>
  </div>
  <div class="nav-right">
    <button class="theme-toggle" id="themeToggle"><div class="toggle-thumb">🌙</div></button>
    <a href="{{ route('anggota.profile.show') }}" class="nav-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</a>
    <form method="POST" action="/logout" style="display:inline;">@csrf<button type="submit" style="background:none;border:none;color:var(--muted);cursor:pointer"><i class="fas fa-sign-out-alt"></i></button></form>
  </div>
</nav>

<div class="page">
  @if(session('success'))<div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
  @if(session('error'))<div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif

  <div class="page-header">
    <div>
      <h1 class="ph-title">Koleksi <em>Buku</em></h1>
      <p class="ph-sub" style="color:rgba(255,255,255,.7);margin-top:6px">{{ $ebooks->total() }} judul tersedia</p>
    </div>
    <div class="ph-stats">
      <div class="ph-stat"><div class="ph-stat-num">{{ $ebooks->total() }}</div><div style="color:rgba(255,255,255,.7);font-size:.8rem">Total</div></div>
      <div class="ph-stat"><div class="ph-stat-num">{{ $ebooks->where('jumlah_ebook','>',0)->count() }}</div><div style="color:rgba(255,255,255,.7);font-size:.8rem">Tersedia</div></div>
    </div>
  </div>

  <div class="filter-bar">
    <div class="cat-chips">
      <button class="cat-chip active" data-cat="semua">Semua</button>
      @foreach($kategoris as $kat)
        <button class="cat-chip" data-cat="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</button>
      @endforeach
    </div>
    <div style="display:flex;gap:6px">
      <button class="avail-chip active" data-avail="semua">Semua</button>
      <button class="avail-chip" data-avail="tersedia">Tersedia</button>
      <button class="avail-chip" data-avail="habis">Habis</button>
    </div>
  </div>

  <div class="toolbar">
    <span class="result-info" id="resultInfo"></span>
    <button class="reset-btn" id="resetBtn"><i class="fas fa-undo" style="font-size:.7rem"></i> Reset</button>
    <select class="sort-select" id="sortSelect">
      <option value="default">Terbaru</option>
      <option value="az">A–Z</option>
      <option value="za">Z–A</option>
      <option value="stok">Stok</option>
    </select>
    <div class="view-toggle" style="display:flex;gap:4px">
      <button class="view-btn active" id="btnGrid"><i class="fas fa-th"></i></button>
      <button class="view-btn" id="btnList"><i class="fas fa-list"></i></button>
    </div>
  </div>

  <div class="book-grid" id="bookGrid">
    @forelse($ebooks as $book)
      @php
        $stok = $book->jumlah_ebook ?? 0;
        $coverUrl = !empty($book->cover) ? Storage::disk('supabase')->url($book->cover) : '';
      @endphp

      {{-- GRID CARD (tanpa button) --}}
      <a href="#" class="book-card grid-item"
         data-id="{{ $book->id_buku }}"
         data-kategori-id="{{ $book->id_kategori }}"
         onclick="bukaModal(event,this)">
        <div class="book-cover-wrap">
          @if($coverUrl)
            <img src="{{ $coverUrl }}" class="book-cover-img" loading="lazy" alt="{{ $book->judul_buku }}">
          @else
            <div class="book-cover-ph" style="background:linear-gradient(135deg,#3b82f6,#8b5cf6)">📚</div>
          @endif
          <div class="avail-dot {{ $stok > 0 ? 'ok' : 'none' }}"></div>
        </div>
        <div class="book-name">{{ Str::limit($book->judul_buku, 40) }}</div>
        <div class="book-author">{{ $book->pengarang }}</div>
        <div class="book-footer">
          <span class="book-kat">{{ $book->kategori->nama_kategori ?? '-' }}</span>
          <span class="book-stok {{ $stok > 0 ? '' : 'habis' }}">{{ $stok > 0 ? $stok.' tersedia' : 'Habis' }}</span>
        </div>
      </a>

      {{-- LIST CARD (dengan button) --}}
      <a href="#" class="list-card list-item"
         data-id="{{ $book->id_buku }}"
         data-kategori-id="{{ $book->id_kategori }}"
         onclick="bukaModal(event,this)">
        <div class="lc-cover">
          @if($coverUrl)
            <img src="{{ $coverUrl }}" loading="lazy" alt="{{ $book->judul_buku }}">
          @else
            <div class="lc-cover-ph">📚</div>
          @endif
        </div>
        <div class="lc-info">
          <div class="lc-title">{{ $book->judul_buku }}</div>
          <div class="lc-author">{{ $book->pengarang }}</div>
          <span class="lc-kat">{{ $book->kategori->nama_kategori ?? '-' }}</span>
        </div>
        <div class="lc-actions">
          <span class="lc-stok {{ $stok > 0 ? 'ok' : 'none' }}">{{ $stok > 0 ? $stok.' eks' : 'Habis' }}</span>
          <a href="{{ route('anggota.buku.show', $book->id_buku) }}" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()">Detail</a>
          @if($stok > 0)
            <a href="{{ route('anggota.buku.show', $book->id_buku) }}" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()">Pinjam</a>
          @else
            <span class="lc-btn lc-btn-habis">Habis</span>
          @endif
        </div>
      </a>

    @empty
      <div class="empty-wrap show">Belum ada buku tersedia.</div>
    @endforelse

    <div class="empty-wrap" id="emptyState">
      <i class="fas fa-search" style="font-size:2rem;margin-bottom:12px;opacity:.3"></i><br>
      Tidak ada buku yang ditemukan.
    </div>
  </div>

  <div class="pagination-wrap">{{ $ebooks->links() }}</div>
</div>

{{-- MODAL --}}
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <div class="modal-inner">
      <div class="modal-cover" id="mCover"></div>
      <div class="modal-info">
        <h3 class="modal-title" id="mJudul"></h3>
        <p class="modal-meta" id="mMeta"></p>
        <p class="modal-sinopsis" id="mSinopsis"></p>
        <div class="modal-btns" id="mBtns"></div>
      </div>
    </div>
  </div>
</div>

<script>
// ── Data map ──────────────────────────────────────────────────
const BOOKS_MAP = {};
@foreach($ebooks as $book)
BOOKS_MAP[{{ $book->id_buku }}] = {
  id: {{ $book->id_buku }},
  judul: "{{ addslashes($book->judul_buku) }}",
  penulis: "{{ addslashes($book->pengarang) }}",
  sinopsis: "{{ addslashes(Str::limit($book->sinopsis ?? 'Tidak ada sinopsis.', 200)) }}",
  stok: {{ $book->jumlah_ebook ?? 0 }},
  kategori: "{{ addslashes($book->kategori->nama_kategori ?? '-') }}",
  kategoriId: "{{ $book->id_kategori ?? '' }}",
  cover: "{{ !empty($book->cover) ? Storage::disk('supabase')->url($book->cover) : '' }}",
  detailUrl: "{{ route('anggota.buku.show', $book->id_buku) }}"
};
@endforeach

// ── State ─────────────────────────────────────────────────────
let isGrid = true;
let activeCat = 'semua';
let activeAvail = 'semua';
let activeSearch = '';

const gridItems = document.querySelectorAll('.grid-item');
const listItems = document.querySelectorAll('.list-item');

// ── Filter & render ───────────────────────────────────────────
function applyFilters() {
  let vis = 0;
  const search = activeSearch.toLowerCase();

  gridItems.forEach((g, i) => {
    const id = g.dataset.id;
    const b = BOOKS_MAP[id];
    if (!b) return;

    // FIX: bandingkan kategoriId (string) dengan activeCat
    const catMatch  = activeCat === 'semua' || b.kategoriId === activeCat;
    const searchMatch = !search || b.judul.toLowerCase().includes(search) || b.penulis.toLowerCase().includes(search);
    const availMatch = activeAvail === 'semua' || (activeAvail === 'tersedia' && b.stok > 0) || (activeAvail === 'habis' && b.stok === 0);

    const show = catMatch && searchMatch && availMatch;

    // Grid item
    g.style.display = (isGrid && show) ? 'block' : 'none';

    // List item (pasangan index yang sama)
    if (listItems[i]) {
      listItems[i].style.display = (!isGrid && show) ? 'flex' : 'none';
    }

    if (show) vis++;
  });

  document.getElementById('resultInfo').innerHTML = `Menampilkan <strong>${vis}</strong> dari <strong>${gridItems.length}</strong> buku`;
  document.getElementById('emptyState').classList.toggle('show', vis === 0);
}

// ── Category chips ────────────────────────────────────────────
document.querySelectorAll('.cat-chip').forEach(c => {
  c.onclick = function () {
    document.querySelectorAll('.cat-chip').forEach(x => x.classList.remove('active'));
    this.classList.add('active');
    activeCat = this.dataset.cat;
    applyFilters();
  };
});

// ── Availability chips ────────────────────────────────────────
document.querySelectorAll('.avail-chip').forEach(a => {
  a.onclick = function () {
    document.querySelectorAll('.avail-chip').forEach(x => x.classList.remove('active'));
    this.classList.add('active');
    activeAvail = this.dataset.avail;
    applyFilters();
  };
});

// ── Search ────────────────────────────────────────────────────
document.getElementById('navSearch').oninput = function () {
  activeSearch = this.value;
  applyFilters();
};

// ── Reset ─────────────────────────────────────────────────────
document.getElementById('resetBtn').onclick = function () {
  activeCat = 'semua';
  activeAvail = 'semua';
  activeSearch = '';
  document.getElementById('navSearch').value = '';
  document.querySelectorAll('.cat-chip').forEach(c => c.classList.remove('active'));
  document.querySelector('.cat-chip').classList.add('active');
  document.querySelectorAll('.avail-chip').forEach(a => a.classList.remove('active'));
  document.querySelector('.avail-chip').classList.add('active');
  applyFilters();
};

// ── View toggle ───────────────────────────────────────────────
document.getElementById('btnGrid').onclick = function () {
  isGrid = true;
  this.classList.add('active');
  document.getElementById('btnList').classList.remove('active');
  document.getElementById('bookGrid').classList.remove('list-view');
  applyFilters();
};
document.getElementById('btnList').onclick = function () {
  isGrid = false;
  this.classList.add('active');
  document.getElementById('btnGrid').classList.remove('active');
  document.getElementById('bookGrid').classList.add('list-view');
  applyFilters();
};

// ── Sort ──────────────────────────────────────────────────────
document.getElementById('sortSelect').onchange = function () {
  const grid = document.getElementById('bookGrid');
  const val = this.value;

  const sortFn = (a, b) => {
    const ba = BOOKS_MAP[a.dataset.id], bb = BOOKS_MAP[b.dataset.id];
    if (val === 'az') return ba.judul.localeCompare(bb.judul);
    if (val === 'za') return bb.judul.localeCompare(ba.judul);
    if (val === 'stok') return bb.stok - ba.stok;
    return 0;
  };

  [...gridItems].sort(sortFn).forEach(i => grid.appendChild(i));
  [...listItems].sort(sortFn).forEach(i => grid.appendChild(i));
  applyFilters();
};

// ── Modal ─────────────────────────────────────────────────────
function bukaModal(e, el) {
  e.preventDefault();
  const b = BOOKS_MAP[el.dataset.id];
  if (!b) return;

  // Cover
  document.getElementById('mCover').innerHTML = b.cover
    ? `<img src="${b.cover}" alt="${b.judul}">`
    : '<div class="modal-cover-ph">📚</div>';

  document.getElementById('mJudul').innerText = b.judul;

  document.getElementById('mMeta').innerHTML =
    `oleh <strong>${b.penulis}</strong> &nbsp;•&nbsp; <span class="lc-kat">${b.kategori}</span> &nbsp;•&nbsp; ` +
    (b.stok > 0 ? `<span style="color:#16a34a;font-weight:600">${b.stok} tersedia</span>` : `<span style="color:#dc2626;font-weight:600">Stok habis</span>`);

  document.getElementById('mSinopsis').innerText = b.sinopsis;

  document.getElementById('mBtns').innerHTML =
    `<a href="${b.detailUrl}" class="modal-btn mb-outline">Detail</a>` +
    (b.stok > 0
      ? `<a href="${b.detailUrl}" class="modal-btn mb-fill">Pinjam Buku</a>`
      : `<span class="modal-btn mb-habis">Stok Habis</span>`);

  document.getElementById('modalOverlay').classList.add('show');
}

function tutupModal() {
  document.getElementById('modalOverlay').classList.remove('show');
}

document.getElementById('modalOverlay').onclick = function (e) {
  if (e.target === this) tutupModal();
};

// ── Theme ─────────────────────────────────────────────────────
document.getElementById('themeToggle').onclick = function () {
  const html = document.documentElement;
  const isDark = html.getAttribute('data-theme') === 'dark';
  html.setAttribute('data-theme', isDark ? 'light' : 'dark');
  localStorage.setItem('libco-theme', isDark ? 'light' : 'dark');
};
(function () {
  const t = localStorage.getItem('libco-theme') || 'light';
  document.documentElement.setAttribute('data-theme', t);
})();

// ── Init ──────────────────────────────────────────────────────
applyFilters();
</script>
</body>
</html>