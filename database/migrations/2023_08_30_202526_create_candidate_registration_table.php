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
        Schema::create('candidate_registration', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('ref_skim_code');
            $table->string('date');
            $table->string('date_register');
            $table->string('type');
            $table->string('priority')->nullable();
            $table->string('status');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_skim_code')->references('code')->on('ref_skim')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_registration');
    }
};
