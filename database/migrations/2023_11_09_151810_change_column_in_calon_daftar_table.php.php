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
        // Schema::table('calon_daftar', function (Blueprint $table) {
        //     $table->string('no_pengenalan', 12)->change();
        //     $table->string('skim', 4)->change();
        //     $table->string('j_daftar', 2)->change();
        //     $table->string('status_akuan', 1)->change();
        //     $table->string('id_pencipta', 12)->change();
        //     $table->string('pengguna', 12)->change();
        // });

        //DB::statement('ALTER TABLE calon_daftar ALTER COLUMN tarikh_daftar TYPE DATE USING tarikh_daftar::date');
        //DB::statement('ALTER TABLE calon_daftar ALTER COLUMN tarikh_daftar_1 TYPE DATE USING tarikh_daftar_1::date');
        //DB::statement('ALTER TABLE calon_daftar ALTER COLUMN keutamaan TYPE NUMERIC(5, 0) USING keutamaan::numeric(5, 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('calon_daftar', function (Blueprint $table) {
        //     $table->string('no_pengenalan')->change();
        //     $table->string('skim')->change();
        //     $table->string('j_daftar')->change();
        //     $table->string('status_akuan')->change();
        //     $table->string('id_pencipta')->change();
        //     $table->string('pengguna')->change();
        // });

        //DB::statement('ALTER TABLE calon_daftar ALTER COLUMN tarikh_daftar TYPE VARCHAR(255');
        //DB::statement('ALTER TABLE calon_daftar ALTER COLUMN tarikh_daftar_1 TYPE VARCHAR(255');
        //DB::statement('ALTER TABLE calon_daftar ALTER COLUMN keutamaan TYPE VARCHAR(255');
    }
};
