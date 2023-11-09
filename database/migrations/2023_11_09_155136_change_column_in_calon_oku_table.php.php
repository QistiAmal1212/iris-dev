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
        Schema::table('calon_oku', function (Blueprint $table) {
            $table->string('no_pengenalan', 12)->change();
            $table->string('kecacatan_calon', 2)->change();
            $table->string('no_daftar_jkm', 30)->change();
            $table->string('kategori_oku', 2)->change();
            $table->string('sub_oku', 2)->change();
            $table->string('status_oku', 50)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_oku', function (Blueprint $table) {
            $table->string('no_pengenalan')->change();
            $table->string('kecacatan_calon')->change();
            $table->string('no_daftar_jkm')->change();
            $table->string('kategori_oku')->change();
            $table->string('sub_oku')->change();
            $table->string('status_oku')->change();
            $table->string('id_pencipta')->change();
            $table->string('pengguna')->change();
        });
    }
};
