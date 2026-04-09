<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = true; // Karena tidak auto increment
    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama_kategori'
    ];

    // Relasi ke EBook
    public function ebooks()
    {
        return $this->hasMany(EBook::class, 'id_kategori', 'id_kategori');
    }
}