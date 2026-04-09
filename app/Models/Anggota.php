<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    /**
     * Nama tabel di database
     */
    protected $table = 'anggota';

    /**
     * Primary key tabel
     */
    protected $primaryKey = 'id_user';

    /**
     * Tipe data primary key
     */
    protected $keyType = 'int';

    /**
     * Apakah primary key auto increment?
     */
    public $incrementing = false;

    /**
     * Apakah menggunakan timestamps (created_at, updated_at)?
     */
    public $timestamps = false;

    /**
     * Kolom yang boleh diisi mass assignment
     */
    protected $fillable = [
        'id_user',
        'nama',
        'nohp',
        'jenis_kelamin',
        'agama',
        'tempat_lahir',
        'tgl_lahir',
        'kota',
        'foto',
    ];

    /**
     * Kolom yang di-cast ke tipe data tertentu
     */
    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
        
    }
}