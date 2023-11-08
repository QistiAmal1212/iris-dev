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
        Schema::table('ruj_ruling', function (Blueprint $table) {
            $table->string('kod', 3)->change();
            $table->string('diskripsi', 150)->change();
            $table->string('pernyataan', 100)->change();
            $table->string('status', 1)->change();
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
        Schema::table('ruj_ruling', function (Blueprint $table) {
            $table->string('kod', 255)->change();
            $table->string('diskripsi', 255)->change();
            $table->string('pernyataan', 255)->change();
            $table->string('status', 255)->change();
            $table->string('id_pencipta', 255)->change();
            $table->string('pengguna', 255)->change();
            $table->string('sah_yt', 255)->change();
        });
    }
};
