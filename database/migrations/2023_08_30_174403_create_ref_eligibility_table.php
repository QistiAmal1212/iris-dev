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
        Schema::create('ref_eligibility', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('ref_skim_code')->nullable();
            $table->string('category')->nullable();
            $table->string('equivalent');
            $table->string('pemerolehan_code')->comment('Link with table pemerolehan column code')->nullable();
            $table->string('rank');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();

            $table->foreign('ref_skim_code')->references('code')->on('ref_skim')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_eligibility');
    }
};
