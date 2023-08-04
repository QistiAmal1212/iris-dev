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
        Schema::create('email_recipient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('email_id')->constrained('email')->onUpdate('cascade')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('email_recipient');
    }
};
