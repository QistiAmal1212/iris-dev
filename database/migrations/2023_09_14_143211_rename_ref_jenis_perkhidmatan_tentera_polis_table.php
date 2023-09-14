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
        Schema::rename('ref_jenis_perkhidmatan_tentera_polis', 'ref_jenis_bekas_tentera_polis');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('ref_jenis_bekas_tentera_polis', 'ref_jenis_perkhidmatan_tentera_polis');
    }
};
