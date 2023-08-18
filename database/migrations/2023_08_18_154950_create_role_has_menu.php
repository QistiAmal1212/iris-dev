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
        Schema::create('role_has_menu', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action')->onUpdate('cascade');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')->references('id')->on('security_menu')->onDelete('no action')->onUpdate('cascade');
            $table->boolean('access')->default(false);
            $table->boolean('search')->default(false);
            $table->boolean('add')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('delete')->default(false);
            $table->boolean('report')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_has_menu');
    }
};
