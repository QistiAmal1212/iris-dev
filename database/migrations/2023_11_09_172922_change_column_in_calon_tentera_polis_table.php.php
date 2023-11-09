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
        Schema::table('calon_tentera_polis', function (Blueprint $table) {
            $table->string('no_pengenalan', 12)->change();
            $table->string('status_pkhidmat', 1)->change();
            $table->string('pangkat_tent_polis', 2)->change();
            $table->string('no_tent_polis', 10)->change();
            $table->string('pencen', 1)->change();
            $table->string('ganjaran', 1)->change();
            $table->string('jenis_bekas_tentera', 7)->change();
            $table->string('jenis_pkhidmat', 1)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        DB::statement('ALTER TABLE calon_tentera_polis ALTER COLUMN gaji_tentera TYPE NUMERIC(8, 2) USING gaji_tentera::numeric(8, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_tentera_polis', function (Blueprint $table) {
            $table->string('no_pengenalan')->change();
            $table->string('status_pkhidmat')->change();
            $table->string('pangkat_tent_polis')->change();
            $table->string('no_tent_polis')->change();
            $table->string('pencen')->change();
            $table->string('ganjaran')->change();
            $table->string('jenis_bekas_tentera')->change();
            $table->string('jenis_pkhidmat')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        DB::statement('ALTER TABLE calon_tentera_polis ALTER COLUMN gaji_tentera TYPE VARCHAR(255)');
    }
};
