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
        Schema::create('ruj_jenis_pengalaman9', function (Blueprint $table) {
            $table->id();
            $table->string('kod');
            $table->string('diskripsi');
            $table->string('id_pencipta')->nullable();
            $table->timestamp('tarikh_cipta')->nullable();
            $table->string('pengguna')->nullable();
            $table->timestamp('tarikh_ubahsuai')->nullable();
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruj_jenis_pengalaman9');
    }
};
