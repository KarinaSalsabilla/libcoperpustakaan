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
   Schema::create('riwayat_ebook', function (Blueprint $table) {
    $table->increments('id_riwayat');
    $table->unsignedInteger('id_user');
    $table->unsignedInteger('id_buku');
    $table->date('tgl_pinjam_riwayat');
    $table->date('tgl_batas_riwayat');
    $table->enum('status_riwayat', ['dibaca', 'selesai'])->default('dibaca');

    $table->foreign('id_user')->references('id_user')->on('users');
    $table->foreign('id_buku')->references('id_buku')->on('e_books');
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_ebook');
    }
};
