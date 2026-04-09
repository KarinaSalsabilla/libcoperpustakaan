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
   Schema::create('anggota', function (Blueprint $table) {
    $table->unsignedInteger('id_user');
    $table->string('nama', 40)->nullable();
    $table->string('nohp', 15)->nullable();
    $table->string('kota', 20)->nullable();
    $table->char('jenis_kelamin', 1)->nullable();
    $table->string('agama', 10)->nullable();
    $table->string('tempat_lahir', 30)->nullable();
    $table->date('tgl_lahir')->nullable();

    $table->foreign('id_user')->references('id_user')->on('users');
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
