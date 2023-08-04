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
        if (!Schema::hasTable('module_role')) {
            Schema::create('module_role', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('module_id')->constrained('module')->onUpdate('cascade')->onDelete('cascade');
                $table->foreignId('role_id')->constrained('roles')->onUpdate('cascade')->onDelete('cascade');
                $table->text('role_description')->nullable();
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
        Schema::dropIfExists('module_role');
    }
};
