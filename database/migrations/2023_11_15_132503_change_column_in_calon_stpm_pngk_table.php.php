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
        Schema::table('calon_stpm_pngk', function (Blueprint $table) {
            $table->string('no_pengenalan', 12)->change();
            $table->string('tahun', 5)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        DB::statement('ALTER TABLE calon_stpm_pngk ALTER COLUMN bil_periksa TYPE INTEGER USING bil_periksa::integer');
        DB::statement('ALTER TABLE calon_stpm_pngk ALTER COLUMN pngk TYPE NUMERIC(5, 2) USING pngk::numeric(5, 2)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_stpm_pngk', function (Blueprint $table) {
            $table->string('no_pengenalan')->change();
            $table->string('tahun')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        DB::statement('ALTER TABLE calon_stpm_pngk ALTER COLUMN bil_periksa TYPE VARCHAR(255');
        DB::statement('ALTER TABLE calon_stpm_pngk ALTER COLUMN pngk TYPE VARCHAR(255)');
    }
};
