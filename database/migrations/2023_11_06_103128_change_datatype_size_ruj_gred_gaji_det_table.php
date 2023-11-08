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
        Schema::table('ruj_gred_gaji_det', function (Blueprint $table) {
            $table->string('ggh_kod', 21)->change();
            $table->string('peringkat', 3)->change();
            $table->string('tahun', 3)->change();
            $table->string('amaun', 8)->change();
            $table->string('gaji_mula', 7)->change();
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
        Schema::table('ruj_gred_gaji_det', function (Blueprint $table) {
            $table->string('ggh_kod', 255)->change();
            $table->string('peringkat', 255)->change();
            $table->string('tahun', 255)->change();
            $table->string('amaun', 255)->change();
            $table->string('gaji_mula', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
