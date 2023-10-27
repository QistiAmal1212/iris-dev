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
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->string('jawatan_terakhir')->nullable()->change();
            $table->string('kekananan')->nullable()->change();
            $table->string('kementerian')->nullable()->change();
            $table->string('pangkat_anugerah')->nullable()->change();
            $table->string('alamat1')->nullable()->change();
            $table->string('alamat2')->nullable()->change();
            $table->string('alamat3')->nullable()->change();
            $table->string('no_tel')->nullable()->change();
            $table->string('nama_pasangan')->nullable()->change();
            $table->string('no_tel_pasangan')->nullable()->change();
            $table->date('kontrak_dari1')->nullable()->change();
            $table->date('kontrak_hingga1')->nullable()->change();
            $table->date('kontrak_dari2')->nullable()->change();
            $table->date('kontrak_hingga2')->nullable()->change();
            $table->date('kontrak_dari3')->nullable()->change();
            $table->date('kontrak_hingga3')->nullable()->change();
            $table->string('sukan1')->nullable()->change();
            $table->string('sukan2')->nullable()->change();
            $table->string('sukan3')->nullable()->change();
            $table->string('elaun_pada_gred')->nullable()->change();
            $table->string('jumlah_pendapatan')->nullable()->change();
            $table->string('tuntutan_perubatan')->nullable()->change();
            $table->string('tuntutan_elaun_makan')->nullable()->change();
            $table->string('kelayakan_bilik_hotel')->nullable()->change();
            $table->string('status_ahli')->nullable()->change();
            $table->string('minat1')->nullable()->change();
            $table->string('minat2')->nullable()->change();
            $table->string('minat3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->string('jawatan_terakhir')->nullable(false)->change();
            $table->string('kekananan')->nullable(false)->change();
            $table->string('kementerian')->nullable(false)->change();
            $table->string('pangkat_anugerah')->nullable(false)->change();
            $table->string('alamat1')->nullable(false)->change();
            $table->string('alamat2')->nullable(false)->change();
            $table->string('alamat3')->nullable(false)->change();
            $table->string('no_tel')->nullable(false)->change();
            $table->string('nama_pasangan')->nullable(false)->change();
            $table->string('no_tel_pasangan')->nullable(false)->change();
            $table->date('kontrak_dari1')->nullable(false)->change();
            $table->date('kontrak_hingga1')->nullable(false)->change();
            $table->date('kontrak_dari2')->nullable(false)->change();
            $table->date('kontrak_hingga2')->nullable(false)->change();
            $table->date('kontrak_dari3')->nullable(false)->change();
            $table->date('kontrak_hingga3')->nullable(false)->change();
            $table->string('sukan1')->nullable(false)->change();
            $table->string('sukan2')->nullable(false)->change();
            $table->string('sukan3')->nullable(false)->change();
            $table->string('elaun_pada_gred')->nullable(false)->change();
            $table->string('jumlah_pendapatan')->nullable(false)->change();
            $table->string('tuntutan_perubatan')->nullable(false)->change();
            $table->string('tuntutan_elaun_makan')->nullable(false)->change();
            $table->string('kelayakan_bilik_hotel')->nullable(false)->change();
            $table->string('status_ahli')->nullable(false)->change();
            $table->string('minat1')->nullable(false)->change();
            $table->string('minat2')->nullable(false)->change();
            $table->string('minat3')->nullable(false)->change();
        });
    }
};
