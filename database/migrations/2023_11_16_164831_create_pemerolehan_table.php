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
        Schema::create('pemerolehan', function (Blueprint $table) {
            $table->string('no_pemerolehan', 10)->primary();
            $table->decimal('bil_calon_fasa', 7, 0)->nullable();
            $table->string('bil_kertas', 10)->nullable();
            $table->string('bil_mesyuarat', 10)->nullable();
            $table->decimal('fasa', 2, 0)->nullable();
            $table->string('jawatan_peg_proses', 10)->nullable();
            $table->string('jaw_pen_peg_proses', 10)->nullable();
            $table->string('jelas_urusan', 3)->nullable();
            $table->string('jenis', 1)->nullable();
            $table->string('jenis_kelulusan', 2)->nullable();
            $table->string('jenis_lantikan', 1)->nullable();
            $table->string('kem_jabatan', 4)->nullable();
            $table->string('pegawai_proses', 10)->nullable();
            $table->string('penolong_peg_proses', 10)->nullable();
            $table->decimal('peringkat', 2, 0)->nullable();
            $table->decimal('peringkat_sekarang', 2, 0)->nullable();
            $table->string('per_no_pemerolehan', 10)->nullable();
            $table->string('rujukan_kami', 29)->nullable();
            $table->string('sebab_batal', 100)->nullable();
            $table->string('ski_kod', 14)->nullable();
            $table->string('status_batal', 1)->nullable();
            $table->string('status_proses', 1)->nullable();
            $table->string('sur_kod', 2);
            $table->date('tarikh_dari')->nullable();
            $table->date('tarikh_kep_ujianp1')->nullable();
            $table->date('tarikh_kep_ujianp2')->nullable();
            $table->date('tarikh_telespa')->nullable();
            $table->date('tarikh_tutup')->nullable();
            $table->date('tkh_lulus_ksjaya')->nullable();
            $table->date('tkh_lulus_plp')->nullable();
            $table->date('tkh_pgspa_kkm')->nullable();
            $table->date('tkh_pltd')->nullable();
            $table->string('id_pencipta', 12)->nullable();
            $table->timestamp('tarikh_cipta')->nullable();
            $table->string('pengguna', 12)->nullable();
            $table->timestamp('tarikh_ubahsuai')->nullable();
            $table->string('catatan', 500)->nullable();
            $table->string('status_ujian', 1)->nullable();
            $table->string('pengguna_status_ujian', 12)->nullable();
            $table->string('catatan_bidang', 500)->nullable();
            $table->string('pemerolehan_ujian', 10)->nullable();
            
            $table->foreign('sur_kod')->references('kod')->on('ruj_suruhanjaya')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('ski_kod')->references('kod')->on('ruj_skim')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemerolehan');
    }
};
