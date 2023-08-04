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
        if (!Schema::hasTable('module_status')) {
            Schema::create('module_status', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('module_id')->constrained('module')->onUpdate('cascade')->onDelete('cascade');
                $table->integer('status_index')->comment('Numbering start from 1 until end, easy to see the flow if using this instead of primary key');
                $table->string('status_name')->nullable();
                $table->text('status_description')->nullable();
                $table->boolean('active')->default(0);
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
        Schema::dropIfExists('module_status');
    }
};
