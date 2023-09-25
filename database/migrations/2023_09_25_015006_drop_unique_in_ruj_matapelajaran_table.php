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
            $table->dropForeign('candidate_school_result_ref_subject_code_foreign');
        });

        Schema::table('calon_svm', function (Blueprint $table) {
            $table->dropForeign('candidate_svm_ref_subject_code_foreign');
        });

        Schema::table('ruj_matapelajaran', function (Blueprint $table) {
            $table->dropUnique('ref_subject_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_matapelajaran', function (Blueprint $table) {
            $table->string('code')->unique()->change();
        });
    }
};
