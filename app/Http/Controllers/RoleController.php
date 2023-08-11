<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

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
                            $label .= '<span class="badge rounded-pill bg-light-info">Internal</span>';
                            return $label;
                        }else{
                            $label = "";
                            $label .= '<span class="badge rounded-pill bg-light-warning">External</span>';
                            return $label;
                        }
                    })
                    ->editColumn('action', function ($roles) {
                        $button = "";

                        $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                        //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="viewRoleForm('.$roles->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        $button .= '<a href="#" class="btn btn-xs btn-default"> <i class="fas fa-trash text-danger"></i> </a>';
                        $button .= '</div>';

                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

        return view('admin.role.index', compact('roles', 'permissions', 'internalRoles', 'externalRoles', 'countInternalRoles', 'countExternalRoles'));
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
            $validatedData = $request->validate([
                'role_name' => 'required|string',
                'role_description' => 'required|string',
                'role_display' => 'required|string',
                'role_level' => 'required|boolean'
            ]);

            $role = Role::create([
                'name' => $request->role_name, 
                'description' => $request->role_description, 
                'display_name' => $request->role_display, 
                'is_internal' => $request->role_level,
                'guard_name' => 'web'
            ]);

            if ($request->permissions) {
                foreach ($request->permissions as $permission) {
                    $role->givePermissionTo($permission);
                }
            }

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        // Validator::make($request->all(), [
        //     'name' => 'required|string|unique:role',
        //     'description' => 'required|string',
        //     'display_name' => 'required|string',
        // ]);

        // $role = Role::create([
        //     'name' => $request->role_name, 
        //     'description' => $request->role_description, 
        //     'display_name' => $request->role_display, 
        //     'guard_name' => 'web'
        // ]);

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

        return to_route('role.index', [$role]);
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
}
