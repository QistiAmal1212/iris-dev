<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notify', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('message');
            $table->boolean('is_active_emel')->default(false);
            $table->boolean('is_active_system')->default(true);
            $table->unsignedBigInteger('created_by_user_id')->index('notify_created_by_user_id_foreign');
            $table->foreign(['created_by_user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('NO ACTION');
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
        Schema::dropIfExists('notify');
    }
}
