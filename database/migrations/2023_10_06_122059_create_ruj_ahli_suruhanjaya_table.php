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
        Schema::create('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->id();
            $table->string('kod')->unique();
            $table->string('nama');
            $table->string('no_kp');
            $table->string('jawatan_terakhir');
            $table->string('kekananan');
            $table->string('kementerian');
            $table->string('pangkat_anugerah');
            $table->string('alamat1');
            $table->string('alamat2');
            $table->string('alamat3');
            $table->string('no_tel');
            $table->string('nama_pasangan');
            $table->string('no_tel_pasangan');
            $table->date('kontrak_dari1');
            $table->date('kontrak_hingga1');
            $table->date('kontrak_dari2');
            $table->date('kontrak_hingga2');
            $table->date('kontrak_dari3');
            $table->date('kontrak_hingga3');
            $table->string('sukan1');
            $table->string('sukan2');
            $table->string('sukan3');
            $table->string('elaun_pada_gred');
            $table->string('jumlah_pendapatan');
            $table->string('tuntutan_perubatan');
            $table->string('tuntutan_elaun_makan');
            $table->string('kelayakan_bilik_hotel');
            $table->string('status_ahli');
            $table->string('minat1');
            $table->string('minat2');
            $table->string('minat3');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruj_ahli_suruhanjaya');
    }
};
