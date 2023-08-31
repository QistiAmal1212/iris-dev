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
        Schema::create('candidate_higher_education', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('ref_institution_code');
            $table->string('ref_eligibility_code');
            $table->string('ref_specialization_code');
            $table->string('year');
            $table->string('cgpa');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_institution_code')->references('code')->on('ref_institution')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_eligibility_code')->references('code')->on('ref_eligibility')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_specialization_code')->references('code')->on('ref_specialization')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_higher_education');
    }
};
