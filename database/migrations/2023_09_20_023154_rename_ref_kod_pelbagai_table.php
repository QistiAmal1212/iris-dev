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
        Schema::rename('ref_kod_pelbagai', 'ruj_kod_pelbagai');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('ruj_kod_pelbagai', 'ref_kod_pelbagai');
    }
};
