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
        Schema::create('test_form_no_fmf', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_full_name')->nullable();
            $table->string('user_ic')->nullable();
            $table->text('user_address')->nullable();
            $table->date('user_birth_date')->nullable();
            $table->bigInteger('user_gender')->nullable();
            $table->boolean('user_is_married')->nullable();
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
        Schema::dropIfExists('test_form_no_fmf');
    }
};
