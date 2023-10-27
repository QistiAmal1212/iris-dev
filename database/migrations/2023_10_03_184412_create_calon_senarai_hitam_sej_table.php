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
        Schema::create('calon_senarai_hitam_sej', function (Blueprint $table) {
            $table->id();
            $table->string('flag');
            $table->string('kod')->nullable();
            $table->string('no_pengenalan');
            $table->date('tarikh_kuatkuasa')->nullable();
            $table->string('no_kp_baru')->nullable();
            $table->string('no_kp_lama')->nullable();
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
        Schema::dropIfExists('calon_senarai_hitam_sej');
    }
};
