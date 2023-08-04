<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('module_permission')) {
            Schema::create('module_permission', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('module_id')->constrained('module')->onUpdate('cascade')->onDelete('cascade');
                $table->string('perm_name')->nullable();
                $table->text('perm_description')->nullable();
                $table->boolean('active');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_permission');
    }
};
