<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\Bahagian;
use App\Models\Reference\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Daerah;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class DaerahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.daerah')->first();
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

        $bahagian = Bahagian::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        $negeri = State::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.daerah')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Daerah";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $daerah = Daerah::orderBy('kod', 'asc')->orderBy('diskripsi', 'asc');

            if ($request->activity_type_id && $request->activity_type_id != "Lihat Semua") {
                $daerah->where('neg_kod', $request->activity_type_id);

            }
            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $daerah->where('bah_kod', $request->module_id);
            }

            return Datatables::of($daerah->with(['bahagian', 'negeri'])->get())
                ->editColumn('kod', function ($daerah){
                    return $daerah->kod;
                })
                ->editColumn('nama', function ($daerah) {
                    return $daerah->diskripsi;
                })
                ->editColumn('kod_bah', function ($daerah) {
                    return $daerah->bahagian->diskripsi;
                })
                ->editColumn('kod_neg', function ($daerah) {
                    return $daerah->negeri->diskripsi;
                })
                ->editColumn('action', function ($daerah) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="daerahForm('.$daerah->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($daerah->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$daerah->id.'" onclick="toggleActive('.$daerah->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$daerah->id.'" onclick="toggleActive('.$daerah->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.daerah', compact('accessAdd', 'accessUpdate', 'accessDelete', 'bahagian', 'negeri'));
    }

    public function getCategoriesByParent(Request $request)
    {
        $parentCategory = $request->input('parent_category');

        $codes = Daerah::where('neg_kod', $parentCategory)
            ->select('bah_kod')
            ->distinct()
            ->pluck('bah_kod')
            ->filter()
            ->toArray();

        $categories = Bahagian::whereIn('kod', $codes)
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
                'code' => 'required|string',
                'name' => 'required|string',
                'kod_ruj_bahagian' => 'required|string|exists:ruj_bahagian,kod',
                'kod_ruj_negeri' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan daerah',
                'kod_ruj_bahagian.required' => 'Sila isikan bahagian',
                'kod_ruj_bahagian.exists' => 'Tiada rekod bahagian yang dipilih',
                'kod_ruj_negeri.required' => 'Sila isikan negeri',
                'kod_ruj_negeri.exists' => 'Tiada rekod negeri yang dipilih',
            ]);

            $daerah = Daerah::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'bah_kod' => $request->kod_ruj_bahagian,
                'neg_kod' => $request->kod_ruj_negeri,
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
                'sah_yt' => 'Y'
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.daerah')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Daerah";
            $log->data_new = json_encode($daerah);
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

            $daerah = Daerah::find($request->daerahId);

            if (!$daerah) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.daerah')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Daerah";
            $log->data_new = json_encode($daerah);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $daerah]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $daerahId = $request->daerahId;
            $daerah = Daerah::find($daerahId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.daerah')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Daerah";
            $log->data_old = json_encode($daerah);

            $request->validate([
                'code' => 'required|string',
                'name' => 'required|string',
                'kod_ruj_bahagian' => 'required|string|exists:ruj_bahagian,kod',
                'kod_ruj_negeri' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan daerah',
                'kod_ruj_bahagian.required' => 'Sila isikan bahagian',
                'kod_ruj_bahagian.exists' => 'Tiada rekod bahagian yang dipilih',
                'kod_ruj_negeri.required' => 'Sila isikan negeri',
                'kod_ruj_negeri.exists' => 'Tiada rekod negeri yang dipilih',
            ]);

            $daerah->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'bah_kod' => $request->kod_ruj_bahagian,
                'neg_kod' => $request->kod_ruj_negeri,
                'pengguna' => auth()->user()->id,
            ]);

            $daerahNewData = daerah::find($daerahId);
            $log->data_new = json_encode($daerahNewData);
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

            $daerahId = $request->daerahId;
            $daerah = Daerah::find($daerahId);

            $sah_yt = $daerah->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $daerah->update([
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
