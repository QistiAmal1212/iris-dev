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
        Schema::create('test_form', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('module_id')->constrained('module')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('module_status_id')->constrained('module_status')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_form');
    }
};
