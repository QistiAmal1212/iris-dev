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
        Schema::create('ref_kod_pelbagai', function (Blueprint $table) {
            $table->id();
            $table->string('kod');
            $table->string('kategori');
            $table->string('nama');
            $table->string('sah_yt');
            $table->string('jantina')->nullable();
            $table->string('nilai')->nullable();
            $table->string('no_pemerolehan')->comment('Link with table pemerolehan column code')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->comment('Last Update User')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_kod_pelbagai');
    }
};
