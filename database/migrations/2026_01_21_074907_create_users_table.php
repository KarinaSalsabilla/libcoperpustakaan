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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedInteger('id_user', true); // AUTO_INCREMENT & UNSIGNED
            $table->string('name', 100); // ✅ TAMBAH NAME
            $table->string('email', 50)->unique();
            $table->string('password', 255);
            $table->enum('role', ['admin', 'anggota']);
            $table->tinyInteger('status')->nullable();
            $table->rememberToken(); // wajib untuk auth
            $table->timestamps();    // created_at & updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
