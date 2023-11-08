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
        Schema::table('ruj_kod_pelbagai', function (Blueprint $table) {
            $table->string('kod', 14)->change();
            $table->string('kategori', 30)->change();
            $table->string('diskripsi', 200)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
            $table->string('sah_yt', 1)->change();
            $table->string('jantina', 2)->change();
            $table->string('nilai', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_kod_pelbagai', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('kategori', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
            $table->string('jantina', 255)->change();
            $table->string('nilai', 255)->change();
        });
    }
};
