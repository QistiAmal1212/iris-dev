<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ruj_tawaran_kursus', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
        });
        Schema::table('ruj_tawaran_kursus', function (Blueprint $table) {
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_tawaran_kursus', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
        });
        Schema::table('ruj_tawaran_kursus', function (Blueprint $table) {
            $table->string('sah_yt')->nullable();
        });
    }
};
