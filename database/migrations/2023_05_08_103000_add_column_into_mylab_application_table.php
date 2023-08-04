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
        Schema::table('mylab_application', function (Blueprint $table) {
            $table->string('file')->nullable()->after('trl_output_remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('mylab_application','file')){
            Schema::table('mylab_application', function (Blueprint $table) {
                $table->dropColumn(['file']);
            });
        }
    }
};
