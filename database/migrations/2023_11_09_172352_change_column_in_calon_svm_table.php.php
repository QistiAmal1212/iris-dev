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
        Schema::table('calon_svm', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('kel1_kod', 4)->change();
            $table->string('tahun_lulus', 5)->change();
            $table->string('mata_pelajaran', 5)->change();
            $table->string('gred', 2)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        DB::statement('ALTER TABLE calon_svm ALTER COLUMN pngka TYPE NUMERIC(5, 2) USING pngka::numeric(5, 2)');
        DB::statement('ALTER TABLE calon_svm ALTER COLUMN pngkv TYPE NUMERIC(5, 2) USING pngkv::numeric(5, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_svm', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('kel1_kod')->change();
            $table->string('tahun_lulus')->change();
            $table->string('mata_pelajaran')->change();
            $table->string('gred')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        DB::statement('ALTER TABLE calon_svm ALTER COLUMN pngka TYPE VARCHAR(255)');
        DB::statement('ALTER TABLE calon_svm ALTER COLUMN pngkv TYPE VARCHAR(255)');
    }
};
