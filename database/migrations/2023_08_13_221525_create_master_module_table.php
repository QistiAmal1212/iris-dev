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
        Schema::create('master_module', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('data')->nullable();
            $table->string('code')->nullable();
            $table->integer('type')->default(2);// 1 for General Non Flow Process, 2 for Admin, 3 For Flow Process
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_module');
    }
};
