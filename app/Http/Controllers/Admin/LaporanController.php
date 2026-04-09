<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $base = Transaksi::whereMonth('tanggal_pinjam', $bulan)
                         ->whereYear('tanggal_pinjam', $tahun);

        // ── Stat cards ──────────────────────────────────────────────
        $totalPeminjaman   = (clone $base)->count();
        $sedangDipinjam    = (clone $base)->where('status_peminjam', 'pinjam')->count();
        $sudahDikembalikan = (clone $base)->where('status_peminjam', 'aktif')->count();
        $kadaluwarsa       = (clone $base)->where('status_peminjam', 'kadaluwarsa')->count();

        // ── Grafik harian ───────────────────────────────────────────
        $grafikRaw = Transaksi::selectRaw('DAY(tanggal_pinjam) as hari, COUNT(*) as total')
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('hari')->orderBy('hari')
            ->pluck('total', 'hari')->toArray();

        $daysInMonth  = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        $grafikLabels = range(1, $daysInMonth);
        $grafikValues = array_map(fn($d) => $grafikRaw[$d] ?? 0, $grafikLabels);

        // ── Buku terpopuler ─────────────────────────────────────────
        $bukuPopuler = Transaksi::selectRaw('id_buku, COUNT(*) as total_pinjam')
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('id_buku')->orderByDesc('total_pinjam')
            ->with('ebook')->take(5)->get();

        // ── Anggota teraktif ────────────────────────────────────────
        $anggotaAktif = Transaksi::selectRaw('id_user, COUNT(*) as total_pinjam')
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->groupBy('id_user')->orderByDesc('total_pinjam')
            ->with('user')->take(5)->get();

        // ── Tabel detail semua data ─────────────────────────────────
        $transaksis = Transaksi::with(['user', 'ebook'])
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->orderBy('tanggal_pinjam', 'desc')
            ->paginate(15);

        return view('admin.laporan.index', compact(
            'bulan', 'tahun',
            'totalPeminjaman', 'sedangDipinjam', 'sudahDikembalikan', 'kadaluwarsa',
            'grafikLabels', 'grafikValues',
            'bukuPopuler', 'anggotaAktif',
            'transaksis'
        ));
    }

    public function exportExcel(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $transaksis = Transaksi::with(['user', 'ebook'])
            ->whereMonth('tanggal_pinjam', $bulan)
            ->whereYear('tanggal_pinjam', $tahun)
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');

        // Gunakan PhpSpreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Peminjaman');

        $gold   = 'C8832A';
        $cream  = 'F7F0E3';
        $border = 'E8DFD0';
        $white  = 'FFFFFF';

        // ── Judul ──────────────────────────────────────────────────
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'LAPORAN PEMINJAMAN — ' . strtoupper($namaBulan));
        $sheet->getStyle('A1')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 13, 'color' => ['rgb' => $white], 'name' => 'Times New Roman'],
            'fill'      => ['fillType' => 'solid', 'startColor' => ['rgb' => $gold]],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(32);

        // ── Sub info ───────────────────────────────────────────────
        $sheet->mergeCells('A2:H2');
        $sheet->setCellValue('A2', 'Digenerate: ' . now()->format('d M Y, H:i') . '   |   Total data: ' . $transaksis->count());
        $sheet->getStyle('A2')->applyFromArray([
            'font'      => ['italic' => true, 'size' => 9, 'color' => ['rgb' => '7A6F5E'], 'name' => 'Arial'],
            'fill'      => ['fillType' => 'solid', 'startColor' => ['rgb' => $cream]],
            'alignment' => ['horizontal' => 'center'],
        ]);
        $sheet->getRowDimension(2)->setRowHeight(18);

        // ── Header kolom ───────────────────────────────────────────
        $headers = ['#', 'ID', 'Nama Anggota', 'Email', 'Judul Buku', 'Tgl Pinjam', 'Tenggat', 'Status'];
        $cols    = ['A','B','C','D','E','F','G','H'];
        foreach ($headers as $i => $h) {
            $sheet->setCellValue($cols[$i].'4', $h);
        }
        $sheet->getStyle('A4:H4')->applyFromArray([
            'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => '5C4D38'], 'name' => 'Arial'],
            'fill'      => ['fillType' => 'solid', 'startColor' => ['rgb' => $cream]],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders'   => [
                'bottom' => ['borderStyle' => 'medium', 'color' => ['rgb' => $gold]],
                'allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => $border]],
            ],
        ]);
        $sheet->getRowDimension(4)->setRowHeight(20);

        // ── Data ───────────────────────────────────────────────────
        $statusColors = [
            'pinjam'      => ['bg' => 'FFFBEB', 'txt' => 'B45309'],
            'kadaluwarsa' => ['bg' => 'FFF1F2', 'txt' => 'B91C1C'],
            'aktif'       => ['bg' => 'F0FDF4', 'txt' => '15803D'],
        ];

        foreach ($transaksis as $i => $t) {
            $row = $i + 5;
            $sheet->setCellValue('A'.$row, $i + 1);
            $sheet->setCellValue('B'.$row, '#'.$t->id_peminjam);
            $sheet->setCellValue('C'.$row, $t->user->name ?? '—');
            $sheet->setCellValue('D'.$row, $t->user->email ?? '—');
            $sheet->setCellValue('E'.$row, $t->ebook->judul_buku ?? '—');
            $sheet->setCellValue('F'.$row, $t->tanggal_pinjam?->format('d/m/Y') ?? '—');
            $sheet->setCellValue('G'.$row, $t->tanggal_batas?->format('d/m/Y') ?? '—');
            $sheet->setCellValue('H'.$row, ucfirst($t->status_peminjam));

            $rowBg = $i % 2 === 0 ? 'FFFFFF' : 'FDFAF6';
            $sheet->getStyle('A'.$row.':G'.$row)->applyFromArray([
                'fill'    => ['fillType' => 'solid', 'startColor' => ['rgb' => $rowBg]],
                'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => $border]]],
                'font'    => ['name' => 'Arial', 'size' => 9],
            ]);

            $sc = $statusColors[$t->status_peminjam] ?? ['bg' => 'F3F4F6', 'txt' => '374151'];
            $sheet->getStyle('H'.$row)->applyFromArray([
                'fill'      => ['fillType' => 'solid', 'startColor' => ['rgb' => $sc['bg']]],
                'font'      => ['bold' => true, 'size' => 9, 'color' => ['rgb' => $sc['txt']], 'name' => 'Arial'],
                'alignment' => ['horizontal' => 'center'],
                'borders'   => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => $border]]],
            ]);
        }

        // ── Lebar kolom ────────────────────────────────────────────
        $widths = ['A'=>5,'B'=>8,'C'=>22,'D'=>28,'E'=>32,'F'=>12,'G'=>12,'H'=>14];
        foreach ($widths as $col => $w) {
            $sheet->getColumnDimension($col)->setWidth($w);
        }

        // ── Freeze header ──────────────────────────────────────────
        $sheet->freezePane('A5');

        $filename = 'laporan_peminjaman_'.$bulan.'_'.$tahun.'.xlsx';
        $writer   = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}