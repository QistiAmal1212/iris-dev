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
        Schema::create('candidate_school_result', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('certificate_type');
            $table->string('examination_no');
            $table->string('open_result');
            $table->string('year');
            $table->string('ref_subject_code');
            $table->string('grade');
            $table->string('certificate_rank');
            $table->string('ref_subject_tkt');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_subject_code')->references('code')->on('ref_subject')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_school_result');
    }
};
