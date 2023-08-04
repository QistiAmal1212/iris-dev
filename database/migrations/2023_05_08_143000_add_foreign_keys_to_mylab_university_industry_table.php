<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMylabUniversityIndustryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mylab_university_industry', function (Blueprint $table) {
            $table->foreign(['mylab_application_id'], 'fk_mylab_university_industry_mylab_application1')->references(['id'])->on('mylab_application')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mylab_university_industry', function (Blueprint $table) {
            $table->dropForeign('fk_mylab_university_industry_mylab_application1');
        });
    }
}
