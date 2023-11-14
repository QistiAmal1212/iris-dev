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
        Schema::table('calon_matrikulasi', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('tahun_lulus', 5)->change();
            $table->string('no_matrik', 15)->change();
            $table->string('jenis_sijil', 5)->change();
            $table->string('jurusan', 2)->change();
            $table->string('sesi', 10)->change();
            $table->string('semester', 2)->change();
            $table->string('kolej', 2)->change();
            $table->string('kod_subjek', 5)->change();
            $table->string('gred', 2)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        //DB::statement('ALTER TABLE calon_matrikulasi ALTER COLUMN pngk TYPE NUMERIC(10, 2) USING pngk::numeric(10, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_matrikulasi', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('tahun_lulus')->change();
            $table->string('no_matrik')->change();
            $table->string('jenis_sijil')->change();
            $table->string('jurusan')->change();
            $table->string('sesi')->change();
            $table->string('semester')->change();
            $table->string('kolej')->change();
            $table->string('kod_subjek')->change();
            $table->string('gred')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        //DB::statement('ALTER TABLE calon_matrikulasi ALTER COLUMN pngk TYPE VARCHAR(255)');
    }
};
