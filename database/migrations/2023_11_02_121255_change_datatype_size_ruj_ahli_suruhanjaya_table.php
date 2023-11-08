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
            $table->string('kod', 12)->change();
            $table->string('nama', 50)->change();
            $table->string('no_kp', 12)->change();
            $table->string('jawatan_terakhir', 20)->change();
            $table->string('kekananan', 10)->change();
            $table->string('kementerian', 30)->change();
            $table->string('pangkat_anugerah', 30)->change();
            $table->string('alamat1', 60)->change();
            $table->string('alamat2', 60)->change();
            $table->string('alamat3', 60)->change();
            $table->string('no_telefon', 12)->change();
            $table->string('nama_pasangan', 50)->change();
            $table->string('no_telefon_pasangan', 12)->change();
            $table->string('sukan1', 50)->change();
            $table->string('sukan2', 50)->change();
            $table->string('sukan3', 50)->change();
            $table->string('elaun_pada_gred', 6)->change();
            $table->string('jumlah_pendapatan', 6)->change();
            $table->string('tuntutan_perbatuan', 6)->change();
            $table->string('tuntutan_elaun_makan', 6)->change();
            $table->string('kelayakan_bilik_hotel', 6)->change();
            $table->string('status_ahli', 1)->change();
            $table->string('minat1', 50)->change();
            $table->string('minat2', 50)->change();
            $table->string('minat3', 50)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
            $table->string('sah_yt', 1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('nama', 255)->change();
            $table->string('no_kp', 255)->change();
            $table->string('jawatan_terakhir', 255)->change();
            $table->string('kekananan', 255)->change();
            $table->string('kementerian', 255)->change();
            $table->string('pangkat_anugerah', 255)->change();
            $table->string('alamat1', 255)->change();
            $table->string('alamat2', 255)->change();
            $table->string('alamat3', 255)->change();
            $table->string('no_telefon', 255)->change();
            $table->string('nama_pasangan', 255)->change();
            $table->string('no_telefon_pasangan', 255)->change();
            $table->string('sukan1', 255)->change();
            $table->string('sukan2', 255)->change();
            $table->string('sukan3', 255)->change();
            $table->string('elaun_pada_gred', 255)->change();
            $table->string('jumlah_pendapatan', 255)->change();
            $table->string('tuntutan_perbatuan', 255)->change();
            $table->string('tuntutan_elaun_makan', 255)->change();
            $table->string('kelayakan_bilik_hotel', 255)->change();
            $table->string('status_ahli', 255)->change();
            $table->string('minat1', 255)->change();
            $table->string('minat2', 255)->change();
            $table->string('minat3', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
