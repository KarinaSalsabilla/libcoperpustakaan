@extends('layouts.admin')
@section('page-title', 'Edit Anggota')
@section('content')
<div class="w-full">
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header-card">
                <div class="page-header-content">
                    <div class="page-header-text">
                        <div class="page-header-icon"><i class="fas fa-user-edit"></i></div>
                        <div>
                            <h2 class="mb-1">Edit Anggota</h2>
                            <p class="mb-0">Perbarui data anggota perpustakaan</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-gradient-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            {{-- Form Upload Foto --}}
            <div class="table-card" style="border-radius:20px;">
                <div class="card-header-custom">
                    <h5 class="mb-0"><i class="fas fa-camera me-2"></i>Foto Profil</h5>
                </div>
                <div class="card-body-custom text-center">
                    <div style="width:150px;height:150px;border-radius:50%;margin:0 auto 1rem;overflow:hidden;
                                border:3px solid #667eea;display:flex;align-items:center;
                                justify-content:center;background:#f0f0f0;">
                        @php
                            $fotoUrl = null;
                            if(!empty($anggota->foto) && Storage::disk('public')->exists('foto/' . $anggota->foto)) {
                                $fotoUrl = asset('storage/foto/' . $anggota->foto);
                            }
                        @endphp
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" id="previewFoto" style="width:100%;height:100%;object-fit:cover;" alt="Foto">
                        @else
                            <div id="previewFoto" style="font-size:3rem;color:#667eea;">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    
                    <form action="{{ route('admin.anggota.upload-foto', $anggota->id_user) }}" method="POST" enctype="multipart/form-data" id="formUploadFoto">
                        @csrf
                        <input type="file" name="foto" id="fotoInput" accept="image/*" style="display:none;">
                        <button type="button" class="btn btn-primary" onclick="document.getElementById('fotoInput').click();">
                            <i class="fas fa-upload me-2"></i>Upload Foto
                        </button>
                        @if($fotoUrl)
                            <a href="{{ route('admin.anggota.delete-foto', $anggota->id_user) }}" 
                               class="btn btn-danger"
                               onclick="return confirm('Yakin ingin menghapus foto?')">
                                <i class="fas fa-trash me-2"></i>Hapus
                            </a>
                        @endif
                    </form>
                    <small class="text-muted d-block mt-2">Format: JPG, PNG, GIF (Max 2MB)</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            {{-- Form Edit Data --}}
            <form action="{{ route('admin.anggota.update', $anggota->id_user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="table-card" style="border-radius:20px;">
                    <div class="card-header-custom">
                        <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Data Pribadi</h5>
                    </div>
                    <div class="card-body-custom">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $anggota->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                <input type="password" name="password" class="form-control">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}" required maxlength="40">
                                @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">No HP</label>
                                <input type="text" name="nohp" class="form-control" value="{{ old('nohp', $anggota->nohp) }}" maxlength="15">
                                @error('nohp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Agama</label>
                                <select name="agama" class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="Islam" {{ old('agama', $anggota->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $anggota->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $anggota->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $anggota->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $anggota->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                </select>
                                @error('agama') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" maxlength="30">
                                @error('tempat_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}">
                                @error('tgl_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" value="{{ old('kota', $anggota->kota) }}" maxlength="20">
                                @error('kota') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-gradient-primary">
                        <i class="fas fa-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview foto sebelum upload
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('previewFoto');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    // Buat img baru
                    const img = document.createElement('img');
                    img.id = 'previewFoto';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.src = e.target.result;
                    preview.parentNode.replaceChild(img, preview);
                }
            }
            reader.readAsDataURL(file);
            
            // Auto submit form upload
            document.getElementById('formUploadFoto').submit();
        }
    });
</script>
@endpush
@endsection