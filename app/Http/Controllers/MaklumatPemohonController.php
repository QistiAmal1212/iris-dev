<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\DepartmentMinistry;
use App\Models\Reference\Eligibility;
use App\Models\Reference\Gender;
use App\Models\Reference\GredMatapelajaran;
use App\Models\Reference\Institution;
use App\Models\Reference\MaritalStatus;
use App\Models\Reference\Penalty;
use App\Models\Reference\PeringkatPengajian;
use App\Models\Reference\PositionLevel;
use App\Models\Reference\Rank;
use App\Models\Reference\Race;
use App\Models\Reference\Religion;
use App\Models\Reference\State;
use App\Models\Reference\Skim;
use App\Models\Reference\Subject;
use App\Models\Reference\Specialization;
use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidateExperience;
use App\Models\Candidate\CandidateHigherEducation;
use App\Models\Candidate\CandidatePenalty;
use App\Models\Candidate\CandidateSchoolResult;
use App\Models\Candidate\CandidateTimeline;
use Carbon\Carbon;

class MaklumatPemohonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchPemohon ()
    {
        $departmentMinistries = DepartmentMinistry::orderBy('name', 'asc')->get();
        $eligibilities = Eligibility::all();
        $genders = Gender::all();
        $gredPmr = GredMatapelajaran::where('tkt', 3)->orderBy('susunan', 'asc')->get();
        $institutions = Institution::orderBy('type', 'asc')->orderBy('name', 'asc')->get();
        $maritalStatuses = MaritalStatus::all();
        $penalties = Penalty::all();
        $peringkatPengajian = PeringkatPengajian::all();
        $positionLevels = PositionLevel::orderBy('name', 'asc')->get();
        $races = Race::all();
        $ranks = Rank::all();
        $religions = Religion::all();
        $states = State::orderBy('name', 'asc')->get();
        $skims = Skim::orderBy('name', 'asc')->get();
        $specializations = Specialization::orderBy('name', 'asc')->get();
        $subjekPmr = Subject::where('form', 3)->orderBy('name', 'asc')->get();

        return view('maklumat_pemohon.carian_pemohon', compact('departmentMinistries', 'eligibilities', 'genders', 'gredPmr', 'institutions', 'maritalStatuses', 'penalties', 'peringkatPengajian', 'positionLevels', 'races', 'ranks', 'religions', 'states', 'skims', 'specializations', 'subjekPmr'));
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
                'license' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(expiry_date, '%d/%m/%Y') as expiryDate")
                    );
                }, 
                'oku', 
                'skim' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(register_date, '%d/%m/%Y') as registerDate"),
                        DB::raw("DATE_FORMAT(expiry_date, '%d/%m/%Y') as expiryDate")
                    );
                    $query->with(['skim', 'interviewCentre']);
                },
                'matriculation' => function ($query) {
                    $query->with(['course', 'college', 'subject']);
                },
                'skm' => function ($query) {
                    $query->with(['qualification']);
                },
                'higherEducation' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(tarikh_senat, '%d/%m/%Y') as tarikhSenat")
                    );
                    $query->with(['institution', 'eligibility', 'specialization']);
                },
                'professional' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(date, '%d/%m/%Y') as newDate")
                    );
                    $query->with(['specialization']);
                },
                'experience' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(date_appoint, '%d/%m/%Y') as dateAppoint"),
                        DB::raw("DATE_FORMAT(date_start, '%d/%m/%Y') as dateStart"),
                        DB::raw("DATE_FORMAT(date_verify, '%d/%m/%Y') as dateVerify"),
                    );
                },
                'psl' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(exam_date, '%d/%m/%Y') as examDate")
                    );
                    $query->with(['qualification']);
                },
                'armyPolice' => function ($query) {
                    $query->with(['rank']);
                },
                'language' => function ($query) {
                    $query->with(['language']);
                },
                'talent' => function ($query) {
                    $query->with(['talent']);
                },
                'penalty' => function ($query) {
                    $query->select(
                        '*', 
                        DB::raw("DATE_FORMAT(date_start, '%d/%m/%Y') as startDate"),
                        DB::raw("DATE_FORMAT(date_end, '%d/%m/%Y') as endDate")
                    );
                    $query->with(['penalty']);
                },
                'timeline',
            ])->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            } 

            $candidate->date_of_birth = Carbon::parse($candidate->date_of_birth)->format('d/m/Y');

            $candidate->pmr = $candidate->schoolResult()->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '3');
            })->get();

            //Cerfiticate Type Form 5 : 1 - SPM, 3 - SPMV, 5 - SVM
            $candidate->spm = $candidate->schoolResult()->where('certificate_type', 1)->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '5');
            })->get();

            $candidate->spmv = $candidate->schoolResult()->where('certificate_type', 3)->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '5');
            })->get();

            $candidate->svm = $candidate->schoolResult()->where('certificate_type', 5)->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '5');
            })->get();

            //Cerfiticate Type Form 6 : 1 - STPM, 2- STP, 3 - HSC, 4 - X Pakai, 5 - STAM
            $candidate->stpm = $candidate->schoolResult()->where('certificate_type', 1)->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '6');
            })->get();

            $candidate->stam = $candidate->schoolResult()->where('certificate_type', 5)->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '6');
            })->get();

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

    public function updatePersonal(Request $request) 
    {
        DB::beginTransaction();
        try {

            $candidate = Candidate::where('no_pengenalan', $request->personal_no_pengenalan)->first();

            $request->validate([
                'gender' => 'required|string|exists:ref_gender,code',
                'religion' => 'required|string|exists:ref_religion,code',
                'race' => 'required|string|exists:ref_race,code',
                'date_of_birth' => 'required',
                'marital_status' => 'required|required|exists:ref_marital_status,code',
                'phone_number' => 'required',
                'email' => 'required|email:rfc,dns',
            ],[
                'gender.required' => 'Sila pilih jantina',
                'gender.exists' => 'Tiada rekod data jantina yang dipilih',
                'religion.required' => 'Sila pilih agama',
                'religion.exists' => 'Tiada rekod data agama yang dipilih',
                'race.required' => 'Sila pilih keturunan',
                'race.exists' => 'Tiada rekod data keturunan yang dipilih',
                'date_of_birth.required' => 'Sila isikan tarikh lahir',
                'marital_status.required' => 'Sila pilih taraf perkahwinan',
                'marital_status.exists' => 'Tiada rekod data taraf perkahwinan yang dipilih',
                'phone_number.required' => 'Sila isikan no telefon',
                'email.required' => 'Sila isikan emel',
                'email.email' => 'Sila isikan emel yang sah',
            ]);

            $candidate->update([
                'ref_gender_code' => $request->gender,
                'ref_religion_code' => $request->religion,
                'ref_race_code' => $request->race,
                'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d'),
                'ref_marital_status_code' => $request->marital_status,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'updated_by' => auth()->user()->id,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->personal_no_pengenalan,
                'activity_type_id' => 4,
                'details' => 'Kemaskini Maklumat Peribadi (Peribadi)',
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

            $candidate->date_of_birth = Carbon::parse($candidate->date_of_birth)->format('d/m/Y');

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }  
    }

    public function updateAlamat(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Candidate::where('no_pengenalan', $request->alamat_no_pengenalan)->first();

            $request->validate([
                'permanent_address_1' => 'required|string',
                'permanent_address_2' => 'nullable|string',
                'permanent_address_3' => 'nullable|string',
                'permanent_poscode' => 'required|min:5|string',
                'permanent_city' => 'required|string',
                'permanent_state' => 'required|string|exists:ref_state,code',
                'address_1' => 'required|string',
                'address_2' => 'nullable|string',
                'address_3' => 'nullable|string',
                'poscode' => 'required|min:5|string',
                'city' => 'required|string',
                'state' => 'required|string|exists:ref_state,code',
            ],[
                'permanent_address_1.required' => 'Sila isi alamat tetap',
                'permanent_poscode.required' => 'Sila isi poskod alamat tetap',
                'permanent_poscode.min' => 'Poskod alamat tetap mestilah sekurang-kurangnya 5 aksara',
                'permanent_city.required' => 'Sila isi bandar alamat tetap',
                'permanent_state.required' => 'Sila pilih negeri alamat tetap',
                'permanent_state.exists' => 'Tiada rekod data negeri yang dipilih',
                'address_1.required' => 'Sila isi alamat surat menyurat',
                'poscode.required' => 'Sila isi poskod alamat surat menyurat',
                'poscode.min' => 'Poskod alamat surat menyurat mestilah sekurang-kurangnya 5 aksara',
                'city.required' => 'Sila isi bandar alamat surat menyurat',
                'state.required' => 'Sila pilih negeri alamat surat menyurat',
                'state.exists' => 'Tiada rekod data negeri yang dipilih',
            ]);

            $candidate->update([
                'permanent_address_1' => $request->permanent_address_1,
                'permanent_address_2' => $request->permanent_address_2,
                'permanent_address_3' => $request->permanent_address_3,
                'permanent_poscode' => $request->permanent_poscode,
                'permanent_city' => $request->permanent_city,
                'permanent_state' => $request->permanent_state,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'address_3' => $request->address_3,
                'poscode' => $request->poscode,
                'city' => $request->city,
                'state' => $request->state,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->alamat_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Alamat)',
                'activity_type_id' => 4,
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

    public function alamatDetails(Request $request)
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

    public function updateTempatLahir(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $candidate = Candidate::where('no_pengenalan', $request->tempat_lahir_no_pengenalan)->first();

            $request->validate([
                'place_of_birth' => 'required|string|exists:ref_state,code',
                'father_place_of_birth' => 'required|string|exists:ref_state,code',
                'mother_place_of_birth' => 'required|string|exists:ref_state,code',
            ],[
                'place_of_birth.required' => 'Sila pilih tempat lahir',
                'place_of_birth.exists' => 'Tiada rekod tempat lahir yang dipilih',
                'father_place_of_birth.required' => 'Sila pilih tempat lahir ayah',
                'father_place_of_birth.exists' => 'Tiada rekod tempat lahir ayah yang dipilih',
                'mother_place_of_birth.required' => 'Sila pilih tempat lahir ibu',
                'mother_place_of_birth.exists' => 'Tiada rekod tempat lahir ibu yang dipilih',
            ]);

            $candidate->update([
                'place_of_birth' => $request->place_of_birth,
                'father_place_of_birth' => $request->father_place_of_birth,
                'mother_place_of_birth' => $request->mother_place_of_birth,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->tempat_lahir_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Tempat Lahir)',
                'activity_type_id' => 4,
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

    public function tempatLahirDetails(Request $request)
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

    public function storePmr(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_pmr' => 'required|string|exists:ref_subject,code',
                'gred_pmr' => 'required|string|exists:ref_gred_matapelajaran,gred',
                'tahun_pmr' => 'required|string',
            ],[
                'subjek_pmr.required' => 'Sila pilih subjek pmr',
                'subjek_pmr.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_pmr.required' => 'Sila pilih gred pmr',
                'gred_pmr.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_pmr.required' => 'Sila pilih gred pmr',
                'tahun_pmr.exists' => 'Tiada rekod gred pmr yang dipilih',
            ]);

            CandidateSchoolResult::create([
                'no_pengenalan' => $request->pmr_no_pengenalan,
                'ref_subject_code' => $request->subjek_pmr,
                'grade' => $request->gred_pmr,
                'year' => $request->tahun_pmr,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->pmr_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (PT3/PMR/SRP)',
                'activity_type_id' => 3,
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

    public function listPmr(Request $request) 
    {
        DB::beginTransaction();
        try {

            $candidatePmr = CandidateSchoolResult::select(
                '*', 
                DB::raw("DATE_FORMAT(year, '%d/%m/%Y') as newYear"),
            )->where('no_pengenalan', $request->noPengenalan)->with('subject')->whereHas('subject', function ($query) { 
                $query->where('form', '3');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //} 

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePmr]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }  

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updatePengajianTinggi(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $candidate = CandidateHigherEducation::where('no_pengenalan', $request->pengajian_tinggi_no_pengenalan)->first();

            $request->validate([
                'peringkat_pengajian_tinggi' => 'required|string|exists:ref_peringkat_pengajian,id',
                'tahun_pengajian_tinggi' => 'required|string',
                'kelayakan_pengajian_tinggi' => 'required|string|exists:ref_eligibility,code',
                'cgpa_pengajian_tinggi' => 'required|string',
                'institusi_pengajian_tinggi' => 'required|string|exists:ref_institution,code',
                'nama_sijil_pengajian_tinggi' => 'required|string',
                'pengkhususan_pengajian_tinggi' => 'required|string|exists:ref_specialization,code',
                'fln_pengajian_tinggi' => 'required|integer|digits_between:1,2',
                'tarikh_senat_pengajian_tinggi' => 'required',
                'biasiswa_pengajian_tinggi' => 'required|boolean',
            ],[
                'peringkat_pengajian_tinggi.required' => 'Sila pilih peringkat pengajian tinggi',
                'peringkat_pengajian_tinggi.exists' => 'Tiada rekod peringkat pengajian tinggi yang dipilih',
                'tahun_pengajian_tinggi.required' => 'Sila pilih tahun pengajian tinggi',
                'kelayakan_pengajian_tinggi.required' => 'Sila pilih peringkat kelulusan pengajian tinggi',
                'kelayakan_pengajian_tinggi.exists' => 'Tiada rekod peringkat kelulusan pengajian tinggi yang dipilih',
                'cgpa_pengajian_tinggi.required' => 'Sila pilih cgpa pengajian tinggi',
                'institusi_pengajian_tinggi.required' => 'Sila pilih institusi pengajian tinggi',
                'institusi_pengajian_tinggi.exists' => 'Tiada rekod institusi pengajian tinggi yang dipilih',
                'nama_sijil_pengajian_tinggi.required' => 'Sila pilih nama sijil pengajian tinggi',
                'pengkhususan_pengajian_tinggi.required' => 'Sila pilih pengkhususan/bidang pengajian tinggi',
                'pengkhususan_pengajian_tinggi.exists' => 'Tiada rekod pengkhususan/bidang pengajian tinggi yang dipilih',
                'fln_pengajian_tinggi.required' => 'Sila pilih francais luar negara pengajian tinggi',
                'fln_pengajian_tinggi.digits_between' => 'Sila pilih Ya/Tidak sahaja untuk francais luar negara pengajian tinggi',
                'tarikh_senat_pengajian_tinggi.required' => 'Sila pilih tarikh senat pengajian tinggi',
                'biasiswa_pengajian_tinggi.required' => 'Sila pilih biasiswa pengajian tinggi',
                'biasiswa_pengajian_tinggi.boolean' => 'Sila pilih Ya/Tidak sahaja untuk biasiswa pengajian tinggi',
            ]);

            $candidate->update([
                'peringkat_pengajian' => $request->peringkat_pengajian_tinggi,
                'year' => $request->tahun_pengajian_tinggi,
                'ref_eligibility_code' => $request->kelayakan_pengajian_tinggi,
                'cgpa' => $request->cgpa_pengajian_tinggi,
                'ref_institution_code' => $request->institusi_pengajian_tinggi,
                'nama_sijil' => $request->nama_sijil_pengajian_tinggi,
                'ref_specialization_code' => $request->pengkhususan_pengajian_tinggi,
                'ins_fln' => $request->fln_pengajian_tinggi,
                'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_pengajian_tinggi)->format('Y-m-d'),
                'biasiswa' => $request->biasiswa_pengajian_tinggi,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->pengajian_tinggi_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (Pengajian Tinggi)',
                'activity_type_id' => 4,
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

    public function pengajianTinggiDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateHigherEducation = CandidateHigherEducation::select(
                '*', 
                DB::raw("DATE_FORMAT(tarikh_senat, '%d/%m/%Y') as tarikhSenat"),
            )->where('no_pengenalan', $request->noPengenalan)->first();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            // } 

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateHigherEducation]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }  
    }

    public function updateExperience(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $candidate = CandidateExperience::where('no_pengenalan', $request->experience_no_pengenalan)->first();

            $request->validate([
                'experience_appoint_date' => 'required',
                'experience_position_level' => 'required|string|exists:ref_position_level,code',
                'experience_skim' => 'required|string|exists:ref_skim,code',
                'experience_start_date' => 'required',
                'experience_verify_date' => 'required',
                'experience_department_ministry' => 'required|string|exists:ref_department_ministry,code',
                'experience_department_state' => 'required|string|exists:ref_state,code',
            ],[
                'experience_appoint_date.required' => 'Sila pilih tarikh lantikan pertama',
                'experience_position_level.required' => 'Sila pilih taraf jawatan',
                'experience_position_level.exists' => 'Tiada rekod taraf jawatan yang dipilih',
                'experience_skim.required' => 'Sila pilih skim perkhidmatan',
                'experience_skim.exists' => 'Tiada rekod skim perkhidmatan yang dipilih',
                'experience_start_date.required' => 'Sila pilih tarikh lantikan',
                'experience_verify_date.required' => 'Sila pilih tarikh pengesahan lantikan',
                'experience_department_ministry.required' => 'Sila pilih kementerian/jabatan',
                'experience_department_ministry.exists' => 'Tiada rekod kementerian/jabatan yang dipilih',
                'experience_department_state.required' => 'Sila pilih negeri kementerian/jabatan',
                'experience_department_state.exists' => 'Tiada rekod negeri kementerian/jabatan yang dipilih',
            ]);

            $candidate->update([
                'date_appoint' => Carbon::createFromFormat('d/m/Y', $request->experience_appoint_date)->format('Y-m-d'),
                'ref_position_level_code' => $request->experience_position_level,
                'ref_skim_code' => $request->experience_skim,
                'date_start' => Carbon::createFromFormat('d/m/Y', $request->experience_start_date)->format('Y-m-d'),
                'date_end' => Carbon::createFromFormat('d/m/Y', $request->experience_verify_date)->format('Y-m-d'),
                'ref_department_ministry_code' => $request->experience_department_ministry,
                'state_department' => $request->experience_department_state,
                
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->experience_no_pengenalan,
                'details' => 'Kemaskini Pegawai Berkhidmat (Maklumat PSB/PSL)',
                'activity_type_id' => 4,
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

    public function experienceDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateExperience = CandidateExperience::select(
                '*', 
                DB::raw("DATE_FORMAT(date_appoint, '%d/%m/%Y') as dateAppoint"),
                DB::raw("DATE_FORMAT(date_start, '%d/%m/%Y') as dateStart"),
                DB::raw("DATE_FORMAT(date_verify, '%d/%m/%Y') as dateVerify"),
            )->where('no_pengenalan', $request->noPengenalan)->first();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            // } 

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateExperience]);

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
                'date_start' => Carbon::createFromFormat('d/m/Y', $request->penalty_start)->format('Y-m-d'),
                'date_end' => Carbon::createFromFormat('d/m/Y', $request->penalty_end)->format('Y-m-d'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CandidateTimeline::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'details' => 'Tambah Tatatertib',
                'activity_type_id' => 3,
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
        DB::beginTransaction();
        try {

            $candidatePenalty = CandidatePenalty::select(
                '*', 
                DB::raw("DATE_FORMAT(date_start, '%d/%m/%Y') as startDate"),
                DB::raw("DATE_FORMAT(date_end, '%d/%m/%Y') as endDate")
            )->where('no_pengenalan', $request->noPengenalan)->with('penalty')->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //} 

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePenalty]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }  

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

}
