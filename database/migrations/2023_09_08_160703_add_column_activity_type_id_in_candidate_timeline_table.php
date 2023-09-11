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
        Schema::table('candidate_timeline', function (Blueprint $table) {
            $table->unsignedBigInteger('activity_type_id')->after('details');
            $table->foreign('activity_type_id')->references('id')->on('master_activity_type')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_timeline', function (Blueprint $table) {
            //
        });
    }
};
