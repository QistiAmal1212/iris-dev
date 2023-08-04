<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterTicketPriorityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('master_ticket_priority')) {
            Schema::create('master_ticket_priority', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('priority_name');
                $table->string('priority_description')->nullable();
                $table->integer('max_hour')->default(0)->nullable();
                $table->string('color')->nullable();
                $table->timestamps();
            });
        }
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('master_ticket_priority');
	}

}
