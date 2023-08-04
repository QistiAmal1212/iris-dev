<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasterTicketSubCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('master_ticket_sub_category')) {
            Schema::create('master_ticket_sub_category', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('master_ticket_category_id')->unsigned()->index('fk_master_ticket_sub_cat_master_ticket_cat1');
                $table->string('sub_category_name');
                $table->string('sub_category_description')->nullable();
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
		Schema::drop('master_ticket_sub_category');
	}

}
