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
        Schema::rename('candidate_registration', 'calon_daftar');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('calon_daftar', 'candidate_registration');
    }
};
