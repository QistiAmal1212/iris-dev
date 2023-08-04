<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Role;
use DeveloperUnijaya\FlowManagementFunction\Models\Module;
use DeveloperUnijaya\FlowManagementFunction\Models\ModuleStatus;
use DeveloperUnijaya\FlowManagementFunction\Models\ModuleRole;
use DeveloperUnijaya\FlowManagementFunction\Models\ModuleFlowManagement;
use DeveloperUnijaya\FlowManagementFunction\Models\ModulePermission;
use DeveloperUnijaya\FlowManagementFunction\Models\ModuleTask;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class HelpdeskSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:hd_fmfseeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DB Helpdesk FMF';

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
     * @return int
     */
    public function handle()
    {
        echo 'START Helpdesk FMF Seed'.PHP_EOL;
        \DB::beginTransaction();
        try {

            echo 'Role Stage'.PHP_EOL;
            $vendor = Role::firstOrCreate(['name' => "Helpdesk_Vendor", 'description' => "Vendor of helpdesk module", 'display_name' => "[Helpdesk] Vendor", 'guard_name' => "web", 'is_internal' => 1]);
            $pegawai = Role::firstOrCreate(['name' => "Helpdesk_Pegawai_BTM", 'description' => "Officer of helpdesk module", 'display_name' => "[Helpdesk] Pegawai BTM", 'guard_name' => "web", 'is_internal' => 1]);
            $pengguna_luar = Role::firstOrCreate(['name' => "pengguna_luar", 'description' => "External User with basic permission", 'display_name' => "pengguna_luar", 'guard_name' => "web", 'is_internal' => 0]);

            echo 'Module Stage'.PHP_EOL;
            $module = Module::firstOrCreate(['module_name' => "HelpdeskModule", 'module_short_name' => "HDM", 'module_description' => "Helpdesk FMF Module", 'active' => 1]);

            echo 'Module Role Stage'.PHP_EOL;
            $modulepengguna_luar = ModuleRole::firstOrCreate(['module_id' => $module->id, 'role_id' => $pengguna_luar->id, 'role_description' => "Module user", 'active' => 1]);
            $modulepegawai = ModuleRole::firstOrCreate(['module_id' => $module->id, 'role_id' => $pegawai->id, 'role_description' => "Officer module", 'active' => 1]);
            $modulevendor = ModuleRole::firstOrCreate(['module_id' => $module->id, 'role_id' => $vendor->id, 'role_description' => "Module vendor", 'active' => 1]);

            echo 'Module Status Stage'.PHP_EOL;
            $New = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 1, 'status_name' => "New", 'status_description' => "New Ticket", 'status_color' => "warning", 'active' => 1]);
            $Cancel = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 2, 'status_name' => "Cancel", 'status_description' => "Cancel Ticket", 'status_color' => "danger", 'active' => 1]);
            $Acknowledge = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 3, 'status_name' => "Acknowledge", 'status_description' => "Acknowledge Ticket", 'status_color' => "primary", 'active' => 1]);
            $In_Progress = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 4, 'status_name' => "In Progress", 'status_description' => "In Progress Ticket", 'status_color' => "info", 'active' => 1]);
            $Push_Staging = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 5, 'status_name' => "Push Staging", 'status_description' => "Push Staging Ticket", 'status_color' => "info", 'active' => 1]);
            $Re_Acknowledge = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 6, 'status_name' => "Re Acknowledge", 'status_description' => "Re-Acknowledge Ticket", 'status_color' => "secondary", 'active' => 1]);
            $Verified_Staging = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 7, 'status_name' => "Verified Staging", 'status_description' => "Verified Staging Ticket", 'status_color' => "info", 'active' => 1]);
            $Push_Production = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 8, 'status_name' => "Push Production", 'status_description' => "Push Production Ticket", 'status_color' => "info", 'active' => 1]);
            $Verified_Production = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 9, 'status_name' => "Verified Production", 'status_description' => "Verified Production Ticket", 'status_color' => "info", 'active' => 1]);
            $Resolved = ModuleStatus::firstOrCreate(['module_id' => $module->id, 'status_index' => 10, 'status_name' => "Resolved", 'status_description' => "Resolved Ticket", 'status_color' => "success", 'active' => 1]);

            echo 'Module Permission Stage'.PHP_EOL;
            $Form_Update_Priority = ModulePermission::firstOrCreate(['module_id' => $module->id, 'perm_name' => "Form Update Priority", 'perm_description' => "Form Update Priority", 'active' => 1]);
            $Form_Update_Ticket = ModulePermission::firstOrCreate(['module_id' => $module->id, 'perm_name' => "Form Update Ticket", 'perm_description' => "Form Update Ticket", 'active' => 1]);
            $Form_View_Timeline = ModulePermission::firstOrCreate(['module_id' => $module->id, 'perm_name' => "Form View Timeline", 'perm_description' => "Form View Timeline", 'active' => 1]);

            echo 'Module Task Stage'.PHP_EOL;
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Cancel->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Acknowledge->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $In_Progress->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Push_Staging->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Re_Acknowledge->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Verified_Staging->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Push_Production->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Verified_Production->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepengguna_luar->id, 'module_status_id' => $Resolved->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);

            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Cancel->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Acknowledge->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $In_Progress->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Push_Staging->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Re_Acknowledge->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Verified_Staging->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Push_Production->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Verified_Production->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Resolved->id, 'module_permission_id' => $Form_Update_Priority->id, 'active' => 1]);

            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Cancel->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Acknowledge->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $In_Progress->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Push_Staging->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Re_Acknowledge->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Verified_Staging->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Push_Production->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Verified_Production->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Resolved->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);

            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Cancel->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Acknowledge->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $In_Progress->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Push_Staging->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Re_Acknowledge->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Verified_Staging->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Push_Production->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Verified_Production->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulepegawai->id, 'module_status_id' => $Resolved->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);

            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Cancel->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Acknowledge->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $In_Progress->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Push_Staging->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Re_Acknowledge->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Verified_Staging->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Push_Production->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Verified_Production->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Resolved->id, 'module_permission_id' => $Form_Update_Ticket->id, 'active' => 1]);

            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $New->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Cancel->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Acknowledge->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $In_Progress->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Push_Staging->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Re_Acknowledge->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Verified_Staging->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Push_Production->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Verified_Production->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);
            ModuleTask::firstOrCreate(['module_id' => $module->id, 'module_role_id' => $modulevendor->id, 'module_status_id' => $Resolved->id, 'module_permission_id' => $Form_View_Timeline->id, 'active' => 1]);

            echo 'Module Flow Stage'.PHP_EOL;
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $New->id, 'module_role_id' => $modulepegawai->id, 'action' => "acknowledge", 'next_status' => $Acknowledge->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $New->id, 'module_role_id' => $modulepegawai->id, 'action' => "cancel ticket", 'next_status' => $Cancel->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Acknowledge->id, 'module_role_id' => $modulevendor->id, 'action' => "in progress", 'next_status' => $In_Progress->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $In_Progress->id, 'module_role_id' => $modulevendor->id, 'action' => "push staging", 'next_status' => $Push_Staging->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Push_Staging->id, 'module_role_id' => $modulepegawai->id, 'action' => "solved (verified staging)", 'next_status' => $Verified_Staging->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Push_Staging->id, 'module_role_id' => $modulepegawai->id, 'action' => "not solved (re-acknowledge)", 'next_status' => $Re_Acknowledge->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Re_Acknowledge->id, 'module_role_id' => $modulevendor->id, 'action' => "in progress", 'next_status' => $In_Progress->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Verified_Staging->id, 'module_role_id' => $modulevendor->id, 'action' => "push production", 'next_status' => $Push_Production->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Push_Production->id, 'module_role_id' => $modulepegawai->id, 'action' => "solved (verified production)", 'next_status' => $Verified_Production->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Verified_Production->id, 'module_role_id' => $modulepegawai->id, 'action' => "not solved (re-acknowledge)", 'next_status' => $Re_Acknowledge->id, 'active' => 1]);
            ModuleFlowManagement::firstOrCreate(['module_id' => $module->id, 'current_status' => $Verified_Production->id, 'module_role_id' => $modulevendor->id, 'action' => "resolved", 'next_status' => $Resolved->id, 'active' => 1]);

        }
        catch (\Throwable $th) {
            \DB::rollback();
            echo 'Failed! ' . $th->getMessage().PHP_EOL;
            Log::debug('Failed! ' . $th->getMessage());
            Log::alert('END  FMF Seed');
            return -1;
        }

        \DB::commit();
        echo 'End Helpdesk FMF Seed'.PHP_EOL;
        return 0;
    }
}
