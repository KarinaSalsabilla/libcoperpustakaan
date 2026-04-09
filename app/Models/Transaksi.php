<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_peminjam';

    protected $fillable = [
        'id_user',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_batas',
        'status_peminjam',   // enum: 'aktif' | 'pinjam' | 'kadaluwarsa'
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_batas'  => 'date',
    ];

    // ── Relasi ──────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function ebook()
    {
        return $this->belongsTo(EBook::class, 'id_buku', 'id_buku');
    }

    // ── Accessor / Helper ────────────────────────────────

    /**
     * Apakah buku sudah lewat tenggat tapi belum dikembalikan?
     */
    public function getIsLewatTenggatAttribute(): bool
    {
        return $this->status_peminjam === 'pinjam'
            && Carbon::today()->gt($this->tanggal_batas);
    }

    /**
     * Sisa hari hingga tenggat (negatif = sudah lewat)
     */
    public function getSisaHariAttribute(): int
    {
        return Carbon::today()->diffInDays($this->tanggal_batas, false);
    }
}