<?php

namespace App\Console\Commands;

use App\Models\Calon\CalonSkim;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CalculateExpDate extends Command
{
    protected $signature = 'update:expdate';
    protected $description = 'Calculate expired date for calon skim.';
    public function handle()
    {
        // DB::statement("
        //     UPDATE calon_skim
        //     SET tarikh_luput = tarikh_daftar + interval '365 days'
        //     WHERE tarikh_daftar IS NOT NULL
        //     AND tarikh_luput IS NULL
        // ");
        $calonSkim = CalonSkim::whereNotNull('tarikh_daftar')->whereNull('tarikh_luput')->get();

        foreach($calonSkim as $skim){
            $updateSkim = CalonSkim::find($skim->id);

            $updateSkim->update([
                'tarikh_luput' => Carbon::parse($updateSkim->tarikh_daftar)->addYear()->format('Y-m-d'),
            ]);
        }

        $this->info('Expired date has been update');
    }
}
