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
        Schema::table('ref_interview_centre', function (Blueprint $table) {
            $table->string('ref_area_interview_centre_code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ref_interview_centre', function (Blueprint $table) {
            $table->string('ref_area_interview_centre_code')->nullable(false);
        });
    }
};
