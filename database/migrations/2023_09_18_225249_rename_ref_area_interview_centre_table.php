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
        Schema::table('ref_area_interview_centre', function (Blueprint $table) {
            $table->renameColumn('code', 'kod');
            $table->renameColumn('name', 'nama');
            $table->string('kawasan_induk')->after('name')->default('1');
            $table->renameColumn('is_active', 'sah_yt');
        });
        Schema::rename('ref_area_interview_centre', 'ruj_kawasan_pst_td');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_kawasan_pst_td', function (Blueprint $table) {
            $table->renameColumn('kod', 'code');
            $table->renameColumn('nama', 'name');
            $table->dropColumn('kawasan_induk');
            $table->renameColumn('sah_yt', 'is_active');
        });
        Schema::rename('ruj_kawasan_pst_td', 'ref_area_interview_centre');
    }
};
