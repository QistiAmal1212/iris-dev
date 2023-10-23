<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KlasifikasiPerkhidmatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class KlasifikasiPerkhidmatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.klasifikasiperkhidmatan')->first();
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

        $klasifikasiperkhidmatan = KlasifikasiPerkhidmatan::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.klasifikasiperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Klasifikasi Perkhidmatan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($klasifikasiperkhidmatan)
                ->editColumn('kod', function ($klasifikasiperkhidmatan){
                    return $klasifikasiperkhidmatan->kod;
                })
                ->editColumn('nama', function ($klasifikasiperkhidmatan) {
                    return $klasifikasiperkhidmatan->diskripsi;
                })
                ->editColumn('action', function ($klasifikasiperkhidmatan) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="klasifikasiperkhidmatanForm('.$klasifikasiperkhidmatan->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessUpdate){
                        if($klasifikasiperkhidmatan->sah_yt=="Y") {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$klasifikasiperkhidmatan->id.'" onclick="toggleActive('.$klasifikasiperkhidmatan->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$klasifikasiperkhidmatan->id.'" onclick="toggleActive('.$klasifikasiperkhidmatan->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$klasifikasiperkhidmatan->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.klasifikasi_perkhidmatan', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_klasifikasi_perkhidmatan,kod',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan klasifikasi perkhidmatan',
            ]);

            $klasifikasiperkhidmatan = KlasifikasiPerkhidmatan::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'sah_yt'=> "Y",
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.klasifikasiperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Klasifikasi Perkhidmatan";
            $log->data_new = json_encode($klasifikasiperkhidmatan);
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

            $klasifikasiperkhidmatan = KlasifikasiPerkhidmatan::find($request->klasifikasiperkhidmatanId);

            if (!$klasifikasiperkhidmatan) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.klasifikasiperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Klasifikasi Perkhidmatan";
            $log->data_new = json_encode($klasifikasiperkhidmatan);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $klasifikasiperkhidmatan]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $klasifikasiperkhidmatanId = $request->klasifikasiperkhidmatanId;
            $klasifikasiperkhidmatan = KlasifikasiPerkhidmatan::find($klasifikasiperkhidmatanId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.klasifikasiperkhidmatan')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Klasifikasi Perkhidmatan";
            $log->data_old = json_encode($klasifikasiperkhidmatan);

            $request->validate([
                'code' => 'required|string|unique:ruj_klasifikasi_perkhidmatan,kod,'.$klasifikasiperkhidmatanId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan klasifikasi perkhidmatan',
            ]);

            $klasifikasiperkhidmatan->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'pengguna' => auth()->user()->id,
            ]);

            $klasifikasiperkhidmatanNewData = KlasifikasiPerkhidmatan::find($klasifikasiperkhidmatanId);
            $log->data_new = json_encode($klasifikasiperkhidmatanNewData);
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

            $klasifikasiperkhidmatanId = $request->klasifikasiperkhidmatanId;
            $klasifikasiperkhidmatan = KlasifikasiPerkhidmatan::find($klasifikasiperkhidmatanId);

            $sah_yt = $klasifikasiperkhidmatan->sah_yt;

            if($sah_yt == "Y"){
                $sah_yt = "T";
            }else{
                $sah_yt = "Y";
            }

            $klasifikasiperkhidmatan->update([
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
            $klasifikasiperkhidmatan = KlasifikasiPerkhidmatan::find($request-> klasifikasiperkhidmatanId);

            $klasifikasiperkhidmatan->delete();

            if (!$klasifikasiperkhidmatan) {
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
