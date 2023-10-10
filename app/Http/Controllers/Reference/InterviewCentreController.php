<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
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

        $areaInterviewCentre = AreaInterviewCentre::where('sah_yt', 1)->orderBy('nama', 'asc')->get();

        $states = State::where('sah_yt', 1)->orderBy('nama', 'asc')->get();

        if ($request->ajax()) {
            $interviewCentre = InterviewCentre::orderBy('kod', 'asc');

            if ($request->module_id && $request->module_id != "Lihat Semua") {
                $interviewCentre->where('kod_ruj_negeri', $request->module_id);
            }

            return Datatables::of($interviewCentre->get())
                ->editColumn('code', function ($interviewCentre){
                    return $interviewCentre->kod;
                })
                ->editColumn('name', function ($interviewCentre) {
                    return $interviewCentre->nama;
                })
                ->editColumn('neg', function ($interviewCentre) {
                    return $interviewCentre->kod_ruj_negeri;
                })
                ->editColumn('action', function ($interviewCentre) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="interviewCentreForm('.$interviewCentre->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($interviewCentre->sah_yt) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$interviewCentre->id.'" onclick="toggleActive('.$interviewCentre->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$interviewCentre->id.'" onclick="toggleActive('.$interviewCentre->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
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
                'ref_area_code' => 'required|string|exists:ruj_kawasan_pst_td,kod',
                'ref_state_code' => 'required|string|exists:ruj_negeri,kod',
                'kod_pendek' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan pusat temuduga',
                'ref_area_code.required' => 'Sila isikan kawasan pusat temuduga',
                'ref_area_code.exists' => 'Tiada rekod kawasan pusat temuduga yang dipilih',
                'ref_state_code.required' => 'Sila isikan negeri',
                'ref_state_code.exists' => 'Tiada rekod negeri yang dipilih',
                'kod_pendek.required' => 'Sila isikan kod pendek',
            ]);

            InterviewCentre::create([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'kod_ruj_kawasan_pst_td' => $request->ref_area_code,
                'kod_ruj_negeri' => strtoupper($request->ref_state_code),
                'kod_pendek' => strtoupper($request->kod_pendek),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
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

            $interviewCentre = InterviewCentre::find($request->interviewCentreId);

            if (!$interviewCentre) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

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

            $request->validate([
                'code' => 'required|string|unique:ruj_pusat_temuduga,kod,'.$interviewCentreId,
                'name' => 'required|string',
                'ref_area_code' => 'required|string|exists:ruj_kawasan_pst_td,kod',
                'ref_state_code' => 'required|string|exists:ruj_negeri,kod',
                'kod_pendek' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan pusat temuduga',
                'ref_area_code.required' => 'Sila isikan kawasan pusat temuduga',
                'ref_area_code.exists' => 'Tiada rekod kawasan pusat temuduga yang dipilih',
                'ref_state_code.required' => 'Sila isikan negeri',
                'ref_state_code.exists' => 'Tiada rekod negeri yang dipilih',
                'kod_pendek.required' => 'Sila isikan kod pendek',
            ]);

            $interviewCentre->update([
                'kod' => $request->code,
                'nama' => strtoupper($request->name),
                'kod_ruj_kawasan_pst_td' => $request->ref_area_code,
                'kod_ruj_negeri' => strtoupper($request->ref_state_code),
                'kod_pendek' => strtoupper($request->kod_pendek),
                'updated_by' => auth()->user()->id,
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

            $interviewCentreId = $request->interviewCentreId;
            $interviewCentre = InterviewCentre::find($interviewCentreId);

            $sah_yt = $interviewCentre->sah_yt;

            $interviewCentre->update([
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
