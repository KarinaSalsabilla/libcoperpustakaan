<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>LibCo — Riwayat Peminjaman</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* ══ COLOUR SYSTEM ══ */
    :root, [data-theme="light"] {
      --blue-50:  #eff6ff;
      --blue-100: #dbeafe;
      --blue-500: #3b82f6;
      --blue-600: #2563eb;
      --blue-700: #1d4ed8;
      --purple-50:  #faf5ff;
      --purple-100: #ede9fe;
      --purple-500: #8b5cf6;
      --purple-600: #7c3aed;

      --ink:    #111827;
      --ink2:   #374151;
      --muted:  #6b7280;
      --border: #e5e7eb;

      --body-bg:   #f0f4ff;
      --card-bg:   #ffffff;
      --nav-bg:    rgba(255,255,255,.93);

      --grad-hero: linear-gradient(135deg,#1d4ed8 0%,#7c3aed 60%,#9333ea 100%);
      --grad-btn:  linear-gradient(135deg,#3b82f6 0%,#8b5cf6 100%);
      --grad-body: linear-gradient(135deg,#eff6ff 0%,#ede9fe 50%,#faf5ff 100%);

      --shadow-sm: 0 1px 3px rgba(0,0,0,.06);
      --shadow-md: 0 4px 16px rgba(37,99,235,.10);
      --shadow-lg: 0 12px 40px rgba(37,99,235,.15);
      --shadow-xl: 0 24px 60px rgba(37,99,235,.18);

      --modal-bg: #ffffff;

      --status-active-bg:  rgba(37,99,235,.08);
      --status-active-fg:  #1d4ed8;
      --status-done-bg:    rgba(124,58,237,.08);
      --status-done-fg:    #7c3aed;
      --status-warn-bg:    rgba(234,179,8,.10);
      --status-warn-fg:    #a16207;
    }

    [data-theme="dark"] {
      --blue-50:  rgba(59,130,246,.1);
      --blue-100: rgba(59,130,246,.15);
      --purple-50:  rgba(139,92,246,.08);
      --purple-100: rgba(139,92,246,.15);

      --ink:    #f1f5f9;
      --ink2:   #cbd5e1;
      --muted:  #94a3b8;
      --border: #1e293b;

      --body-bg:   #0f172a;
      --card-bg:   #1e293b;
      --nav-bg:    rgba(15,23,42,.95);

      --grad-hero: linear-gradient(135deg,#1d4ed8 0%,#6d28d9 60%,#7e22ce 100%);
      --grad-btn:  linear-gradient(135deg,#2563eb 0%,#7c3aed 100%);
      --grad-body: linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#150e2b 100%);

      --shadow-sm: 0 1px 3px rgba(0,0,0,.3);
      --shadow-md: 0 4px 16px rgba(0,0,0,.3);
      --shadow-lg: 0 12px 40px rgba(0,0,0,.4);
      --shadow-xl: 0 24px 60px rgba(0,0,0,.5);

      --modal-bg: #1e293b;

      --status-active-bg: rgba(59,130,246,.12);
      --status-active-fg: #93c5fd;
      --status-done-bg:   rgba(167,139,250,.12);
      --status-done-fg:   #c4b5fd;
      --status-warn-bg:   rgba(250,204,21,.10);
      --status-warn-fg:   #fde68a;
    }

    *,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
    html { scroll-behavior:smooth; }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--grad-body);
      background-attachment: fixed;
      color: var(--ink);
      min-height: 100vh;
      transition: background .4s, color .4s;
    }

    /* ══ TOPNAV ══ */
    .topnav {
      position: sticky; top: 0; z-index: 200;
      background: var(--nav-bg);
      backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      height: 64px;
      display: flex; align-items: center; padding: 0 32px; gap: 16px;
      transition: background .4s, border-color .4s;
    }

    .nav-logo {
      font-family: 'Fraunces', serif;
      font-size: 1.75rem; font-weight: 700;
      background: var(--grad-btn);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent;
      background-clip: text;
      text-decoration: none; flex-shrink: 0; letter-spacing: -.03em;
    }

    .nav-links { display:flex; gap:2px; flex-shrink:0; }
    .nav-link {
      display: flex; align-items: center; gap: 6px;
      padding: 7px 14px; border-radius: 10px;
      font-size: .82rem; font-weight: 600; color: var(--muted);
      text-decoration: none; transition: all .2s; white-space: nowrap;
    }
    .nav-link i { font-size:.75rem; }
    .nav-link:hover { background:var(--blue-50); color:var(--blue-600); }
    [data-theme="dark"] .nav-link:hover { background:rgba(59,130,246,.1); color:#93c5fd; }
    .nav-link.active { background:var(--grad-btn); color:white; box-shadow:0 4px 12px rgba(124,58,237,.3); }

    .nav-right { margin-left:auto; display:flex; align-items:center; gap:10px; flex-shrink:0; }

    .theme-toggle {
      width: 56px; height: 30px; border-radius: 50px;
      background: var(--blue-50); border: 1.5px solid var(--border);
      position: relative; cursor: pointer;
      transition: background .35s, border-color .35s;
      flex-shrink: 0; display: flex; align-items: center; padding: 2px;
    }
    .theme-toggle:hover { border-color: var(--blue-500); }
    .toggle-thumb {
      width: 24px; height: 24px; border-radius: 50%;
      background: var(--grad-btn);
      box-shadow: 0 2px 6px rgba(0,0,0,.2);
      display: flex; align-items: center; justify-content: center;
      font-size: .75rem;
      transition: transform .38s cubic-bezier(.34,1.3,.64,1);
    }
    [data-theme="dark"]  .toggle-thumb { transform: translateX(26px); }
    [data-theme="light"] .toggle-thumb { transform: translateX(0); }
    .toggle-sun, .toggle-moon { position:absolute; font-size:.68rem; transition:opacity .3s; }
    .toggle-sun  { right:6px; }
    .toggle-moon { left:6px; }
    [data-theme="light"] .toggle-sun  { opacity:0; }
    [data-theme="light"] .toggle-moon { opacity:.4; }
    [data-theme="dark"]  .toggle-sun  { opacity:.4; }
    [data-theme="dark"]  .toggle-moon { opacity:0; }

    .nav-avatar {
      width: 36px; height: 36px; border-radius: 50%;
      background: var(--grad-btn); color: white;
      display: flex; align-items: center; justify-content: center;
      font-size: .85rem; font-weight: 700;
      cursor: pointer; flex-shrink: 0;
      box-shadow: 0 2px 10px rgba(124,58,237,.35);
      overflow: hidden; padding: 0; text-decoration: none;
    }
    .nav-logout {
      background: none; border: none; cursor: pointer;
      font-size: .82rem; color: var(--muted);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 600; padding: 7px 10px; border-radius: 8px;
      transition: all .2s; display: flex; align-items: center; gap: 4px;
    }
    .nav-logout:hover { background:rgba(239,68,68,.1); color:#ef4444; }

    .theme-transition-flash {
      position: fixed; inset: 0; z-index: 9999; pointer-events: none; opacity: 0;
      background: radial-gradient(circle at 50% 5%, white 0%, transparent 70%);
      transition: opacity .15s ease;
    }
    [data-theme="dark"] .theme-transition-flash {
      background: radial-gradient(circle at 50% 5%, #0f172a 0%, transparent 70%);
    }
    .theme-transition-flash.active { opacity:.45; }

    /* ══ PAGE ══ */
    .page { max-width: 1100px; margin: 0 auto; padding: 28px 32px 80px; }

    /* ══ FLASH ══ */
    .flash {
      display: flex; align-items: center; gap: 10px;
      padding: 11px 16px; border-radius: 12px;
      margin-bottom: 18px; font-size: .82rem; font-weight: 600;
      animation: fadeUp .4s ease;
    }
    .flash-success { background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.25); color:#15803d; }
    .flash-error   { background:rgba(239,68,68,.1);  border:1px solid rgba(239,68,68,.25);  color:#dc2626; }
    [data-theme="dark"] .flash-success { color:#4ade80; }
    [data-theme="dark"] .flash-error   { color:#f87171; }

    @keyframes fadeUp {
      from { opacity:0; transform:translateY(10px); }
      to   { opacity:1; transform:none; }
    }

    /* ══ ALERT BAR (hanya untuk batas hari ini) ══ */
    .alert-bar {
      display: flex; align-items: center; gap: 12px;
      background: linear-gradient(135deg, #fefce8, #fef9c3);
      border: 1px solid #fde047;
      border-left: 4px solid #eab308;
      border-radius: 12px;
      padding: 14px 18px;
      margin-bottom: 24px;
      font-size: .83rem; color: var(--ink2);
      animation: fadeUp .4s ease both;
    }
    .alert-bar i { color:#a16207; font-size:1.1rem; flex-shrink:0; }
    [data-theme="dark"] .alert-bar {
      background: linear-gradient(135deg, rgba(161,98,7,.15), rgba(161,98,7,.08));
      border-color: rgba(250,204,21,.3); border-left-color:#eab308;
    }
    [data-theme="dark"] .alert-bar i { color:#fde68a; }

    /* ══ INFO BAR (auto-return) ══ */
    .info-bar {
      display: flex; align-items: center; gap: 12px;
      background: var(--blue-50); border: 1px solid var(--blue-100);
      border-left: 4px solid var(--blue-500);
      border-radius: 12px; padding: 12px 18px;
      margin-bottom: 24px; font-size: .8rem; color: var(--ink2);
    }
    .info-bar i { color:var(--blue-500); font-size:1rem; flex-shrink:0; }
    [data-theme="dark"] .info-bar { background:rgba(59,130,246,.08); border-color:rgba(59,130,246,.2); border-left-color:var(--blue-500); }

    /* ══ PAGE HEADER ══ */
    .page-header {
      background: var(--grad-hero);
      border-radius: 24px; padding: 40px 48px;
      margin-bottom: 28px; position: relative; overflow: hidden;
      display: flex; align-items: center; justify-content: space-between; gap: 28px;
      box-shadow: var(--shadow-xl);
    }
    .page-header::before {
      content: ''; position: absolute; inset: 0;
      background:
        radial-gradient(ellipse at 80% 40%, rgba(251,191,36,.15) 0%, transparent 55%),
        radial-gradient(ellipse at 5%  80%, rgba(96,165,250,.2)  0%, transparent 45%);
    }
    .ph-deco-circle  { position:absolute; right:-80px; top:-80px; width:300px; height:300px; border-radius:50%; background:rgba(255,255,255,.06); pointer-events:none; }
    .ph-deco-circle2 { position:absolute; right:180px; bottom:-100px; width:200px; height:200px; border-radius:50%; background:rgba(255,255,255,.04); pointer-events:none; }

    .ph-left { position:relative; z-index:1; }

    .ph-eyebrow {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.2);
      border-radius: 50px; padding: 5px 14px;
      font-size: .62rem; font-weight: 700; letter-spacing: .18em; text-transform: uppercase;
      color: rgba(255,255,255,.9); margin-bottom: 14px;
    }
    .ph-eyebrow-dot { width:5px; height:5px; border-radius:50%; background:#fbbf24; animation:pulse 2s infinite; }
    @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.7)} }

    .ph-title {
      font-family: 'Fraunces', serif;
      font-size: clamp(1.8rem, 3vw, 2.8rem);
      font-weight: 600; color: white; line-height: 1.1; margin-bottom: 12px;
    }
    .ph-title em { font-style:italic; color:#fde68a; }
    .ph-sub { font-size:.83rem; color:rgba(255,255,255,.65); font-weight:400; line-height:1.7; max-width:440px; }
    .ph-sub strong { color:white; font-weight:700; }

    .ph-right { position:relative; z-index:1; flex-shrink:0; }
    .ph-btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 11px 22px; border-radius: 50px;
      background: rgba(255,255,255,.15);
      border: 1.5px solid rgba(255,255,255,.25);
      color: white; font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .82rem; font-weight: 700;
      text-decoration: none; transition: all .2s;
      backdrop-filter: blur(6px);
    }
    .ph-btn:hover { background:rgba(255,255,255,.28); border-color:rgba(255,255,255,.4); }

    /* ══ SUMMARY STRIP — 3 kartu saja ══ */
    .summary-strip {
      display: grid; grid-template-columns: repeat(3,1fr); gap: 12px;
      margin-bottom: 28px;
    }
    .sum-card {
      background: var(--card-bg); border: 1px solid var(--border);
      border-radius: 18px; padding: 18px 20px;
      position: relative; overflow: hidden;
      transition: transform .2s, box-shadow .2s;
      text-align: center; box-shadow: var(--shadow-sm);
    }
    .sum-card:hover { transform:translateY(-3px); box-shadow:var(--shadow-lg); }
    .sum-card::after {
      content: ''; position: absolute; bottom: 0; left: 0; right: 0;
      height: 3px; border-radius: 0 0 18px 18px;
    }
    .sum-card:nth-child(1)::after { background:var(--grad-btn); }
    .sum-card:nth-child(2)::after { background:linear-gradient(90deg,#3b82f6,#06b6d4); }
    .sum-card:nth-child(3)::after { background:linear-gradient(90deg,#8b5cf6,#a855f7); }

    .sum-icon {
      width: 38px; height: 38px; border-radius: 11px;
      display: flex; align-items: center; justify-content: center;
      font-size: .9rem; margin: 0 auto 10px;
    }
    .sum-icon.blue   { background:var(--blue-50);   color:var(--blue-600); }
    .sum-icon.cyan   { background:rgba(6,182,212,.08); color:#0891b2; }
    .sum-icon.purple { background:var(--purple-50);  color:var(--purple-600); }
    [data-theme="dark"] .sum-icon.cyan { color:#22d3ee; }

    .sum-num {
      font-family: 'Fraunces', serif;
      font-size: 2.2rem; font-weight: 700; color: var(--ink);
      line-height: 1; margin-bottom: 4px;
    }
    .sum-label { font-size: .68rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing:.06em; }

    /* ══ TOOLBAR ══ */
    .toolbar { display:flex; align-items:center; gap:10px; margin-bottom:16px; flex-wrap:wrap; }

    .toolbar-search {
      display: flex; align-items: center; gap: 8px;
      background: var(--card-bg); border: 1.5px solid var(--border);
      border-radius: 50px; padding: 8px 16px;
      flex: 1; max-width: 320px; transition: all .22s;
      box-shadow: var(--shadow-sm);
    }
    .toolbar-search:focus-within { border-color:var(--blue-500); box-shadow:0 0 0 3px rgba(59,130,246,.13); }
    .toolbar-search i { color:var(--muted); font-size:.8rem; transition:color .2s; }
    .toolbar-search:focus-within i { color:var(--blue-500); }
    .toolbar-search input { border:none; background:transparent; outline:none; font-family:'Plus Jakarta Sans',sans-serif; font-size:.82rem; color:var(--ink); flex:1; }
    .toolbar-search input::placeholder { color:var(--muted); }

    .toolbar-select {
      background: var(--card-bg); border: 1.5px solid var(--border);
      border-radius: 50px; padding: 8px 30px 8px 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .77rem; font-weight: 600; color: var(--ink);
      cursor: pointer; outline: none; transition: border-color .2s;
      appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2.5'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat; background-position: right 10px center;
      box-shadow: var(--shadow-sm);
    }
    .toolbar-select:focus { border-color:var(--blue-500); }

    .toolbar-spacer { flex:1; }

    .export-btn {
      display: inline-flex; align-items: center; gap: 7px;
      padding: 8px 18px; border-radius: 50px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .78rem; font-weight: 700;
      border: 1.5px solid var(--border);
      background: var(--card-bg); color: var(--ink2);
      cursor: pointer; transition: all .2s; box-shadow:var(--shadow-sm);
    }
    .export-btn:hover { background:var(--grad-btn); color:white; border-color:transparent; box-shadow:0 4px 14px rgba(124,58,237,.3); }

    /* ══ STATUS TABS — hanya Semua, Aktif, Selesai ══ */
    .status-tabs {
      display: flex; gap: 4px;
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 14px; padding: 4px;
      margin-bottom: 20px;
      width: fit-content;
      box-shadow: var(--shadow-sm);
    }
    .status-tab {
      padding: 7px 18px; border-radius: 10px; border: none;
      background: transparent;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .78rem; font-weight: 600; color: var(--muted);
      cursor: pointer; transition: all .2s;
      display: flex; align-items: center; gap: 6px;
    }
    .status-tab:hover { color:var(--ink); }
    .status-tab.active { background:var(--grad-btn); color:white; box-shadow:0 3px 10px rgba(124,58,237,.3); }

    .tab-count {
      font-size: .62rem; font-weight: 800;
      background: rgba(255,255,255,.25); color: white;
      padding: 1px 6px; border-radius: 50px;
      min-width: 18px; text-align: center;
    }
    .status-tab:not(.active) .tab-count {
      background: var(--border); color: var(--muted);
    }

    /* ══ TABLE ══ */
    .table-wrap {
      background: var(--card-bg); border: 1px solid var(--border);
      border-radius: 20px; overflow: hidden;
      box-shadow: var(--shadow-md);
    }
    table { width:100%; border-collapse:collapse; }
    thead {
      background: linear-gradient(135deg, var(--blue-50) 0%, var(--purple-50) 100%);
      border-bottom: 1px solid var(--border);
    }
    [data-theme="dark"] thead { background: rgba(30,41,59,.8); }

    thead th {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .64rem; font-weight: 800;
      letter-spacing: .12em; text-transform: uppercase;
      color: var(--muted); padding: 14px 18px;
      text-align: left; white-space: nowrap;
    }
    thead th.center { text-align:center; }
    thead th i { margin-right:5px; font-size:.62rem; color:var(--blue-500); }

    tbody tr { border-bottom:1px solid var(--border); transition:background .15s; }
    tbody tr:last-child { border-bottom:none; }
    tbody tr:hover { background:var(--blue-50); }
    [data-theme="dark"] tbody tr:hover { background:rgba(59,130,246,.05); }

    td { padding:14px 18px; vertical-align:middle; }

    .td-book { display:flex; align-items:center; gap:12px; }
    .td-cover {
      width: 36px; height: 52px;
      border-radius: 3px 8px 8px 3px;
      flex-shrink: 0; object-fit: cover;
      box-shadow: -2px 3px 10px rgba(37,99,235,.15);
      background: var(--grad-btn);
      display: flex; align-items: center; justify-content: center;
      font-size: 1rem; color: white; overflow: hidden;
    }
    .td-cover img { width:100%; height:100%; object-fit:cover; }
    .td-judul {
      font-size: .88rem; font-weight: 700; color: var(--ink);
      margin-bottom: 2px; line-height: 1.3; max-width: 220px;
      display: -webkit-box; -webkit-line-clamp: 2;
      -webkit-box-orient: vertical; overflow: hidden;
    }
    .td-penulis { font-size: .72rem; color: var(--muted); }

    .td-date { font-size:.82rem; font-weight:600; color:var(--ink2); white-space:nowrap; }
    .td-date-sub { font-size:.7rem; color:var(--muted); margin-top:2px; }

    .td-dur { font-size:.82rem; font-weight:600; color:var(--ink2); text-align:center; }
    .td-dur small { display:block; font-size:.68rem; color:var(--muted); font-weight:400; }

    /* ══ STATUS BADGES — hanya aktif, segera, selesai ══ */
    .badge {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 5px 12px; border-radius: 50px;
      font-size: .71rem; font-weight: 700;
      letter-spacing: .03em; white-space: nowrap;
    }
    .badge i { font-size:.62rem; }
    .badge-aktif {
      background: var(--status-active-bg); color: var(--status-active-fg);
      border: 1px solid rgba(37,99,235,.2);
    }
    .badge-selesai {
      background: var(--status-done-bg); color: var(--status-done-fg);
      border: 1px solid rgba(124,58,237,.2);
    }
    .badge-segera {
      background: var(--status-warn-bg); color: var(--status-warn-fg);
      border: 1px solid rgba(234,179,8,.3);
    }

    /* Progress bar */
    .sisa-bar { width:80px; height:4px; background:var(--border); border-radius:4px; overflow:hidden; margin-top:5px; }
    .sisa-fill { height:100%; border-radius:4px; }
    .sisa-fill.ok   { background:linear-gradient(90deg,#3b82f6,#8b5cf6); }
    .sisa-fill.warn { background:#eab308; }

    .td-actions { text-align:center; }
    .action-btn {
      display: inline-flex; align-items: center; gap: 5px;
      padding: 5px 12px; border-radius: 50px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .72rem; font-weight: 700;
      border: 1.5px solid var(--border);
      background: transparent; color: var(--muted);
      cursor: pointer; transition: all .2s; text-decoration: none;
    }
    .action-btn:hover { background:var(--ink); color:white; border-color:var(--ink); }
    .action-btn.primary { background:var(--grad-btn); color:white; border-color:transparent; box-shadow:0 3px 10px rgba(124,58,237,.3); }
    .action-btn.primary:hover { filter:brightness(1.1); transform:translateY(-1px); }

    /* Detail row */
    .detail-row td { padding:0; background: var(--blue-50); }
    [data-theme="dark"] .detail-row td { background: rgba(59,130,246,.04); }
    .detail-inner {
      padding: 16px 18px 16px 66px;
      display: grid; grid-template-columns: repeat(4,1fr); gap: 16px;
    }
    .detail-label {
      font-size: .6rem; font-weight: 800;
      letter-spacing: .1em; text-transform: uppercase;
      color: var(--muted); margin-bottom: 3px;
    }
    .detail-val { font-size:.82rem; font-weight:600; color:var(--ink2); }

    /* Empty state */
    .empty-table { text-align:center; padding:60px 20px; display:none; }
    .empty-table.show { display:block; }
    .empty-table .es-icon { font-size:3.5rem; margin-bottom:14px; opacity:.3; }
    .empty-table .es-title { font-size:1rem; font-weight:700; color:var(--ink); margin-bottom:6px; }
    .empty-table .es-sub { font-size:.82rem; color:var(--muted); line-height:1.6; }

    .pagination-wrap { display:flex; align-items:center; justify-content:space-between; padding:16px 20px 0; flex-wrap:wrap; gap:10px; }

    /* ══ MODAL ══ */
    .modal-overlay {
      display: none; position: fixed; inset: 0; z-index: 500;
      background: rgba(15,23,42,.65);
      backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
      align-items: center; justify-content: center; padding: 20px;
    }
    .modal-overlay.show { display:flex; }
    .modal-box {
      background: var(--modal-bg); border-radius: 24px;
      max-width: 420px; width: 100%;
      box-shadow: var(--shadow-xl); overflow: hidden;
      animation: popIn .28s cubic-bezier(.34,1.4,.64,1);
    }
    @keyframes popIn { from{opacity:0;transform:scale(.9)} to{opacity:1;transform:scale(1)} }
    .modal-strip { height:4px; background:var(--grad-btn); }
    .modal-body { padding:28px; }
    .modal-icon {
      width: 52px; height: 52px; border-radius: 14px;
      background: var(--blue-50); color: var(--blue-600);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem; margin-bottom: 16px;
    }
    .modal-title-text { font-size:1.1rem; font-weight:800; color:var(--ink); margin-bottom:6px; }
    .modal-desc { font-size:.83rem; color:var(--muted); line-height:1.6; margin-bottom:20px; }

    .modal-book-preview {
      display: flex; gap: 12px; align-items: center;
      background: var(--blue-50); border-radius: 14px;
      padding: 12px 14px; margin-bottom: 22px;
      border: 1px solid var(--blue-100);
    }
    [data-theme="dark"] .modal-book-preview { background:rgba(59,130,246,.08); border-color:rgba(59,130,246,.15); }
    .modal-book-cover {
      width: 36px; height: 52px; border-radius: 3px 8px 8px 3px;
      background: var(--grad-btn); display: flex; align-items: center;
      justify-content: center; font-size: 1.1rem; flex-shrink: 0; overflow: hidden;
    }
    .modal-book-title { font-size:.88rem; font-weight:700; color:var(--ink); }
    .modal-book-sub { font-size:.73rem; color:var(--muted); margin-top:2px; }
    .modal-btns { display:flex; gap:10px; }
    .modal-btn {
      flex: 1; padding: 11px 20px; border-radius: 50px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .82rem; font-weight: 700; cursor: pointer;
      transition: all .2s; display: flex; align-items: center;
      justify-content: center; gap: 7px; text-decoration: none;
    }
    .modal-btn-cancel {
      background: var(--card-bg); color: var(--muted);
      border: 1.5px solid var(--border);
    }
    .modal-btn-cancel:hover { background:var(--blue-50); color:var(--blue-600); border-color:var(--blue-500); }
    .modal-btn-confirm {
      background: var(--grad-btn); color: white; border: none;
      box-shadow: 0 4px 14px rgba(124,58,237,.3);
    }
    .modal-btn-confirm:hover { filter:brightness(1.1); transform:translateY(-1px); }

    /* ══ RESPONSIVE ══ */
    @media (max-width:1000px) {
      .summary-strip { grid-template-columns:repeat(3,1fr); }
      .detail-inner  { grid-template-columns:repeat(2,1fr); }
    }
    @media (max-width:680px) {
      .topnav       { padding:0 16px; height:58px; }
      .nav-links    { display:none; }
      .page         { padding:20px 16px 60px; }
      .page-header  { padding:28px 24px; flex-direction:column; gap:16px; }
      .summary-strip { grid-template-columns:repeat(3,1fr); }
      .toolbar-search { max-width:100%; }
      .td-judul     { max-width:150px; }
      .detail-inner { grid-template-columns:1fr 1fr; }
      .ph-title     { font-size:1.9rem; }
      .ph-right     { width:100%; }
      .ph-btn       { width:100%; justify-content:center; }
    }
    @media (max-width:480px) {
      .summary-strip { grid-template-columns:1fr 1fr; }
    }
  </style>
</head>

<body>
  <div class="theme-transition-flash" id="themeFlash"></div>

  <!-- TOP NAV -->
  <nav class="topnav">
    <a href="{{ route('anggota.dashboard') }}" class="nav-logo">LibCo</a>
    <div class="nav-links">
      <a href="{{ route('anggota.dashboard') }}"         class="nav-link"><i class="fas fa-home"></i> Beranda</a>
      <a href="{{ route('anggota.koleksi.index') }}"     class="nav-link"><i class="fas fa-book-open"></i> Koleksi</a>
      <a href="{{ route('anggota.peminjaman.index') }}"  class="nav-link active"><i class="fas fa-history"></i> Riwayat</a>
      <a href="{{ route('anggota.profile.show') }}"      class="nav-link"><i class="fas fa-user"></i> Profil</a>
    </div>
    <div class="nav-right">
      <button class="theme-toggle" id="themeToggle" title="Ganti tema">
        <span class="toggle-moon">🌙</span>
        <div class="toggle-thumb"><span id="toggleEmoji">☀️</span></div>
        <span class="toggle-sun">☀️</span>
      </button>
      <a href="{{ route('anggota.profile.show') }}" class="nav-avatar" title="{{ auth()->user()->name }}">
        @if(auth()->user()->anggota?->foto)
          <img src="{{ Storage::url('foto/' . auth()->user()->anggota->foto) }}" alt="{{ auth()->user()->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        @else
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        @endif
      </a>
      <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button type="submit" class="nav-logout"><i class="fas fa-sign-out-alt"></i></button>
      </form>
    </div>
  </nav>

  <div class="page">

    {{-- Flash messages --}}
    @if(session('success'))
      <div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    {{-- Info auto-return --}}
    <div class="info-bar">
      <i class="fas fa-robot"></i>
      Buku akan <strong>otomatis dikembalikan</strong> saat tanggal batas tercapai. Tidak ada denda — perpustakaan digital.
    </div>

    {{-- Alert batas hari ini / segera --}}
    @php
      $segera = $loans->where('status_peminjam', 'pinjam')
        ->filter(fn($p) =>
          \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($p->tanggal_batas), false) <= 3 &&
          \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($p->tanggal_batas), false) >= 0
        );
    @endphp

    @if($segera->count() > 0)
      <div class="alert-bar">
        <i class="fas fa-clock"></i>
        <span><strong>{{ $segera->count() }} buku</strong> akan segera dikembalikan otomatis dalam 3 hari ke depan.</span>
      </div>
    @endif

    <!-- PAGE HEADER -->
    <div class="page-header">
      <div class="ph-deco-circle"></div>
      <div class="ph-deco-circle2"></div>
      <div class="ph-left">
        <div class="ph-eyebrow">
          <div class="ph-eyebrow-dot"></div>
          Anggota · {{ auth()->user()->name }}
        </div>
        <h1 class="ph-title">Riwayat <em>Peminjaman</em></h1>
        <p class="ph-sub">Semua catatan peminjaman buku kamu ada di sini. Total <strong>{{ $totalPeminjaman }} transaksi</strong> tercatat.</p>
      </div>
      <div class="ph-right">
        <a href="{{ route('anggota.koleksi.index') }}" class="ph-btn">
          <i class="fas fa-book-open"></i> Pinjam Buku Baru
        </a>
      </div>
    </div>

    <!-- SUMMARY STRIP — 3 kartu -->
    <div class="summary-strip">
      <div class="sum-card">
        <div class="sum-icon blue"><i class="fas fa-book-reader"></i></div>
        <div class="sum-num">{{ $totalPeminjaman }}</div>
        <div class="sum-label">Total Peminjaman</div>
      </div>
      <div class="sum-card">
        <div class="sum-icon cyan"><i class="fas fa-clock"></i></div>
        <div class="sum-num">{{ $totalAktif }}</div>
        <div class="sum-label">Sedang Dipinjam</div>
      </div>
      <div class="sum-card">
        <div class="sum-icon purple"><i class="fas fa-check-circle"></i></div>
        <div class="sum-num">{{ $totalSelesai }}</div>
        <div class="sum-label">Sudah Dikembalikan</div>
      </div>
    </div>

    <!-- TOOLBAR -->
    <div class="toolbar">
      <div class="toolbar-search">
        <i class="fas fa-search"></i>
        <input type="text" id="tableSearch" placeholder="Cari judul buku…">
      </div>
      <select class="toolbar-select" id="sortSelect">
        <option value="terbaru">Terbaru dulu</option>
        <option value="terlama">Terlama dulu</option>
        <option value="judul">Judul A–Z</option>
        <option value="batas">Tenggat terdekat</option>
      </select>
      <div class="toolbar-spacer"></div>
      <button class="export-btn" onclick="printTable()">
        <i class="fas fa-print"></i> Cetak
      </button>
    </div>

    <!-- STATUS TABS — hanya 3 tab -->
    <div class="status-tabs">
      <button class="status-tab active" data-tab="semua">
        Semua <span class="tab-count">{{ $totalPeminjaman }}</span>
      </button>
      <button class="status-tab" data-tab="pinjam">
        <i class="fas fa-clock" style="font-size:.7rem;"></i> Aktif
        <span class="tab-count">{{ $totalAktif }}</span>
      </button>
      <button class="status-tab" data-tab="aktif">
        <i class="fas fa-check" style="font-size:.7rem;"></i> Selesai
        <span class="tab-count">{{ $totalSelesai }}</span>
      </button>
    </div>

    <!-- TABLE -->
    <div class="table-wrap">
      <table id="riwayatTable">
        <thead>
          <tr>
            <th><i class="fas fa-book"></i> Buku</th>
            <th><i class="fas fa-calendar-plus"></i> Tanggal Pinjam</th>
            <th><i class="fas fa-calendar-times"></i> Tenggat</th>
            <th class="center"><i class="fas fa-hourglass-half"></i> Durasi</th>
            <th class="center"><i class="fas fa-tag"></i> Status</th>
            <th class="center"><i class="fas fa-ellipsis-h"></i> Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody">

          @forelse($loans->sortByDesc('tanggal_pinjam') as $loan)
            @php
              $batas  = \Carbon\Carbon::parse($loan->tanggal_batas);
              $pinjam = \Carbon\Carbon::parse($loan->tanggal_pinjam);
              $today  = \Carbon\Carbon::today();
              $durasi = $pinjam->diffInDays($batas);
              $sisa   = $today->diffInDays($batas, false);

              // Status sudah bersih: hanya 'pinjam' atau 'aktif'
              $statusKey = $loan->status_peminjam;

              $pct = $durasi > 0
                ? max(0, min(100, round(($durasi - max($sisa, 0)) / $durasi * 100)))
                : 100;
              $cls = $sisa <= 2 ? 'warn' : 'ok';
            @endphp

            <tr class="loan-row"
                data-status="{{ $statusKey }}"
                data-judul="{{ strtolower($loan->ebook->judul_buku ?? '') }}">

              <td>
                <div class="td-book">
                  <div class="td-cover">
                    @if($loan->ebook->cover)
                      <img src="{{ Storage::url($loan->ebook->cover) }}" alt="">
                    @else
                      📚
                    @endif
                  </div>
                  <div>
                    <div class="td-judul">{{ $loan->ebook->judul_buku ?? '—' }}</div>
                    <div class="td-penulis">{{ $loan->ebook->pengarang ?? '—' }}</div>
                  </div>
                </div>
              </td>

              <td>
                <div class="td-date">{{ $pinjam->translatedFormat('j M Y') }}</div>
                <div class="td-date-sub">{{ $pinjam->diffForHumans() }}</div>
              </td>

              <td>
                <div class="td-date"
                  style="{{ $sisa <= 2 && $statusKey === 'pinjam' ? 'color:#a16207' : '' }}">
                  {{ $batas->translatedFormat('j M Y') }}
                </div>
                @if($statusKey === 'pinjam')
                  <div class="sisa-bar">
                    <div class="sisa-fill {{ $cls }}" style="width:{{ $pct }}%"></div>
                  </div>
                  <div class="td-date-sub"
                    style="{{ $sisa <= 2 ? 'color:#a16207;font-weight:600' : '' }}">
                    @if($sisa === 0) Hari ini tenggat — akan dikembalikan otomatis
                    @elseif($sisa === 1) 1 hari lagi
                    @else {{ $sisa }} hari lagi
                    @endif
                  </div>
                @endif
              </td>

              <td>
                <div class="td-dur">
                  {{ $durasi }} hari
                  <small>{{ $pinjam->translatedFormat('j M') }} – {{ $batas->translatedFormat('j M') }}</small>
                </div>
              </td>

              <td style="text-align:center;">
                @if($statusKey === 'aktif')
                  <span class="badge badge-selesai"><i class="fas fa-check"></i> Selesai</span>
                @elseif($sisa <= 2)
                  <span class="badge badge-segera"><i class="fas fa-fire"></i> Segera</span>
                @else
                  <span class="badge badge-aktif"><i class="fas fa-book-open"></i> Dipinjam</span>
                @endif
              </td>

              <td class="td-actions">
                <div style="display:flex;gap:6px;justify-content:center;align-items:center;">
                  <button class="action-btn expand-btn"
                          data-target="detail-{{ $loan->id_peminjam }}"
                          title="Detail">
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  @if($statusKey === 'pinjam')
                    <button class="action-btn primary kembalikan-btn"
                            data-id="{{ $loan->id_peminjam }}"
                            data-judul="{{ $loan->ebook->judul_buku ?? '—' }}"
                            data-penulis="{{ $loan->ebook->pengarang ?? '—' }}"
                            data-cover="{{ $loan->ebook->cover ? Storage::url($loan->ebook->cover) : '' }}"
                            data-action="{{ route('anggota.kembalikan', $loan->id_peminjam) }}">
                      <i class="fas fa-undo-alt"></i> Kembalikan
                    </button>
                  @endif
                </div>
              </td>
            </tr>

            <tr class="detail-row" id="detail-{{ $loan->id_peminjam }}" style="display:none;">
              <td colspan="6">
                <div class="detail-inner">
                  <div>
                    <div class="detail-label">ID Peminjaman</div>
                    <div class="detail-val">#{{ str_pad($loan->id_peminjam, 5, '0', STR_PAD_LEFT) }}</div>
                  </div>
                  <div>
                    <div class="detail-label">Kategori Buku</div>
                    <div class="detail-val">{{ $loan->ebook->kategori->nama_kategori ?? '—' }}</div>
                  </div>
                  <div>
                    <div class="detail-label">Dipinjam Sejak</div>
                    <div class="detail-val">{{ $pinjam->translatedFormat('l, j F Y') }}</div>
                  </div>
                  <div>
                    <div class="detail-label">Tenggat Pengembalian</div>
                    <div class="detail-val">{{ $batas->translatedFormat('l, j F Y') }}</div>
                  </div>
                  @if($statusKey === 'aktif')
                    <div>
                      <div class="detail-label">Tanggal Kembali</div>
                      <div class="detail-val">
                        {{ $loan->tanggal_kembali
                            ? \Carbon\Carbon::parse($loan->tanggal_kembali)->translatedFormat('j F Y')
                            : $batas->translatedFormat('j F Y') }}
                      </div>
                    </div>
                  @endif
                  <div>
                    <div class="detail-label">Keterangan</div>
                    <div class="detail-val" style="color:var(--blue-600);font-size:.78rem;">
                      <i class="fas fa-robot"></i> Otomatis dikembalikan saat tenggat — tidak ada denda
                    </div>
                  </div>
                </div>
              </td>
            </tr>

          @empty
            <tr>
              <td colspan="6">
                <div class="empty-table show">
                  <div class="es-icon">📭</div>
                  <div class="es-title">Belum ada peminjaman</div>
                  <div class="es-sub">Kamu belum pernah meminjam buku.<br>Yuk mulai jelajahi koleksi kami!</div>
                </div>
              </td>
            </tr>
          @endforelse

        </tbody>
      </table>

      <div class="empty-table" id="emptySearch">
        <div class="es-icon">🔍</div>
        <div class="es-title">Tidak ada hasil</div>
        <div class="es-sub" id="emptySearchText">Tidak ada buku yang cocok dengan pencarianmu.</div>
      </div>

      <div class="pagination-wrap">
        {{ $loans->links() }}
      </div>
    </div>

  </div><!-- /.page -->

  <!-- MODAL KEMBALIKAN -->
  <div class="modal-overlay" id="kembalikanModal">
    <div class="modal-box">
      <div class="modal-strip"></div>
      <div class="modal-body">
        <div class="modal-icon"><i class="fas fa-undo-alt"></i></div>
        <div class="modal-title-text">Kembalikan Buku?</div>
        <p class="modal-desc">
          Pastikan kamu sudah selesai membaca. Setelah dikembalikan, slot akan tersedia untuk anggota lain.
        </p>
        <div class="modal-book-preview">
          <div class="modal-book-cover" id="modalCoverEl">📚</div>
          <div>
            <div class="modal-book-title" id="modalJudulEl">—</div>
            <div class="modal-book-sub" id="modalPenulisEl">—</div>
          </div>
        </div>
        <form id="modalKembalikanForm" method="POST">
          @csrf
          <div class="modal-btns">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="tutupModal()">
              <i class="fas fa-times"></i> Batal
            </button>
            <button type="submit" class="modal-btn modal-btn-confirm">
              <i class="fas fa-check"></i> Ya, Kembalikan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    /* ══ THEME ══ */
    const html        = document.documentElement,
          themeToggle = document.getElementById('themeToggle'),
          toggleEmoji = document.getElementById('toggleEmoji'),
          themeFlash  = document.getElementById('themeFlash');

    const savedTheme = localStorage.getItem('libco-theme') || 'light';
    applyTheme(savedTheme, false);

    function applyTheme(theme, animate) {
      if (animate) {
        themeFlash.classList.add('active');
        setTimeout(() => themeFlash.classList.remove('active'), 300);
      }
      html.setAttribute('data-theme', theme);
      toggleEmoji.textContent = theme === 'dark' ? '🌙' : '☀️';
      localStorage.setItem('libco-theme', theme);
    }
    themeToggle.addEventListener('click', () => {
      applyTheme(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark', true);
    });

    /* ══ STATUS TABS ══ */
    const tabs = document.querySelectorAll('.status-tab');
    let activeTab = 'semua', activeSearch = '';

    function applyFilters() {
      const loanRows = document.querySelectorAll('.loan-row');
      let visible = 0;
      loanRows.forEach(row => {
        const status    = row.dataset.status || '';
        const judul     = row.dataset.judul  || '';
        const detailId  = row.querySelector('.expand-btn')?.dataset.target;
        const detailRow = detailId ? document.getElementById(detailId) : null;
        const tabOk    = activeTab === 'semua' || status === activeTab;
        const searchOk = !activeSearch || judul.includes(activeSearch);
        const show     = tabOk && searchOk;
        row.style.display = show ? '' : 'none';
        if (detailRow) detailRow.style.display = 'none';
        if (show) visible++;
      });
      const emptyEl = document.getElementById('emptySearch');
      if (visible === 0) {
        emptyEl.classList.add('show');
        document.getElementById('emptySearchText').textContent = activeSearch
          ? `Tidak ada buku "${activeSearch}" ditemukan.`
          : 'Tidak ada data pada kategori ini.';
      } else {
        emptyEl.classList.remove('show');
      }
    }

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        activeTab = tab.dataset.tab;
        applyFilters();
      });
    });

    document.getElementById('tableSearch').addEventListener('input', function () {
      activeSearch = this.value.trim().toLowerCase();
      applyFilters();
    });

    /* ══ EXPAND ROWS ══ */
    document.querySelectorAll('.expand-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId  = btn.dataset.target;
        const targetRow = document.getElementById(targetId);
        if (!targetRow) return;
        const isOpen = targetRow.style.display !== 'none';
        document.querySelectorAll('.detail-row').forEach(r => r.style.display = 'none');
        document.querySelectorAll('.expand-btn i').forEach(i => i.className = 'fas fa-chevron-down');
        if (!isOpen) {
          targetRow.style.display = '';
          btn.querySelector('i').className = 'fas fa-chevron-up';
        }
      });
    });

    /* ══ MODAL ══ */
    document.querySelectorAll('.kembalikan-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('modalJudulEl').textContent  = btn.dataset.judul;
        document.getElementById('modalPenulisEl').textContent = btn.dataset.penulis;
        document.getElementById('modalKembalikanForm').action = btn.dataset.action;
        const coverEl = document.getElementById('modalCoverEl');
        coverEl.innerHTML = btn.dataset.cover
          ? `<img src="${btn.dataset.cover}" style="width:100%;height:100%;object-fit:cover;border-radius:3px 8px 8px 3px;">`
          : '📚';
        document.getElementById('kembalikanModal').classList.add('show');
        document.body.style.overflow = 'hidden';
      });
    });

    function tutupModal() {
      document.getElementById('kembalikanModal').classList.remove('show');
      document.body.style.overflow = '';
    }
    document.getElementById('kembalikanModal').addEventListener('click', function (e) { if (e.target === this) tutupModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') tutupModal(); });

    /* ══ PRINT ══ */
    function printTable() { window.print(); }

    /* ══ SORT ══ */
    document.getElementById('sortSelect').addEventListener('change', function () {
      const tbody    = document.getElementById('tableBody');
      const loanRows = Array.from(tbody.querySelectorAll('.loan-row'));
      const rowPairs = loanRows.map(r => {
        const detailId  = r.querySelector('.expand-btn')?.dataset.target;
        const detailRow = detailId ? tbody.querySelector('#' + detailId) : null;
        return { loan: r, detail: detailRow };
      });
      rowPairs.sort((a, b) => {
        switch (this.value) {
          case 'terbaru': return (b.loan.querySelector('.td-date')?.textContent || '').localeCompare(a.loan.querySelector('.td-date')?.textContent || '');
          case 'terlama': return (a.loan.querySelector('.td-date')?.textContent || '').localeCompare(b.loan.querySelector('.td-date')?.textContent || '');
          case 'judul':   return (a.loan.dataset.judul || '').localeCompare(b.loan.dataset.judul || '');
          default: return 0;
        }
      });
      rowPairs.forEach(pair => {
        tbody.appendChild(pair.loan);
        if (pair.detail) tbody.appendChild(pair.detail);
      });
    });
  </script>
</body>
</html>