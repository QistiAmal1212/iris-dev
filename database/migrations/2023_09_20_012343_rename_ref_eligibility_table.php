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
        Schema::rename('ref_eligibility', 'ruj_kelayakan');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('ruj_kelayakan', 'ref_eligibility');
    }
};
