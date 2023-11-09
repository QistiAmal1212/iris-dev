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
        Schema::table('calon_pengalaman', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('pek_kod', 5)->change();
            $table->string('pen1_indicator', 1)->change();
            $table->string('sektor_pekerjaan', 1)->change();
            $table->string('taraf_jawatan', 1)->change();
            $table->string('ggh_kod', 5)->change();
            $table->string('tj_kod', 1)->change();
            $table->string('kump_pkhidmat', 1)->change();
            $table->string('kj_kod', 4)->change();
            $table->string('harta', 1)->change();
            $table->string('negeri_jabatan', 2)->change();
            $table->string('tangga_gaji', 5)->change();
            $table->string('pergerakan_gaji', 2)->change();
            $table->string('ski_kod', 14)->change();
            $table->string('neg_kod', 2)->change();
            $table->string('daerah_bertugas', 5)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        DB::statement('ALTER TABLE calon_pengalaman ALTER COLUMN gaji_bulanan TYPE NUMERIC(7, 2) USING gaji_bulanan::numeric(7, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_pengalaman', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('pek_kod')->change();
            $table->string('pen1_indicator')->change();
            $table->string('sektor_pekerjaan')->change();
            $table->string('taraf_jawatan')->change();
            $table->string('ggh_kod')->change();
            $table->string('tj_kod')->change();
            $table->string('kump_pkhidmat')->change();
            $table->string('kj_kod')->change();
            $table->string('harta')->change();
            $table->string('negeri_jabatan')->change();
            $table->string('tangga_gaji')->change();
            $table->string('pergerakan_gaji')->change();
            $table->string('ski_kod')->change();
            $table->string('neg_kod')->change();
            $table->string('daerah_bertugas')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        DB::statement('ALTER TABLE calon_pengalaman ALTER COLUMN gaji_bulanan TYPE VARCHAR(255)');
    }
};
