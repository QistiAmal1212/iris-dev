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
        Schema::create('candidate_matriculation', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('year');
            $table->string('matric_no');
            $table->string('type');
            $table->string('ref_matriculation_course_code');
            $table->string('session');
            $table->string('semester');
            $table->string('ref_matriculation_code');
            $table->string('ref_matriculation_subject_code');
            $table->string('grade');
            $table->string('pngk')->comment('Purata Nilai Gred Kumulatif');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_matriculation_course_code')->references('code')->on('ref_matriculation_course')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_matriculation_code')->references('code')->on('ref_matriculation')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_matriculation_subject_code')->references('code')->on('ref_matriculation_subject')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_matriculation');
    }
};
