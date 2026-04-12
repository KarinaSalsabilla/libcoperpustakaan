{{-- resources/views/anggota/profile/show.blade.php --}}
<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>LibCo — Profil Saya</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Fraunces:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    :root,
    [data-theme="light"] {
      --blue-50: #eff6ff;
      --blue-100: #dbeafe;
      --blue-500: #3b82f6;
      --blue-600: #2563eb;
      --blue-700: #1d4ed8;
      --purple-50: #faf5ff;
      --purple-100: #ede9fe;
      --purple-500: #8b5cf6;
      --purple-600: #7c3aed;

      --ink: #111827;
      --ink2: #374151;
      --muted: #6b7280;
      --border: #e5e7eb;

      --body-bg: #f0f4ff;
      --card-bg: #ffffff;
      --nav-bg: rgba(255, 255, 255, .93);
      --search-bg: #ffffff;
      --cream2: #eff6ff;

      --grad-hero: linear-gradient(135deg, #1d4ed8 0%, #7c3aed 60%, #9333ea 100%);
      --grad-btn: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
      --grad-body: linear-gradient(135deg, #eff6ff 0%, #ede9fe 50%, #faf5ff 100%);

      --shadow-sm: 0 1px 3px rgba(0, 0, 0, .06);
      --shadow-md: 0 4px 16px rgba(37, 99, 235, .10);
      --shadow-lg: 0 12px 40px rgba(37, 99, 235, .15);
      --shadow-xl: 0 24px 60px rgba(37, 99, 235, .18);

      --modal-bg: #ffffff;
      --modal-overlay: rgba(17, 24, 39, .65);

      --flash-ok-bg: rgba(34, 197, 94, .1);
      --flash-ok-border: rgba(34, 197, 94, .25);
      --flash-ok-text: #15803d;
      --flash-err-bg: rgba(239, 68, 68, .1);
      --flash-err-border: rgba(239, 68, 68, .25);
      --flash-err-text: #dc2626;
    }

    [data-theme="dark"] {
      --blue-50: rgba(59, 130, 246, .1);
      --blue-100: rgba(59, 130, 246, .15);
      --purple-50: rgba(139, 92, 246, .08);
      --purple-100: rgba(139, 92, 246, .15);

      --ink: #f1f5f9;
      --ink2: #cbd5e1;
      --muted: #94a3b8;
      --border: #1e293b;

      --body-bg: #0f172a;
      --card-bg: #1e293b;
      --nav-bg: rgba(15, 23, 42, .95);
      --search-bg: #1e293b;
      --cream2: rgba(59, 130, 246, .08);

      --grad-hero: linear-gradient(135deg, #1d4ed8 0%, #6d28d9 60%, #7e22ce 100%);
      --grad-btn: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
      --grad-body: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #150e2b 100%);

      --shadow-sm: 0 1px 3px rgba(0, 0, 0, .3);
      --shadow-md: 0 4px 16px rgba(0, 0, 0, .3);
      --shadow-lg: 0 12px 40px rgba(0, 0, 0, .4);
      --shadow-xl: 0 24px 60px rgba(0, 0, 0, .5);

      --modal-bg: #1e293b;
      --modal-overlay: rgba(0, 0, 0, .8);

      --flash-ok-bg: rgba(34, 197, 94, .1);
      --flash-ok-border: rgba(34, 197, 94, .25);
      --flash-ok-text: #4ade80;
      --flash-err-bg: rgba(239, 68, 68, .1);
      --flash-err-border: rgba(239, 68, 68, .25);
      --flash-err-text: #f87171;
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
      transition: background .4s, color .4s;
    }

    /* ══ TOPNAV ══ */
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
      font-size: .82rem;
      font-weight: 600;
      color: var(--muted);
      text-decoration: none;
      transition: all .2s;
      white-space: nowrap;
    }

    .nav-link i {
      font-size: .75rem;
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

    .nav-right {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
      flex-shrink: 0;
    }

    .theme-toggle {
      width: 56px;
      height: 30px;
      border-radius: 50px;
      background: var(--blue-50);
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

    .nav-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--grad-btn);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .85rem;
      font-weight: 700;
      cursor: pointer;
      flex-shrink: 0;
      box-shadow: 0 2px 10px rgba(124, 58, 237, .35);
      overflow: hidden;
      padding: 0;
      text-decoration: none;
    }

    .nav-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }

    .nav-logout {
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

    .nav-logout:hover {
      background: rgba(239, 68, 68, .1);
      color: #ef4444;
    }

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

    /* ══ PAGE ══ */
    .page {
      max-width: 1100px;
      margin: 0 auto;
      padding: 28px 32px 80px;
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(16px)
      }

      to {
        opacity: 1;
        transform: none
      }
    }

    /* ══ FLASH ══ */
    .flash {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 11px 16px;
      border-radius: 12px;
      margin-bottom: 18px;
      font-size: .82rem;
      font-weight: 600;
      animation: fadeUp .4s ease;
    }

    .flash-success {
      background: var(--flash-ok-bg);
      border: 1px solid var(--flash-ok-border);
      color: var(--flash-ok-text);
    }

    .flash-error {
      background: var(--flash-err-bg);
      border: 1px solid var(--flash-err-border);
      color: var(--flash-err-text);
    }

    /* ══ PHOTO TOAST ══ */
    .photo-toast {
      position: fixed;
      top: 80px;
      right: 24px;
      z-index: 999;
      background: var(--grad-btn);
      color: white;
      padding: 14px 20px;
      border-radius: 14px;
      font-size: .83rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 10px;
      box-shadow: 0 8px 32px rgba(124, 58, 237, .35);
      transform: translateX(140%);
      transition: transform .4s cubic-bezier(.34, 1.2, .64, 1);
    }

    .photo-toast.show {
      transform: translateX(0);
    }

    .photo-toast i {
      color: #a5f3fc;
      font-size: 1rem;
    }

    .photo-toast.error {
      background: linear-gradient(135deg, #dc2626, #b91c1c);
    }

    .photo-toast.error i {
      color: #fca5a5;
    }

    /* ══ PROFILE HERO ══ */
    .profile-hero {
      border-radius: 24px;
      overflow: hidden;
      margin-bottom: 28px;
      position: relative;
      animation: fadeUp .5s ease both;
      background: var(--grad-hero);
      box-shadow: var(--shadow-xl);
    }

    .hero-banner-bg {
      height: 160px;
      position: relative;
      overflow: hidden;
      background: linear-gradient(135deg, #1d4ed8 0%, #7c3aed 60%, #9333ea 100%);
    }

    .hero-banner-bg::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image: repeating-linear-gradient(45deg, rgba(255, 255, 255, .03) 0px, rgba(255, 255, 255, .03) 1px, transparent 1px, transparent 28px);
    }

    .hero-banner-bg::after {
      content: '';
      position: absolute;
      top: -80px;
      right: -60px;
      width: 340px;
      height: 340px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(251, 191, 36, .2) 0%, transparent 65%);
    }

    .hero-bottom-wave {
      position: absolute;
      bottom: -1px;
      left: 0;
      right: 0;
      height: 36px;
      background: var(--grad-hero);
      clip-path: ellipse(56% 100% at 50% 100%);
    }

    .hero-content {
      padding: 0 40px 36px;
      display: flex;
      align-items: flex-end;
      gap: 28px;
      position: relative;
    }

    .avatar-upload-wrap {
      margin-top: -60px;
      position: relative;
      flex-shrink: 0;
    }

    .avatar-display {
      width: 112px;
      height: 112px;
      border-radius: 50%;
      border: 4px solid rgba(255, 255, 255, .15);
      box-shadow: 0 0 0 3px rgba(139, 92, 246, .6), 0 8px 28px rgba(0, 0, 0, .35);
      overflow: hidden;
      position: relative;
      background: var(--grad-btn);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .avatar-display img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .avatar-initial {
      font-family: 'Fraunces', serif;
      font-size: 2.4rem;
      font-weight: 700;
      color: white;
      letter-spacing: -2px;
    }

    .avatar-overlay {
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, .5);
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transition: opacity .25s;
      cursor: pointer;
    }

    .avatar-display:hover .avatar-overlay {
      opacity: 1;
    }

    .avatar-overlay i {
      color: white;
      font-size: 1.3rem;
      margin-bottom: 4px;
    }

    .avatar-overlay span {
      color: rgba(255, 255, 255, .85);
      font-size: .6rem;
      font-weight: 700;
      letter-spacing: .05em;
      text-transform: uppercase;
    }

    .avatar-status-dot {
      position: absolute;
      bottom: 7px;
      right: 7px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      background: #4ade80;
      border: 3px solid #1d4ed8;
    }

    #avatarInput {
      display: none;
    }

    .hero-info {
      flex: 1;
      padding-bottom: 6px;
    }

    .hero-name {
      font-family: 'Fraunces', serif;
      font-size: 2rem;
      font-weight: 700;
      font-style: italic;
      color: white;
      line-height: 1.1;
      margin-bottom: 4px;
    }

    .hero-email {
      font-size: .82rem;
      color: rgba(255, 255, 255, .55);
      margin-bottom: 12px;
    }

    .hero-badges {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .hero-badge {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      padding: 4px 12px;
      border-radius: 50px;
      font-size: .72rem;
      font-weight: 700;
      letter-spacing: .04em;
    }

    .badge-role {
      background: rgba(139, 92, 246, .25);
      color: #e9d5ff;
      border: 1px solid rgba(139, 92, 246, .4);
    }

    .badge-aktif {
      background: rgba(34, 197, 94, .15);
      color: #4ade80;
      border: 1px solid rgba(34, 197, 94, .25);
    }

    .hero-actions {
      display: flex;
      gap: 10px;
      margin-left: auto;
      align-self: flex-end;
      padding-bottom: 6px;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 22px;
      border-radius: 50px;
      background: rgba(255, 255, 255, .2);
      color: white;
      font-size: .82rem;
      font-weight: 700;
      cursor: pointer;
      border: 1.5px solid rgba(255, 255, 255, .3);
      transition: all .2s;
      text-decoration: none;
      backdrop-filter: blur(6px);
    }

    .btn-primary:hover {
      background: rgba(255, 255, 255, .3);
      transform: translateY(-1px);
    }

    .btn-ghost {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 10px 22px;
      border-radius: 50px;
      background: rgba(255, 255, 255, .1);
      color: rgba(255, 255, 255, .8);
      font-size: .82rem;
      font-weight: 700;
      cursor: pointer;
      border: 1.5px solid rgba(255, 255, 255, .2);
      transition: all .2s;
      text-decoration: none;
    }

    .btn-ghost:hover {
      background: rgba(255, 255, 255, .18);
      transform: translateY(-1px);
    }

    /* ══ STATS ROW ══ */
    .stats-row {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 14px;
      margin-bottom: 28px;
      animation: fadeUp .5s .1s ease both;
    }

    .stat-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 18px;
      padding: 22px 24px;
      display: flex;
      align-items: center;
      gap: 18px;
      transition: transform .25s, box-shadow .25s;
      position: relative;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 3px;
    }

    .stat-card:nth-child(1)::before {
      background: var(--grad-btn);
    }

    .stat-card:nth-child(2)::before {
      background: linear-gradient(90deg, #3b82f6, #06b6d4);
    }

    .stat-card:nth-child(3)::before {
      background: linear-gradient(90deg, #8b5cf6, #a855f7);
    }

    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
    }

    .stat-icon-wrap {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      flex-shrink: 0;
    }

    .stat-icon-wrap.blue {
      background: var(--blue-50);
      color: var(--blue-600);
    }

    .stat-icon-wrap.cyan {
      background: rgba(6, 182, 212, .08);
      color: #0891b2;
    }

    .stat-icon-wrap.purple {
      background: var(--purple-50);
      color: var(--purple-600);
    }

    [data-theme="dark"] .stat-icon-wrap.cyan {
      color: #22d3ee;
    }

    .stat-num {
      font-family: 'Fraunces', serif;
      font-size: 2.4rem;
      font-weight: 700;
      line-height: 1;
      color: var(--ink);
      margin-bottom: 3px;
    }

    .stat-label {
      font-size: .72rem;
      font-weight: 600;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .06em;
    }

    .stat-trend {
      position: absolute;
      top: 14px;
      right: 14px;
      font-size: .63rem;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 50px;
      letter-spacing: .04em;
      background: var(--blue-50);
      color: var(--blue-600);
    }

    [data-theme="dark"] .stat-trend {
      background: rgba(59, 130, 246, .1);
      color: #93c5fd;
    }

    /* ══ TWO COL ══ */
    .two-col {
      display: grid;
      grid-template-columns: 1fr 1.45fr;
      gap: 20px;
      margin-bottom: 28px;
      animation: fadeUp .5s .2s ease both;
    }

    .info-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
      transition: background .4s, border-color .4s;
    }

    .card-header {
      padding: 16px 22px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: linear-gradient(135deg, var(--blue-50) 0%, var(--purple-50) 100%);
    }

    [data-theme="dark"] .card-header {
      background: rgba(30, 41, 59, .6);
    }

    .card-header-title {
      font-size: .88rem;
      font-weight: 700;
      color: var(--ink);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .card-header-title i {
      color: var(--blue-500);
      font-size: .82rem;
    }

    .card-link {
      font-size: .75rem;
      color: var(--blue-600);
      font-weight: 700;
      cursor: pointer;
      text-decoration: none;
      transition: color .2s;
    }

    .card-link:hover {
      color: var(--purple-600);
    }

    .card-body {
      padding: 20px 22px;
    }

    .info-row {
      display: flex;
      align-items: flex-start;
      padding: 13px 0;
      border-bottom: 1px solid var(--border);
      transition: border-color .35s;
    }

    .info-row:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .info-row:first-child {
      padding-top: 0;
    }

    .info-icon {
      width: 34px;
      height: 34px;
      border-radius: 9px;
      background: var(--blue-50);
      color: var(--blue-600);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: .82rem;
      flex-shrink: 0;
      margin-right: 14px;
      margin-top: 1px;
    }

    [data-theme="dark"] .info-icon {
      background: rgba(59, 130, 246, .1);
    }

    .info-label {
      font-size: .67rem;
      color: var(--muted);
      margin-bottom: 3px;
      text-transform: uppercase;
      letter-spacing: .06em;
      font-weight: 700;
    }

    .info-value {
      font-size: .88rem;
      font-weight: 600;
      color: var(--ink);
    }

    /* ══ ACTIVITY LIST ══ */
    .activity-list {
      display: flex;
      flex-direction: column;
      max-height: 340px;
      overflow-y: auto;
      padding-right: 4px;
    }

    .activity-list::-webkit-scrollbar {
      width: 4px;
    }

    .activity-list::-webkit-scrollbar-track {
      background: transparent;
    }

    .activity-list::-webkit-scrollbar-thumb {
      background: var(--border);
      border-radius: 4px;
    }

    .activity-list::-webkit-scrollbar-thumb:hover {
      background: var(--blue-500);
    }

    .activity-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 13px 0;
      border-bottom: 1px solid var(--border);
    }

    .activity-item:last-child {
      border-bottom: none;
      padding-bottom: 0;
    }

    .activity-item:first-child {
      padding-top: 0;
    }

    .act-cover {
      width: 36px;
      height: 52px;
      border-radius: 3px 8px 8px 3px;
      flex-shrink: 0;
      box-shadow: -1px 2px 8px rgba(37, 99, 235, .15);
    }

    .act-info {
      flex: 1;
    }

    .act-title {
      font-size: .85rem;
      font-weight: 700;
      color: var(--ink);
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 200px;
      margin-bottom: 2px;
    }

    .act-author {
      font-size: .7rem;
      color: var(--muted);
      margin-bottom: 5px;
    }

    .act-status-pill {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 3px 9px;
      border-radius: 50px;
      font-size: .65rem;
      font-weight: 700;
      margin-top: 2px;
    }

    .pill-aktif {
      background: var(--blue-50);
      color: var(--blue-600);
    }

    .pill-selesai {
      background: var(--purple-50);
      color: var(--purple-600);
    }

    .pill-terlambat {
      background: rgba(239, 68, 68, .08);
      color: #dc2626;
    }

    [data-theme="dark"] .pill-terlambat {
      color: #f87171;
    }

    .status-dot {
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: currentColor;
      display: inline-block;
    }

    .act-date {
      font-size: .7rem;
      color: var(--muted);
      text-align: right;
      line-height: 1.6;
    }

    .c1 {
      background: linear-gradient(135deg, #1d4ed8, #7c3aed);
    }

    .c2 {
      background: linear-gradient(135deg, #0891b2, #3b82f6);
    }

    .c3 {
      background: linear-gradient(135deg, #7c3aed, #a855f7);
    }

    .c4 {
      background: linear-gradient(135deg, #2563eb, #8b5cf6);
    }

    .c5 {
      background: linear-gradient(135deg, #1d4ed8, #06b6d4);
    }

    .c8 {
      background: linear-gradient(135deg, #4f46e5, #7c3aed);
    }

    /* ══ ACHIEVEMENTS ══ */
    .achievement-section {
      animation: fadeUp .5s .3s ease both;
      margin-bottom: 40px;
    }

    .section-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 18px;
    }

    .section-label {
      font-size: .62rem;
      font-weight: 800;
      letter-spacing: .18em;
      text-transform: uppercase;
      color: var(--blue-600);
      margin-bottom: 4px;
    }

    .section-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 18px;
      line-height: 1.25;
    }

    .achievement-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 14px;
    }

    .ach-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 20px 16px;
      text-align: center;
      transition: box-shadow .2s, transform .2s;
      position: relative;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
    }

    .ach-card:hover {
      box-shadow: var(--shadow-lg);
      transform: translateY(-3px);
    }

    .ach-card.unlocked {
      border-color: rgba(59, 130, 246, .3);
    }

    .ach-card.locked {
      opacity: .45;
      filter: grayscale(.5);
    }

    .ach-icon {
      width: 54px;
      height: 54px;
      border-radius: 50%;
      margin: 0 auto 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
    }

    .ach-icon.gold {
      background: linear-gradient(135deg, #fef3c7, #fbbf24);
      box-shadow: 0 4px 14px rgba(251, 191, 36, .3);
    }

    .ach-icon.silver {
      background: linear-gradient(135deg, #e2e8f0, #94a3b8);
      box-shadow: 0 4px 14px rgba(148, 163, 184, .3);
    }

    .ach-icon.bronze {
      background: linear-gradient(135deg, #ffedd5, #f97316);
      box-shadow: 0 4px 14px rgba(249, 115, 22, .2);
    }

    .ach-icon.gray {
      background: var(--blue-50);
    }

    .ach-name {
      font-size: .82rem;
      font-weight: 700;
      color: var(--ink);
      margin-bottom: 3px;
    }

    .ach-desc {
      font-size: .7rem;
      color: var(--muted);
      line-height: 1.4;
    }

    .ach-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: .55rem;
      padding: 2px 7px;
      border-radius: 50px;
      font-weight: 700;
      letter-spacing: .05em;
      text-transform: uppercase;
    }

    .ach-badge.done {
      background: var(--blue-50);
      color: var(--blue-600);
    }

    .ach-badge.locked {
      background: var(--blue-50);
      color: var(--muted);
    }

    /* ══ MODAL ══ */
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

    @keyframes popIn {
      from {
        opacity: 0;
        transform: scale(.88)
      }

      to {
        opacity: 1;
        transform: scale(1)
      }
    }

    .modal-box {
      background: var(--modal-bg);
      border-radius: 24px;
      max-width: 480px;
      width: 100%;
      box-shadow: var(--shadow-xl);
      overflow: hidden;
      position: relative;
      animation: popIn .32s cubic-bezier(.34, 1.4, .64, 1);
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
      padding: 28px;
    }

    .modal-title {
      font-family: 'Fraunces', serif;
      font-size: 1.4rem;
      font-weight: 700;
      font-style: italic;
      color: var(--ink);
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      font-size: .72rem;
      font-weight: 700;
      color: var(--muted);
      text-transform: uppercase;
      letter-spacing: .06em;
      margin-bottom: 6px;
      display: block;
    }

    .form-input {
      width: 100%;
      padding: 10px 14px;
      border-radius: 10px;
      border: 1.5px solid var(--border);
      background: var(--search-bg);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: .88rem;
      color: var(--ink);
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    .form-input:focus {
      border-color: var(--blue-500);
      box-shadow: 0 0 0 3px rgba(59, 130, 246, .13);
    }

    .form-btns {
      display: flex;
      gap: 10px;
      margin-top: 22px;
    }

    .btn-form-fill {
      flex: 1;
      padding: 11px;
      border-radius: 50px;
      background: var(--grad-btn);
      color: white;
      border: none;
      font-size: .82rem;
      font-weight: 700;
      cursor: pointer;
      transition: all .2s;
      box-shadow: 0 4px 14px rgba(124, 58, 237, .3);
    }

    .btn-form-fill:hover {
      filter: brightness(1.1);
      transform: translateY(-1px);
    }

    .btn-form-outline {
      flex: 1;
      padding: 11px;
      border-radius: 50px;
      background: transparent;
      color: var(--muted);
      border: 1.5px solid var(--border);
      font-size: .82rem;
      font-weight: 700;
      cursor: pointer;
      transition: all .2s;
    }

    .btn-form-outline:hover {
      border-color: #ef4444;
      color: #ef4444;
    }

    /* ══ RESPONSIVE ══ */
    @media(max-width:900px) {
      .two-col {
        grid-template-columns: 1fr;
      }

      .achievement-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media(max-width:768px) {
      .page {
        padding: 24px 20px 60px;
      }

      .nav-links {
        display: none;
      }

      .stats-row {
        grid-template-columns: 1fr 1fr;
      }

      .hero-actions {
        flex-direction: column;
        gap: 8px;
      }
    }

    @media(max-width:480px) {
      .topnav {
        padding: 0 14px;
        height: 56px;
      }

      .page {
        padding: 16px 14px 60px;
      }

      .hero-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
      }

      .hero-actions {
        margin-left: 0;
      }

      .stats-row {
        grid-template-columns: 1fr 1fr;
        gap: 8px;
      }

      .achievement-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>

<body>
  <div class="theme-transition-flash" id="themeFlash"></div>
  <div class="photo-toast" id="photoToast">
    <i class="fas fa-check-circle"></i>
    <span id="photoToastMsg">Foto profil berhasil diperbarui!</span>
  </div>

  <!-- TOPNAV -->
  <nav class="topnav">
    <a href="{{ route('anggota.dashboard') }}" class="nav-logo">LibCo</a>
    <div class="nav-links">
      <a href="{{ route('anggota.dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Beranda</a>
      <a href="{{ route('anggota.koleksi.index') }}" class="nav-link"><i class="fas fa-book-open"></i> Koleksi</a>
      <a href="{{ route('anggota.riwayat_saya') }}" class="nav-link"><i class="fas fa-history"></i> Riwayat</a>
      <a href="{{ route('anggota.profile.show') }}" class="nav-link active"><i class="fas fa-user"></i> Profil</a>
    </div>
    <div class="nav-right">
      <button class="theme-toggle" id="themeToggle" aria-label="Toggle theme">
        <span class="toggle-moon">🌙</span>
        <div class="toggle-thumb"><span id="toggleEmoji">☀️</span></div>
        <span class="toggle-sun">☀️</span>
      </button>
      <a href="{{ route('anggota.profile.show') }}" class="nav-avatar" id="navAvatarLink" title="{{ auth()->user()->name }}">
        @php
          use Illuminate\Support\Facades\Storage;
          $fotoFileName = auth()->user()->anggota?->foto;
          $fotoUrl = null;
          if ($fotoFileName) {
              try {
                  $fotoUrl = Storage::disk('supabase')->url('images/foto/' . $fotoFileName);
              } catch (\Exception $e) {
                  $fotoUrl = null;
              }
          }
        @endphp
        @if($fotoUrl)
          <img src="{{ $fotoUrl }}" alt="avatar" id="navAvatarImg" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
        @else
          <span id="navAvatarInitial">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
        @endif
      </a>
      <form method="POST" action="/logout" style="display:inline;">
        @csrf
        <button type="submit" class="nav-logout"><i class="fas fa-sign-out-alt"></i></button>
      </form>
    </div>
  </nav>

  <div class="page">
    @if(session('success'))
      <div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif

    <form id="avatarForm" action="{{ route('anggota.profile.uploadFoto') }}" method="POST" enctype="multipart/form-data" style="display:none;">
      @csrf
      <input type="file" name="foto" id="avatarInput" accept="image/jpeg,image/png,image/webp" onchange="handleAvatarChange(this)">
    </form>

    <!-- PROFILE HERO -->
    <div class="profile-hero">
      <div class="hero-banner-bg">
        <div class="hero-bottom-wave"></div>
      </div>
      <div class="hero-content">
        <div class="avatar-upload-wrap">
          <div class="avatar-display" onclick="triggerAvatarUpload()" title="Klik untuk mengganti foto profil">
            @php
              $fotoFileName = auth()->user()->anggota?->foto;
              $fotoUrl = null;
              if ($fotoFileName) {
                  try {
                      $fotoUrl = Storage::disk('supabase')->url('images/foto/' . $fotoFileName);
                  } catch (\Exception $e) {
                      $fotoUrl = null;
                  }
              }
            @endphp
            @if($fotoUrl)
              <img src="{{ $fotoUrl }}" alt="{{ auth()->user()->name }}" id="avatarPreview" style="width:100%;height:100%;object-fit:cover;">
            @else
              <span class="avatar-initial" id="avatarInitialText">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}{{ strtoupper(substr(strstr(auth()->user()->name, ' ') ?: ' ', 1, 1)) }}
              </span>
              <img src="" alt="" id="avatarPreview" style="display:none;width:100%;height:100%;object-fit:cover;">
            @endif
            <div class="avatar-overlay">
              <i class="fas fa-camera"></i>
              <span>Ganti Foto</span>
            </div>
          </div>
          <div class="avatar-status-dot"></div>
        </div>
        <div class="hero-info">
          <div class="hero-name">{{ auth()->user()->name }}</div>
          <div class="hero-email"><i class="far fa-envelope" style="margin-right:5px;opacity:.5;"></i>{{ auth()->user()->email }}</div>
          <div class="hero-badges">
            <span class="hero-badge badge-role"><i class="fas fa-crown" style="font-size:.6rem;"></i> {{ ucfirst(auth()->user()->role) }}</span>
            <span class="hero-badge badge-aktif"><i class="fas fa-circle" style="font-size:.4rem;"></i> Akun Aktif</span>
          </div>
        </div>
        <div class="hero-actions">
          <button class="btn-ghost" onclick="openEditModal()"><i class="fas fa-pen"></i> Edit Profil</button>
          <button class="btn-primary" onclick="triggerAvatarUpload()"><i class="fas fa-camera"></i> Ganti Foto</button>
        </div>
      </div>
    </div>

    <!-- STATS -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-icon-wrap blue"><i class="fas fa-book-reader"></i></div>
        <div>
          <div class="stat-num">{{ $totalPeminjaman ?? 0 }}</div>
          <div class="stat-label">Total Peminjaman</div>
        </div>
        <span class="stat-trend">Sepanjang waktu</span>
      </div>
      <div class="stat-card">
        <div class="stat-icon-wrap cyan"><i class="fas fa-clock"></i></div>
        <div>
          <div class="stat-num">{{ $sedangDipinjam ?? 0 }}</div>
          <div class="stat-label">Sedang Dipinjam</div>
        </div>
        <span class="stat-trend" style="background:rgba(6,182,212,.1);color:#0891b2;">Aktif</span>
      </div>
      <div class="stat-card">
        <div class="stat-icon-wrap purple"><i class="fas fa-check-circle"></i></div>
        <div>
          <div class="stat-num">{{ $sudahDikembalikan ?? 0 }}</div>
          <div class="stat-label">Sudah Dikembalikan</div>
        </div>
        <span class="stat-trend" style="background:var(--purple-50);color:var(--purple-600);">✓ Selesai</span>
      </div>
    </div>

    <!-- TWO COL -->
    <div class="two-col">
      <!-- Informasi Akun -->
      <div class="info-card">
        <div class="card-header">
          <div class="card-header-title"><i class="fas fa-id-card"></i> Informasi Akun</div>
          <a href="#" class="card-link" onclick="openEditModal();return false;"><i class="fas fa-pen" style="font-size:.65rem;margin-right:3px;"></i> Ubah</a>
        </div>
        <div class="card-body">
          <div class="info-row">
            <div class="info-icon"><i class="fas fa-user"></i></div>
            <div>
              <div class="info-label">Nama Lengkap</div>
              <div class="info-value">{{ auth()->user()->name }}</div>
            </div>
          </div>
          <div class="info-row">
            <div class="info-icon"><i class="far fa-envelope"></i></div>
            <div>
              <div class="info-label">Alamat Email</div>
              <div class="info-value">{{ auth()->user()->email }}</div>
            </div>
          </div>
          <div class="info-row">
            <div class="info-icon"><i class="fas fa-shield-alt"></i></div>
            <div>
              <div class="info-label">Role / Peran</div>
              <div class="info-value" style="display:flex;align-items:center;gap:8px;">
                {{ ucfirst(auth()->user()->role) }}
                <span style="width:6px;height:6px;border-radius:50%;background:var(--blue-500);display:inline-block;"></span>
              </div>
            </div>
          </div>
          <div class="info-row">
            <div class="info-icon"><i class="far fa-calendar-alt"></i></div>
            <div>
              <div class="info-label">Bergabung Sejak</div>
              <div class="info-value">{{ auth()->user()->created_at->format('d M Y') }}</div>
            </div>
          </div>
          <div class="info-row">
            <div class="info-icon"><i class="fas fa-image"></i></div>
            <div>
              <div class="info-label">Foto Profil</div>
              <div class="info-value" style="display:flex;align-items:center;gap:10px;">
                @if($fotoUrl)
                  <span style="color:var(--blue-600);font-size:.82rem;">📸 Sudah dipasang</span>
                  <button onclick="triggerAvatarUpload()" style="font-size:.73rem;color:var(--blue-600);font-weight:700;background:none;border:none;cursor:pointer;padding:0;">Ganti</button>
                @else
                  <span style="color:var(--muted);font-size:.82rem;">Belum ada foto</span>
                  <button onclick="triggerAvatarUpload()" style="font-size:.73rem;color:var(--blue-600);font-weight:700;background:none;border:none;cursor:pointer;padding:0;">Upload</button>
                @endif
              </div>
            </div>
          </div>
          <div class="info-row">
            <div class="info-icon"><i class="fas fa-lock"></i></div>
            <div>
              <div class="info-label">Password</div>
              <div class="info-value" style="display:flex;align-items:center;gap:10px;">
                <span style="letter-spacing:3px;font-size:.7rem;color:var(--muted);">••••••••••</span>
                <a href="#" style="font-size:.73rem;color:var(--blue-600);font-weight:700;text-decoration:none;" onclick="openEditModal();return false;">Ganti</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Aktivitas Terakhir -->
      <div class="info-card">
        <div class="card-header">
          <div class="card-header-title"><i class="fas fa-history"></i> Aktivitas Terakhir</div>
        </div>
        <div class="card-body">
          <div class="activity-list">
            @forelse($riwayat ?? [] as $item)
              <div class="activity-item">
                <div class="act-cover {{ ['c1', 'c2', 'c3', 'c4', 'c5', 'c8'][$loop->index % 6] }}"></div>
                <div class="act-info">
                  <div class="act-title">{{ $item->ebook->judul_buku ?? 'Judul Buku' }}</div>
                  <div class="act-author">{{ $item->ebook->pengarang ?? 'Pengarang' }}</div>
                  <span class="act-status-pill {{ $item->status === 'aktif' ? 'pill-aktif' : ($item->status === 'terlambat' ? 'pill-terlambat' : 'pill-selesai') }}">
                    <span class="status-dot"></span> {{ ucfirst($item->status) }}
                  </span>
                </div>
                <div class="act-date">
                  {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}<br>
                  <span>s/d {{ \Carbon\Carbon::parse($item->tgl_kembali)->format('d M Y') }}</span>
                </div>
              </div>
            @empty
              <div style="padding:24px 0;text-align:center;color:var(--muted);font-size:.83rem;">
                <i class="fas fa-book-open" style="font-size:2rem;margin-bottom:10px;display:block;opacity:.25;color:var(--blue-500);"></i>
                Belum ada aktivitas peminjaman
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    <!-- PENCAPAIAN -->
    <div class="achievement-section">
      <div class="section-header">
        <div>
          <div class="section-label">Lencana</div>
          <div class="section-title" style="margin-bottom:0;">Pencapaian Kamu</div>
        </div>
      </div>
      <div class="achievement-grid">
        <div class="ach-card {{ $totalPeminjaman >= 1 ? 'unlocked' : 'locked' }}">
          <span class="ach-badge {{ $totalPeminjaman >= 1 ? 'done' : 'locked' }}">{{ $totalPeminjaman >= 1 ? 'Diraih' : 'Terkunci' }}</span>
          <div class="ach-icon gold">📚</div>
          <div class="ach-name">Pembaca Pertama</div>
          <div class="ach-desc">Pinjam buku pertama kali</div>
        </div>
        <div class="ach-card {{ \Carbon\Carbon::parse(auth()->user()->created_at)->diffInMonths(now()) >= 3 ? 'unlocked' : 'locked' }}">
          <span class="ach-badge {{ \Carbon\Carbon::parse(auth()->user()->created_at)->diffInMonths(now()) >= 3 ? 'done' : 'locked' }}">
            {{ \Carbon\Carbon::parse(auth()->user()->created_at)->diffInMonths(now()) >= 3 ? 'Diraih' : 'Terkunci' }}
          </span>
          <div class="ach-icon gold">⭐</div>
          <div class="ach-name">Anggota Setia</div>
          <div class="ach-desc">Aktif selama 3 bulan</div>
        </div>
        <div class="ach-card {{ $totalPeminjaman >= 10 ? 'unlocked' : 'locked' }}">
          <span class="ach-badge {{ $totalPeminjaman >= 10 ? 'done' : 'locked' }}">{{ $totalPeminjaman >= 10 ? 'Diraih' : 'Terkunci' }}</span>
          <div class="ach-icon bronze">🔥</div>
          <div class="ach-name">Pembaca Aktif</div>
          <div class="ach-desc">Pinjam 10 buku</div>
        </div>
        <div class="ach-card {{ $totalPeminjaman >= 50 ? 'unlocked' : 'locked' }}">
          <span class="ach-badge {{ $totalPeminjaman >= 50 ? 'done' : 'locked' }}">{{ $totalPeminjaman >= 50 ? 'Diraih' : 'Terkunci' }}</span>
          <div class="ach-icon gray">🏆</div>
          <div class="ach-name">Kutu Buku</div>
          <div class="ach-desc">
            @if($totalPeminjaman < 50) Pinjam 50 buku — {{ 50 - $totalPeminjaman }} lagi!
            @else Pinjam 50 buku @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- EDIT MODAL -->
  <div class="modal-overlay" id="editModalOverlay">
    <div class="modal-box" style="max-width:560px;">
      <div class="modal-strip"></div>
      <button class="modal-close" onclick="closeEditModal()">✕</button>
      <div class="modal-inner">
        <div class="modal-title">Edit Profil</div>

        {{-- TAB SWITCHER --}}
        <div style="display:flex;gap:4px;margin-bottom:22px;background:var(--cream2);border-radius:12px;padding:4px;">
          <button type="button" id="tabBtnAkun" onclick="switchTab('akun')" style="flex:1;padding:8px;border-radius:9px;border:none;cursor:pointer;font-size:.8rem;font-weight:700;background:var(--grad-btn);color:white;transition:all .2s;font-family:'Plus Jakarta Sans',sans-serif;">
            <i class="fas fa-lock" style="margin-right:5px;font-size:.7rem;"></i>Data Akun
          </button>
          <button type="button" id="tabBtnDiri" onclick="switchTab('diri')" style="flex:1;padding:8px;border-radius:9px;border:none;cursor:pointer;font-size:.8rem;font-weight:700;background:transparent;color:var(--muted);transition:all .2s;font-family:'Plus Jakarta Sans',sans-serif;">
            <i class="fas fa-id-card" style="margin-right:5px;font-size:.7rem;"></i>Data Diri
          </button>
        </div>

        <form method="POST" action="{{ route('anggota.profile.update') }}">
          @csrf @method('PUT')

          {{-- PANEL: Data Akun --}}
          <div id="panelAkun">
            <div class="form-group">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="name" class="form-input" value="{{ old('name', auth()->user()->name) }}" required>
            </div>
            <div class="form-group">
              <label class="form-label">Alamat Email</label>
              <input type="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            <div class="form-group">
              <label class="form-label">
                Password Baru
                <span style="color:var(--muted);font-weight:400;text-transform:none;letter-spacing:0;">(kosongkan jika tidak ingin mengubah)</span>
              </label>
              <input type="password" name="password" class="form-input" placeholder="••••••••">
            </div>
            <div class="form-group">
              <label class="form-label">Konfirmasi Password Baru</label>
              <input type="password" name="password_confirmation" class="form-input" placeholder="••••••••">
            </div>
          </div>

          {{-- PANEL: Data Diri --}}
          <div id="panelDiri" style="display:none;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">No HP</label>
                <input type="text" name="nohp" class="form-input" value="{{ old('nohp', auth()->user()->anggota?->nohp) }}" placeholder="08xxxxxxxxxx">
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Kota</label>
                <input type="text" name="kota" class="form-input" value="{{ old('kota', auth()->user()->anggota?->kota) }}" placeholder="Kota domisili">
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-input">
                  <option value="">-- Pilih --</option>
                  <option value="L" {{ old('jenis_kelamin', auth()->user()->anggota?->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ old('jenis_kelamin', auth()->user()->anggota?->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Agama</label>
                <select name="agama" class="form-input">
                  <option value="">-- Pilih --</option>
                  @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $ag)
                    <option value="{{ $ag }}" {{ old('agama', auth()->user()->anggota?->agama) == $ag ? 'selected' : '' }}>{{ $ag }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:16px;">
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-input" value="{{ old('tempat_lahir', auth()->user()->anggota?->tempat_lahir) }}" placeholder="Kota kelahiran">
              </div>
              <div class="form-group" style="margin-bottom:0;">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-input" value="{{ old('tgl_lahir', auth()->user()->anggota?->tgl_lahir) }}">
              </div>
            </div>
          </div>

          <div class="form-btns" style="margin-top:22px;">
            <button type="button" class="btn-form-outline" onclick="closeEditModal()">Batal</button>
            <button type="submit" class="btn-form-fill"><i class="fas fa-save"></i> Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    /* THEME */
    const html = document.documentElement,
      themeFlash = document.getElementById('themeFlash'),
      toggleEmoji = document.getElementById('toggleEmoji');
    (function () { const t = localStorage.getItem('libco-theme') || 'light'; html.setAttribute('data-theme', t); toggleEmoji.textContent = t === 'dark' ? '🌙' : '☀️'; })();
    document.getElementById('themeToggle').addEventListener('click', () => {
      const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      themeFlash.classList.add('active'); setTimeout(() => themeFlash.classList.remove('active'), 300);
      html.setAttribute('data-theme', next);
      toggleEmoji.textContent = next === 'dark' ? '🌙' : '☀️';
      localStorage.setItem('libco-theme', next);
    });

    /* MODAL */
    function openEditModal() { document.getElementById('editModalOverlay').classList.add('show'); document.body.style.overflow = 'hidden'; }
    function closeEditModal() { document.getElementById('editModalOverlay').classList.remove('show'); document.body.style.overflow = ''; }
    document.getElementById('editModalOverlay').addEventListener('click', function (e) { if (e.target === this) closeEditModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeEditModal(); });

    /* TAB MODAL */
    function switchTab(tab) {
      const isAkun = tab === 'akun';
      document.getElementById('panelAkun').style.display = isAkun ? '' : 'none';
      document.getElementById('panelDiri').style.display = isAkun ? 'none' : '';

      const activeStyle = 'flex:1;padding:8px;border-radius:9px;border:none;cursor:pointer;font-size:.8rem;font-weight:700;background:var(--grad-btn);color:white;transition:all .2s;font-family:\'Plus Jakarta Sans\',sans-serif;';
      const inactiveStyle = 'flex:1;padding:8px;border-radius:9px;border:none;cursor:pointer;font-size:.8rem;font-weight:700;background:transparent;color:var(--muted);transition:all .2s;font-family:\'Plus Jakarta Sans\',sans-serif;';

      document.getElementById('tabBtnAkun').style.cssText = isAkun ? activeStyle : inactiveStyle;
      document.getElementById('tabBtnDiri').style.cssText = isAkun ? inactiveStyle : activeStyle;
    }

    /* AVATAR */
    function triggerAvatarUpload() { document.getElementById('avatarInput').click(); }
    
    function handleAvatarChange(input) {
      if (!input.files || !input.files[0]) return;
      const file = input.files[0];
      if (file.size > 2 * 1024 * 1024) { showToast('Ukuran foto maksimal 2MB!', true); return; }
      
      // Preview lokal dulu
      const reader = new FileReader();
      reader.onload = function(e) { updateAvatarUI(e.target.result); };
      reader.readAsDataURL(file);
      
      // Upload ke server
      const fd = new FormData();
      fd.append('_token', '{{ csrf_token() }}');
      fd.append('foto', file);
      
      fetch('{{ route("anggota.profile.uploadFoto") }}', { method: 'POST', body: fd })
        .then(response => response.json())
        .then(data => {
          if (data.success) { 
            updateAvatarUI(data.url); 
            showToast('Foto profil berhasil diperbarui! 🎉', false);
            // Refresh page after 1.5 seconds to ensure all data is updated
            setTimeout(() => location.reload(), 1500);
          } else { 
            showToast(data.message || 'Gagal mengunggah foto.', true);
            location.reload();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showToast('Terjadi kesalahan. Coba lagi.', true);
          location.reload();
        });
    }
    
    function updateAvatarUI(src) {
      // Update hero avatar
      const preview = document.getElementById('avatarPreview');
      const initialText = document.getElementById('avatarInitialText');
      if (preview) { 
        preview.src = src; 
        preview.style.display = 'block'; 
      }
      if (initialText) initialText.style.display = 'none';
      
      // Update navbar avatar
      const navInitial = document.getElementById('navAvatarInitial');
      let navImg = document.getElementById('navAvatarImg');
      const navLink = document.getElementById('navAvatarLink');
      
      if (navInitial) navInitial.style.display = 'none';
      if (navImg) { 
        navImg.src = src; 
      } else if (navLink) {
        navImg = document.createElement('img');
        navImg.id = 'navAvatarImg';
        navImg.alt = 'avatar';
        navImg.style.cssText = 'width:100%;height:100%;object-fit:cover;border-radius:50%;';
        navImg.src = src;
        navLink.appendChild(navImg);
      }
    }
    
    function showToast(msg, isError) {
      const toast = document.getElementById('photoToast'), 
            msgEl = document.getElementById('photoToastMsg'), 
            icon = toast.querySelector('i');
      msgEl.textContent = msg;
      if (isError) { 
        toast.classList.add('error'); 
        icon.className = 'fas fa-exclamation-circle'; 
      } else { 
        toast.classList.remove('error'); 
        icon.className = 'fas fa-check-circle'; 
      }
      toast.classList.add('show');
      setTimeout(() => toast.classList.remove('show'), 3500);
    }

    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
          openEditModal();
          @if($errors->has('nohp') || $errors->has('kota') || $errors->has('jenis_kelamin') || $errors->has('agama') || $errors->has('tempat_lahir') || $errors->has('tgl_lahir'))
            switchTab('diri');
          @endif
      });
    @endif

    document.querySelectorAll('.ach-card').forEach((card, i) => { card.style.animation = `fadeUp 0.4s ${0.3 + i * 0.07}s ease both`; });
  </script>
</body>

</html>