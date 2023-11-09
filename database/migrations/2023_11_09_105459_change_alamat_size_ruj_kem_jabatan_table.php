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
        Schema::table('ruj_kem_jabatan', function (Blueprint $table) {
            $table->string('alamat_1', 150)->change();
            $table->string('alamat_2', 150)->change();
            $table->string('alamat_3', 150)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_kem_jabatan', function (Blueprint $table) {
            $table->string('alamat_1', 60)->change();
            $table->string('alamat_2', 60)->change();
            $table->string('alamat_3', 60)->change();
        });
    }
};
