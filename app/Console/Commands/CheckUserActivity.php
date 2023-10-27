<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CheckUserActivity extends Command
{
    protected $signature = 'check:date';
    protected $description = 'Check if date has passed 30 days and toggle column.';

    public function handle()
    {
        $dateLimit = now()->subDays(30);
        // $dateLimit = now()->subMinutes(3);

        User::where('last_login', '<', $dateLimit)
            ->update(['is_active' => 0]);

        $this->info('Check complete.');
    }
}

