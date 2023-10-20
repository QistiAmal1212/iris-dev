<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\State;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;
use App\Models\Reference\CutiAwam;
use App\Models\Reference\SenaraiCuti;

class CutiAwamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.cutiawam')->first();
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

        $senaraicuti = SenaraiCuti::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        $negeri = State::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();


        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.cutiawam')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Cuti Awam";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $cutiawam = CutiAwam::orderBy('ca_id', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $cutiawam->where('neg_kod', $request->activity_type_id);
            }

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $cutiawam->where('scut_kod', $request->module_id);
            }

            return Datatables::of($cutiawam->with(['scut', 'negeri'])->get())
                ->editColumn('kod', function ($cutiawam){
                    return $cutiawam->ca_id;
                })
                ->editColumn('tarikh_cuti', function ($cutiawam) {
                    return $cutiawam->tarikh_cuti = Carbon::parse($cutiawam->tarikh_cuti)->format('d/m/Y');
                })
                ->editColumn('kod_cuti', function ($cutiawam) {
                    return strtoupper($cutiawam->scut->diskripsi);
                })
                ->editColumn('kod_neg', function ($cutiawam) {
                    return $cutiawam->negeri->diskripsi;
                })
                ->editColumn('action', function ($cutiawam) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="cutiawamForm('.$cutiawam->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($cutiawam->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$cutiawam->id.'" onclick="toggleActive('.$cutiawam->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$cutiawam->id.'" onclick="toggleActive('.$cutiawam->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.cuti_awam', compact('accessAdd', 'accessUpdate', 'accessDelete', 'senaraicuti', 'negeri'));
    }

    public function getCategoriesByParent(Request $request)
    {
        $parentCategory = $request->input('parent_category');

        $codes = CutiAwam::where('neg_kod', $parentCategory)
            ->select('scut_kod')
            ->distinct()
            ->pluck('scut_kod')
            ->filter()
            ->toArray();

        $categories = SenaraiCuti::whereIn('kod', $codes)
        ->where('sah_yt', 'Y')
        ->get();

        $result = $categories->map(function($item) {
            return [
                'categories' => $item->diskripsi,
                'codes' => $item->kod
            ];
        });

        return response()->json($result);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_cuti_awam,ca_id',
                'tarikh_cuti' => 'required|string',
                'kod_ruj_senarai_cuti' => 'required|string|exists:ruj_senarai_cuti,kod',
                'kod_ruj_negeri' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'tarikh_cuti.required' => 'Sila isikan cutiawam',
                'kod_ruj_senarai_cuti.required' => 'Sila isikan senarai cuti',
                'kod_ruj_senarai_cuti.exists' => 'Tiada rekod senarai cuti yang dipilih',
                'kod_ruj_negeri.required' => 'Sila isikan negeri',
                'kod_ruj_negeri.exists' => 'Tiada rekod negeri yang dipilih',
            ]);

            $cutiawam = CutiAwam::create([
                'ca_id' => $request->code,
                'tarikh_cuti' => Carbon::createFromFormat('d/m/Y', $request->tarikh_cuti)->format('Y-m-d'),
                'scut_kod' => $request->kod_ruj_senarai_cuti,
                'neg_kod' => $request->kod_ruj_negeri,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.cutiawam')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Cuti Awam";
            $log->data_new = json_encode($cutiawam);
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

            $cutiawam = CutiAwam::find($request->cutiawamId);

            $cutiawam->tarikh_cuti = Carbon::parse($cutiawam->tarikh_cuti)->format('d/m/Y');

            if (!$cutiawam) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.cutiawam')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Cuti Awam";
            $log->data_new = json_encode($cutiawam);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $cutiawam]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $cutiawamId = $request->cutiawamId;
            $cutiawam = CutiAwam::find($cutiawamId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.cutiawam')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Cuti Awam";
            $log->data_old = json_encode($cutiawam);

            $request->validate([
                'code' => 'required|string|unique:ruj_cuti_awam,ca_id,'.$cutiawamId,
                'tarikh_cuti' => 'required|string',
                'kod_ruj_senarai_cuti' => 'required|string|exists:ruj_senarai_cuti,kod',
                'kod_ruj_negeri' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'tarikh_cuti.required' => 'Sila isikan cutiawam',
                'kod_ruj_senarai_cuti.required' => 'Sila isikan senarai cuti',
                'kod_ruj_senarai_cuti.exists' => 'Tiada rekod senarai cuti yang dipilih',
                'kod_ruj_negeri.required' => 'Sila isikan negeri',
                'kod_ruj_negeri.exists' => 'Tiada rekod negeri yang dipilih',
            ]);

            $cutiawam->update([
                'ca_id' => $request->code,
                'tarikh_cuti' => Carbon::createFromFormat('d/m/Y', $request->tarikh_cuti)->format('Y-m-d'),
                'scut_kod' => $request->kod_ruj_senarai_cuti,
                'neg_kod' => $request->kod_ruj_negeri,
                'pengguna' => auth()->user()->id,
            ]);

            $cutiawamNewData = cutiawam::find($cutiawamId);
            $log->data_new = json_encode($cutiawamNewData);
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

            $cutiawamId = $request->cutiawamId;
            $cutiawam = CutiAwam::find($cutiawamId);

            $sah_yt = $cutiawam->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $cutiawam->update([
                'sah_yt' => $sah_yt,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
