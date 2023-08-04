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
        if (!Schema::hasTable('module_task')) {
            Schema::create('module_task', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('module_id')->constrained('module')->onUpdate('cascade')->onDelete('cascade');
                $table->foreignId('module_role_id')->constrained('module_role')->onUpdate('cascade')->onDelete('cascade');
                $table->foreignId('module_status_id')->constrained('module_status')->onUpdate('cascade')->onDelete('cascade');
                $table->foreignId('module_permission_id')->constrained('module_permission')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('module_task');
    }
};
