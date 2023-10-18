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
        Schema::table('calon_stpm_pngk', function (Blueprint $table) {
            $table->string('tahun')->nullable()->change();
            $table->string('pngk')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_stpm_pngk', function (Blueprint $table) {
            $table->string('tahun')->nullable(false)->change();
            $table->string('pngk')->nullable(false)->change();
        });
    }
};
