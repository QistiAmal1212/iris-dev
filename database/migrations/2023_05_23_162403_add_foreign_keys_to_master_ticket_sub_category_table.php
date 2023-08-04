<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMasterTicketSubCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        
		Schema::table('master_ticket_sub_category', function(Blueprint $table)
		{
			$table->foreign('master_ticket_category_id', 'fk_master_ticket_sub_cat_master_ticket_cat1')->references('id')->on('master_ticket_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('master_ticket_sub_category', function(Blueprint $table)
		{
			$table->dropForeign('fk_master_ticket_sub_cat_master_ticket_cat1');
		});
	}

}
