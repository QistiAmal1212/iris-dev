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
        Schema::table('calon_matrikulasi', function (Blueprint $table) {
            $table->string('year')->nullable()->change();
            $table->string('matric_no')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('ref_matriculation_course_code')->nullable()->change();
            $table->string('session')->nullable()->change();
            $table->string('ref_matriculation_code')->nullable()->change();
            $table->string('grade')->nullable()->change();
            $table->string('pngk')->nullable()->change();
            $table->renameColumn('year', 'tahun_lulus');
            $table->renameColumn('matric_no', 'no_matrik');
            $table->renameColumn('type', 'jenis_sijil');
            $table->renameColumn('ref_matriculation_course_code', 'jurusan');
            $table->renameColumn('session', 'sesi');
            $table->renameColumn('ref_matriculation_code', 'kolej');
            $table->renameColumn('ref_matriculation_subject_code', 'kod_subjek');
            $table->renameColumn('grade', 'gred');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_matrikulasi', function (Blueprint $table) {
            $table->string('tahun_lulus')->nullable(false)->change();
            $table->string('no_matrik')->nullable(false)->change();
            $table->string('jenis_sijil')->nullable(false)->change();
            $table->string('jurusan')->nullable(false)->change();
            $table->string('sesi')->nullable(false)->change();
            $table->string('kolej')->nullable(false)->change();
            $table->string('gred')->nullable(false)->change();
            $table->string('pngk')->nullable(false)->change();
            $table->renameColumn('tahun_lulus', 'year');
            $table->renameColumn('no_matrik', 'matric_no');
            $table->renameColumn('jenis_sijil', 'type');
            $table->renameColumn('jurusan', 'ref_matriculation_course_code');
            $table->renameColumn('sesi', 'session');
            $table->renameColumn('kolej', 'ref_matriculation_code');
            $table->renameColumn('kod_subjek', 'ref_matriculation_subject_code');
            $table->renameColumn('gred', 'grade');
        });
    }
};
