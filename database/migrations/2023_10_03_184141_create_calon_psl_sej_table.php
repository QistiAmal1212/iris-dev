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
        Schema::create('calon_psl_sej', function (Blueprint $table) {
            $table->id('pslch_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('kod_ruj_kelulusan')->nullable();
            $table->date('tarikh_exam')->nullable();
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
        Schema::dropIfExists('calon_psl_sej');
    }
};
