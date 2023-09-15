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
        Schema::table('ref_rank', function (Blueprint $table) {
            $table->string('kategori')->after('name')->nullable()->comment('D->Tentera Darat, U->Tentera Udara, L->Tentera Laut');//D->Tentera Darat // U->Tentera Udara // L->Tentera Laut
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ref_rank', function (Blueprint $table) {
            //
        });
    }
};
