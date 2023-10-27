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
        Schema::create('calon_pengalaman9', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->date('tarikh_mula')->nullable();
            $table->date('tarikh_akhir')->nullable();
            $table->string('tempoh_pengalaman')->nullable();
            $table->string('peringkat_pengalaman')->nullable();
            $table->string('jenis_pengalaman')->nullable();
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
        Schema::dropIfExists('calon_pengalaman9');
    }
};
