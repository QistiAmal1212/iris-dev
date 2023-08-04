<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Master\MasterCountry;

class MasterStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('master_state')->delete();

        DB::table('master_state')->insert([
            'name' => 'Johor',
            'code' => '01',
            'is_friday_weekend' => 1,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Kedah',
            'code' => '02',
            'is_friday_weekend' => 1,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Kelantan',
            'code' => '03',
            'is_friday_weekend' => 1,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Melaka',
            'code' => '04',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Negeri Sembilan',
            'code' => '05',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Pahang',
            'code' => '06',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Pulau Pinang',
            'code' => '09',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Perak',
            'code' => '07',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Perlis',
            'code' => '08',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Selangor',
            'code' => '12',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Terengganu',
            'code' => '13',
            'is_friday_weekend' => 1,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Sabah',
            'code' => '10',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Sarawak',
            'code' => '11',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Wilayah Persekutuan Kuala Lumpur',
            'code' => '14',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Wilayah Persekutuan Labuan',
            'code' => '15',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Wilayah Persekutuan Putrajaya',
            'code' => '16',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
        DB::table('master_state')->insert([
            'name' => 'Ibu Pejabat (HQ)',
            'code' => '00',
            'is_friday_weekend' => 0,
            'country_id' => MasterCountry::where('code','MY')->first()->id,
        ]);
    }
}
