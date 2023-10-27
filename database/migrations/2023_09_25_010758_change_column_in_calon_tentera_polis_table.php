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
        Schema::table('calon_tentera_polis', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->string('ref_rank_code')->nullable()->change();
            $table->string('pension')->nullable()->change();
            $table->string('reward')->nullable()->change();
            $table->renameColumn('status', 'status_pkhidmat');
            $table->renameColumn('start_date', 'tarikh_mula');
            $table->renameColumn('end_date', 'tarikh_tamat');
            $table->renameColumn('verify_date', 'tarikh_disahkan');
            $table->renameColumn('ref_rank_code', 'pangkat_tentera_polis');
            $table->renameColumn('no_id', 'no_tentera_polis');
            $table->renameColumn('salary', 'gaji_tentera');
            $table->renameColumn('pension', 'pencen');
            $table->renameColumn('reward', 'ganjaran');
            $table->renameColumn('type_army_police', 'jenis_bekas_tentera');
            $table->renameColumn('type_service', 'jenis_pkhidmat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calon_tentera_polis', function (Blueprint $table) {
            $table->string('status_pkhidmat')->nullable()->change();
            $table->string('pangkat_tentera_polis')->nullable()->change();
            $table->string('pencen')->nullable()->change();
            $table->string('ganjaran')->nullable()->change();
            $table->renameColumn('status_pkhidmat', 'status');
            $table->renameColumn('tarikh_mula', 'start_date');
            $table->renameColumn('tarikh_tamat', 'end_date');
            $table->renameColumn('tarikh_disahkan', 'verify_date');
            $table->renameColumn('pangkat_tentera_polis', 'ref_rank_code');
            $table->renameColumn('no_tentera_polis', 'no_id');
            $table->renameColumn('gaji_tentera', 'salary');
            $table->renameColumn('pencen', 'pension');
            $table->renameColumn('ganjaran', 'reward');
            $table->renameColumn('jenis_bekas_tentera', 'type_army_police');
            $table->renameColumn('jenis_pkhidmat', 'type_service');
        });
    }
};
