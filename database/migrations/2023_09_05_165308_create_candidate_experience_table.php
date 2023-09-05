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
        Schema::create('candidate_experience', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('ref_job_code')->nullable();
            $table->string('indicator')->nullable();
            $table->string('job_sector')->nullable();
            $table->string('ref_position_level_code')->nullable();
            $table->string('ref_salary_grade_code')->nullable();
            $table->string('ref_level_jkk_code')->nullable();
            $table->string('service_group')->nullable();
            $table->date('date_appoint')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_verify')->nullable();
            $table->date('date_end')->nullable();
            $table->string('ref_department_ministry_code')->nullable();
            $table->string('property')->nullable();
            $table->string('state_department')->nullable();
            $table->string('salary_scale')->nullable();
            $table->string('monthly_salary')->nullable();
            $table->string('salary_movement')->nullable();
            $table->string('ref_skim_code')->nullable();
            $table->string('ref_state_code')->nullable();
            $table->date('date_end_contract')->nullable();
            $table->string('working_district')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_job_code')->references('code')->on('ref_job')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_position_level_code')->references('code')->on('ref_position_level')->onDelete('no action')->onUpdate('cascade');

            $table->foreign('ref_salary_grade_code')->references('code')->on('ref_salary_grade')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_level_jkk_code')->references('code')->on('ref_level_jkk')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_department_ministry_code')->references('code')->on('ref_department_ministry')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('state_department')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_skim_code')->references('code')->on('ref_skim')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_state_code')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_experience');
    }
};
