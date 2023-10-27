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
        Schema::table('calon_profesional', function (Blueprint $table) {
            $table->dropForeign('candidate_professional_ref_specialization_code_foreign');
            $table->renameColumn('ref_specialization_code', 'kod_ruj_kelulusan');
            $table->renameColumn('member_no', 'no_ahli');
            $table->renameColumn('date', 'tarikh');
            $table->foreign('kod_ruj_kelulusan')->references('code')->on('ruj_kelulusan')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_profesional', function (Blueprint $table) {
            $table->dropForeign('calon_profesional_kod_ruj_kelulusan_foreign');
            $table->renameColumn('kod_ruj_kelulusan', 'ref_specialization_code');
            $table->renameColumn('no_ahli', 'member_no');
            $table->renameColumn('tarikh', 'date');
        });

        Schema::table('calon_profesional', function (Blueprint $table) {
            $table->foreign('ref_specialization_code')->references('code')->on('ref_specialization')->onDelete('no action')->onUpdate('cascade');
        });
    }
};
