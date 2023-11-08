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
        Schema::table('ruj_pusat_temuduga', function (Blueprint $table) {
            $table->string('kod', 2)->change();
            $table->string('diskripsi', 35)->change();
            $table->string('kpt_kod', 10)->change();
            $table->string('neg_kod', 2)->change();
            $table->string('kod_pendek', 4)->change();
            $table->string('jenis_pusat', 1)->change();
            $table->string('order_seq', 4)->change();
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
        Schema::table('ruj_pusat_temuduga', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->string('kpt_kod', 255)->change();
            $table->string('neg_kod', 255)->change();
            $table->string('kod_pendek', 255)->change();
            $table->string('jenis_pusat', 255)->change();
            $table->string('order_seq', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
