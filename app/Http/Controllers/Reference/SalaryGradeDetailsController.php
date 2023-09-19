<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\SalaryGradeDetails;
use Yajra\DataTables\DataTables;
use App\Models\Master\MasterModule;
use App\Models\Reference\SalaryGrade;

class salaryGradeDetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->module = MasterModule::where('code', 'admin.reference.salary-grade-details')->first();
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

        $salaryGrade = SalaryGrade::all();

        $salaryGradeDetails = SalaryGradeDetails::all();
        if ($request->ajax()) {
            return Datatables::of($salaryGradeDetails)
                ->editColumn('ref_salary_grade_code', function ($salaryGradeDetails){
                    return $salaryGradeDetails->ref_salary_grade_code;
                })
                ->editColumn('level', function ($salaryGradeDetails) {
                    return $salaryGradeDetails->level;
                })
                ->editColumn('year', function ($salaryGradeDetails){
                    return $salaryGradeDetails->year;
                })
                ->editColumn('amount', function ($salaryGradeDetails) {
                    return $salaryGradeDetails->amount;
                })
                ->editColumn('action', function ($salaryGradeDetails) use ($accessDelete) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="salaryGradeDetailsForm('.$salaryGradeDetails->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    if($accessDelete){
                        if($salaryGradeDetails->is_active) {
                            $button .= '<a href="#" class="btn btn-sm btn-default deactivate" data-id="'.$salaryGradeDetails->id.'" onclick="toggleActive('.$salaryGradeDetails->id.')"> <i class="fas fa-toggle-on text-success fa-lg"></i> </a>';
                        } else {
                            $button .= '<a href="#" class="btn btn-sm btn-default activate" data-id="'.$salaryGradeDetails->id.'" onclick="toggleActive('.$salaryGradeDetails->id.')"> <i class="fas fa-toggle-off text-danger fa-lg"></i> </a>';
                        }
                    }
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        //pass
        return view('admin.reference.salary_grade_details', compact('accessAdd', 'accessUpdate', 'accessDelete', 'salaryGrade'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ref_salary_grade_details,ref_salary_grade_code',
                'level' => 'required|string',
                'year' => 'required|string',
                'amount' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'level.required' => 'Sila isikan tahap gred gaji',
                'year.required' => 'Sila isikan tahun',
                'amount.required' => 'Sila isikan jumlah',
            ]);

            SalaryGradeDetails::create([
                'ref_salary_grade_code' => $request->code,
                'level' => strtoupper($request->level),
                'year' => strtoupper($request->year),
                'amount' => strtoupper($request->amount),
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

            $salaryGradeDetails = SalaryGradeDetails::find($request->salaryGradeDetailsId);

            if (!$salaryGradeDetails) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $salaryGradeDetails]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $salaryGradeDetailsId = $request->salaryGradeDetailsId;
            $salaryGradeDetails = SalaryGradeDetails::find($salaryGradeDetailsId);

            $request->validate([
                'code' => 'required|string|unique:ref_salary_grade_details,ref_salary_grade_code,'.$salaryGradeDetailsId,
                'level' => 'required|string',
                'year' => 'required|string',
                'amount' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'level.required' => 'Sila isikan tahap gred gaji',
                'year.required' => 'Sila isikan tahun',
                'amount.required' => 'Sila isikan jumlah',
            ]);

            $salaryGradeDetails->update([
                'ref_salary_grade_code' => $request->code,
                'level' => strtoupper($request->level),
                'year' => strtoupper($request->year),
                'amount' => strtoupper($request->amount),
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

            $salaryGradeDetailsId = $request->salaryGradeDetailsId;
            $salaryGradeDetails = SalaryGradeDetails::find($salaryGradeDetailsId);

            $is_active = $salaryGradeDetails->is_active;

            $salaryGradeDetails->update([
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
