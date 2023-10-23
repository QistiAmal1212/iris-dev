<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\JenisSkim;
use App\Models\Reference\KumpulanJKK;
use App\Models\Reference\SalaryGrade;
use App\Models\Reference\SkimPerkhidmatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Skim;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class SkimController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.skim')->first();
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

        $ggh = SalaryGrade::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $skim_pkh = SkimPerkhidmatan::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $kump_jkk = KumpulanJKK::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $jenis_skim = JenisSkim::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skim')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Skim";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $skim = Skim::orderBy('kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $skim->where('jenis_skim', $request->activity_type_id);
            }
            return Datatables::of($skim->get())
                ->editColumn('code', function ($skim){
                    return $skim->kod;
                })
                ->editColumn('name', function ($skim) {
                    return $skim->diskripsi;
                })
                ->editColumn('jenis', function ($skim) {
                    return JenisSkim::where('sah_yt', 'Y')
                    ->where('kod', $skim->jenis_skim)
                    ->pluck('diskripsi')
                    ->first();
                })
                ->editColumn('ggh', function ($skim) {
                    return $skim->GGH_KOD;
                })
                ->editColumn('jkk', function ($skim) {
                    return KumpulanJKK::where('sah_yt', 'Y')
                    ->where('kod', $skim->KUMP_PKHIDMAT_JKK)
                    ->pluck('diskripsi')
                    ->first();
                })
                ->editColumn('action', function ($skim) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="skimForm('.$skim->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessUpdate){
                        if($skim->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$skim->id.'" onclick="toggleActive('.$skim->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$skim->id.'" onclick="toggleActive('.$skim->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$skim->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.skim', compact('accessAdd', 'accessUpdate', 'accessDelete', 'ggh', 'skim_pkh', 'kump_jkk', 'jenis_skim'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_skim,kod',
                'name' => 'required|string',
                'GGH_KOD' => 'required|string',
                'GUNASAMA' => 'required|string',
                'ref_skim_type' => 'required|string',
                'KUMP_PKHIDMAT_JKK' => 'required|string',
                'SKIM_PKHIDMAT' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama jawatan',
                'GGH_KOD.required' => 'Sila isikan gred gaji',
                'GUNASAMA.required' => 'Sila isikan gunasama',
                'ref_skim_type.required' => 'Sila isikan jenis jawatan',
                'KUMP_PKHIDMAT_JKK.required' => 'Sila isikan kumpulan perkhidmatan JKK',
                'SKIM_PKHIDMAT.required' => 'Sila isikan jawatan perkidmatan',
            ]);

            $skim = Skim::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'GGH_KOD' => strtoupper($request->GGH_KOD),
                'GUNASAMA' => strtoupper($request->GUNASAMA),
                'jenis_skim' => strtoupper($request->ref_skim_type),
                'KUMP_PKHIDMAT_JKK' => strtoupper($request->KUMP_PKHIDMAT_JKK),
                'SKIM_PKHIDMAT' => strtoupper($request->SKIM_PKHIDMAT),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skim')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Skim";
            $log->data_new = json_encode($skim);
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

            $skim = Skim::find($request->skimId);

            if (!$skim) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skim')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Skim";
            $log->data_new = json_encode($skim);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $skim]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $skimId = $request->skimId;
            $skim = Skim::find($skimId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.skim')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Skim";
            $log->data_old = json_encode($skim);

            $request->validate([
                'code' => 'required|string|unique:ruj_skim,kod,'.$skimId,
                'name' => 'required|string',
                'GGH_KOD' => 'required|string',
                'GUNASAMA' => 'required|string',
                'ref_skim_type' => 'required|string',
                'KUMP_PKHIDMAT_JKK' => 'required|string',
                'SKIM_PKHIDMAT' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama jawatan',
                'GGH_KOD.required' => 'Sila isikan gred gaji',
                'GUNASAMA.required' => 'Sila isikan gunasama',
                'ref_skim_type.required' => 'Sila isikan jenis jawatan',
                'KUMP_PKHIDMAT_JKK.required' => 'Sila isikan kumpulan perkhidmatan JKK',
                'SKIM_PKHIDMAT.required' => 'Sila isikan jawatan perkidmatan',
            ]);

            $skim->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'GGH_KOD' => strtoupper($request->GGH_KOD),
                'GUNASAMA' => strtoupper($request->GUNASAMA),
                'jenis_skim' => strtoupper($request->ref_skim_type),
                'KUMP_PKHIDMAT_JKK' => strtoupper($request->KUMP_PKHIDMAT_JKK),
                'SKIM_PKHIDMAT' => strtoupper($request->SKIM_PKHIDMAT),
                'pengguna' => auth()->user()->id,
            ]);

            $skimNewData = Skim::find($skim);
            $log->data_new = json_encode($skimNewData);
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

            $skimId = $request->skimId;
            $skim = Skim::find($skimId);

            $sah_yt = $skim->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $skim->update([
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
            $skim = Skim::find($request-> skimId);

            $skim->delete();

            if (!$skim) {
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
