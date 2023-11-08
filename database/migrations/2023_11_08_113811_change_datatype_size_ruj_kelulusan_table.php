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
        Schema::table('ruj_kelulusan', function (Blueprint $table) {
            $table->string('kod', 14)->change();
            $table->string('diskripsi', 100)->change();
            $table->string('jenis', 1)->change();
            $table->string('kategori', 1)->change();
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
        Schema::table('ruj_kelulusan', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->string('jenis', 255)->change();
            $table->string('kategori', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
