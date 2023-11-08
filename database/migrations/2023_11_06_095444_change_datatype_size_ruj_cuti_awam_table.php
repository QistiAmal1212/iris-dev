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
        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            $table->string('ca_id', 20)->change();
            $table->string('neg_kod', 2)->change();
            $table->string('scut_kod', 3)->change();
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
        Schema::table('ruj_cuti_awam', function (Blueprint $table) {
            $table->string('ca_id', 255)->change();
            $table->string('neg_kod', 255)->change();
            $table->string('scut_kod', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
