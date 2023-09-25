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
        Schema::table('candidate_school_result', function (Blueprint $table) {
            $table->string('certificate_type')->nullable()->change();
            $table->string('examination_no')->nullable()->change();
            $table->string('open_result')->nullable()->change();
            $table->string('year')->nullable()->change();
            $table->string('ref_subject_tkt')->nullable()->change();
            $table->string('ref_subject_code')->nullable()->change();
            $table->string('grade')->nullable()->change();
            $table->string('certificate_rank')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_school_result', function (Blueprint $table) {
            $table->string('certificate_type')->nullable(false)->change();
            $table->string('examination_no')->nullable(false)->change();
            $table->string('open_result')->nullable(false)->change();
            $table->string('year')->nullable(false)->change();
            $table->string('ref_subject_code')->nullable(false)->change();
            $table->string('grade')->nullable(false)->change();
            $table->string('certificate_rank')->nullable(false)->change();
        });
    }
};
