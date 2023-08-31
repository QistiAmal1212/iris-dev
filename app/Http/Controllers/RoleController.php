<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
//use Spatie\Permission\Models\Role;
use App\Models\Role;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterFunction;
use App\Models\SecurityMenu;
use App\Models\LogSystem;
use App\Models\Master\MasterModule;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $internalRoles = Role::where('is_internal', 1)->get();
        $countInternalRoles = count($internalRoles);

        $externalRoles = Role::where('is_internal', 0)->get();
        $countExternalRoles = count($externalRoles);

        $permissions = Permission::get();
        $masterFunction = MasterFunction::all();
        $securityMenu = SecurityMenu::where('level', '1')->get();
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        // $roles = Role::paginate(20);
        $roles = Role::all();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'role.index')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Peranan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($roles)
                    ->editColumn('id', function ($roles) {
                        return $roles->id;
                    })
                    ->editColumn('name', function ($roles) {
                        return $roles->name;
                    })
                    ->editColumn('display_name', function ($roles) {
                        return $roles->display_name;
                    })
                    ->editColumn('description', function ($roles) {
                        return $roles->description;
                    })
                    ->editColumn('is_internal', function ($roles) {

                        if ($roles->is_internal == 1){
                            $label = "";
                            $label .= '<span class="badge rounded-pill bg-light-info">Peranan Dalaman</span>';
                            return $label;
                        }else{
                            $label = "";
                            $label .= '<span class="badge rounded-pill bg-light-warning">Peranan Luaran</span>';
                            return $label;
                        }
                    })
                    ->editColumn('action', function ($roles) {
                        $button = "";

                        $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';

                        //view role
                        $button .= '<a class="btn btn-xs btn-default" onclick="viewOnlyForm('.$roles->id.')"> <i class="fas fa-eye text-seconday"></i> ';

                        //edit role
                        $button .= '<a class="btn btn-xs btn-default" onclick="viewForm('.$roles->id.')"> <i class="fas fa-pencil text-primary"></i> ';

                        //delete role
                        // $button .= '<a class="btn btn-xs btn-default" title="" onclick="$(`#rolesDeleteButton_'.$roles->id.'`).trigger(`click`);" > <i class="fas fa-trash text-danger"></i> </a>';
                        // $button .= "</div>";
                        // $button .= '<form action="'.route('roles.delete',['roleId' => $roles->id]).'" method="post" refreshFunctionDivId="RoleList">';
                        // $button .= '<button id="rolesDeleteButton_'.$roles->id.'" type="button" hidden onclick="confirmBeforeSubmit(this)"></button>';
                        // $button .= '</form>';
                        $button .= '</div>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

        return view('admin.role.index', compact('roles', 'permissions', 'internalRoles', 'externalRoles', 'countInternalRoles', 'countExternalRoles', 'masterFunction', 'securityMenu'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // $validatedData = $request->validate([
            //     'role_name' => 'required|string',
            //     'role_description' => 'required|string',
            //     'role_display' => 'required|string',
            //     'role_level' => 'required|boolean'
            // ]);

            $role = Role::create([
                'name' => $request->role_name,
                'description' => $request->role_description,
                'display_name' => $request->role_display,
                'is_internal' => $request->role_level,
                'guard_name' => 'web'
            ]);

            $role->function()->sync($request->access_function);

            $levelOne = isset($request->level_one) ? $request->level_one : [];
            $levelTwo = isset($request->level_two) ? $request->level_two : [];
            $levelThree = isset($request->level_three) ? $request->level_three : [];

            $accessMenu = array_merge($levelOne, $levelTwo, $levelThree);

            $roleMenu = [];

            $access = isset($request->access) ? $request->access : [];
            $search = isset($request->search) ? $request->search : [];
            $add = isset($request->add) ? $request->add : [];
            $update = isset($request->update) ? $request->update : [];
            $delete = isset($request->delete) ? $request->delete : [];
            $report = isset($request->report) ? $request->report : [];

            foreach($accessMenu as $menu)
            {
                $roleMenu[$menu]['access'] = in_array($menu, $access) ? true : false;
                $roleMenu[$menu]['search'] = in_array($menu, $search) ? true : false;
                $roleMenu[$menu]['add'] = in_array($menu, $add) ? true : false;
                $roleMenu[$menu]['update'] = in_array($menu, $update) ? true : false;
                $roleMenu[$menu]['delete'] = in_array($menu, $delete) ? true : false;
                $roleMenu[$menu]['report'] = in_array($menu, $report) ? true : false;
            }

            $role->menu()->sync($roleMenu);

            //For Audit Trail
            $roleNewData = Role::with(['function', 'menu'])->find($role->id);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'role.index')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Peranan [" . $roleNewData->name . "]";
            $log->data_new = json_encode($roleNewData);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
            
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return redirect()->route('role.index');
    }

    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.show', compact('role', 'permissions'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id_used)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'role_name' => 'required|string',
                'role_description' => 'required|string',
                'role_display' => 'required|string',
                'role_level' => 'required|boolean'
            ]);

            if ($id_used) {
                $role = Role::find($id_used);
            } else {
                $role = new Role;
            }

            $role->name = $request->role_name;
            $role->description = $request->role_description;
            $role->display_name = $request->role_display;
            $role->is_internal = $request->role_level;
            // $role->update($request->only('role_name', 'role_description','role_display'));
            $role->syncPermissions($request->permissions ? $request->permissions : []);
            $role->save();
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return redirect()->route('role.index');
        //return to_route('role.index', [$role]);
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        return redirect()->route('role.index');
    }

    public function getRole(Request $request, Role $roleId)
    {

        DB::beginTransaction();
        try {

            $role = $roleId;
            $role->listOfPermission = $role->permissions->pluck('id')->toArray();

            if (!$role) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Role not found. Please refresh"], 404);
            }

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $role]);
    }

    public function getMenu(Request $request)
    {
        if($request->level == 'one') {
            $level = 1;
        } else if($request->level == 'two'){
            $level = 2;
        } else if($request->level == 'three'){
            $level = 3;
        }

        $menuId = isset($request->menu_id) ? $request->menu_id : [];
        $role_id = $request->role_id;

        $securityMenu = SecurityMenu::whereIn('id', $menuId)->where('level', $level)->orderBy('sequence', 'asc')->get();


        foreach($securityMenu as $menu){
            if(isset($role_id)){
                $roleExist = $menu->role->where('id', $role_id)->first();
                if($roleExist){
                    unset($menu->role);
                    $menu->role = $roleExist;
                } else {
                    unset($menu->role);
                    $menu->role = null;
                }
            } else {
                unset($menu->role);
                $menu->role = null;
            }
        }

        return view('admin.role.listMenu', compact('securityMenu'));
    }

    public function getNextMenu(Request $request)
    {
        if($request->level == 'one') {
            $level = 1;
        } else if($request->level == 'two'){
            $level = 2;
        } else if($request->level == 'three'){
            $level = 3;
        }

        $menuId = isset($request->menu_id) ? $request->menu_id : [];

        $menuData = [];

        $role_id = $request->role_id;

        $parentMenu = SecurityMenu::whereIn('id', $menuId)->get();

        foreach($parentMenu as $parent){
            $menuData[$parent->id]['name'] = $parent->name;
            $menuData[$parent->id]['id'] = $parent->id;
            $menuData[$parent->id]['sub_menu'] = [];
        }

        $securityMenu = SecurityMenu::whereIn('menu_link', $menuId)->where('level', $level)->orderBy('sequence', 'asc')->get();

        foreach($securityMenu as $menu) {
            if($menu->menu_link != null){
                if(isset($role_id)){
                    $roleExist = $menu->role->where('id', $role_id)->first();
                    if($roleExist){
                        unset($menu->role);
                        $menu->role = $roleExist;
                    } else {
                        unset($menu->role);
                        $menu->role = null;
                    }
                } else {
                    unset($menu->role);
                    $menu->role = null;
                }
                $menuData[$menu->menu_link]['sub_menu'][] = $menu;
            }
        }

        return view('admin.role.menu_details', compact('menuData'));
    }

    public function editRole(Request $request)
    {
        DB::beginTransaction();
        try {

            $role = Role::with(['function', 'menu'])->find($request->roleId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'role.index')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Peranan [".$role->name."]";
            $log->data_old = $role;
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $role->listFunction = $role->function->pluck('id')->toArray();
            $role->levelOne = $role->menu->where('level', 1)->pluck('id')->toArray();
            $role->levelTwo = $role->menu->where('level', 2)->pluck('id')->toArray();
            $role->levelThree = $role->menu->where('level', 3)->pluck('id')->toArray();

            $levelOne = $levelTwo = [];

            $menuLevelOne = SecurityMenu::whereIn('id', $role->levelOne)->get();

            foreach($menuLevelOne as $menu){
                $levelOne[$menu->id]['name'] = $menu->name;
                $levelOne[$menu->id]['id'] = $menu->id;
                $levelOne[$menu->id]['sub_menu'] = [];
            }

            $menuLevelTwo = SecurityMenu::whereIn('id', $role->levelTwo)->get();

            foreach($menuLevelTwo as $menu){
                $levelTwo[$menu->id]['name'] = $menu->name;
                $levelTwo[$menu->id]['id'] = $menu->id;
                $levelTwo[$menu->id]['sub_menu'] = [];
            }

            $subMenuOne = SecurityMenu::whereIn('menu_link', $role->levelOne)->where('level', 2)->orderBy('sequence', 'asc')->get();
            $subMenuTwo = SecurityMenu::whereIn('menu_link', $role->levelTwo)->where('level', 3)->orderBy('sequence', 'asc')->get();

            foreach($subMenuOne as $menu) {
                if($menu->menu_link != null){
                    $levelOne[$menu->menu_link]['sub_menu'][] = $menu;
                }
            }

            foreach($subMenuTwo as $menu) {
                if($menu->menu_link != null){
                    $levelTwo[$menu->menu_link]['sub_menu'][] = $menu;
                }
            }

            $optionLevel2 = '';
            foreach($levelOne as $menu){
            $optionLevel2 .= '<optgroup label="'.$menu['name'].'">';
                foreach($menu['sub_menu'] as $subMenu){
            $optionLevel2 .= '<option value="'.$subMenu->id.'">'.$subMenu->name.'</option>';
                }
            $optionLevel2 .= '</optgroup>';
            }

            $optionLevel3 = '';
            foreach($levelTwo as $menu){
            $optionLevel3 .= '<optgroup label="'.$menu['name'].'">';
                foreach($menu['sub_menu'] as $subMenu){
            $optionLevel3 .= '<option value="'.$subMenu->id.'">'.$subMenu->name.'</option>';
                }
            $optionLevel3 .= '</optgroup>';
            }

            $role->optionLevel2 = $optionLevel2;
            $role->optionLevel3 = $optionLevel3;

            if (!$role) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Role not found. Please refresh"], 404);
            }

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $role]);
    }

    public function updateRole(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'role_name' => 'required|string',
                'role_description' => 'required|string',
                'role_display' => 'required|string',
                'role_level' => 'required|boolean'
            ]);

            $role = Role::with(['function', 'menu'])->find($request->roleId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'role.index')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Peranan [".$role->name."]";
            $log->data_old = json_encode($role);

            $role->update([
                'name' => $request->role_name,
                'description' => $request->role_description,
                'display_name' => $request->role_display,
                'is_internal' => $request->role_level,
            ]);

            $role->function()->sync($request->access_function);

            $levelOne = isset($request->level_one) ? $request->level_one : [];
            $levelTwo = isset($request->level_two) ? $request->level_two : [];
            $levelThree = isset($request->level_three) ? $request->level_three : [];

            $accessMenu = array_merge($levelOne, $levelTwo, $levelThree);

            $roleMenu = [];

            $access = isset($request->access) ? $request->access : [];
            $search = isset($request->search) ? $request->search : [];
            $add = isset($request->add) ? $request->add : [];
            $update = isset($request->update) ? $request->update : [];
            $delete = isset($request->delete) ? $request->delete : [];
            $report = isset($request->report) ? $request->report : [];

            foreach($accessMenu as $menu)
            {
                $roleMenu[$menu]['access'] = in_array($menu, $access) ? true : false;
                $roleMenu[$menu]['search'] = in_array($menu, $search) ? true : false;
                $roleMenu[$menu]['add'] = in_array($menu, $add) ? true : false;
                $roleMenu[$menu]['update'] = in_array($menu, $update) ? true : false;
                $roleMenu[$menu]['delete'] = in_array($menu, $delete) ? true : false;
                $roleMenu[$menu]['report'] = in_array($menu, $report) ? true : false;
            }

            $role->menu()->sync($roleMenu);

            //For Audit Trail
            $roleNewData = Role::with(['function', 'menu'])->find($role->id);

            $log->data_new = json_encode($roleNewData);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return redirect()->route('role.index');
    }
}
