<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $ebook->judul_buku }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    :root {
      --p1: #4c1d95; --p2: #5b21b6; --p3: #6d28d9; --p4: #7c3aed; --p5: #8b5cf6; --p6: #a78bfa; --p7: #c4b5fd; --p8: #ede9fe;
      --b1: #1e3a8a; --b2: #1d4ed8; --b3: #2563eb; --b4: #3b82f6; --b5: #60a5fa; --b6: #93c5fd; --b7: #bfdbfe; --b8: #dbeafe;
      --ink: #1e1b4b; --mu: #6b7280; --bd: #e0e7ff; --cream: #f5f3ff; --wh: #ffffff;
      --shadow-sm: 0 1px 3px rgba(76,29,149,.08); --shadow-md: 0 4px 16px rgba(76,29,149,.12); --shadow-lg: 0 12px 40px rgba(76,29,149,.18);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { background: var(--cream); font-family: 'Plus Jakarta Sans', sans-serif; color: var(--ink); min-height: 100vh; }

    /* ══ HERO ══ */
    .hero {
      position: relative; overflow: hidden;
      background: #07051a;
      padding-bottom: 100px; min-height: 520px;
    }
    .hero-bg {
      position: absolute; inset: 0; z-index: 0;
      background-size: cover; background-position: center;
      filter: blur(70px) brightness(.22) saturate(1.6) hue-rotate(230deg);
      transform: scale(1.15);
    }
    .hero-particles {
      position: absolute; inset: 0; z-index: 1; overflow: hidden; pointer-events: none;
    }
    .hero-particles::before, .hero-particles::after {
      content: ''; position: absolute; border-radius: 50%;
      animation: float 8s ease-in-out infinite;
    }
    .hero-particles::before {
      width: 400px; height: 400px; top: -100px; right: -80px;
      background: radial-gradient(circle, rgba(124,58,237,.25) 0%, transparent 70%);
    }
    .hero-particles::after {
      width: 300px; height: 300px; bottom: 0; left: 10%;
      background: radial-gradient(circle, rgba(37,99,235,.2) 0%, transparent 70%);
      animation-delay: -4s;
    }
    @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-20px)} }
    .hero-overlay {
      position: absolute; inset: 0; z-index: 2;
      background: linear-gradient(180deg, rgba(7,5,26,.05) 0%, rgba(7,5,26,.45) 50%, rgba(7,5,26,.96) 100%);
    }
    .hero-inner {
      position: relative; z-index: 3;
      max-width: 1100px; margin: 0 auto; padding: 36px 40px 0;
    }

    /* Breadcrumb */
    .bc {
      display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
      font-size: 0.72rem; color: rgba(255,255,255,.35); margin-bottom: 44px;
    }
    .bc a {
      color: rgba(255,255,255,.42); text-decoration: none;
      transition: color .2s; display: flex; align-items: center; gap: 4px;
    }
    .bc a:hover { color: var(--p6); }
    .bc-sep { opacity: .25; font-size: .9em; }

    /* Layout */
    .hero-layout { display: grid; grid-template-columns: 220px 1fr; gap: 56px; align-items: start; }

    /* Cover */
    .cover-col { position: relative; }
    .book-3d-wrap {
      position: relative; width: 220px;
      filter: drop-shadow(-14px 24px 48px rgba(0,0,0,.8));
      transform: perspective(900px) rotateY(-8deg) rotateX(2deg);
      transition: transform .6s cubic-bezier(.34,1.2,.64,1), filter .6s;
    }
    .book-3d-wrap:hover {
      transform: perspective(900px) rotateY(-2deg) rotateX(0deg) translateY(-8px);
      filter: drop-shadow(-4px 32px 56px rgba(0,0,0,.88));
    }
    .book-spine-left {
      position: absolute; left: 0; top: 0; bottom: 0; width: 16px; z-index: 2; border-radius: 2px 0 0 2px;
      background: linear-gradient(90deg, rgba(0,0,0,.5) 0%, rgba(0,0,0,.15) 60%, transparent 100%);
    }
    .book-shine {
      position: absolute; inset: 0; z-index: 3; border-radius: 2px 10px 10px 2px;
      background: linear-gradient(135deg, rgba(255,255,255,.12) 0%, transparent 50%, rgba(0,0,0,.08) 100%);
      pointer-events: none;
    }
    .book-img { width: 220px; aspect-ratio: 2/3; object-fit: cover; display: block; border-radius: 2px 10px 10px 2px; }
    .book-ph {
      width: 220px; aspect-ratio: 2/3; border-radius: 2px 10px 10px 2px;
      background: linear-gradient(135deg, #1e1040 0%, #2e1065 40%, #1e3a8a 100%);
      display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px;
    }
    .book-ph-icon { font-size: 3.5rem; opacity: .8; }
    .book-ph-title { font-family: 'Playfair Display', serif; font-size: .75rem; color: rgba(255,255,255,.5); text-align: center; padding: 0 16px; }

    .pop-badge {
      position: absolute; top: -12px; right: -12px; z-index: 4;
      width: 54px; height: 54px; border-radius: 50%;
      background: linear-gradient(135deg, var(--p4), var(--b2));
      display: flex; align-items: center; justify-content: center; flex-direction: column;
      font-size: 0.52rem; font-weight: 800; color: white;
      letter-spacing: .06em; text-transform: uppercase; line-height: 1.3; text-align: center;
      box-shadow: 0 4px 20px rgba(124,58,237,.6), 0 0 0 3px rgba(255,255,255,.15);
      animation: pulse-badge 2.5s ease infinite;
    }
    @keyframes pulse-badge {
      0%,100%{ box-shadow: 0 4px 20px rgba(124,58,237,.6), 0 0 0 3px rgba(255,255,255,.15); }
      50%{ box-shadow: 0 4px 32px rgba(124,58,237,.85), 0 0 0 6px rgba(255,255,255,.08); }
    }

    /* Stats bar under cover */
    .cover-stats {
      display: flex; justify-content: center; gap: 16px; margin-top: 18px;
    }
    .cstat {
      display: flex; flex-direction: column; align-items: center; gap: 2px;
    }
    .cstat-val { font-size: .82rem; font-weight: 800; color: var(--p6); }
    .cstat-lbl { font-size: .58rem; color: rgba(255,255,255,.35); text-transform: uppercase; letter-spacing: .06em; }

    /* Info column */
    .info-col { padding-top: 4px; }
    .tag-row { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 20px; }
    .tag {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 4px 11px; border-radius: 50px;
      font-size: 0.64rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase;
    }
    .tag-kat   { background: rgba(59,130,246,.18); color: var(--b6); border: 1px solid rgba(59,130,246,.28); }
    .tag-genre { background: rgba(139,92,246,.18); color: var(--p7); border: 1px solid rgba(139,92,246,.28); }
    .tag-pdf   { background: rgba(16,185,129,.18); color: #6ee7b7; border: 1px solid rgba(16,185,129,.28); }

    .hero-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.9rem, 3.4vw, 2.9rem);
      font-weight: 800; color: #fff; line-height: 1.13;
      letter-spacing: -.025em; margin-bottom: 10px;
    }
    .hero-title-accent { color: var(--p6); }
    .hero-author { font-size: 0.86rem; color: rgba(255,255,255,.45); margin-bottom: 28px; }
    .hero-author span { color: var(--p6); font-weight: 600; }

    .meta-row { display: flex; flex-wrap: wrap; gap: 7px; margin-bottom: 22px; }
    .meta-chip {
      display: inline-flex; align-items: center; gap: 6px;
      background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.09);
      border-radius: 9px; padding: 7px 13px;
      font-size: 0.73rem; color: rgba(255,255,255,.48);
      backdrop-filter: blur(4px);
    }
    .meta-chip strong { color: rgba(255,255,255,.82); font-weight: 700; }
    .meta-chip.avail   { background: rgba(16,185,129,.1); border-color: rgba(16,185,129,.28); color: #6ee7b7; }
    .meta-chip.avail strong { color: #6ee7b7; }
    .meta-chip.nostock { background: rgba(239,68,68,.1); border-color: rgba(239,68,68,.28); color: #fca5a5; }
    .meta-chip.nostock strong { color: #fca5a5; }

    /* Cara baca hint */
    .cara-baca-hint {
      display: flex; align-items: flex-start; gap: 10px;
      background: rgba(124,58,237,.1); border: 1px solid rgba(124,58,237,.2);
      border-radius: 12px; padding: 12px 16px; margin-bottom: 22px;
      font-size: 0.76rem; color: rgba(255,255,255,.48); line-height: 1.65;
      backdrop-filter: blur(4px);
    }
    .cara-baca-hint .hint-icon { font-size: 1.05rem; flex-shrink: 0; margin-top: 2px; }
    .cara-baca-hint strong { color: var(--p6); }

    /* Action row */
    .action-row { display: flex; flex-wrap: wrap; gap: 12px; align-items: center; }
    .btn {
      display: inline-flex; align-items: center; gap: 9px;
      padding: 13px 28px; border-radius: 14px; border: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 0.88rem; font-weight: 700; cursor: pointer;
      transition: all .24s cubic-bezier(.34,1.2,.64,1); text-decoration: none; white-space: nowrap;
    }
    .btn-pinjam {
      background: linear-gradient(135deg, var(--p4) 0%, var(--p2) 100%);
      color: white; box-shadow: 0 4px 24px rgba(124,58,237,.5);
    }
    .btn-pinjam:hover {
      background: linear-gradient(135deg, var(--p5) 0%, var(--p3) 100%);
      box-shadow: 0 8px 36px rgba(124,58,237,.7); transform: translateY(-3px);
    }
    .btn-baca {
      background: linear-gradient(135deg, var(--b3) 0%, var(--b1) 100%);
      color: white; box-shadow: 0 4px 24px rgba(37,99,235,.45);
    }
    .btn-baca:hover {
      background: linear-gradient(135deg, var(--b4) 0%, var(--b2) 100%);
      box-shadow: 0 8px 36px rgba(37,99,235,.65); transform: translateY(-3px);
    }
    .btn-sudah {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 13px 24px; border-radius: 14px;
      background: rgba(16,185,129,.12); color: #6ee7b7;
      border: 1px solid rgba(16,185,129,.28);
      font-size: 0.88rem; font-weight: 600; cursor: default;
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* ══ BODY ══ */
    .body-wrap {
      max-width: 1100px; margin: -52px auto 80px;
      padding: 0 40px; position: relative; z-index: 4;
    }

    .alert {
      display: flex; align-items: center; gap: 10px;
      padding: 14px 18px; border-radius: 14px; margin-bottom: 20px;
      font-weight: 600; font-size: 0.84rem;
      animation: slideDown .3s ease;
    }
    @keyframes slideDown { from{opacity:0;transform:translateY(-10px)} to{opacity:1;transform:none} }
    .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
    .alert-error   { background: #fff1f2; border: 1px solid #fecada; color: #dc2626; }

    /* Banner cara baca */
    .banner-cara-baca {
      background: linear-gradient(135deg, #12104a 0%, #0f1a3d 100%);
      border: 1px solid rgba(124,58,237,.22);
      border-radius: 20px; padding: 22px 26px;
      display: flex; gap: 18px; align-items: flex-start;
      margin-bottom: 22px;
      animation: fadeUp .4s ease both;
      box-shadow: 0 4px 20px rgba(76,29,149,.2);
    }
    .bcb-icon { font-size: 2.2rem; flex-shrink: 0; }
    .bcb-content { flex: 1; }
    .bcb-title { font-size: 0.87rem; font-weight: 800; color: var(--p7); margin-bottom: 10px; letter-spacing: .01em; }
    .bcb-steps { display: flex; flex-direction: column; gap: 8px; }
    .bcb-step { display: flex; align-items: center; gap: 10px; font-size: 0.78rem; color: rgba(255,255,255,.55); }
    .bcb-step-num {
      width: 22px; height: 22px; border-radius: 50%; flex-shrink: 0;
      background: linear-gradient(135deg, rgba(124,58,237,.4), rgba(37,99,235,.3));
      border: 1px solid rgba(124,58,237,.35);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.6rem; font-weight: 800; color: var(--p7);
    }
    .bcb-step strong { color: rgba(255,255,255,.82); }

    /* Cards */
    .card {
      background: var(--wh); border-radius: 22px;
      padding: 34px 38px; border: 1px solid var(--bd);
      box-shadow: var(--shadow-md); margin-bottom: 20px;
      animation: fadeUp .45s ease both;
      transition: box-shadow .3s;
    }
    .card:hover { box-shadow: var(--shadow-lg); }
    @keyframes fadeUp { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:none} }
    .card:nth-child(2){animation-delay:.06s}
    .card:nth-child(3){animation-delay:.11s}
    .card:nth-child(4){animation-delay:.16s}
    .card:nth-child(5){animation-delay:.21s}

    .card-label {
      font-size: 0.58rem; font-weight: 800; letter-spacing: .16em;
      color: var(--p4); text-transform: uppercase; margin-bottom: 20px;
      display: flex; align-items: center; gap: 10px;
    }
    .card-label::before { content: ''; width: 3px; height: 14px; background: linear-gradient(180deg, var(--p4), var(--b3)); border-radius: 2px; }
    .card-label::after { content:''; flex:1; height:1px; background: linear-gradient(90deg, var(--bd), transparent); }

    /* Sinopsis */
    .sinopsis-text {
      font-family: 'Playfair Display', serif;
      font-size: 1.02rem; color: #3d2e60; line-height: 2;
      font-style: italic; position: relative; padding-left: 20px;
    }
    .sinopsis-text::before {
      content: '"'; position: absolute; left: -4px; top: -8px;
      font-size: 4rem; color: var(--p8); font-style: normal; line-height: 1; font-weight: 800;
    }

    /* Info grid */
    .info-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .info-item {
      background: linear-gradient(135deg, var(--cream), #fff);
      border-radius: 14px; padding: 18px 20px;
      border: 1px solid var(--bd);
      position: relative; overflow: hidden;
      transition: transform .22s, box-shadow .22s;
    }
    .info-item::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg, var(--p4), var(--b3));
    }
    .info-item:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(124,58,237,.12); }
    .info-item label {
      display: block; font-size: 0.58rem; font-weight: 800; color: var(--p5);
      text-transform: uppercase; letter-spacing: .1em; margin-bottom: 6px;
    }
    .info-item p { font-size: 0.9rem; font-weight: 700; color: var(--ink); }

    /* Pills */
    .pill-row { display: flex; flex-wrap: wrap; gap: 9px; }
    .pill {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 18px; border-radius: 50px;
      font-size: 0.75rem; font-weight: 700; transition: all .22s;
    }
    .pill-purple { background: var(--p8); color: var(--p2); border: 1px solid rgba(124,58,237,.22); }
    .pill-purple:hover { background: #ddd6fe; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(124,58,237,.18); }
    .pill-blue   { background: var(--b8); color: var(--b1); border: 1px solid rgba(37,99,235,.2); }
    .pill-blue:hover { background: var(--b7); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37,99,235,.15); }
    .pill-green  { background: #ecfdf5; color: #065f46; border: 1px solid rgba(16,185,129,.2); }

    /* Related books */
    .related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
    .rel-card {
      background: var(--cream); border-radius: 16px; overflow: hidden;
      border: 1px solid var(--bd); text-decoration: none; color: var(--ink);
      transition: transform .25s, box-shadow .25s; display: block;
    }
    .rel-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 16px 40px rgba(124,58,237,.18);
      border-color: rgba(124,58,237,.3);
    }
    .rel-img   { width:100%; aspect-ratio:3/4; object-fit:cover; display:block; }
    .rel-ph    { width:100%; aspect-ratio:3/4; background:linear-gradient(135deg,#1e1040,#1e3a8a); display:flex; align-items:center; justify-content:center; font-size:2.5rem; }
    .rel-info  { padding: 14px 16px; }
    .rel-title { font-size:.8rem; font-weight:700; line-height:1.45; margin-bottom:4px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; color: var(--ink); }
    .rel-author{ font-size:.72rem; color:var(--mu); }

    /* Rating stars placeholder */
    .rating-row { display: flex; align-items: center; gap: 6px; margin-bottom: 24px; }
    .stars { color: #f59e0b; letter-spacing: 2px; font-size: .9rem; }
    .rating-count { font-size: .76rem; color: rgba(255,255,255,.38); }

    /* ══ PDF READER ══ */
    .pdf-overlay { display: none; position: fixed; inset: 0; z-index: 9000; flex-direction: column; background: #07051a; }
    .pdf-overlay.show { display: flex; }
    .pdf-bar {
      height: 60px; flex-shrink: 0;
      background: linear-gradient(90deg, #0f0a25, #0a1030);
      border-bottom: 1px solid rgba(124,58,237,.15);
      display: flex; align-items: center; padding: 0 22px; gap: 14px;
    }
    .pdf-bar-icon { font-size: 1.3rem; }
    .pdf-bar-meta { flex: 1; min-width: 0; }
    .pdf-bar-title { font-family: 'Playfair Display', serif; font-size: .92rem; font-weight: 700; color: white; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .pdf-bar-sub { font-size: .67rem; color: rgba(255,255,255,.32); margin-top: 2px; }
    .pdf-btn { display: inline-flex; align-items: center; gap: 7px; padding: 7px 16px; border-radius: 9px; font-family: 'Plus Jakarta Sans', sans-serif; font-size: .77rem; font-weight: 700; cursor: pointer; border: none; text-decoration: none; transition: all .2s; white-space: nowrap; flex-shrink: 0; }
    .pdf-btn-dl { background: rgba(124,58,237,.15); border: 1px solid rgba(124,58,237,.28); color: var(--p7); }
    .pdf-btn-dl:hover { background: rgba(124,58,237,.28); }
    .pdf-btn-close { background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1); color: rgba(255,255,255,.6); }
    .pdf-btn-close:hover { background: rgba(220,38,38,.65); color: white; border-color: transparent; }
    .pdf-body { flex: 1; position: relative; overflow: hidden; }
    .pdf-loading { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 16px; color: rgba(255,255,255,.38); }
    .pdf-spinner { width: 44px; height: 44px; border: 3px solid rgba(255,255,255,.08); border-top-color: var(--p5); border-radius: 50%; animation: spin .8s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
    .pdf-frame { width:100%; height:100%; border:none; opacity:0; transition:opacity .35s; }
    .pdf-frame.loaded { opacity: 1; }
    .pdf-fallback { display:none; position:absolute; inset:0; flex-direction:column; align-items:center; justify-content:center; gap:18px; color:rgba(255,255,255,.45); text-align:center; padding:48px; }
    .pdf-fallback h3 { font-family:'Playfair Display',serif; font-size:1.25rem; color:white; }
    .pdf-fallback p { font-size:.84rem; max-width:360px; line-height:1.75; }
    .pdf-fallback a { display:inline-flex; align-items:center; gap:8px; background:linear-gradient(135deg,var(--p4),var(--b2)); color:white; padding:12px 28px; border-radius:14px; font-weight:700; text-decoration:none; box-shadow:0 4px 20px rgba(124,58,237,.4); transition:opacity .2s; }
    .pdf-fallback a:hover { opacity:.9; }

    /* ══ MODAL PINJAM ══ */
    .overlay { display:none; position:fixed; inset:0; z-index:8000; background:rgba(7,5,26,.65); backdrop-filter:blur(8px); align-items:center; justify-content:center; padding:20px; }
    .overlay.show { display:flex; }
    .modal {
      background: white; border-radius: 28px; padding: 44px;
      max-width: 460px; width: 100%;
      box-shadow: 0 40px 100px rgba(0,0,0,.35), 0 0 0 1px rgba(124,58,237,.1);
      animation: pop .32s cubic-bezier(.34,1.56,.64,1);
    }
    @keyframes pop { from{opacity:0;transform:scale(.82) translateY(20px)} to{opacity:1;transform:scale(1) translateY(0)} }
    .modal-icon  { text-align:center; font-size:3.2rem; margin-bottom:14px; }
    .modal-title { font-family:'Playfair Display',serif; font-size:1.35rem; font-weight:800; text-align:center; margin-bottom:8px; color:var(--ink); }
    .modal-sub   { font-size:.83rem; color:var(--mu); text-align:center; line-height:1.65; margin-bottom:22px; }
    .modal-preview {
      background: var(--cream); border-radius: 16px; padding: 14px 18px;
      display: flex; gap: 14px; align-items: center;
      margin-bottom: 16px; border: 1px solid var(--bd);
    }
    .mp-thumb  { width:46px; height:62px; object-fit:cover; border-radius:5px; flex-shrink:0; }
    .mp-ph     { width:46px; height:62px; background:linear-gradient(135deg,#1e1040,#1e3a8a); border-radius:5px; display:flex; align-items:center; justify-content:center; font-size:1.5rem; flex-shrink:0; }
    .mp-title  { font-size:.88rem; font-weight:700; margin-bottom:3px; color:var(--ink); }
    .mp-author { font-size:.74rem; color:var(--mu); }
    .modal-notice {
      background: var(--p8); border: 1px solid rgba(124,58,237,.18);
      border-radius: 12px; padding: 12px 16px;
      font-size: .76rem; color: var(--p2); line-height: 1.6; margin-bottom: 24px;
    }
    .modal-btns { display:flex; gap:10px; }
    .btn-batal {
      flex:1; background:white; border:1.5px solid var(--bd); color:var(--mu);
      padding:13px; border-radius:13px; font-weight:600; font-size:.86rem;
      cursor:pointer; font-family:'Plus Jakarta Sans',sans-serif; transition:all .2s;
    }
    .btn-batal:hover { border-color:var(--p4); color:var(--p4); }
    .btn-konfirm {
      flex:2; background:linear-gradient(135deg,var(--p4),var(--p2)); color:white; border:none;
      padding:13px; border-radius:13px; font-weight:700; font-size:.86rem; cursor:pointer;
      font-family:'Plus Jakarta Sans',sans-serif; display:flex; align-items:center; justify-content:center;
      gap:8px; transition:all .22s; box-shadow:0 4px 18px rgba(124,58,237,.38);
    }
    .btn-konfirm:hover { background:linear-gradient(135deg,var(--p5),var(--p3)); transform:translateY(-1px); box-shadow:0 8px 28px rgba(124,58,237,.5); }

    /* ══ FOOTER MINI ══ */
    .page-footer {
      text-align: center; padding: 32px 20px;
      font-size: .72rem; color: var(--mu); border-top: 1px solid var(--bd);
      margin-top: 40px;
    }

    /* ══ RESPONSIVE ══ */
    @media(max-width:860px){
      .hero-inner { padding: 28px 24px 0; }
      .body-wrap  { padding: 0 20px; }
      .hero-layout { grid-template-columns: 1fr; justify-items: center; text-align: center; gap: 32px; }
      .book-3d-wrap, .book-img, .book-ph { width: 170px; }
      .tag-row, .meta-row, .action-row, .rating-row, .cover-stats { justify-content: center; }
      .info-grid    { grid-template-columns: 1fr 1fr; }
      .related-grid { grid-template-columns: 1fr 1fr; }
      .card { padding: 26px 22px; }
      .sinopsis-text::before { display: none; }
      .sinopsis-text { padding-left: 0; }
      .banner-cara-baca { flex-direction: column; }
    }
    @media(max-width:540px){
      .info-grid { grid-template-columns: 1fr; }
      .modal { padding: 30px 22px; }
      .hero-title { font-size: 1.65rem; }
    }
  </style>

@php
  $genreList = [];
  if (!empty($ebook->id_genre)) {
    $raw = $ebook->id_genre;
    if (is_string($raw)) {
      $decoded = json_decode($raw, true);
      if (is_array($decoded)) {
        foreach ($decoded as $g) {
          $label = $g['NAMA_GENRE'] ?? $g['nama_genre'] ?? null;
          if ($label) $genreList[] = $label;
        }
      } else {
        $genreList = array_filter(array_map('trim', explode(',', $raw)));
      }
    } elseif (is_array($raw)) {
      foreach ($raw as $g) {
        $label = $g['NAMA_GENRE'] ?? $g['nama_genre'] ?? (is_string($g) ? $g : null);
        if ($label) $genreList[] = $label;
      }
    }
  }
  $hasPdf   = !empty($ebook->file_ebook);
  $pdfUrl   = $hasPdf ? Storage::url($ebook->file_ebook) : null;
  $bisaBaca = $sudahPinjam && $hasPdf;
  $totalPinjam = \App\Models\Transaksi::where('id_buku', $ebook->id_buku)->count();
@endphp

{{-- ══ HERO ══ --}}
<div class="hero">
  <div class="hero-bg"
    @if($ebook->cover)
      style="background-image:url('{{ Storage::url($ebook->cover) }}')"
    @else
      style="background:linear-gradient(135deg,#1e1040,#1e3a8a)"
    @endif
  ></div>
  <div class="hero-particles"></div>
  <div class="hero-overlay"></div>

  <div class="hero-inner">
    <nav class="bc">
      <a href="{{ route('anggota.dashboard') }}">🏠 Beranda</a>
      <span class="bc-sep">›</span>
      <a href="{{ route('anggota.koleksi.index') }}">Koleksi Buku</a>
      <span class="bc-sep">›</span>
      <span>{{ Str::limit($ebook->judul_buku, 40) }}</span>
    </nav>

    <div class="hero-layout">

      {{-- Cover --}}
      <div class="cover-col">
        <div class="book-3d-wrap">
          <div class="book-spine-left"></div>
          @if($ebook->cover)
            <img src="{{ Storage::url($ebook->cover) }}" alt="{{ $ebook->judul_buku }}" class="book-img">
          @else
            <div class="book-ph">
              <div class="book-ph-icon">📚</div>
              <div class="book-ph-title">{{ Str::limit($ebook->judul_buku, 30) }}</div>
            </div>
          @endif
          <div class="book-shine"></div>
        </div>
        @if($totalPinjam >= 5)
          <div class="pop-badge">🔥<br>Populer</div>
        @endif
        <div class="cover-stats">
          <div class="cstat">
            <span class="cstat-val">{{ $totalPinjam }}</span>
            <span class="cstat-lbl">Dipinjam</span>
          </div>
          <div class="cstat">
            <span class="cstat-val">{{ $ebook->jumlah_ebook ?? 0 }}</span>
            <span class="cstat-lbl">Stok</span>
          </div>
          @if($hasPdf)
          <div class="cstat">
            <span class="cstat-val">PDF</span>
            <span class="cstat-lbl">Tersedia</span>
          </div>
          @endif
        </div>
      </div>

      {{-- Info --}}
      <div class="info-col">
        <div class="tag-row">
          <span class="tag tag-kat">📂 {{ $ebook->kategori->nama_kategori ?? 'Umum' }}</span>
          @foreach($genreList as $g)
            <span class="tag tag-genre">🏷 {{ $g }}</span>
          @endforeach
          @if($hasPdf)
            <span class="tag tag-pdf">📄 PDF</span>
          @endif
        </div>

        <h1 class="hero-title">{{ $ebook->judul_buku }}</h1>
        <p class="hero-author">oleh <span>{{ $ebook->pengarang }}</span></p>

        <div class="meta-row">
          @if($ebook->tahun_terbit)
            <div class="meta-chip">📅 <strong>{{ $ebook->tahun_terbit }}</strong></div>
          @endif
          @if($ebook->penerbit)
            <div class="meta-chip">🏢 <strong>{{ Str::limit($ebook->penerbit, 22) }}</strong></div>
          @endif
          @if($ebook->no_isbn)
            <div class="meta-chip">🔖 <strong>{{ $ebook->no_isbn }}</strong></div>
          @endif
          @if(($ebook->jumlah_ebook ?? 0) > 0)
            <div class="meta-chip avail">✅ <strong>Tersedia</strong></div>
          @else
            <div class="meta-chip nostock">❌ <strong>Stok Habis</strong></div>
          @endif
        </div>

        @if(!$sudahPinjam && $hasPdf)
          <div class="cara-baca-hint">
            <span class="hint-icon">💡</span>
            <span>Buku ini punya versi digital PDF. <strong>Pinjam dulu</strong> untuk bisa membaca langsung di browser kamu.</span>
          </div>
        @endif

        <div class="action-row">
          @if($sudahPinjam)
            <div class="btn-sudah">✅ Sedang Kamu Pinjam</div>
            @if($hasPdf)
              <button class="btn btn-baca" onclick="bukaPDF()">📄 Baca Sekarang</button>
            @endif
          @else
            <button class="btn btn-pinjam" onclick="bukaKonfirmasi()">📖 Pinjam Buku Ini</button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ══ BODY ══ --}}
<div class="body-wrap">

  @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-error">❌ {{ session('error') }}</div>
  @endif

  {{-- Banner cara baca --}}
  @if(!$sudahPinjam && $hasPdf)
  <div class="banner-cara-baca">
    <div class="bcb-icon">📖</div>
    <div class="bcb-content">
      <div class="bcb-title">Cara Membaca Buku Ini</div>
      <div class="bcb-steps">
        <div class="bcb-step"><div class="bcb-step-num">1</div><span>Klik <strong>Pinjam Buku Ini</strong> di atas</span></div>
        <div class="bcb-step"><div class="bcb-step-num">2</div><span>Konfirmasi — akses diberikan selama <strong>{{ \App\Models\AppSetting::get('durasi_pinjam', 7) }} hari</strong></span></div>
        <div class="bcb-step"><div class="bcb-step-num">3</div><span>Tombol <strong>Baca Sekarang</strong> muncul otomatis, klik untuk buka PDF</span></div>
        <div class="bcb-step"><div class="bcb-step-num">4</div><span>Selesai? Kembalikan dari <strong>Dashboard</strong> kamu</span></div>
      </div>
    </div>
  </div>
  @endif

  {{-- Sinopsis --}}
  <div class="card">
    <p class="card-label">Tentang Buku</p>
    <p class="sinopsis-text">{{ $ebook->sinopsis ?? 'Deskripsi buku ini belum tersedia.' }}</p>
  </div>

  {{-- Informasi --}}
  <div class="card">
    <p class="card-label">Informasi Buku</p>
    <div class="info-grid">
      <div class="info-item">
        <label>Penulis</label>
        <p>{{ $ebook->pengarang ?? '-' }}</p>
      </div>
      <div class="info-item">
        <label>Kategori</label>
        <p>{{ $ebook->kategori->nama_kategori ?? '-' }}</p>
      </div>
      <div class="info-item">
        <label>Tahun Terbit</label>
        <p>{{ $ebook->tahun_terbit ?? '-' }}</p>
      </div>
      @if($ebook->penerbit)
      <div class="info-item">
        <label>Penerbit</label>
        <p>{{ $ebook->penerbit }}</p>
      </div>
      @endif
      @if($ebook->no_isbn)
      <div class="info-item">
        <label>No. ISBN</label>
        <p>{{ $ebook->no_isbn }}</p>
      </div>
      @endif
      <div class="info-item">
        <label>Total Dipinjam</label>
        <p>{{ $totalPinjam }} kali</p>
      </div>
      <div class="info-item">
        <label>Stok</label>
        <p>{{ $ebook->jumlah_ebook ?? 0 }} eksemplar</p>
      </div>
      @if($hasPdf)
      <div class="info-item">
        <label>Format Digital</label>
        <p>📄 PDF Tersedia</p>
      </div>
      @endif
    </div>
  </div>

  {{-- Genre & Kategori --}}
  <div class="card">
    <p class="card-label">Genre & Kategori</p>
    <div class="pill-row">
      <span class="pill pill-blue">📂 {{ $ebook->kategori->nama_kategori ?? 'Umum' }}</span>
      @forelse($genreList as $g)
        <span class="pill pill-purple">🏷 {{ $g }}</span>
      @empty
        <span class="pill pill-purple">🏷 {{ $ebook->kategori->nama_kategori ?? 'Umum' }}</span>
      @endforelse
      @if($hasPdf)
        <span class="pill pill-green">📄 PDF Tersedia</span>
      @endif
    </div>
  </div>

  {{-- Buku Terkait --}}
  @if(isset($related) && $related->count())
  <div class="card">
    <p class="card-label">Buku Serupa</p>
    <div class="related-grid">
      @foreach($related as $r)
      <a href="{{ route('anggota.buku.show', $r->id_buku) }}" class="rel-card">
        @if($r->cover)
          <img src="{{ Storage::url($r->cover) }}" alt="{{ $r->judul_buku }}" class="rel-img">
        @else
          <div class="rel-ph">📚</div>
        @endif
        <div class="rel-info">
          <p class="rel-title">{{ $r->judul_buku }}</p>
          <p class="rel-author">{{ $r->pengarang }}</p>
        </div>
      </a>
      @endforeach
    </div>
  </div>
  @endif

</div>

{{-- ══ PDF READER ══ --}}
@if($bisaBaca)
<div class="pdf-overlay" id="pdfOverlay">
  <div class="pdf-bar">
    <div class="pdf-bar-icon">📄</div>
    <div class="pdf-bar-meta">
      <div class="pdf-bar-title">{{ $ebook->judul_buku }}</div>
      <div class="pdf-bar-sub">{{ $ebook->pengarang }} · {{ $ebook->kategori->nama_kategori ?? '' }}</div>
    </div>
    <a href="{{ $pdfUrl }}" download class="pdf-btn pdf-btn-dl">⬇ Unduh</a>
    <button class="pdf-btn pdf-btn-close" onclick="tutupPDF()">✕ Tutup</button>
  </div>
  <div class="pdf-body">
    <div class="pdf-loading" id="pdfLoading">
      <div class="pdf-spinner"></div>
      <span style="font-size:.84rem;margin-top:4px">Memuat dokumen…</span>
    </div>
    <iframe id="pdfFrame" class="pdf-frame" src="" title="{{ $ebook->judul_buku }}" onload="onPdfLoaded()"></iframe>
    <div class="pdf-fallback" id="pdfFallback">
      <div style="font-size:4rem">📄</div>
      <h3>PDF tidak dapat ditampilkan</h3>
      <p>Browser kamu tidak mendukung tampilan PDF langsung. Silakan unduh untuk membaca.</p>
      <a href="{{ $pdfUrl }}" download>⬇ Unduh PDF</a>
    </div>
  </div>
</div>
@endif

{{-- ══ MODAL PINJAM ══ --}}
<div class="overlay" id="modalOverlay" onclick="if(event.target===this)tutupModal()">
  <div class="modal">
    <div class="modal-icon">📖</div>
    <h3 class="modal-title">Konfirmasi Peminjaman</h3>
   <p class="modal-sub">Kamu akan meminjam buku berikut selama <strong>{{ \App\Models\AppSetting::get('durasi_pinjam', 7) }} hari</strong>:</p>
    <div class="modal-preview">
      @if($ebook->cover)
        <img src="{{ Storage::url($ebook->cover) }}" class="mp-thumb" alt="">
      @else
        <div class="mp-ph">📚</div>
      @endif
      <div>
        <p class="mp-title">{{ $ebook->judul_buku }}</p>
        <p class="mp-author">{{ $ebook->pengarang }}</p>
      </div>
    </div>
   <div class="modal-notice">
  ⏰ Buku otomatis <strong>kadaluwarsa</strong> setelah {{ \App\Models\AppSetting::get('durasi_pinjam', 7) }} hari. Kembalikan tepat waktu agar statusmu tetap aktif.
</div>
    <div class="modal-btns">
      <button class="btn-batal" onclick="tutupModal()">Batal</button>
      <form method="POST" action="{{ route('anggota.buku.pinjam', $ebook->id_buku) }}" style="flex:2;display:flex;">
        @csrf
        <button type="submit" class="btn-konfirm" style="flex:1;">✅ Ya, Pinjam Sekarang</button>
      </form>
    </div>
  </div>
</div>

<script>
function bukaKonfirmasi() {
  document.getElementById('modalOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}
function tutupModal() {
  document.getElementById('modalOverlay').classList.remove('show');
  document.body.style.overflow = '';
}

@if($bisaBaca)
const PDF_SRC = "{{ $pdfUrl }}";
let pdfFallbackTimer = null;
function bukaPDF() {
  const overlay  = document.getElementById('pdfOverlay');
  const frame    = document.getElementById('pdfFrame');
  const loading  = document.getElementById('pdfLoading');
  const fallback = document.getElementById('pdfFallback');
  frame.classList.remove('loaded');
  loading.style.display  = 'flex';
  fallback.style.display = 'none';
  frame.src = '';
  overlay.classList.add('show');
  document.body.style.overflow = 'hidden';
  setTimeout(() => { frame.src = PDF_SRC; }, 250);
  clearTimeout(pdfFallbackTimer);
  pdfFallbackTimer = setTimeout(() => {
    if (!frame.classList.contains('loaded')) {
      loading.style.display  = 'none';
      fallback.style.display = 'flex';
    }
  }, 10000);
}
function tutupPDF() {
  clearTimeout(pdfFallbackTimer);
  document.getElementById('pdfOverlay').classList.remove('show');
  document.getElementById('pdfFrame').src = '';
  document.body.style.overflow = '';
}
function onPdfLoaded() {
  clearTimeout(pdfFallbackTimer);
  document.getElementById('pdfLoading').style.display = 'none';
  document.getElementById('pdfFrame').classList.add('loaded');
}
@endif

document.addEventListener('keydown', e => {
  if (e.key !== 'Escape') return;
  @if($bisaBaca)
  if (document.getElementById('pdfOverlay')?.classList.contains('show')) { tutupPDF(); return; }
  @endif
  tutupModal();
});
</script>

</html>