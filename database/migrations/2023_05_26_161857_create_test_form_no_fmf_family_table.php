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
        Schema::create('test_form_no_fmf_family', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('test_form_no_fmf_id')->constrained('test_form_no_fmf')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_form_no_fmf_family');
    }
};
