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
        Schema::table('calon_svm', function (Blueprint $table) {
            $table->string('year')->nullable()->change();
            $table->string('pngka')->nullable()->change();
            $table->string('pngkav')->nullable()->change();
            $table->string('ref_subject_code')->nullable()->change();
            $table->string('grade')->nullable()->change();
            $table->renameColumn('ref_qualification_code', 'kod_ruj_kelulusan');
            $table->renameColumn('year', 'tahun_lulus');
            $table->renameColumn('ref_subject_code', 'mata_pelajaran');
            $table->renameColumn('grade', 'gred');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_svm', function (Blueprint $table) {
            $table->string('tahun_lulus')->nullable(false)->change();
            $table->string('pngka')->nullable(false)->change();
            $table->string('pngkav')->nullable(false)->change();
            $table->string('mata_pelajaran')->nullable(false)->change();
            $table->string('gred')->nullable(false)->change();
            $table->renameColumn('kod_ruj_kelulusan', 'ref_qualification_code');
            $table->renameColumn('tahun_lulus', 'year');
            $table->renameColumn('mata_pelajaran', 'ref_subject_code');
            $table->renameColumn('gred', 'grade');
        });
    }
};
