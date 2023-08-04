<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterTicketCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('master_ticket_category')) {
            Schema::create('master_ticket_category', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('category_name');
                $table->string('category_description')->nullable();
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
		Schema::drop('master_ticket_category');
	}

}
