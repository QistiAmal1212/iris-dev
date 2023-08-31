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
        Schema::create('candidate_army_police', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan');
            $table->string('status');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('verify_date')->nullable();
            $table->string('ref_rank_code');
            $table->string('no_id')->nullable();
            $table->string('salary')->nullable();
            $table->string('pension');
            $table->string('reward');
            $table->string('type_army_police')->nullable();
            $table->String('type_service')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('no_pengenalan')->references('no_pengenalan')->on('candidate')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_rank_code')->references('code')->on('ref_rank')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_army_police');
    }
};
