<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;

    protected $table      = 'e_books';
    protected $primaryKey = 'id_buku';
    public    $timestamps = true;

    protected $fillable = [
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'id_kategori',
        'id_genre',
        'cover',
        'file_ebook',
        'sinopsis',
        'jumlah_ebook',
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Kembalikan array id genre dari string "1,2,3" → [1, 2, 3]
    public function getGenreIdsAttribute(): array
    {
        if (empty($this->id_genre)) return [];
        return array_map('intval', explode(',', $this->id_genre));
    }

    // Kembalikan koleksi Genre objects
    public function getGenresAttribute()
    {
        $ids = $this->genre_ids;
        if (empty($ids)) return collect();
        return Genre::whereIn('id_genre', $ids)->get();
    }
}


// cara untuk seeding databases

// LENOVO@DESKTOP-CFKFUSC MINGW64 /d/laragon/www/libco
// $ php artisan db:seed --class=AdminSeeder
