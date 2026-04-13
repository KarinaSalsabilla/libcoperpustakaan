@extends('layouts.admin')
@section('page-title', 'Detail Anggota')
@section('content')

<style>
    /* Additional styles for better UI */
    .detail-card {
        background: var(--card-bg);
        border-radius: 24px;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .detail-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }
    
    .info-grid-item {
        background: linear-gradient(135deg, var(--blue-50) 0%, var(--purple-50) 100%);
        border-radius: 16px;
        padding: 16px;
        transition: all 0.3s ease;
    }
    
    .info-grid-item:hover {
        transform: translateX(4px);
        background: linear-gradient(135deg, var(--blue-100) 0%, var(--purple-100) 100%);
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    
    .status-pinjam { background: rgba(59,130,246,0.15); color: #3b82f6; }
    .status-kembali { background: rgba(34,197,94,0.15); color: #22c55e; }
    .status-kadaluwarsa { background: rgba(239,68,68,0.15); color: #ef4444; }
    
    .stat-mini-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-mini-card:hover {
        transform: translateY(-4px);
        border-color: #667eea;
        box-shadow: 0 8px 25px rgba(102,126,234,0.15);
    }
    
    .gradient-border {
        position: relative;
        background: var(--card-bg);
        border-radius: 20px;
    }
    
    .gradient-border::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 2px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }
    
    .activity-timeline {
        position: relative;
        padding-left: 20px;
    }
    
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 10px;
        bottom: 10px;
        width: 2px;
        background: linear-gradient(180deg, #667eea, #764ba2, #667eea);
        border-radius: 2px;
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
        padding-left: 20px;
    }
    
    .timeline-dot {
        position: absolute;
        left: -26px;
        top: 0;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #667eea;
        border: 2px solid var(--card-bg);
        box-shadow: 0 0 0 2px rgba(102,126,234,0.3);
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        color: white;
    }
    
    .btn-gradient-outline {
        background: transparent;
        border: 2px solid #667eea;
        color: #667eea;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-gradient-outline:hover {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-color: transparent;
    }
</style>

<div class="w-full">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header-card" data-aos="fade-down">
                <div class="page-header-content">
                    <div class="page-header-text">
                        <div class="page-header-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div>
                            <h2 class="mb-1">Detail Anggota</h2>
                            <p class="mb-0">Informasi lengkap anggota perpustakaan</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.anggota.edit', $anggota->id_user) }}" class="btn btn-gradient">
                            <i class="fas fa-edit me-2"></i>Edit Anggota
                        </a>
                        <a href="{{ route('admin.anggota.index') }}" class="btn btn-gradient-outline">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Kolom kiri: Kartu Identitas --}}
        <div class="col-lg-4">
            <div class="detail-card" data-aos="fade-up">
                <div class="text-center p-4" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                    <div class="position-relative d-inline-block">
                        <div class="rounded-circle overflow-hidden mx-auto" 
                             style="width: 130px; height: 130px; border: 4px solid rgba(255,255,255,0.3); 
                                    background: rgba(255,255,255,0.2); display: flex; align-items: center; 
                                    justify-content: center;">
                            @if(isset($fotoUrl) && $fotoUrl)
                                <img src="{{ $fotoUrl }}" 
                                     style="width: 100%; height: 100%; object-fit: cover;" 
                                     alt="{{ $anggota->nama }}"
                                     onerror="this.onerror=null; this.parentElement.innerHTML='<span style=\"font-size:3rem;color:white;\">{{ strtoupper(substr($anggota->nama ?? 'A', 0, 1)) }}</span>'">
                            @else
                                <span style="font-size: 3rem; color: white;">
                                    {{ strtoupper(substr($anggota->nama ?? 'A', 0, 1)) }}
                                </span>
                            @endif
                        </div>
                        <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-3 border-white"
                             style="width: 18px; height: 18px;"></div>
                    </div>
                    
                    <h4 class="text-white mt-3 mb-1">{{ $anggota->nama ?? $anggota->user->name ?? '-' }}</h4>
                    <p class="text-white-50 mb-2">
                        <i class="fas fa-envelope me-1"></i> {{ $anggota->user->email ?? '-' }}
                    </p>
                    <span class="badge bg-white text-primary px-3 py-2 rounded-pill">
                        <i class="fas fa-id-card me-1"></i> ID: #{{ $anggota->id_user }}
                    </span>
                </div>
                
                <div class="p-4">
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Bergabung
                        </span>
                        <span class="fw-bold">{{ optional($anggota->user->created_at)->format('d F Y') ?? '-' }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted">
                            <i class="fas fa-book me-2 text-primary"></i>Total Pinjam
                        </span>
                        <span class="fw-bold text-primary">{{ $totalPeminjaman }} Buku</span>
                    </div>
                    <div class="d-flex justify-content-between py-3">
                        <span class="text-muted">
                            <i class="fas fa-clock me-2 text-primary"></i>Status
                        </span>
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                            <i class="fas fa-check-circle me-1"></i> Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="col-lg-8">
            
            {{-- Statistik Mini --}}
            <div class="row g-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-4">
                    <div class="stat-mini-card">
                        <div class="mb-2">
                            <i class="fas fa-book-open fa-2x" style="color: #667eea;"></i>
                        </div>
                        <h3 class="mb-1">{{ $totalPeminjaman }}</h3>
                        <p class="text-muted mb-0">Total Peminjaman</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-mini-card">
                        <div class="mb-2">
                            <i class="fas fa-spinner fa-2x" style="color: #764ba2;"></i>
                        </div>
                        <h3 class="mb-1">
                            {{ $riwayat->where('status_peminjam', 'pinjam')->count() }}
                        </h3>
                        <p class="text-muted mb-0">Sedang Dipinjam</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-mini-card">
                        <div class="mb-2">
                            <i class="fas fa-check-circle fa-2x" style="color: #22c55e;"></i>
                        </div>
                        <h3 class="mb-1">
                            {{ $riwayat->where('status_peminjam', 'kembali')->count() }}
                        </h3>
                        <p class="text-muted mb-0">Dikembalikan</p>
                    </div>
                </div>
            </div>

            {{-- Data Pribadi --}}
            <div class="detail-card mb-4" data-aos="fade-up" data-aos-delay="150">
                <div class="card-header-custom" style="background: linear-gradient(135deg, #667eea15, #764ba215);">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card me-2" style="color: #667eea;"></i>
                        Data Pribadi
                    </h5>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        @php
                            $personalFields = [
                                ['icon' => 'fa-user', 'label' => 'Nama Lengkap', 'value' => $anggota->nama],
                                ['icon' => 'fa-phone', 'label' => 'No HP', 'value' => $anggota->nohp ?? '-'],
                                ['icon' => 'fa-venus-mars', 'label' => 'Jenis Kelamin', 'value' => match($anggota->jenis_kelamin){
                                    'L' => 'Laki-laki', 'P' => 'Perempuan', default => '-'
                                }],
                                ['icon' => 'fa-mosque', 'label' => 'Agama', 'value' => $anggota->agama ?? '-'],
                                ['icon' => 'fa-map-marker-alt', 'label' => 'Kota', 'value' => $anggota->kota ?? '-'],
                                ['icon' => 'fa-map-pin', 'label' => 'Tempat Lahir', 'value' => $anggota->tempat_lahir ?? '-'],
                                ['icon' => 'fa-calendar', 'label' => 'Tanggal Lahir', 'value' => $anggota->tgl_lahir ? \Carbon\Carbon::parse($anggota->tgl_lahir)->format('d F Y') : '-'],
                                ['icon' => 'fa-envelope', 'label' => 'Email', 'value' => $anggota->user->email ?? '-'],
                            ];
                        @endphp
                        
                        @foreach($personalFields as $field)
                            <div class="col-md-6">
                                <div class="info-grid-item">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle p-2" style="background: linear-gradient(135deg, #667eea, #764ba2); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas {{ $field['icon'] }} text-white"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted text-uppercase fw-bold">{{ $field['label'] }}</small>
                                            <div class="fw-semibold">{{ $field['value'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Riwayat Peminjaman --}}
            <div class="detail-card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-header-custom" style="background: linear-gradient(135deg, #667eea15, #764ba215);">
                    <h5 class="mb-0">
                        <i class="fas fa-history me-2" style="color: #667eea;"></i>
                        Riwayat Peminjaman Terakhir
                    </h5>
                </div>
                <div class="p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                <tr>
                                    <th class="text-white">No</th>
                                    <th class="text-white">Judul Buku</th>
                                    <th class="text-white">Tanggal Pinjam</th>
                                    <th class="text-white">Batas Kembali</th>
                                    <th class="text-white">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $index => $r)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-semibold">{{ $r->ebook->judul_buku ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_pinjam)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->tanggal_batas)->format('d/m/Y') }}</td>
                                        <td>
                                            @php
                                                $status = $r->status_peminjam;
                                                $statusClass = match($status) {
                                                    'pinjam' => 'status-pinjam',
                                                    'kembali' => 'status-kembali',
                                                    'kadaluwarsa' => 'status-kadaluwarsa',
                                                    default => ''
                                                };
                                                $statusText = match($status) {
                                                    'pinjam' => 'Dipinjam',
                                                    'kembali' => 'Dikembalikan',
                                                    'kadaluwarsa' => 'Kadaluwarsa',
                                                    default => ucfirst($status)
                                                };
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="fas fa-{{ $status == 'pinjam' ? 'clock' : ($status == 'kembali' ? 'check' : 'exclamation') }} me-1"></i>
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-book-open fa-3x text-muted mb-3 d-block opacity-25"></i>
                                            <p class="text-muted mb-0">Belum ada riwayat peminjaman</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ 
        duration: 700, 
        once: true,
        offset: 10
    });
</script>
@endpush

@endsection