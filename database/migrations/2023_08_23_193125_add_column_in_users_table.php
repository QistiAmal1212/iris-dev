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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->after('no_ic');
            $table->after('signature', function ($table) {
                $table->unsignedBigInteger('ref_department_ministry_code')->nullable();
                $table->unsignedBigInteger('ref_skim_code')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('ref_department_ministry_code');
            $table->dropColumn('ref_skim_code');
        });
    }
};
