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
        Schema::table('calon_pengalaman', function (Blueprint $table) {
            $table->renameColumn('ref_job_code', 'kod_ruj_pekerjaan');
            $table->renameColumn('indicator', 'pen1_indicator');
            $table->renameColumn('job_sector', 'sektor_pekerjaan');
            $table->renameColumn('ref_position_level_code', 'taraf_jawatan');
            $table->renameColumn('ref_salary_grade_code', 'kod_ruj_gred_gaji');
            $table->renameColumn('ref_level_jkk_code', 'kod_ruj_tingkatan_jkk');
            $table->renameColumn('service_group', 'kump_pkhidmat');
            $table->renameColumn('date_appoint', 'tarikh_lantik');
            $table->renameColumn('date_start', 'tarikh_mula');
            $table->renameColumn('date_verify', 'tarikh_disahkan');
            $table->renameColumn('date_end', 'tarikh_tamat');
            $table->renameColumn('ref_department_ministry_code', 'ruj_kem_jabatan');
            $table->renameColumn('property', 'harta');
            $table->renameColumn('state_department', 'negeri_jabatan');
            $table->renameColumn('salary_scale', 'tangga_gaji');
            $table->renameColumn('monthly_salary', 'gaji_bulanan');
            $table->renameColumn('salary_movement', 'pergerakan_gaji');
            $table->renameColumn('ref_skim_code', 'kod_ruj_skim');
            $table->renameColumn('ref_state_code', 'kod_ruj_negeri');
            $table->renameColumn('date_end_contract', 'tarikh_tamat_kontrak');
            $table->renameColumn('working_district', 'daerah_bertugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_pengalaman', function (Blueprint $table) {
            $table->renameColumn('pen1_indicator', 'indicator');
            $table->renameColumn('sektor_pekerjaan', 'job_sector');
            $table->renameColumn('taraf_jawatan', 'ref_position_level_code');
            $table->renameColumn('kod_ruj_gred_gaji', 'ref_salary_grade_code');
            $table->renameColumn('kod_ruj_tingkatan_jkk', 'ref_level_jkk_code');
            $table->renameColumn('kump_pkhidmat', 'service_group');
            $table->renameColumn('tarikh_lantik', 'date_appoint');
            $table->renameColumn('tarikh_mula', 'date_start');
            $table->renameColumn('tarikh_disahkan', 'date_verify');
            $table->renameColumn('tarikh_tamat', 'date_end');
            $table->renameColumn('ruj_kem_jabatan', 'ref_department_ministry_code');
            $table->renameColumn('harta', 'property');
            $table->renameColumn('negeri_jabatan', 'state_department');
            $table->renameColumn('tangga_gaji', 'salary_scale');
            $table->renameColumn('gaji_bulanan', 'monthly_salary');
            $table->renameColumn('pergerakan_gaji', 'salary_movement');
            $table->renameColumn('kod_ruj_skim', 'ref_skim_code');
            $table->renameColumn('kod_ruj_negeri', 'ref_state_code');
            $table->renameColumn('tarikh_tamat_kontrak', 'date_end_contract');
            $table->renameColumn('daerah_bertugas', 'working_district');
        });
    }
};
