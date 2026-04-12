<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>LibCo — Koleksi Buku</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root,[data-theme="light"]{
      --blue-50:#eff6ff;--blue-100:#dbeafe;--blue-500:#3b82f6;--blue-600:#2563eb;--blue-700:#1d4ed8;
      --purple-50:#faf5ff;--purple-100:#ede9fe;--purple-500:#8b5cf6;--purple-600:#7c3aed;
      --ink:#111827;--ink2:#374151;--muted:#6b7280;--border:#e5e7eb;
      --body-bg:#f0f4ff;--card-bg:#ffffff;--nav-bg:rgba(255,255,255,.93);
      --chip-bg:#ffffff;--search-bg:#ffffff;--sidebar-bg:#ffffff;
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
      --chip-bg:#1e293b;--search-bg:#1e293b;--sidebar-bg:#1e293b;
      --grad-hero:linear-gradient(135deg,#1d4ed8 0%,#6d28d9 60%,#7e22ce 100%);
      --grad-btn:linear-gradient(135deg,#2563eb 0%,#7c3aed 100%);
      --grad-body:linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#150e2b 100%);
      --shadow-sm:0 1px 3px rgba(0,0,0,.3);--shadow-md:0 4px 16px rgba(0,0,0,.3);
      --shadow-lg:0 12px 40px rgba(0,0,0,.4);--shadow-xl:0 24px 60px rgba(0,0,0,.5);
      --modal-bg:#1e293b;--modal-overlay:rgba(0,0,0,.8);
      --blue-50:rgba(59,130,246,.1);--blue-100:rgba(59,130,246,.15);
      --purple-50:rgba(139,92,246,.08);--purple-100:rgba(139,92,246,.15);
    }

    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    html{scroll-behavior:smooth}
    body{
      font-family:'Plus Jakarta Sans',sans-serif;
      background:var(--grad-body);background-attachment:fixed;
      color:var(--ink);min-height:100vh;transition:background .4s,color .4s;
    }
    ::-webkit-scrollbar{width:5px;height:5px}
    ::-webkit-scrollbar-track{background:transparent}
    ::-webkit-scrollbar-thumb{background:var(--border);border-radius:4px}

    /* TOPNAV */
    .topnav{
      position:sticky;top:0;z-index:200;
      background:var(--nav-bg);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);
      border-bottom:1px solid var(--border);height:64px;
      display:flex;align-items:center;padding:0 32px;gap:16px;
      transition:background .4s,border-color .4s;
    }
    .nav-logo{
      font-family:'Fraunces',serif;font-size:1.75rem;font-weight:700;
      background:var(--grad-btn);-webkit-background-clip:text;-webkit-text-fill-color:transparent;
      background-clip:text;text-decoration:none;flex-shrink:0;letter-spacing:-.03em;
    }
    .nav-links{display:flex;gap:2px;flex-shrink:0}
    .nav-link{
      display:flex;align-items:center;gap:6px;padding:7px 14px;border-radius:10px;
      font-size:.82rem;font-weight:600;color:var(--muted);text-decoration:none;
      transition:all .2s;white-space:nowrap;
    }
    .nav-link i{font-size:.75rem}
    .nav-link:hover{background:var(--blue-50);color:var(--blue-600)}
    [data-theme="dark"] .nav-link:hover{background:rgba(59,130,246,.1);color:#93c5fd}
    .nav-link.active{background:var(--grad-btn);color:white;box-shadow:0 4px 12px rgba(124,58,237,.3)}
    .nav-search-wrap{flex:1;max-width:380px;margin:0 auto}
    .nav-search-box{
      display:flex;align-items:center;gap:8px;background:var(--search-bg);
      border:1.5px solid var(--border);border-radius:50px;padding:7px 16px;
      transition:all .22s;box-shadow:var(--shadow-sm);
    }
    .nav-search-box:focus-within{border-color:var(--blue-500);box-shadow:0 0 0 3px rgba(59,130,246,.13)}
    .nav-search-box i{color:var(--muted);font-size:.8rem;flex-shrink:0;transition:color .2s}
    .nav-search-box:focus-within i{color:var(--blue-500)}
    .nav-search-box input{flex:1;border:none;background:transparent;outline:none;font-family:'Plus Jakarta Sans',sans-serif;font-size:.82rem;color:var(--ink)}
    .nav-search-box input::placeholder{color:var(--muted)}
    .nav-right{margin-left:auto;display:flex;align-items:center;gap:10px;flex-shrink:0}
    .theme-toggle{
      width:56px;height:30px;border-radius:50px;background:var(--blue-50);
      border:1.5px solid var(--border);position:relative;cursor:pointer;
      transition:background .35s,border-color .35s;flex-shrink:0;
      display:flex;align-items:center;padding:2px;
    }
    .theme-toggle:hover{border-color:var(--blue-500)}
    .toggle-thumb{
      width:24px;height:24px;border-radius:50%;background:var(--grad-btn);
      box-shadow:0 2px 6px rgba(0,0,0,.2);display:flex;align-items:center;
      justify-content:center;font-size:.75rem;
      transition:transform .38s cubic-bezier(.34,1.3,.64,1);
    }
    [data-theme="dark"] .toggle-thumb{transform:translateX(26px)}
    [data-theme="light"] .toggle-thumb{transform:translateX(0)}
    .toggle-sun,.toggle-moon{position:absolute;font-size:.68rem;transition:opacity .3s}
    .toggle-sun{right:6px}.toggle-moon{left:6px}
    [data-theme="light"] .toggle-sun{opacity:0}[data-theme="light"] .toggle-moon{opacity:.4}
    [data-theme="dark"] .toggle-sun{opacity:.4}[data-theme="dark"] .toggle-moon{opacity:0}
    .nav-avatar{
      width:36px;height:36px;border-radius:50%;background:var(--grad-btn);color:white;
      display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:700;
      cursor:pointer;flex-shrink:0;box-shadow:0 2px 10px rgba(124,58,237,.35);
      overflow:hidden;padding:0;text-decoration:none;
    }
    .nav-logout{
      background:none;border:none;cursor:pointer;font-size:.82rem;color:var(--muted);
      font-family:'Plus Jakarta Sans',sans-serif;font-weight:600;padding:7px 10px;
      border-radius:8px;transition:all .2s;display:flex;align-items:center;gap:4px;
    }
    .nav-logout:hover{background:rgba(239,68,68,.1);color:#ef4444}

    .flash{
      display:flex;align-items:center;gap:10px;padding:11px 16px;border-radius:12px;
      margin-bottom:18px;font-size:.82rem;font-weight:600;animation:fadeUp .4s ease;
    }
    .flash-success{background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.25);color:#15803d}
    .flash-error{background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.25);color:#dc2626}
    [data-theme="dark"] .flash-success{color:#4ade80}[data-theme="dark"] .flash-error{color:#f87171}
    @keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}

    .page{max-width:1320px;margin:0 auto;padding:28px 32px 80px}

    /* PAGE HEADER */
    .page-header{
      background:var(--grad-hero);border-radius:24px;padding:40px 48px;
      margin-bottom:28px;position:relative;overflow:hidden;
      display:flex;align-items:center;justify-content:space-between;gap:28px;
      box-shadow:var(--shadow-xl);
    }
    .page-header::before{
      content:'';position:absolute;inset:0;
      background:
        radial-gradient(ellipse at 80% 40%,rgba(251,191,36,.15) 0%,transparent 55%),
        radial-gradient(ellipse at 5% 80%,rgba(96,165,250,.2) 0%,transparent 45%);
    }
    .ph-deco-circle{position:absolute;right:-80px;top:-80px;width:300px;height:300px;border-radius:50%;background:rgba(255,255,255,.06);pointer-events:none}
    .ph-deco-circle2{position:absolute;right:180px;bottom:-100px;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.04);pointer-events:none}
    .ph-books{position:absolute;right:52px;top:50%;transform:translateY(-50%);display:flex;gap:4px;align-items:flex-end;opacity:.18;pointer-events:none;z-index:0}
    .ph-spine{border-radius:2px 6px 6px 2px}
    .ph-spine:nth-child(1){width:14px;height:72px;background:#60a5fa}
    .ph-spine:nth-child(2){width:11px;height:88px;background:#a78bfa}
    .ph-spine:nth-child(3){width:17px;height:64px;background:#fbbf24}
    .ph-spine:nth-child(4){width:10px;height:78px;background:#34d399}
    .ph-spine:nth-child(5){width:14px;height:58px;background:#fb923c}
    .ph-left{position:relative;z-index:1}
    .ph-eyebrow{
      display:inline-flex;align-items:center;gap:8px;
      background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);
      border-radius:50px;padding:5px 14px;font-size:.62rem;font-weight:700;
      letter-spacing:.18em;text-transform:uppercase;color:rgba(255,255,255,.9);margin-bottom:14px;
    }
    .ph-eyebrow-dot{width:5px;height:5px;border-radius:50%;background:#fbbf24;animation:pulse 2s infinite}
    @keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.7)}}
    .ph-title{font-family:'Fraunces',serif;font-size:clamp(1.8rem,3vw,2.8rem);font-weight:600;color:white;line-height:1.1;margin-bottom:12px}
    .ph-title em{font-style:italic;color:#fde68a}
    .ph-sub{font-size:.83rem;color:rgba(255,255,255,.65);font-weight:400;line-height:1.7;max-width:440px}
    .ph-sub strong{color:white;font-weight:700}
    .ph-stats{position:relative;z-index:1;display:flex;gap:12px;flex-shrink:0}
    .ph-stat{
      background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);
      border-radius:16px;padding:18px 22px;text-align:center;min-width:92px;
      transition:background .2s;backdrop-filter:blur(6px);
    }
    .ph-stat:hover{background:rgba(255,255,255,.18)}
    .ph-stat-num{font-family:'Fraunces',serif;font-size:2rem;font-weight:700;color:white;line-height:1;margin-bottom:5px}
    .ph-stat-label{font-size:.58rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.45)}

    /* LAYOUT */
    .layout{display:grid;grid-template-columns:230px 1fr;gap:22px;align-items:start}

    /* SIDEBAR */
    .sidebar-toggle{
      display:none;width:100%;padding:12px 18px;
      background:var(--sidebar-bg);border:1px solid var(--border);border-radius:14px;
      font-family:'Plus Jakarta Sans',sans-serif;font-size:.83rem;font-weight:700;color:var(--ink);
      cursor:pointer;transition:all .2s;align-items:center;justify-content:space-between;gap:10px;
    }
    .sidebar-toggle:hover{border-color:var(--blue-500)}
    .sidebar-toggle i.chevron{transition:transform .25s}
    .sidebar-toggle.open i.chevron{transform:rotate(180deg)}
    .sidebar-collapsible{display:block}
    .filter-sidebar{
      background:var(--sidebar-bg);border:1px solid var(--border);border-radius:20px;
      overflow:hidden;box-shadow:var(--shadow-sm);transition:background .4s,border-color .4s;
    }
    .fs-header{padding:14px 18px 12px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
    .fs-header-title{font-size:.66rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);display:flex;align-items:center;gap:6px}
    .fs-header-title i{color:var(--blue-500)}
    .fs-reset-sm{font-size:.68rem;font-weight:700;color:var(--muted);background:none;border:none;cursor:pointer;transition:color .18s;display:flex;align-items:center;gap:4px;font-family:'Plus Jakarta Sans',sans-serif}
    .fs-reset-sm:hover{color:#ef4444}
    .fs-body{padding:14px 16px}
    .fs-search{
      display:flex;align-items:center;gap:8px;background:var(--body-bg);
      border:1.5px solid var(--border);border-radius:10px;padding:8px 11px;
      transition:all .2s;margin-bottom:16px;
    }
    .fs-search:focus-within{border-color:var(--blue-500);background:var(--card-bg);box-shadow:0 0 0 3px rgba(59,130,246,.1)}
    .fs-search i{color:var(--muted);font-size:.75rem;flex-shrink:0}
    .fs-search input{border:none;background:transparent;outline:none;font-family:'Plus Jakarta Sans',sans-serif;font-size:.78rem;color:var(--ink);flex:1}
    .fs-search input::placeholder{color:var(--muted)}
    .fs-section{margin-bottom:16px}.fs-section:last-child{margin-bottom:0}
    .fs-divider{height:1px;background:var(--border);margin:14px 0}
    .fs-section-label{font-size:.61rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:8px}
    .cat-list{display:flex;flex-direction:column;gap:2px}
    .cat-item{
      display:flex;align-items:center;justify-content:space-between;
      padding:7px 10px;border-radius:10px;cursor:pointer;font-size:.78rem;font-weight:500;
      color:var(--muted);background:none;border:none;text-align:left;width:100%;
      font-family:'Plus Jakarta Sans',sans-serif;transition:all .15s;
    }
    .cat-item:hover{background:var(--blue-50);color:var(--blue-600)}
    [data-theme="dark"] .cat-item:hover{background:rgba(59,130,246,.1);color:#93c5fd}
    .cat-item.active{background:var(--grad-btn);color:white;font-weight:600}
    .cat-count{font-size:.6rem;font-weight:700;padding:1px 7px;border-radius:50px;flex-shrink:0;background:rgba(0,0,0,.08)}
    .cat-item.active .cat-count{background:rgba(255,255,255,.2)}
    .avail-opts{display:flex;flex-direction:column;gap:4px}
    .avail-opt{
      display:flex;align-items:center;gap:8px;font-size:.78rem;color:var(--muted);
      cursor:pointer;padding:6px 8px;border-radius:8px;transition:background .15s;
      font-family:'Plus Jakarta Sans',sans-serif;
    }
    .avail-opt:hover{background:var(--blue-50);color:var(--ink)}
    [data-theme="dark"] .avail-opt:hover{background:rgba(59,130,246,.08)}
    .avail-opt input[type=radio]{accent-color:var(--blue-600);cursor:pointer}

    /* TOOLBAR */
    .toolbar{display:flex;align-items:center;gap:10px;margin-bottom:14px;flex-wrap:wrap}
    .result-info{flex:1;font-size:.8rem;color:var(--muted);min-width:120px}
    .result-info strong{color:var(--ink);font-weight:700}
    .sort-select{
      background:var(--card-bg);border:1.5px solid var(--border);border-radius:50px;
      padding:7px 30px 7px 14px;font-family:'Plus Jakarta Sans',sans-serif;
      font-size:.77rem;font-weight:600;color:var(--ink);cursor:pointer;outline:none;
      transition:border-color .2s;appearance:none;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat:no-repeat;background-position:right 10px center;
    }
    .sort-select:focus{border-color:var(--blue-500)}
    .view-toggle{display:flex;gap:3px}
    .view-btn{
      width:34px;height:34px;border-radius:9px;border:1.5px solid var(--border);
      background:var(--card-bg);display:flex;align-items:center;justify-content:center;
      font-size:.78rem;color:var(--muted);cursor:pointer;transition:all .18s;
    }
    .view-btn:hover{border-color:var(--blue-500);color:var(--blue-500)}
    .view-btn.active{background:var(--grad-btn);color:white;border-color:transparent;box-shadow:0 3px 10px rgba(124,58,237,.3)}
    .active-filters{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:12px;min-height:0}
    .afc{
      display:inline-flex;align-items:center;gap:5px;padding:3px 12px;border-radius:50px;
      background:var(--blue-50);border:1px solid var(--blue-100);
      font-size:.71rem;font-weight:600;color:var(--blue-600);cursor:pointer;transition:all .18s;
    }
    .afc:hover{background:#ef4444;color:white;border-color:#ef4444}
    .afc i{font-size:.55rem}
    [data-theme="dark"] .afc{color:#93c5fd}

    /* ===== BOOK GRID — PERBAIKAN UTAMA ===== */
    .book-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(155px,1fr));gap:22px}
    .book-grid.list-view{grid-template-columns:1fr;gap:8px}

    .book-card{
      text-decoration:none;color:inherit;display:block;cursor:pointer;
      animation:fadeUp .4s ease both;
    }
    .book-card:nth-child(2n+1){animation-delay:.03s}
    .book-card:nth-child(2n+2){animation-delay:.06s}
    .book-card:nth-child(2n+3){animation-delay:.09s}

    /* COVER WRAP — aspect ratio 2:3, posisi relatif */
    .book-cover-wrap{
      aspect-ratio:2/3;
      width:100%;
      border-radius:4px 12px 12px 4px;
      overflow:hidden;
      position:relative;
      box-shadow:-3px 5px 18px rgba(37,99,235,.15);
      transition:transform .32s cubic-bezier(.34,1.2,.64,1),box-shadow .32s;
      margin-bottom:10px;
    }
    .book-card:hover .book-cover-wrap{
      transform:perspective(600px) rotateY(-8deg) translateY(-7px) scale(1.02);
      box-shadow:6px 16px 32px rgba(37,99,235,.22);
    }

    /* GAMBAR COVER — absolute fill */
    .book-cover-img{
      position:absolute;
      inset:0;
      width:100%;
      height:100%;
      object-fit:cover;
      display:block;
    }

    /* PLACEHOLDER COVER — absolute fill dengan gradien */
    .book-cover-ph{
      position:absolute;
      inset:0;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      padding:12px 10px;
      gap:8px;
    }
    .book-cover-ph-icon{
      font-size:2.2rem;
      opacity:.7;
      filter:drop-shadow(0 2px 6px rgba(0,0,0,.3));
    }
    .book-cover-ph-title{
      font-size:.65rem;
      font-weight:700;
      color:white;
      text-shadow:0 1px 4px rgba(0,0,0,.6);
      line-height:1.3;
      text-align:center;
      display:-webkit-box;
      -webkit-line-clamp:3;
      -webkit-box-orient:vertical;
      overflow:hidden;
    }

    .book-spine{position:absolute;left:0;top:0;bottom:0;width:8px;background:rgba(0,0,0,.2);z-index:2;border-radius:4px 0 0 4px;}
    .avail-dot{position:absolute;top:8px;right:8px;z-index:4;width:9px;height:9px;border-radius:50%;border:2px solid rgba(255,255,255,.8);box-shadow:0 1px 4px rgba(0,0,0,.3)}
    .avail-dot.ok{background:#4ade80}.avail-dot.none{background:#f87171}
    .hover-pinjam{
      position:absolute;bottom:9px;left:50%;transform:translateX(-50%) translateY(8px);
      z-index:5;opacity:0;background:var(--grad-btn);color:white;border:none;
      border-radius:50px;padding:6px 14px;font-family:'Plus Jakarta Sans',sans-serif;
      font-size:.7rem;font-weight:700;cursor:pointer;transition:opacity .22s,transform .22s;
      white-space:nowrap;display:flex;align-items:center;gap:5px;
      text-decoration:none;box-shadow:0 4px 14px rgba(0,0,0,.32);
    }
    .book-card:hover .hover-pinjam{opacity:1;transform:translateX(-50%) translateY(0)}
    .hover-pinjam:hover{filter:brightness(1.1)}
    .hover-pinjam.habis{background:rgba(107,114,128,.75);cursor:default}

    .book-name{font-size:.84rem;font-weight:700;color:var(--ink);line-height:1.35;margin-bottom:2px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .book-author{font-size:.7rem;color:var(--muted);margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .book-footer{display:flex;align-items:center;gap:6px;flex-wrap:wrap}
    .book-kat{font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--purple-600);background:var(--purple-100);padding:2px 7px;border-radius:4px}
    [data-theme="dark"] .book-kat{color:#c4b5fd}
    .book-stok{font-size:.62rem;font-weight:600;color:#16a34a;display:flex;align-items:center;gap:3px}
    .book-stok.habis{color:#dc2626}
    .book-stok::before{content:'';width:5px;height:5px;border-radius:50%;background:currentColor;flex-shrink:0}
    [data-theme="dark"] .book-stok{color:#4ade80}[data-theme="dark"] .book-stok.habis{color:#f87171}

    /* LIST CARD */
    .list-card{
      background:var(--card-bg);border:1px solid var(--border);border-radius:16px;
      padding:14px 16px;display:flex;gap:14px;align-items:center;
      text-decoration:none;color:inherit;cursor:pointer;transition:all .2s;box-shadow:var(--shadow-sm);
    }
    .list-card:hover{box-shadow:var(--shadow-md);transform:translateX(4px);border-color:var(--blue-500)}
    .lc-cover{
      width:50px;height:74px;flex-shrink:0;
      border-radius:3px 8px 8px 3px;overflow:hidden;
      position:relative;box-shadow:-2px 3px 10px rgba(37,99,235,.15);
    }
    /* PERBAIKAN: gambar list cover juga absolute fill */
    .lc-cover img{
      position:absolute;inset:0;width:100%;height:100%;
      object-fit:cover;display:block;
    }
    .lc-cover-ph{
      position:absolute;inset:0;
      display:flex;align-items:center;justify-content:center;font-size:1.4rem;
    }
    .lc-spine{position:absolute;left:0;top:0;bottom:0;width:6px;background:rgba(0,0,0,.2);z-index:1}
    .lc-info{flex:1;min-width:0}
    .lc-title{font-size:.88rem;font-weight:700;color:var(--ink);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:2px}
    .lc-author{font-size:.71rem;color:var(--muted);margin-bottom:6px}
    .lc-tags{display:flex;gap:6px;align-items:center;flex-wrap:wrap}
    .lc-kat{font-size:.6rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;color:var(--purple-600);background:var(--purple-100);padding:2px 7px;border-radius:4px}
    [data-theme="dark"] .lc-kat{color:#c4b5fd}
    .lc-tahun{font-size:.68rem;color:var(--muted)}
    .lc-desc{font-size:.74rem;color:var(--muted);line-height:1.55;margin-top:5px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .lc-actions{display:flex;gap:7px;align-items:center;flex-shrink:0}
    .lc-stok{font-size:.7rem;font-weight:600;white-space:nowrap}
    .lc-stok.ok{color:#16a34a}.lc-stok.none{color:#dc2626}
    [data-theme="dark"] .lc-stok.ok{color:#4ade80}[data-theme="dark"] .lc-stok.none{color:#f87171}
    .lc-btn{
      display:inline-flex;align-items:center;gap:5px;padding:7px 14px;border-radius:50px;
      font-size:.73rem;font-weight:700;border:none;cursor:pointer;transition:all .18s;
      text-decoration:none;white-space:nowrap;font-family:'Plus Jakarta Sans',sans-serif;
    }
    .lc-btn-ghost{background:var(--card-bg);color:var(--ink2);border:1.5px solid var(--border)}
    .lc-btn-ghost:hover{background:var(--ink);color:white;border-color:var(--ink)}
    .lc-btn-pinjam{background:var(--grad-btn);color:white;box-shadow:0 3px 10px rgba(124,58,237,.3)}
    .lc-btn-pinjam:hover{filter:brightness(1.1);transform:translateY(-1px)}
    .lc-btn-disabled{background:var(--card-bg);color:var(--muted);border:1.5px solid var(--border);cursor:not-allowed}

    /* EMPTY */
    .empty-wrap{grid-column:1/-1;display:none;text-align:center;padding:64px 20px}
    .empty-wrap.show{display:block}
    .empty-wrap .es-ico{font-size:3.8rem;margin-bottom:12px;opacity:.28}
    .empty-wrap .es-ttl{font-size:.98rem;font-weight:700;color:var(--ink);margin-bottom:5px}
    .empty-wrap .es-sub{font-size:.8rem;color:var(--muted);line-height:1.6}
    .pagination-wrap{margin-top:28px;display:flex;justify-content:center}

    /* MODAL */
    .modal-overlay{
      display:none;position:fixed;inset:0;z-index:500;background:var(--modal-overlay);
      backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px);
      align-items:center;justify-content:center;padding:16px;
    }
    .modal-overlay.show{display:flex}
    .modal-box{
      background:var(--modal-bg);border-radius:24px;max-width:580px;width:100%;
      box-shadow:var(--shadow-xl);overflow:hidden;position:relative;
      animation:popIn .28s cubic-bezier(.34,1.4,.64,1);transition:background .4s;
      max-height:90vh;overflow-y:auto;
    }
    @keyframes popIn{from{opacity:0;transform:scale(.9)}to{opacity:1;transform:scale(1)}}
    .modal-strip{height:4px;background:var(--grad-btn);position:sticky;top:0;z-index:10}
    .modal-close-wrap{display:flex;justify-content:flex-end;padding:10px 14px 0;position:sticky;top:4px;z-index:9}
    .modal-close{
      width:30px;height:30px;border-radius:50%;background:var(--border);border:none;
      cursor:pointer;display:flex;align-items:center;justify-content:center;
      font-size:.75rem;color:var(--muted);transition:all .18s;
    }
    .modal-close:hover{background:#ef4444;color:white}
    .modal-inner{display:flex;gap:24px;padding:4px 26px 26px}
    .modal-cover-col{flex-shrink:0;padding-top:4px}
    .modal-cover{
      width:128px;height:188px;border-radius:4px 12px 12px 4px;overflow:hidden;
      position:relative;box-shadow:-5px 8px 26px rgba(37,99,235,.2);
    }
    /* PERBAIKAN: modal cover image juga absolute */
    .modal-cover img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block}
    .modal-cover-ph{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;font-size:2.8rem}
    .modal-cover-spine{position:absolute;left:0;top:0;bottom:0;width:10px;background:rgba(0,0,0,.2);z-index:2}
    .modal-avail{margin-top:9px;text-align:center;font-size:.7rem;font-weight:600;display:flex;align-items:center;justify-content:center;gap:5px}
    .modal-avail.ok{color:#16a34a}.modal-avail.none{color:#dc2626}
    .modal-avail::before{content:'';width:6px;height:6px;border-radius:50%;background:currentColor}
    [data-theme="dark"] .modal-avail.ok{color:#4ade80}[data-theme="dark"] .modal-avail.none{color:#f87171}
    .modal-info{flex:1;min-width:0;display:flex;flex-direction:column}
    .modal-kat{display:inline-block;width:fit-content;margin-bottom:9px;font-size:.6rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--purple-600);background:var(--purple-100);padding:3px 10px;border-radius:4px}
    [data-theme="dark"] .modal-kat{color:#c4b5fd}
    .modal-title{font-size:1.15rem;font-weight:800;color:var(--ink);line-height:1.25;margin-bottom:3px}
    .modal-author{font-size:.78rem;color:var(--muted);margin-bottom:14px}
    .modal-author span{color:var(--blue-600);font-weight:600}
    .modal-metas{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:14px}
    .mm-label{font-size:.58rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:2px}
    .mm-val{font-size:.78rem;font-weight:600;color:var(--ink2)}
    .modal-divider{height:1px;background:var(--border);margin-bottom:11px}
    .modal-sinopsis-label{font-size:.58rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:5px}
    .modal-sinopsis{font-size:.78rem;color:var(--ink2);line-height:1.75;flex:1;margin-bottom:18px;font-weight:400;display:-webkit-box;-webkit-line-clamp:5;-webkit-box-orient:vertical;overflow:hidden}
    .modal-btns{display:flex;gap:9px;margin-top:auto}
    .modal-btn{
      display:inline-flex;align-items:center;justify-content:center;gap:6px;
      padding:10px 16px;border-radius:50px;font-size:.79rem;font-weight:700;
      text-decoration:none;cursor:pointer;transition:all .18s;white-space:nowrap;
      font-family:'Plus Jakarta Sans',sans-serif;
    }
    .mb-outline{border:1.5px solid var(--border);background:var(--card-bg);color:var(--ink2);flex:1}
    .mb-outline:hover{border-color:var(--blue-500);color:var(--blue-600)}
    .mb-fill{background:var(--grad-btn);color:white;border:none;flex:1.6;box-shadow:0 4px 14px rgba(124,58,237,.3)}
    .mb-fill:hover{filter:brightness(1.1);transform:translateY(-1px)}
    .mb-disabled{background:var(--card-bg);color:var(--muted);border:1.5px solid var(--border);flex:1.6;cursor:not-allowed}

    .theme-transition-flash{
      position:fixed;inset:0;z-index:9999;pointer-events:none;opacity:0;
      background:radial-gradient(circle at 50% 5%,white 0%,transparent 70%);transition:opacity .15s ease;
    }
    [data-theme="dark"] .theme-transition-flash{background:radial-gradient(circle at 50% 5%,#0f172a 0%,transparent 70%)}
    .theme-transition-flash.active{opacity:.45}

    /* RESPONSIVE */
    @media(max-width:1024px){.layout{grid-template-columns:210px 1fr}}
    @media(max-width:900px){
      .layout{grid-template-columns:1fr}
      .filter-sidebar{position:static}
      .sidebar-toggle{display:flex}
      .sidebar-collapsible{display:none}
      .sidebar-collapsible.open{display:block}
      .ph-stats{display:none}
      .ph-books{display:none}
    }
    @media(max-width:768px){
      .topnav{padding:0 16px;height:58px}
      .nav-links{display:none}
      .nav-search-wrap{max-width:100%}
      .page{padding:20px 16px 60px}
      .page-header{padding:28px 24px}
      .ph-title{font-size:1.9rem}
      .toolbar{gap:8px}
      .lc-actions{flex-direction:column;align-items:flex-end;gap:5px}
    }
    @media(max-width:640px){
      .topnav{padding:0 12px;height:56px;gap:8px}
      .nav-logo{font-size:1.5rem}
      .page{padding:14px 12px 60px}
      .page-header{padding:22px 18px;border-radius:18px}
      .ph-title{font-size:1.6rem}
      .ph-sub{font-size:.78rem}
      .book-grid{grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:14px}
      .book-name{font-size:.78rem}
      .book-author{font-size:.67rem}
      .book-kat{font-size:.56rem}
      .modal-inner{flex-direction:column;align-items:center;gap:14px;padding:0 18px 22px}
      .modal-cover-col{width:100%;display:flex;flex-direction:column;align-items:center}
      .modal-cover{width:100px;height:148px}
      .lc-desc{display:none}
      .lc-stok{display:none}
    }
    @media(max-width:400px){
      .book-grid{grid-template-columns:repeat(2,1fr);gap:10px}
      .ph-title{font-size:1.4rem}
      .nav-logo{font-size:1.35rem}
    }
  </style>
</head>
<body>

<div class="theme-transition-flash" id="themeFlash"></div>

<!-- TOPNAV -->
<nav class="topnav">
  <a href="#" class="nav-logo">LibCo</a>
  <div class="nav-links">
    <a href="#" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
    <a href="#" class="nav-link active"><i class="fas fa-book-open"></i> Koleksi</a>
    <a href="#" class="nav-link"><i class="fas fa-history"></i> Riwayat</a>
    <a href="#" class="nav-link"><i class="fas fa-user"></i> Profil</a>
  </div>
  <div class="nav-search-wrap">
    <div class="nav-search-box">
      <i class="fas fa-search"></i>
      <input type="text" id="navSearch" placeholder="Cari judul atau penulis…" autocomplete="off">
    </div>
  </div>
  <div class="nav-right">
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
      <span class="toggle-moon">🌙</span>
      <div class="toggle-thumb"><span id="toggleEmoji">☀️</span></div>
      <span class="toggle-sun">☀️</span>
    </button>
    <a href="#" class="nav-avatar" title="User">A</a>
    <form method="POST" action="#" style="display:inline;">
      <button type="button" class="nav-logout"><i class="fas fa-sign-out-alt"></i></button>
    </form>
  </div>
</nav>

<div class="page">

  <!-- PAGE HEADER -->
  <div class="page-header">
    <div class="ph-deco-circle"></div><div class="ph-deco-circle2"></div>
    <div class="ph-books">
      <div class="ph-spine"></div><div class="ph-spine"></div>
      <div class="ph-spine"></div><div class="ph-spine"></div><div class="ph-spine"></div>
    </div>
    <div class="ph-left">
      <div class="ph-eyebrow"><div class="ph-eyebrow-dot"></div>Perpustakaan Digital</div>
      <h1 class="ph-title">Koleksi <em>Buku</em></h1>
      <p class="ph-sub">Temukan dan pinjam buku favoritmu dari <strong id="totalBuku">8 judul</strong> yang tersedia dalam koleksi kami.</p>
    </div>
    <div class="ph-stats">
      <div class="ph-stat"><div class="ph-stat-num" id="statTotal">8</div><div class="ph-stat-label">Total Buku</div></div>
      <div class="ph-stat"><div class="ph-stat-num">4</div><div class="ph-stat-label">Kategori</div></div>
      <div class="ph-stat"><div class="ph-stat-num">6</div><div class="ph-stat-label">Tersedia</div></div>
    </div>
  </div>

  <!-- LAYOUT -->
  <div class="layout">

    <!-- SIDEBAR -->
    <aside>
      <button class="sidebar-toggle" id="sidebarToggle">
        <span style="display:flex;align-items:center;gap:8px;"><i class="fas fa-sliders-h" style="color:var(--blue-500);"></i><span>Filter &amp; Cari</span></span>
        <i class="fas fa-chevron-down chevron"></i>
      </button>
      <div class="filter-sidebar">
        <div class="sidebar-collapsible" id="sidebarCollapsible">
          <div class="fs-header">
            <span class="fs-header-title"><i class="fas fa-sliders-h"></i> Filter</span>
            <button class="fs-reset-sm" id="resetBtn"><i class="fas fa-rotate-left"></i> Reset</button>
          </div>
          <div class="fs-body">
            <div class="fs-search">
              <i class="fas fa-search"></i>
              <input type="text" id="sidebarSearch" placeholder="Judul atau penulis…">
            </div>
            <div class="fs-section">
              <div class="fs-section-label">Kategori</div>
              <div class="cat-list">
                <button class="cat-item active" data-cat="semua">
                  Semua <span class="cat-count" id="countSemua">8</span>
                </button>
                <button class="cat-item" data-cat="1">
                  Fiksi <span class="cat-count">3</span>
                </button>
                <button class="cat-item" data-cat="2">
                  Non-Fiksi <span class="cat-count">2</span>
                </button>
                <button class="cat-item" data-cat="3">
                  Sains &amp; Teknologi <span class="cat-count">2</span>
                </button>
                <button class="cat-item" data-cat="4">
                  Sejarah <span class="cat-count">1</span>
                </button>
              </div>
            </div>
            <div class="fs-divider"></div>
            <div class="fs-section">
              <div class="fs-section-label">Ketersediaan</div>
              <div class="avail-opts">
                <label class="avail-opt"><input type="radio" name="avail" value="semua" checked> Semua buku</label>
                <label class="avail-opt"><input type="radio" name="avail" value="tersedia"> Tersedia saja</label>
                <label class="avail-opt"><input type="radio" name="avail" value="habis"> Stok habis</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <div class="main-content">
      <div class="toolbar">
        <span class="result-info" id="resultInfo">Menampilkan <strong>8</strong> dari 8 buku</span>
        <select class="sort-select" id="sortSelect">
          <option value="default">Terbaru</option>
          <option value="az">Judul A–Z</option>
          <option value="za">Judul Z–A</option>
          <option value="stok">Tersedia Dulu</option>
        </select>
        <div class="view-toggle">
          <button class="view-btn active" id="btnGrid" title="Grid"><i class="fas fa-th-large"></i></button>
          <button class="view-btn" id="btnList" title="List"><i class="fas fa-list"></i></button>
        </div>
      </div>

      <div class="active-filters" id="activeFilters"></div>

      <div class="book-grid" id="bookGrid">

        <!-- SAMPLE BOOKS: cat 1=Fiksi, 2=Non-Fiksi, 3=Sains, 4=Sejarah -->

        <!-- Buku 1 - Fiksi, stok ada, pakai placeholder -->
        <a href="#" class="book-card grid-item"
          data-cat="1" data-stok="3"
          data-judul="laskar pelangi" data-penulis="andrea hirata"
          data-full-judul="Laskar Pelangi" data-full-penulis="Andrea Hirata"
          data-kategori="Fiksi"
          data-sinopsis="Novel fenomenal tentang sepuluh anak kampung Belitung yang berjuang menggapai mimpi meski hidup dalam keterbatasan. Kisah persahabatan, semangat, dan tekad yang menginspirasi jutaan pembaca."
          data-cover="" data-color="linear-gradient(135deg,#1d4ed8,#7c3aed)"
          data-tahun="2005" data-isbn="978-979-19-8468-1"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <div class="book-cover-ph" style="background:linear-gradient(135deg,#1d4ed8,#7c3aed);">
              <div class="book-cover-ph-icon">📖</div>
              <div class="book-cover-ph-title">Laskar Pelangi</div>
            </div>
            <div class="book-spine"></div>
            <div class="avail-dot ok"></div>
            <a href="#" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
          <div class="book-name">Laskar Pelangi</div>
          <div class="book-author">Andrea Hirata</div>
          <div class="book-footer">
            <span class="book-kat">Fiksi</span>
            <span class="book-stok">3 tersedia</span>
          </div>
        </a>

        <!-- List version buku 1 -->
        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="1" data-stok="3"
          data-judul="laskar pelangi" data-penulis="andrea hirata"
          data-full-judul="Laskar Pelangi" data-full-penulis="Andrea Hirata"
          data-kategori="Fiksi"
          data-sinopsis="Novel fenomenal tentang sepuluh anak kampung Belitung yang berjuang menggapai mimpi."
          data-cover="" data-color="linear-gradient(135deg,#1d4ed8,#7c3aed)"
          data-tahun="2005" data-isbn="978-979-19-8468-1"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#1d4ed8,#7c3aed)">
            <div class="lc-cover-ph">📖</div>
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Laskar Pelangi</div>
            <div class="lc-author">Andrea Hirata</div>
            <div class="lc-tags"><span class="lc-kat">Fiksi</span><span class="lc-tahun">2005</span></div>
            <div class="lc-desc">Novel fenomenal tentang sepuluh anak kampung Belitung yang berjuang menggapai mimpi.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok ok">3 eks.</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <a href="#" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
        </a>

        <!-- Buku 2 - Fiksi, stok ada, simulasi punya gambar via picsum -->
        <a href="#" class="book-card grid-item"
          data-cat="1" data-stok="2"
          data-judul="bumi manusia" data-penulis="pramoedya ananta toer"
          data-full-judul="Bumi Manusia" data-full-penulis="Pramoedya Ananta Toer"
          data-kategori="Fiksi"
          data-sinopsis="Kisah Minke, seorang pribumi berpendidikan Belanda yang jatuh cinta pada Annelies. Novel monumental yang menggambarkan kondisi kolonialisme Belanda di Hindia Belanda awal abad ke-20."
          data-cover="https://picsum.photos/seed/bumi/300/450"
          data-color="linear-gradient(135deg,#0f766e,#0891b2)"
          data-tahun="1980" data-isbn="978-979-922-940-8"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <img src="https://picsum.photos/seed/bumi/300/450" class="book-cover-img" alt="Bumi Manusia">
            <div class="book-spine"></div>
            <div class="avail-dot ok"></div>
            <a href="#" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
          <div class="book-name">Bumi Manusia</div>
          <div class="book-author">Pramoedya Ananta Toer</div>
          <div class="book-footer">
            <span class="book-kat">Fiksi</span>
            <span class="book-stok">2 tersedia</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="1" data-stok="2"
          data-judul="bumi manusia" data-penulis="pramoedya ananta toer"
          data-full-judul="Bumi Manusia" data-full-penulis="Pramoedya Ananta Toer"
          data-kategori="Fiksi"
          data-sinopsis="Kisah Minke, seorang pribumi berpendidikan Belanda yang jatuh cinta pada Annelies."
          data-cover="https://picsum.photos/seed/bumi/300/450"
          data-color="linear-gradient(135deg,#0f766e,#0891b2)"
          data-tahun="1980" data-isbn="978-979-922-940-8"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#0f766e,#0891b2)">
            <img src="https://picsum.photos/seed/bumi/300/450" alt="Bumi Manusia">
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Bumi Manusia</div>
            <div class="lc-author">Pramoedya Ananta Toer</div>
            <div class="lc-tags"><span class="lc-kat">Fiksi</span><span class="lc-tahun">1980</span></div>
            <div class="lc-desc">Kisah Minke, seorang pribumi berpendidikan Belanda yang jatuh cinta pada Annelies.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok ok">2 eks.</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <a href="#" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
        </a>

        <!-- Buku 3 - Fiksi, STOK HABIS -->
        <a href="#" class="book-card grid-item"
          data-cat="1" data-stok="0"
          data-judul="negeri 5 menara" data-penulis="ahmad fuadi"
          data-full-judul="Negeri 5 Menara" data-full-penulis="Ahmad Fuadi"
          data-kategori="Fiksi"
          data-sinopsis="Kisah Alif Fikri yang meninggalkan kampung halaman untuk menuntut ilmu di pesantren Madani. Di sana, ia bertemu sahabat-sahabat yang bermimpi melihat menara-menara dunia."
          data-cover="" data-color="linear-gradient(135deg,#9333ea,#ec4899)"
          data-tahun="2009" data-isbn="978-602-03-1375-4"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <div class="book-cover-ph" style="background:linear-gradient(135deg,#9333ea,#ec4899);">
              <div class="book-cover-ph-icon">🌙</div>
              <div class="book-cover-ph-title">Negeri 5 Menara</div>
            </div>
            <div class="book-spine"></div>
            <div class="avail-dot none"></div>
            <span class="hover-pinjam habis" style="pointer-events:none;"><i class="fas fa-times"></i> Habis</span>
          </div>
          <div class="book-name">Negeri 5 Menara</div>
          <div class="book-author">Ahmad Fuadi</div>
          <div class="book-footer">
            <span class="book-kat">Fiksi</span>
            <span class="book-stok habis">Habis</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="1" data-stok="0"
          data-judul="negeri 5 menara" data-penulis="ahmad fuadi"
          data-full-judul="Negeri 5 Menara" data-full-penulis="Ahmad Fuadi"
          data-kategori="Fiksi"
          data-sinopsis="Kisah Alif Fikri yang meninggalkan kampung halaman untuk menuntut ilmu di pesantren Madani."
          data-cover="" data-color="linear-gradient(135deg,#9333ea,#ec4899)"
          data-tahun="2009" data-isbn="978-602-03-1375-4"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#9333ea,#ec4899)">
            <div class="lc-cover-ph">🌙</div>
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Negeri 5 Menara</div>
            <div class="lc-author">Ahmad Fuadi</div>
            <div class="lc-tags"><span class="lc-kat">Fiksi</span><span class="lc-tahun">2009</span></div>
            <div class="lc-desc">Kisah Alif Fikri yang meninggalkan kampung halaman untuk menuntut ilmu di pesantren Madani.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok none">Habis</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <span class="lc-btn lc-btn-disabled"><i class="fas fa-times"></i> Habis</span>
          </div>
        </a>

        <!-- Buku 4 - Non-Fiksi -->
        <a href="#" class="book-card grid-item"
          data-cat="2" data-stok="5"
          data-judul="atomic habits" data-penulis="james clear"
          data-full-judul="Atomic Habits" data-full-penulis="James Clear"
          data-kategori="Non-Fiksi"
          data-sinopsis="Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk. James Clear menjelaskan bagaimana perubahan kecil dapat menghasilkan hasil yang luar biasa."
          data-cover="https://picsum.photos/seed/habit/300/450"
          data-color="linear-gradient(135deg,#b45309,#d97706)"
          data-tahun="2018" data-isbn="978-0-7352-1120-7"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <img src="https://picsum.photos/seed/habit/300/450" class="book-cover-img" alt="Atomic Habits">
            <div class="book-spine"></div>
            <div class="avail-dot ok"></div>
            <a href="#" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
          <div class="book-name">Atomic Habits</div>
          <div class="book-author">James Clear</div>
          <div class="book-footer">
            <span class="book-kat">Non-Fiksi</span>
            <span class="book-stok">5 tersedia</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="2" data-stok="5"
          data-judul="atomic habits" data-penulis="james clear"
          data-full-judul="Atomic Habits" data-full-penulis="James Clear"
          data-kategori="Non-Fiksi"
          data-sinopsis="Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk."
          data-cover="https://picsum.photos/seed/habit/300/450"
          data-color="linear-gradient(135deg,#b45309,#d97706)"
          data-tahun="2018" data-isbn="978-0-7352-1120-7"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#b45309,#d97706)">
            <img src="https://picsum.photos/seed/habit/300/450" alt="Atomic Habits">
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Atomic Habits</div>
            <div class="lc-author">James Clear</div>
            <div class="lc-tags"><span class="lc-kat">Non-Fiksi</span><span class="lc-tahun">2018</span></div>
            <div class="lc-desc">Panduan praktis untuk membangun kebiasaan baik dan menghilangkan kebiasaan buruk.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok ok">5 eks.</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <a href="#" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
        </a>

        <!-- Buku 5 - Non-Fiksi, stok habis -->
        <a href="#" class="book-card grid-item"
          data-cat="2" data-stok="0"
          data-judul="sapiens" data-penulis="yuval noah harari"
          data-full-judul="Sapiens" data-full-penulis="Yuval Noah Harari"
          data-kategori="Non-Fiksi"
          data-sinopsis="Sejarah singkat umat manusia dari zaman batu hingga era modern. Harari mengajak pembaca merenung tentang bagaimana manusia menjadi penguasa bumi."
          data-cover="" data-color="linear-gradient(135deg,#047857,#059669)"
          data-tahun="2011" data-isbn="978-0-06-231609-7"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <div class="book-cover-ph" style="background:linear-gradient(135deg,#047857,#059669);">
              <div class="book-cover-ph-icon">🌍</div>
              <div class="book-cover-ph-title">Sapiens</div>
            </div>
            <div class="book-spine"></div>
            <div class="avail-dot none"></div>
            <span class="hover-pinjam habis" style="pointer-events:none;"><i class="fas fa-times"></i> Habis</span>
          </div>
          <div class="book-name">Sapiens</div>
          <div class="book-author">Yuval Noah Harari</div>
          <div class="book-footer">
            <span class="book-kat">Non-Fiksi</span>
            <span class="book-stok habis">Habis</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="2" data-stok="0"
          data-judul="sapiens" data-penulis="yuval noah harari"
          data-full-judul="Sapiens" data-full-penulis="Yuval Noah Harari"
          data-kategori="Non-Fiksi"
          data-sinopsis="Sejarah singkat umat manusia dari zaman batu hingga era modern."
          data-cover="" data-color="linear-gradient(135deg,#047857,#059669)"
          data-tahun="2011" data-isbn="978-0-06-231609-7"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#047857,#059669)">
            <div class="lc-cover-ph">🌍</div>
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Sapiens</div>
            <div class="lc-author">Yuval Noah Harari</div>
            <div class="lc-tags"><span class="lc-kat">Non-Fiksi</span><span class="lc-tahun">2011</span></div>
            <div class="lc-desc">Sejarah singkat umat manusia dari zaman batu hingga era modern.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok none">Habis</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <span class="lc-btn lc-btn-disabled"><i class="fas fa-times"></i> Habis</span>
          </div>
        </a>

        <!-- Buku 6 - Sains & Teknologi -->
        <a href="#" class="book-card grid-item"
          data-cat="3" data-stok="4"
          data-judul="a brief history of time" data-penulis="stephen hawking"
          data-full-judul="A Brief History of Time" data-full-penulis="Stephen Hawking"
          data-kategori="Sains & Teknologi"
          data-sinopsis="Eksplorasi alam semesta dari Big Bang hingga lubang hitam. Hawking menjelaskan konsep fisika paling kompleks dengan cara yang dapat dipahami semua orang."
          data-cover="https://picsum.photos/seed/time/300/450"
          data-color="linear-gradient(135deg,#1e40af,#0369a1)"
          data-tahun="1988" data-isbn="978-0-553-38016-3"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <img src="https://picsum.photos/seed/time/300/450" class="book-cover-img" alt="A Brief History of Time">
            <div class="book-spine"></div>
            <div class="avail-dot ok"></div>
            <a href="#" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
          <div class="book-name">A Brief History of Time</div>
          <div class="book-author">Stephen Hawking</div>
          <div class="book-footer">
            <span class="book-kat">Sains &amp; Teknologi</span>
            <span class="book-stok">4 tersedia</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="3" data-stok="4"
          data-judul="a brief history of time" data-penulis="stephen hawking"
          data-full-judul="A Brief History of Time" data-full-penulis="Stephen Hawking"
          data-kategori="Sains & Teknologi"
          data-sinopsis="Eksplorasi alam semesta dari Big Bang hingga lubang hitam."
          data-cover="https://picsum.photos/seed/time/300/450"
          data-color="linear-gradient(135deg,#1e40af,#0369a1)"
          data-tahun="1988" data-isbn="978-0-553-38016-3"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#1e40af,#0369a1)">
            <img src="https://picsum.photos/seed/time/300/450" alt="A Brief History of Time">
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">A Brief History of Time</div>
            <div class="lc-author">Stephen Hawking</div>
            <div class="lc-tags"><span class="lc-kat">Sains &amp; Teknologi</span><span class="lc-tahun">1988</span></div>
            <div class="lc-desc">Eksplorasi alam semesta dari Big Bang hingga lubang hitam.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok ok">4 eks.</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <a href="#" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
        </a>

        <!-- Buku 7 - Sains & Teknologi -->
        <a href="#" class="book-card grid-item"
          data-cat="3" data-stok="2"
          data-judul="clean code" data-penulis="robert c. martin"
          data-full-judul="Clean Code" data-full-penulis="Robert C. Martin"
          data-kategori="Sains & Teknologi"
          data-sinopsis="Panduan menulis kode yang bersih, mudah dipahami, dan maintainable. Wajib dibaca bagi setiap programmer yang ingin menulis kode berkualitas tinggi."
          data-cover="" data-color="linear-gradient(135deg,#dc2626,#ea580c)"
          data-tahun="2008" data-isbn="978-0-13-235088-4"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <div class="book-cover-ph" style="background:linear-gradient(135deg,#dc2626,#ea580c);">
              <div class="book-cover-ph-icon">💻</div>
              <div class="book-cover-ph-title">Clean Code</div>
            </div>
            <div class="book-spine"></div>
            <div class="avail-dot ok"></div>
            <a href="#" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
          <div class="book-name">Clean Code</div>
          <div class="book-author">Robert C. Martin</div>
          <div class="book-footer">
            <span class="book-kat">Sains &amp; Teknologi</span>
            <span class="book-stok">2 tersedia</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="3" data-stok="2"
          data-judul="clean code" data-penulis="robert c. martin"
          data-full-judul="Clean Code" data-full-penulis="Robert C. Martin"
          data-kategori="Sains & Teknologi"
          data-sinopsis="Panduan menulis kode yang bersih, mudah dipahami, dan maintainable."
          data-cover="" data-color="linear-gradient(135deg,#dc2626,#ea580c)"
          data-tahun="2008" data-isbn="978-0-13-235088-4"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#dc2626,#ea580c)">
            <div class="lc-cover-ph">💻</div>
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Clean Code</div>
            <div class="lc-author">Robert C. Martin</div>
            <div class="lc-tags"><span class="lc-kat">Sains &amp; Teknologi</span><span class="lc-tahun">2008</span></div>
            <div class="lc-desc">Panduan menulis kode yang bersih, mudah dipahami, dan maintainable.</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok ok">2 eks.</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <a href="#" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
        </a>

        <!-- Buku 8 - Sejarah -->
        <a href="#" class="book-card grid-item"
          data-cat="4" data-stok="1"
          data-judul="guns germs and steel" data-penulis="jared diamond"
          data-full-judul="Guns, Germs, and Steel" data-full-penulis="Jared Diamond"
          data-kategori="Sejarah"
          data-sinopsis="Mengapa peradaban di berbagai belahan dunia berkembang dengan cara yang berbeda? Diamond menjawab dengan menelusuri pengaruh geografis, ekologis, dan biologis terhadap sejarah manusia."
          data-cover="https://picsum.photos/seed/guns/300/450"
          data-color="linear-gradient(135deg,#7e22ce,#a21caf)"
          data-tahun="1997" data-isbn="978-0-393-31755-8"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="book-cover-wrap">
            <img src="https://picsum.photos/seed/guns/300/450" class="book-cover-img" alt="Guns, Germs, and Steel">
            <div class="book-spine"></div>
            <div class="avail-dot ok"></div>
            <a href="#" class="hover-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
          <div class="book-name">Guns, Germs, and Steel</div>
          <div class="book-author">Jared Diamond</div>
          <div class="book-footer">
            <span class="book-kat">Sejarah</span>
            <span class="book-stok">1 tersedia</span>
          </div>
        </a>

        <a href="#" class="list-card list-item" style="display:none;"
          data-cat="4" data-stok="1"
          data-judul="guns germs and steel" data-penulis="jared diamond"
          data-full-judul="Guns, Germs, and Steel" data-full-penulis="Jared Diamond"
          data-kategori="Sejarah"
          data-sinopsis="Mengapa peradaban di berbagai belahan dunia berkembang dengan cara yang berbeda?"
          data-cover="https://picsum.photos/seed/guns/300/450"
          data-color="linear-gradient(135deg,#7e22ce,#a21caf)"
          data-tahun="1997" data-isbn="978-0-393-31755-8"
          data-detail-url="#"
          onclick="bukaModal(event,this)">
          <div class="lc-cover" style="background:linear-gradient(135deg,#7e22ce,#a21caf)">
            <img src="https://picsum.photos/seed/guns/300/450" alt="Guns, Germs, and Steel">
            <div class="lc-spine"></div>
          </div>
          <div class="lc-info">
            <div class="lc-title">Guns, Germs, and Steel</div>
            <div class="lc-author">Jared Diamond</div>
            <div class="lc-tags"><span class="lc-kat">Sejarah</span><span class="lc-tahun">1997</span></div>
            <div class="lc-desc">Mengapa peradaban di berbagai belahan dunia berkembang dengan cara yang berbeda?</div>
          </div>
          <div class="lc-actions">
            <span class="lc-stok ok">1 eks.</span>
            <a href="#" class="lc-btn lc-btn-ghost" onclick="event.stopPropagation()"><i class="fas fa-eye"></i></a>
            <a href="#" class="lc-btn lc-btn-pinjam" onclick="event.stopPropagation()"><i class="fas fa-book-open"></i> Pinjam</a>
          </div>
        </a>

        <!-- Empty State -->
        <div class="empty-wrap" id="emptyState">
          <div class="es-ico">🔍</div>
          <div class="es-ttl">Tidak ditemukan</div>
          <div class="es-sub" id="emptyText">Coba kata kunci atau filter lain.</div>
        </div>

      </div><!-- /bookGrid -->
    </div><!-- /main-content -->
  </div><!-- /layout -->
</div><!-- /page -->

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <div class="modal-strip"></div>
    <div class="modal-close-wrap">
      <button class="modal-close" onclick="tutupModal()">✕</button>
    </div>
    <div class="modal-inner">
      <div class="modal-cover-col">
        <div class="modal-cover" id="mCover"></div>
        <div class="modal-avail" id="mAvail"></div>
      </div>
      <div class="modal-info">
        <span class="modal-kat" id="mKat"></span>
        <h2 class="modal-title" id="mJudul"></h2>
        <p class="modal-author" id="mPenulis"></p>
        <div class="modal-metas">
          <div><div class="mm-label">Tahun Terbit</div><div class="mm-val" id="mTahun">—</div></div>
          <div><div class="mm-label">ISBN</div><div class="mm-val" id="mIsbn">—</div></div>
        </div>
        <div class="modal-divider"></div>
        <div class="modal-sinopsis-label">Sinopsis</div>
        <p class="modal-sinopsis" id="mSinopsis"></p>
        <div class="modal-btns" id="mBtns"></div>
      </div>
    </div>
  </div>
</div>

<script>
/* THEME */
const html=document.documentElement,themeFlash=document.getElementById('themeFlash'),toggleEmoji=document.getElementById('toggleEmoji');
(function(){
  const t=localStorage.getItem('libco-theme')||'light';
  html.setAttribute('data-theme',t);
  toggleEmoji.textContent=t==='dark'?'🌙':'☀️';
})();
document.getElementById('themeToggle').addEventListener('click',()=>{
  const isDark=html.getAttribute('data-theme')==='dark',next=isDark?'light':'dark';
  themeFlash.classList.add('active');setTimeout(()=>themeFlash.classList.remove('active'),300);
  html.setAttribute('data-theme',next);
  toggleEmoji.textContent=next==='dark'?'🌙':'☀️';
  localStorage.setItem('libco-theme',next);
});

/* SIDEBAR TOGGLE (mobile) */
const sidebarToggle=document.getElementById('sidebarToggle'),sidebarCollapsible=document.getElementById('sidebarCollapsible');
function checkSidebar(){
  if(window.innerWidth>900){
    sidebarCollapsible.classList.add('open');
    sidebarToggle.style.display='none';
  } else {
    sidebarToggle.style.display='flex';
  }
}
checkSidebar();
window.addEventListener('resize',checkSidebar);
sidebarToggle.addEventListener('click',()=>{
  sidebarToggle.classList.toggle('open');
  sidebarCollapsible.classList.toggle('open');
});

/* =====================================================
   FILTER ENGINE
   KUNCI PERBAIKAN: bandingkan data-cat sebagai STRING,
   karena dataset selalu mengembalikan string.
   ===================================================== */
let isGrid=true, activeSearch='', activeCat='semua', activeAvail='semua';

// Kumpulkan semua pasangan grid+list card
const allBooks = [];
document.querySelectorAll('.book-card.grid-item').forEach(g => {
  allBooks.push({
    g: g,
    l: g.nextElementSibling,            // elemen list-card tepat setelahnya
    cat: g.dataset.cat,                  // sudah string dari dataset
    stok: parseInt(g.dataset.stok) || 0,
    judul: g.dataset.judul,
    penulis: g.dataset.penulis,
  });
});

const totalAll = allBooks.length;

function applyFilters(){
  let vis = 0;
  allBooks.forEach(b => {
    // Bandingkan sebagai string — ini kunci utama filter kategori
    const catMatch  = activeCat === 'semua' || b.cat === activeCat;
    const searchQ   = activeSearch.toLowerCase();
    const searchMatch = !searchQ || b.judul.includes(searchQ) || b.penulis.includes(searchQ);
    const availMatch  = activeAvail === 'semua'
      || (activeAvail === 'tersedia' && b.stok > 0)
      || (activeAvail === 'habis'    && b.stok === 0);

    const show = catMatch && searchMatch && availMatch;

    // Grid item
    b.g.style.display = (isGrid && show) ? '' : 'none';
    // List item
    if(b.l) b.l.style.display = (!isGrid && show) ? '' : 'none';

    if(show) vis++;
  });

  document.getElementById('resultInfo').innerHTML =
    `Menampilkan <strong>${vis}</strong> dari ${totalAll} buku`;

  const empty = document.getElementById('emptyState');
  empty.classList.toggle('show', vis === 0);
  document.getElementById('emptyText').textContent = activeSearch
    ? `Tidak ada buku untuk "${activeSearch}".`
    : 'Tidak ada buku pada filter ini.';

  buildChips();
}

function buildChips(){
  const w = document.getElementById('activeFilters');
  w.innerHTML = '';
  if(activeCat !== 'semua'){
    const btn = document.querySelector(`.cat-item[data-cat="${activeCat}"]`);
    const lbl = btn ? btn.childNodes[0].textContent.trim() : activeCat;
    w.innerHTML += `<span class="afc" onclick="resetCat()"><i class="fas fa-times"></i>${lbl}</span>`;
  }
  if(activeAvail !== 'semua'){
    const lbl = {tersedia:'Tersedia',habis:'Stok Habis'}[activeAvail];
    w.innerHTML += `<span class="afc" onclick="resetAvail()"><i class="fas fa-times"></i>${lbl}</span>`;
  }
  if(activeSearch){
    w.innerHTML += `<span class="afc" onclick="resetSearch()"><i class="fas fa-times"></i>"${activeSearch}"</span>`;
  }
}

function resetCat(){
  activeCat='semua';
  document.querySelectorAll('.cat-item').forEach(b=>b.classList.remove('active'));
  document.querySelector('.cat-item[data-cat="semua"]').classList.add('active');
  applyFilters();
}
function resetAvail(){
  activeAvail='semua';
  document.querySelector('input[name=avail][value=semua]').checked=true;
  applyFilters();
}
function resetSearch(){
  activeSearch='';
  document.getElementById('sidebarSearch').value='';
  document.getElementById('navSearch').value='';
  applyFilters();
}

// Category click
document.querySelectorAll('.cat-item').forEach(btn => btn.addEventListener('click', () => {
  document.querySelectorAll('.cat-item').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  activeCat = btn.dataset.cat;  // string langsung dari dataset
  applyFilters();
}));

// Availability radio
document.querySelectorAll('input[name=avail]').forEach(r =>
  r.addEventListener('change', () => { activeAvail = r.value; applyFilters(); })
);

// Search debounce
let debounce;
function syncSearch(val){
  clearTimeout(debounce);
  debounce = setTimeout(() => { activeSearch = val.trim().toLowerCase(); applyFilters(); }, 150);
}
document.getElementById('sidebarSearch').addEventListener('input', function(){
  document.getElementById('navSearch').value = this.value;
  syncSearch(this.value);
});
document.getElementById('navSearch').addEventListener('input', function(){
  document.getElementById('sidebarSearch').value = this.value;
  syncSearch(this.value);
});

document.getElementById('resetBtn').addEventListener('click', () => { resetCat(); resetAvail(); resetSearch(); });

// View toggle
document.getElementById('btnGrid').addEventListener('click', () => {
  isGrid = true;
  document.getElementById('btnGrid').classList.add('active');
  document.getElementById('btnList').classList.remove('active');
  document.getElementById('bookGrid').classList.remove('list-view');
  applyFilters();
});
document.getElementById('btnList').addEventListener('click', () => {
  isGrid = false;
  document.getElementById('btnList').classList.add('active');
  document.getElementById('btnGrid').classList.remove('active');
  document.getElementById('bookGrid').classList.add('list-view');
  applyFilters();
});

// Sort
document.getElementById('sortSelect').addEventListener('change', function(){
  const grid = document.getElementById('bookGrid');
  const pairs = allBooks.map(b => ({g:b.g, l:b.l, judul:b.judul, stok:b.stok}));
  pairs.sort((a,b) => {
    if(this.value==='az')   return a.judul.localeCompare(b.judul);
    if(this.value==='za')   return b.judul.localeCompare(a.judul);
    if(this.value==='stok') return b.stok - a.stok;
    return 0;
  });
  const emptyEl = document.getElementById('emptyState');
  pairs.forEach(p => { grid.insertBefore(p.g, emptyEl); grid.insertBefore(p.l, emptyEl); });
});

/* =====================================================
   MODAL
   ===================================================== */
function bukaModal(e, el){
  e.preventDefault();
  const stok   = parseInt(el.dataset.stok) || 0;
  const cover  = el.dataset.cover;
  const color  = el.dataset.color || 'linear-gradient(135deg,#1d4ed8,#7c3aed)';
  const judul  = el.dataset.fullJudul || '—';
  const penulis= el.dataset.fullPenulis || '—';
  const detailUrl = el.dataset.detailUrl || '#';

  const mc = document.getElementById('mCover');
  mc.style.background = color;
  if(cover){
    mc.innerHTML = `<div class="modal-cover-spine"></div><img src="${cover}" alt="${judul}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;">`;
  } else {
    mc.innerHTML = `<div class="modal-cover-spine"></div><div class="modal-cover-ph">📚</div>`;
  }

  const ma = document.getElementById('mAvail');
  ma.className = 'modal-avail ' + (stok > 0 ? 'ok' : 'none');
  ma.textContent = stok > 0 ? `${stok} eksemplar tersedia` : 'Stok habis';

  document.getElementById('mKat').textContent     = el.dataset.kategori || '—';
  document.getElementById('mJudul').textContent   = judul;
  document.getElementById('mPenulis').innerHTML   = `oleh <span>${penulis}</span>`;
  document.getElementById('mSinopsis').textContent= el.dataset.sinopsis || 'Deskripsi belum tersedia.';
  document.getElementById('mTahun').textContent   = el.dataset.tahun || '—';
  document.getElementById('mIsbn').textContent    = el.dataset.isbn  || '—';

  document.getElementById('mBtns').innerHTML =
    `<a href="${detailUrl}" class="modal-btn mb-outline"><i class="fas fa-eye"></i> Selengkapnya</a>` +
    (stok > 0
      ? `<a href="${detailUrl}" class="modal-btn mb-fill"><i class="fas fa-book-open"></i> Pinjam Buku</a>`
      : `<span class="modal-btn mb-disabled"><i class="fas fa-times"></i> Stok Habis</span>`
    );

  document.getElementById('modalOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}

function tutupModal(){
  document.getElementById('modalOverlay').classList.remove('show');
  document.body.style.overflow = '';
}

document.getElementById('modalOverlay').addEventListener('click', function(e){
  if(e.target === this) tutupModal();
});
document.addEventListener('keydown', e => { if(e.key === 'Escape') tutupModal(); });
</script>
</body>
</html>