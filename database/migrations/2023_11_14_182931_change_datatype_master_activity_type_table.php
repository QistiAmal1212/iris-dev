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
        Schema::table('master_activity_type', function (Blueprint $table) {
            $table->string('name', 25)->change();
            $table->string('name_bi', 25)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_activity_type', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('name_bi', 255)->change();
        });
    }
};
