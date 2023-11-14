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
        Schema::table('log_system', function (Blueprint $table) {
            $table->string('method', 10)->change();
            $table->string('ip_address', 45)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('log_system', function (Blueprint $table) {
            $table->string('method', 255)->change();
            $table->string('ip_address', 255)->change();
        });
    }
};
