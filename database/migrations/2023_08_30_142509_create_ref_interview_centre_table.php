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
        Schema::create('ref_interview_centre', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('ref_area_interview_centre_code');
            $table->string('ref_state_code');
            $table->string('short_name')->nullable();
            $table->timestamps();

            $table->foreign('ref_area_interview_centre_code')->references('code')->on('ref_area_interview_centre')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_interview_centre');
    }
};
