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
        Schema::create('e_books', function (Blueprint $table) {  // ← Pakai 'e_books' (dengan 's')
            $table->increments('id_buku');
            $table->string('judul_buku', 40)->nullable();
            $table->string('pengarang', 50)->nullable();
            $table->string('penerbit', 30)->nullable();
            $table->year('tahun_terbit')->nullable();

            $table->unsignedInteger('id_kategori')->nullable();

            $table->string('cover', 100)->nullable();
            $table->string('file_ebook', 100)->nullable();
            $table->text('sinopsis')->nullable();
            $table->integer('jumlah_ebook');
            $table->timestamps();
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_books');  // ← Pakai 'e_books' (dengan 's')
    }
};