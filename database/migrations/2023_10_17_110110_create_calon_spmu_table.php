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
        Schema::create('calon_spmu', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('angka_giliran_1')->nullable();
            $table->string('keputusan_1')->nullable();
            $table->string('mata_pelajaran_1')->nullable();
            $table->string('tahun_1')->nullable();
            $table->string('angka_giliran_2')->nullable();
            $table->string('keputusan_2')->nullable();
            $table->string('mata_pelajaran_2')->nullable();
            $table->string('tahun_2')->nullable();
            $table->string('id_pencipta')->nullable();
            $table->timestamp('tarikh_cipta')->nullable();
            $table->string('pengguna')->nullable();
            $table->timestamp('tarikh_ubahsuai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_spmu');
    }
};
