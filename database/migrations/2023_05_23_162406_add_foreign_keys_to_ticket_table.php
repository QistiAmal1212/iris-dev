<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('ticket', function(Blueprint $table)
		{
			$table->foreign('master_ticket_category_id', 'fk_ticket_master_ticket_cat1')->references('id')->on('master_ticket_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('master_priority_id', 'fk_ticket_master_ticket_priority1')->references('id')->on('master_ticket_priority')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('master_ticket_sub_category_id', 'fk_ticket_master_ticket_sub_cat1')->references('id')->on('master_ticket_sub_category')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('module_status_id', 'fk_ticket_module_status1')->references('id')->on('module_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('current_assignee_user_id', 'fk_ticket_user1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->dropForeign('fk_ticket_master_ticket_cat1');
			$table->dropForeign('fk_ticket_master_ticket_priority1');
			$table->dropForeign('fk_ticket_master_ticket_sub_cat1');
			$table->dropForeign('fk_ticket_module_status1');
			$table->dropForeign('fk_ticket_user1');
		});
	}

}
