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
        Schema::create('calon_matrikulasi_sej', function (Blueprint $table) {
            $table->id('matrikch_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('tahun_lulus')->nullable();
            $table->string('no_matrik')->nullable();
            $table->string('jenis_sijil')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('sesi')->nullable();
            $table->string('semester')->nullable();
            $table->string('kolej')->nullable();
            $table->string('kod_subjek')->nullable();
            $table->string('gred')->nullable();
            $table->string('pngk')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_matrikulasi_sej');
    }
};
