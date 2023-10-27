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
        Schema::create('ruj_daerah', function (Blueprint $table) {
            $table->id();
            $table->string('kod')->unique();
            $table->date('tarikh_cuti');
            $table->string('kod_ruj_bahagian')->comment('Kod daripada table ruj_bahagian');
            $table->string('kod_ruj_negeri')->comment('Kod daripada table ruj_negeri');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
            $table->boolean('sah_yt')->default(true);

            $table->foreign('kod_ruj_bahagian')->references('kod')->on('ruj_bahagian')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('kod_ruj_negeri')->references('kod')->on('ruj_negeri')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruj_daerah');
    }
};
