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
        Schema::table('calon_pengajian_tinggi', function (Blueprint $table) {
            $table->string('year')->nullable()->change();
            $table->string('cgpa')->nullable()->change();
            $table->renameColumn('ref_institution_code', 'kod_ruj_institusi');
            $table->renameColumn('ref_eligibility_code', 'kod_ruj_kelayakan');
            $table->renameColumn('ref_specialization_code', 'kod_ruj_pengkhususan');
            $table->renameColumn('year', 'tahun_lulus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_pengajian_tinggi', function (Blueprint $table) {
            $table->string('tahun_lulus')->nullable(false)->change();
            $table->string('cgpa')->nullable(false)->change();
            $table->renameColumn('kod_ruj_institusi', 'ref_institution_code');
            $table->renameColumn('kod_ruj_kelayakan', 'ref_eligibility_code');
            $table->renameColumn('kod_ruj_pengkhususan', 'ref_specialization_code');
            $table->renameColumn('tahun_lulus', 'year');
        });
    }
};
