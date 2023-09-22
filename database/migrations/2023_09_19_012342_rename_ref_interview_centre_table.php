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
        Schema::table('ref_interview_centre', function (Blueprint $table) {
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'nama');
            $table->renameColumn('ref_area_interview_centre_code', 'kod_ruj_kawasan_pst_td');
            $table->renameColumn('ref_state_code', 'kod_ruj_negeri');
            $table->string('jenis_pusat')->after('ref_state_code')->nullable();
            $table->renameColumn('short_name', 'kod_pendek');
            $table->after('short_name', function ($table) {
                $table->string('order_seq')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            });
            $table->renameColumn('is_active', 'sah_yt');
        });
        Schema::rename('ref_interview_centre', 'ruj_pusat_temuduga');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_pusat_temuduga', function (Blueprint $table) {
            $table->renameColumn('kod', 'code');
            $table->renameColumn('nama', 'name');
            $table->renameColumn('kod_ruj_kawasan_pst_td', 'ref_area_interview_centre_code');
            $table->renameColumn('kod_ruj_negeri', 'ref_state_code');
            $table->dropColumn('jenis_pusat');
            $table->renameColumn('kod_pendek', 'short_name');
            $table->dropColumn('order_seq');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->renameColumn('sah_yt', 'is_active');
        });
        Schema::rename('ruj_pusat_temuduga', 'ref_interview_centre');
    }
};
