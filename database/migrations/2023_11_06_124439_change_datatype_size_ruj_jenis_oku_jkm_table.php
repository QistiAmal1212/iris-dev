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
        Schema::table('ruj_jenis_oku_jkm', function (Blueprint $table) {
            $table->string('kod_oku', 2)->change();
            $table->string('kategori_oku', 50)->change();
            $table->string('diskripsi_oku', 150)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
            $table->string('sah_yt', 1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_jenis_oku_jkm', function (Blueprint $table) {
            $table->string('kod_oku', 255)->change();
            $table->string('kategori_oku', 255)->change();
            $table->string('diskripsi_oku', 120)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
