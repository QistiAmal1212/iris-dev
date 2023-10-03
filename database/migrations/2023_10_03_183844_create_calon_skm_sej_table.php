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
        Schema::create('calon_skm_sej', function (Blueprint $table) {
            $table->id('skmch_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('kod_ruj_kelulusan')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_skm_sej');
    }
};
