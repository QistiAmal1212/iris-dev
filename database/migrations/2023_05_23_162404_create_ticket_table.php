<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if (!Schema::hasTable('ticket')) {
            Schema::create('ticket', function(Blueprint $table)
            {
                $table->increments('id');
                $table->bigInteger('module_status_id')->unsigned()->nullable()->index('fk_ticket_module_status1');
                $table->integer('module_id')->unsigned()->nullable();
                $table->integer('master_ticket_category_id')->unsigned()->nullable()->index('fk_ticket_master_ticket_cat1');
                $table->integer('master_ticket_sub_category_id')->unsigned()->nullable()->index('fk_ticket_master_ticket_sub_cat1');
                $table->string('sub_category_other')->nullable();
                $table->string('track_id')->nullable();
                $table->integer('user_id')->unsigned()->nullable();
                $table->integer('master_priority_id')->unsigned()->nullable()->index('fk_ticket_master_ticket_priority1');
                $table->string('frp_no')->nullable();
                $table->string('subject')->nullable();
                $table->text('message', 65535);
                $table->text('solution', 65535)->nullable();
                $table->text('notes', 65535)->nullable();
                $table->integer('sla')->default(0);
                $table->integer('irt')->default(0);
                $table->integer('ort')->default(0);
                $table->integer('prt')->default(0);
                $table->bigInteger('current_assignee_user_id')->unsigned()->nullable()->index('fk_ticket_user1');
                $table->integer('current_issue_line')->default(0);
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
		Schema::drop('ticket');
	}

}
