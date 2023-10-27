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
        Schema::table('calon', function (Blueprint $table) {
            $table->string('pusat_temuduga')->nullable();

            $table->foreign('pusat_temuduga')->references('kod')->on('ruj_pusat_temuduga')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->dropForeign();
        });
    }
};
