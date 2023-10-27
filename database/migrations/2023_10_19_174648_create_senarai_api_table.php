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
        Schema::create('senarai_api', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('url');
            $table->string('nama_path')->nullable();
            $table->boolean('status');
            $table->string('id_pencipta')->nullable();
            $table->string('tarikh_cipta')->nullable();
            $table->string('pengguna')->nullable();
            $table->string('tarikh_ubahsuai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senarai_api');
    }
};
