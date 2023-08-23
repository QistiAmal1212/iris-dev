<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reference\Penalty;
use App\Models\DummyPenalty;
use Illuminate\Support\Facades\DB;

class MaklumatPemohonController extends Controller
{
    public function searchPemohon ()
    {
        $penalties = Penalty::all();
        $dummyPenalty = DummyPenalty::all();

        return view('maklumat_pemohon.carian_pemohon', compact('penalties', 'dummyPenalty'));
    }

    public function viewMaklumatPemohon(){
        return view('maklumat_pemohon.index_pemohon');
    }

    public function storePenalty(Request $request) 
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'penalty' => 'required|string|exists:ref_penalty,code',
                'penalty_duration' => 'required|integer',
                'penalty_type' => 'required|required',
                'penalty_start' => 'required|required',
                'penalty_end' => 'required|required',
            ],[
                'penalty.required' => 'Sila pilih tindakan tatatertib',
                'penalty_duration.required' => 'Sila isikan tempoh hukuman',
                'penalty_type.required' => 'Sila isikan jenis tempoh hukuman',
                'penalty_start.required' => 'Sila isikan tarikh mula hukuman',
                'penalty_end.required' => 'Sila isikan tarikh akhir hukuman',
            ]);

            DummyPenalty::create([
                'ref_penalty_code' => $request->penalty,
                'duration' => $request->penalty_duration,
                'type' => $request->penalty_type,
                'date_start' => $request->penalty_start,
                'date_end' => $request->penalty_end,
            ]);

            DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => "berjaya"]);    
            
        } catch (\Throwable $e) {

            DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function listPenalty() 
    {
        $dummyPenalty = DummyPenalty::all();
        return view('maklumat_pemohon.dummy_penalty', compact('dummyPenalty'));
    }

}
