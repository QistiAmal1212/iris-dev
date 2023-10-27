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
        Schema::create('calon_pengalaman_sej', function (Blueprint $table) {
            $table->id('ph_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('kod_ruj_pekerjaan')->nullable();
            $table->string('pen1_indicator')->nullable();
            $table->string('sektor_pekerjaan')->nullable();
            $table->string('taraf_jawatan')->nullable();
            $table->string('kod_ruj_gred_gaji')->nullable();
            $table->string('kod_ruj_tingkatan_jkk')->nullable();
            $table->string('kump_pkhidmat')->nullable();
            $table->date('tarikh_lantik')->nullable();
            $table->date('tarikh_mula')->nullable();
            $table->date('tarikh_disahkan')->nullable();
            $table->date('tarikh_tamat')->nullable();
            $table->string('ruj_kem_jabatan')->nullable();
            $table->string('harta')->nullable();
            $table->string('negeri_jabatan')->nullable();
            $table->string('tangga_gaji')->nullable();
            $table->string('gaji_bulanan')->nullable();
            $table->string('pergerakan_gaji')->nullable();
            $table->string('kod_ruj_skim')->nullable();
            $table->string('kod_ruj_negeri')->nullable();
            $table->date('tarikh_tamat_kontrak')->nullable();
            $table->string('daerah_bertugas')->nullable();
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
        Schema::dropIfExists('calon_pengalaman_sej');
    }
};
