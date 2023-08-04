<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbox', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('sender_user_id')->nullable();
            $table->unsignedInteger('receiver_user_id')->nullable();
            $table->string('subject');
            $table->text('message');
            $table->unsignedInteger('inbox_status_id')->index('inbox_inbox_status_id_foreign');
            $table->foreign(['inbox_status_id'])->references(['id'])->on('master_inbox_status')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inbox');
    }
}
