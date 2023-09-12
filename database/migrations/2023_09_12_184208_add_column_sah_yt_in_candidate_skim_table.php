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
        Schema::table('candidate_skim', function (Blueprint $table) {
            $table->string('sah_yt')->after('ref_interview_centre_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_skim', function (Blueprint $table) {
            $table->dropColumn('sah_yt');
        });
    }
};
