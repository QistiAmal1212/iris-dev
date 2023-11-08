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
        Schema::table('ruj_kem_jabatan', function (Blueprint $table) {
            $table->string('kod', 14)->change();
            $table->string('diskripsi', 80)->change();
            $table->string('alamat_1', 60)->change();
            $table->string('alamat_2', 60)->change();
            $table->string('alamat_3', 60)->change();
            $table->string('gelaran_ketua', 50)->change();
            $table->string('poskod', 5)->change();
            $table->string('bandar', 30)->change();
            $table->string('kem_kod', 14)->change();
            $table->string('diskripsi_2', 80)->change();
            $table->string('diskripsi_3', 80)->change();
            $table->string('emel', 80)->change();
            $table->string('no_tel', 12)->change();
            $table->string('unit_urusan', 2)->change();
            $table->string('id_pencipta', 12)->change();
            $table->string('pengguna', 12)->change();
            $table->string('sah_yt', 1)->change();
            $table->dropColumn('no_pemerolehan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_kem_jabatan', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->text('alamat_1')->change();
            $table->text('alamat_2')->change();
            $table->text('alamat_3')->change();
            $table->string('gelaran_ketua', 255)->change();
            $table->string('poskod', 255)->change();
            $table->string('bandar', 255)->change();
            $table->string('kem_kod', 255)->change();
            $table->string('diskripsi_2', 255)->change();
            $table->string('diskripsi_3', 255)->change();
            $table->string('emel', 255)->change();
            $table->string('no_tel', 255)->change();
            $table->string('unit_urusan', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
            $table->string('no_pemerolehan')->nullable();
        });
    }
};
