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
        Schema::table('calon_keputusan_sekolah', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('jenis_sijil', 1)->change();
            $table->string('angka_gil', 10)->change();
            $table->string('kep_terbuka', 1)->change();
            $table->string('tahun', 4)->change();
            $table->string('mpel_tkt', 1)->change();
            $table->string('mpel_kod', 3)->change();
            $table->string('gred', 15)->change();
            $table->string('pangkat_sijil', 1)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        DB::statement('ALTER TABLE calon_keputusan_sekolah ALTER COLUMN pngk_gred TYPE NUMERIC(5, 2) USING pngk_gred::numeric(5, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_keputusan_sekolah', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('jenis_sijil')->change();
            $table->string('angka_gil')->change();
            $table->string('kep_terbuka')->change();
            $table->string('tahun')->change();
            $table->string('mpel_tkt')->change();
            $table->string('mpel_kod')->change();
            $table->string('gred')->change();
            $table->string('pangkat_sijil')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        DB::statement('ALTER TABLE calon_keputusan_sekolah ALTER COLUMN pngk_gred TYPE VARCHAR(255');
    }
};
