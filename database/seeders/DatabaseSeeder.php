<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ModelHasPermissionsTableSeeder::class);
        $this->call(ModelHasRolesTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);

        $this->call(SettingsTableSeeder::class);
        $this->call(MasterAnnouncementTypeSeeder::class);
        $this->call(MasterCountrySeeder::class);
        $this->call(MasterInboxStatusSeeder::class);
        $this->call(MasterMonthTableSeeder::class);
        $this->call(MasterStateSeeder::class);
        $this->call(NotifyTableSeeder::class);
        $this->call(MasterFaqTypeSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(MasterHolidayTypeSeeder::class);
        $this->call(HolidaySeeder::class);
        $this->call(HolidayTableSeeder::class);
        $this->call(HolidayStateTableSeeder::class);

        $this->call(ModuleTableSeeder::class);
        $this->call(ModulePermissionTableSeeder::class);
        $this->call(ModuleRoleTableSeeder::class);
        $this->call(ModuleStatusTableSeeder::class);
        $this->call(ModuleTaskTableSeeder::class);
        $this->call(ModuleFlowManagementTableSeeder::class);

        $this->call(TestFormTableSeeder::class);
        $this->call(TestTableTableSeeder::class);

        $this->call(MasterTicketCategoryTableSeeder::class);
        $this->call(MasterTicketSubCategoryTableSeeder::class);
        $this->call(MasterTicketPriorityTableSeeder::class);
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
