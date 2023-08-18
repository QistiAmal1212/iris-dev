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
        Schema::create('security_menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('module_id')->nullable();
            $table->integer('level');
            $table->integer('sequence');
            $table->integer('menu_link')->nullable();
            $table->timestamps();

            $table->foreign('module_id')
                ->references('id')
                ->on('master_module')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_menu');
    }
};
