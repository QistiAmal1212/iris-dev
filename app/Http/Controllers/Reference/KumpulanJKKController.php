<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KumpulanJKK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class KumpulanJKKController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.kumpulanjkk')->first();
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

        $kumpulanjkk = KumpulanJKK::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kumpulanjkk')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Kumpulan JKK";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($kumpulanjkk)
                ->editColumn('kod', function ($kumpulanjkk){
                    return $kumpulanjkk->kod;
                })
                ->editColumn('nama', function ($kumpulanjkk) {
                    return $kumpulanjkk->diskripsi;
                })
                ->editColumn('action', function ($kumpulanjkk) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="kumpulanjkkForm('.$kumpulanjkk->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessUpdate){
                        if($kumpulanjkk->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$kumpulanjkk->id.'" onclick="toggleActive('.$kumpulanjkk->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$kumpulanjkk->id.'" onclick="toggleActive('.$kumpulanjkk->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$kumpulanjkk->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.kumpulan_jkk', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_kumpulan_jkk,kod',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan kumpulan jkk',
            ]);

            $kumpulanjkk = KumpulanJKK::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kumpulanjkk')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Kumpulan JKK";
            $log->data_new = json_encode($kumpulanjkk);
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

            $kumpulanjkk = KumpulanJKK::find($request->kumpulanjkkId);

            if (!$kumpulanjkk) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kumpulanjkk')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Kumpulan JKK";
            $log->data_new = json_encode($kumpulanjkk);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $kumpulanjkk]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $kumpulanjkkId = $request->kumpulanjkkId;
            $kumpulanjkk = KumpulanJKK::find($kumpulanjkkId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kumpulanjkk')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Kumpulan JKK";
            $log->data_old = json_encode($kumpulanjkk);

            $request->validate([
                'code' => 'required|string|unique:ruj_kumpulan_jkk,kod,'.$kumpulanjkkId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan kumpulanjkk',
            ]);

            $kumpulanjkk->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                'pengguna' => auth()->user()->id,
            ]);

            $kumpulanjkkNewData = kumpulanjkk::find($kumpulanjkkId);
            $log->data_new = json_encode($kumpulanjkkNewData);
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

            $kumpulanjkkId = $request->kumpulanjkkId;
            $kumpulanjkk = KumpulanJKK::find($kumpulanjkkId);

            $sah_yt = $kumpulanjkk->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $kumpulanjkk->update([
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
            $kumpulanjkk = KumpulanJKK::find($request-> kumpulanjkkId);

            $kumpulanjkk->delete();

            if (!$kumpulanjkk) {
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
