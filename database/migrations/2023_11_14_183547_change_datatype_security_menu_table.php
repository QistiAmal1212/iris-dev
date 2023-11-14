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
        Schema::table('security_menu', function (Blueprint $table) {
            $table->string('name', 30)->change();
            $table->string('type', 5)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('security_menu', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('type', 255)->change();
        });
    }
};
