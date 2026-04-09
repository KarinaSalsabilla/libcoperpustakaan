@extends('layouts.admin')

@section('page-title', 'Edit Anggota')

@section('main-class', '')

@section('content')
    <div class="w-full">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header-card" data-aos="fade-down">
                    <div class="page-header-content">
                        <div class="page-header-text">
                            <div class="page-header-icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div>
                                <h2 class="mb-2">Edit Data Anggota</h2>
                                <p class="mb-0">Perbarui informasi anggota perpustakaan</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.anggota.index') }}" class="btn btn-gradient-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row">
            <div class="col-12">
                <div class="form-card" data-aos="fade-up">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Form Edit Anggota
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('admin.anggota.update', $anggota->id_user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-4">
                                <!-- Account Information -->
                                <div class="col-12">
                                    <div class="section-title">
                                        <i class="fas fa-user-circle me-2"></i>
                                        Informasi Akun
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-envelope me-2"></i>Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" name="email" class="form-control-custom @error('email') is-invalid @enderror" 
                                               value="{{ old('email', $anggota->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-lock me-2"></i>Password Baru
                                            <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>
                                        </label>
                                        <input type="password" name="password" class="form-control-custom @error('password') is-invalid @enderror" 
                                               placeholder="Minimal 8 karakter">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Personal Information -->
                                <div class="col-12 mt-4">
                                    <div class="section-title">
                                        <i class="fas fa-user me-2"></i>
                                        Informasi Pribadi
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-id-card me-2"></i>Nama Lengkap
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="nama" class="form-control-custom @error('nama') is-invalid @enderror" 
                                               value="{{ old('nama', $anggota->nama) }}" required maxlength="40">
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-phone me-2"></i>No HP
                                        </label>
                                        <input type="text" name="nohp" class="form-control-custom @error('nohp') is-invalid @enderror" 
                                               value="{{ old('nohp', $anggota->nohp) }}" maxlength="15">
                                        @error('nohp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-venus-mars me-2"></i>Jenis Kelamin
                                        </label>
                                        <select name="jenis_kelamin" class="form-control-custom @error('jenis_kelamin') is-invalid @enderror">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-mosque me-2"></i>Agama
                                        </label>
                                        <select name="agama" class="form-control-custom @error('agama') is-invalid @enderror">
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam" {{ old('agama', $anggota->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ old('agama', $anggota->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ old('agama', $anggota->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama', $anggota->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ old('agama', $anggota->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ old('agama', $anggota->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-map-marker-alt me-2"></i>Tempat Lahir
                                        </label>
                                        <input type="text" name="tempat_lahir" class="form-control-custom @error('tempat_lahir') is-invalid @enderror" 
                                               value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" maxlength="30">
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-calendar me-2"></i>Tanggal Lahir
                                        </label>
                                        <input type="date" name="tgl_lahir" class="form-control-custom @error('tgl_lahir') is-invalid @enderror" 
                                               value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}">
                                        @error('tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group-custom">
                                        <label class="form-label-custom">
                                            <i class="fas fa-city me-2"></i>Kota
                                        </label>
                                        <input type="text" name="kota" class="form-control-custom @error('kota') is-invalid @enderror" 
                                               value="{{ old('kota', $anggota->kota) }}" maxlength="20">
                                        @error('kota')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-gradient-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Update Data
                                </button>
                                <a href="{{ route('admin.anggota.index') }}" class="btn btn-gradient-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
            /* Copy semua style dari create.blade.php */
            :root {
                --bg-primary: #f8f9fa;
                --bg-secondary: #ffffff;
                --text-primary: #2d3748;
                --text-secondary: #718096;
                --border-color: #e2e8f0;
                --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
                --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.15);
                --shadow-xl: 0 20px 40px rgba(0, 0, 0, 0.2);
                --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                --gradient-secondary: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            }

            [data-theme="dark"] {
                --bg-primary: #1a202c;
                --bg-secondary: #2d3748;
                --text-primary: #f7fafc;
                --text-secondary: #a0aec0;
                --border-color: #4a5568;
            }

            body {
                background-color: var(--bg-primary);
                color: var(--text-primary);
            }

            .w-full {
                width: 100% !important;
            }

            .page-header-card {
                background: var(--gradient-primary);
                border-radius: 20px;
                padding: 2rem;
                box-shadow: var(--shadow-xl);
            }

            .page-header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .page-header-text {
                display: flex;
                align-items: center;
                gap: 1.5rem;
                color: white;
            }

            .page-header-icon {
                width: 70px;
                height: 70px;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                backdrop-filter: blur(10px);
            }

            .page-header-text h2 {
                font-size: 1.8rem;
                font-weight: 700;
                margin: 0;
            }

            .page-header-text p {
                font-size: 1rem;
                opacity: 0.9;
            }

            .btn-gradient-secondary,
            .btn-gradient-primary {
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.6rem 1.5rem;
                border-radius: 10px;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
            }

            .btn-gradient-secondary {
                background: var(--gradient-secondary);
            }

            .btn-gradient-primary {
                background: var(--gradient-primary);
            }

            .btn-gradient-secondary:hover,
            .btn-gradient-primary:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-lg);
                color: white;
            }

            .form-card {
                background: var(--bg-secondary);
                border-radius: 20px;
                box-shadow: var(--shadow-md);
                overflow: hidden;
                border: 1px solid var(--border-color);
            }

            .card-header-custom {
                padding: 1.5rem;
                border-bottom: 2px solid var(--border-color);
                background: var(--bg-secondary);
            }

            .card-header-custom h5 {
                color: var(--text-primary);
                font-weight: 700;
                margin: 0;
            }

            .card-body-custom {
                padding: 2rem;
            }

            .section-title {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--text-primary);
                padding-bottom: 0.5rem;
                border-bottom: 2px solid var(--border-color);
                margin-bottom: 1rem;
            }

            .form-group-custom {
                margin-bottom: 1.5rem;
            }

            .form-label-custom {
                font-weight: 600;
                color: var(--text-primary);
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
                display: block;
            }

            .text-danger {
                color: #e53e3e;
            }

            .text-muted {
                color: var(--text-secondary);
                font-size: 0.8rem;
            }

            .form-control-custom {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 2px solid var(--border-color);
                border-radius: 10px;
                background: var(--bg-primary);
                color: var(--text-primary);
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .form-control-custom:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .form-control-custom.is-invalid {
                border-color: #e53e3e;
            }

            .invalid-feedback {
                color: #e53e3e;
                font-size: 0.85rem;
                margin-top: 0.25rem;
                display: block;
            }

            .form-actions {
                margin-top: 2rem;
                padding-top: 2rem;
                border-top: 2px solid var(--border-color);
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
            }

            @media (max-width: 768px) {
                .page-header-text {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .page-header-text h2 {
                    font-size: 1.5rem;
                }

                .form-actions {
                    flex-direction: column;
                }

                .form-actions .btn {
                    width: 100%;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        </script>
    @endpush
@endsection