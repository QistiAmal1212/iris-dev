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
        Schema::table('calon_psl', function (Blueprint $table) {
            $table->string('exam_date')->nullable()->change();
            $table->renameColumn('ref_qualification_code', 'kod_ruj_kelulusan');
            $table->renameColumn('exam_date', 'tarikh_exam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_psl', function (Blueprint $table) {
            $table->string('tarikh_exam')->nullable(false)->change();
            $table->renameColumn('kod_ruj_kelulusan', 'ref_qualification_code');
            $table->renameColumn('tarikh_exam', 'exam_date');
        });
    }
};
