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
        Schema::table('ruj_gred_gaji_det', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->string('created_by')->change();
            $table->string('updated_by')->change();
            $table->renameColumn('ref_salary_grade_code', 'ggh_kod');
            $table->renameColumn('level', 'peringkat');
            $table->renameColumn('year', 'tahun');
            $table->renameColumn('amount', 'amaun');
            $table->renameColumn('starting_salary', 'gaji_mula');
            $table->renameColumn('created_by', 'id_pencipta');
            $table->renameColumn('created_at', 'tarikh_cipta');
            $table->renameColumn('updated_by', 'pengguna');
            $table->renameColumn('updated_at', 'tarikh_ubahsuai');
        });

        Schema::table('ruj_gred_gaji_det', function (Blueprint $table) {
            $table->string('sah_yt')->default('Y');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_gred_gaji_det', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
            $table->string('id_pencipta')->nullable()->change();
            $table->string('pengguna')->nullable()->change();
            $table->renameColumn('ggh_kod', 'ref_salary_grade_code');
            $table->renameColumn('peringkat', 'level');
            $table->renameColumn('tahun', 'year');
            $table->renameColumn('amaun', 'amount');
            $table->renameColumn('gaji_mula', 'starting_salary');
            $table->renameColumn('id_pencipta', 'created_by');
            $table->renameColumn('tarikh_cipta', 'created_at');
            $table->renameColumn('pengguna', 'updated_by');
            $table->renameColumn('tarikh_ubahsuai', 'updated_at');
        });

        Schema::table('ruj_gred_gaji_det', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
    }
};
