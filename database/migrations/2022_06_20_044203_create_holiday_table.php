<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holiday', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('holiday_type_id')->nullable()->index('holiday_holiday_type_id_foreign');
            $table->date('start_date');
            $table->unsignedInteger('duration')->default('1');
            $table->unsignedBigInteger('created_by_user_id')->index('holiday_created_by_user_id_foreign');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign(['created_by_user_id'])->references(['id'])->on('users')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['holiday_type_id'])->references(['id'])->on('master_holiday_type')->onUpdate('CASCADE')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('holiday');
    }
}
