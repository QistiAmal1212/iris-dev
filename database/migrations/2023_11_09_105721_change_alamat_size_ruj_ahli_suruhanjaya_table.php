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
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->string('alamat1', 150)->change();
            $table->string('alamat2', 150)->change();
            $table->string('alamat3', 150)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_ahli_suruhanjaya', function (Blueprint $table) {
            $table->string('alamat1', 60)->change();
            $table->string('alamat2', 60)->change();
            $table->string('alamat3', 60)->change();
        });
    }
};
