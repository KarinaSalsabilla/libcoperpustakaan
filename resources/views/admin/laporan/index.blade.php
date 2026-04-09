@extends('layouts.admin')

@section('content')

@php
  $bulanArr = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  $namaBulan = $bulanArr[(int)$bulan] . ' ' . $tahun;
@endphp

<style>
  @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Outfit:wght@400;500;600;700&display=swap');

  :root {
    --primary:   #4f46e5;
    --primary-lt:#6366f1;
    --accent:    #7c3aed;
    --accent-lt: #a78bfa;
    --bg:        #f5f3ff;
    --bg2:       #eef2ff;
    --ink:       #1e1b4b;
    --muted:     #6b7280;
    --border:    #ddd6fe;
    --white:     #ffffff;
    --red:       #dc2626;
    --green:     #059669;
    --blue:      #2563eb;
    --grad:      linear-gradient(135deg, #4f46e5, #7c3aed);
  }

  .lap { padding: 28px 32px; font-family: 'Outfit', sans-serif; color: var(--ink); }

  /* ─── PAGE HEADER ─── */
  .page-header {
    display: flex; justify-content: space-between; align-items: flex-end;
    margin-bottom: 28px; flex-wrap: wrap; gap: 16px;
  }
  .page-header h1 {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: -.02em;
    line-height: 1.1;
  }
  .page-header h1 span {
    background: var(--grad);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  }
  .page-header p { margin: 5px 0 0; color: var(--muted); font-size: 0.85rem; }

  /* ─── FILTER PILL ─── */
  .filter-pill {
    display: flex; align-items: center; gap: 10px;
    background: var(--white); border: 1.5px solid var(--border);
    border-radius: 50px; padding: 6px 8px 6px 18px;
    box-shadow: 0 2px 8px rgba(79,70,229,.08);
  }
  .filter-pill label { font-size: 0.78rem; font-weight: 600; color: var(--muted); white-space: nowrap; }
  .filter-pill select, .filter-pill input[type=number] {
    border: none; background: var(--bg); border-radius: 50px;
    padding: 5px 12px; font-size: 0.82rem; color: var(--ink);
    font-family: 'Outfit', sans-serif; cursor: pointer; outline: none;
  }
  .filter-pill input[type=number] { width: 70px; }
  .btn-apply {
    background: var(--grad); color: white; border: none;
    padding: 7px 18px; border-radius: 50px; font-weight: 600;
    font-size: 0.82rem; cursor: pointer; font-family: 'Outfit', sans-serif;
    transition: opacity .2s;
  }
  .btn-apply:hover { opacity: .85; }

  .btn-export {
    display: inline-flex; align-items: center; gap: 7px;
    background: var(--grad); color: white; border: none;
    padding: 10px 20px; border-radius: 10px; font-weight: 600;
    font-size: 0.83rem; cursor: pointer; font-family: 'Outfit', sans-serif;
    text-decoration: none; transition: opacity .2s;
    box-shadow: 0 4px 16px rgba(79,70,229,.35);
  }
  .btn-export:hover { opacity: .85; }

  /* ─── STAT CARDS ─── */
  .stat-row {
    display: grid; grid-template-columns: repeat(4,1fr);
    gap: 16px; margin-bottom: 24px;
  }
  .stat-card {
    background: var(--white); border-radius: 16px; padding: 22px 22px 18px;
    position: relative; overflow: hidden;
    box-shadow: 0 2px 12px rgba(79,70,229,.08);
    border-top: 3px solid var(--primary);
    animation: fadeUp .5s ease both;
  }
  .stat-card:nth-child(1) { animation-delay: .05s; border-top-color: var(--primary); }
  .stat-card:nth-child(2) { animation-delay: .10s; border-top-color: var(--blue); }
  .stat-card:nth-child(3) { animation-delay: .15s; border-top-color: var(--green); }
  .stat-card:nth-child(4) { animation-delay: .20s; border-top-color: var(--red); }

  @keyframes fadeUp {
    from { opacity:0; transform:translateY(16px); }
    to   { opacity:1; transform:translateY(0); }
  }

  .stat-icon {
    width: 38px; height: 38px; border-radius: 10px; background: var(--bg);
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; margin-bottom: 14px;
  }
  .stat-label { font-size: 0.7rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .07em; }
  .stat-val   { font-size: 2.2rem; font-weight: 700; line-height: 1.1; margin-top: 4px;
                font-family: 'Cormorant Garamond', serif; }
  .stat-bg-num {
    position: absolute; right: -6px; bottom: -10px;
    font-size: 5rem; font-weight: 900; opacity: .04;
    font-family: 'Cormorant Garamond', serif; line-height: 1; user-select: none;
  }

  /* ─── GRAFIK ─── */
  .chart-panel {
    background: var(--white); border-radius: 16px; padding: 24px;
    box-shadow: 0 2px 12px rgba(79,70,229,.08); margin-bottom: 24px;
    animation: fadeUp .5s .25s ease both;
  }
  .panel-title {
    font-size: 0.68rem; font-weight: 700; letter-spacing: .1em;
    color: var(--primary); text-transform: uppercase; margin: 0 0 18px;
    display: flex; align-items: center; gap: 8px;
  }
  .panel-title::after {
    content: ''; flex: 1; height: 1px; background: var(--border);
  }
  .chart-canvas { height: 200px; }

  /* ─── BOTTOM GRID ─── */
  .bottom-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 20px; margin-bottom: 24px;
  }
  .rank-panel {
    background: var(--white); border-radius: 16px; padding: 22px;
    box-shadow: 0 2px 12px rgba(79,70,229,.08);
    animation: fadeUp .5s .35s ease both;
  }
  .rank-item { display: flex; align-items: center; gap: 12px; padding: 11px 0; border-bottom: 1px solid var(--border); }
  .rank-item:last-child { border-bottom: none; }
  .rank-num {
    width: 28px; height: 28px; border-radius: 50%; flex-shrink: 0;
    background: var(--bg2); color: var(--muted);
    font-size: 0.72rem; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
  }
  .rank-num.gold { background: var(--grad); color: white; }
  .rank-info  { flex: 1; min-width: 0; }
  .rank-name  { font-size: 0.83rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .rank-sub   { font-size: 0.7rem; color: var(--muted); margin-top: 1px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .rank-bar   { height: 3px; background: var(--border); border-radius: 4px; margin-top: 6px; }
  .rank-fill  { height: 3px; background: var(--grad); border-radius: 4px; transition: width .8s .4s cubic-bezier(.4,0,.2,1); }
  .rank-count { font-size: 0.9rem; font-weight: 700; color: var(--primary); flex-shrink: 0; }

  /* ─── TABEL ─── */
  .tbl-panel {
    background: var(--white); border-radius: 16px; overflow: hidden;
    box-shadow: 0 2px 12px rgba(79,70,229,.08);
    animation: fadeUp .5s .45s ease both;
  }
  .tbl-head {
    display: flex; justify-content: space-between; align-items: center;
    padding: 18px 24px; border-bottom: 1px solid var(--border);
  }
  .tbl-head h4 { margin: 0; font-size: 0.88rem; font-weight: 700; }
  .tbl-head span { font-size: 0.75rem; color: var(--muted); }
  table.lap-t  { width: 100%; border-collapse: collapse; }
  table.lap-t thead { background: var(--bg2); }
  table.lap-t th {
    padding: 10px 18px; text-align: left;
    font-size: 0.67rem; color: var(--muted); font-weight: 700;
    letter-spacing: .06em; text-transform: uppercase;
  }
  table.lap-t td { padding: 12px 18px; font-size: 0.83rem; border-top: 1px solid var(--border); }
  table.lap-t tbody tr { transition: background .12s; }
  table.lap-t tbody tr:hover { background: var(--bg); }
  .name-cell   { font-weight: 600; }
  .email-cell  { font-size: 0.72rem; color: var(--muted); }
  .badge {
    padding: 3px 11px; border-radius: 50px; font-size: 0.68rem; font-weight: 700;
    display: inline-block;
  }
  .b-pinjam      { background: #ede9fe; color: #5b21b6; }
  .b-aktif       { background: #f0fdf4; color: #15803d; }
  .b-kadaluwarsa { background: #fff1f2; color: #b91c1c; }

  .pagination-wrap { padding: 16px 24px; border-top: 1px solid var(--border); }

  @media(max-width:900px) {
    .stat-row    { grid-template-columns: repeat(2,1fr); }
    .bottom-grid { grid-template-columns: 1fr; }
    .filter-pill { flex-wrap: wrap; border-radius: 12px; }
    .lap { padding: 18px; }
  }
</style>

<div class="lap">

  {{-- ── PAGE HEADER ── --}}
  <div class="page-header">
    <div>
      <h1>Laporan <span>Peminjaman</span></h1>
      <p>Periode: <strong>{{ $namaBulan }}</strong> &nbsp;·&nbsp; {{ $transaksis->total() }} total transaksi</p>
    </div>
    <a href="{{ route('admin.laporan.export', ['bulan'=>$bulan,'tahun'=>$tahun]) }}"
       class="btn-export">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      Export Excel
    </a>
  </div>

  {{-- ── FILTER ── --}}
  <form method="GET" action="{{ route('admin.laporan.index') }}" style="margin-bottom:24px;">
    <div class="filter-pill" style="width:fit-content;">
      <label>Periode</label>
      <select name="bulan">
        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $nb)
          <option value="{{ $i+1 }}" @selected((int)$bulan === $i+1)>{{ $nb }}</option>
        @endforeach
      </select>
      <input type="number" name="tahun" value="{{ $tahun }}" min="2020" max="2099">
      <button type="submit" class="btn-apply">Tampilkan</button>
    </div>
  </form>

  {{-- ── STAT CARDS ── --}}
  <div class="stat-row">
    <div class="stat-card">
      <div class="stat-icon">📚</div>
      <div class="stat-label">Total Peminjaman</div>
      <div class="stat-val">{{ $totalPeminjaman }}</div>
      <div class="stat-bg-num">{{ $totalPeminjaman }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon" style="background:#eff6ff;">📖</div>
      <div class="stat-label">Sedang Dipinjam</div>
      <div class="stat-val" style="color:var(--blue)">{{ $sedangDipinjam }}</div>
      <div class="stat-bg-num">{{ $sedangDipinjam }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon" style="background:#f0fdf4;">✅</div>
      <div class="stat-label">Dikembalikan</div>
      <div class="stat-val" style="color:var(--green)">{{ $sudahDikembalikan }}</div>
      <div class="stat-bg-num">{{ $sudahDikembalikan }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-icon" style="background:#fff1f2;">⚠️</div>
      <div class="stat-label">Kadaluwarsa</div>
      <div class="stat-val" style="color:var(--red)">{{ $kadaluwarsa }}</div>
      <div class="stat-bg-num">{{ $kadaluwarsa }}</div>
    </div>
  </div>

  {{-- ── GRAFIK ── --}}
  <div class="chart-panel">
    <p class="panel-title">Grafik Peminjaman Harian — {{ $namaBulan }}</p>
    <div class="chart-canvas">
      <canvas id="chartHarian"></canvas>
    </div>
  </div>

  {{-- ── BUKU + ANGGOTA ── --}}
  <div class="bottom-grid">

    {{-- Buku Terpopuler --}}
    <div class="rank-panel">
      <p class="panel-title">Buku Terpopuler</p>
      @forelse($bukuPopuler as $i => $b)
        @php $maxB = $bukuPopuler->first()->total_pinjam ?: 1; @endphp
        <div class="rank-item">
          <div class="rank-num {{ $i===0?'gold':'' }}">{{ $i+1 }}</div>
          <div class="rank-info">
            <div class="rank-name">{{ $b->ebook->judul_buku ?? '—' }}</div>
            <div class="rank-sub">{{ $b->ebook->penulis ?? '' }}</div>
            <div class="rank-bar">
              <div class="rank-fill" style="width:{{ round($b->total_pinjam/$maxB*100) }}%"></div>
            </div>
          </div>
          <div class="rank-count">{{ $b->total_pinjam }}x</div>
        </div>
      @empty
        <p style="color:var(--muted);font-size:.83rem;text-align:center;padding:24px 0;">Tidak ada data</p>
      @endforelse
    </div>

    {{-- Anggota Teraktif --}}
    <div class="rank-panel">
      <p class="panel-title">Anggota Teraktif</p>
      @forelse($anggotaAktif as $i => $a)
        @php $maxA = $anggotaAktif->first()->total_pinjam ?: 1; @endphp
        <div class="rank-item">
          <div class="rank-num {{ $i===0?'gold':'' }}">{{ $i+1 }}</div>
          <div class="rank-info">
            <div class="rank-name">{{ $a->user->name ?? '—' }}</div>
            <div class="rank-sub">{{ $a->user->email ?? '' }}</div>
            <div class="rank-bar">
              <div class="rank-fill" style="width:{{ round($a->total_pinjam/$maxA*100) }}%"></div>
            </div>
          </div>
          <div class="rank-count">{{ $a->total_pinjam }}x</div>
        </div>
      @empty
        <p style="color:var(--muted);font-size:.83rem;text-align:center;padding:24px 0;">Tidak ada data</p>
      @endforelse
    </div>

  </div>

  {{-- ── TABEL DETAIL ── --}}
  <div class="tbl-panel">
    <div class="tbl-head">
      <h4>Semua Transaksi — {{ $namaBulan }}</h4>
      <span>{{ $transaksis->total() }} data</span>
    </div>
    <table class="lap-t">
      <thead>
        <tr>
          <th>#</th>
          <th>Anggota</th>
          <th>Judul Buku</th>
          <th>Tgl Pinjam</th>
          <th>Tenggat</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @forelse($transaksis as $i => $t)
        <tr>
          <td style="color:var(--muted);font-size:.78rem;">{{ $transaksis->firstItem() + $i }}</td>
          <td>
            <div class="name-cell">{{ $t->user->name ?? '—' }}</div>
            <div class="email-cell">{{ $t->user->email ?? '' }}</div>
          </td>
          <td>{{ $t->ebook->judul_buku ?? '—' }}</td>
          <td>{{ $t->tanggal_pinjam?->format('j M Y') }}</td>
          <td>{{ $t->tanggal_batas?->format('j M Y') }}</td>
          <td>
            <span class="badge b-{{ $t->status_peminjam }}">{{ ucfirst($t->status_peminjam) }}</span>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">
            Tidak ada data untuk periode ini
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
    @if($transaksis->hasPages())
      <div class="pagination-wrap">{{ $transaksis->appends(['bulan'=>$bulan,'tahun'=>$tahun])->links() }}</div>
    @endif
  </div>

</div>

{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
  const canvas = document.getElementById('chartHarian');
  const ctx = canvas.getContext('2d');

  const grad = ctx.createLinearGradient(0, 0, 0, 200);
  grad.addColorStop(0, 'rgba(99,102,241,.30)');
  grad.addColorStop(1, 'rgba(99,102,241,0)');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($grafikLabels) !!},
      datasets: [
        {
          type: 'line',
          label: 'Tren',
          data: {!! json_encode($grafikValues) !!},
          borderColor: '#4f46e5',
          borderWidth: 2.5,
          pointBackgroundColor: '#7c3aed',
          pointRadius: 3,
          pointHoverRadius: 6,
          fill: false,
          tension: 0.4,
          yAxisID: 'y',
          order: 1,
        },
        {
          type: 'bar',
          label: 'Peminjaman',
          data: {!! json_encode($grafikValues) !!},
          backgroundColor: 'rgba(99,102,241,.15)',
          borderColor: 'rgba(99,102,241,.4)',
          borderWidth: 1.5,
          borderRadius: 6,
          yAxisID: 'y',
          order: 2,
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      interaction: { mode: 'index', intersect: false },
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: '#1e1b4b',
          titleColor: '#eef2ff',
          bodyColor: '#eef2ff',
          padding: 12,
          cornerRadius: 8,
          callbacks: {
            title: c => 'Tanggal ' + c[0].label + ' — {{ $namaBulan }}',
            label: c => '  ' + c.parsed.y + ' peminjaman',
          }
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#6b7280', font: { size: 10, family: 'Outfit' } }
        },
        y: {
          beginAtZero: true,
          grid: { color: '#ede9fe' },
          ticks: { color: '#6b7280', font: { size: 10, family: 'Outfit' }, stepSize: 1 }
        }
      }
    }
  });
})();
</script>
@endsection