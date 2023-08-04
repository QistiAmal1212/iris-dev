<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if (request()->route()->getname() == 'admin.internalUser') {
                $users = User::whereHas('roles', function ($query) {
                    $query->where('is_internal', 1);
                });
                $type = 'internal';
            } else {
                $users = User::whereHas('roles', function ($query) {
                    $query->where('is_internal', 0);
                });
                $type = 'external';
            }
            return Datatables::of($users)
                ->editColumn('name', function ($users) use ($type) {

                    if ($type == "internal") {

                        $label = "";
                        $label .= '<form hidden action="' . route("emptyResponse") . '" method="get" data-refreshFunctionDivId="showUser" data-refreshFunctionURL="' . route('user.show', $users) . '">@csrf';
                        $label .= '<button type="button" id="btnView' . $users->name . '" hidden onclick="generalFormSubmit(this)"></button></form>';
                        $label .= '<a class="btn btn-xs btn-default" onclick="$(`#btnView' . $users->name . '`).trigger(`click`)">' . $users->name . '</a>';

                        // $label = '<a href=" '.route('user.show', $users).' ">'.$users->name.' </a>';
                        $label .= $users->is_active == 1 ? '<img src="' . asset('images/icons/verify.png') . '" style="width: 15px;"> &nbsp;' : '<img src="' . asset('images/icons/alert.png') . '" style="width: 15px;"> &nbsp;';
                        $roles = implode(",", $users->getRoleNames()->toArray());
                        $label .= '</br>';
                        $label .= '<td>';
                        if (strpos($roles, "admin") !== false && strpos($roles, "superadmin") !== false) {
                            $label .= '<span class="badge rounded-pill bg-light-info">Superadmin</span> &nbsp; <span class="badge rounded-pill bg-light-secondary">Admin</span>';
                        } elseif ($roles == "admin") {
                            $label .= '<span class="badge rounded-pill bg-light-secondary">Admin</span>';
                        } elseif ($roles == "superadmin") {
                            $label .= '<span class="badge rounded-pill bg-light-info">Superadmin</span>';
                        } else {
                            $label .= '<span class="badge rounded-pill bg-light-info">' . $roles . '</span> &nbsp;';
                        }
                        $label .= "</td>";
                        return $label;
                    } else {
                        $label = '<a href=" ' . route('user.show', $users) . ' ">' . $users->name . ' </a>';
                        $label .= $users->is_active == 1 ? '<img src="' . asset('images/icons/verify.png') . '" style="width: 15px;"> &nbsp;' : '<img src="' . asset('images/icons/alert.png') . '" style="width: 15px;"> &nbsp;';
                        $label .= '</br>';
                        $label .= '<td>';
                        $label .= $users->no_ic;
                        $label .= '</td>';
                        return $label;
                    }
                })
                ->editColumn('email', function ($users) use ($type) {

                    if ($type == "internal") {
                        return $users->email;
                    } else {
                        return $users->email;
                    }
                })
                ->editColumn('action', function ($users) use ($type) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    if ($type == "internal") {
                        $button .= '<a href=" ' . route('user.show', $users) . ' " class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="viewUserForm(' . $users->id . ')"> <i class="fas fa-pencil text-primary"></i> ';
                        // $button .= '<form id="formDestroyUser_'.$user->id.'" method="POST" action=" '.route('user.destroy', $user).' "> @csrf <input type="hidden" name="_method" value="DELETE"/> </form>';
                        // $button .= '<a href="#" class="btn btn-outline-dark waves-effect" onclick="event.preventDefault(); document.getElementById('formDestroyUser_. $user->id .').submit();"> <i class="fas fa-trash"></i> </a>';
                    } else {
                        $button .= '<a href=" ' . route('user.show', $users) . ' " class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="viewUserForm(' . $users->id . ')"> <i class="fas fa-pencil text-primary"></i> ';
                    }
                    $button .= "</div>";

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if (request()->route()->getname() == 'admin.internalUser') {
            $users = User::whereHas('roles', function ($query) {
                $query->where('is_internal', 1);
            });
            $type = 'internal';
        } else {
            $users = User::whereHas('roles', function ($query) {
                $query->where('is_internal', 0);
            });
            $type = 'external';
        }

        $totalUser = clone $users;
        $totalUser = $totalUser->count();

        $inactiveUser = clone $users;
        $inactiveUser = $inactiveUser->where('is_active', 0)->count();

        $activeUser = $totalUser - $inactiveUser;

        $role = Role::get();

        return view('admin.user.index', compact('type', 'role', 'totalUser', 'inactiveUser', 'activeUser'));
    }

    // public function index(Request $request)
    // {
    //     if(request()->route()->getname()=='admin.internalUser'){
    //         $users = User::whereHas('roles',function($query){
    //             $query->where('is_internal',1);
    //         });
    //         $type = 'internal';
    //     }
    //     else{
    //         $users = User::whereHas('roles',function($query){
    //             $query->where('is_internal',0);
    //         });
    //         $type = 'external';
    //     }

    //     $totalUser = clone $users;
    //     $totalUser = $totalUser->count();

    //     $inactiveUser = clone $users;
    //     $inactiveUser = $inactiveUser->where('is_active',0)->count();

    //     $activeUser = $totalUser - $inactiveUser;

    //     $users = $users->paginate(15);
    //     $role = Role::get();

    //     return view('admin.user.index', compact('users','type','role','totalUser','inactiveUser','activeUser'));
    // }

    public function create(Request $request)
    {
        $type = $request->type;
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.user.create', compact('roles', 'permissions', 'type'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string',
                'ic_number' => 'required|integer',
                'email' => 'required|email',
                'password' => 'required|string',
                'retype_password' => 'required|string',
                // 'role' => 'required',
            ]);

            $user = new User;
            $user->name = $request->full_name;
            $user->no_ic = $request->ic_number;
            $user->email = $request->email;
            $user->is_active = $request->has("status") ?? 0;
            $user->password = Hash::make($request->password);

            $user->save();

            $user->syncRoles($request->roles ? $request->roles : []);
            // $user->syncPermissions($request->permissions ? $request->permissions : []);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $internalRoleArr = Role::where('is_internal', 1)->pluck('name')->toArray();
        if ($user->role($internalRoleArr)) {
            $type = "internal";
        } else {
            $type = "external";
        }
        return view('admin.user.show', compact('user', 'roles', 'permissions', 'type'));
    }

    public function edit(User $user, $userId)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        $internalRoleArr = Role::where('is_internal', 1)->pluck('name')->toArray();
        if ($user->role($internalRoleArr)) {
            $type = "internal";
        } else {
            $type = "external";
        }
        // return view('admin.user.edit', compact('user', 'roles', 'permissions','type'));
        return view('admin.user.index', compact('user', 'roles', 'permissions', 'type'));
    }

    public function update(Request $request, $id_used)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'full_name' => 'required|string',
                'ic_number' => 'required|integer',
                'email' => 'required|email',
            ]);

            if ($id_used) {
                $user = user::find($id_used);
            } else {
                $user = new user;
            }

            $user->name = $request->full_name;
            $user->no_ic = $request->ic_number;
            $user->email = $request->email;
            $user->is_active = $request->has("status") ?? 0;

            $user->syncRoles($request->roles ? $request->roles : []);
            $user->save();

            DB::commit();

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        return to_route('user.index', [$user]);
    }

    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }

    public function getUser(Request $request, User $userId)
    {

        $userId->listOfRole = $userId->roles->pluck('id')->toArray();

        DB::beginTransaction();
        try {

            if (!$userId) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Module Role not found. Please refresh"], 404);
            }

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        DB::commit();
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $userId]);
    }
}
