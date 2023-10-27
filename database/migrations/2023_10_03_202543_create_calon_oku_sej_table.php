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
        Schema::create('calon_oku_sej', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('kecacatan_calon')->nullable();
            $table->string('no_daftar_jkm')->nullable();
            $table->string('kategori_oku')->nullable();
            $table->string('sub_oku')->nullable();
            $table->string('status_oku')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calon_oku_sej');
    }
};
