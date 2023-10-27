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
        Schema::table('ruj_jenis_bekas_tentera_polis', function (Blueprint $table) {
            $table->boolean('sah_yt')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_jenis_bekas_tentera_polis', function (Blueprint $table) {
            //
        });
    }
};
