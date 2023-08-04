<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        
		Schema::table('ticket_history', function(Blueprint $table)
		{
			$table->foreign('ticket_id', 'fk_ticket_history_ticket1')->references('id')->on('ticket')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('assigned_by', 'fk_ticket_history_user1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ticket_history', function(Blueprint $table)
		{
			$table->dropForeign('fk_ticket_history_ticket1');
			$table->dropForeign('fk_ticket_history_user1');
		});
	}

}
