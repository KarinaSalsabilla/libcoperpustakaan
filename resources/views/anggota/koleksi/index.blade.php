<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>LibCo — Koleksi Buku</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    /* ---------- CSS VAR ---------- */
    :root,[data-theme="light"]{
      --blue-50:#eff6ff; --blue-100:#dbeafe; --blue-500:#3b82f6; --blue-600:#2563eb; --blue-700:#1d4ed8;
      --purple-50:#faf5ff; --purple-100:#ede9fe; --purple-500:#8b5cf6; --purple-600:#7c3aed;
      --ink:#111827; --ink2:#374151; --muted:#6b7280; --border:#e5e7eb;
      --body-bg:#f0f4ff; --card-bg:#ffffff; --nav-bg:rgba(255,255,255,.93);
      --search-bg:#ffffff;
      --grad-hero:linear-gradient(135deg,#1d4ed8 0%,#7c3aed 60%,#9333ea 100%);
      --grad-btn:linear-gradient(135deg,#3b82f6 0%,#8b5cf6 100%);
      --grad-body:linear-gradient(135deg,#eff6ff 0%,#ede9fe 50%,#faf5ff 100%);
      --shadow-sm:0 1px 3px rgba(0,0,0,.06); --shadow-md:0 4px 16px rgba(37,99,235,.10);
      --shadow-lg:0 12px 40px rgba(37,99,235,.15); --shadow-xl:0 24px 60px rgba(37,99,235,.18);
      --modal-bg:#ffffff; --modal-overlay:rgba(17,24,39,.65);
    }
    [data-theme="dark"]{
      --ink:#f1f5f9; --ink2:#cbd5e1; --muted:#94a3b8; --border:#1e293b;
      --body-bg:#0f172a; --card-bg:#1e293b; --nav-bg:rgba(15,23,42,.95);
      --search-bg:#1e293b;
      --grad-hero:linear-gradient(135deg,#1d4ed8 0%,#6d28d9 60%,#7e22ce 100%);
      --grad-btn:linear-gradient(135deg,#2563eb 0%,#7c3aed 100%);
      --grad-body:linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#150e2b 100%);
      --shadow-sm:0 1px 3px rgba(0,0,0,.3); --shadow-md:0 4px 16px rgba(0,0,0,.3);
      --shadow-lg:0 12px 40px rgba(0,0,0,.4); --shadow-xl:0 24px 60px rgba(0,0,0,.5);
      --modal-bg:#1e293b; --modal-overlay:rgba(0,0,0,.8);
      --blue-50:rgba(59,130,246,.1); --blue-100:rgba(59,130,246,.15);
      --purple-50:rgba(139,92,246,.08); --purple-100:rgba(139,92,246,.15);
    }

    *{box-sizing:border-box; margin:0; padding:0}
    html{scroll-behavior:smooth}
    body{font-family:'Plus Jakarta Sans',sans-serif; background:var(--grad-body); background-attachment:fixed; color:var(--ink); min-height:100vh; transition:background .4s,color .4s}
    ::-webkit-scrollbar{width:5px; height:5px}
    ::-webkit-scrollbar-track{background:transparent}
    ::-webkit-scrollbar-thumb{background:var(--border); border-radius:4px}

    /* TOPNAV */
    .topnav{position:sticky; top:0; z-index:200; background:var(--nav-bg); backdrop-filter:blur(20px); border-bottom:1px solid var(--border); height:64px; display:flex; align-items:center; padding:0 32px; gap:16px}
    .nav-logo{font-family:'Fraunces',serif; font-size:1.75rem; font-weight:700; background:var(--grad-btn); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; text-decoration:none; flex-shrink:0}
    .nav-links{display:flex; gap:2px}
    .nav-link{display:flex; align-items:center; gap:6px; padding:7px 14px; border-radius:10px; font-size:.82rem; font-weight:600; color:var(--muted); text-decoration:none; transition:all .2s}
    .nav-link i{font-size:.75rem}
    .nav-link:hover{background:var(--blue-50); color:var(--blue-600)}
    .nav-link.active{background:var(--grad-btn); color:white; box-shadow:0 4px 12px rgba(124,58,237,.3)}
    .nav-search-wrap{flex:1; max-width:400px; margin:0 auto}
    .nav-search-box{display:flex; align-items:center; gap:8px; background:var(--search-bg); border:1.5px solid var(--border); border-radius:50px; padding:7px 16px; transition:all .22s}
    .nav-search-box:focus-within{border-color:var(--blue-500); box-shadow:0 0 0 3px rgba(59,130,246,.13)}
    .nav-search-box i{color:var(--muted); font-size:.8rem}
    .nav-search-box:focus-within i{color:var(--blue-500)}
    .nav-search-box input{flex:1; border:none; background:transparent; outline:none; font-size:.82rem; color:var(--ink)}
    .nav-right{margin-left:auto; display:flex; align-items:center; gap:10px}
    .theme-toggle{width:56px; height:30px; border-radius:50px; background:var(--blue-50); border:1.5px solid var(--border); position:relative; cursor:pointer; display:flex; align-items:center; padding:2px}
    .toggle-thumb{width:24px; height:24px; border-radius:50%; background:var(--grad-btn); display:flex; align-items:center; justify-content:center; font-size:.75rem; transition:transform .38s cubic-bezier(.34,1.3,.64,1)}
    [data-theme="dark"] .toggle-thumb{transform:translateX(26px)}
    .toggle-sun{position:absolute; right:6px; font-size:.68rem; opacity:.4}
    .toggle-moon{position:absolute; left:6px; font-size:.68rem}
    [data-theme="light"] .toggle-sun{opacity:0}
    [data-theme="dark"] .toggle-moon{opacity:0}
    .nav-avatar{width:36px; height:36px; border-radius:50%; background:var(--grad-btn); color:white; display:flex; align-items:center; justify-content:center; font-weight:700; cursor:pointer; text-decoration:none}
    .nav-logout{background:none; border:none; cursor:pointer; font-size:.82rem; color:var(--muted); font-weight:600; padding:7px 10px; border-radius:8px; display:flex; align-items:center; gap:4px}
    .nav-logout:hover{background:rgba(239,68,68,.1); color:#ef4444}
    .flash{display:flex; align-items:center; gap:10px; padding:11px 16px; border-radius:12px; margin-bottom:18px; font-size:.82rem; font-weight:600}
    .flash-success{background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.25); color:#15803d}
    .flash-error{background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.25); color:#dc2626}
    [data-theme="dark"] .flash-success{color:#4ade80}
    [data-theme="dark"] .flash-error{color:#f87171}
    .page{max-width:1320px; margin:0 auto; padding:28px 32px 80px}

    /* PAGE HEADER */
    .page-header{background:var(--grad-hero); border-radius:24px; padding:40px 52px; margin-bottom:28px; position:relative; overflow:hidden; display:flex; align-items:center; justify-content:space-between; gap:28px; box-shadow:var(--shadow-xl)}
    .ph-deco-circle{position:absolute; right:-80px; top:-80px; width:300px; height:300px; border-radius:50%; background:rgba(255,255,255,.06)}
    .ph-books{position:absolute; right:60px; top:50%; transform:translateY(-50%); display:flex; gap:5px; opacity:.18}
    .ph-spine{width:14px; height:72px; background:#60a5fa; border-radius:2px 6px 6px 2px}
    .ph-left{position:relative; z-index:1}
    .ph-eyebrow{display:inline-flex; background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.2); border-radius:50px; padding:5px 14px; font-size:.62rem; font-weight:700; color:rgba(255,255,255,.9); margin-bottom:14px}
    .ph-eyebrow-dot{width:5px; height:5px; background:#fbbf24; border-radius:50%; animation:pulse 2s infinite}
    @keyframes pulse{0%,100%{opacity:1} 50%{opacity:.5}}
    .ph-title{font-family:'Fraunces',serif; font-size:clamp(1.8rem,3vw,2.8rem); font-weight:600; color:white; line-height:1.1; margin-bottom:12px}
    .ph-title em{font-style:italic; color:#fde68a}
    .ph-sub{font-size:.83rem; color:rgba(255,255,255,.65); max-width:500px}
    .ph-stats{display:flex; gap:12px}
    .ph-stat{background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.15); border-radius:16px; padding:18px 24px; text-align:center; backdrop-filter:blur(6px)}
    .ph-stat-num{font-family:'Fraunces',serif; font-size:2rem; font-weight:700; color:white}
    .ph-stat-label{font-size:.58rem; font-weight:700; text-transform:uppercase; color:rgba(255,255,255,.45)}

    /* FILTER BAR */
    .filter-bar{background:var(--card-bg); border:1px solid var(--border); border-radius:18px; padding:14px 20px; margin-bottom:20px; display:flex; align-items:center; gap:12px; flex-wrap:wrap}
    .filter-bar-label{font-size:.62rem; font-weight:800; text-transform:uppercase; color:var(--muted); display:flex; align-items:center; gap:6px}
    .cat-chips{display:flex; gap:6px; flex-wrap:wrap; flex:1}
    .cat-chip{display:inline-flex; align-items:center; gap:4px; padding:5px 13px; border-radius:50px; font-size:.75rem; font-weight:600; background:var(--body-bg); border:1.5px solid var(--border); color:var(--muted); cursor:pointer; transition:all .18s}
    .cat-chip.active{background:var(--grad-btn); border-color:transparent; color:white; box-shadow:0 3px 10px rgba(124,58,237,.25)}
    .avail-group{display:flex; gap:6px}
    .avail-chip{display:inline-flex; align-items:center; gap:5px; padding:5px 13px; border-radius:50px; font-size:.75rem; font-weight:600; background:var(--body-bg); border:1.5px solid var(--border); color:var(--muted); cursor:pointer}
    .avail-chip.active{background:var(--grad-btn); border-color:transparent; color:white}
    .avail-dot-chip{width:7px; height:7px; border-radius:50%}
    .avail-dot-chip.ok{background:#4ade80}
    .avail-dot-chip.none{background:#f87171}

    /* TOOLBAR */
    .toolbar{display:flex; align-items:center; gap:10px; margin-bottom:16px; flex-wrap:wrap}
    .result-info{flex:1; font-size:.8rem; color:var(--muted)}
    .sort-select{background:var(--card-bg); border:1.5px solid var(--border); border-radius:50px; padding:7px 30px 7px 14px; font-size:.77rem; font-weight:600; color:var(--ink); cursor:pointer; appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 10px center}
    .view-toggle{display:flex; gap:3px}
    .view-btn{width:34px; height:34px; border-radius:9px; border:1.5px solid var(--border); background:var(--card-bg); display:flex; align-items:center; justify-content:center; cursor:pointer}
    .view-btn.active{background:var(--grad-btn); color:white; border-color:transparent}
    .reset-btn{display:inline-flex; align-items:center; gap:5px; padding:6px 12px; border-radius:50px; font-size:.73rem; font-weight:600; border:1.5px solid var(--border); background:var(--card-bg); color:var(--muted); cursor:pointer}
    .reset-btn:hover{background:rgba(239,68,68,.08); border-color:#ef4444; color:#ef4444}

    /* GRID + LIST */
    .book-grid{display:grid; grid-template-columns:repeat(auto-fill, minmax(155px,1fr)); gap:22px}
    .book-grid.list-view{grid-template-columns:1fr; gap:8px}
    .book-card{text-decoration:none; color:inherit; display:block; cursor:pointer}
    .book-cover-wrap{position:relative; width:100%; aspect-ratio:2/3; border-radius:4px 12px 12px 4px; overflow:hidden; box-shadow:-3px 5px 18px rgba(37,99,235,.15); transition:transform .3s, box-shadow .3s; margin-bottom:10px}
    .book-card:hover .book-cover-wrap{transform:perspective(600px) rotateY(-6deg) translateY(-5px); box-shadow:6px 16px 32px rgba(37,99,235,.22)}
    .book-cover-img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block; z-index:1}
    .book-cover-ph{position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:var(--grad-btn); z-index:0}
    .book-cover-title{position:absolute; bottom:12px; left:0; right:0; padding:0 10px; z-index:2; font-size:.65rem; font-weight:700; color:white; text-shadow:0 1px 4px rgba(0,0,0,.8); text-align:center}
    .book-spine{position:absolute; left:0; top:0; bottom:0; width:8px; background:rgba(0,0,0,.22); border-radius:4px 0 0 4px; z-index:3}
    .avail-dot{position:absolute; top:8px; right:8px; width:9px; height:9px; border-radius:50%; border:2px solid rgba(255,255,255,.8); z-index:4}
    .avail-dot.ok{background:#4ade80}
    .avail-dot.none{background:#f87171}
    .hover-pinjam{position:absolute; bottom:9px; left:50%; transform:translateX(-50%) translateY(8px); opacity:0; background:var(--grad-btn); color:white; border:none; border-radius:50px; padding:6px 12px; font-size:.7rem; font-weight:700; cursor:pointer; transition:all .22s; white-space:nowrap; text-decoration:none}
    .book-card:hover .hover-pinjam{opacity:1; transform:translateX(-50%) translateY(0)}
    .hover-pinjam.habis{background:rgba(107,114,128,.75); cursor:default; pointer-events:none}
    .book-name{font-size:.84rem; font-weight:700; color:var(--ink); line-height:1.35; margin-bottom:2px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden}
    .book-author{font-size:.7rem; color:var(--muted); margin-bottom:6px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis}
    .book-footer{display:flex; align-items:center; gap:6px}
    .book-kat{font-size:.6rem; font-weight:700; text-transform:uppercase; color:var(--purple-600); background:var(--purple-100); padding:2px 7px; border-radius:4px}
    .book-stok{font-size:.62rem; font-weight:600; color:#16a34a; display:flex; align-items:center; gap:3px}
    .book-stok.habis{color:#dc2626}
    .book-stok::before{content:''; width:5px; height:5px; border-radius:50%; background:currentColor}

    /* LIST CARD */
    .list-card{background:var(--card-bg); border:1px solid var(--border); border-radius:16px; padding:14px 16px; display:flex; gap:14px; align-items:center; text-decoration:none; color:inherit; cursor:pointer; transition:all .2s}
    .list-card:hover{box-shadow:var(--shadow-md); transform:translateX(4px); border-color:var(--blue-500)}
    .lc-cover{width:50px; height:74px; flex-shrink:0; border-radius:3px 8px 8px 3px; overflow:hidden; position:relative}
    .lc-cover img{position:absolute; inset:0; width:100%; height:100%; object-fit:cover}
    .lc-spine{position:absolute; left:0; top:0; bottom:0; width:6px; background:rgba(0,0,0,.2); z-index:1}
    .lc-info{flex:1; min-width:0}
    .lc-title{font-size:.88rem; font-weight:700; color:var(--ink); white-space:nowrap; overflow:hidden; text-overflow:ellipsis}
    .lc-author{font-size:.71rem; color:var(--muted); margin-bottom:4px}
    .lc-tags{display:flex; gap:6px; align-items:center}
    .lc-kat{font-size:.6rem; font-weight:700; text-transform:uppercase; color:var(--purple-600); background:var(--purple-100); padding:2px 7px; border-radius:4px}
    .lc-tahun{font-size:.68rem; color:var(--muted)}
    .lc-desc{font-size:.74rem; color:var(--muted); line-height:1.55; margin-top:5px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden}
    .lc-actions{display:flex; gap:7px; align-items:center}
    .lc-stok{font-size:.7rem; font-weight:600}
    .lc-stok.ok{color:#16a34a}
    .lc-stok.none{color:#dc2626}
    .lc-btn{display:inline-flex; align-items:center; gap:5px; padding:7px 14px; border-radius:50px; font-size:.73rem; font-weight:700; text-decoration:none; cursor:pointer}
    .lc-btn-ghost{background:var(--card-bg); color:var(--ink2); border:1.5px solid var(--border)}
    .lc-btn-pinjam{background:var(--grad-btn); color:white; box-shadow:0 3px 10px rgba(124,58,237,.3)}
    .lc-btn-disabled{background:var(--card-bg); color:var(--muted); border:1.5px solid var(--border); cursor:not-allowed}
    .empty-wrap{display:none; text-align:center; padding:64px 20px; grid-column:1/-1}
    .empty-wrap.show{display:block}
    .pagination-wrap{margin-top:28px; display:flex; justify-content:center}

    /* MODAL */
    .modal-overlay{display:none; position:fixed; inset:0; z-index:500; background:var(--modal-overlay); backdrop-filter:blur(10px); align-items:center; justify-content:center}
    .modal-overlay.show{display:flex}
    .modal-box{background:var(--modal-bg); border-radius:24px; max-width:580px; width:100%; max-height:90vh; overflow-y:auto; animation:popIn .28s}
    @keyframes popIn{from{opacity:0; transform:scale(.95)} to{opacity:1; transform:scale(1)}}
    .modal-strip{height:4px; background:var(--grad-btn)}
    .modal-close-wrap{display:flex; justify-content:flex-end; padding:10px 14px 0}
    .modal-close{width:30px; height:30px; border-radius:50%; background:var(--border); border:none; cursor:pointer}
    .modal-inner{display:flex; gap:24px; padding:4px 26px 26px}
    .modal-cover{width:128px; height:188px; border-radius:4px 12px 12px 4px; overflow:hidden; position:relative}
    .modal-cover img{width:100%; height:100%; object-fit:cover}
    .modal-cover-spine{position:absolute; left:0; top:0; bottom:0; width:10px; background:rgba(0,0,0,.2)}
    .modal-avail{margin-top:9px; font-size:.7rem; font-weight:600; display:flex; align-items:center; justify-content:center; gap:5px}
    .modal-avail.ok{color:#16a34a}
    .modal-avail.none{color:#dc2626}
    .modal-kat{display:inline-block; margin-bottom:9px; font-size:.6rem; font-weight:700; text-transform:uppercase; color:var(--purple-600); background:var(--purple-100); padding:3px 10px; border-radius:4px}
    .modal-title{font-size:1.15rem; font-weight:800; margin-bottom:3px}
    .modal-author{font-size:.78rem; color:var(--muted); margin-bottom:14px}
    .modal-metas{display:grid; grid-template-columns:1fr 1fr; gap:8px; margin-bottom:14px}
    .mm-label{font-size:.58rem; font-weight:800; text-transform:uppercase; color:var(--muted)}
    .modal-sinopsis{font-size:.78rem; color:var(--ink2); line-height:1.75; margin-bottom:18px; max-height:150px; overflow-y:auto}
    .modal-btns{display:flex; gap:9px}
    .modal-btn{display:inline-flex; align-items:center; justify-content:center; gap:6px; padding:10px 16px; border-radius:50px; font-size:.79rem; font-weight:700; text-decoration:none; cursor:pointer}
    .mb-outline{border:1.5px solid var(--border); background:var(--card-bg); color:var(--ink2); flex:1}
    .mb-fill{background:var(--grad-btn); color:white; flex:1.6; box-shadow:0 4px 14px rgba(124,58,237,.3)}
    .mb-disabled{background:var(--card-bg); color:var(--muted); border:1.5px solid var(--border); flex:1.6; cursor:not-allowed}
    @media (max-width:768px){.topnav{padding:0 16px} .page{padding:20px 16px} .modal-inner{flex-direction:column; align-items:center}}
  </style>
</head>
<body>

<div class="theme-transition-flash" id="themeFlash" style="position:fixed; inset:0; pointer-events:none; opacity:0; transition:opacity .15s; background:radial-gradient(circle at 50% 5%, white, transparent); z-index:9999"></div>

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
    <button class="theme-toggle" id="themeToggle"><span class="toggle-moon">🌙</span><div class="toggle-thumb"><span id="toggleEmoji">☀️</span></div><span class="toggle-sun">☀️</span></button>
    <a href="{{ route('anggota.profile.show') }}" class="nav-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</a>
    <form method="POST" action="/logout" style="display:inline;">@csrf<button type="submit" class="nav-logout"><i class="fas fa-sign-out-alt"></i></button></form>
  </div>
</nav>

<div class="page">
  @if(session('success'))<div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>@endif
  @if(session('error'))<div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>@endif

  <div class="page-header">
    <div class="ph-deco-circle"></div><div class="ph-books"><div class="ph-spine"></div><div class="ph-spine"></div><div class="ph-spine"></div><div class="ph-spine"></div></div>
    <div class="ph-left"><div class="ph-eyebrow"><div class="ph-eyebrow-dot"></div>Perpustakaan Digital</div><h1 class="ph-title">Koleksi <em>Buku</em></h1><p class="ph-sub">Temukan dan pinjam buku favoritmu dari <strong>{{ $ebooks->total() }} judul</strong> yang tersedia.</p></div>
    <div class="ph-stats"><div class="ph-stat"><div class="ph-stat-num">{{ $ebooks->total() }}</div><div class="ph-stat-label">Total Buku</div></div><div class="ph-stat"><div class="ph-stat-num">{{ $kategoris->count() }}</div><div class="ph-stat-label">Kategori</div></div><div class="ph-stat"><div class="ph-stat-num">{{ $ebooks->where('jumlah_ebook','>',0)->count() }}</div><div class="ph-stat-label">Tersedia</div></div></div>
  </div>

  <div class="filter-bar">
    <span class="filter-bar-label"><i class="fas fa-filter"></i> Kategori</span>
    <div class="cat-chips"><button class="cat-chip active" data-cat="semua">Semua <span class="cat-chip-count">({{ $ebooks->total() }})</span></button>@foreach($kategoris as $kat)<button class="cat-chip" data-cat="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }} <span class="cat-chip-count">({{ $kat->ebooks_count }})</span></button>@endforeach</div>
    <div class="avail-group"><button class="avail-chip active" data-avail="semua">Semua</button><button class="avail-chip" data-avail="tersedia"><span class="avail-dot-chip ok"></span> Tersedia</button><button class="avail-chip" data-avail="habis"><span class="avail-dot-chip none"></span> Habis</button></div>
  </div>

  <div class="toolbar"><span class="result-info" id="resultInfo">Menampilkan <strong>{{ $ebooks->count() }}</strong> dari {{ $ebooks->total() }} buku</span><button class="reset-btn" id="resetBtn"><i class="fas fa-rotate-left"></i> Reset</button><select class="sort-select" id="sortSelect"><option value="default">Terbaru</option><option value="az">Judul A–Z</option><option value="za">Judul Z–A</option><option value="stok">Tersedia Dulu</option></select><div class="view-toggle"><button class="view-btn active" id="btnGrid"><i class="fas fa-th-large"></i></button><button class="view-btn" id="btnList"><i class="fas fa-list"></i></button></div></div>

  <div class="book-grid" id="bookGrid">
    @forelse($ebooks as $book)
      @php 
        $stok = $book->jumlah_ebook ?? 0; 
        $hasImg = !empty($book->cover); 
        $coverUrl = $hasImg ? Storage::disk('supabase')->url($book->cover) : ''; 
        $colors = ['linear-gradient(135deg,#1d4ed8,#7c3aed)','linear-gradient(135deg,#0f766e,#0891b2)','linear-gradient(135deg,#b45309,#d97706)','linear-gradient(135deg,#9333ea,#ec4899)'];
        $color = $colors[$loop->index % count($colors)];
      @endphp
      
      {{-- GRID CARD --}}
      <a href="#" class="book-card grid-item" data-id="{{ $book->id_buku }}" onclick="bukaModal(event,this)">
        <div class="book-cover-wrap">
          @if($hasImg)
            <img src="{{ $coverUrl }}" class="book-cover-img" alt="{{ $book->judul_buku }}" referrerpolicy="no-referrer" loading="lazy">
          @else
            <div class="book-cover-ph" style="background:{{ $color }};"></div>
            <div class="book-cover-title">{{ Str::limit($book->judul_buku, 32) }}</div>
          @endif
          <div class="book-spine"></div>
          <div class="avail-dot {{ $stok > 0 ? 'ok' : 'none' }}"></div>
          @if($stok > 0)
            <a href="{{ route('anggota.buku.show', $book->id_buku) }}" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          @else
            <span class="hover-pinjam habis"><i class="fas fa-times"></i> Habis</span>
          @endif
        </div>
        <div class="book-name">{{ $book->judul_buku }}</div>
        <div class="book-author">{{ $book->pengarang }}</div>
        <div class="book-footer">
          <span class="book-kat">{{ $book->kategori->nama_kategori ?? '-' }}</span>
          <span class="book-stok {{ $stok > 0 ? '' : 'habis' }}">{{ $stok > 0 ? $stok.' tersedia' : 'Habis' }}</span>
        </div