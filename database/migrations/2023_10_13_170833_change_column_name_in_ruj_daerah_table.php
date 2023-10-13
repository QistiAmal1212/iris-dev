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
        Schema::table('ruj_daerah', function (Blueprint $table) {
            $table->renameColumn('bah_kod','bah');
            $table->renameColumn('neg_kod','bah_kod');
        });
        Schema::table('ruj_daerah', function (Blueprint $table) {
            $table->renameColumn('bah','neg_kod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ruj_daerah', function (Blueprint $table) {
            $table->renameColumn('bah_kod','neg');
            $table->renameColumn('neg_kod','bah_kod');
        });
        Schema::table('ruj_daerah', function (Blueprint $table) {
            $table->renameColumn('neg','neg_kod');
        });
    }
};
