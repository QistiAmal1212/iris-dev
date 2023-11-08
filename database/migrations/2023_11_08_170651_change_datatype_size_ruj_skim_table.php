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
        Schema::table('ruj_skim', function (Blueprint $table) {
            $table->string('kod', 14)->change();
            $table->string('diskripsi', 80)->change();
            $table->string('"GGH_KOD"', 11)->change();
            $table->string('"GUNASAMA"', 1)->change();
            $table->string('jenis_skim', 2)->change();
            $table->string('"KP_KOD"', 4)->change();
            $table->string('"KUMP_PKHIDMAT_JKK"', 1)->change();
            $table->string('"KUMP_PKHIDMAT_SSB"', 1)->change();
            $table->string('"UJIAN_WAJIB_1"', 6)->change();
            $table->string('"UJIAN_WAJIB_2"', 6)->change();
            $table->string('"UJIAN_WAJIB_3"', 6)->change();
            $table->string('"UJIAN_WAJIB_4"', 6)->change();
            $table->string('"UJIAN_WAJIB_5"', 6)->change();
            $table->string('"SKIM_PKHIDMAT"', 4)->change();
            $table->string('"GGH_SSM"', 5)->change();
            $table->string('"KUMP_PKHIDMAT_SBPA"', 1)->change();
            $table->string('"OLD_KOD"', 4)->change();
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
        Schema::table('ruj_skim', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->string('"GGH_KOD"', 255)->change();
            $table->string('"GUNASAMA"', 255)->change();
            $table->string('jenis_skim', 255)->change();
            $table->string('"KP_KOD"', 255)->change();
            $table->string('"KUMP_PKHIDMAT_JKK"', 255)->change();
            $table->string('"KUMP_PKHIDMAT_SSB"', 255)->change();
            $table->string('"UJIAN_WAJIB_1"', 255)->change();
            $table->string('"UJIAN_WAJIB_2"', 255)->change();
            $table->string('"UJIAN_WAJIB_3"', 255)->change();
            $table->string('"UJIAN_WAJIB_4"', 255)->change();
            $table->string('"UJIAN_WAJIB_5"', 255)->change();
            $table->string('"SKIM_PKHIDMAT"', 255)->change();
            $table->string('"GGH_SSM"', 255)->change();
            $table->string('"KUMP_PKHIDMAT_SBPA"', 255)->change();
            $table->string('"OLD_KOD"', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
