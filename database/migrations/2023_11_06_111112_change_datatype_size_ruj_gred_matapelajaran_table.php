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
        Schema::table('ruj_gred_matapelajaran', function (Blueprint $table) {
            $table->string('gred', 2)->change();
            $table->string('jenis', 1)->change();
            $table->string('tkt', 1)->change();
            $table->string('susunan', 2)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_gred_matapelajaran', function (Blueprint $table) {
            $table->string('gred', 255)->change();
            $table->string('jenis', 255)->change();
            $table->string('tkt', 40)->change();
            $table->string('susunan', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
        });
    }
};
