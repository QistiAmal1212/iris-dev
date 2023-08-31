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
        Schema::table('role_has_menu', function (Blueprint $table) {
            $table->dropColumn('access');
            $table->dropColumn('search');
            $table->dropColumn('report');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_has_menu', function (Blueprint $table) {
            $table->boolean('access')->default(false);
            $table->boolean('search')->default(false);
            $table->boolean('report')->default(false);
        });
    }
};
