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
        Schema::table('calon_keputusan_sekolah', function (Blueprint $table) {
            $table->renameColumn('certificate_type', 'jenis_sijil');
            $table->renameColumn('examination_no', 'angka_giliran');
            $table->renameColumn('open_result', 'kep_terbuka');
            $table->renameColumn('year', 'tahun');
            $table->renameColumn('ref_subject_tkt', 'mpel_tkt');
            $table->renameColumn('ref_subject_code', 'mpel_kod');
            $table->renameColumn('grade', 'gred');
            $table->renameColumn('certificate_rank', 'pangkat_sijil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_keputusan_sekolah', function (Blueprint $table) {
            $table->renameColumn('jenis_sijil', 'certificate_type');
            $table->renameColumn('angka_giliran', 'examination_no');
            $table->renameColumn('kep_terbuka', 'open_result');
            $table->renameColumn('tahun', 'year');
            $table->renameColumn('mpel_tkt', 'ref_subject_tkt');
            $table->renameColumn('mpel_kod', 'ref_subject_code');
            $table->renameColumn('gred', 'grade');
            $table->renameColumn('pangkat_sijil', 'certificate_rank');
        });
    }
};
