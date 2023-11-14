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
        Schema::table('calon_pengajian_tinggi', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('ins_kod', 4)->change();
            $table->string('kel_kod', 6)->change();
            $table->string('pen_kod', 3)->change();
            $table->string('tahun_lulus', 8)->change();
            $table->string('ins_fln', 1)->change();
            $table->string('peringkat_pengajian', 1)->change();
            $table->string('nama_sijil', 150)->change();
            $table->string('biasiswa', 1)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        //DB::statement('ALTER TABLE calon_pengajian_tinggi ALTER COLUMN cgpa TYPE NUMERIC(3, 2) USING cgpa::numeric(3, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_pengajian_tinggi', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('ins_kod')->change();
            $table->string('kel_kod')->change();
            $table->string('pen_kod')->change();
            $table->string('tahun_lulus')->change();
            $table->string('ins_fln')->change();
            $table->string('peringkat_pengajian')->change();
            $table->string('nama_sijil')->change();
            $table->string('biasiswa')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        //DB::statement('ALTER TABLE calon_pengajian_tinggi ALTER COLUMN cgpa TYPE VARCHAR(255)');
    }
};
