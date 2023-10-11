<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
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

        $ggh = SalaryGrade::where('is_active', 1)->orderBy('name', 'asc')->get();
        $skim_pkh = SkimPerkhidmatan::where('sah_yt', 1)->orderBy('nama', 'asc')->get();
        $kump_jkk = KumpulanJKK::where('sah_yt', 1)->orderBy('nama', 'asc')->get();

        if ($request->ajax()) {
            $skim = Skim::orderBy('kod', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $skim->where('KUMP_PKHIDMAT_JKK', $request->activity_type_id);
            }
            return Datatables::of($skim->get())
                ->editColumn('code', function ($skim){
                    return $skim->kod;
                })
                ->editColumn('name', function ($skim) {
                    return $skim->diskripsi;
                })
                ->editColumn('ggh', function ($skim) {
                    return $skim->GGH_KOD;
                })
                ->editColumn('jkk', function ($skim) {
                    return $skim->KUMP_PKHIDMAT_JKK;
                })
                ->editColumn('action', function ($skim) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="skimForm('.$skim->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($skim->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$skim->id.'" onclick="toggleActive('.$skim->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$skim->id.'" onclick="toggleActive('.$skim->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.skim', compact('accessAdd', 'accessUpdate', 'accessDelete', 'ggh', 'skim_pkh', 'kump_jkk'));
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

            Skim::create([
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
                'sah_yt' => !$sah_yt,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
