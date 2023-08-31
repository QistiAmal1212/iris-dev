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
use App\Models\LogSystem;
use App\Models\Master\MasterModule;

class GroupRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $roles = Role::all();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.group-role')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Kumpulan Pengguna";
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

                    $name = '';
                    $name .= '<a class="text-primary" onclick="viewUsersForm('.$roles->id.')">';
                    $name .= $roles->name;
                    $name .= '</a>';

                    return $name;
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
                ->make(true);
        }

        return view('admin.group_role.index');
    }

    public function edit(Request $request)
    {
        $role = Role::find($request->roleId);
        $users = $role->users;
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.group-role')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Pengguna [".$role->name."]";
            $log->data_old = $users;
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($users)
                ->editColumn('name', function ($users) {
                    return $users->name;
                })
                ->editColumn('no_ic', function ($users) {
                    return $users->no_ic;
                })
                ->editColumn('email', function ($users) {
                    return $users->email;
                })
                ->editColumn('phone_number', function ($users) {
                    return $users->phone_number;
                })
                ->editColumn('department_ministry', function ($users) {
                    return ($users->ref_department_ministry_code != null) ? $users->department_ministry->name : null;
                })
                ->editColumn('skim', function ($users) {
                    return ($users->ref_skim_code != null) ? $users->skim->name : null;
                })
                ->editColumn('status', function ($users) {
                    if ($users->is_active == 1){
                        $label = "";
                        $label .= '<span class="badge rounded-pill bg-light-success">Aktif</span>';
                        return $label;
                    }else{
                        $label = "";
                        $label .= '<span class="badge rounded-pill bg-light-danger">Tidak Aktif</span>';
                        return $label;
                    }
                })
                ->make(true);
        }
    }

    public function getRole(Request $request)
    {
        DB::beginTransaction();
        try {

            $role = Role::find($request->roleId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.group-role')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Kumpulan Pengguna [".$role->name."]";
            $log->data_old = $role;
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            if (!$role) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            if($role->is_internal){
                $role->internalType = 'Peranan Dalaman';
            } else {
                $role->internalType = 'Peranan Luaran';
            }

            $role->totalCount = count($role->users);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $role]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
