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
        Schema::table('calon_psl', function (Blueprint $table) {
            $table->string('cal_no_pengenalan', 12)->change();
            $table->string('kel1_kod', 4)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });

        DB::statement('ALTER TABLE calon_psl ALTER COLUMN tarikh_exam TYPE DATE USING tarikh_exam::date');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_psl', function (Blueprint $table) {
            $table->string('cal_no_pengenalan')->change();
            $table->string('kel1_kod')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });

        DB::statement('ALTER TABLE calon_psl ALTER COLUMN tarikh_exam TYPE VARCHAR(255)');
    }
};
