<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Matriculation;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class MatriculationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.matriculation')->first();
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

        $matriculation = Matriculation::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Matrikulasi";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($matriculation)
                ->editColumn('code', function ($matriculation){
                    return $matriculation->kod;
                })
                ->editColumn('name', function ($matriculation) {
                    return $matriculation->diskripsi;
                })
                ->editColumn('action', function ($matriculation) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';

                    if($accessUpdate){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="matriculationForm('.$matriculation->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        if($matriculation->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$matriculation->id.'" onclick="toggleActive('.$matriculation->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$matriculation->id.'" onclick="toggleActive('.$matriculation->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }else{
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="matriculationForm('.$matriculation->id.')"> <i class="fas fa-eye text-primary"></i> ';
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$matriculation->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.matriculation', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|max:13|unique:ruj_matrikulasi,kod',
                'name' => 'required|string|max:100',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama matrikulasi',
                'code.max' => 'Maksimum panjang kod adalah :max karakter',
                'name.max' => 'Maksimum panjang matrikulasi adalah :max karakter',
            ]);

            $matric = Matriculation::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Matrikulasi";
            $log->data_new = json_encode($matric);
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

            $matriculation = Matriculation::find($request->matriculationId);

            if (!$matriculation) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Matrikulasi";
            $log->data_new = json_encode($matriculation);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $matriculation]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $matriculationId = $request->matriculationId;
            $matriculation = Matriculation::find($matriculationId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Matrikulasi";
            $log->data_old = json_encode($matriculation);

            $request->validate([
                'code' => 'required|string|max:13|unique:ruj_matrikulasi,kod,'.$matriculationId,
                'name' => 'required|string|max:100',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama matrikulasi',
                'code.max' => 'Maksimum panjang kod adalah :max karakter',
                'name.max' => 'Maksimum panjang matrikulasi adalah :max karakter',
            ]);

            $matriculation->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'pengguna' => auth()->user()->id,
            ]);

            $matriculationNewData = Matriculation::find($matriculationId);
            $log->data_new = json_encode($matriculationNewData);
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

            $matriculationId = $request->matriculationId;
            $matriculation = Matriculation::find($matriculationId);

            $sah_yt = $matriculation->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $matriculation->update([
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
            $matriculation = Matriculation::find($request-> matriculationId);

            $matriculation->delete();

            if (!$matriculation) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.matriculation')->firstOrFail()->id;
            $log->activity_type_id = 5;
            $log->description = "Hapus Matrikulasi";
            $log->data_new = json_encode($matriculation);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();
            return response()->json(['message' => 'Rekod berjaya dihapuskan'], 200);

        }catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
