<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('e_books', function (Blueprint $table) {
            $table->unsignedInteger('id_genre')->nullable()->after('id_kategori');

            $table->foreign('id_genre')
                  ->references('id_genre')
                  ->on('genres')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('e_books', function (Blueprint $table) {
            $table->dropForeign(['id_genre']);
            $table->dropColumn('id_genre');
        });
    }
};
