<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Race;
use Yajra\DataTables\DataTables;

class RaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $race = Race::all();
        if ($request->ajax()) {
            return Datatables::of($race)
                ->editColumn('code', function ($race){
                    return $race->code;
                })
                ->editColumn('name', function ($race) {
                    return $race->name;
                })
                ->editColumn('action', function ($race) {
                    $button = "";

                    $button .= '<div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">';
                    // //$button .= '<a onclick="getModalContent(this)" data-action="'.route('role.edit', $roles).'" type="button" class="btn btn-xs btn-default"> <i class="fas fa-eye text-primary"></i> </a>';
                    $button .= '<a href="javascript:void(0);" class="btn btn-xs btn-default" onclick="raceForm('.$race->id.')"> <i class="fas fa-pencil text-primary"></i> ';
                    $button .= '<a href="#" class="btn btn-xs btn-default"> <i class="fas fa-trash text-danger"></i> </a>';
                    $button .= '</div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.reference.race');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'code' => 'required|string|unique:ref_race,code',
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan keturunan',
            ]);

            Race::create([
                'code' => $request->code,
                'name' => strtoupper($request->name),
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

            $race = Race::find($request->raceId);

            if (!$race) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }
            
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $race]);

        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $raceId = $request->raceId;
            $race = Race::find($raceId);

            $request->validate([
                'code' => 'required|string|unique:ref_race,code,'.$raceId,
                'name' => 'required|string',
            ],[
                'code.required' => 'Sila isikan kod',
                'code.unique' => 'Kod telah diambil',
                'name.required' => 'Sila isikan keturunan',
            ]);

            $race->update([
                'code' => $request->code,
                'name' => strtoupper($request->name),
                'updated_by' => auth()->user()->id,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);    
            
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }
}
