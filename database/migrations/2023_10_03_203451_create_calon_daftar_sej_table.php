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
        Schema::create('calon_daftar_sej', function (Blueprint $table) {
            $table->id('dch_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('skim')->nullable();
            $table->string('tarikh_daftar')->nullable();
            $table->string('tarikh_daftar_1')->nullable();
            $table->string('j_daftar')->nullable();
            $table->string('keutamaan')->nullable();
            $table->string('status_akaun')->nullable();
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
        Schema::dropIfExists('calon_daftar_sej');
    }
};
