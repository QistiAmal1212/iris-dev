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

        $areaInterviewCentre = AreaInterviewCentre::all();

        $state = State::all();

        $interviewCentre = InterviewCentre::all();
        if ($request->ajax()) {
            return Datatables::of($interviewCentre)
                ->editColumn('code', function ($interviewCentre){
                    return $interviewCentre->code;
                })
                ->editColumn('name', function ($interviewCentre) {
                    return $interviewCentre->name;
                })
                ->editColumn('action', function ($interviewCentre) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="interviewCentreForm('.$interviewCentre->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($interviewCentre->is_active) {
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
        return view('admin.reference.interview_centre', compact('accessAdd', 'accessUpdate', 'accessDelete', 'areaInterviewCentre', 'state'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ref_interview_centre,code',
                'name' => 'required|string',
                'ref_area_code' => 'required|string',
                'ref_state_code' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan pangkat',
                'ref_area_code.required' => 'Sila isikan kod kawasan',
                'ref_state_code.required' => 'Sila isikan kod negeri',
            ]);

            InterviewCentre::create([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'ref_area_interview_centre_code' => $request->ref_area_code,
                'ref_state_code' => strtoupper($request->ref_state_code),
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
                'code' => 'required|string|unique:ref_interview_centre,code,'.$interviewCentreId,
                'name' => 'required|string',
                'ref_area_code' => 'required|string',
                'ref_state_code' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan pangkat',
                'ref_area_code.required' => 'Sila isikan kod kawasan',
                'ref_state_code.required' => 'Sila isikan kod negeri',
            ]);

            $interviewCentre->update([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'ref_area_interview_centre_code' => $request->ref_area_code,
                'ref_state_code' => strtoupper($request->ref_state_code),
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

            $is_active = $interviewCentre->is_active;

            $interviewCentre->update([
                'is_active' => !$is_active,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya", 'success' => true]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
