<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KelayakanSetaraf;
use App\Models\Reference\Skim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Eligibility;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class EligibilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.eligibility')->first();
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

        $skim = Skim::where('sah_yt', 'Y')->get();
        $kelayakanSetaraf = KelayakanSetaraf::where('sah_yt', 'Y')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.eligibility')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Kelayakan";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $eligibility = Eligibility::orderBy('kod', 'asc');
            if($request->activity_type_id && $request->activity_type_id != "Lihat Semua"){
                $eligibility->where('kelayakan_setara',$request->activity_type_id);
            }
            return Datatables::of($eligibility->with(['KSetara'])->get())
                ->editColumn('code', function ($eligibility){
                    return $eligibility->kod;
                })
                ->editColumn('name', function ($eligibility) {
                    return $eligibility->diskripsi;
                })
                ->editColumn('ks', function ($eligibility) {
                    // return $eligibility->kelayakan_setara;
                    return $eligibility->KSetara->diskripsi;
                })
                ->editColumn('action', function ($eligibility) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';

                    if($accessUpdate){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="eligibilityForm('.$eligibility->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        if($eligibility->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$eligibility->id.'" onclick="toggleActive('.$eligibility->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$eligibility->id.'" onclick="toggleActive('.$eligibility->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }else{
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="eligibilityForm('.$eligibility->id.')"> <i class="fas fa-eye text-primary"></i> ';
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$eligibility->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //pass
        return view('admin.reference.eligibility', compact('accessAdd', 'accessUpdate', 'accessDelete', 'skim', 'kelayakanSetaraf'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_kelayakan,kod',
                'name' => 'required|string',
                // 'ref_skim_code' => 'required|string',
                'equivalent' => 'required|string',
                // 'rank' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan kelayakan',
                // 'ref_skim_code.required' => 'Sila isikan jawatan',
                'equivalent.required' => 'Sila isikan bersamaan',
                // 'rank.required' => 'Sila isikan pangkat',
            ]);

            $kelayakan = Eligibility::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                // 'ski_kod' => $request->ref_skim_code,
                'kelayakan_setara' => strtoupper($request->equivalent),
                // 'rank_layak' => strtoupper($request->rank),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.eligibility')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Kelayakan";
            $log->data_new = json_encode($kelayakan);
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

            $eligibility = Eligibility::find($request->eligibilityId);

            if (!$eligibility) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.eligibility')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Kelayakan";
            $log->data_new = json_encode($eligibility);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $eligibility]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $eligibilityId = $request->eligibilityId;
            $eligibility = Eligibility::find($eligibilityId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.eligibility')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Kelayakan";
            $log->data_old = json_encode($eligibility);

            $request->validate([
                'code' => 'required|string|unique:ruj_kelayakan,kod,'.$eligibilityId,
                'name' => 'required|string',
                // 'ref_skim_code' => 'required|string',
                'equivalent' => 'required|string',
                // 'rank' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan kelayakan',
                // 'ref_skim_code.required' => 'Sila isikan jawatan',
                'equivalent.required' => 'Sila isikan bersamaan',
                // 'rank.required' => 'Sila isikan pangkat',
            ]);

            $eligibility->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                // 'ski_kod' => $request->ref_skim_code,
                'kelayakan_setara' => strtoupper($request->equivalent),
                // 'rank_layak' => strtoupper($request->rank),
                'pengguna' => auth()->user()->id,
            ]);

            $eligibilityNewData = Eligibility::find($eligibilityId);
            $log->data_new = json_encode($eligibilityNewData);
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

            $eligibilityId = $request->eligibilityId;
            $eligibility = Eligibility::find($eligibilityId);

            $sah_yt = $eligibility->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $eligibility->update([
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
            $eligibility = Eligibility::find($request-> eligibilityId);

            $eligibility->delete();

            if (!$eligibility) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.eligibility')->firstOrFail()->id;
            $log->activity_type_id = 5;
            $log->description = "Hapus Kelayakan";
            $log->data_new = json_encode($eligibility);
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
