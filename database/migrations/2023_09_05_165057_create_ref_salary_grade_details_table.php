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
        Schema::create('ref_salary_grade_details', function (Blueprint $table) {
            $table->id();
            $table->string('ref_salary_grade_code');
            $table->string('level');
            $table->string('year');
            $table->string('amount');
            $table->string('starting_salary')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('ref_salary_grade_code')->references('code')->on('ref_salary_grade')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_salary_grade_details');
    }
};
