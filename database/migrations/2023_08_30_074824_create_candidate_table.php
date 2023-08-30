<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate', function (Blueprint $table) {
            $table->id();
            $table->string('no_pengenalan')->unique();
            $table->string('no_ic')->nullable();
            $table->string('no_ic_old')->nullable();
            $table->string('no_passport')->nullable();
            $table->string('ic_color')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('ref_gender_code')->nullable();
            $table->string('ref_marital_status_code')->nullable();
            $table->string('ref_race_code')->nullable();
            $table->string('ref_religion_code')->nullable();
            $table->string('nationality')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->text('address_1')->nullable();
            $table->text('address_2')->nullable();
            $table->text('address_3')->nullable();
            $table->string('poscode')->nullable();
            $table->string('city')->nullable();
            $table->string('ref_state_code')->nullable()->comment('Table Calon: tempat_tinggal');
            $table->text('mail_address_1')->nullable();
            $table->text('maiL_address_2')->nullable();
            $table->text('mail_address_3')->nullable();
            $table->string('mail_poscode')->nullable();
            $table->string('mail_city')->nullable();
            $table->string('mail_ref_state_code')->nullable()->comment('Table Calon: tempat_tinggal');
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable()->comment('ref_state_code');
            $table->string('father_place_of_birth')->nullable()->comment('ref_state_code');
            $table->string('mother_place_of_birth')->nullable()->comment('ref_state_code');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
            
            $table->foreign('place_of_birth')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('father_place_of_birth')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('mother_place_of_birth')->references('code')->on('ref_state')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_gender_code')->references('code')->on('ref_gender')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_marital_status_code')->references('code')->on('ref_marital_status')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_race_code')->references('code')->on('ref_race')->onDelete('no action')->onUpdate('cascade');
            $table->foreign('ref_religion_code')->references('code')->on('ref_religion')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate');
    }
};
