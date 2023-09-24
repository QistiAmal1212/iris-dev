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
        Schema::table('calon_skm', function (Blueprint $table) {
            $table->string('year')->nullable()->change();
            $table->renameColumn('ref_qualification_code', 'kod_ruj_kelulusan');
            $table->renameColumn('year', 'tahun_lulus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_skm', function (Blueprint $table) {
            $table->string('tahun_lulus')->nullable(false)->change();
            $table->renameColumn('kod_ruj_kelulusan', 'ref_qualification_code');
            $table->renameColumn('tahun_lulus', 'year');
        });
    }
};
