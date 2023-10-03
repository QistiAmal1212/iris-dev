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
        Schema::create('calon_pengajian_tinggi_sej', function (Blueprint $table) {
            $table->id('pthh_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('kod_ruj_institusi')->nullable();
            $table->string('kod_ruj_kelayakan')->nullable();
            $table->string('kod_ruj_pengkhususan')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('ins_fln')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
            $table->string('peringkat_pengajian')->nullable();
            $table->string('nama_sijil')->nullable();
            $table->date('tarikh_senat')->nullable();
            $table->boolean('biasiswa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_pengajian_tinggi_sej');
    }
};
