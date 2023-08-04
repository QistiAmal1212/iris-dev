<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;


class FMFSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fmfseeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DB Seeder FMF';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'START FMF Seed'.PHP_EOL;
        Log::alert('START FMF Seed');
        try {
            \DB::beginTransaction();
            Log::alert('disable foreign key');
            Schema::disableForeignKeyConstraints();

            Log::alert('FMF Seeding...');
            echo 'FMF Seed...'.PHP_EOL;
            \Artisan::call('db:seed --class=ModuleFlowManagementTableSeeder --force');
            \Artisan::call('db:seed --class=ModuleTableSeeder --force');
            \Artisan::call('db:seed --class=ModuleTaskTableSeeder --force');
            \Artisan::call('db:seed --class=ModulePermissionTableSeeder --force');
            \Artisan::call('db:seed --class=ModuleRoleTableSeeder --force');
            \Artisan::call('db:seed --class=ModuleStatusTableSeeder --force');
            Log::alert('FMF Seed Ended');
            echo 'FMF Seed Ended'.PHP_EOL;

            Log::alert('enable foreign key');
            Schema::enableForeignKeyConstraints();
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            echo 'Failed! ' . $th->getMessage().PHP_EOL;
            Log::debug('Failed! ' . $th->getMessage());
            Log::alert('END  FMF Seed');
            return -1;
        }

        Log::alert('END  FMF Seed');
        echo 'End FMF Seed'.PHP_EOL;
        return 0;
    }
};
