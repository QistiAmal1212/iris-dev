<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\LogSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;
use App\Models\Reference\AreaInterviewCentre;
use App\Models\Reference\InterviewCentre;
use App\Models\Reference\State;

class InterviewCentreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.interview-centre')->first();
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

        $areaInterviewCentre = AreaInterviewCentre::where('sah_yt', 1)->orderBy('diskripsi', 'asc')->get();

        $states = State::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        if ($request->ajax()) {

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.interview-centre')->firstOrFail()->id;
            $log->activity_type_id = 1;
            $log->description = "Lihat Senarai Pusat Temu Duga";
            $log->data_old = json_encode($request->input());
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            $interviewCentre = InterviewCentre::orderBy('kod', 'asc');

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $interviewCentre->where('neg_kod', $request->module_id);
            }

            return Datatables::of($interviewCentre->with(['negeri'])->get())
                ->editColumn('code', function ($interviewCentre){
                    return $interviewCentre->kod;
                })
                ->editColumn('nama', function ($interviewCentre) {
                    return $interviewCentre->diskripsi;
                })
                ->editColumn('neg', function ($interviewCentre) {
                    return $interviewCentre->negeri->diskripsi;
                })
                ->editColumn('kp', function ($interviewCentre) {
                    return $interviewCentre->kod_pendek;
                })
                ->editColumn('action', function ($interviewCentre) use ($accessUpdate, $accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';

                    if($accessUpdate){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="interviewCentreForm('.$interviewCentre->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                        if($interviewCentre->sah_yt=='Y') {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$interviewCentre->id.'" onclick="toggleActive('.$interviewCentre->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$interviewCentre->id.'" onclick="toggleActive('.$interviewCentre->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }else{
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="interviewCentreForm('.$interviewCentre->id.')"> <i class="fas fa-eye text-primary"></i> ';
                    }
                    if($accessDelete){
                        $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="deleteItem('.$interviewCentre->id.')"> <i class="fas fa-trash text-danger"></i> ';
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //pass
        return view('admin.reference.interview_centre', compact('accessAdd', 'accessUpdate', 'accessDelete', 'areaInterviewCentre', 'states'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ruj_pusat_temuduga,kod',
                'name' => 'required|string',
                // 'ref_area_code' => 'required|string|exists:ruj_kawasan_pst_td,kod',
                'ref_state_code' => 'required|string|exists:ruj_negeri,kod',
                'kod_pendek' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan pusat temu duga',
                // 'ref_area_code.required' => 'Sila isikan kawasan pusat temuduga',
                // 'ref_area_code.exists' => 'Tiada rekod kawasan pusat temuduga yang dipilih',
                'ref_state_code.required' => 'Sila isikan negeri',
                'ref_state_code.exists' => 'Tiada rekod negeri yang dipilih',
                'kod_pendek.required' => 'Sila isikan kod pendek',
            ]);

            $iv = InterviewCentre::create([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                // 'kpt_kod' => $request->ref_area_code,
                'neg_kod' => strtoupper($request->ref_state_code),
                'kod_pendek' => strtoupper($request->kod_pendek),
                'id_pencipta' => auth()->user()->id,
                'pengguna' => auth()->user()->id,
            ]);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.interview-centre')->firstOrFail()->id;
            $log->activity_type_id = 3;
            $log->description = "Tambah Pusat Temu Duga";
            $log->data_new = json_encode($iv);
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

            $interviewCentre = InterviewCentre::find($request->interviewCentreId);

            if (!$interviewCentre) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.interview-centre')->firstOrFail()->id;
            $log->activity_type_id = 2;
            $log->description = "Lihat Maklumat Pusat Temu Duga";
            $log->data_new = json_encode($interviewCentre);
            $log->url = $request->fullUrl();
            $log->method = strtoupper($request->method());
            $log->ip_address = $request->ip();
            $log->created_by_user_id = auth()->id();
            $log->save();

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $interviewCentre]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $interviewCentreId = $request->interviewCentreId;
            $interviewCentre = InterviewCentre::find($interviewCentreId);

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.interview-centre')->firstOrFail()->id;
            $log->activity_type_id = 4;
            $log->description = "Kemaskini Maklumat Pusat Temu Duga";
            $log->data_old = json_encode($interviewCentre);

            $request->validate([
                'code' => 'required|string|unique:ruj_pusat_temuduga,kod,'.$interviewCentreId,
                'name' => 'required|string',
                // 'ref_area_code' => 'required|string|exists:ruj_kawasan_pst_td,kod',
                'ref_state_code' => 'required|string|exists:ruj_negeri,kod',
                'kod_pendek' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan pusat temu duga',
                // 'ref_area_code.required' => 'Sila isikan kawasan pusat temuduga',
                'ref_area_code.exists' => 'Tiada rekod kawasan pusat temuduga yang dipilih',
                'ref_state_code.required' => 'Sila isikan negeri',
                'ref_state_code.exists' => 'Tiada rekod negeri yang dipilih',
                'kod_pendek.required' => 'Sila isikan kod pendek',
            ]);

            $interviewCentre->update([
                'kod' => $request->code,
                'diskripsi' => strtoupper($request->name),
                // 'kpt_kod' => $request->ref_area_code,
                'neg_kod' => strtoupper($request->ref_state_code),
                'kod_pendek' => strtoupper($request->kod_pendek),
                'pengguna' => auth()->user()->id,
            ]);

            $interviewCentreNewData = InterviewCentre::find($interviewCentreId);
            $log->data_new = json_encode($interviewCentreNewData);
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

            $interviewCentreId = $request->interviewCentreId;
            $interviewCentre = InterviewCentre::find($interviewCentreId);

            $sah_yt = $interviewCentre->sah_yt;

            if($sah_yt=='Y') $sah_yt = 'T';
            else $sah_yt = 'Y';

            $interviewCentre->update([
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
            $interviewCentre = InterviewCentre::find($request-> interviewCentreId);

            $interviewCentre->delete();

            if (!$interviewCentre) {
                throw new \Exception('Rekod tidak dijumpai');
            }

            $log = new LogSystem;
            $log->module_id = MasterModule::where('code', 'admin.reference.interview-centre')->firstOrFail()->id;
            $log->activity_type_id = 5;
            $log->description = "Hapus Pusat Temu Duga";
            $log->data_new = json_encode($interviewCentre);
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
