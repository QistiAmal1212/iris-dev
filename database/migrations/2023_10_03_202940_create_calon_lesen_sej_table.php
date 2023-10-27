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
        Schema::create('calon_lesen_sej', function (Blueprint $table) {
            $table->id('lch_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('jenis_lesen')->nullable();
            $table->string('tempoh_tamat')->nullable();
            $table->string('status_senaraihitam')->nullable();
            $table->text('msg_senaraihitam')->nullable();
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
        Schema::dropIfExists('calon_lesen_sej');
    }
};
