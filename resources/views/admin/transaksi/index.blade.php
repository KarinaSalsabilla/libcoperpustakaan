{{-- resources/views/admin/transaksi/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Data Peminjaman')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap');
.tx-wrap { padding: 28px 32px; font-family: 'Poppins', sans-serif; }
.tx-topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; flex-wrap:wrap; gap:12px; }
.tx-title { font-size:1.35rem; font-weight:800; color:#1a120b; }
.tx-topbar-right { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
.tx-search { display:flex; align-items:center; gap:8px; background:white; border:1.5px solid #ddd0b8; border-radius:50px; padding:8px 16px; }
.tx-search input { border:none; outline:none; font-family:'Poppins',sans-serif; font-size:0.82rem; color:#1a120b; width:200px; }
.tx-search input::placeholder { color:#7a6855; }
.tx-select { padding:8px 14px; border:1.5px solid #ddd0b8; border-radius:50px; font-family:'Poppins',sans-serif; font-size:0.82rem; color:#1a120b; outline:none; cursor:pointer; background:white; }
.tx-btn-add { display:inline-flex; align-items:center; gap:7px; padding:9px 20px; border-radius:50px; background:#1a120b; color:white; font-family:'Poppins',sans-serif; font-size:0.82rem; font-weight:700; text-decoration:none; transition:background .2s; border:none; cursor:pointer; }
.tx-btn-add:hover { background:#2d4a3e; }
.flash { padding:12px 18px; border-radius:10px; margin-bottom:18px; font-size:0.83rem; font-weight:600; display:flex; align-items:center; gap:10px; }
.flash-success { background:rgba(45,74,62,.1); border:1px solid rgba(45,74,62,.25); color:#2d4a3e; }
.flash-error { background:rgba(139,58,26,.1); border:1px solid rgba(139,58,26,.25); color:#8b3a1a; }
.tx-table-wrap { background:white; border:1px solid #ddd0b8; border-radius:16px; overflow:hidden; box-shadow:0 2px 16px rgba(26,18,11,.08); }
table { width:100%; border-collapse:collapse; }
thead { background:#f2e9d8; border-bottom:1px solid #ddd0b8; }
thead th { padding:13px 16px; font-size:0.67rem; font-weight:800; letter-spacing:.1em; text-transform:uppercase; color:#7a6855; text-align:left; white-space:nowrap; }
tbody tr { border-bottom:1px solid #f0e8d8; transition:background .15s; }
tbody tr:last-child { border-bottom:none; }
tbody tr:hover { background:#faf5ec; }
td { padding:13px 16px; vertical-align:middle; }
.td-book { display:flex; align-items:center; gap:10px; }
.td-cover { width:32px; height:46px; border-radius:2px 6px 6px 2px; flex-shrink:0; overflow:hidden; background:#2d4a3e; display:flex; align-items:center; justify-content:center; font-size:0.9rem; }
.td-cover img { width:100%; height:100%; object-fit:cover; }
.td-judul { font-size:0.85rem; font-weight:700; color:#1a120b; margin-bottom:1px; max-width:180px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.td-penulis { font-size:0.7rem; color:#7a6855; }
.td-user { font-size:0.85rem; font-weight:600; color:#1a120b; }
.td-date { font-size:0.82rem; font-weight:600; color:#3d2b1f; white-space:nowrap; }
.td-date-sub { font-size:0.7rem; color:#7a6855; margin-top:1px; }
.badge { display:inline-flex; align-items:center; gap:5px; padding:4px 11px; border-radius:50px; font-size:0.7rem; font-weight:700; white-space:nowrap; }
.badge-pinjam { background:rgba(181,101,29,.1); color:#b5651d; border:1px solid rgba(181,101,29,.25); }
.badge-aktif { background:rgba(45,74,62,.1); color:#2d4a3e; border:1px solid rgba(45,74,62,.22); }
.act-btn { display:inline-flex; align-items:center; gap:5px; padding:5px 12px; border-radius:50px; font-family:'Poppins',sans-serif; font-size:0.72rem; font-weight:700; border:1.5px solid #ddd0b8; background:transparent; color:#7a6855; cursor:pointer; text-decoration:none; transition:all .2s; }
.act-btn:hover { background:#1a120b; color:white; border-color:#1a120b; }
.act-btn-edit { border-color:#b5651d; color:#b5651d; }
.act-btn-edit:hover { background:#b5651d; color:white; border-color:#b5651d; }
.act-btn-kembali { border-color:#2d4a3e; color:#2d4a3e; }
.act-btn-kembali:hover { background:#2d4a3e; color:white; border-color:#2d4a3e; }
.act-btn-del { border-color:#e07070; color:#e07070; }
.act-btn-del:hover { background:#c0392b; color:white; border-color:#c0392b; }
.pag-wrap { padding:16px 20px; }
.empty-state { text-align:center; padding:60px 20px; color:#7a6855; }
.empty-state i { font-size:2.5rem; margin-bottom:12px; display:block; opacity:.25; }

/* Modal Edit */
.modal-overlay { display:none; position:fixed; inset:0; z-index:500; background:rgba(26,18,11,.6); backdrop-filter:blur(8px); align-items:center; justify-content:center; padding:20px; }
.modal-overlay.show { display:flex; }
.modal-box { background:#faf5ec; border-radius:20px; max-width:440px; width:100%; box-shadow:0 40px 100px rgba(0,0,0,.3); overflow:hidden; animation:popIn .3s cubic-bezier(.34,1.4,.64,1); }
@keyframes popIn { from{opacity:0;transform:scale(.88)} to{opacity:1;transform:scale(1)} }
.modal-strip { height:4px; background:linear-gradient(90deg,#b5651d,#f0c08a,#2d4a3e); }
.modal-inner { padding:28px; }
.modal-title { font-size:1.1rem; font-weight:800; color:#1a120b; margin-bottom:20px; }
.form-group { margin-bottom:16px; }
.form-label { display:block; font-size:0.7rem; font-weight:700; color:#7a6855; text-transform:uppercase; letter-spacing:.06em; margin-bottom:6px; }
.form-input, .form-select-modal { width:100%; padding:10px 14px; border-radius:10px; border:1.5px solid #ddd0b8; background:white; font-family:'Poppins',sans-serif; font-size:0.88rem; color:#1a120b; outline:none; transition:border-color .2s; }
.form-input:focus, .form-select-modal:focus { border-color:#b5651d; box-shadow:0 0 0 3px rgba(181,101,29,.1); }
.modal-btns { display:flex; gap:10px; margin-top:22px; }
.modal-btn-cancel { flex:1; padding:11px; border-radius:50px; background:transparent; color:#7a6855; border:1.5px solid #ddd0b8; font-family:'Poppins',sans-serif; font-size:0.82rem; font-weight:700; cursor:pointer; transition:all .2s; }
.modal-btn-cancel:hover { border-color:#8b3a1a; color:#8b3a1a; }
.modal-btn-save { flex:2; padding:11px; border-radius:50px; background:#1a120b; color:white; border:none; font-family:'Poppins',sans-serif; font-size:0.82rem; font-weight:700; cursor:pointer; transition:background .2s; }
.modal-btn-save:hover { background:#2d4a3e; }
.preview-book { background:#f2e9d8; border-radius:10px; padding:12px 14px; margin-bottom:18px; font-size:0.82rem; color:#3d2b1f; }
.preview-book strong { font-weight:700; color:#1a120b; }

/* Info auto-kembali */
.info-bar { display:flex; align-items:center; gap:10px; padding:10px 16px; background:rgba(45,74,62,.08); border:1px solid rgba(45,74,62,.2); border-radius:10px; margin-bottom:20px; font-size:0.78rem; color:#2d4a3e; font-weight:600; }
.info-bar i { font-size:0.85rem; flex-shrink:0; }

/* Live indicator */
.live-dot { display:inline-flex; align-items:center; gap:6px; font-size:0.72rem; font-weight:600; color:#7a6855; }
.live-dot::before { content:''; width:7px; height:7px; border-radius:50%; background:#4ade80; animation:livePulse 1.8s ease infinite; display:inline-block; }
@keyframes livePulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(.7)} }

/* Notif toast */
@keyframes slideIn { from{opacity:0;transform:translateX(20px)} to{opacity:1;transform:none} }
@keyframes slideOut { to{opacity:0;transform:translateX(20px)} }
</style>

<div class="tx-wrap">

  <div class="tx-topbar">
    <div style="display:flex;align-items:center;gap:14px;">
      <div class="tx-title">📋 Data Peminjaman</div>
      <span class="live-dot">Live</span>
    </div>
    <div class="tx-topbar-right">
      {{-- Search + filter --}}
      <form method="GET" action="{{ route('admin.transaksi.index') }}" style="display:contents;">
        <div class="tx-search">
          <i class="fas fa-search" style="color:#7a6855;font-size:.8rem;"></i>
          <input type="text" name="q" placeholder="Cari anggota / buku…" value="{{ request('q') }}">
        </div>
        <select name="status" class="tx-select" onchange="this.form.submit()">
          <option value="">Semua Status</option>
          <option value="pinjam" {{ request('status') === 'pinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
          <option value="aktif"  {{ request('status') === 'aktif'  ? 'selected' : '' }}>Dikembalikan</option>
        </select>
      </form>
    </div>
  </div>

  {{-- Info auto-return --}}
  <div class="info-bar">
    <i class="fas fa-info-circle"></i>
    Sistem otomatis mengembalikan buku saat tanggal batas tercapai. Tidak ada denda — ini adalah perpustakaan digital.
  </div>

  @if(session('success'))
    <div class="flash flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="flash flash-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
  @endif

  <div class="tx-table-wrap">
    {{-- Tag untuk polling --}}
    <span id="poll-count" data-count="{{ $transaksis->total() }}" style="display:none;"></span>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Buku</th>
          <th>Anggota</th>
          <th>Tgl Pinjam</th>
          <th>Batas Kembali</th>
          <th>Status</th>
          <th style="text-align:center;">Aksi</th>
        </tr>
      </thead>
      <tbody id="transaksiTbody">
        @forelse($transaksis as $t)
        <tr>
          <td style="font-size:.78rem;color:#7a6855;font-weight:600;">
            #{{ str_pad($t->id_peminjam, 4, '0', STR_PAD_LEFT) }}
          </td>
          <td>
            <div class="td-book">
              <div class="td-cover">
                @if($t->ebook?->cover)
                  <img src="{{ Storage::url($t->ebook->cover) }}" alt="">
                @else
                  📚
                @endif
              </div>
              <div>
                <div class="td-judul">{{ $t->ebook->judul_buku ?? '—' }}</div>
                <div class="td-penulis">{{ $t->ebook->pengarang ?? '—' }}</div>
              </div>
            </div>
          </td>
          <td>
            <div class="td-user">{{ $t->user->name ?? '—' }}</div>
            <div class="td-penulis">{{ $t->user->email ?? '' }}</div>
          </td>
          <td>
            <div class="td-date">{{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d M Y') }}</div>
          </td>
          <td>
            <div class="td-date">
              {{ \Carbon\Carbon::parse($t->tanggal_batas)->format('d M Y') }}
            </div>
            @if($t->status_peminjam === 'pinjam')
              @php $sisa = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($t->tanggal_batas), false); @endphp
              <div class="td-date-sub" style="{{ $sisa <= 2 ? 'color:#b5651d;font-weight:600;' : '' }}">
                @if($sisa > 0)
                  {{ $sisa }} hari lagi
                @else
                  Hari ini batas!
                @endif
              </div>
            @endif
          </td>
          <td>
            @if($t->status_peminjam === 'pinjam')
              <span class="badge badge-pinjam">📖 Dipinjam</span>
            @else
              <span class="badge badge-aktif">✅ Dikembalikan</span>
            @endif
          </td>
          <td>
            <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap;">
              {{-- Tombol Edit --}}
              <button class="act-btn act-btn-edit"
                onclick="bukaEdit(
                  {{ $t->id_peminjam }},
                  '{{ addslashes($t->ebook->judul_buku ?? '') }}',
                  '{{ \Carbon\Carbon::parse($t->tanggal_batas)->format('Y-m-d') }}',
                  '{{ $t->status_peminjam }}'
                )">
                <i class="fas fa-pen"></i> Edit
              </button>

              {{-- Kembalikan manual (hanya jika masih dipinjam) --}}
              @if($t->status_peminjam === 'pinjam')
                <form method="POST" action="{{ route('admin.transaksi.kembalikan', $t->id_peminjam) }}">
                  @csrf
                  <button type="submit" class="act-btn act-btn-kembali">
                    <i class="fas fa-undo-alt"></i> Kembalikan
                  </button>
                </form>
              @endif

              {{-- Hapus --}}
              <form method="POST" action="{{ route('admin.transaksi.destroy', $t->id_peminjam) }}">
                @csrf @method('DELETE')
                <button type="submit" class="act-btn act-btn-del"
                  onclick="return confirm('Hapus transaksi ini?')">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7">
            <div class="empty-state">
              <i class="fas fa-inbox"></i>
              <div style="font-weight:700;margin-bottom:4px;">Belum ada data transaksi</div>
              <div style="font-size:.82rem;">Belum ada peminjaman tercatat.</div>
            </div>
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>

    @if($transaksis->hasPages())
      <div class="pag-wrap">{{ $transaksis->links() }}</div>
    @endif
  </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal-overlay" id="editModal">
  <div class="modal-box">
    <div class="modal-strip"></div>
    <div class="modal-inner">
      <div class="modal-title">✏️ Edit Transaksi</div>
      <div class="preview-book" id="previewBook">—</div>
      <form method="POST" id="editForm">
        @csrf @method('PUT')
        <div class="form-group">
          <label class="form-label">Batas Kembali</label>
          <input type="date" name="tanggal_batas" id="editTanggal" class="form-input" required>
        </div>
        <div class="form-group">
          <label class="form-label">Status Peminjaman</label>
          <select name="status_peminjam" id="editStatus" class="form-select-modal">
            <option value="pinjam">Dipinjam</option>
            <option value="aktif">Dikembalikan</option>
          </select>
        </div>
        <div class="modal-btns">
          <button type="button" class="modal-btn-cancel" onclick="tutupEdit()">Batal</button>
          <button type="submit" class="modal-btn-save"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// ── MODAL EDIT ────────────────────────────────────────
function bukaEdit(id, judul, tanggal, status) {
  document.getElementById('previewBook').innerHTML = '<strong>' + judul + '</strong>';
  document.getElementById('editForm').action = '/admin/transaksi/' + id;
  document.getElementById('editTanggal').value = tanggal;
  document.getElementById('editStatus').value = status;
  document.getElementById('editModal').classList.add('show');
  document.body.style.overflow = 'hidden';
}
function tutupEdit() {
  document.getElementById('editModal').classList.remove('show');
  document.body.style.overflow = '';
}

// ── LIVE POLLING ──────────────────────────────────────
let lastCount = {{ $transaksis->total() }};
let pollingTimer;

async function cekTransaksiBaru() {
  try {
    const res  = await fetch('{{ route('admin.transaksi.index') }}', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const html   = await res.text();
    const parser = new DOMParser();
    const doc    = parser.parseFromString(html, 'text/html');

    const newCount = parseInt(
      doc.querySelector('#poll-count')?.dataset.count ?? lastCount
    );

    if (newCount !== lastCount) {
      // Update tbody
      const newTbody = doc.querySelector('#transaksiTbody');
      if (newTbody) {
        document.getElementById('transaksiTbody').innerHTML = newTbody.innerHTML;
      }
      lastCount = newCount;
      tampilkanNotif(newCount > lastCount
        ? '🔔 Ada peminjaman baru masuk!'
        : '🔄 Data peminjaman diperbarui.');
    }
  } catch (e) {
    // silent — tidak ganggu tampilan
  }
}

function tampilkanNotif(msg) {
  // Hapus notif lama kalau ada
  document.querySelectorAll('.live-notif').forEach(el => el.remove());

  const el = document.createElement('div');
  el.className = 'live-notif';
  el.style.cssText = `
    position:fixed;top:20px;right:20px;z-index:9999;
    background:#1a120b;color:white;padding:14px 20px;
    border-radius:12px;font-size:.82rem;font-weight:700;
    display:flex;align-items:center;gap:12px;
    box-shadow:0 8px 28px rgba(0,0,0,.3);
    animation:slideIn .3s ease;
  `;
  el.innerHTML = `
    <span>${msg}</span>
    <button onclick="location.reload()"
      style="background:#b5651d;border:none;color:white;padding:5px 14px;
             border-radius:50px;cursor:pointer;font-size:.75rem;font-weight:700;
             font-family:'Poppins',sans-serif;">
      Refresh
    </button>
    <button onclick="this.parentElement.remove()"
      style="background:rgba(255,255,255,.15);border:none;color:white;
             width:22px;height:22px;border-radius:50%;cursor:pointer;font-size:.8rem;">
      ✕
    </button>
  `;
  document.body.appendChild(el);

  // Auto hilang setelah 8 detik
  setTimeout(() => {
    el.style.animation = 'slideOut .3s ease forwards';
    setTimeout(() => el.remove(), 300);
  }, 8000);
}

function mulaiPolling() {
  pollingTimer = setInterval(cekTransaksiBaru, 8000);
}

function hentikanPolling() {
  clearInterval(pollingTimer);
}

// Pause saat tab tidak aktif — hemat resource server
document.addEventListener('visibilitychange', () => {
  if (document.hidden) {
    hentikanPolling();
  } else {
    cekTransaksiBaru(); // langsung cek saat tab aktif kembali
    mulaiPolling();
  }
});

mulaiPolling();
</script>
@endsection