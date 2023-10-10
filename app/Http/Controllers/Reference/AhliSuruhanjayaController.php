<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use App\Models\Reference\AhliSuruhanjaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;

class AhliSuruhanjayaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.ahlisuruhanjaya')->first();
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

        $ahlisuruhanjaya = AhliSuruhanjaya::orderBy('kod', 'asc')->get();
        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ahlisuruhanjaya')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Ahli Suruhanjaya";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return Datatables::of($ahlisuruhanjaya)
                ->editColumn('kod', function ($ahlisuruhanjaya){
                    return $ahlisuruhanjaya->kod;
                })
                ->editColumn('nama', function ($ahlisuruhanjaya) {
                    return $ahlisuruhanjaya->nama;
                })
                ->editColumn('no_kp', function ($ahlisuruhanjaya){
                    return $ahlisuruhanjaya->no_kp;
                })
                ->editColumn('no_tel', function ($ahlisuruhanjaya) {
                    return $ahlisuruhanjaya->no_tel;
                })
                ->editColumn('action', function ($ahlisuruhanjaya) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="ahlisuruhanjayaForm('.$ahlisuruhanjaya->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($ahlisuruhanjaya->sah_yt=="Y") {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$ahlisuruhanjaya->id.'" onclick="toggleActive('.$ahlisuruhanjaya->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$ahlisuruhanjaya->id.'" onclick="toggleActive('.$ahlisuruhanjaya->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.ahlisuruhanjaya', compact('accessAdd', 'accessUpdate', 'accessDelete'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_ahli_suruhanjaya,kod',
                'name' => 'required|string',
                'no_tel' => 'required|string',
                'no_kp' => 'required|string',
                'nama_pasangan' => 'required|string',
                'no_tel_pasangan' => 'required|string',
                'alamat1' => 'required|string',
                'kekananan' => 'required|string',
                'kontrak_dari1' => 'required|string',
                'kontrak_hingga1' => 'required|string',
                'elaun_pada_gred' => 'required|string',
                'status_ahli' => 'required|string',

            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan nama ahli suruhanjaya',
                'no_tel.required' => 'Sila isikan nombor telefon',
                'no_kp.required' => 'Sila isikan nombor kad pengenalan',
                'nama_pasangan.required' => 'Sila isikan nama pasangan',
                'no_tel_pasangan.required' => 'Sila isikan nombor telefon pasangan',
                'alamat1.required' => 'Sila isikan alamat',
                'kekananan.required' => 'Sila isikan kekananan',
                'kontrak_dari1.required' => 'Sila isikan tarikh mula kontrak',
                'kontrak_hingga1.required' => 'Sila isikan tarikh tamat kontrak',
                'elaun_pada_gred.required' => 'Sila isikan elaun pada gred',
                'status_ahli.required' => 'Sila isikan status keahlian',
            ]);

            $ahlisuruhanjaya = AhliSuruhanjaya::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'no_tel' => strtoupper($request->no_tel),
                'no_kp' => strtoupper($request->no_kp),
                'nama_pasangan' => strtoupper($request->nama_pasangan),
                'no_tel_pasangan' => strtoupper($request->no_tel_pasangan),
                'alamat1' => strtoupper($request->alamat1),
                'alamat2' => strtoupper($request->alamat2),
                'alamat3' => strtoupper($request->alamat3),
                'kekananan' => strtoupper($request->kekananan),
                'kontrak_dari1' => strtoupper($request->kontrak_dari1),
                'kontrak_hingga1' => strtoupper($request->kontrak_hingga1),
                'elaun_pada_gred' => strtoupper($request->elaun_pada_gred),
                'status_ahli' => strtoupper($request->status_ahli),
                'sah_yt'=> "Y",
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ahlisuruhanjaya')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Ahli Suruhanjaya";
            $log->data_new = json_encode($ahlisuruhanjaya);
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

            $ahlisuruhanjaya = AhliSuruhanjaya::find($request->ahlisuruhanjayaId);

            if (!$ahlisuruhanjaya) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ahlisuruhanjaya')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat AhliSuruhanjaya";
            $log->data_new = json_encode($ahlisuruhanjaya);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            DB::commit();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $ahlisuruhanjaya]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $ahlisuruhanjayaId = $request->ahlisuruhanjayaId;
            $ahlisuruhanjaya = AhliSuruhanjaya::find($ahlisuruhanjayaId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.ahlisuruhanjaya')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Ahli Suruhanjaya";
            $log->data_old = json_encode($ahlisuruhanjaya);

            $request->validate([
                'code' => 'required|string|unique:ruj_ahli_suruhanjaya,kod,'.$ahlisuruhanjayaId,
                'name' => 'required|string',
                'no_tel' => 'required|string',
                'no_kp' => 'required|string',
                'nama_pasangan' => 'required|string',
                'no_tel_pasangan' => 'required|string',
                'alamat1' => 'required|string',
                'kekananan' => 'required|string',
                'kontrak_dari1' => 'required|string',
                'kontrak_hingga1' => 'required|string',
                'elaun_pada_gred' => 'required|string',
                'status_ahli' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan ahli suruhanjaya',
                'no_tel.required' => 'Sila isikan nombor telefon',
                'no_kp.required' => 'Sila isikan nombor kad pengenalan',
                'nama_pasangan.required' => 'Sila isikan nama pasangan',
                'no_tel_pasangan.required' => 'Sila isikan nombor telefon pasangan',
                'alamat1.required' => 'Sila isikan alamat',
                'kekananan.required' => 'Sila isikan kekananan',
                'kontrak_dari1.required' => 'Sila isikan tarikh mula kontrak',
                'kontrak_hingga1.required' => 'Sila isikan tarikh tamat kontrak',
                'elaun_pada_gred.required' => 'Sila isikan elaun pada gred',
                'status_ahli.required' => 'Sila isikan status keahlian',
            ]);

            $ahlisuruhanjaya->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'no_tel' => strtoupper($request->no_tel),
                'no_kp' => strtoupper($request->no_kp),
                'nama_pasangan' => strtoupper($request->nama_pasangan),
                'no_tel_pasangan' => strtoupper($request->no_tel_pasangan),
                'alamat1' => strtoupper($request->alamat1),
                'alamat2' => strtoupper($request->alamat2),
                'alamat3' => strtoupper($request->alamat3),
                'kekananan' => strtoupper($request->kekananan),
                'kontrak_dari1' => strtoupper($request->kontrak_dari1),
                'kontrak_hingga1' => strtoupper($request->kontrak_hingga1),
                'elaun_pada_gred' => strtoupper($request->elaun_pada_gred),
                'status_ahli' => strtoupper($request->status_ahli),
                'updated_by' => auth()->user()->id,
            ]);

            $ahlisuruhanjayaNewData = AhliSuruhanjaya::find($ahlisuruhanjayaId);
            $log->data_new = json_encode($ahlisuruhanjayaNewData);
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

            $ahlisuruhanjayaId = $request->ahlisuruhanjayaId;
            $ahlisuruhanjaya = AhliSuruhanjaya::find($ahlisuruhanjayaId);

            $sah_yt = $ahlisuruhanjaya->sah_yt;

            if($sah_yt == "Y"){
                $sah_yt = "T";
            }else{
                $sah_yt = "Y";
            }

            $ahlisuruhanjaya->update([
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
