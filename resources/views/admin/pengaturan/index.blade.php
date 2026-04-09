@extends('layouts.admin')

@section('content')
@php
  $tab = session('tab', 'password');
  $s   = $appSettings;
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Manrope:wght@400;500;600;700;800&display=swap');

:root {
  --primary:   #4f46e5;
  --primary-lt:#6366f1;
  --accent:    #7c3aed;
  --accent-lt: #a78bfa;
  --bg:        #f5f3ff;
  --bg2:       #eef2ff;
  --ink:       #1e1b4b;
  --mu:        #6b7280;
  --bd:        #ddd6fe;
  --wh:        #ffffff;
  --red:       #dc2626;
  --grn:       #16a34a;
  --grad:      linear-gradient(135deg, #4f46e5, #7c3aed);
}

* { box-sizing: border-box; }
.pg { padding: 32px; font-family: 'Manrope', sans-serif; color: var(--ink); max-width: 860px; }

/* ── Page title ── */
.pg-title {
  font-family: 'DM Serif Display', serif;
  font-size: 2.1rem; margin: 0 0 6px; letter-spacing: -.02em;
}
.pg-title em {
  background: var(--grad);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  font-style: italic;
}
.pg-sub { color: var(--mu); font-size: 0.83rem; margin: 0 0 28px; }

/* ── Tab nav ── */
.tnav {
  display: flex; gap: 2px; margin-bottom: 28px;
  border-bottom: 2px solid var(--bd); padding-bottom: 0;
}
.tbtn {
  padding: 10px 22px 12px; border: none; background: none;
  font-family: 'Manrope', sans-serif; font-size: 0.82rem; font-weight: 700;
  color: var(--mu); cursor: pointer; position: relative; transition: color .2s;
  letter-spacing: .02em;
}
.tbtn::after {
  content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
  height: 2px; background: var(--primary); border-radius: 2px 2px 0 0;
  transform: scaleX(0); transition: transform .25s cubic-bezier(.4,0,.2,1);
}
.tbtn.on { color: var(--primary); }
.tbtn.on::after { transform: scaleX(1); }
.tbtn:hover { color: var(--ink); }

/* ── Panels ── */
.tpanel { display: none; animation: fadeUp .28s ease both; }
.tpanel.on { display: block; }
@keyframes fadeUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:none} }

/* ── Section card ── */
.scard {
  background: var(--wh); border-radius: 16px;
  padding: 28px 30px; margin-bottom: 20px;
  box-shadow: 0 1px 3px rgba(79,70,229,.06), 0 4px 16px rgba(79,70,229,.08);
  border: 1px solid var(--bd);
}
.scard-label {
  font-size: 0.65rem; font-weight: 800; letter-spacing: .12em;
  color: var(--primary); text-transform: uppercase; margin: 0 0 20px;
  display: flex; align-items: center; gap: 10px;
}
.scard-label::after { content:''; flex:1; height:1px; background:var(--bd); }

/* ── Fields ── */
.frow  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
.frow1 { grid-template-columns: 1fr; }
.frow3 { grid-template-columns: 1fr 1fr 1fr; }
.field { display: flex; flex-direction: column; gap: 5px; }
.field label {
  font-size: 0.7rem; font-weight: 700; color: var(--mu);
  text-transform: uppercase; letter-spacing: .05em;
}
.field input, .field textarea {
  border: 1.5px solid var(--bd); border-radius: 10px;
  padding: 10px 14px; font-size: 0.88rem; color: var(--ink);
  font-family: 'Manrope', sans-serif; background: var(--bg2); outline: none;
  transition: border .2s, box-shadow .2s, background .2s;
}
.field input:focus, .field textarea:focus {
  border-color: var(--primary); background: var(--wh);
  box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}
.field input.err-inp { border-color: var(--red); background: #fff5f5; }
.field textarea { resize: vertical; min-height: 78px; }
.ferr { font-size: 0.71rem; color: var(--red); font-weight: 600; }

/* ── Password strength ── */
.pw-meter { height: 4px; background: var(--bd); border-radius: 4px; margin-top: 7px; overflow: hidden; }
.pw-fill  { height: 100%; border-radius: 4px; transition: width .35s, background .35s; width: 0; }
.pw-hint  { font-size: 0.7rem; font-weight: 700; margin-top: 4px; display: block; }

/* ── Info notice ── */
.notice {
  display: flex; gap: 10px; align-items: flex-start;
  background: var(--bg); border-radius: 10px; padding: 13px 16px;
  font-size: 0.79rem; color: var(--mu); margin-bottom: 20px; line-height: 1.5;
  border: 1px solid var(--bd);
}
.notice .ni { font-size: 1rem; flex-shrink: 0; }

/* ── Stat inputs (maks & durasi) ── */
.stat-inputs { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px; }
.stat-inp-box {
  background: var(--bg2); border-radius: 12px; padding: 18px 20px;
  border: 1.5px solid var(--bd); border-left: 4px solid var(--primary);
  transition: border-color .2s, background .2s;
}
.stat-inp-box:focus-within { border-color: var(--primary); background: var(--wh); }
.stat-inp-box label { font-size: 0.65rem; font-weight: 800; color: var(--mu); text-transform: uppercase; letter-spacing:.07em; }
.stat-inp-box input {
  display: block; width: 100%; border: none; background: transparent;
  font-size: 1.8rem; font-weight: 800; color: var(--primary);
  font-family: 'DM Serif Display', serif; outline: none; margin: 4px 0 2px;
}
.stat-inp-box span { font-size: 0.72rem; color: var(--mu); }

/* ── Tema cards ── */
.tema-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 12px; margin-bottom: 24px; }
.tema-card {
  border: 2px solid var(--bd); border-radius: 12px; overflow: hidden;
  cursor: pointer; transition: border-color .2s, transform .15s, box-shadow .2s;
  position: relative;
}
.tema-card:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(79,70,229,.12); }
.tema-card.picked { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(99,102,241,.2); }
.tema-preview { height: 72px; position: relative; overflow: hidden; }
.tema-preview .bar { position: absolute; left: 0; top: 0; bottom: 0; width: 36%; }
.tema-preview .content { position: absolute; left: 36%; right: 0; top: 0; bottom: 0; }
.tema-preview .dot { width: 8px; height: 8px; border-radius: 50%; position: absolute; }

/* Libco */
.t-libco .bar     { background: linear-gradient(180deg, #4f46e5, #7c3aed); }
.t-libco .content { background: #eef2ff; }
.t-libco .dot     { background: #a78bfa; top: 14px; left: 8px; }

/* Warm */
.t-warm .bar    { background: #2b1d0e; }
.t-warm .content{ background: #f7f0e3; }
.t-warm .dot    { background: #c8832a; top: 14px; left: 8px; }
/* Dark */
.t-dark .bar    { background: #0f0f0f; }
.t-dark .content{ background: #1a1a1a; }
.t-dark .dot    { background: #6366f1; top: 14px; left: 8px; }
/* Sage */
.t-sage .bar    { background: #2d4a3e; }
.t-sage .content{ background: #f0f7f4; }
.t-sage .dot    { background: #4a9e7d; top: 14px; left: 8px; }
/* Slate */
.t-slate .bar   { background: #1e2a3a; }
.t-slate .content{ background: #f0f4f8; }
.t-slate .dot   { background: #4a7fb5; top: 14px; left: 8px; }

.tema-name { padding: 10px 12px; font-size: 0.78rem; font-weight: 700; }
.tema-check {
  position: absolute; top: 7px; right: 7px;
  width: 20px; height: 20px; border-radius: 50%;
  background: var(--grad);
  color: white; display: none; align-items: center; justify-content: center; font-size: 0.65rem;
}
.tema-card.picked .tema-check { display: flex; }
.tema-card input[type=radio] { display: none; }

/* Sidebar style picker */
.sb-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 24px; }
.sb-opt {
  border: 2px solid var(--bd); border-radius: 10px; padding: 14px;
  cursor: pointer; text-align: center; transition: border-color .2s, background .2s;
  font-size: 0.8rem; font-weight: 700; color: var(--mu);
}
.sb-opt:hover { border-color: var(--primary); color: var(--ink); }
.sb-opt.picked { border-color: var(--primary); background: var(--bg2); color: var(--primary); }
.sb-opt .sb-icon { font-size: 1.4rem; display: block; margin-bottom: 5px; }
.sb-opt input[type=radio] { display: none; }

/* ── Save button ── */
.btn-save {
  background: var(--grad); color: white; border: none;
  padding: 11px 26px; border-radius: 10px; font-weight: 700;
  font-size: 0.88rem; cursor: pointer; font-family: 'Manrope', sans-serif;
  display: inline-flex; align-items: center; gap: 8px;
  transition: opacity .2s, transform .1s;
  box-shadow: 0 4px 16px rgba(79,70,229,.35);
}
.btn-save:hover  { opacity: .88; }
.btn-save:active { transform: scale(.97); }
.btn-row { display: flex; justify-content: flex-end; margin-top: 6px; }

/* ── Toast ── */
.toast-wrap { position: fixed; bottom: 28px; right: 28px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
.toast {
  display: flex; align-items: center; gap: 12px;
  background: var(--ink); color: white; padding: 14px 20px;
  border-radius: 12px; font-size: 0.84rem; font-weight: 600;
  box-shadow: 0 8px 28px rgba(79,70,229,.25); min-width: 260px; max-width: 340px;
  animation: tIn .35s cubic-bezier(.4,0,.2,1);
}
.toast-icon { font-size: 1.1rem; flex-shrink: 0; }
.toast-bar  {
  position: absolute; bottom: 0; left: 0; height: 3px;
  background: var(--grad); border-radius: 0 0 12px 12px;
  animation: tBar 3.5s linear forwards;
}
@keyframes tIn  { from{opacity:0;transform:translateY(16px) scale(.95)} to{opacity:1;transform:none} }
@keyframes tOut { to{opacity:0;transform:translateY(8px) scale(.95)} }
@keyframes tBar { from{width:100%} to{width:0} }

@media(max-width:700px){
  .pg { padding: 16px; }
  .frow, .frow3, .tema-grid, .stat-inputs, .sb-grid { grid-template-columns: 1fr 1fr; }
  .tema-grid { grid-template-columns: 1fr 1fr; }
  .sb-grid   { grid-template-columns: 1fr 1fr 1fr; }
}
@media(max-width:480px){
  .frow3, .tema-grid { grid-template-columns: 1fr; }
}

</style>

<div class="pg">

  <h1 class="pg-title">Peng<em>aturan</em></h1>
  <p class="pg-sub">Keamanan, konfigurasi aplikasi, dan tampilan sistem</p>

  {{-- Tab Nav --}}
  <div class="tnav">
    <button class="tbtn {{ $tab==='password' ?'on':'' }}" onclick="goTab('password')">🔑 Keamanan</button>
    <button class="tbtn {{ $tab==='aplikasi' ?'on':'' }}" onclick="goTab('aplikasi')">⚙️ Aplikasi</button>
    <button class="tbtn {{ $tab==='tema'     ?'on':'' }}" onclick="goTab('tema')">🎨 Tampilan</button>
  </div>

  {{-- ════════════════════════════════
       TAB: KEAMANAN / PASSWORD
  ════════════════════════════════ --}}
  <div id="tab-password" class="tpanel {{ $tab==='password'?'on':'' }}">
    @if(session('success_password'))
      <script>document.addEventListener('DOMContentLoaded',()=>toast('{{ session('success_password') }}','✅'))</script>
    @endif

    <form method="POST" action="{{ route('admin.pengaturan.password') }}">
      @csrf @method('PUT')
      <div class="scard">
        <p class="scard-label">Ganti Password</p>

        <div class="notice">
          <span class="ni">🛡️</span>
          Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol agar password lebih kuat.
        </div>

        <div class="frow frow1" style="max-width:420px; gap:14px;">
          <div class="field">
            <label>Password Lama</label>
            <input type="password" name="password_lama" placeholder="••••••••" autocomplete="current-password"
                   class="{{ $errors->has('password_lama') ? 'err-inp' : '' }}">
            @error('password_lama')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <label>Password Baru</label>
            <input type="password" name="password_baru" id="pwNew" placeholder="••••••••"
                   autocomplete="new-password" oninput="pwStrength(this.value)"
                   class="{{ $errors->has('password_baru') ? 'err-inp' : '' }}">
            <div class="pw-meter"><div class="pw-fill" id="pwFill"></div></div>
            <span class="pw-hint" id="pwHint"></span>
            @error('password_baru')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_baru_confirmation" placeholder="••••••••" autocomplete="new-password">
          </div>
        </div>

        <div class="btn-row" style="margin-top:20px;">
          <button type="submit" class="btn-save">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
            Ubah Password
          </button>
        </div>
      </div>
    </form>
  </div>

  {{-- ════════════════════════════════
       TAB: PENGATURAN APLIKASI
  ════════════════════════════════ --}}
  <div id="tab-aplikasi" class="tpanel {{ $tab==='aplikasi'?'on':'' }}">
    @if(session('success_aplikasi'))
      <script>document.addEventListener('DOMContentLoaded',()=>toast('{{ session('success_aplikasi') }}','✅'))</script>
    @endif

    <form method="POST" action="{{ route('admin.pengaturan.aplikasi') }}">
      @csrf @method('PUT')

      {{-- Identitas --}}
      <div class="scard">
        <p class="scard-label">Identitas Perpustakaan</p>
        <div class="frow frow1" style="margin-bottom:14px;">
          <div class="field">
            <label>Nama Aplikasi</label>
            <input type="text" name="nama_aplikasi"
                   value="{{ old('nama_aplikasi', $s['nama_aplikasi'] ?? 'Perpustakaan Digital') }}"
                   placeholder="Nama perpustakaan">
            @error('nama_aplikasi')<span class="ferr">{{ $message }}</span>@enderror
          </div>
        </div>
        <div class="frow frow1" style="margin-bottom:14px;">
          <div class="field">
            <label>Deskripsi Singkat</label>
            <textarea name="deskripsi" placeholder="Deskripsi singkat...">{{ old('deskripsi', $s['deskripsi'] ?? '') }}</textarea>
          </div>
        </div>
        <div class="frow frow3">
          <div class="field">
            <label>Email Kontak</label>
            <input type="email" name="email_kontak"
                   value="{{ old('email_kontak', $s['email_kontak'] ?? '') }}"
                   placeholder="kontak@email.com">
            @error('email_kontak')<span class="ferr">{{ $message }}</span>@enderror
          </div>
          <div class="field">
            <label>No. Telepon</label>
            <input type="text" name="telp_kontak"
                   value="{{ old('telp_kontak', $s['telp_kontak'] ?? '') }}"
                   placeholder="08xxxxxxxxxx">
          </div>
          <div class="field">
            <label>Alamat</label>
            <input type="text" name="alamat"
                   value="{{ old('alamat', $s['alamat'] ?? '') }}"
                   placeholder="Alamat perpustakaan">
          </div>
        </div>
      </div>

      {{-- Aturan Peminjaman --}}
      <div class="scard">
        <p class="scard-label">Aturan Peminjaman</p>
        <div class="stat-inputs">
          <div class="stat-inp-box">
            <label>Maks. Buku Dipinjam</label>
            <input type="number" name="maks_pinjam" min="1" max="30"
                   value="{{ old('maks_pinjam', $s['maks_pinjam'] ?? 3) }}">
            <span>buku sekaligus / anggota</span>
            @error('maks_pinjam')<p class="ferr" style="margin-top:4px">{{ $message }}</p>@enderror
          </div>
          <div class="stat-inp-box">
            <label>Durasi Peminjaman</label>
            <input type="number" name="durasi_pinjam" min="1" max="90"
                   value="{{ old('durasi_pinjam', $s['durasi_pinjam'] ?? 7) }}">
            <span>hari sebelum tenggat</span>
            @error('durasi_pinjam')<p class="ferr" style="margin-top:4px">{{ $message }}</p>@enderror
          </div>
        </div>
        <div class="notice">
          <span class="ni">💡</span>
          Pengaturan berlaku untuk transaksi baru. Transaksi yang sudah ada tidak terpengaruh.
        </div>
        <div class="btn-row">
          <button type="submit" class="btn-save">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            Simpan Pengaturan
          </button>
        </div>
      </div>
    </form>
  </div>

  {{-- ════════════════════════════════
       TAB: TAMPILAN / TEMA
  ════════════════════════════════ --}}
  <div id="tab-tema" class="tpanel {{ $tab==='tema'?'on':'' }}">
    @if(session('success_tema'))
      <script>document.addEventListener('DOMContentLoaded',()=>toast('{{ session('success_tema') }}','🎨'))</script>
    @endif

    <form method="POST" action="{{ route('admin.pengaturan.tema') }}">
      @csrf @method('PUT')

      <div class="scard">
        <p class="scard-label">Pilih Tema Warna</p>

        @php $activeTema = $s['tema'] ?? 'warm'; @endphp
        <div class="tema-grid">
          @foreach([
            ['val'=>'libco',  'label'=>'Libco',       'cls'=>'t-libco'], 
            ['val'=>'warm',  'label'=>'Warm Ivory',  'cls'=>'t-warm'],
            ['val'=>'dark',  'label'=>'Midnight',    'cls'=>'t-dark'],
            ['val'=>'sage',  'label'=>'Sage Forest', 'cls'=>'t-sage'],
            ['val'=>'slate', 'label'=>'Ocean Slate', 'cls'=>'t-slate'],
          ] as $t)
          <label class="tema-card {{ $activeTema===$t['val'] ? 'picked' : '' }}" onclick="pickTema('{{ $t['val'] }}')">
            <input type="radio" name="tema" value="{{ $t['val'] }}" {{ $activeTema===$t['val']?'checked':'' }}>
            <div class="tema-preview {{ $t['cls'] }}">
              <div class="bar"></div>
              <div class="content"><div class="dot"></div></div>
            </div>
            <div class="tema-name">{{ $t['label'] }}</div>
            <div class="tema-check">✓</div>
          </label>
          @endforeach
        </div>

        <p class="scard-label" style="margin-top:8px;">Gaya Sidebar</p>
        @php $activeSb = $s['sidebar_style'] ?? 'solid'; @endphp
        <div class="sb-grid">
          @foreach([
            ['val'=>'solid',   'icon'=>'▮', 'label'=>'Solid'],
            ['val'=>'glass',   'icon'=>'◈', 'label'=>'Glass'],
            ['val'=>'minimal', 'icon'=>'▯', 'label'=>'Minimal'],
          ] as $sb)
          <label class="sb-opt {{ $activeSb===$sb['val']?'picked':'' }}" onclick="pickSb('{{ $sb['val'] }}')">
            <input type="radio" name="sidebar_style" value="{{ $sb['val'] }}" {{ $activeSb===$sb['val']?'checked':'' }}>
            <span class="sb-icon">{{ $sb['icon'] }}</span>
            {{ $sb['label'] }}
          </label>
          @endforeach
        </div>

        <div class="notice">
          <span class="ni">🖌️</span>
          Tema dan gaya sidebar akan tersimpan dan diterapkan di seluruh halaman admin.
          Fitur ini memerlukan integrasi dengan layout admin kamu.
        </div>

        <div class="btn-row">
          <button type="submit" class="btn-save">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93A10 10 0 1 0 4.93 19.07 10 10 0 0 0 19.07 4.93z"/></svg>
            Terapkan Tema
          </button>
        </div>
      </div>
    </form>
  </div>

</div>{{-- .pg --}}

{{-- Toast container --}}
<div class="toast-wrap" id="toastWrap"></div>

<script>
// ── Tab switching ─────────────────────────────────────────
function goTab(name) {
  document.querySelectorAll('.tpanel').forEach(p => p.classList.remove('on'));
  document.querySelectorAll('.tbtn').forEach(b => b.classList.remove('on'));
  document.getElementById('tab-' + name).classList.add('on');
  document.querySelectorAll('.tbtn').forEach(b => {
    if (b.getAttribute('onclick')?.includes(name)) b.classList.add('on');
  });
}

// ── Tema picker ──────────────────────────────────────────
function pickTema(val) {
  document.querySelectorAll('.tema-card').forEach(c => c.classList.remove('picked'));
  document.querySelectorAll('input[name=tema]').forEach(r => r.checked = r.value === val);
  event.currentTarget.classList.add('picked');
}
function pickSb(val) {
  document.querySelectorAll('.sb-opt').forEach(c => c.classList.remove('picked'));
  document.querySelectorAll('input[name=sidebar_style]').forEach(r => r.checked = r.value === val);
  event.currentTarget.classList.add('picked');
}

// ── Password strength ────────────────────────────────────
function pwStrength(v) {
  const fill = document.getElementById('pwFill');
  const hint = document.getElementById('pwHint');
  if (!v) { fill.style.width='0'; hint.textContent=''; return; }
  const sc = [/.{8,}/, /[A-Z]/, /[0-9]/, /[^A-Za-z0-9]/].filter(r=>r.test(v)).length;
  const lvl = [
    {w:'20%', bg:'#ef4444', txt:'Sangat lemah'},
    {w:'45%', bg:'#f97316', txt:'Lemah'},
    {w:'70%', bg:'#eab308', txt:'Cukup'},
    {w:'100%',bg:'#22c55e', txt:'Kuat 💪'},
  ][sc - 1] || {w:'20%', bg:'#ef4444', txt:'Sangat lemah'};
  fill.style.width      = lvl.w;
  fill.style.background = lvl.bg;
  hint.textContent      = lvl.txt;
  hint.style.color      = lvl.bg;
}

// ── Toast ────────────────────────────────────────────────
function toast(msg, icon = '✅') {
  const el = document.createElement('div');
  el.className = 'toast';
  el.style.position = 'relative'; el.style.overflow = 'hidden';
  el.innerHTML = `<span class="toast-icon">${icon}</span><span>${msg}</span><div class="toast-bar"></div>`;
  document.getElementById('toastWrap').appendChild(el);
  setTimeout(() => {
    el.style.animation = 'tOut .3s ease forwards';
    setTimeout(() => el.remove(), 300);
  }, 3500);
}
</script>

@endsection