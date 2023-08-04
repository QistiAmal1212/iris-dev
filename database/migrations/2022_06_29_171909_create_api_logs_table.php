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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('system')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->datetime('time_request')->nullable();
            $table->datetime('time_receive')->nullable();
            $table->string('status')->nullable();
            $table->json('value')->nullable();

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
        Schema::dropIfExists('api_logs');
    }
};
