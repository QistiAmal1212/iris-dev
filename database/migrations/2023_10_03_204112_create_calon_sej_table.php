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
        Schema::create('calon_sej', function (Blueprint $table) {
            $table->id('ch_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('no_kp_baru')->nullable();
            $table->string('no_kp_lama')->nullable();
            $table->string('no_pasport')->nullable();
            $table->string('warna_kp')->nullable();
            $table->string('nama_penuh')->nullable();
            $table->string('emel')->nullable();
            $table->string('no_tel')->nullable();
            $table->string('kod_ruj_jantina')->nullable();
            $table->string('kod_ruj_status_kahwin')->nullable();
            $table->string('kod_ruj_keturunan')->nullable();
            $table->string('kod_ruj_agama')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('tinggi')->nullable();
            $table->string('berat')->nullable();
            $table->text('alamat_1')->nullable();
            $table->text('alamat_2')->nullable();
            $table->text('alamat_3')->nullable();
            $table->string('poskod')->nullable();
            $table->string('bandar')->nullable();
            $table->string('tempat_tinggal')->nullable();
            $table->text('alamat_1_tetap')->nullable();
            $table->text('alamat_2_tetap')->nullable();
            $table->text('alamat_3_tetap')->nullable();
            $table->string('poskod_tetap')->nullable();
            $table->string('bandar_tetap')->nullable();
            $table->string('tempat_tinggal_tetap')->nullable();
            $table->date('tarikh_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tempat_lahir_bapa')->nullable();
            $table->string('tempat_lahir_ibu')->nullable();
            $table->string('bantuan')->nullable();
            $table->string('biasiswa_p')->nullable();
            $table->string('nom_daftar_bantuan')->nullable();
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
        Schema::dropIfExists('calon_sej');
    }
};
