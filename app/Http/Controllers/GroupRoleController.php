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

                    // //view role
                    // $button .= '<a class="btn btn-xs btn-default" onclick="viewOnlyForm('.$roles->id.')"> <i class="fas fa-eye text-seconday"></i> ';

                    //edit role
                    $button .= '<a class="btn btn-xs btn-default" onclick="viewUsersForm('.$roles->id.')"> <i class="fas fa-pencil text-primary"></i> ';

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

        return view('admin.group_role.index');
    }

    public function edit(Request $request)
    {
        $users = Role::find($request->roleId)->users;
        if ($request->ajax()) {
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

            if (!$role) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            if($role->is_internal){
                $role->internalType = 'Peranan Dalaman';
            } else {
                $role->internalType = 'Peranan Luaran';
            }

            $role->totalCount = count($role->users);
            
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $role]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
