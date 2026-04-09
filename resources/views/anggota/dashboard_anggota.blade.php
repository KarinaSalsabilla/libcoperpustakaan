{{-- dashboard_anggota --}}

<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>LibCo — Ruang Baca</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    /* ════════════════════════════════════════════
       CSS VARIABLES — Light & Dark
    ════════════════════════════════════════════ */
    :root,
    [data-theme="light"] {
      --blue-50: #eff6ff;
      --blue-100: #dbeafe;
      --blue-500: #3b82f6;
      --blue-600: #2563eb;
      --blue-700: #1d4ed8;
      --purple-50: #faf5ff;
      --purple-100: #ede9fe;
      --purple-400: #a78bfa;
      --purple-500: #8b5cf6;
      --purple-600: #7c3aed;
      --purple-700: #6d28d9;
      --orange-400: #fb923c;
      --orange-500: #f97316;
      --orange-600: #ea580c;

      --ink: #111827;
      --ink2: #374151;
      --muted: #6b7280;
      --border: #e5e7eb;
      --body-bg: #f0f4ff;
      --card-bg: #ffffff;
      --nav-bg: rgba(255, 255, 255, 0.92);
      --chip-bg: #ffffff;
      --search-bg: #ffffff;

      --grad-hero: linear-gradient(135deg, #2563eb 0%, #7c3aed 60%, #9333ea 100%);
      --grad-btn: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      --grad-body: linear-gradient(135deg, #eff6ff 0%, #ede9fe 50%, #faf5ff 100%);
      --grad-cta: linear-gradient(135deg, #1d4ed8 0%, #7c3aed 100%);

      --shadow-sm: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
      --shadow-md: 0 4px 16px rgba(37, 99, 235, .10);
      --shadow-lg: 0 12px 40px rgba(37, 99, 235, .15);
      --shadow-xl: 0 24px 60px rgba(37, 99, 235, .18);

      --stat-1: linear-gradient(135deg, #3b82f6, #2563eb);
      --stat-2: linear-gradient(135deg, #8b5cf6, #7c3aed);
      --stat-3: linear-gradient(135deg, #f97316, #ea580c);
      --stat-4: linear-gradient(135deg, #06b6d4, #0284c7);

      --modal-bg: #ffffff;
      --modal-overlay: rgba(17, 24, 39, 0.65);
      --ticker-bg: #1e1b4b;
      --hist-bg: linear-gradient(135deg, #1d4ed8, #7c3aed);
      --quote-bg: linear-gradient(135deg, #eff6ff, #ede9fe);
      --toggle-track: #e0e7ff;
    }

    [data-theme="dark"] {
      --ink: #f1f5f9;
      --ink2: #cbd5e1;
      --muted: #94a3b8;
      --border: #1e293b;
      --body-bg: #0f172a;
      --card-bg: #1e293b;
      --nav-bg: rgba(15, 23, 42, 0.95);
      --chip-bg: #1e293b;
      --search-bg: #1e293b;

      --grad-hero: linear-gradient(135deg, #1d4ed8 0%, #6d28d9 60%, #7e22ce 100%);
      --grad-btn: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
      --grad-body: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #150e2b 100%);
      --grad-cta: linear-gradient(135deg, #1e3a8a 0%, #581c87 100%);

      --shadow-sm: 0 1px 3px rgba(0, 0, 0, .3);
      --shadow-md: 0 4px 16px rgba(0, 0, 0, .3);
      --shadow-lg: 0 12px 40px rgba(0, 0, 0, .4);
      --shadow-xl: 0 24px 60px rgba(0, 0, 0, .5);

      --modal-bg: #1e293b;
      --modal-overlay: rgba(0, 0, 0, 0.8);
      --ticker-bg: #0f172a;
      --hist-bg: linear-gradient(135deg, #1e3a8a, #4c1d95);
      --quote-bg: linear-gradient(135deg, #1e293b, #1e1b4b);
      --toggle-track: #1e1b4b;

      --stat-1: linear-gradient(135deg, #1d4ed8, #2563eb);
      --stat-2: linear-gradient(135deg, #6d28d9, #7c3aed);
      --stat-3: linear-gradient(135deg, #c2410c, #ea580c);
      --stat-4: linear-gradient(135deg, #0e7490, #0284c7);
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--grad-body);
      background-attachment: fixed;
      color: var(--ink);
      min-height: 100vh;
      transition: background .4s ease, color .4s ease;
    }

    /* ════════════════════════════════════════════
       TOPNAV
    ════════════════════════════════════════════ */
    .topnav {
      position: sticky;
      top: 0;
      z-index: 200;
      background: var(--nav-bg);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border);
      height: 64px;
      display: flex;
      align-items: center;
      padding: 0 32px;
      gap: 16px;
      transition: background .4s, border-color .4s;
    }

    .nav-logo {
      font-family: 'Fraunces', serif;
      font-size: 1.75rem;
      font-weight: 700;
      background: var(--grad-btn);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-decoration: none;
      flex-shrink: 0;
      letter-spacing: -.03em;
    }

    .nav-links {
      display: flex;
      gap: 2px;
      flex-shrink: 0;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      border-radius: 10px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--muted);
      text-decoration: none;
      transition: all .2s;
      white-space: nowrap;
    }

    .nav-link:hover {
      background: var(--blue-50);
      color: var(--blue-600);
    }

    [data-theme="dark"] .nav-link:hover {
      background: rgba(59, 130, 246, .1);
      color: #93c5fd;
    }

    .nav-link.active {
      background: var(--grad-btn);
      color: white;
      box-shadow: 0 4px 12px rgba(124, 58, 237, .3);
    }

    .nav-link i {
      font-size: .75rem;
    }

    /* Centered search */
    .nav-search-wrap {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      max-width: 460px;
      z-index: 10;
    }

    .nav-search-box {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--search-bg);
      border: 1.5px solid var(--border);
      border-radius: 50px;
      padding: 8px 16px;
      transition: all .25s;
      box-shadow: var(--shadow-sm);
    }

    .nav-search-box:focus-within {
      border-color: var(--blue-500);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, .15);
    }

    .nav-search-box i.search-icon {
      color: var(--muted);
      font-size: .82rem;
      flex-shrink: 0;
      transition: color .2s;
    }

    .nav-search-box:focus-within i.search-icon {
      color: var(--blue-500);
    }

    .nav-search-box input {
      flex: 1;
      border: none;
      background: transparent;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .83rem;
      color: var(--ink);
      outline: none;
    }

    .nav-search-box input::placeholder {
      color: var(--muted);
    }

    .search-clear {
      background: none;
      border: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      cursor: pointer;
      display: none;
      align-items: center;
      justify-content: center;
      font-size: .65rem;
      color: var(--muted);
      transition: all .2s;
      flex-shrink: 0;
    }

    .search-clear:hover {
      background: #ef4444;
      color: white;
    }

    .search-clear.visible {
      display: flex;
    }

    .nav-search-divider {
      width: 1px;
      height: 14px;
      background: var(--border);
      flex-shrink: 0;
    }

    .nav-search-btn {
      background: var(--grad-btn);
      color: white;
      border: none;
      border-radius: 50px;
      padding: 5px 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .74rem;
      font-weight: 700;
      cursor: pointer;
      transition: all .2s;
      flex-shrink: 0;
      box-shadow: 0 2px 8px rgba(124, 58, 237, .3);
    }

    .nav-search-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 14px rgba(124, 58, 237, .4);
    }

    /* Search dropdown */
    .search-dropdown {
      position: absolute;
      top: calc(100% + 8px);
      left: 0;
      right: 0;
      background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: 16px;
      box-shadow: var(--shadow-xl);
      z-index: 200;
      display: none;
      max-height: 380px;
      overflow-y: auto;
    }

    .search-dropdown.show {
      display: block;
    }

    .search-dropdown-header {
      padding: 10px 16px 6px;
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
      border-bottom: 1px solid var(--border);
    }

    .search-result-item {
      display: flex;
      gap: 12px;
      align-items: center;
      padding: 10px 16px;
      cursor: pointer;
      transition: background .15s;
      text-decoration: none;
      color: inherit;
    }

    .search-result-item:hover {
      background: var(--blue-50);
    }

    [data-theme="dark"] .search-result-item:hover {
      background: rgba(59, 130, 246, .08);
    }

    .search-result-cover {
      width: 32px;
      height: 46px;
      border-radius: 4px;
      flex-shrink: 0;
      object-fit: cover;
      background: var(--grad-btn);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .9rem;
      color: white;
      box-shadow: var(--shadow-sm);
    }

    .search-result-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 4px;
    }

    .search-result-info {
      flex: 1;
      min-width: 0;
    }

    .search-result-title {
      font-size: .84rem;
      font-weight: 600;
      color: var(--ink);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 2px;
    }

    .search-result-title mark {
      background: rgba(139, 92, 246, .18);
      color: var(--purple-600);
      border-radius: 2px;
      padding: 0 2px;
    }

    .search-result-sub {
      font-size: .71rem;
      color: var(--muted);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .search-result-kat {
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .07em;
      text-transform: uppercase;
      color: var(--purple-600);
      background: var(--purple-100);
      padding: 2px 8px;
      border-radius: 4px;
      flex-shrink: 0;
    }

    [data-theme="dark"] .search-result-kat {
      color: #c4b5fd;
      background: rgba(139, 92, 246, .2);
    }

    .search-no-result {
      padding: 24px 16px;
      text-align: center;
      font-size: .83rem;
      color: var(--muted);
    }

    .search-no-result i {
      font-size: 1.5rem;
      display: block;
      margin-bottom: 8px;
      opacity: .4;
    }

    /* Theme toggle */
    .theme-toggle {
      width: 56px;
      height: 30px;
      border-radius: 50px;
      background: var(--toggle-track);
      border: 1.5px solid var(--border);
      position: relative;
      cursor: pointer;
      transition: background .35s, border-color .35s;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      padding: 2px;
    }

    .theme-toggle:hover {
      border-color: var(--blue-500);
    }

    .toggle-thumb {
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background: var(--grad-btn);
      box-shadow: 0 2px 6px rgba(0, 0, 0, .2);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .75rem;
      transition: transform .38s cubic-bezier(.34, 1.3, .64, 1);
    }

    [data-theme="dark"] .toggle-thumb {
      transform: translateX(26px);
    }

    [data-theme="light"] .toggle-thumb {
      transform: translateX(0);
    }

    .toggle-sun,
    .toggle-moon {
      position: absolute;
      font-size: .68rem;
      transition: opacity .3s;
    }

    .toggle-sun {
      right: 6px;
    }

    .toggle-moon {
      left: 6px;
    }

    [data-theme="light"] .toggle-sun {
      opacity: 0;
    }

    [data-theme="light"] .toggle-moon {
      opacity: .4;
    }

    [data-theme="dark"] .toggle-sun {
      opacity: .4;
    }

    [data-theme="dark"] .toggle-moon {
      opacity: 0;
    }

    /* Nav right */
    .nav-right {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    .nav-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--grad-btn);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .85rem;
      font-weight: 700;
      color: white;
      cursor: pointer;
      flex-shrink: 0;
      box-shadow: 0 2px 10px rgba(124, 58, 237, .35);
      overflow: hidden;
      padding: 0;
      text-decoration: none;
      transition: box-shadow .2s;
    }

    .nav-avatar:hover {
      box-shadow: 0 4px 16px rgba(124, 58, 237, .5);
    }

    .logout-form {
      display: inline;
    }

    .logout-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: .82rem;
      color: var(--muted);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 600;
      padding: 7px 10px;
      border-radius: 8px;
      transition: all .2s;
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .logout-btn:hover {
      background: rgba(239, 68, 68, .1);
      color: #ef4444;
    }

    /* Flash overlay */
    .theme-transition-flash {
      position: fixed;
      inset: 0;
      z-index: 9999;
      pointer-events: none;
      opacity: 0;
      background: radial-gradient(circle at 50% 5%, white 0%, transparent 70%);
      transition: opacity .15s ease;
    }

    [data-theme="dark"] .theme-transition-flash {
      background: radial-gradient(circle at 50% 5%, #0f172a 0%, transparent 70%);
    }

    .theme-transition-flash.active {
      opacity: .45;
    }

    /* ════════════════════════════════════════════
       PAGE LAYOUT
    ════════════════════════════════════════════ */
    .page {
      max-width: 1240px;
      margin: 0 auto;
      padding: 32px 32px 80px;
    }

    /* Flash messages */
    .flash {
      padding: 12px 18px;
      border-radius: 12px;
      margin-bottom: 16px;
      font-size: .83rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: fadeUp .4s ease;
    }

    .flash-success {
      background: rgba(34, 197, 94, .1);
      border: 1px solid rgba(34, 197, 94, .25);
      color: #15803d;
    }

    .flash-error {
      background: rgba(239, 68, 68, .1);
      border: 1px solid rgba(239, 68, 68, .25);
      color: #dc2626;
    }

    [data-theme="dark"] .flash-success {
      color: #4ade80;
    }

    [data-theme="dark"] .flash-error {
      color: #f87171;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: none;
      }
    }

    /* Deadline alert */
    .deadline-alert {
      background: linear-gradient(135deg, rgba(251, 146, 60, .12), rgba(249, 115, 22, .08));
      border: 1px solid rgba(251, 146, 60, .3);
      border-left: 4px solid var(--orange-500);
      border-radius: 14px;
      padding: 14px 18px;
      display: flex;
      gap: 12px;
      align-items: center;
      margin-bottom: 20px;
      font-size: .83rem;
      color: var(--ink2);
      animation: fadeUp .4s ease;
    }

    .deadline-alert i {
      color: var(--orange-500);
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    /* ════════════════════════════════════════════
       HERO BANNER
    ════════════════════════════════════════════ */
    .hero-banner {
      background: var(--grad-hero);
      border-radius: 24px;
      padding: 40px 48px;
      margin-bottom: 24px;
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      gap: 40px;
      min-height: 220px;
      box-shadow: var(--shadow-xl);
    }

    .hero-banner::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse at 80% 50%, rgba(251, 191, 36, .15) 0%, transparent 50%),
        radial-gradient(ellipse at 10% 80%, rgba(96, 165, 250, .2) 0%, transparent 40%);
    }

    /* Decorative circles */
    .hero-banner::after {
      content: '';
      position: absolute;
      right: -60px;
      top: -60px;
      width: 320px;
      height: 320px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .06);
      pointer-events: none;
    }

    .hero-deco-circle {
      position: absolute;
      right: 120px;
      bottom: -80px;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .04);
      pointer-events: none;
    }

    .hero-left {
      flex: 1;
      position: relative;
      z-index: 1;
    }

    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, .15);
      border: 1px solid rgba(255, 255, 255, .2);
      border-radius: 50px;
      padding: 5px 14px;
      font-size: .65rem;
      font-weight: 700;
      letter-spacing: .15em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .9);
      margin-bottom: 16px;
    }

    .hero-eyebrow-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #fbbf24;
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
        transform: scale(1);
      }

      50% {
        opacity: .5;
        transform: scale(.7);
      }
    }

    .hero-title {
      font-family: 'Fraunces', serif;
      font-size: clamp(2rem, 3.5vw, 3.2rem);
      font-weight: 600;
      line-height: 1.1;
      color: white;
      margin-bottom: 14px;
    }

    .hero-title em {
      font-style: italic;
      color: #fde68a;
    }

    .hero-sub {
      font-size: .85rem;
      color: rgba(255, 255, 255, .7);
      line-height: 1.7;
      max-width: 460px;
      margin-bottom: 24px;
    }

    .hero-sub strong {
      color: white;
      font-weight: 700;
    }

    .hero-cta {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .btn-hero-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: white;
      color: var(--blue-700);
      padding: 11px 24px;
      border-radius: 50px;
      font-size: .83rem;
      font-weight: 700;
      text-decoration: none;
      border: none;
      cursor: pointer;
      transition: all .2s;
      letter-spacing: .01em;
      box-shadow: 0 4px 20px rgba(0, 0, 0, .2);
    }

    .btn-hero-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(0, 0, 0, .25);
    }

    .btn-hero-ghost {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, .15);
      color: rgba(255, 255, 255, .9);
      padding: 11px 24px;
      border-radius: 50px;
      font-size: .83rem;
      font-weight: 700;
      text-decoration: none;
      border: 1px solid rgba(255, 255, 255, .25);
      cursor: pointer;
      transition: all .2s;
    }

    .btn-hero-ghost:hover {
      background: rgba(255, 255, 255, .25);
      transform: translateY(-2px);
    }

    /* Hero books decoration */
    .hero-books-wrap {
      position: relative;
      z-index: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
      flex-shrink: 0;
    }

    .hero-books {
      display: flex;
      align-items: flex-end;
      gap: 5px;
    }

    .hb {
      border-radius: 3px 7px 7px 3px;
      position: relative;
      transition: transform .3s ease;
      cursor: default;
    }

    .hb::after {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 8px;
      background: rgba(0, 0, 0, .2);
      border-radius: 3px 0 0 3px;
    }

    .hb:hover {
      transform: translateY(-14px) rotate(2deg);
    }

    .hb:nth-child(1) {
      width: 28px;
      height: 120px;
      background: linear-gradient(160deg, #60a5fa, #2563eb);
    }

    .hb:nth-child(2) {
      width: 22px;
      height: 145px;
      background: linear-gradient(160deg, #a78bfa, #7c3aed);
    }

    .hb:nth-child(3) {
      width: 32px;
      height: 108px;
      background: linear-gradient(160deg, #fbbf24, #d97706);
    }

    .hb:nth-child(4) {
      width: 20px;
      height: 135px;
      background: linear-gradient(160deg, #34d399, #059669);
    }

    .hb:nth-child(5) {
      width: 26px;
      height: 118px;
      background: linear-gradient(160deg, #fb923c, #ea580c);
    }

    .hb:nth-child(6) {
      width: 30px;
      height: 150px;
      background: linear-gradient(160deg, #c084fc, #9333ea);
    }

    .hb:nth-child(7) {
      width: 22px;
      height: 106px;
      background: linear-gradient(160deg, #38bdf8, #0284c7);
    }

    .shelf-line {
      width: 100%;
      height: 3px;
      background: linear-gradient(90deg, rgba(255, 255, 255, .3), rgba(255, 255, 255, .6));
      border-radius: 2px;
      margin-top: 4px;
    }

    /* ════════════════════════════════════════════
       TICKER
    ════════════════════════════════════════════ */
    .ticker-strip {
      background: var(--ticker-bg);
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      align-items: center;
      margin-bottom: 28px;
      height: 38px;
      box-shadow: var(--shadow-md);
    }

    .ticker-label {
      background: var(--grad-btn);
      color: white;
      font-size: .62rem;
      font-weight: 800;
      letter-spacing: .15em;
      text-transform: uppercase;
      padding: 0 16px;
      height: 100%;
      display: flex;
      align-items: center;
      gap: 6px;
      flex-shrink: 0;
      white-space: nowrap;
    }

    .ticker-scroll {
      flex: 1;
      overflow: hidden;
      position: relative;
      height: 100%;
      display: flex;
      align-items: center;
    }

    .ticker-inner {
      display: flex;
      gap: 0;
      animation: tickerSlide 30s linear infinite;
      white-space: nowrap;
    }

    @keyframes tickerSlide {
      from {
        transform: translateX(0);
      }

      to {
        transform: translateX(-50%);
      }
    }

    .ticker-item {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: .74rem;
      font-weight: 500;
      color: rgba(167, 139, 250, .8);
      padding: 0 22px;
    }

    .ticker-item i {
      color: #818cf8;
      font-size: .68rem;
    }

    .ticker-author {
      opacity: .5;
      font-weight: 400;
    }

    .ticker-sep {
      color: rgba(255, 255, 255, .15);
    }

    /* ════════════════════════════════════════════
       STATS ROW
    ════════════════════════════════════════════ */
    .stats-row {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
      margin-bottom: 28px;
    }

    .stat-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 22px;
      position: relative;
      overflow: hidden;
      transition: transform .25s, box-shadow .25s, background .4s, border-color .4s;
      box-shadow: var(--shadow-sm);
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .stat-icon-ring {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .95rem;
      color: white;
      margin-bottom: 14px;
    }

    .stat-icon-ring.s1 {
      background: var(--stat-1);
      box-shadow: 0 4px 12px rgba(37, 99, 235, .3);
    }

    .stat-icon-ring.s2 {
      background: var(--stat-2);
      box-shadow: 0 4px 12px rgba(124, 58, 237, .3);
    }

    .stat-icon-ring.s3 {
      background: var(--stat-3);
      box-shadow: 0 4px 12px rgba(234, 88, 12, .3);
    }

    .stat-icon-ring.s4 {
      background: var(--stat-4);
      box-shadow: 0 4px 12px rgba(2, 132, 199, .3);
    }

    .stat-num {
      font-family: 'Fraunces', serif;
      font-size: 2.6rem;
      font-weight: 700;
      line-height: 1;
      color: var(--ink);
      margin-bottom: 4px;
      transition: color .4s;
    }

    .stat-label {
      font-size: .71rem;
      font-weight: 600;
      color: var(--muted);
    }

    .stat-trend {
      position: absolute;
      top: 16px;
      right: 16px;
      font-size: .63rem;
      font-weight: 700;
      padding: 3px 9px;
      border-radius: 50px;
      letter-spacing: .04em;
    }

    .stat-trend.up {
      background: rgba(34, 197, 94, .12);
      color: #16a34a;
    }

    .stat-trend.same {
      background: rgba(107, 114, 128, .1);
      color: var(--muted);
    }

    [data-theme="dark"] .stat-trend.up {
      color: #4ade80;
    }

    /* Left accent bar */
    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 3px;
      border-radius: 18px 18px 0 0;
    }

    .stat-card:nth-child(1)::before {
      background: var(--stat-1);
    }

    .stat-card:nth-child(2)::before {
      background: var(--stat-2);
    }

    .stat-card:nth-child(3)::before {
      background: var(--stat-3);
    }

    .stat-card:nth-child(4)::before {
      background: var(--stat-4);
    }

    /* ════════════════════════════════════════════
       MAIN GRID
    ════════════════════════════════════════════ */
    .main-grid {
      display: grid;
      grid-template-columns: 1fr 340px;
      gap: 24px;
      margin-bottom: 36px;
    }

    /* Section labels */
    .section-label {
      font-size: .62rem;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--blue-500);
      margin-bottom: 4px;
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 16px;
      line-height: 1.25;
      transition: color .4s;
    }

    /* ════════════════════════════════════════════
       LOAN CARDS
    ════════════════════════════════════════════ */
    .loan-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 16px 18px;
      display: flex;
      gap: 14px;
      align-items: center;
      margin-bottom: 10px;
      transition: all .25s, background .4s;
      box-shadow: var(--shadow-sm);
    }

    .loan-card:hover {
      box-shadow: var(--shadow-md);
      transform: translateX(4px);
      border-color: var(--blue-500);
    }

    .loan-cover-ph {
      width: 46px;
      height: 64px;
      background: var(--grad-btn);
      border-radius: 4px 8px 8px 4px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      box-shadow: var(--shadow-sm);
    }

    .loan-cover-img {
      width: 46px;
      height: 64px;
      border-radius: 4px 8px 8px 4px;
      flex-shrink: 0;
      object-fit: cover;
      box-shadow: var(--shadow-sm);
    }

    .loan-info {
      flex: 1;
      min-width: 0;
    }

    .loan-title {
      font-size: .9rem;
      font-weight: 700;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 2px;
      color: var(--ink);
    }

    .loan-author {
      font-size: .72rem;
      color: var(--muted);
      margin-bottom: 7px;
    }

    .loan-deadline {
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: .71rem;
      font-weight: 600;
    }

    .loan-deadline.ok {
      color: #16a34a;
    }

    .loan-deadline.warn {
      color: var(--orange-500);
    }

    .loan-deadline.over {
      color: #dc2626;
    }

    .deadline-bar {
      height: 4px;
      border-radius: 4px;
      background: var(--border);
      overflow: hidden;
      margin-top: 6px;
    }

    .deadline-fill {
      height: 100%;
      border-radius: 4px;
    }

    .deadline-fill.ok {
      background: linear-gradient(90deg, #22c55e, #4ade80);
    }

    .deadline-fill.warn {
      background: linear-gradient(90deg, #f97316, #fb923c);
    }

    .deadline-fill.over {
      background: linear-gradient(90deg, #ef4444, #f87171);
    }

    .return-btn {
      padding: 7px 14px;
      border-radius: 50px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .72rem;
      font-weight: 700;
      cursor: pointer;
      transition: all .2s;
      flex-shrink: 0;
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--muted);
    }

    .return-btn:hover {
      background: var(--grad-btn);
      color: white;
      border-color: transparent;
      box-shadow: 0 4px 12px rgba(124, 58, 237, .3);
    }

    .empty-state {
      text-align: center;
      padding: 40px 20px;
      color: var(--muted);
    }

    .empty-state .es-icon {
      font-size: 2.8rem;
      margin-bottom: 10px;
      opacity: .4;
    }

    .empty-state p {
      font-size: .83rem;
      line-height: 1.65;
    }

    /* Reading challenge */
    .challenge-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 20px 22px;
      margin-top: 20px;
      transition: background .4s, border-color .4s;
      box-shadow: var(--shadow-sm);
    }

    .challenge-head {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 14px;
    }

    .challenge-head-left .section-label {
      margin-bottom: 2px;
    }

    .challenge-head-left .section-title {
      font-size: 1rem;
      margin-bottom: 0;
    }

    .challenge-badge {
      background: var(--purple-100);
      border: 1px solid rgba(139, 92, 246, .2);
      border-radius: 50px;
      padding: 4px 12px;
      font-size: .7rem;
      font-weight: 700;
      color: var(--purple-600);
    }

    [data-theme="dark"] .challenge-badge {
      background: rgba(139, 92, 246, .2);
      color: #c4b5fd;
    }

    .challenge-bar-wrap {
      background: var(--border);
      border-radius: 8px;
      height: 8px;
      overflow: hidden;
      margin-bottom: 8px;
    }

    .challenge-bar-fill {
      height: 100%;
      background: var(--grad-btn);
      border-radius: 8px;
      transition: width .8s ease;
    }

    .challenge-meta {
      display: flex;
      justify-content: space-between;
      font-size: .72rem;
      color: var(--muted);
      font-weight: 600;
    }

    /* ════════════════════════════════════════════
       SIDEBAR
    ════════════════════════════════════════════ */
    .sidebar-stack {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    /* Quote card */
    .quote-card {
      background: var(--quote-bg);
      border: 1px solid rgba(139, 92, 246, .2);
      border-radius: 18px;
      padding: 22px;
      position: relative;
      overflow: hidden;
    }

    .quote-card::before {
      content: '❝';
      position: absolute;
      right: 10px;
      bottom: -16px;
      font-family: 'Fraunces', serif;
      font-size: 7rem;
      line-height: 1;
      color: rgba(139, 92, 246, .1);
      pointer-events: none;
      user-select: none;
    }

    .quote-label {
      font-size: .6rem;
      font-weight: 800;
      letter-spacing: .16em;
      text-transform: uppercase;
      color: var(--purple-500);
      margin-bottom: 10px;
    }

    .quote-text {
      font-family: 'Fraunces', serif;
      font-size: 1.02rem;
      font-weight: 600;
      font-style: italic;
      color: var(--ink2);
      line-height: 1.6;
      margin-bottom: 10px;
    }

    .quote-author {
      font-size: .72rem;
      color: var(--muted);
      font-weight: 600;
    }

    /* History card */
    .history-card {
      background: var(--hist-bg);
      border-radius: 18px;
      padding: 22px;
      color: white;
      box-shadow: var(--shadow-lg);
    }

    .history-card .section-label {
      color: rgba(255, 255, 255, .5);
    }

    .history-card .section-title {
      color: white;
      font-size: 1.1rem;
    }

    .history-item {
      display: flex;
      gap: 10px;
      align-items: center;
      padding: 9px 0;
      border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .history-item:last-child {
      border-bottom: none;
    }

    .history-cover-ph {
      width: 32px;
      height: 46px;
      background: rgba(255, 255, 255, .15);
      border-radius: 3px 6px 6px 3px;
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .9rem;
    }

    .history-cover-img {
      width: 32px;
      height: 46px;
      border-radius: 3px 6px 6px 3px;
      flex-shrink: 0;
      object-fit: cover;
    }

    .history-info {
      flex: 1;
      min-width: 0;
    }

    .history-title {
      font-size: .83rem;
      font-weight: 700;
      color: rgba(255, 255, 255, .9);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      margin-bottom: 2px;
    }

    .history-date {
      font-size: .68rem;
      color: rgba(255, 255, 255, .4);
    }

    .history-status {
      font-size: .62rem;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 50px;
      letter-spacing: .05em;
      flex-shrink: 0;
    }

    .history-status.selesai {
      background: rgba(255, 255, 255, .15);
      color: rgba(255, 255, 255, .85);
    }

    .history-status.kadaluwarsa {
      background: rgba(239, 68, 68, .3);
      color: #fca5a5;
    }

    .history-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 14px;
      font-size: .77rem;
      font-weight: 700;
      color: rgba(255, 255, 255, .45);
      text-decoration: none;
      transition: color .2s;
    }

    .history-link:hover {
      color: white;
    }

    /* ════════════════════════════════════════════
       RECENTLY ADDED / BOOK GRID
    ════════════════════════════════════════════ */
    .books-section,
    .recent-section {
      margin-bottom: 36px;
    }

    .books-header {
      display: flex;
      align-items: flex-end;
      justify-content: space-between;
      margin-bottom: 14px;
    }

    .view-all-link {
      font-size: .78rem;
      font-weight: 700;
      color: var(--blue-500);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: color .2s;
    }

    .view-all-link:hover {
      color: var(--purple-500);
    }

    .recent-scroll {
      display: flex;
      gap: 12px;
      overflow-x: auto;
      padding-bottom: 8px;
      scrollbar-width: thin;
      scrollbar-color: var(--border) transparent;
    }

    .recent-scroll::-webkit-scrollbar {
      height: 4px;
    }

    .recent-scroll::-webkit-scrollbar-track {
      background: transparent;
    }

    .recent-scroll::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 4px;
    }

    .recent-card {
      flex-shrink: 0;
      width: 196px;
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 16px;
      overflow: hidden;
      transition: transform .25s, box-shadow .25s, background .4s;
      text-decoration: none;
      color: inherit;
      cursor: pointer;
      box-shadow: var(--shadow-sm);
    }

    .recent-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .recent-card-cover {
      height: 110px;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      overflow: hidden;
    }

    .recent-card-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .recent-card-body {
      padding: 12px 14px;
    }

    .recent-card-kat {
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--purple-500);
      margin-bottom: 5px;
    }

    .recent-card-title {
      font-size: .86rem;
      font-weight: 700;
      color: var(--ink);
      line-height: 1.3;
      margin-bottom: 3px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .recent-card-author {
      font-size: .7rem;
      color: var(--muted);
    }

    .recent-new-badge {
      position: absolute;
      top: 8px;
      left: 8px;
      background: var(--grad-btn);
      color: white;
      font-size: .57rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      padding: 2px 9px;
      border-radius: 50px;
    }

    /* Toolbar */
    .toolbar-wrap {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 12px;
    }

    .toolbar-search-box {
      display: flex;
      align-items: center;
      gap: 8px;
      background: var(--search-bg);
      border: 1.5px solid var(--border);
      border-radius: 50px;
      padding: 7px 14px;
      flex-shrink: 0;
      width: 220px;
      transition: border-color .2s, box-shadow .2s, background .4s;
    }

    .toolbar-search-box:focus-within {
      border-color: var(--blue-500);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, .12);
    }

    .toolbar-search-box i {
      color: var(--muted);
      font-size: .78rem;
      flex-shrink: 0;
    }

    .toolbar-search-box input {
      flex: 1;
      border: none;
      background: transparent;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .81rem;
      color: var(--ink);
      outline: none;
      min-width: 0;
    }

    .toolbar-search-box input::placeholder {
      color: var(--muted);
    }

    .toolbar-search-clear {
      background: none;
      border: none;
      padding: 0;
      cursor: pointer;
      color: var(--muted);
      font-size: .68rem;
      display: none;
      align-items: center;
      justify-content: center;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      transition: all .2s;
      flex-shrink: 0;
    }

    .toolbar-search-clear:hover {
      background: #ef4444;
      color: white;
    }

    .toolbar-search-clear.vis {
      display: flex;
    }

    .filter-row {
      display: flex;
      gap: 6px;
      flex-wrap: nowrap;
      overflow-x: auto;
      flex: 1;
      scrollbar-width: none;
      padding-bottom: 2px;
      margin-bottom: 0;
    }

    .filter-row::-webkit-scrollbar {
      display: none;
    }

    .filter-chip {
      padding: 6px 15px;
      border-radius: 50px;
      border: 1.5px solid var(--border);
      background: var(--chip-bg);
      font-size: .76rem;
      font-weight: 600;
      color: var(--muted);
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .filter-chip:hover {
      border-color: var(--blue-500);
      color: var(--blue-500);
      background: var(--blue-50);
    }

    [data-theme="dark"] .filter-chip:hover {
      background: rgba(59, 130, 246, .1);
    }

    .filter-chip.active {
      background: var(--grad-btn);
      color: white;
      border-color: transparent;
      box-shadow: 0 3px 12px rgba(124, 58, 237, .3);
    }

    .toolbar-sort-wrap {
      position: relative;
      flex-shrink: 0;
    }

    .toolbar-sort-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 7px 14px;
      border-radius: 50px;
      border: 1.5px solid var(--border);
      background: var(--chip-bg);
      font-size: .76rem;
      font-weight: 600;
      color: var(--muted);
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .toolbar-sort-btn:hover,
    .toolbar-sort-btn.open {
      border-color: var(--blue-500);
      color: var(--blue-500);
    }

    .sort-dropdown {
      position: absolute;
      top: calc(100% + 6px);
      right: 0;
      background: var(--card-bg);
      border: 1.5px solid var(--border);
      border-radius: 14px;
      box-shadow: var(--shadow-lg);
      min-width: 170px;
      overflow: hidden;
      z-index: 50;
      display: none;
      animation: popIn .2s cubic-bezier(.34, 1.4, .64, 1);
    }

    .sort-dropdown.show {
      display: block;
    }

    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(.9);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .sort-opt {
      display: flex;
      align-items: center;
      gap: 9px;
      width: 100%;
      padding: 10px 16px;
      font-size: .79rem;
      font-weight: 500;
      color: var(--ink2);
      background: none;
      border: none;
      cursor: pointer;
      transition: background .15s;
      text-align: left;
    }

    .sort-opt i {
      color: var(--muted);
      font-size: .74rem;
    }

    .sort-opt:hover {
      background: var(--blue-50);
    }

    [data-theme="dark"] .sort-opt:hover {
      background: rgba(59, 130, 246, .08);
    }

    .sort-opt.active {
      font-weight: 700;
      color: var(--blue-600);
    }

    .sort-opt.active i {
      color: var(--blue-600);
    }

    /* Result bar */
    .result-bar {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 8px 14px;
      margin-bottom: 14px;
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 10px;
      font-size: .77rem;
      color: var(--muted);
      animation: fadeUp .25s ease;
    }

    .result-bar-count {
      font-weight: 700;
      color: var(--blue-600);
      background: var(--blue-100);
      padding: 2px 10px;
      border-radius: 50px;
    }

    [data-theme="dark"] .result-bar-count {
      background: rgba(59, 130, 246, .15);
    }

    .result-bar-info {
      font-style: italic;
      color: var(--ink);
      font-weight: 500;
    }

    .result-bar-reset {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 5px;
      font-size: .72rem;
      font-weight: 700;
      color: var(--muted);
      cursor: pointer;
      border: 1.5px solid var(--border);
      background: none;
      padding: 3px 12px;
      border-radius: 50px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      transition: all .2s;
    }

    .result-bar-reset:hover {
      background: var(--ink);
      color: white;
      border-color: var(--ink);
    }

    /* Book grid */
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(148px, 1fr));
      gap: 20px;
    }

    .book-item {
      text-decoration: none;
      color: inherit;
      display: block;
      animation: fadeUp .5s ease both;
      cursor: pointer;
    }

    .book-item:nth-child(1) {
      animation-delay: .04s
    }

    .book-item:nth-child(2) {
      animation-delay: .08s
    }

    .book-item:nth-child(3) {
      animation-delay: .12s
    }

    .book-item:nth-child(4) {
      animation-delay: .16s
    }

    .book-item:nth-child(5) {
      animation-delay: .20s
    }

    .book-item:nth-child(6) {
      animation-delay: .24s
    }

    .book-item:nth-child(7) {
      animation-delay: .28s
    }

    .book-item:nth-child(8) {
      animation-delay: .32s
    }

    .book-item:nth-child(9) {
      animation-delay: .36s
    }

    .book-item:nth-child(10) {
      animation-delay: .40s
    }

    .book-cover-wrap {
      aspect-ratio: 2/3;
      border-radius: 5px 12px 12px 5px;
      overflow: hidden;
      position: relative;
      box-shadow: -3px 4px 14px rgba(37, 99, 235, .15);
      transition: transform .35s cubic-bezier(.34, 1.2, .64, 1), box-shadow .35s;
      margin-bottom: 10px;
    }

    .book-item:hover .book-cover-wrap {
      transform: perspective(600px) rotateY(-8deg) translateY(-6px);
      box-shadow: 6px 14px 32px rgba(37, 99, 235, .2);
    }

    .book-cover-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .book-cover-color {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: flex-end;
      padding: 12px 10px;
    }

    .book-cover-spine {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 10px;
      background: rgba(0, 0, 0, .2);
    }

    .book-cover-overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(to bottom, transparent 40%, rgba(0, 0, 0, .55));
    }

    .book-cover-text {
      font-size: .72rem;
      font-weight: 700;
      color: white;
      position: relative;
      z-index: 1;
      text-shadow: 0 1px 4px rgba(0, 0, 0, .5);
      line-height: 1.3;
    }

    .book-avail-dot {
      position: absolute;
      top: 8px;
      right: 8px;
      width: 9px;
      height: 9px;
      border-radius: 50%;
      border: 2px solid rgba(255, 255, 255, .7);
      z-index: 2;
    }

    .book-avail-dot.ok {
      background: #4ade80;
    }

    .book-avail-dot.none {
      background: #f87171;
    }

    .book-name {
      font-size: .84rem;
      font-weight: 700;
      line-height: 1.3;
      margin-bottom: 2px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      color: var(--ink);
    }

    .book-by {
      font-size: .71rem;
      color: var(--muted);
    }

    .book-kat {
      display: inline-block;
      margin-top: 5px;
      font-size: .61rem;
      font-weight: 700;
      letter-spacing: .07em;
      text-transform: uppercase;
      color: var(--purple-600);
      background: var(--purple-100);
      padding: 2px 8px;
      border-radius: 4px;
    }

    [data-theme="dark"] .book-kat {
      color: #c4b5fd;
      background: rgba(139, 92, 246, .2);
    }

    .grid-empty-state {
      grid-column: 1/-1;
      text-align: center;
      padding: 60px 20px;
      color: var(--muted);
    }

    .grid-empty-state .es-icon {
      font-size: 3rem;
      margin-bottom: 12px;
      opacity: .35;
      display: block;
    }

    .grid-empty-state p {
      font-size: .87rem;
      line-height: 1.65;
    }

    .pagination-wrap {
      margin-top: 24px;
      display: flex;
      justify-content: center;
    }

    /* ════════════════════════════════════════════
       CTA SECTION
    ════════════════════════════════════════════ */
    .cta-section {
      background: var(--grad-cta);
      border-radius: 24px;
      padding: 52px 56px;
      margin: 0 32px 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      position: relative;
      overflow: hidden;
      box-shadow: var(--shadow-xl);
    }

    .cta-section::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse at 85% 50%, rgba(251, 191, 36, .15) 0%, transparent 50%),
        radial-gradient(ellipse at 5% 50%, rgba(96, 165, 250, .2) 0%, transparent 40%);
      pointer-events: none;
    }

    .cta-deco-circle {
      position: absolute;
      right: -80px;
      top: -80px;
      width: 280px;
      height: 280px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .06);
      pointer-events: none;
    }

    .cta-deco-circle2 {
      position: absolute;
      right: 160px;
      bottom: -100px;
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .04);
      pointer-events: none;
    }

    .cta-left {
      flex: 1;
      position: relative;
      z-index: 1;
    }

    .cta-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(255, 255, 255, .15);
      border: 1px solid rgba(255, 255, 255, .25);
      color: #fde68a;
      border-radius: 50px;
      font-size: .64rem;
      font-weight: 700;
      letter-spacing: .15em;
      text-transform: uppercase;
      padding: 5px 14px;
      margin-bottom: 16px;
    }

    .cta-badge-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #fde68a;
      animation: pulse 2s infinite;
    }

    .cta-title {
      font-family: 'Fraunces', serif;
      font-size: clamp(1.8rem, 3vw, 2.6rem);
      font-weight: 600;
      line-height: 1.15;
      color: white;
      margin-bottom: 12px;
    }

    .cta-title em {
      font-style: italic;
      color: #fde68a;
    }

    .cta-desc {
      font-size: .84rem;
      color: rgba(255, 255, 255, .6);
      line-height: 1.75;
      max-width: 480px;
      margin-bottom: 0;
    }

    .cta-desc strong {
      color: rgba(255, 255, 255, .88);
      font-weight: 700;
    }

    .cta-steps {
      display: flex;
      gap: 24px;
      margin-top: 24px;
      flex-wrap: wrap;
    }

    .cta-step {
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .cta-stepnum {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      flex-shrink: 0;
      background: rgba(255, 255, 255, .15);
      border: 1px solid rgba(255, 255, 255, .2);
      font-size: .62rem;
      font-weight: 700;
      color: #fde68a;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cta-steptext {
      font-size: .74rem;
      color: rgba(255, 255, 255, .45);
      line-height: 1.5;
    }

    .cta-steptext strong {
      color: rgba(255, 255, 255, .72);
      font-weight: 700;
    }

    .cta-right {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
      flex-shrink: 0;
      position: relative;
      z-index: 1;
    }

    .cta-ring {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      border: 1.5px solid rgba(255, 255, 255, .2);
      display: flex;
      align-items: center;
      justify-content: center;
      background: rgba(255, 255, 255, .1);
    }

    .cta-inner {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: rgba(255, 255, 255, .15);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.6rem;
    }

    .cta-btn {
      display: inline-flex;
      align-items: center;
      gap: 9px;
      background: white;
      color: var(--blue-700);
      padding: 14px 30px;
      border-radius: 50px;
      font-size: .83rem;
      font-weight: 700;
      letter-spacing: .02em;
      text-decoration: none;
      transition: all .2s;
      white-space: nowrap;
      box-shadow: 0 4px 20px rgba(0, 0, 0, .2);
    }

    .cta-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(0, 0, 0, .28);
    }

    .cta-micro {
      font-size: .67rem;
      color: rgba(255, 255, 255, .3);
      text-align: center;
    }

    /* ════════════════════════════════════════════
       MODAL
    ════════════════════════════════════════════ */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 500;
      background: var(--modal-overlay);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .modal-overlay.show {
      display: flex;
    }

    .modal-box {
      background: var(--modal-bg);
      border-radius: 24px;
      max-width: 520px;
      width: 100%;
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      position: relative;
      animation: popIn .32s cubic-bezier(.34, 1.4, .64, 1);
      transition: background .4s;
    }

    .modal-strip {
      height: 4px;
      background: var(--grad-btn);
    }

    .modal-close {
      position: absolute;
      top: 12px;
      right: 14px;
      background: var(--border);
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .8rem;
      color: var(--muted);
      transition: all .2s;
      z-index: 10;
    }

    .modal-close:hover {
      background: #ef4444;
      color: white;
    }

    .modal-inner {
      display: flex;
      gap: 24px;
      padding: 28px;
    }

    .modal-cover-col {
      flex-shrink: 0;
      width: 120px;
    }

    .modal-cover {
      width: 120px;
      height: 175px;
      border-radius: 4px 12px 12px 4px;
      overflow: hidden;
      box-shadow: var(--shadow-lg);
      position: relative;
    }

    .modal-cover img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .modal-cover-ph {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      background: var(--grad-btn);
    }

    .modal-cover-spine {
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 10px;
      background: rgba(0, 0, 0, .2);
    }

    .modal-info {
      flex: 1;
      min-width: 0;
      display: flex;
      flex-direction: column;
    }

    .modal-kat {
      display: inline-block;
      font-size: .62rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: var(--purple-600);
      background: var(--purple-100);
      padding: 3px 10px;
      border-radius: 4px;
      margin-bottom: 10px;
      width: fit-content;
    }

    [data-theme="dark"] .modal-kat {
      background: rgba(139, 92, 246, .2);
      color: #c4b5fd;
    }

    .modal-title {
      font-size: 1.15rem;
      font-weight: 700;
      color: var(--ink);
      line-height: 1.3;
      margin-bottom: 4px;
    }

    .modal-author {
      font-size: .8rem;
      color: var(--muted);
      margin-bottom: 14px;
    }

    .modal-author span {
      color: var(--blue-600);
      font-weight: 600;
    }

    .modal-divider {
      height: 1px;
      background: var(--border);
      margin-bottom: 12px;
    }

    .modal-sinopsis-label {
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .12em;
      text-transform: uppercase;
      color: var(--muted);
      margin-bottom: 6px;
    }

    .modal-sinopsis {
      font-size: .81rem;
      color: var(--ink2);
      line-height: 1.75;
      flex: 1;
      margin-bottom: 20px;
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .modal-btns {
      display: flex;
      gap: 10px;
      margin-top: auto;
    }

    .modal-btn {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 10px 18px;
      border-radius: 50px;
      font-size: .8rem;
      font-weight: 700;
      text-decoration: none;
      cursor: pointer;
      transition: all .2s;
      white-space: nowrap;
    }

    .modal-btn-outline {
      border: 1.5px solid var(--border);
      background: transparent;
      color: var(--ink2);
      flex: 1;
      justify-content: center;
    }

    .modal-btn-outline:hover {
      border-color: var(--blue-500);
      color: var(--blue-600);
    }

    .modal-btn-fill {
      background: var(--grad-btn);
      color: white;
      border: none;
      flex: 1.5;
      justify-content: center;
      box-shadow: 0 4px 14px rgba(124, 58, 237, .3);
    }

    .modal-btn-fill:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(124, 58, 237, .4);
    }

    /* ════════════════════════════════════════════
       RESPONSIVE
    ════════════════════════════════════════════ */
    @media (max-width: 1080px) {
      .main-grid {
        grid-template-columns: 1fr;
      }

      .stats-row {
        grid-template-columns: repeat(2, 1fr);
      }

      .sidebar-stack {
        flex-direction: row;
        flex-wrap: wrap;
      }

      .sidebar-stack>* {
        flex: 1;
        min-width: 260px;
      }

      .nav-search-wrap {
        max-width: 360px;
      }
    }

    @media (max-width: 768px) {
      .page {
        padding: 20px 20px 60px;
      }

      .hero-banner {
        padding: 28px 28px;
        min-height: auto;
        gap: 20px;
      }

      .hero-title {
        font-size: 1.9rem;
      }

      .hero-books-wrap {
        display: none;
      }

      .stats-row {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }

      .stat-num {
        font-size: 2rem;
      }

      .nav-search-wrap {
        max-width: 300px;
      }

      .nav-links {
        display: none;
      }

      .toolbar-wrap {
        flex-wrap: wrap;
        gap: 8px;
      }

      .toolbar-search-box {
        width: 100%;
        order: -1;
      }

      .filter-row {
        order: 0;
        flex: 1 1 100%;
      }

      .toolbar-sort-wrap {
        order: 1;
        margin-left: auto;
      }

      .recent-card {
        width: 168px;
      }

      .modal-inner {
        flex-direction: column;
        align-items: center;
        padding: 20px;
        gap: 14px;
      }

      .modal-cover-col {
        width: 100%;
        display: flex;
        justify-content: center;
      }

      .modal-cover {
        width: 100px;
        height: 145px;
      }

      .cta-section {
        flex-direction: column;
        padding: 36px 28px;
        margin: 0 20px;
      }

      .cta-right {
        width: 100%;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
      }
    }

    @media (max-width: 480px) {
      .topnav {
        padding: 0 14px;
        height: 56px;
        gap: 0;
      }

      .nav-logo {
        font-size: 1.5rem;
      }

      .nav-search-wrap {
        max-width: calc(100% - 126px);
      }

      .nav-search-box {
        padding: 6px 12px;
        gap: 6px;
      }

      .nav-search-box input {
        font-size: .77rem;
      }

      .nav-search-btn {
        display: none;
      }

      .nav-search-divider {
        display: none;
      }

      .theme-toggle {
        width: 50px;
        height: 28px;
      }

      .toggle-thumb {
        width: 22px;
        height: 22px;
        font-size: .7rem;
      }

      [data-theme="dark"] .toggle-thumb {
        transform: translateX(22px);
      }

      .page {
        padding: 14px 14px 60px;
      }

      .hero-banner {
        padding: 22px 18px;
        border-radius: 18px;
        margin-bottom: 14px;
      }

      .hero-title {
        font-size: 1.6rem;
      }

      .hero-sub {
        font-size: .78rem;
        margin-bottom: 16px;
      }

      .hero-eyebrow {
        font-size: .58rem;
      }

      .btn-hero-primary,
      .btn-hero-ghost {
        font-size: .75rem;
        padding: 9px 17px;
      }

      .ticker-strip {
        height: 34px;
        border-radius: 10px;
        margin-bottom: 16px;
      }

      .ticker-label {
        padding: 0 12px;
        font-size: .55rem;
      }

      .ticker-item {
        font-size: .67rem;
        padding: 0 14px;
      }

      .stats-row {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin-bottom: 16px;
      }

      .stat-card {
        padding: 14px;
        border-radius: 14px;
      }

      .stat-num {
        font-size: 1.8rem;
      }

      .stat-label {
        font-size: .64rem;
      }

      .stat-trend {
        font-size: .58rem;
        padding: 2px 7px;
      }

      .stat-icon-ring {
        width: 34px;
        height: 34px;
        font-size: .8rem;
        border-radius: 10px;
        margin-bottom: 10px;
      }

      .section-title {
        font-size: 1.05rem;
      }

      .loan-card {
        padding: 12px;
        gap: 10px;
      }

      .loan-title {
        font-size: .82rem;
      }

      .loan-author {
        font-size: .67rem;
      }

      .loan-cover-ph,
      .loan-cover-img {
        width: 38px;
        height: 54px;
      }

      .filter-chip {
        padding: 5px 12px;
        font-size: .7rem;
      }

      .toolbar-sort-btn {
        padding: 5px 10px;
        font-size: .7rem;
      }

      .book-grid {
        grid-template-columns: repeat(auto-fill, minmax(108px, 1fr));
        gap: 12px;
      }

      .book-name {
        font-size: .77rem;
      }

      .book-by {
        font-size: .64rem;
      }

      .recent-card {
        width: 148px;
      }

      .recent-card-cover {
        height: 90px;
      }

      .recent-card-body {
        padding: 10px;
      }

      .recent-card-title {
        font-size: .78rem;
      }

      .quote-card {
        padding: 16px;
      }

      .quote-text {
        font-size: .9rem;
      }

      .history-card {
        padding: 16px;
      }

      .challenge-card {
        padding: 14px 16px;
      }

      .cta-section {
        padding: 28px 20px;
        border-radius: 18px;
        margin: 0 14px;
      }

      .cta-right {
        flex-direction: column;
        align-items: flex-start;
      }

      .cta-ring {
        display: none;
      }

      .sidebar-stack {
        flex-direction: column;
      }
    }

    @media (max-width: 360px) {
      .topnav {
        padding: 0 10px;
      }

      .nav-logo {
        font-size: 1.3rem;
      }

      .stats-row {
        grid-template-columns: 1fr 1fr;
        gap: 6px;
      }

      .stat-num {
        font-size: 1.5rem;
      }

      .book-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }

      .hero-title {
        font-size: 1.4rem;
      }
    }
  </style>
</head>

<body>

  <div class="theme-transition-flash" id="themeFlash"></div>

  <!-- TOP NAV -->
  <nav class="topnav">
    <a href="{{ route('anggota.dashboard') }}" class="nav-logo">LibCo</a>

    <div class="nav-links">
      <a href="{{ route('anggota.dashboard') }}" class="nav-link active"><i class="fas fa-home"></i> Beranda</a>
      <a href="{{ route('anggota.koleksi.index') }}" class="nav-link"><i class="fas fa-book"></i> Koleksi</a>
      <a href="{{ route('anggota.riwayat_saya') }}" class="nav-link"><i class="fas fa-history"></i> Riwayat</a>
      <a href="{{ route('anggota.profile.show') }}" class="nav-link"><i class="fas fa-user"></i> Profil</a>
    </div>

    <!-- Search Bar -->
    <div class="nav-search-wrap">
      <div class="nav-search-box">
        <i class="fas fa-search search-icon"></i>
        <input type="text" placeholder="Cari judul, penulis, atau kategori…" id="globalSearch" autocomplete="off">
        <button class="search-clear" id="searchClearBtn" title="Hapus">✕</button>
        <div class="nav-search-divider"></div>
        <button class="nav-search-btn" id="navSearchBtn">Cari</button>
      </div>
      <div class="search-dropdown" id="searchDropdown">
        <div class="search-dropdown-header" id="searchDropdownHeader">Hasil Pencarian</div>
        <div id="searchDropdownList"></div>
      </div>
    </div>

    <div class="nav-right">
      <button class="theme-toggle" id="themeToggle" title="Ganti tema" aria-label="Toggle dark/light mode">
        <span class="toggle-moon">🌙</span>
        <div class="toggle-thumb" id="toggleThumb"><span id="toggleEmoji">☀️</span></div>
        <span class="toggle-sun">☀️</span>
      </button>

      <a href="{{ route('anggota.profile.show') }}" class="nav-avatar" title="{{ auth()->user()->name }}">
        @if(auth()->user()->anggota?->foto)
          <img src="{{ asset('storage/foto/' . auth()->user()->anggota->foto) }}" alt="{{ auth()->user()->name }}"
            style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        @else
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        @endif
      </a>

      <form class="logout-form" method="POST" action="/logout">
        @csrf
        <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i></button>
      </form>
    </div>
  </nav>

  <!-- PAGE -->
  <div class="page">

    @if(session('success'))
      <div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    @php
      $segera = $activeLoans->filter(
        fn($p) =>
        \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($p->tanggal_batas), false) <= 3 &&
        \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($p->tanggal_batas), false) >= 0
      )->count();
    @endphp

    @if($segera > 0)
      <div class="deadline-alert">
        <i class="fas fa-exclamation-triangle"></i>
        <span><strong>{{ $segera }} buku</strong> harus dikembalikan dalam 3 hari ke depan. Jangan sampai
          terlambat!</span>
      </div>
    @endif

    <!-- HERO BANNER -->
    <div class="hero-banner">
      <div class="hero-deco-circle"></div>
      <div class="hero-left">
        <div class="hero-eyebrow">
          <div class="hero-eyebrow-dot"></div>
          Ruang Baca Digital
        </div>
        <h1 class="hero-title">
          Selamat datang,<br>
          <em>{{ explode(' ', auth()->user()->name)[0] }}.</em>
        </h1>
        <p class="hero-sub">
          @if($sedangDipinjam > 0)
            Kamu sedang meminjam <strong>{{ $sedangDipinjam }} buku</strong>.
            @if($segera > 0) Ada yang harus segera dikembalikan!
            @else Selamat membaca dan nikmati setiap halamannya.
            @endif
          @else
            Belum ada buku yang dipinjam. Yuk jelajahi koleksi dan temukan bacaan baru hari ini.
          @endif
        </p>
        <div class="hero-cta">
          <a href="{{ route('anggota.koleksi.index') }}" class="btn-hero-primary">
            <i class="fas fa-book-open"></i> Jelajahi Koleksi
          </a>
          <a href="{{ route('anggota.riwayat_saya') }}" class="btn-hero-ghost">
            <i class="fas fa-history"></i> Riwayat Saya
          </a>
        </div>
      </div>
      <div class="hero-books-wrap">
        <div class="hero-books">
          <div class="hb"></div>
          <div class="hb"></div>
          <div class="hb"></div>
          <div class="hb"></div>
          <div class="hb"></div>
          <div class="hb"></div>
          <div class="hb"></div>
        </div>
        <div class="shelf-line"></div>
      </div>
    </div>

    <!-- TICKER -->
    <div class="ticker-strip">
      <div class="ticker-label"><i class="fas fa-star"></i> Koleksi Terbaru</div>
      <div class="ticker-scroll">
        <div class="ticker-inner" id="tickerInner">
          @foreach($books as $book)
            <span class="ticker-item">
              <i class="fas fa-book"></i>
              {{ $book->judul_buku }}
              @if($book->pengarang)<span class="ticker-author">— {{ $book->pengarang }}</span>@endif
            </span>
            <span class="ticker-sep">·</span>
          @endforeach
          @foreach($books as $book)
            <span class="ticker-item">
              <i class="fas fa-book"></i>
              {{ $book->judul_buku }}
              @if($book->pengarang)<span class="ticker-author">— {{ $book->pengarang }}</span>@endif
            </span>
            <span class="ticker-sep">·</span>
          @endforeach
        </div>
      </div>
    </div>

    <!-- STATS ROW -->
    <div class="stats-row">
      <div class="stat-card">
        <span class="stat-trend up">↑ Aktif</span>
        <div class="stat-icon-ring s1"><i class="fas fa-book-reader"></i></div>
        <div class="stat-num">{{ $totalPeminjaman }}</div>
        <div class="stat-label">Total Peminjaman</div>
      </div>
      <div class="stat-card">
        <span class="stat-trend same">Aktif</span>
        <div class="stat-icon-ring s2"><i class="fas fa-clock"></i></div>
        <div class="stat-num">{{ $sedangDipinjam }}</div>
        <div class="stat-label">Sedang Dipinjam</div>
      </div>
      <div class="stat-card">
        <span class="stat-trend up">✓ Selesai</span>
        <div class="stat-icon-ring s3"><i class="fas fa-check-circle"></i></div>
        <div class="stat-num">{{ $selesaiDibaca }}</div>
        <div class="stat-label">Selesai Dibaca</div>
      </div>
      <div class="stat-card">
        <span class="stat-trend same">Koleksi</span>
        <div class="stat-icon-ring s4"><i class="fas fa-layer-group"></i></div>
        <div class="stat-num">{{ $books->total() }}</div>
        <div class="stat-label">Buku Tersedia</div>
      </div>
    </div>

    <!-- MAIN GRID -->
    <div class="main-grid">
      <div>
        <div class="section-label">Peminjaman Aktif</div>
        <div class="section-title">Buku yang Sedang Kamu Baca</div>

        @forelse($activeLoans as $loan)
          @php
            $batas = \Carbon\Carbon::parse($loan->tanggal_batas);
            $today = \Carbon\Carbon::today();
            $sisa = $today->diffInDays($batas, false);
            $pinjam = \Carbon\Carbon::parse($loan->tanggal_pinjam);
            $total = $pinjam->diffInDays($batas);
            $pct = $total > 0 ? max(0, min(100, round(($total - max($sisa, 0)) / $total * 100))) : 100;
            $cls = $sisa < 0 ? 'over' : ($sisa <= 2 ? 'warn' : 'ok');
          @endphp
          <div class="loan-card">
            @if($loan->ebook->cover)
              <img src="{{ asset('storage/' . $loan->ebook->cover) }}" class="loan-cover-img">
            @else
              <div class="loan-cover-ph">📚</div>
            @endif
            <div class="loan-info">
              <div class="loan-title">{{ $loan->ebook->judul_buku }}</div>
              <div class="loan-author">{{ $loan->ebook->pengarang }}</div>
              <div class="loan-deadline {{ $cls }}">
                <i class="fas fa-{{ $sisa < 0 ? 'exclamation-circle' : 'calendar-alt' }}"></i>
                @if($sisa < 0) Terlambat {{ abs($sisa) }} hari
                @elseif($sisa === 0) Hari ini tenggat!
                @else {{ $sisa }} hari tersisa · {{ $batas->translatedFormat('j M Y') }}
                @endif
              </div>
              <div class="deadline-bar">
                <div class="deadline-fill {{ $cls }}" style="width:{{ $pct }}%"></div>
              </div>
            </div>
            <button type="button" class="return-btn"
              onclick="konfirmasiKembalikan(event, '{{ route('anggota.kembalikan', $loan->id_peminjam) }}', '{{ addslashes($loan->ebook->judul_buku) }}')">
              Kembalikan
            </button>
          </div>
        @empty
          <div class="empty-state">
            <div class="es-icon">📭</div>
            <p>Tidak ada peminjaman aktif.<br>Mulai pinjam buku dari koleksi kami!</p>
          </div>
        @endforelse

        <div class="challenge-card">
          <div class="challenge-head">
            <div class="challenge-head-left">
              <div class="section-label">Target Baca</div>
              <div class="section-title">Tantangan Bulan Ini</div>
            </div>
            <span class="challenge-badge">{{ $selesaiDibaca }}/5 Buku</span>
          </div>
          <div class="challenge-bar-wrap">
            <div class="challenge-bar-fill" style="width:{{ min(100, ($selesaiDibaca / 5) * 100) }}%"></div>
          </div>
          <div class="challenge-meta">
            <span>{{ $selesaiDibaca }} selesai dibaca</span>
            <span>Target: 5 buku</span>
          </div>
        </div>
      </div>

      <div class="sidebar-stack">
        <div class="quote-card">
          <div class="quote-label"><i class="fas fa-feather-alt"></i> Kutipan Hari Ini</div>
          <p class="quote-text">"Membaca adalah jendela dunia yang tak pernah tertutup, bahkan saat malam paling pekat
            sekalipun."</p>
          <div class="quote-author">— Pramoedya Ananta Toer</div>
        </div>

        <div class="history-card">
          <div class="section-label">Riwayat</div>
          <div class="section-title">Bacaan Terakhir</div>
          @forelse($historyLoans as $loan)
            <div class="history-item">
              @if($loan->ebook->cover)
                <img src="{{ asset('storage/' . $loan->ebook->cover) }}" class="history-cover-img">
              @else
                <div class="history-cover-ph">📖</div>
              @endif
              <div class="history-info">
                <div class="history-title">{{ $loan->ebook->judul_buku }}</div>
                <div class="history-date">{{ \Carbon\Carbon::parse($loan->tanggal_batas)->translatedFormat('j M Y') }}
                </div>
              </div>
              <span class="history-status {{ $loan->status_peminjam }}">
                {{ $loan->status_peminjam === 'kadaluwarsa' ? 'Terlambat' : 'Selesai' }}
              </span>
            </div>
          @empty
            <p style="font-size:.82rem;color:rgba(255,255,255,.4);padding:12px 0;">Belum ada riwayat peminjaman.</p>
          @endforelse
          <a href="{{ route('anggota.riwayat_saya') }}" class="history-link">
            Lihat semua riwayat <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- RECENTLY ADDED -->
    <div class="recent-section">
      <div class="books-header">
        <div>
          <div class="section-label">Baru Ditambahkan</div>
          <div class="section-title" style="margin-bottom:0;">Koleksi Terbaru</div>
        </div>
        <a href="{{ route('anggota.koleksi.index') }}" class="view-all-link">Lihat semua <i
            class="fas fa-arrow-right"></i></a>
      </div>
      <div class="recent-scroll">
        @foreach($books->take(8) as $i => $book)
          <a href="{{ route('anggota.buku.show', $book->id_buku) }}" class="recent-card">
            <div class="recent-card-cover"
              style="background:{{ $book->cover_color ?? 'linear-gradient(135deg,#3b82f6,#8b5cf6)' }};">
              @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->judul_buku }}">
              @else
                📚
              @endif
              @if($i < 3)<span class="recent-new-badge">Baru</span>@endif
            </div>
            <div class="recent-card-body">
              <div class="recent-card-kat">{{ $book->kategori->nama_kategori ?? '—' }}</div>
              <div class="recent-card-title">{{ $book->judul_buku }}</div>
              <div class="recent-card-author">{{ $book->pengarang }}</div>
            </div>
          </a>
        @endforeach
      </div>
    </div>

    <!-- BOOK GRID -->
    <div class="books-section">
      <div class="books-header">
        <div>
          <div class="section-label">Koleksi</div>
          <div class="section-title" style="margin-bottom:0;">Semua Buku</div>
        </div>
      </div>

      <div class="toolbar-wrap">
        <div class="toolbar-search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="toolbarSearch" placeholder="Cari judul, penulis…" autocomplete="off">
          <button class="toolbar-search-clear" id="toolbarSearchClear" title="Hapus">✕</button>
        </div>

        <div class="filter-row" id="filterRow">
          <button class="filter-chip active" data-cat="semua"><i class="fas fa-border-all"></i> Semua</button>
          @foreach($kategoris as $kat)
            <button class="filter-chip" data-cat="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</button>
          @endforeach
        </div>

        <div class="toolbar-sort-wrap" id="toolbarSortWrap">
          <button class="toolbar-sort-btn" id="toolbarSortBtn">
            <i class="fas fa-sort-amount-down"></i>
            <span id="sortLabel">A–Z</span>
            <i class="fas fa-chevron-down" style="font-size:.58rem;"></i>
          </button>
          <div class="sort-dropdown" id="sortDropdown">
            <button class="sort-opt active" data-sort="az"><i class="fas fa-sort-alpha-down"></i> Judul A–Z</button>
            <button class="sort-opt" data-sort="za"><i class="fas fa-sort-alpha-up"></i> Judul Z–A</button>
            <button class="sort-opt" data-sort="penulis"><i class="fas fa-user"></i> Penulis A–Z</button>
          </div>
        </div>
      </div>

      <div class="result-bar" id="resultBar" style="display:none;">
        <span class="result-bar-count" id="resultBarCount"></span>
        <span>·</span>
        <span class="result-bar-info" id="resultBarInfo"></span>
        <button class="result-bar-reset" id="resultBarReset"><i class="fas fa-times"></i> Reset</button>
      </div>

      <div class="book-grid" id="bookGrid">
        @forelse($books as $book)
          <a href="{{ route('anggota.buku.show', $book->id_buku) }}" class="book-item" data-cat="{{ $book->id_kategori }}"
            data-id="{{ $book->id_buku }}" data-judul="{{ $book->judul_buku }}" data-penulis="{{ $book->pengarang }}"
            data-sinopsis="{{ Str::limit($book->sinopsis ?? 'Deskripsi buku ini belum tersedia.', 220) }}"
            data-kategori="{{ $book->kategori->nama_kategori ?? '-' }}"
            data-cover="{{ $book->cover ? asset('storage/' . $book->cover) : '' }}"
            data-color="{{ $book->cover_color ?? 'linear-gradient(135deg,#3b82f6,#8b5cf6)' }}"
            onclick="bukaModal(event,this)">
            <div class="book-cover-wrap">
              @if($book->cover)
                <img src="{{ asset('storage/' . $book->cover) }}" class="book-cover-img" alt="{{ $book->judul_buku }}">
              @else
                <div class="book-cover-color"
                  style="background:{{ $book->cover_color ?? 'linear-gradient(135deg,#3b82f6,#8b5cf6)' }}">
                  <div class="book-cover-overlay"></div>
                  <div class="book-cover-text">{{ Str::limit($book->judul_buku, 30) }}</div>
                </div>
              @endif
              <div class="book-cover-spine"></div>
              <div class="book-cover-overlay"></div>
              <div class="book-avail-dot {{ ($book->jumlah_ebook ?? 0) > 0 ? 'ok' : 'none' }}"></div>
            </div>
            <div class="book-name">{{ $book->judul_buku }}</div>
            <div class="book-by">{{ $book->pengarang }}</div>
            <span class="book-kat">{{ $book->kategori->nama_kategori ?? '-' }}</span>
          </a>
        @empty
          <div style="grid-column:1/-1;text-align:center;color:var(--muted);padding:48px;font-size:.88rem;">
            Belum ada buku tersedia saat ini.
          </div>
        @endforelse
      </div>

      <div class="pagination-wrap">{{ $books->links() }}</div>
    </div>

  </div><!-- /page -->

  <!-- MODAL KONFIRMASI KEMBALIKAN -->
  <div class="modal-overlay" id="returnModalOverlay">
    <div class="modal-box" style="max-width:400px;">
      <div class="modal-strip" style="background:linear-gradient(90deg,#22c55e,#16a34a);"></div>
      <button class="modal-close" onclick="tutupReturnModal()">✕</button>
      <div style="padding:32px 28px 28px;text-align:center;">
        <div
          style="width:64px;height:64px;border-radius:50%;background:rgba(34,197,94,.12);border:2px solid rgba(34,197,94,.25);display:flex;align-items:center;justify-content:center;font-size:1.8rem;margin:0 auto 18px;">
          ✅</div>
        <h3 style="font-size:1.1rem;font-weight:700;color:var(--ink);margin-bottom:8px;">Kembalikan Buku?</h3>
        <p style="font-size:.82rem;color:var(--muted);line-height:1.7;margin-bottom:24px;">
          Kamu akan mengembalikan<br>
          <strong id="returnBookTitle" style="color:var(--ink2);"></strong>
        </p>
        <div style="display:flex;gap:10px;">
          <button onclick="tutupReturnModal()"
            style="flex:1;padding:10px;border-radius:50px;border:1.5px solid var(--border);background:transparent;color:var(--muted);font-family:'Plus Jakarta Sans',sans-serif;font-size:.8rem;font-weight:700;cursor:pointer;transition:all .2s;"
            onmouseover="this.style.background='var(--body-bg)'"
            onmouseout="this.style.background='transparent'">Batal</button>
          <form id="returnForm" method="POST" style="flex:1.5;">
            @csrf
            <button type="submit"
              style="width:100%;padding:10px;border-radius:50px;background:linear-gradient(135deg,#22c55e,#16a34a);color:white;border:none;font-family:'Plus Jakarta Sans',sans-serif;font-size:.8rem;font-weight:700;cursor:pointer;transition:all .2s;box-shadow:0 4px 14px rgba(34,197,94,.3);">
              <i class="fas fa-check"></i> Ya, Kembalikan
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- CTA SECTION -->
  <div class="cta-section">
    <div class="cta-deco-circle"></div>
    <div class="cta-deco-circle2"></div>

    <div class="cta-left">
      <div class="cta-badge">
        <div class="cta-badge-dot"></div>
        Open Submission
      </div>
      <h2 class="cta-title">
        Punya karya<br>yang ingin kamu <em>bagikan?</em>
      </h2>
      <p class="cta-desc">
        LibCo membuka ruang bagi siapapun untuk berbagi tulisan, cerpen, puisi, atau esai.
        Karyamu bisa menjadi <strong>inspirasi bagi ribuan pembaca</strong> di perpustakaan ini.
      </p>
      <div class="cta-steps">
        <div class="cta-step">
          <div class="cta-stepnum">1</div>
          <div class="cta-steptext"><strong>Tulis</strong><br>karya terbaikmu</div>
        </div>
        <div class="cta-step">
          <div class="cta-stepnum">2</div>
          <div class="cta-steptext"><strong>Isi form</strong><br>& unggah file</div>
        </div>
        <div class="cta-step">
          <div class="cta-stepnum">3</div>
          <div class="cta-steptext"><strong>Tunggu</strong><br>kurasi tim kami</div>
        </div>
      </div>
    </div>

    <div class="cta-right">
      <div class="cta-ring">
        <div class="cta-inner">✍️</div>
      </div>
      <a href="https://forms.gle/KWjZm5kp3BNKCmo7A" target="_blank" rel="noopener noreferrer" class="cta-btn">
        🚀 &nbsp;Kirim Karya Sekarang
      </a>
      <div class="cta-micro">Gratis · Terbuka untuk umum</div>
    </div>
  </div>

  <!-- MODAL -->
  <div class="modal-overlay" id="modalOverlay">
    <div class="modal-box">
      <div class="modal-strip"></div>
      <button class="modal-close" onclick="tutupModal()">✕</button>
      <div class="modal-inner">
        <div class="modal-cover-col">
          <div class="modal-cover" id="modalCover"></div>
        </div>
        <div class="modal-info">
          <span class="modal-kat" id="modalKat"></span>
          <h2 class="modal-title" id="modalJudul"></h2>
          <p class="modal-author" id="modalPenulis"></p>
          <div class="modal-divider"></div>
          <div class="modal-sinopsis-label">Sinopsis</div>
          <p class="modal-sinopsis" id="modalSinopsis"></p>
          <div class="modal-btns">
            <a id="modalDetail" href="#" class="modal-btn modal-btn-outline"><i class="fas fa-eye"></i> Detail</a>
            <a id="modalPinjam" href="#" class="modal-btn modal-btn-fill"><i class="fas fa-book-open"></i> Pinjam
              Buku</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script>

    /* ══ MODAL KEMBALIKAN ══ */
    function konfirmasiKembalikan(e, actionUrl, judulBuku) {
      e.preventDefault();
      document.getElementById('returnBookTitle').textContent = judulBuku;
      document.getElementById('returnForm').action = actionUrl;
      document.getElementById('returnModalOverlay').classList.add('show');
      document.body.style.overflow = 'hidden';
    }
    function tutupReturnModal() {
      document.getElementById('returnModalOverlay').classList.remove('show');
      document.body.style.overflow = '';
    }
    document.getElementById('returnModalOverlay').addEventListener('click', function (e) {
      if (e.target === this) tutupReturnModal();
    });
    /* ══ TICKER speed ══ */
    (function () {
      const inner = document.getElementById('tickerInner');
      if (!inner) return;
      requestAnimationFrame(() => {
        const halfW = inner.scrollWidth / 2;
        inner.style.animationDuration = Math.max(20, halfW / 80) + 's';
      });
    })();

    /* ══ THEME ══ */
    const html = document.documentElement;
    const themeToggle = document.getElementById('themeToggle');
    const toggleEmoji = document.getElementById('toggleEmoji');
    const themeFlash = document.getElementById('themeFlash');
    applyTheme(localStorage.getItem('libco-theme') || 'light', false);

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

    /* ══ SEARCH & FILTER ENGINE ══ */
    const allBooks = Array.from(document.querySelectorAll('.book-item')).map(el => ({
      el,
      judul: (el.dataset.judul || '').toLowerCase(),
      penulis: (el.dataset.penulis || '').toLowerCase(),
      kategori: (el.dataset.kategori || '').toLowerCase(),
      cat: el.dataset.cat || '',
      raw: {
        judul: el.dataset.judul || '',
        penulis: el.dataset.penulis || '',
        kategori: el.dataset.kategori || '',
        cover: el.dataset.cover || '',
        color: el.dataset.color || '',
        id: el.dataset.id || '',
        href: el.getAttribute('href') || '#',
      }
    }));

    const bookGrid = document.getElementById('bookGrid');
    let state = { q: '', cat: 'semua', sort: 'az' };

    function hl(text, q) {
      if (!q) return text;
      const i = text.toLowerCase().indexOf(q.toLowerCase());
      if (i === -1) return text;
      return text.slice(0, i) + '<mark>' + text.slice(i, i + q.length) + '</mark>' + text.slice(i + q.length);
    }

    function render() {
      const q = state.q.trim().toLowerCase();
      let visible = allBooks.filter(b => {
        const catOk = state.cat === 'semua' || b.cat === state.cat;
        const textOk = !q || b.judul.includes(q) || b.penulis.includes(q) || b.kategori.includes(q);
        return catOk && textOk;
      });
      visible = [...visible].sort((a, b) => {
        if (state.sort === 'az') return a.judul.localeCompare(b.judul);
        if (state.sort === 'za') return b.judul.localeCompare(a.judul);
        if (state.sort === 'penulis') return a.penulis.localeCompare(b.penulis);
        return 0;
      });
      const visSet = new Set(visible.map(b => b.el));
      allBooks.forEach(b => { b.el.style.display = visSet.has(b.el) ? '' : 'none'; });
      visible.forEach(b => bookGrid.appendChild(b.el));

      // Empty state
      let emptyEl = bookGrid.querySelector('.grid-empty-state');
      if (visible.length === 0) {
        if (!emptyEl) {
          emptyEl = document.createElement('div');
          emptyEl.className = 'grid-empty-state';
          emptyEl.innerHTML = `<span class="es-icon">🔍</span><p>Tidak ada buku untuk <strong>"${state.q}"</strong>${state.cat !== 'semua' ? ' di kategori ini' : ''}.<br>Coba kata kunci lain atau reset filter.</p>`;
          bookGrid.appendChild(emptyEl);
        }
      } else {
        if (emptyEl) emptyEl.remove();
      }

      // Result bar
      const resultBar = document.getElementById('resultBar');
      const isFiltered = q || state.cat !== 'semua';
      if (isFiltered) {
        resultBar.style.display = 'flex';
        document.getElementById('resultBarCount').textContent = `${visible.length} buku`;
        const parts = [];
        if (q) parts.push(`"${state.q}"`);
        if (state.cat !== 'semua') {
          const chip = document.querySelector(`.filter-chip[data-cat="${state.cat}"]`);
          parts.push('kategori ' + (chip ? chip.textContent.trim() : state.cat));
        }
        document.getElementById('resultBarInfo').textContent = parts.length ? 'untuk ' + parts.join(' + ') : '';
      } else {
        resultBar.style.display = 'none';
      }
      buildDropdown(q);
    }

    /* Navbar search dropdown */
    const searchInput = document.getElementById('globalSearch');
    const searchDropdown = document.getElementById('searchDropdown');
    const dropdownList = document.getElementById('searchDropdownList');
    const dropdownHeader = document.getElementById('searchDropdownHeader');
    const navClearBtn = document.getElementById('searchClearBtn');

    function buildDropdown(q) {
      if (!q) { closeDropdown(); return; }
      const hits = allBooks.filter(b => b.judul.includes(q) || b.penulis.includes(q) || b.kategori.includes(q)).slice(0, 7);
      dropdownHeader.textContent = hits.length ? `${hits.length} hasil ditemukan` : 'Tidak ada hasil';
      dropdownList.innerHTML = hits.length
        ? hits.map(b => `
            <a href="${b.raw.href}" class="search-result-item" onclick="closeDropdown()">
              <div class="search-result-cover">${b.raw.cover ? `<img src="${b.raw.cover}" alt="">` : '📚'}</div>
              <div class="search-result-info">
                <div class="search-result-title">${hl(b.raw.judul, state.q)}</div>
                <div class="search-result-sub">${hl(b.raw.penulis, state.q)}</div>
              </div>
              <span class="search-result-kat">${b.raw.kategori}</span>
            </a>`).join('')
        : `<div class="search-no-result"><i class="fas fa-search"></i>Tidak ada buku untuk "<strong>${state.q}</strong>"</div>`;
      openDropdown();
    }
    function openDropdown() { searchDropdown.classList.add('show'); }
    function closeDropdown() { searchDropdown.classList.remove('show'); }

    let navDebounce;
    searchInput.addEventListener('input', function () {
      const v = this.value;
      navClearBtn.classList.toggle('visible', v.length > 0);
      const tb = document.getElementById('toolbarSearch');
      if (tb) { tb.value = v; document.getElementById('toolbarSearchClear').classList.toggle('vis', v.length > 0); }
      state.q = v;
      clearTimeout(navDebounce);
      navDebounce = setTimeout(() => render(), 120);
    });
    searchInput.addEventListener('focus', function () { if (this.value.trim()) openDropdown(); });
    searchInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') { closeDropdown(); document.querySelector('.books-section').scrollIntoView({ behavior: 'smooth', block: 'start' }); }
      if (e.key === 'Escape') { closeDropdown(); this.blur(); }
    });
    navClearBtn.addEventListener('click', () => {
      searchInput.value = ''; state.q = '';
      navClearBtn.classList.remove('visible');
      const tb = document.getElementById('toolbarSearch');
      if (tb) { tb.value = ''; document.getElementById('toolbarSearchClear').classList.remove('vis'); }
      render(); searchInput.focus();
    });
    document.addEventListener('click', e => { if (!e.target.closest('.nav-search-wrap')) closeDropdown(); });
    document.getElementById('navSearchBtn').addEventListener('click', () => {
      closeDropdown();
      document.querySelector('.books-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    /* Toolbar search */
    const toolbarSearch = document.getElementById('toolbarSearch');
    const toolbarSearchClear = document.getElementById('toolbarSearchClear');
    let tbDebounce;
    toolbarSearch.addEventListener('input', function () {
      const v = this.value;
      toolbarSearchClear.classList.toggle('vis', v.length > 0);
      searchInput.value = v;
      navClearBtn.classList.toggle('visible', v.length > 0);
      state.q = v;
      clearTimeout(tbDebounce);
      tbDebounce = setTimeout(() => render(), 120);
    });
    toolbarSearchClear.addEventListener('click', () => {
      toolbarSearch.value = ''; searchInput.value = '';
      toolbarSearchClear.classList.remove('vis');
      navClearBtn.classList.remove('visible');
      state.q = ''; render(); toolbarSearch.focus();
    });

    /* Filter chips */
    document.querySelectorAll('.filter-chip').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-chip').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        state.cat = btn.dataset.cat;
        render();
      });
    });

    /* Sort */
    const sortBtn = document.getElementById('toolbarSortBtn');
    const sortDropdown = document.getElementById('sortDropdown');
    const sortLabel = document.getElementById('sortLabel');
    const sortLabels = { az: 'A–Z', za: 'Z–A', penulis: 'Penulis' };
    sortBtn.addEventListener('click', e => {
      e.stopPropagation();
      sortDropdown.classList.toggle('show');
      sortBtn.classList.toggle('open');
    });
    document.addEventListener('click', e => {
      if (!e.target.closest('#toolbarSortWrap')) {
        sortDropdown.classList.remove('show');
        sortBtn.classList.remove('open');
      }
    });
    document.querySelectorAll('.sort-opt').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.sort-opt').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        state.sort = btn.dataset.sort;
        sortLabel.textContent = sortLabels[state.sort];
        sortDropdown.classList.remove('show');
        sortBtn.classList.remove('open');
        render();
      });
    });

    /* Result bar reset */
    document.getElementById('resultBarReset').addEventListener('click', () => {
      state.q = ''; state.cat = 'semua';
      searchInput.value = ''; toolbarSearch.value = '';
      navClearBtn.classList.remove('visible');
      toolbarSearchClear.classList.remove('vis');
      document.querySelectorAll('.filter-chip').forEach(b => b.classList.remove('active'));
      document.querySelector('.filter-chip[data-cat="semua"]').classList.add('active');
      render();
    });

    render();

    /* ══ MODAL ══ */
    function bukaModal(e, el) {
      e.preventDefault();
      const cover = el.dataset.cover;
      const color = el.dataset.color || 'linear-gradient(135deg,#3b82f6,#8b5cf6)';
      const judul = el.dataset.judul || '—';
      const penulis = el.dataset.penulis || '—';
      const sinopsis = el.dataset.sinopsis || 'Deskripsi belum tersedia.';
      const kategori = el.dataset.kategori || '—';
      const id = el.dataset.id;

      const coverEl = document.getElementById('modalCover');
      coverEl.style.background = color;
      coverEl.innerHTML = cover
        ? `<div class="modal-cover-spine"></div><img src="${cover}" alt="${judul}" style="width:100%;height:100%;object-fit:cover;display:block;">`
        : `<div class="modal-cover-spine"></div><div class="modal-cover-ph">📚</div>`;

      document.getElementById('modalKat').textContent = kategori;
      document.getElementById('modalJudul').textContent = judul;
      document.getElementById('modalPenulis').innerHTML = `oleh <span>${penulis}</span>`;
      document.getElementById('modalSinopsis').textContent = sinopsis;

      const url = `{{ url('anggota/buku') }}/${id}`;
      document.getElementById('modalDetail').href = url;
      document.getElementById('modalPinjam').href = url;

      document.getElementById('modalOverlay').classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function tutupModal() {
      document.getElementById('modalOverlay').classList.remove('show');
      document.body.style.overflow = '';
    }

    document.getElementById('modalOverlay').addEventListener('click', function (e) {
      if (e.target === this) tutupModal();
    });
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') { tutupModal(); closeDropdown(); }
    });
  </script>
</body>

</html>