<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday_state', function (Blueprint $table) {
            $table->unsignedInteger('holiday_id');
            $table->unsignedInteger('state_id')->index('holiday_state_state_id_foreign');
            $table->foreign(['holiday_id'])->references(['id'])->on('holiday')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['state_id'])->references(['id'])->on('master_state')->onUpdate('CASCADE')->onDelete('NO ACTION');
            
            $table->primary(['holiday_id', 'state_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holiday_state');
    }
}
