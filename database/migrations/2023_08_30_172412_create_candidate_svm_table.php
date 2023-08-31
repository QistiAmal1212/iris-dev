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
        Schema::create('candidate_svm', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('ref_qualification_code');
            $table->string('year');
            $table->string('pngka')->comment('Purata Nilai Gred Kumulatif');
            $table->string('pngkav')->comment('Purata Nilai Gred Kumulatif');
            $table->string('ref_subject_code');
            $table->string('grade');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_qualification_code')->references('code')->on('ref_qualification')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_subject_code')->references('code')->on('ref_subject')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_svm');
    }
};
