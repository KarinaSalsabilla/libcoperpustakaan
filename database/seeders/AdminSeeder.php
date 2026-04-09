<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@libco26.com',
            'password' => Hash::make('AdminPerpus@Libco26'),
            'role' => 'admin',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
