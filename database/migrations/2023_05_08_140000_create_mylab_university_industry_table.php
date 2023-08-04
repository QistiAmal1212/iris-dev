<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMylabUniversityIndustryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mylab_university_industry', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('mylab_application_id')->index('fk_mylab_university_industry_mylab_application1_idx');
            $table->string('university_name_addrs');
            $table->string('industry_name_addrs');
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mylab_university_industry');
    }
}
