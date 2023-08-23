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
        Schema::create('ref_skim', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('pemerolehan_code')->comment('Link with table pemerolehan column code')->nullable();
            $table->string('GGH_KOD')->nullable();
            $table->string('GUNASAMA')->nullable();
            $table->unsignedBigInteger('ref_skim_type')->nullable();
            $table->string('KP_KOD')->nullable();
            $table->string('KUMP_PKHIDMAT_JKK')->nullable();
            $table->string('KUMP_PKHIDMAT_SSB')->nullable();
            $table->string('UJIAN_WAJIB_1')->nullable();
            $table->string('UJIAN_WAJIB_2')->nullable();
            $table->string('UJIAN_WAJIB_3')->nullable();
            $table->string('UJIAN_WAJIB_4')->nullable();
            $table->string('UJIAN_WAJIB_5')->nullable();
            $table->string('SKIM_PKHIDMAT')->nullable();
            $table->string('GGH_SSM')->nullable();
            $table->string('KUMP_PKHIDMAT_SBPA')->nullable();
            $table->string('OLD_KOD')->nullable();
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
        Schema::dropIfExists('ref_skim');
    }
};
