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
        // Schema::table('calon_profesional', function (Blueprint $table) {
        //     $table->string('cal_no_pengenalan', 12)->change();
        //     $table->string('kel1_kod', 4)->change();
        //     $table->string('no_ahli', 20)->change();
        //     $table->string('id_pencipta', 12)->change();
        //     $table->string('pengguna', 12)->change();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('calon_profesional', function (Blueprint $table) {
        //     $table->string('cal_no_pengenalan')->change();
        //     $table->string('kel1_kod')->change();
        //     $table->string('no_ahli')->change();
        //     $table->string('id_pencipta')->change();
        //     $table->string('pengguna')->change();
        // });
    }
};
