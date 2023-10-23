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
        Schema::create('akses_api', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_senarai_api');
            $table->unsignedBigInteger('id_table_api');

            $table->foreign('id_senarai_api')->references('id')->on('senarai_api')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('id_table_api')->references('id')->on('table_api')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akses_api');
    }
};
