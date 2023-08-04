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
        if (!Schema::hasTable('module_flow_management')) {
            Schema::create('module_flow_management', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('module_id')->constrained('module')->onUpdate('cascade')->onDelete('cascade');
                $table->foreignId('current_status')->nullable()->constrained('module_status')->onUpdate('cascade')->onDelete('cascade');
                $table->foreignId('module_role_id')->nullable()->constrained('module_role')->onUpdate('cascade')->onDelete('cascade');
                $table->string('action')->nullable();
                $table->foreignId('next_status')->nullable()->constrained('module_status')->onUpdate('cascade')->onDelete('cascade');
                $table->boolean('active');
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
        Schema::dropIfExists('module_flow_management');
    }
};
