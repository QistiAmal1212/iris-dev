<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\KodPelbagai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class KodPelbagaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.kodpelbagai')->first();
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

        $kodpelbagai = KodPelbagai::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {
            return Datatables::of($kodpelbagai)
                ->editColumn('kod', function ($kodpelbagai){
                    return $kodpelbagai->kod;
                })
                ->editColumn('nama', function ($kodpelbagai) {
                    return $kodpelbagai->nama;
                })
                ->editColumn('kategori', function ($kodpelbagai) {
                    return $kodpelbagai->kategori;
                })
                ->editColumn('action', function ($kodpelbagai) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="kodpelbagaiForm('.$kodpelbagai->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($kodpelbagai->sah_yt == "Y") {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$kodpelbagai->id.'" onclick="toggleActive('.$kodpelbagai->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$kodpelbagai->id.'" onclick="toggleActive('.$kodpelbagai->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.kodpelbagai', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'kod' => 'required|string|unique:ruj_kod_pelbagai,kod',
                'kategori' => 'required|string',
                'nama' => 'required|string',
            ],[
                'kod.required' => 'Sila isikan kod',
                'kod.unique' => 'Kod telah diambil',
                'kategori.required' => 'Sila isikan nama kategori',
                'nama.required' => 'Sila isikan nama kod pelbagai',
            ]);

            $kodpelbagai = KodPelbagai::create([
                'kod' => $request->kod,
                'kategori' => strtoupper($request->kategori),
                'nama' => strtoupper($request->nama),
                'sah_yt' => "Y",
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kodpelbagai')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Kod Pelbagai";
            $log->data_new = json_encode($kodpelbagai);
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

            $kodpelbagai = KodPelbagai::find($request->kodpelbagaiId);

            if (!$kodpelbagai) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
                $log = new LogSystem;
                $log->module_id = MasterModule::where('code', 'admin.reference.kodpelbagai')->firstOrFail()->id;
                $log->activity_type_id = 2;
                $log->description = "Lihat Maklumat Kod Pelbagai";
                $log->data_new = json_encode($kodpelbagai);
                $log->url = $request->fullUrl();
                $log->method = strtoupper($request->method());
                $log->ip_address = $request->ip();
                $log->created_by_user_id = auth()->id();
                $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $kodpelbagai]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $kodpelbagaiId = $request->kodpelbagaiId;
            $kodpelbagai = KodPelbagai::find($kodpelbagaiId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.kodpelbagai')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Kod Pelbagai";
            $log->data_old = json_encode($kodpelbagai);

            $request->validate([
                'kod' => 'required|string|unique:ruj_kod_pelbagai,kod,'.$kodpelbagaiId,
                'kategori' => 'required|string',
                'nama' => 'required|string',
            ],[
                'kod.required' => 'Sila isikan kod',
                'kod.unique' => 'Kod telah diambil',
                'kategori.required' => 'Sila isikan nama kategori',
                'nama.required' => 'Sila isikan nama kod pelbagai',
            ]);

            $kodpelbagai->update([
                'kod' => $request->kod,
                'kategori' => strtoupper($request->kategori),
                'nama' => strtoupper($request->nama),
                'updated_by' => auth()->user()->id,
            ]);

            $kodpelbagaiNewData = KodPelbagai::find($kodpelbagaiId);
            $log->data_new = json_encode($kodpelbagaiNewData);
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

            $kodpelbagaiId = $request->kodpelbagaiId;
            $kodpelbagai = KodPelbagai::find($kodpelbagaiId);

            $sah_yt = $kodpelbagai->sah_yt;

            if($sah_yt == "Y"){
                $sah_yt = "T";
            }else{
                $sah_yt = "Y";
            }

            $kodpelbagai->update([
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
