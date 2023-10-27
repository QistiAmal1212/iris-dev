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
        Schema::table('calon_daftar', function (Blueprint $table) {
            $table->string('date_register')->nullable(true)->change();
            $table->string('type')->nullable(true)->change();
            $table->string('priority')->nullable(true)->change();
            $table->string('status')->nullable(true)->change();
            $table->renameColumn('ref_skim_code', 'skim');
            $table->renameColumn('date', 'tarikh_daftar');
            $table->renameColumn('date_register', 'tarikh_daftar_1');
            $table->renameColumn('type', 'j_daftar');
            $table->renameColumn('priority', 'keutamaan');
            $table->renameColumn('status', 'status_akaun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_daftar', function (Blueprint $table) {
            $table->string('tarikh_daftar_1')->nullable(true)->change();
            $table->string('j_daftar')->nullable(true)->change();
            $table->string('keutamaan')->nullable(true)->change();
            $table->string('status_akaun')->nullable(true)->change();
            $table->renameColumn('skim', 'ref_skim_code');
            $table->renameColumn('tarikh_daftar', 'date');
            $table->renameColumn('tarikh_daftar_1', 'date_register');
            $table->renameColumn('j_daftar', 'type');
            $table->renameColumn('keutamaan', 'priority');
            $table->renameColumn('status_akaun', 'status');
        });
    }
};
