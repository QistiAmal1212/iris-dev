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
        Schema::create('calon_keputusan_sekolah_sej', function (Blueprint $table) {
            $table->id('rshh_id');
            $table->string('flag');
            $table->string('no_pengenalan');
            $table->string('jenis_sijil')->nullable();
            $table->string('angka_giliran')->nullable();
            $table->string('kep_terbuka')->nullable();
            $table->string('tahun')->nullable();
            $table->string('mpel_tkt')->nullable();
            $table->string('mpel_kod')->nullable();
            $table->string('gred')->nullable();
            $table->string('pangkat_sijil')->nullable();
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
        Schema::dropIfExists('calon_keputusan_sekolah_sej');
    }
};
