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
        Schema::table('ruj_kelayakan', function (Blueprint $table) {
            $table->string('kod', 16)->change();
            $table->string('diskripsi', 60)->change();
            $table->string('ski_kod', 14)->change();
            $table->string('kategori_kelayakan', 3)->change();
            $table->string('kelayakan_setara', 1)->change();
            $table->string('rank_layak', 2)->change();
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
        Schema::table('ruj_kelayakan', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->string('ski_kod', 255)->change();
            $table->string('kategori_kelayakan', 255)->change();
            $table->string('kelayakan_setara', 255)->change();
            $table->string('rank_layak', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
