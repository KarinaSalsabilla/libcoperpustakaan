<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaksi;
use Carbon\Carbon;

class AutoKembalikanBuku extends Command
{
    protected $signature   = 'buku:auto-kembalikan';
    protected $description = 'Otomatis kembalikan buku yang sudah melewati tanggal batas';

    public function handle()
    {
        $transaksis = Transaksi::with('ebook')
            ->where('status_peminjam', 'pinjam')
            ->where('tanggal_batas', '<', Carbon::today())
            ->get();

        if ($transaksis->isEmpty()) {
            $this->info('Tidak ada buku yang perlu dikembalikan.');
            return;
        }

        $count = 0;
        foreach ($transaksis as $transaksi) {
            if ($transaksi->ebook) {
                $transaksi->ebook->increment('jumlah_ebook');
            }
            $transaksi->update(['status_peminjam' => 'aktif']);
            $count++;
        }

        $this->info("Berhasil mengembalikan {$count} buku.");
    }
}