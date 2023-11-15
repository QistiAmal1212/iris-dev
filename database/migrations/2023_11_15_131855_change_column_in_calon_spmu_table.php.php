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
        Schema::table('calon_spmu', function (Blueprint $table) {
            $table->string('no_pengenalan', 12)->change();
            $table->string('tahun', 4)->change();
            $table->string('matapelajaran', 30)->change();
            $table->string('jenis_sijil', 20)->change();
            $table->string('gred', 10)->change();
            $table->string('jenis_xm', 1)->change();
            $table->string('ujian_lisan', 1)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_spmu', function (Blueprint $table) {
            $table->string('no_pengenalan')->change();
            $table->string('tahun')->change();
            $table->string('matapelajaran')->change();
            $table->string('jenis_sijil')->change();
            $table->string('gred')->change();
            $table->string('jenis_xm')->change();
            $table->string('ujian_lisan')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });
    }
};
