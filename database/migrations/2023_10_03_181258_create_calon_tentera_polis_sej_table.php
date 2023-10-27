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
        Schema::create('calon_tentera_polis_sej', function (Blueprint $table) {
            $table->id('tph_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('status_pkhidmat')->nullable();
            $table->date('tarikh_mula')->nullable();
            $table->date('tarikh_tamat')->nullable();
            $table->date('tarikh_disahkan')->nullable();
            $table->string('pangkat_tentera_polis');
            $table->string('no_tentera_polis')->nullable();
            $table->string('gaji_tentera')->nullable();
            $table->string('pencen')->nullable();
            $table->string('ganjaran')->nullable();
            $table->string('jenis_bekas_tentera')->nullable();
            $table->String('jenis_pkhidmat')->nullable();
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
        Schema::dropIfExists('calon_tentera_polis_sej');
    }
};
