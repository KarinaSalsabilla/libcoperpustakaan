<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $table = 'genres';
    protected $primaryKey = 'id_genre';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_genre'
    ];

    // ✅ TAMBAHKAN INI agar Laravel pakai id_genre untuk route model binding
    public function getRouteKeyName()
    {
        return 'id_genre';
    }
}