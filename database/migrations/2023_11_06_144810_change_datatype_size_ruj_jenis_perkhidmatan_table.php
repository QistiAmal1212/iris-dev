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
        Schema::table('ruj_jenis_perkhidmatan', function (Blueprint $table) {
            $table->string('diskripsi', 100)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_jenis_perkhidmatan', function (Blueprint $table) {
            $table->string('diskripsi', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
        });
    }
};
