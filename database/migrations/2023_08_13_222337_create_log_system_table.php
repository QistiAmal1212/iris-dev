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
        Schema::create('log_system', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('activity_type_id');
            $table->text('description');
            $table->text('data_old')->nullable();
            $table->text('data_new')->nullable();
            $table->text('url');
            $table->string('method')->default('GET');
            $table->string('ip_address')->nullable();
            $table->unsignedInteger('created_by_user_id')->nullable();
            $table->timestamps();
            $table->foreign('module_id')
                ->references('id')
                ->on('master_module')
                ->onDelete('no action')
                ->onUpdate('cascade');
            $table->foreign('activity_type_id')
                ->references('id')
                ->on('master_activity_type')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_system');
    }
};
