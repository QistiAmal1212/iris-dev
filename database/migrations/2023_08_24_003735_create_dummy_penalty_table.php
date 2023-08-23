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
        Schema::create('dummy_penalty', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ref_penalty_code');
            $table->string('duration');
            $table->string('type');
            $table->string('date_start');
            $table->string('date_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dummy_penalty');
    }
};
