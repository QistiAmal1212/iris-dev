<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $permissions = Permission::get();
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $roles = Role::paginate(20);

        $internalRoles = Role::where('is_internal', 1)->get();
        $countInternalRoles = count($internalRoles);

        $externalRoles = Role::where('is_internal', 0)->get();
        $countExternalRoles = count($externalRoles);

        return view('admin.role.index', compact('roles', 'permissions', 'internalRoles', 'externalRoles', 'countInternalRoles', 'countExternalRoles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validator::make($request->all(), [
        //     'name' => 'required|string|unique:role',
        //     'description' => 'required|string',
        //     'display_name' => 'required|string',
        // ]);

        // $role = Role::create(['name' => $request->name, 'description' => $request->description, 'display_name' => $request->role_display, 'guard_name' => 'web']);

        // if ($request->permissions) {
        //     foreach ($request->permissions as $permission) {
        //         $role->givePermissionTo($permission);
        //     }
        // }

        Validator::make($request->all(), [
            'name' => 'required|string|unique:role',
            'description' => 'required|string',
            'display_name' => 'required|string',
        ]);

        $role = Role::create(['name' => $request->role_name, 'description' => $request->role_description, 'display_name' => $request->role_display, 'guard_name' => 'web']);

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
            ]);

            if ($id_used) {
                $role = Role::find($id_used);
            } else {
                $role = new Role;
            }

            $role->name = $request->role_name;
            $role->description = $request->role_description;
            $role->display_name = $request->role_display;
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
