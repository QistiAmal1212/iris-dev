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
        Schema::table('master_function', function (Blueprint $table) {
            $table->string('name', 60)->change();
            $table->string('code', 5)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_function', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('code', 255)->change();
        });
    }
};
