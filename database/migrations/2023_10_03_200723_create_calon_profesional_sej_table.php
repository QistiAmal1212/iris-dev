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
        Schema::create('calon_profesional_sej', function (Blueprint $table) {
            $table->id('ph_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('kod_ruj_kelulusan')->nullable();
            $table->string('no_ahli')->nullable();
            $table->date('tarikh')->nullable();
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
        Schema::dropIfExists('calon_profesional_sej');
    }
};
