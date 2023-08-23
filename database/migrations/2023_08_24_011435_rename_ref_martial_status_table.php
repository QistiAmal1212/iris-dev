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
        Schema::rename('ref_martial_status', 'ref_marital_status');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('ref_marital_status', 'ref_martial_status');
    }
};
