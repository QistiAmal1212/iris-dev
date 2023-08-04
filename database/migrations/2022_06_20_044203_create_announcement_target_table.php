<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcement_target', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('announcement_id')->constrained('announcement')->onUpdate('cascade')->onDelete('NO ACTION');
            $table->foreignId('role_id')->constrained('roles')->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['announcement_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_target');
    }
}
