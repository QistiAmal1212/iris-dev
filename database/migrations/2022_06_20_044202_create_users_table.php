<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('no_ic', 45)->nullable();
            $table->string('email')->unique();
            $table->boolean('isClient')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('signature')->nullable();
            $table->smallInteger('is_active')->default(1);
            $table->rememberToken();
            $table->string('google_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
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
        Schema::dropIfExists('users');
    }
}
