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
        // Schema::table('calon_senarai_hitam', function (Blueprint $table) {
        //     $table->string('no_pengenalan', 12)->change();
        //     $table->string('kod', 4)->change();
        //     $table->string('no_kp_baru', 12)->change();
        //     $table->string('no_kp_lama', 12)->change();
        //     $table->string('id_pencipta', 12)->change();
        //     $table->string('pengguna', 12)->change();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('calon_senarai_hitam', function (Blueprint $table) {
        //     $table->string('no_pengenalan')->change();
        //     $table->string('kod')->change();
        //     $table->string('no_kp_baru')->change();
        //     $table->string('no_kp_lama')->change();
        //     $table->string('id_pencipta')->change();
        //     $table->string('pengguna')->change();
        // });
    }
};
