<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('ticket_history')) {

            Schema::create('ticket_history', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('ticket_id')->unsigned()->index('fk_ticket_history_ticket1');
                $table->text('comments', 65535);
                $table->bigInteger('assigned_by')->unsigned()->index('fk_ticket_history_user1');
                $table->integer('module_status_id')->unsigned();
                $table->integer('issue_line')->default(0);
                $table->integer('is_no_action')->default(0);
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
		Schema::drop('ticket_history');
	}

}
