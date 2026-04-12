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
    .cat-chip{display:inline-flex;align-items:center;gap:4px;padding:5px 13px;border-radius:50px;font-size:.75rem;font-weight:600;background:var(--body-bg);border:1.5px solid var(--border);color:var(--muted);cursor:pointer;transition:all .18s}
    .cat-chip.active{background:var(--grad-btn);border-color:transparent;color:white;box-shadow:0 3px 10px rgba(124,58,237,.25)}
    .toolbar{display:flex;align-items:center;gap:10px;margin-bottom:16px;flex-wrap:wrap}
    .result-info{flex:1;font-size:.8rem;color:var(--muted)}
    .sort-select{background:var(--card-bg);border:1.5px solid var(--border);border-radius:50px;padding:7px 30px 7px 14px;color:var(--ink);cursor:pointer}
    .view-toggle{display:flex;gap:3px}
    .view-btn{width:34px;height:34px;border-radius:9px;border:1.5px solid var(--border);background:var(--card-bg);cursor:pointer}
    .view-btn.active{background:var(--grad-btn);color:white}
    .reset-btn{padding:6px 12px;border-radius:50px;border:1.5px solid var(--border);background:var(--card-bg);cursor:pointer}
    .book-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(165px,1fr));gap:22px}
    .book-card{text-decoration:none;color:inherit;display:block;cursor:pointer;transition:transform .2s}
    .book-card:hover{transform:translateY(-4px)}
    .book-cover-wrap{position:relative;width:100%;aspect-ratio:2/3;border-radius:4px 12px 12px 4px;overflow:hidden;box-shadow:-3px 5px 18px rgba(37,99,235,.15);margin-bottom:10px}
    .book-cover-img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
    .book-cover-ph{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#1d4ed8,#7c3aed)}
    .avail-dot{position:absolute;top:8px;right:8px;width:9px;height:9px;border-radius:50%;border:2px solid rgba(255,255,255,.8);z-index:2}
    .avail-dot.ok{background:#4ade80}
    .avail-dot.none{background:#f87171}
    .book-name{font-size:.85rem;font-weight:700;color:var(--ink);line-height:1.35;margin-bottom:3px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .book-author{font-size:.7rem;color:var(--muted);margin-bottom:5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .book-footer{display:flex;align-items:center;gap:6px;flex-wrap:wrap}
    .book-kat{font-size:.6rem;font-weight:700;text-transform:uppercase;color:var(--purple-600);background:var(--purple-100);padding:2px 7px;border-radius:4px}
    .book-stok{font-size:.62rem;font-weight:600;color:#16a34a;display:flex;align-items:center;gap:3px}
    .book-stok.habis{color:#dc2626}
    .book-stok::before{content:'';width:5px;height:5px;border-radius:50%;background:currentColor}
    .empty-wrap{display:none;text-align:center;padding:64px 20px;grid-column:1/-1}
    .empty-wrap.show{display:block}
    .pagination-wrap{margin-top:28px;display:flex;justify-content:center}
    .modal-overlay{display:none;position:fixed;inset:0;z-index:500;background:var(--modal-overlay);backdrop-filter:blur(10px);align-items:center;justify-content:center}
    .modal-overlay.show{display:flex}
    .modal-box{background:var(--modal-bg);border-radius:24px;max-width:580px;width:100%;max-height:90vh;overflow-y:auto}
    .modal-inner{display:flex;gap:24px;padding:24px}
    .modal-cover{width:128px;height:188px;border-radius:4px 12px 12px 4px;overflow:hidden;position:relative;flex-shrink:0}
    .modal-cover img{width:100%;height:100%;object-fit:cover}
    .modal-info{flex:1}
    .modal-title{font-size:1.15rem;font-weight:800}
    .modal-btns{display:flex;gap:9px;margin-top:16px}
    .modal-btn{padding:10px 16px;border-radius:50px;font-size:.79rem;font-weight:700;text-decoration:none;text-align:center}
    .mb-outline{border:1.5px solid var(--border);background:var(--card-bg);flex:1}
    .mb-fill{background:var(--grad-btn);color:white;flex:1.6}
    @media(max-width:768px){.topnav{padding:0 16px}.page{padding:20px 16px}.modal-inner{flex-direction:column;align-items:center}.book-grid{grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:14px}}
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
      <i class="fas fa-search"></i>
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
    <div><h1 class="ph-title">Koleksi <em>Buku</em></h1><p class="ph-sub" style="color:rgba(255,255,255,.7);margin-top:8px">{{ $ebooks->total() }} judul tersedia</p></div>
    <div class="ph-stats"><div class="ph-stat"><div class="ph-stat-num">{{ $ebooks->total() }}</div><div class="ph-stat-label">Total</div></div><div class="ph-stat"><div class="ph-stat-num">{{ $ebooks->where('jumlah_ebook','>',0)->count() }}</div><div class="ph-stat-label">Tersedia</div></div></div>
  </div>

  <div class="filter-bar">
    <span class="filter-bar-label"><i class="fas fa-filter"></i> Kategori</span>
    <div class="cat-chips">
      <button class="cat-chip active" data-cat="semua">Semua <span class="cat-chip-count">({{ $ebooks->total() }})</span></button>
      @foreach($kategoris as $kat)
        <button class="cat-chip" data-cat="{{ $kat->nama_kategori }}">{{ $kat->nama_kategori }} <span class="cat-chip-count">({{ $kat->ebooks_count }})</span></button>
      @endforeach
    </div>
  </div>

  <div class="toolbar">
    <span class="result-info" id="resultInfo"></span>
    <button class="reset-btn" id="resetBtn"><i class="fas fa-rotate-left"></i> Reset</button>
    <select class="sort-select" id="sortSelect">
      <option value="default">Terbaru</option>
      <option value="az">Judul A–Z</option>
      <option value="za">Judul Z–A</option>
      <option value="stok">Stok Terbanyak</option>
    </select>
    <div class="view-toggle">
      <button class="view-btn active" id="btnGrid"><i class="fas fa-th-large"></i></button>
      <button class="view-btn" id="btnList"><i class="fas fa-list"></i></button>
    </div>
  </div>

  <div class="book-grid" id="bookGrid">
    @forelse($ebooks as $book)
    @php 
      $stok = $book->jumlah_ebook ?? 0; 
      $coverUrl = !empty($book->cover) ? Storage::disk('supabase')->url($book->cover) : ''; 
      $colors = ['linear-gradient(135deg,#1d4ed8,#7c3aed)','linear-gradient(135deg,#0f766e,#0891b2)','linear-gradient(135deg,#b45309,#d97706)','linear-gradient(135deg,#9333ea,#ec4899)','linear-gradient(135deg,#047857,#059669)','linear-gradient(135deg,#dc2626,#ea580c)'];
      $color = $colors[$loop->index % count($colors)];
    @endphp
    
    <div class="book-card" data-id="{{ $book->id_buku }}" data-judul="{{ strtolower($book->judul_buku) }}" data-penulis="{{ strtolower($book->pengarang) }}" data-kategori="{{ $book->kategori->nama_kategori ?? '-' }}" data-stok="{{ $stok }}" onclick="bukaModal(event,this)">
      <div class="book-cover-wrap">
        @if($coverUrl)
          <img src="{{ $coverUrl }}" class="book-cover-img" alt="{{ $book->judul_buku }}" loading="lazy">
        @else
          <div class="book-cover-ph" style="background:{{ $color }}"><span style="font-size:2rem;color:white">📚</span></div>
        @endif
        <div class="avail-dot {{ $stok > 0 ? 'ok' : 'none' }}"></div>
      </div>
      <div class="book-name">{{ Str::limit($book->judul_buku, 45) }}</div>
      <div class="book-author">{{ $book->pengarang }}</div>
      <div class="book-footer">
        <span class="book-kat">{{ $book->kategori->nama_kategori ?? '-' }}</span>
        <span class="book-stok {{ $stok > 0 ? '' : 'habis' }}">{{ $stok > 0 ? $stok.' tersedia' : 'Habis' }}</span>
      </div>
    </div>
    @empty
    <div class="empty-wrap show">Belum ada buku dalam koleksi</div>
    @endforelse
    <div class="empty-wrap" id="emptyState"><i class="fas fa-book-open" style="font-size:3rem;opacity:0.5;margin-bottom:12px;display:block"></i>Tidak ada buku yang ditemukan</div>
  </div>
  
  <div class="pagination-wrap">{{ $ebooks->links() }}</div>
</div>

<div class="modal-overlay" id="modalOverlay" onclick="if(event.target===this) tutupModal()">
  <div class="modal-box">
    <div style="padding:16px 24px 0;text-align:right"><button onclick="tutupModal()" style="background:none;border:none;font-size:1.2rem;cursor:pointer;color:var(--muted)">✕</button></div>
    <div class="modal-inner">
      <div class="modal-cover" id="mCover"></div>
      <div class="modal-info">
        <h3 class="modal-title" id="mJudul"></h3>
        <p id="mPenulis" style="color:var(--muted);margin:8px 0"></p>
        <p id="mSinopsis" style="font-size:.8rem;color:var(--ink2);margin:12px 0;line-height:1.6"></p>
        <div class="modal-btns" id="mBtns"></div>
      </div>
    </div>
  </div>
</div>

<script>
// Data buku dari server
const booksData = @json($ebooks->map(function($book) {
    return [
        'id' => $book->id_buku,
        'judul' => $book->judul_buku,
        'penulis' => $book->pengarang,
        'sinopsis' => Str::limit($book->sinopsis ?? 'Tidak ada sinopsis untuk buku ini.', 300),
        'stok' => $book->jumlah_ebook ?? 0,
        'kategori' => $book->kategori->nama_kategori ?? '-',
        'cover' => !empty($book->cover) ? Storage::disk('supabase')->url($book->cover) : '',
        'detailUrl' => route('anggota.buku.show', $book->id_buku)
    ];
}));

// Variabel filter
let isGrid = true;
let activeCat = 'semua';
let activeSearch = '';

// DOM elements
const bookGrid = document.getElementById('bookGrid');
const gridCards = document.querySelectorAll('.book-card');
const resultInfo = document.getElementById('resultInfo');
const emptyState = document.getElementById('emptyState');

// Fungsi filter
function applyFilters() {
    let visibleCount = 0;
    const searchLower = activeSearch.toLowerCase();
    
    gridCards.forEach(card => {
        const judul = card.dataset.judul || '';
        const penulis = card.dataset.penulis || '';
        const kategori = card.dataset.kategori || '';
        const stok = parseInt(card.dataset.stok);
        
        const catMatch = activeCat === 'semua' || kategori === activeCat;
        const searchMatch = searchLower === '' || judul.includes(searchLower) || penulis.includes(searchLower);
        
        const show = catMatch && searchMatch;
        
        card.style.display = show ? 'block' : 'none';
        if (show) visibleCount++;
    });
    
    resultInfo.innerHTML = `Menampilkan <strong>${visibleCount}</strong> dari ${gridCards.length} buku`;
    emptyState.classList.toggle('show', visibleCount === 0);
}

// Event listener kategori
document.querySelectorAll('.cat-chip').forEach(chip => {
    chip.addEventListener('click', function() {
        document.querySelectorAll('.cat-chip').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        activeCat = this.dataset.cat;
        applyFilters();
    });
});

// Event listener search
let debounceTimer;
document.getElementById('navSearch').addEventListener('input', function() {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        activeSearch = this.value.trim().toLowerCase();
        applyFilters();
    }, 300);
});

// Reset filter
document.getElementById('resetBtn').addEventListener('click', function() {
    activeCat = 'semua';
    activeSearch = '';
    document.getElementById('navSearch').value = '';
    document.querySelectorAll('.cat-chip').forEach(c => c.classList.remove('active'));
    document.querySelector('.cat-chip[data-cat="semua"]').classList.add('active');
    applyFilters();
});

// Sorting
document.getElementById('sortSelect').addEventListener('change', function() {
    const cards = Array.from(gridCards);
    cards.sort((a, b) => {
        const judulA = a.dataset.judul || '';
        const judulB = b.dataset.judul || '';
        const stokA = parseInt(a.dataset.stok) || 0;
        const stokB = parseInt(b.dataset.stok) || 0;
        
        if (this.value === 'az') return judulA.localeCompare(judulB);
        if (this.value === 'za') return judulB.localeCompare(judulA);
        if (this.value === 'stok') return stokB - stokA;
        return 0;
    });
    cards.forEach(card => bookGrid.appendChild(card));
});

// View toggle
document.getElementById('btnGrid').addEventListener('click', function() {
    isGrid = true;
    this.classList.add('active');
    document.getElementById('btnList').classList.remove('active');
    bookGrid.classList.remove('list-view');
});

document.getElementById('btnList').addEventListener('click', function() {
    isGrid = false;
    this.classList.add('active');
    document.getElementById('btnGrid').classList.remove('active');
    bookGrid.classList.add('list-view');
});

// Modal
function bukaModal(event, element) {
    event.preventDefault();
    const id = element.dataset.id;
    const book = booksData.find(b => b.id == id);
    if (!book) return;
    
    const coverHtml = book.cover 
        ? `<img src="${book.cover}" alt="${book.judul}" style="width:100%;height:100%;object-fit:cover">`
        : `<div style="display:flex;align-items:center;justify-content:center;height:100%;background:linear-gradient(135deg,#1d4ed8,#7c3aed);color:white;font-size:2rem">📚</div>`;
    
    document.getElementById('mCover').innerHTML = coverHtml;
    document.getElementById('mJudul').innerText = book.judul;
    document.getElementById('mPenulis').innerHTML = `oleh <strong>${book.penulis}</strong> • <span style="background:var(--purple-100);padding:2px 8px;border-radius:4px;font-size:.7rem">${book.kategori}</span> • ${book.stok > 0 ? `<span style="color:#16a34a">${book.stok} tersedia</span>` : '<span style="color:#dc2626">Stok habis</span>'}`;
    document.getElementById('mSinopsis').innerText = book.sinopsis;
    document.getElementById('mBtns').innerHTML = `
        <a href="${book.detailUrl}" class="modal-btn mb-outline"><i class="fas fa-eye"></i> Detail</a>
        ${book.stok > 0 ? `<a href="${book.detailUrl}" class="modal-btn mb-fill"><i class="fas fa-book-open"></i> Pinjam Sekarang</a>` : `<span class="modal-btn mb-fill" style="background:#6b7280;cursor:not-allowed"><i class="fas fa-times"></i> Stok Habis</span>`}
    `;
    document.getElementById('modalOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function tutupModal() {
    document.getElementById('modalOverlay').classList.remove('show');
    document.body.style.overflow = '';
}

// Theme toggle
document.getElementById('themeToggle').addEventListener('click', function() {
    const html = document.documentElement;
    const isDark = html.getAttribute('data-theme') === 'dark';
    html.setAttribute('data-theme', isDark ? 'light' : 'dark');
    localStorage.setItem('libco-theme', isDark ? 'light' : 'dark');
});

// Inisialisasi tema
(function() {
    const savedTheme = localStorage.getItem('libco-theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);
})();

// Inisialisasi filter
applyFilters();
</script>
</body>
</html>