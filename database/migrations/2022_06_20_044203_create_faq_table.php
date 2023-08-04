<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->text('question');
            $table->text('answer');
            $table->unsignedInteger('status')->default('1');
            $table->unsignedInteger('faq_type_id')->default('1')->index('faq_faq_type_id_foreign');
            $table->foreign(['faq_type_id'])->references(['id'])->on('master_faq_type')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->string('lang')->default('ms');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq');
    }
}
