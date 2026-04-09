@extends('layouts.admin')

@section('page-title', 'Karya')

@section('content')
<div class="container-fluid px-4 py-4">

    @php
        // ── Link Google Form (embed untuk admin isi) ──
        $linkFormEmbed = 'https://docs.google.com/forms/d/e/1FAIpQLSdreAVdDIsG3-ueo-5PoNExYCHNgtBRCdfYRcSAE-bJOxBFmA/viewform?embedded=true';

        // ── Link buka form di tab baru ──
        $linkFormBuka  = 'https://docs.google.com/forms/d/e/1FAIpQLSdreAVdDIsG3-ueo-5PoNExYCHNgtBRCdfYRcSAE-bJOxBFmA/viewform';

        // ── Link Responses admin ──
        $linkResponses = 'https://docs.google.com/forms/d/1Ttz98fanx-JN5WAnURCdrwwmELDzo_uKEKbgrLhwtUM/edit#responses';

        // ── Link Google Sheets (embed) ──
        // Diambil dari spreadsheet ID kamu, gid sudah sesuai
        $sheetsId      = '18aLqJ9kgBsZNW1QS3QUGdJlT7-F4mjIxcitdVMWYw5M';
        $sheetsGid     = '1208787637';
        $sheetsEmbed   = "https://docs.google.com/spreadsheets/d/{$sheetsId}/htmlview?gid={$sheetsGid}&single=true&widget=true";
        $sheetsBuka    = "https://docs.google.com/spreadsheets/d/{$sheetsId}/edit?gid={$sheetsGid}";
    @endphp

    <!-- Header -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="header-icon">
                <i class="fas fa-feather-alt"></i>
            </div>
            <div>
                <h2 class="mb-1 fw-bold">Karya</h2>
                <p class="text-muted mb-0 small">
                    <i class="fas fa-info-circle me-1"></i>
                    Input karya baru &amp; pantau karya yang dikirim anggota
                </p>
            </div>
        </div>
        <!-- Shortcut buttons -->
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ $linkFormBuka }}" target="_blank" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-external-link-alt me-1"></i> Buka Form
            </a>
            <a href="{{ $linkResponses }}" target="_blank" class="btn btn-sm btn-outline-success">
                <i class="fas fa-list-alt me-1"></i> Lihat Respons
            </a>
            <a href="{{ $sheetsBuka }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-table me-1"></i> Buka Sheets
            </a>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-wrapper">
        <button class="karya-tab active" data-tab="input">
            <i class="fas fa-plus-circle me-2"></i>Input Karya Baru
        </button>
        <button class="karya-tab" data-tab="data">
            <i class="fas fa-database me-2"></i>Data Karya Anggota
        </button>
    </div>

    {{-- ══════════ TAB 1: INPUT KARYA (embed form) ══════════ --}}
    <div id="tab-input" class="panel-card">
        <div class="panel-info mb-3">
            <i class="fas fa-edit me-2 text-primary"></i>
            <span class="small text-muted">
                Isi form di bawah ini untuk menambahkan karya baru ke koleksi perpustakaan.
            </span>
        </div>
        <div class="embed-wrapper">
            <iframe
                src="{{ $linkFormEmbed }}"
                width="100%"
                height="820"
                frameborder="0"
                marginheight="0"
                marginwidth="0">
                Memuat form...
            </iframe>
        </div>
    </div>

    {{-- ══════════ TAB 2: DATA KARYA ANGGOTA ══════════ --}}
    <div id="tab-data" class="panel-card d-none">

        <!-- Info bar -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
            <div class="panel-info flex-grow-1 mb-0">
                <i class="fas fa-info-circle me-2 text-primary"></i>
                <span class="small text-muted">
                    Data berikut diambil langsung dari Google Sheets yang terhubung ke form anggota.
                    Klik <strong>Refresh</strong> untuk memuat ulang data terbaru.
                </span>
            </div>
            <div class="d-flex gap-2 ms-2">
                <button class="btn btn-sm btn-outline-primary" onclick="refreshSheets()">
                    <i class="fas fa-sync-alt me-1" id="refreshIcon"></i> Refresh
                </button>
                <a href="{{ $sheetsBuka }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-external-link-alt me-1"></i> Buka Sheets
                </a>
            </div>
        </div>

        <!-- Embed Spreadsheet -->
        <div class="embed-wrapper">
            <iframe
                id="sheetsFrame"
                src="{{ $sheetsEmbed }}"
                width="100%"
                height="620"
                frameborder="0"
                style="border: none;">
                Memuat data...
            </iframe>
        </div>

        <!-- Catatan -->
        <div class="note-box mt-3">
            <i class="fas fa-lightbulb me-2 text-warning"></i>
            <span class="small">
                <strong>Tips:</strong> Jika data tidak muncul, pastikan Google Sheets sudah
                di-publish. Caranya: buka Sheets → <em>File → Share → Publish to web → Publish</em>.
                Atau klik <strong>Buka Sheets</strong> untuk lihat data langsung di Google.
            </span>
        </div>

    </div>

</div>

@push('styles')
<style>
    :root {
        --bg-primary: #f8f9fa;
        --bg-secondary: #ffffff;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --border-color: #e2e8f0;
        --shadow-md: 0 4px 6px rgba(0,0,0,.08);
        --shadow-lg: 0 10px 25px rgba(0,0,0,.12);
        --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    [data-theme="dark"] {
        --bg-primary: #1a202c;
        --bg-secondary: #2d3748;
        --text-primary: #f7fafc;
        --text-secondary: #a0aec0;
        --border-color: #4a5568;
    }

    /* Header icon */
    .header-icon {
        width: 55px; height: 55px;
        background: var(--gradient-primary);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px; color: white;
        box-shadow: var(--shadow-md);
        flex-shrink: 0;
    }

    /* Tab Nav */
    .tab-wrapper {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-bottom: none;
        border-radius: 14px 14px 0 0;
        padding: 12px 20px 0;
        display: flex;
        gap: 4px;
    }

    .karya-tab {
        padding: 10px 22px;
        border: none;
        border-radius: 10px 10px 0 0;
        background: transparent;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border-bottom: 3px solid transparent;
    }

    .karya-tab:hover {
        color: var(--text-primary);
        background: var(--bg-primary);
    }

    .karya-tab.active {
        color: #667eea;
        border-bottom: 3px solid #667eea;
        background: var(--bg-secondary);
    }

    /* Panel */
    .panel-card {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: 0 0 14px 14px;
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
    }

    .panel-info {
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 12px 16px;
        display: inline-flex;
        align-items: center;
    }

    /* Embed */
    .embed-wrapper {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-md);
        background: var(--bg-primary);
    }

    /* Note */
    .note-box {
        background: linear-gradient(135deg, rgba(255,193,7,0.08), rgba(255,152,0,0.08));
        border: 1px solid rgba(255,193,7,0.25);
        border-radius: 10px;
        padding: 12px 16px;
        color: var(--text-secondary);
        display: flex;
        align-items: flex-start;
    }
</style>
@endpush

@push('scripts')
<script>
    // Tab switching
    document.querySelectorAll('.karya-tab').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.karya-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.panel-card').forEach(p => p.classList.add('d-none'));
            this.classList.add('active');
            document.getElementById('tab-' + this.dataset.tab).classList.remove('d-none');
        });
    });

    // Refresh spreadsheet
    function refreshSheets() {
        const icon  = document.getElementById('refreshIcon');
        const frame = document.getElementById('sheetsFrame');
        icon.classList.add('fa-spin');
        // Reload iframe dengan timestamp agar tidak pakai cache
        const base = frame.src.split('&_t=')[0];
        frame.src  = base + '&_t=' + Date.now();
        frame.onload = () => icon.classList.remove('fa-spin');
        setTimeout(() => icon.classList.remove('fa-spin'), 3000);
    }
</script>
@endpush
@endsection