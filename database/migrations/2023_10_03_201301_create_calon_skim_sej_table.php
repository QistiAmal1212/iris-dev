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
        Schema::create('calon_skim_sej', function (Blueprint $table) {
            $table->id('sdh_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('jenis_lantikan')->nullable();
            $table->date('tarikh_daftar')->nullable();
            $table->string('kod_ruj_skim')->nullable();
            $table->string('no_kelompok')->nullable();
            $table->string('no_siri')->nullable();
            $table->string('pusat_td_pilihan')->nullable();
            $table->string('status')->nullable();
            $table->string('tmp_status')->nullable();
            $table->date('tarikh_luput')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
            $table->string('sah_yt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_skim_sej');
    }
};
