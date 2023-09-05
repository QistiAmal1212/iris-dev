<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Gender;
use App\Models\Reference\Institution;
use App\Models\Reference\MaritalStatus;
use App\Models\Reference\Penalty;
use App\Models\Reference\Race;
use App\Models\Reference\Religion;
use App\Models\Reference\State;
use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidatePenalty;
use App\Models\Candidate\CandidateTimeline;

class MaklumatPemohonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchPemohon ()
    {
        $genders = Gender::all();
        $institutions = Institution::orderBy('type', 'asc')->orderBy('name', 'asc')->get();
        $maritalStatuses = MaritalStatus::all();
        $penalties = Penalty::all();
        $races = Race::all();
        $religions = Religion::all();
        $states = State::orderBy('name', 'asc')->get();

        return view('maklumat_pemohon.carian_pemohon', compact('genders', 'institutions', 'maritalStatuses', 'penalties', 'races', 'religions', 'states'));
    }

    public function viewMaklumatPemohon(){
        return view('maklumat_pemohon.index_pemohon');
    }

    public function getCandidateDetails(Request $request)
    {
        $no_ic = $request->no_ic;

        DB::beginTransaction();
        try {

            $candidate = Candidate::where(function ($query) use ($no_ic) {
                $query->where('no_ic', $no_ic)->orWhere('no_ic_old', $no_ic);
            })
            ->with([
                'license', 
                'oku', 
                'skim' => function ($query) {
                    $query->with(['skim', 'interviewCentre']);
                },
                'matriculation' => function ($query) {
                    $query->with(['course', 'college', 'subject']);
                },
                'skm' => function ($query) {
                    $query->with(['qualification']);
                },
                'penalty' => function ($query) {
                    $query->with(['penalty']);
                },
                'timeline',
            ])->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            } 

            $candidate->resultForm3 = $candidate->schoolResult()->with(['subject' => function ($query) { 
                $query->where('form', '3');
            }])->get();

            $candidate->resultForm5 = $candidate->schoolResult()->with(['subject' => function ($query) { 
                $query->where('form', '5');
            }])->get();

            $candidate->resultForm6 = $candidate->schoolResult()->with(['subject' => function ($query) { 
                $query->where('form', '6');
            }])->get();

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }     
    }

    public function listTimeline(Request $request)
    {
        $candidateTimeline = CandidateTimeline::where('no_pengenalan', $request->noPengenalan)->orderBy('created_at', 'desc')->limit(10)->get();
        return view('maklumat_pemohon.pemohon.list_timeline', compact('candidateTimeline'));
    }

    public function storePersonal(Request $request) 
    {
        DB::beginTransaction();
        try {

            $candidate = Candidate::where('no_pengenalan', $request->personal_no_pengenalan)->first();

            $request->validate([
                'personal_no_pengenalan' => 'required|string|exists:candidate,no_pengenalan',
                'gender' => 'required|string|exists:ref_gender,code',
                'religion' => 'required|string|exists:ref_religion,code',
                'race' => 'required|string|exists:ref_race,code',
                'date_of_birth' => 'required',
                'marital_status' => 'required|required|exists:ref_marital_status,code',
                'phone_number' => 'required',
                'email' => 'required',
            ],[
                'personal_no_pengenalan.required' => 'Sila isikan no kad pengenalan',
                'personal_no_pengenalan.exists' => 'Rekod data no kad pengenalan tidak dijumpai',
                'gender.required' => 'Sila pilih jantina',
                'date_of_birth.required' => 'Sila isikan tarikh lahir',
            ]);

            $candidate->update([
                'no_pengenalan' => $request->personal_no_pengenalan,
                'ref_gender_code' => $request->gender,
                'ref_religion_code' => $request->religion,
                'ref_race_code' => $request->race,
                'date_of_birth' => $request->date_of_birth,
                'ref_marital_status_code' => $request->marital_status,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'updated_by' => auth()->user()->id,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->personal_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Tatatertib)',
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

    public function personalDetails(Request $request) 
    {
        DB::beginTransaction();
        try {

            $candidate = Candidate::where('no_pengenalan', $request->noPengenalan)->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            } 

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }  
    }

    public function storePenalty(Request $request) 
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'penalty_no_pengenalan' => 'required|string|exists:candidate,no_pengenalan',
                'penalty' => 'required|string|exists:ref_penalty,code',
                'penalty_duration' => 'required|integer',
                'penalty_type' => 'required',
                'penalty_start' => 'required',
                'penalty_end' => 'required',
            ],[
                'penalty_no_pengenalan.required' => 'Sila isikan no kad pengenalan',
                'penalty_no_pengenalan.exists' => 'Rekod data no kad pengenalan tidak dijumpai',
                'penalty.required' => 'Sila pilih tindakan tatatertib',
                'penalty_duration.required' => 'Sila isikan tempoh hukuman',
                'penalty_type.required' => 'Sila isikan jenis tempoh hukuman',
                'penalty_start.required' => 'Sila isikan tarikh mula hukuman',
                'penalty_end.required' => 'Sila isikan tarikh akhir hukuman',
            ]);

            $candidatePenalty = CandidatePenalty::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'ref_penalty_code' => $request->penalty,
                'duration' => $request->penalty_duration,
                'type' => $request->penalty_type,
                'date_start' => $request->penalty_start,
                'date_end' => $request->penalty_end,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'details' => 'Tambah Tatatertib',
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

    public function listPenalty(Request $request) 
    {
        $candidatePenalty = CandidatePenalty::where('no_pengenalan', $request->noPengenalan)->get();
        return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

}
