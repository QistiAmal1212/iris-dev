<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\DepartmentMinistry;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class DepartmentMinistryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.department-ministry')->first();
        $this->menu = $this->module->menu;
    }

    public function index(Request $request)
    {
        $roles = auth()->user()->roles;
        $roles = $roles->pluck('id')->toArray();

        $accessRole = $this->menu->role()->whereIn('id', $roles)->get();

        $accessAdd = $accessUpdate = $accessDelete = false;

        foreach($accessRole as $access) {
            if($access->pivot->add){
                $accessAdd = true;
            }

            if($access->pivot->update){
                $accessUpdate = true;
            }

            if($access->pivot->delete){
                $accessDelete = true;
            }
        }

        $departmentMinistry = DepartmentMinistry::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.department-ministry')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Kementerian";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($departmentMinistry)
                ->editColumn('kod', function ($departmentMinistry){
                    return $departmentMinistry->kod;
                })
                ->editColumn('nama', function ($departmentMinistry) {
                    return $departmentMinistry->diskripsi;
                })
                ->editColumn('action', function ($departmentMinistry) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="departmentMinistryForm('.$departmentMinistry->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessUpdate){
                        if($departmentMinistry->sah_yt=="Y") {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$departmentMinistry->id.'" onclick="toggleActive('.$departmentMinistry->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$departmentMinistry->id.'" onclick="toggleActive('.$departmentMinistry->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$departmentMinistry->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.department_ministry', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_kem_jabatan,kod',
                'name' => 'required|string',
                'alamat_1' => 'required|string',
                'poskod' => 'required|string',
                'bandar' => 'required|string',
                'gelaran_ketua' => 'required|string',
                'kem_kod' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama kementerian',
                'alamat_1.required' => 'Sila isikan alamat',
                'poskod.required' => 'Sila isikan poskod',
                'bandar.required' => 'Sila isikan bandar',
                'gelaran_ketua.required' => 'Sila isikan gelaran ketua',
                'kem_kod.required' => 'Sila isikan kod kementerian',
            ]);

            $departmentMinistry = DepartmentMinistry::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'alamat_1' => strtoupper($request->alamat_1),
                'alamat_2' => strtoupper($request->alamat_2),
                'alamat_3' => strtoupper($request->alamat_3),
                'poskod' => strtoupper($request->poskod),
                'bandar' => strtoupper($request->bandar),
                'gelaran_ketua' => strtoupper($request->gelaran_ketua),
                'kem_kod' => strtoupper($request->kem_kod),
                'unit_urusan' => strtoupper($request->unit_urusan),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.department-ministry')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Kementerian";
            $log->data_new = json_encode($departmentMinistry);
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

    }

    public function edit(Request $request)
    {
        DB::beginTransaction();
        try {

            $departmentMinistry = DepartmentMinistry::find($request->departmentMinistryId);

            if (!$departmentMinistry) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.department-ministry')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Kementerian";
            $log->data_new = json_encode($departmentMinistry);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $departmentMinistry]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $departmentMinistryId = $request->departmentMinistryId;
            $departmentMinistry = DepartmentMinistry::find($departmentMinistryId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.department-ministry')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Kementerian";
            $log->data_old = json_encode($departmentMinistry);

            $request->validate([
                'code' => 'required|string|unique:ruj_kem_jabatan,kod,'.$departmentMinistryId,
                'name' => 'required|string',
                'alamat_1' => 'required|string',
                'poskod' => 'required|string',
                'bandar' => 'required|string',
                'gelaran_ketua' => 'required|string',
                'kem_kod' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama kementerian',
                'alamat_1.required' => 'Sila isikan alamat',
                'poskod.required' => 'Sila isikan poskod',
                'bandar.required' => 'Sila isikan bandar',
                'gelaran_ketua.required' => 'Sila isikan gelaran ketua',
                'kem_kod.required' => 'Sila isikan kod kementerian',
            ]);

            $departmentMinistry->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'alamat_1' => strtoupper($request->alamat_1),
                'alamat_2' => strtoupper($request->alamat_2),
                'alamat_3' => strtoupper($request->alamat_3),
                'poskod' => strtoupper($request->poskod),
                'bandar' => strtoupper($request->bandar),
                'gelaran_ketua' => strtoupper($request->gelaran_ketua),
                'kem_kod' => strtoupper($request->kem_kod),
                'unit_urusan' => strtoupper($request->unit_urusan),
                'updated_by' => auth()->user()->id,
            ]);

            $departmentMinistryNewData = DepartmentMinistry::find($departmentMinistryId);
            $log->data_new = json_encode($departmentMinistryNewData);
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
    }

    public function toggleActive(Request $request)
    {
        DB::beginTransaction();
        try {

            $departmentMinistryId = $request->departmentMinistryId;
            $departmentMinistry = DepartmentMinistry::find($departmentMinistryId);

            $sah_yt = $departmentMinistry->sah_yt;

            if($sah_yt == 'Y'){
                $sah_yt = 'T';
            }else{
                $sah_yt = 'Y';
            }

            $departmentMinistry->update([
                'sah_yt' => $sah_yt,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function deleteItem(Request $request){
        DB::beginTransaction();
        try{
            $departmentMinistry = DepartmentMinistry::find($request-> departmentMinistryId);

            $departmentMinistry->delete();

            if (!$departmentMinistry) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            DB::commit();
            return response()->json(['message' => 'Rekod berjaya dihapuskan'], 200);

        }catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
