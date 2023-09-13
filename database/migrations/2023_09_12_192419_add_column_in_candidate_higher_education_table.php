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
        Schema::table('candidate_higher_education', function (Blueprint $table) {
            $table->after('cgpa', function ($table) {
                $table->string('peringkat_pengajian')->nullable();
                $table->string('nama_sijil')->nullable();
                $table->date('tarikh_senat')->nullable();
                $table->boolean('biasiswa')->nullable();
             });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_higher_education', function (Blueprint $table) {
            $table->dropColumn('peringkat_pengajian');
            $table->dropColumn('nama_sijil');
            $table->dropColumn('tarikh_senat');
            $table->dropColumn('biasiswa');
        });
    }
};
