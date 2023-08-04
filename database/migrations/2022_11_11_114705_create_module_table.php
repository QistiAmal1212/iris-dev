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
        if (!Schema::hasTable('module')) {
            Schema::create('module', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('module_name');
                $table->string('module_short_name')->nullable();
                $table->text('module_description')->nullable();
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
        Schema::dropIfExists('module');
    }
};
