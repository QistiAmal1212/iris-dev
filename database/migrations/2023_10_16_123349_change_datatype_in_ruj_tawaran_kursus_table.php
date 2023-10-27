<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ruj_tawaran_kursus', function (Blueprint $table) {
            $table->text('diskripsi_penuh')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_tawaran_kursus', function (Blueprint $table) {
            $table->string('diskripsi_penuh')->change();
        });
    }
};
