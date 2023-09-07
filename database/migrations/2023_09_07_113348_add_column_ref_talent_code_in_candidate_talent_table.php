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
        Schema::table('candidate_talent', function (Blueprint $table) {
            $table->string('ref_talent_code')->after('no_pengenalan');
            $table->foreign('ref_talent_code')->references('code')->on('ref_talent')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_talent', function (Blueprint $table) {
			$table->dropForeign('candidate_talent_ref_talent_code_foreign');
            $table->dropColumn('ref_talent_code');
        });
    }
};
