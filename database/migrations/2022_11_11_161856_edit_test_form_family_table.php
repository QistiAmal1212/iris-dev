<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_form', function (Blueprint $table) {
            $table->string('father_name')->nullable()->after('module_status_id');
            $table->integer('father_ic')->nullable()->after('module_status_id');
            $table->text('father_address')->nullable()->after('module_status_id');
            $table->boolean('father_status')->nullable()->after('module_status_id');
            $table->date('father_birthdate')->nullable()->after('module_status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
