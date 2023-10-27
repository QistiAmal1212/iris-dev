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
        Schema::create('log_api', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_senarai_api');
            $table->string('kod_http');
            $table->string('nama');
            $table->string('execution_time');
            $table->string('size_request');
            $table->boolean('status');
            $table->string('id_pencipta')->nullable();
            $table->string('tarikh_cipta')->nullable();
            $table->string('pengguna')->nullable();
            $table->string('tarikh_ubahsuai')->nullable();

            
            $table->foreign('id_senarai_api')->references('id')->on('senarai_api')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_api');
    }
};
