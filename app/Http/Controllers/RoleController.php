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
                        //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                        // $button .= '<a class="btn btn-xs btn-default" onclick="viewRoleForm('.$roles->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        $button .= '<a class="btn btn-xs btn-default" onclick="#"> <i class="fas fa-eye text-iris-one"></i> ';
                        $button .= '<a class="btn btn-xs btn-default" onclick="viewForm('.$roles->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        $button .= '<a href="#" class="btn btn-xs btn-default"> <i class="fas fa-trash text-danger"></i> </a>';
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

            DB::commit();
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return redirect()->route('role.index');
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

        $securityMenu = SecurityMenu::whereIn('id', $menuId)->where('level', $level)->orderBy('sequence', 'asc')->get();

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

        $parentMenu = SecurityMenu::whereIn('id', $menuId)->get();

        foreach($parentMenu as $parent){
            $menuData[$parent->id]['name'] = $parent->name;
            $menuData[$parent->id]['id'] = $parent->id;
            $menuData[$parent->id]['sub_menu'] = [];
        }

        $securityMenu = SecurityMenu::whereIn('menu_link', $menuId)->where('level', $level)->orderBy('sequence', 'asc')->get();

        foreach($securityMenu as $menu) {
            if($menu->menu_link != null){
                $menuData[$menu->menu_link]['sub_menu'][] = $menu;
            }
        }

        return view('admin.role.menu_details', compact('menuData'));
    }

    public function editRole(Request $request)
    {
        DB::beginTransaction();
        try {

            $role = Role::find($request->roleId);
            $role->listFunction = $role->function->pluck('id')->toArray();
            $role->levelOne = $role->menu->where('level', 1)->pluck('id')->toArray();
            $role->levelTwo = $role->menu->where('level', 2)->pluck('id')->toArray();
            $role->levelThree = $role->menu->where('level', 3)->pluck('id')->toArray();

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

            $role = Role::find($request->roleId);

            $role->name = $request->role_name;
            $role->description = $request->role_description;
            $role->display_name = $request->role_display;
            $role->is_internal = $request->role_level;
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

            $role->save();
            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return redirect()->route('role.index');
    }
}
