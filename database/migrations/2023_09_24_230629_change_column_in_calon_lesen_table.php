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
        Schema::table('calon_lesen', function (Blueprint $table) {
            $table->dropUnique('candidate_license_no_pengenalan_unique');
            $table->string('expiry_date')->nullable()->change();
            $table->string('is_blacklist')->nullable()->change();
            $table->text('blacklist_details')->nullable()->change();
            $table->renameColumn('type', 'jenis_lesen');
            $table->renameColumn('expiry_date', 'tempoh_tamat');
            $table->renameColumn('is_blacklist', 'status_senaraihitam');
            $table->renameColumn('blacklist_details', 'msg_senaraihitam');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_lesen', function (Blueprint $table) {
            $table->string('no_pengenalan')->unique()->change();
            $table->string('tempoh_tamat')->nullable()->change();
            $table->string('status_senaraihitam')->nullable()->change();
            $table->text('msg_senaraihitam')->nullable()->change();
            $table->renameColumn('jenis_lesen', 'type');
            $table->renameColumn('tempoh_tamat', 'expiry_date');
            $table->renameColumn('status_senaraihitam', 'is_blacklist');
            $table->renameColumn('msg_senaraihitam', 'blacklist_details');
        });
    }
};
