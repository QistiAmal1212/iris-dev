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
        Schema::table('candidate', function (Blueprint $table) {
            $table->foreign('ref_state_code')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('permanent_ref_state_code')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate', function (Blueprint $table) {
            $table->dropForeign(['ref_state_code']);
            $table->dropForeign(['permanent_ref_state_code']);
        });
    }
};
