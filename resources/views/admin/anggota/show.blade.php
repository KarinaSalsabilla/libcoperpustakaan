@extends('layouts.admin')
@section('page-title', 'Detail Anggota')
@section('content')
<div class="w-full">

  {{-- Header --}}
  <div class="row mb-4">
    <div class="col-12">
      <div class="page-header-card" data-aos="fade-down">
        <div class="page-header-content">
          <div class="page-header-text">
            <div class="page-header-icon"><i class="fas fa-user"></i></div>
            <div>
              <h2 class="mb-1">Detail Anggota</h2>
              <p class="mb-0">Informasi lengkap anggota perpustakaan</p>
            </div>
          </div>
          <a href="{{ route('admin.anggota.index') }}" class="btn btn-gradient-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">

    {{-- Kolom kiri: kartu identitas --}}
    <div class="col-md-4">
      <div class="table-card p-0" style="border-radius:20px;overflow:hidden;" data-aos="fade-up">
        <div style="background:linear-gradient(135deg,#667eea,#764ba2);padding:2rem;text-align:center;">
          <div style="width:88px;height:88px;border-radius:50%;margin:0 auto 1rem;overflow:hidden;
                      border:3px solid rgba(255,255,255,.35);display:flex;align-items:center;
                      justify-content:center;font-size:2.2rem;color:white;
                      background:rgba(255,255,255,.2);">
            @php
              $fotoUrl = null;
              $hasFoto = false;
              
              if(!empty($anggota->foto)) {
                  // Cek apakah foto ada di storage
                  if(Storage::disk('public')->exists('foto/' . $anggota->foto)) {
                      $fotoUrl = asset('storage/foto/' . $anggota->foto);
                      $hasFoto = true;
                  } 
                  // Cek apakah foto menggunakan path lengkap
                  elseif(filter_var($anggota->foto, FILTER_VALIDATE_URL)) {
                      $fotoUrl = $anggota->foto;
                      $hasFoto = true;
                  }
              }
            @endphp
            
            @if($hasFoto && $fotoUrl)
              <img src="{{ $fotoUrl }}"
                   style="width:100%;height:100%;object-fit:cover;" 
                   alt="Foto {{ $anggota->nama }}"
                   onerror="this.onerror=null; this.parentElement.innerHTML='{{ strtoupper(substr($anggota->nama ?? 'A', 0, 1)) }}';">
            @else
              {{ strtoupper(substr($anggota->nama ?? 'A', 0, 1)) }}
            @endif
          </div>
          <h5 style="color:white;font-weight:700;margin-bottom:4px;">{{ $anggota->nama ?? $anggota->user->name ?? '-' }}</h5>
          <p style="color:rgba(255,255,255,.75);font-size:.85rem;margin:0;">{{ $anggota->user->email ?? '-' }}</p>
          <span style="display:inline-block;margin-top:10px;padding:4px 14px;border-radius:50px;
                       background:rgba(255,255,255,.2);color:white;font-size:.75rem;font-weight:700;
                       border:1px solid rgba(255,255,255,.3);">
            {{ ucfirst($anggota->user->role ?? 'anggota') }}
          </span>
        </div>
        <div style="padding:1.25rem;">
          @php
            $meta = [
              ['label'=>'ID Anggota',   'value'=>'#'.$anggota->id_user],
              ['label'=>'Bergabung',    'value'=>optional($anggota->user->created_at)->format('d M Y') ?? '-'],
              ['label'=>'Total Pinjam', 'value'=>$totalPeminjaman.' buku'],
            ];
          @endphp
          @foreach($meta as $i => $m)
            <div style="display:flex;justify-content:space-between;padding:10px 0;
                        {{ $i < count($meta)-1 ? 'border-bottom:1px solid var(--border-color);' : '' }}">
              <span style="font-size:.8rem;color:var(--text-secondary);">{{ $m['label'] }}</span>
              <span style="font-size:.85rem;font-weight:700;{{ $i==2 ? 'color:#667eea;' : '' }}">{{ $m['value'] }}</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    {{-- Kolom kanan --}}
    <div class="col-md-8">

      {{-- Data pribadi --}}
      <div class="table-card" style="border-radius:20px;" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header-custom">
          <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Data Pribadi</h5>
        </div>
        <div class="card-body-custom">
          <div class="row g-3">
            @php
              $fields = [
                ['icon'=>'fa-user',           'label'=>'Nama Lengkap',  'value'=>$anggota->nama],
                ['icon'=>'fa-phone',          'label'=>'No HP',         'value'=>$anggota->nohp],
                ['icon'=>'fa-venus-mars',     'label'=>'Jenis Kelamin', 'value'=>match($anggota->jenis_kelamin){
                    'L'=>'Laki-laki','P'=>'Perempuan',default=>'-'}],
                ['icon'=>'fa-mosque',         'label'=>'Agama',         'value'=>$anggota->agama],
                ['icon'=>'fa-map-marker-alt', 'label'=>'Kota',          'value'=>$anggota->kota],
                ['icon'=>'fa-map-pin',        'label'=>'Tempat Lahir',  'value'=>$anggota->tempat_lahir],
                ['icon'=>'fa-calendar',       'label'=>'Tanggal Lahir', 'value'=>$anggota->tgl_lahir
                    ? \Carbon\Carbon::parse($anggota->tgl_lahir)->format('d M Y') : '-'],
                ['icon'=>'fa-envelope',       'label'=>'Email',         'value'=>$anggota->user->email ?? '-'],
              ];
            @endphp
            @foreach($fields as $f)
              <div class="col-md-6">
                <div style="background:var(--bg-primary);border-radius:12px;padding:13px 15px;
                            display:flex;align-items:center;gap:12px;">
                  <div style="width:36px;height:36px;border-radius:10px;flex-shrink:0;
                               background:linear-gradient(135deg,rgba(102,126,234,.15),rgba(118,75,162,.15));
                               display:flex;align-items:center;justify-content:center;color:#667eea;">
                    <i class="fas {{ $f['icon'] }}" style="font-size:.82rem;"></i>
                  </div>
                  <div>
                    <div style="font-size:.65rem;color:var(--text-secondary);text-transform:uppercase;
                                letter-spacing:.06em;font-weight:700;margin-bottom:2px;">{{ $f['label'] }}</div>
                    <div style="font-size:.88rem;font-weight:600;color:var(--text-primary);">{{ $f['value'] ?? '-' }}</div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      {{-- Riwayat peminjaman --}}
      <div class="table-card mt-4" style="border-radius:20px;" data-aos="fade-up" data-aos-delay="200">
        <div class="card-header-custom">
          <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Peminjaman Terakhir</h5>
        </div>
        <div class="card-body-custom p-0">
          <div class="table-responsive">
            <table class="table table-modern mb-0">
              <thead>
                <tr>
                  <th>Judul Buku</th>
                  <th>Tgl Pinjam</th>
                  <th>Batas Kembali</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($riwayat as $r)
                  <tr>
                    <td style="font-weight:600;font-size:.88rem;">{{ $r->ebook->judul_buku ?? '-' }}</td>
                    <td style="font-size:.85rem;">{{ \Carbon\Carbon::parse($r->tanggal_pinjam)->format('d M Y') }}</td>
                    <td style="font-size:.85rem;">{{ \Carbon\Carbon::parse($r->tanggal_batas)->format('d M Y') }}</td>
                    <td>
                      @php
                        $s = $r->status_peminjam;
                        $color = match($s) {
                          'pinjam'      => ['bg'=>'rgba(102,126,234,.15)', 'text'=>'#667eea', 'label'=>'Dipinjam'],
                          'kembali'     => ['bg'=>'rgba(17,153,142,.12)',  'text'=>'#11998e', 'label'=>'Dikembalikan'],
                          'kadaluwarsa' => ['bg'=>'rgba(239,68,68,.1)',    'text'=>'#dc2626', 'label'=>'Kadaluwarsa'],
                          default       => ['bg'=>'rgba(100,100,100,.1)',  'text'=>'#666',    'label'=>ucfirst($s)],
                        };
                      @endphp
                      <span style="padding:3px 12px;border-radius:50px;font-size:.75rem;font-weight:700;
                                   background:{{ $color['bg'] }};color:{{ $color['text'] }};">
                        {{ $color['label'] }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-4" style="color:var(--text-secondary);font-size:.85rem;">
                      <i class="fas fa-book-open" style="font-size:1.5rem;opacity:.3;display:block;margin-bottom:8px;"></i>
                      Belum ada riwayat peminjaman
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>{{-- end col kanan --}}
  </div>
</div>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({ duration:700, once:true });</script>
@endpush
@endsection