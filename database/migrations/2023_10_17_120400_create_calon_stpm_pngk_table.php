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
        Schema::create('calon_stpm_pngk', function (Blueprint $table) {
            $table->id(); 
            $table->string('no_pengenalan');
            $table->string('tahun');
            $table->string('bil_periksa')->nullable();
            $table->string('pngk');
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
        Schema::dropIfExists('calon_stpm_pngk');
    }
};
