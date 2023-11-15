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
        Schema::table('calon_skim', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('jenis_lantikan', 1)->change();
            $table->string('ski_kod', 14)->change();
            $table->string('no_kelompok', 10)->change();
            $table->string('no_siri', 3)->change();
            $table->string('pusat_td_pilihan', 2)->change();
            $table->string('status', 1)->change();
            $table->string('tmp_status', 2)->change();
            $table->string('sah_yt', 2)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        //DB::statement('ALTER TABLE calon_skim ALTER COLUMN tarikh_daftar TYPE DATE USING tarikh_daftar::date');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('calon_skim', function (Blueprint $table) {
        //     $table->string('cal_no_pengenalan')->change();
        //     $table->string('jenis_lantikan')->change();
        //     $table->string('ski_kod')->change();
        //     $table->string('no_kelompok')->change();
        //     $table->string('no_siri')->change();
        //     $table->string('pusat_td_pilihan')->change();
        //     $table->string('status')->change();
        //     $table->string('tmp_status')->change();
        //     $table->string('sah_yt')->change();
        //     $table->string('id_pencipta')->change();
        //     $table->string('pengguna')->change();
        // });

        //DB::statement('ALTER TABLE calon_skim ALTER COLUMN tarikh_daftar TYPE VARCHAR(255)');
    }
};
