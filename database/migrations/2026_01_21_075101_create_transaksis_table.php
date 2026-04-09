<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_peminjam');
            $table->unsignedInteger('id_buku')->nullable();
            $table->unsignedInteger('id_user')->nullable();
            $table->date('tanggal_pinjam')->nullable();
            $table->date('tanggal_batas')->nullable();
            $table->enum('status_peminjam', ['aktif', 'pinjam', 'kadaluwarsa'])->default('aktif');

            $table->foreign('id_buku')->references('id_buku')->on('e_books');
            $table->foreign('id_user')->references('id_user')->on('users');

             $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
