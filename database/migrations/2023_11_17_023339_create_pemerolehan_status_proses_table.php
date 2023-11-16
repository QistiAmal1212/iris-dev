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
        Schema::create('pemerolehan_status_proses', function (Blueprint $table) {
            $table->string('no_pemerolehan', 10)->primary();
            $table->string('status_proses', 1)->nullable(); // You might want to adjust this based on your constraints
            $table->decimal('bil_rekod', 8, 0)->nullable();
            $table->decimal('bil_calon', 8, 0)->nullable();
            $table->decimal('bil_berjaya', 8, 0)->nullable();
            $table->string('pengguna_jalankan', 10)->nullable();
            $table->date('masa_mula')->nullable();
            $table->date('masa_tamat')->nullable();
            $table->decimal('bil_rekod_temp', 8, 0)->nullable();
            $table->decimal('bil_rekod_berjaya_temp', 8, 0)->nullable();
            $table->string('msg', 255)->nullable();
            $table->string('id_pencipta', 12)->nullable();
            $table->timestamp('tarikh_cipta')->nullable();
            $table->string('pengguna', 12)->nullable();
            $table->timestamp('tarikh_ubahsuai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemerolehan_status_proses');
    }
};
