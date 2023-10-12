<?php

namespace App\Http\Controllers;

use App\Models\Calon\CalonBahasa;
use App\Models\Calon\CalonLesen;
use App\Models\Calon\CalonMatrikulasi;
use App\Models\Calon\CalonOku;
use App\Models\Calon\CalonPsl;
use App\Models\Reference\KodPelbagai;
use App\Models\Reference\Language;
use App\Models\Reference\MatriculationSubject;
use App\Models\Reference\Qualification;
use App\Models\Reference\Talent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\DepartmentMinistry;
use App\Models\Reference\Eligibility;
use App\Models\Reference\Gender;
use App\Models\Reference\GredMatapelajaran;
use App\Models\Reference\Institution;
use App\Models\Reference\InterviewCentre;
use App\Models\Reference\JenisBekasTenteraPolis;
use App\Models\Reference\JenisPerkhidmatan;
use App\Models\Reference\KumpulanSSM;
use App\Models\Reference\MaritalStatus;
use App\Models\Reference\Penalty;
use App\Models\Reference\PeringkatPengajian;
use App\Models\Reference\PositionLevel;
use App\Models\Reference\Rank;
use App\Models\Reference\Race;
use App\Models\Reference\Religion;
use App\Models\Reference\SalaryGrade;
use App\Models\Reference\State;
use App\Models\Reference\Skim;
use App\Models\Reference\Subject;
use App\Models\Reference\Specialization;
use App\Models\Calon\Calon;
use App\Models\Calon\CalonTenteraPolis;
use App\Models\Calon\CalonPengalaman;
use App\Models\Calon\CalonPengajianTinggi;
use App\Models\Calon\CalonTatatertib;
use App\Models\Calon\CalonKeputusanSekolah;
use App\Models\Calon\CalonSkm;
use App\Models\Calon\CalonBakat;
use App\Models\Calon\CalonGarisMasa;
use App\Models\Reference\Matriculation;
use App\Models\Reference\MatriculationCourse;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class MaklumatPemohonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchPemohon ()
    {
        $departmentMinistries = DepartmentMinistry::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $eligibilities = Eligibility::where('sah_yt', 'Y')->get();
        $genders = Gender::all();
        $gredPmr = GredMatapelajaran::where('tkt', 3)->orderBy('susunan', 'asc')->get();
        $gredSpm = GredMatapelajaran::where('tkt', 5)->orderBy('susunan', 'asc')->get();
        $gredSpmv = GredMatapelajaran::where('tkt', 5)->orderBy('susunan', 'asc')->get();
        $gredSvm = GredMatapelajaran::where('tkt', 5)->orderBy('susunan', 'asc')->get();
        $gredStpm = GredMatapelajaran::where('tkt', 6)->orderBy('susunan', 'asc')->get();
        $gredStam = GredMatapelajaran::where('tkt', 6)->orderBy('susunan', 'asc')->get();
        $institutions = Institution::where('sah_yt', 'Y')->orderBy('jenis_institusi', 'asc')->orderBy('diskripsi', 'asc')->get();
        $jenisBekasTenteraPolis = JenisBekasTenteraPolis::all();
        $jenisPerkhidmatan = JenisPerkhidmatan::all();
        $maritalStatuses = MaritalStatus::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $penalties = Penalty::all();
        $peringkatPengajian = PeringkatPengajian::all();
        $positionLevels = PositionLevel::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $races = Race::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $pusatTemuduga = InterviewCentre::where('sah_yt', 'Y')->get();
        $ranks = Rank::where('sah_yt', 'Y')->get();
        $religions = Religion::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $states = State::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $skims = Skim::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $specializations = Specialization::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $subjekPmr = Subject::where('sah_yt', 'Y')->where('tkt', 3)->orderBy('diskripsi', 'asc')->get();
        $subjekSpm = Subject::where('sah_yt', 'Y')->where('tkt', 5)->orderBy('diskripsi', 'asc')->get();
        $subjekSpmv = Subject::where('sah_yt', 'Y')->where('tkt', 5)->orderBy('diskripsi', 'asc')->get();
        $subjekSvm = Subject::where('sah_yt', 'Y')->where('tkt', 5)->orderBy('diskripsi', 'asc')->get();
        $subjekStpm = Subject::where('sah_yt', 'Y')->where('tkt', 6)->orderBy('diskripsi', 'asc')->get();
        $subjekStam = Subject::where('sah_yt', 'Y')->where('tkt', 6)->orderBy('diskripsi', 'asc')->get();
        $skmkod = Qualification::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $talentkod = Talent::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $kolejMatrikulasi = Matriculation::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $jurusanMatrikulasi = MatriculationCourse::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $subjekMatrikulasi =  MatriculationSubject::orderBy('name', 'asc')->get();
        $kategoriOKU = KodPelbagai::where('kategori', 'KECACATAN CALON')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $Bahasa = Language::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $kategoriPenguasaan = KodPelbagai::where('kategori', 'PENGUASAAN BAHASA')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $jenisPeperiksaan = Qualification::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $sektorPekerjaan = KodPelbagai::where('kategori', 'JENIS PERKHIDMATAN')->where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();
        $gredJawatan = SalaryGrade::where('sah_yt', 'Y')->orderBy('kod', 'asc')->get();
        $kumpulanPerkhidmatan = KumpulanSSM::where('sah_yt', 'Y')->orderBy('diskripsi', 'asc')->get();

        return view('maklumat_pemohon.carian_pemohon', compact('departmentMinistries', 'eligibilities', 'genders', 'gredPmr', 'institutions', 'jenisBekasTenteraPolis', 'jenisPerkhidmatan', 'maritalStatuses', 'penalties', 'peringkatPengajian', 'positionLevels', 'pusatTemuduga', 'races', 'ranks', 'religions', 'states', 'skims', 'specializations', 'subjekPmr', 'skmkod', 'talentkod', 'gredSpm', 'subjekSpm', 'gredSpmv', 'subjekSpmv', 'gredSvm', 'subjekSvm', 'gredStpm', 'subjekStpm', 'gredStam', 'subjekStam', 'kolejMatrikulasi', 'jurusanMatrikulasi', 'subjekMatrikulasi', 'kategoriOKU', 'Bahasa', 'kategoriPenguasaan', 'jenisPeperiksaan', 'sektorPekerjaan', 'gredJawatan', 'kumpulanPerkhidmatan'));
    }

    public function viewMaklumatPemohon(){
        return view('maklumat_pemohon.index_pemohon');
    }

    public function listCarian(Request $request){
        $nama = $request->search_nama;
        if (!isset($request->page)) {
            $count = DB::select("SELECT count(*) FROM calon WHERE nama_penuh ilike ?", ['%'.$nama.'%']);
            $total_pages = $count[0]->count/10;
            $total_pages = round($total_pages);
        } else {
            $total_pages = $request->total_pages;
        }


        $offset = $request->input('page', 1)*10 - 10;
        $currentPage = $request->input('page', 1);
        $previousPage = $currentPage-1;
        $nextPage = $currentPage+1;
        $sql = "SELECT no_kp_baru, nama_penuh FROM calon WHERE nama_penuh ilike ? OFFSET ? LIMIT ?";

        $candidate = DB::select($sql, ['%' . $nama . '%', $offset, 10]);

        return view('maklumat_pemohon.list', compact('total_pages', 'candidate', 'previousPage', 'nextPage', 'currentPage'));
    }

    public function getCandidateDetails(Request $request)
    {
        $no_ic = $request->no_ic;

        DB::beginTransaction();
        try {

            $candidate = Calon::where(function ($query) use ($no_ic) {
                $query->where('no_kp_baru', $no_ic);
            })
            ->with([
                'license',
                'oku',
                'skim' => function ($query) {
                    $query->with(['skim']);
                },
                'interviewCentre',
                'matriculation' => function ($query) {
                    $query->with(['course', 'college', 'subject']);
                },
                'skm' => function ($query) {
                    $query->with(['qualification']);
                },
                'higherEducation' => function ($query) {
                    $query->with(['institution', 'eligibility', 'specialization']);
                },
                'professional' => function ($query) {
                    $query->with(['qualification']);
                },
                'experience',
                'psl' => function ($query) {
                    $query->with(['qualification']);
                },
                'armyPolice' => function ($query) {
                    $query->with(['rank']);
                },
                'language' => function ($query) {
                    $query->with(['language', 'kategori']);
                },
                'talent' => function ($query) {
                    $query->with(['talent']);
                },
                'penalty' => function ($query) {
                    $query->with(['penalty']);
                },
                'timeline',
            ])->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            $candidate->tarikh_lahir = ($candidate->tarikh_lahir != null) ? Carbon::parse($candidate->tarikh_lahir)->format('d/m/Y') : null;

            if($candidate->license){
                //$candidate->license->tempoh_tamat = ($candidate->license->tempoh_tamat != null) ? Carbon::parse($candidate->license->tempoh_tamat)->format('d/m/Y') : null;
            }

            foreach($candidate->skim as $skim){
                $skim->tarikh_daftar = ($skim->tarikh_daftar != null) ? Carbon::parse($skim->tarikh_daftar)->format('d/m/Y') : null;
                $skim->tarikh_luput = ($skim->tarikh_luput != null) ? Carbon::parse($skim->tarikh_luput)->format('d/m/Y') : null;
            }

            if($candidate->higherEducation) {
                $candidate->higherEducation->tarikh_senat = ($candidate->higherEducation->tarikh_senat != null) ? Carbon::parse($candidate->higherEducation->tarikh_senat)->format('d/m/Y') : null;
            }

            foreach($candidate->professional as $professional){
                $professional->tarikh = ($professional->tarikh != null) ? Carbon::parse($professional->tarikh)->format('d/m/Y') : null;
            }

            if($candidate->experience){

                $candidate->experience->tarikh_lantik = ($candidate->experience->tarikh_lantik != null) ? Carbon::parse($candidate->experience->tarikh_lantik)->format('d/m/Y') : null;
                $candidate->experience->tarikh_mula = ($candidate->experience->tarikh_mula != null) ? Carbon::parse($candidate->experience->tarikh_mula)->format('d/m/Y') : null;
                $candidate->experience->tarikh_disahkan = ($candidate->experience->tarikh_disahkan != null) ? Carbon::parse($candidate->experience->tarikh_disahkan)->format('d/m/Y') : null;
                $candidate->experience->tarikh_tamat = ($candidate->experience->tarikh_tamat != null) ? Carbon::parse($candidate->experience->tarikh_tamat)->format('d/m/Y') : null;

            }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function listTimeline(Request $request)
    {
        $candidateTimeline = CalonGarisMasa::where('no_pengenalan', $request->noPengenalan)->orderBy('created_at', 'desc')->limit(10)->get();
        return view('maklumat_pemohon.pemohon.list_timeline', compact('candidateTimeline'));
    }

    public function updatePersonal(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->personal_no_pengenalan)->first();

            $request->validate([
                'gender' => 'required|string|exists:ruj_jantina,code',
                'religion' => 'required|string|exists:ruj_agama,kod',
                'race' => 'required|string|exists:ruj_keturunan,kod',
                'date_of_birth' => 'required',
                'marital_status' => 'required|required|exists:ruj_taraf_kahwin,kod',
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
                'jan_kod' => $request->gender,
                'agama' => $request->religion,
                'ket_kod' => $request->race,
                'tarikh_lahir' => Carbon::createFromFormat('d/m/Y', $request->date_of_birth)->format('Y-m-d'),
                'taraf_perkahwinan' => $request->marital_status,
                'e_mel' => $request->email,
                'no_tel' => $request->phone_number,
                'pengguna' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
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

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            $candidate->tarikh_lahir = Carbon::parse($candidate->tarikh_lahir)->format('d/m/Y');

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

            $candidate = Calon::where('no_pengenalan', $request->alamat_no_pengenalan)->first();

            $request->validate([
                'permanent_address_1' => 'required|string',
                'permanent_address_2' => 'nullable|string',
                'permanent_address_3' => 'nullable|string',
                'permanent_poscode' => 'required|min:5|string',
                'permanent_city' => 'required|string',
                'permanent_state' => 'required|string|exists:ruj_negeri,kod',
                'address_1' => 'required|string',
                'address_2' => 'nullable|string',
                'address_3' => 'nullable|string',
                'poscode' => 'required|min:5|string',
                'city' => 'required|string',
                'state' => 'required|string|exists:ruj_negeri,kod',
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
                'alamat_1_tetap' => $request->permanent_address_1,
                'alamat_2_tetap' => $request->permanent_address_2,
                'alamat_3_tetap' => $request->permanent_address_3,
                'poskod_tetap' => $request->permanent_poscode,
                'bandar_tetap' => $request->permanent_city,
                'tempat_tinggal_tetap' => $request->permanent_state,
                'alamat_1' => $request->address_1,
                'alamat_2' => $request->address_2,
                'alamat_3' => $request->address_3,
                'poskod' => $request->poscode,
                'bandar' => $request->city,
                'tempat_tinggal' => $request->state,
            ]);

            CalonGarisMasa::create([
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

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

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

            $candidate = Calon::where('no_pengenalan', $request->tempat_lahir_no_pengenalan)->first();

            $request->validate([
                'place_of_birth' => 'required|string|exists:ruj_negeri,kod',
                'father_place_of_birth' => 'required|string|exists:ruj_negeri,kod',
                'mother_place_of_birth' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'place_of_birth.required' => 'Sila pilih tempat lahir',
                'place_of_birth.exists' => 'Tiada rekod tempat lahir yang dipilih',
                'father_place_of_birth.required' => 'Sila pilih tempat lahir ayah',
                'father_place_of_birth.exists' => 'Tiada rekod tempat lahir ayah yang dipilih',
                'mother_place_of_birth.required' => 'Sila pilih tempat lahir ibu',
                'mother_place_of_birth.exists' => 'Tiada rekod tempat lahir ibu yang dipilih',
            ]);

            $candidate->update([
                'tempat_lahir' => $request->place_of_birth,
                'tempat_lahir_bapa' => $request->father_place_of_birth,
                'tempat_lahir_ibu' => $request->mother_place_of_birth,
            ]);

            CalonGarisMasa::create([
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

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

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

    public function updateLesenMemandu(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'license_type' => 'required|string',
                'license_expiry_date' => 'required|string',
                'license_blacklist_status' => 'required|string',
                'license_blacklist_details' => 'required|string',
            ],[
                'license_type.required' => 'Sila pilih jenis lesen',
                'license_expiry_date.required' => 'Sila pilih tarikh tamat tempoh',
                'license_blacklist_status.required' => 'Sila pilih senarai hitam status',
                'license_blacklist_details.required' => 'Sila pilih butiran senarai hitam',
            ]);

            $candidateLesen = CalonLesen::where('no_pengenalan', $request->lesen_memandu_no_pengenalan)->first();

            if($candidateLesen){
                CalonLesen::where('no_pengenalan',$request->lesen_memandu_no_pengenalan)->update([
                    'jenis_lesen' => $request->license_type,
                    //'tempoh_tamat' => Carbon::createFromFormat('d/m/Y', $request->license_expiry_date)->format('Y-m-d'),
                    'tempoh_tamat' => $request->license_expiry_date,
                    'status_senaraihitam' => $request->license_blacklist_status,
                    'msg_senaraihitam' => $request->license_blacklist_details,
                ]);
            }else{
                CalonLesen::create([
                    'no_pengenalan' => $request->lesen_memandu_no_pengenalan,
                    'jenis_lesen' => $request->license_type,
                    //'tempoh_tamat' => Carbon::createFromFormat('d/m/Y', $request->license_expiry_date)->format('Y-m-d'),
                    'tempoh_tamat' => $request->license_expiry_date,
                    'status_senaraihitam' => $request->license_blacklist_status,
                    'msg_senaraihitam' => $request->license_blacklist_details,
                ]);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $request->lesen_memandu_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (Lesen Memandu)',
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

    public function lesenMemanduDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)
            ->with([
                'license'
            ])->first();
            if(!$candidate) {
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            }

            //$candidate->license->tempoh_tamat = ($candidate->license->tempoh_tamat != null) ? Carbon::parse($candidate->license->tempoh_tamat)->format('d/m/Y') : null;

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidate]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function updateOKU(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'oku_registration_no' => 'required|string',
                'oku_status' => 'required|string',
                'oku_category' => 'required|string',
                'oku_sub' => 'required|string',
            ],[
                'oku_registration_no.required' => 'Sila pilih nombor pendaftaran',
                'oku_status.required' => 'Sila pilih tempat status',
                'oku_category.required' => 'Sila pilih kategori',
                'oku_sub.required' => 'Sila pilih sub-kategori',
            ]);

            $candidateOku = CalonOku::where('no_pengenalan', $request->oku_no_pengenalan)->first();

            if($candidateOku){
                CalonOku::where('no_pengenalan',$request->oku_no_pengenalan)->update([
                    'no_daftar_jkm' => $request->oku_registration_no,
                    'status_oku' => $request->oku_status,
                    'kategori_oku' => $request->oku_category,
                    'sub_oku' => $request->oku_sub,
                ]);
            }else{
                CalonOku::create([
                    'no_pengenalan' => $request->oku_no_pengenalan,
                    'no_daftar_jkm' => $request->oku_registration_no,
                    'status_oku' => $request->oku_status,
                    'kategori_oku' => $request->oku_category,
                    'sub_oku' => $request->oku_sub,
                ]);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $request->oku_no_pengenalan,
                'details' => 'Kemaskini Maklumat Peribadi (OKU)',
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

    public function OKUDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)
            ->with([
                'oku',
            ])->first();
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

    public function updatePusatTemuduga(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->pusat_temuduga_no_pengenalan)->first();

            $request->validate([
                'pusat_temuduga' => 'required|string|exists:ruj_pusat_temuduga,kod',
            ],[
                'pusat_temuduga.required' => 'Sila pilih pusat temuduga',
                'pusat_temuduga.exists' => 'Tiada rekod pusat temuduga yang dipilih',
            ]);

            $candidate->update([
                'pusat_temuduga' => $request->pusat_temuduga,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pusat_temuduga_no_pengenalan,
                'details' => 'Kemaskini Maklumat Skim (Pusat Temuduga)',
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

    public function pusatTemudugaDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = Calon::where('no_pengenalan', $request->noPengenalan)->first();

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
                'subjek_pmr' => 'required|string|exists:ruj_matapelajaran,code',
                'gred_pmr' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_pmr' => 'required|string',
            ],[
                'subjek_pmr.required' => 'Sila pilih subjek pmr',
                'subjek_pmr.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_pmr.required' => 'Sila pilih gred pmr',
                'gred_pmr.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_pmr.required' => 'Sila pilih gred pmr',
                'tahun_pmr.exists' => 'Tiada rekod gred pmr yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'no_pengenalan' => $request->pmr_no_pengenalan,
                'mpel_kod' => $request->subjek_pmr,
                'gred' => $request->gred_pmr,
                'tahun' => $request->tahun_pmr,
                'mpel_tkt' => 3,
                'jenis_sijil' => 1, // 1 = PMR
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
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

            $candidatePmr = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 3)->with('subjectForm3')->whereHas('subjectForm3', function ($query) {
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

    public function updatePmr(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_pmr' => 'required|string',
                'gred_pmr' => 'required|string',
                'tahun_pmr' => 'required|string',
            ],[
                'subjek_pmr.required' => 'Sila pilih subjek pmr',
                'gred_pmr.required' => 'Sila pilih gred pmr',
                'tahun_pmr.required' => 'Sila pilih gred pmr',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_pmr)->update([
                'mpel_kod' => $request->subjek_pmr,
                'gred' => $request->gred_pmr,
                'tahun' => $request->tahun_pmr,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->pmr_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (PT3/PMR/SRP)',
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

    public function deletePmr(Request $request){
        $pmr = CalonKeputusanSekolah::find($request-> idPmr);

        if (!$pmr) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $pmr->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSpm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spm' => 'required|string|exists:ruj_matapelajaran,code',
                'gred_spm' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spm' => 'required|string',
            ],[
                'subjek_spm.required' => 'Sila pilih subjek spm',
                'subjek_spm.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spm.required' => 'Sila pilih gred spm',
                'gred_spm.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spm.required' => 'Sila pilih gred spm',
                'tahun_spm.exists' => 'Tiada rekod gred spm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'no_pengenalan' => $request->spm_no_pengenalan,
                'mpel_kod' => $request->subjek_spm,
                'gred' => $request->gred_spm,
                'tahun' => $request->tahun_spm,
                'jenis_sijil' => 1,
                'mpel_tkt' => 5,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spm_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SPM)',
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

    public function listSpm(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateSpm = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 5)->where('jenis_sijil', 1)->with('subjectForm5')->whereHas('subjectForm5', function ($query) {
                $query->where('form', '5');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSpm]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateSpm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spm' => 'required|string',
                'gred_spm' => 'required|string',
                'tahun_spm' => 'required|string',
            ],[
                'subjek_spm.required' => 'Sila pilih subjek spm',
                'gred_spm.required' => 'Sila pilih gred spm',
                'tahun_spm.required' => 'Sila pilih gred spm',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_spm)->update([
                'mpel_kod' => $request->subjek_spm,
                'gred' => $request->gred_spm,
                'tahun' => $request->tahun_spm,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spm_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SPM)',
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

    public function deleteSpm(Request $request){
        $spm = CalonKeputusanSekolah::find($request-> idSpm);

        if (!$spm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $spm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSpmv(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spmv' => 'required|string|exists:ruj_matapelajaran,code',
                'gred_spmv' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_spmv' => 'required|string',
            ],[
                'subjek_spmv.required' => 'Sila pilih subjek spmv',
                'subjek_spmv.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_spmv.required' => 'Sila pilih gred spmv',
                'gred_spmv.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_spmv.required' => 'Sila pilih gred spmv',
                'tahun_spmv.exists' => 'Tiada rekod gred spmv yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'no_pengenalan' => $request->spmv_no_pengenalan,
                'mpel_kod' => $request->subjek_spmv,
                'gred' => $request->gred_spmv,
                'tahun' => $request->tahun_spmv,
                'jenis_sijil' => 3,
                'mpel_tkt'=> 5,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spmv_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SPMV)',
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

    public function listSpmv(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateSpmv = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 5)->where('jenis_sijil', 3)->with('subjectForm5')->whereHas('subjectForm5', function ($query) {
                $query->where('form', '5');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSpmv]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateSpmv(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_spmv' => 'required|string',
                'gred_spmv' => 'required|string',
                'tahun_spmv' => 'required|string',
            ],[
                'subjek_spmv.required' => 'Sila pilih subjek spmv',
                'gred_spmv.required' => 'Sila pilih gred spmv',
                'tahun_spmv.required' => 'Sila pilih gred spmv',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_spmv)->update([
                'mpel_kod' => $request->subjek_spmv,
                'gred' => $request->gred_spmv,
                'tahun' => $request->tahun_spmv,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->spmv_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SPMV)',
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

    public function deleteSpmv(Request $request){
        $spmv = CalonKeputusanSekolah::find($request-> idSpmv);

        if (!$spmv) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $spmv->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSvm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_svm' => 'required|string|exists:ruj_matapelajaran,code',
                'gred_svm' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_svm' => 'required|string',
            ],[
                'subjek_svm.required' => 'Sila pilih subjek svm',
                'subjek_svm.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_svm.required' => 'Sila pilih gred svm',
                'gred_svm.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_svm.required' => 'Sila pilih gred svm',
                'tahun_svm.exists' => 'Tiada rekod gred svm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'no_pengenalan' => $request->svm_no_pengenalan,
                'mpel_kod' => $request->subjek_svm,
                'gred' => $request->gred_svm,
                'tahun' => $request->tahun_svm,
                'jenis_sijil' => 5,
                'mpel_tkt'=> 5,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->svm_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SVM)',
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

    public function listSvm(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateSvm = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 5)->where('jenis_sijil', 5)->with('subjectForm5')->whereHas('subjectForm5', function ($query) {
                $query->where('form', '5');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSvm]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateSvm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_svm' => 'required|string',
                'gred_svm' => 'required|string',
                'tahun_svm' => 'required|string',
            ],[
                'subjek_svm.required' => 'Sila pilih subjek svm',
                'gred_svm.required' => 'Sila pilih gred svm',
                'tahun_svm.required' => 'Sila pilih gred svm',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_svm)->update([
                'mpel_kod' => $request->subjek_svm,
                'gred' => $request->gred_svm,
                'tahun' => $request->tahun_svm,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->svm_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SVM)',
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

    public function deleteSvm(Request $request){
        $svm = CalonKeputusanSekolah::find($request-> idSvm);

        if (!$svm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $svm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeStpm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stpm' => 'required|string|exists:ruj_matapelajaran,code',
                'gred_stpm' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stpm' => 'required|string',
            ],[
                'subjek_stpm.required' => 'Sila pilih subjek stpm',
                'subjek_stpm.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stpm.required' => 'Sila pilih gred stpm',
                'gred_stpm.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stpm.required' => 'Sila pilih gred stpm',
                'tahun_stpm.exists' => 'Tiada rekod gred stpm yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'no_pengenalan' => $request->stpm_no_pengenalan,
                'mpel_kod' => $request->subjek_stpm,
                'gred' => $request->gred_stpm,
                'tahun' => $request->tahun_stpm,
                'jenis_sijil' => 1,
                'mpel_tkt'=> 6,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stpm_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (STPM)',
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

    public function listStpm(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateStpm = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 6)->where('jenis_sijil', 1)->with('subjectForm6')->whereHas('subjectForm6', function ($query) {
                $query->where('form', '6');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateStpm]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateStpm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stpm' => 'required|string',
                'gred_stpm' => 'required|string',
                'tahun_stpm' => 'required|string',
            ],[
                'subjek_stpm.required' => 'Sila pilih subjek stpm',
                'gred_stpm.required' => 'Sila pilih gred stpm',
                'tahun_stpm.required' => 'Sila pilih gred stpm',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_stpm)->update([
                'mpel_kod' => $request->subjek_stpm,
                'gred' => $request->gred_stpm,
                'tahun' => $request->tahun_stpm,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stpm_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (STPM)',
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

    public function deleteStpm(Request $request){
        $stpm = CalonKeputusanSekolah::find($request-> idStpm);

        if (!$stpm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $stpm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeStam(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stam' => 'required|string|exists:ruj_matapelajaran,code',
                'gred_stam' => 'required|string|exists:ruj_gred_matapelajaran,gred',
                'tahun_stam' => 'required|string',
            ],[
                'subjek_stam.required' => 'Sila pilih subjek stam',
                'subjek_stam.exists' => 'Tiada rekod subjek yang dipilih',
                'gred_stam.required' => 'Sila pilih gred stam',
                'gred_stam.exists' => 'Tiada rekod gred yang dipilih',
                'tahun_stam.required' => 'Sila pilih gred stam',
                'tahun_stam.exists' => 'Tiada rekod gred stam yang dipilih',
            ]);

            CalonKeputusanSekolah::create([
                'no_pengenalan' => $request->stam_no_pengenalan,
                'mpel_kod' => $request->subjek_stam,
                'gred' => $request->gred_stam,
                'tahun' => $request->tahun_stam,
                'jenis_sijil' => 5,
                'mpel_tkt'=> 6,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stam_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (STAM)',
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

    public function listStam(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateStam = CalonKeputusanSekolah::where('no_pengenalan', $request->noPengenalan)->where('mpel_tkt', 6)->where('jenis_sijil', 5)->with('subjectForm6')->whereHas('subjectForm6', function ($query) {
                $query->where('form', '6');
            })->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateStam]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateStam(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'subjek_stam' => 'required|string',
                'gred_stam' => 'required|string',
                'tahun_stam' => 'required|string',
            ],[
                'subjek_stam.required' => 'Sila pilih subjek stam',
                'gred_stam.required' => 'Sila pilih gred stam',
                'tahun_stam.required' => 'Sila pilih gred stam',
            ]);

            CalonKeputusanSekolah::where('id',$request->id_stam)->update([
                'mpel_kod' => $request->subjek_stam,
                'gred' => $request->gred_stam,
                'tahun' => $request->tahun_stam,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->stam_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (STAM)',
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

    public function deleteStam(Request $request){
        $stam = CalonKeputusanSekolah::find($request-> idStam);

        if (!$stam) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $stam->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeMatrikulasi(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'kolej_matrikulasi' => 'required|string',
                'jurusan_matrikulasi' => 'required|string',
                'matrik_matrikulasi' => 'required|string',
                'sesi_matrikulasi' => 'required|string',
                'semester_matrikulasi' => 'required|string',
                'subjek_matrikulasi' => 'required|string',
                'gred_matrikulasi' => 'required|string',
                'pngk_matrikulasi' => 'required|string',
            ],[
                'kolej_matrikulasi.required' => 'Sila pilih kolej matrikulasi',
                'jurusan_matrikulasi.required' => 'Sila pilih jurusan matrikulasi',
                'matrik_matrikulasi.required' => 'Sila isikan nombor matrik matrikulasi',
                'sesi_matrikulasi.required' => 'Sila isikan sesi matrikulasi',
                'semester_matrikulasi.required' => 'Sila isikan semester matrikulasi',
                'subjek_matrikulasi.required' => 'Sila pilih subjek matrikulasi',
                'gred_matrikulasi.required' => 'Sila isikan gred matrikulasi',
                'pngk_matrikulasi.required' => 'Sila isikan pngk matrikulasi',
            ]);

            CalonMatrikulasi::create([
                'no_pengenalan' => $request->matrikulasi_no_pengenalan,
                'no_matrik' => $request->matrik_matrikulasi,
                'jurusan' => $request->jurusan_matrikulasi,
                'sesi' => $request->sesi_matrikulasi,
                'semester' => $request->semester_matrikulasi,
                'kolej' => $request->kolej_matrikulasi,
                'kod_subjek' => $request->subjek_matrikulasi,
                'gred' => $request->gred_matrikulasi,
                'pngk' => $request->pngk_matrikulasi,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->matrikulasi_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (Matrikulasi)',
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

    public function listMatrikulasi(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateMatrikulasi = CalonMatrikulasi::where('no_pengenalan', $request->noPengenalan)->with(['course', 'college', 'subject'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateMatrikulasi]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateMatrikulasi(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'kolej_matrikulasi' => 'required|string',
                'jurusan_matrikulasi' => 'required|string',
                'matrik_matrikulasi' => 'required|string',
                'sesi_matrikulasi' => 'required|string',
                'semester_matrikulasi' => 'required|string',
                'subjek_matrikulasi' => 'required|string',
                'gred_matrikulasi' => 'required|string',
                'pngk_matrikulasi' => 'required|string',
            ],[
                'kolej_matrikulasi.required' => 'Sila pilih kolej matrikulasi',
                'jurusan_matrikulasi.required' => 'Sila pilih jurusan matrikulasi',
                'matrik_matrikulasi.required' => 'Sila isikan nombor matrik matrikulasi',
                'sesi_matrikulasi.required' => 'Sila isikan sesi matrikulasi',
                'semester_matrikulasi.required' => 'Sila isikan semester matrikulasi',
                'subjek_matrikulasi.required' => 'Sila pilih subjek matrikulasi',
                'gred_matrikulasi.required' => 'Sila isikan gred matrikulasi',
                'pngk_matrikulasi.required' => 'Sila isikan pngk matrikulasi',
            ]);

            CalonMatrikulasi::where('id',$request->id_matrikulasi)->update([
                'no_matrik' => $request->matrik_matrikulasi,
                'jurusan' => $request->jurusan_matrikulasi,
                'sesi' => $request->sesi_matrikulasi,
                'semester' => $request->semester_matrikulasi,
                'kolej' => $request->kolej_matrikulasi,
                'kod_subjek' => $request->subjek_matrikulasi,
                'gred' => $request->gred_matrikulasi,
                'pngk' => $request->pngk_matrikulasi,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->matrikulasi_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (Matrikulasi)',
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

    public function deleteMatrikulasi(Request $request){
        $smatrikulasi = CalonMatrikulasi::find($request-> idMatrikulasi);

        if (!$smatrikulasi) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $smatrikulasi->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeSkm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'tahun_skm' => 'required|string',
                'nama_skm' => 'required|string',
            ],[
                'tahun_skm.required' => 'Sila isi tahun kelulusan',
                'nama_skm.required' => 'Sila pilih kelulusan',
            ]);

            CalonSkm::create([
                'no_pengenalan' => $request->skm_no_pengenalan,
                'kod_ruj_kelulusan' => $request->nama_skm,
                'tahun_lulus' => $request->tahun_skm,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->skm_no_pengenalan,
                'details' => 'Tambah Maklumat Akademik (SKM)',
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

    public function listSkm(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateSkm = CalonSkm::where('no_pengenalan', $request->noPengenalan)->with(['qualification'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateSkm]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateSkm(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'tahun_skm' => 'required|string',
                'nama_skm' => 'required|string',
            ],[
                'tahun_skm.required' => 'Sila isi tahun kelulusan',
                'nama_skm.required' => 'Sila pilih kelulusan',
            ]);

            CalonSkm::where('id',$request->id_skm)->update([
                'kod_ruj_kelulusan' => $request->nama_skm,
                'tahun_lulus' => $request->tahun_skm,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->skm_no_pengenalan,
                'details' => 'Kemaskini Maklumat Akademik (SKM)',
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

    public function deleteSkm(Request $request){
        $skm = CalonSkm::find($request-> idSkm);

        if (!$skm) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $skm->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeBahasa(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bahasa' => 'required|string',
                'penguasaan_bahasa' => 'required|string',
            ],[
                'nama_bahasa.required' => 'Sila pilih bahasa',
                'penguasaan_bahasa.required' => 'Sila pilih penguasaan',

            ]);

            CalonBahasa::create([
                'no_pengenalan' => $request->bahasa_no_pengenalan,
                'jenis_bahasa' => $request->nama_bahasa,
                'penguasaan' => $request->penguasaan_bahasa,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bahasa_no_pengenalan,
                'details' => 'Tambah Maklumat Tambahan (Bahasa)',
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

    public function listBahasa(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateBahasa = CalonBahasa::select(
            )->where('no_pengenalan', $request->noPengenalan)->with(['language', 'kategori'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateBahasa]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateBahasa(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bahasa' => 'required|string',
                'penguasaan_bahasa' => 'required|string',
            ],[
                'nama_bahasa.required' => 'Sila pilih bahasa',
                'penguasaan_bahasa.required' => 'Sila pilih penguasaan',

            ]);

            CalonBahasa::where('id',$request->id_bahasa)->update([
                'jenis_bahasa' => $request->nama_bahasa,
                'penguasaan' => $request->penguasaan_bahasa,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bahasa_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tamabahan (Bahasa)',
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

    public function deleteBahasa(Request $request){
        $bahasa = CalonBahasa::find($request-> idBahasa);

        if (!$bahasa) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $bahasa->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function storeBakat(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bakat' => 'required|string',
            ],[
                'nama_bakat.required' => 'Sila pilih kelulusan',
            ]);

            CalonBakat::create([
                'no_pengenalan' => $request->bakat_no_pengenalan,
                'bakat' => $request->nama_bakat,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bakat_no_pengenalan,
                'details' => 'Tambah Maklumat Tambahan (Bakat)',
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

    public function listBakat(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidateBakat = CalonBakat::select(
            )->where('no_pengenalan', $request->noPengenalan)->with(['talent'])->get();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateBakat]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updateBakat(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'nama_bakat' => 'required|string',
            ],[
                'nama_bakat.required' => 'Sila pilih kelulusan',
            ]);

            CalonBakat::where('id',$request->id_bakat)->update([
                'bakat' => $request->nama_bakat,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->bakat_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tamabahan (Bakat)',
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

    public function deleteBakat(Request $request){
        $bakat = CalonBakat::find($request-> idBakat);

        if (!$bakat) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $bakat->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function updatePengajianTinggi(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = CalonPengajianTinggi::where('no_pengenalan', $request->pengajian_tinggi_no_pengenalan)->first();

            $request->validate([
                'peringkat_pengajian_tinggi' => 'required|string|exists:ruj_peringkat_pengajian,id',
                'tahun_pengajian_tinggi' => 'required|string',
                'kelayakan_pengajian_tinggi' => 'required|string|exists:ruj_kelayakan,code',
                'cgpa_pengajian_tinggi' => 'required|string',
                'institusi_pengajian_tinggi' => 'required|string|exists:ruj_institusi,code',
                'nama_sijil_pengajian_tinggi' => 'required|string',
                'pengkhususan_pengajian_tinggi' => 'required|string|exists:ruj_pengkhususan,code',
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

            if(!$candidate){
                CalonPengajianTinggi::create([
                    'no_pengenalan' => $request->pengajian_tinggi_no_pengenalan,
                    'peringkat_pengajian' => $request->peringkat_pengajian_tinggi,
                    'tahun_lulus' => $request->tahun_pengajian_tinggi,
                    'kod_ruj_kelayakan' => $request->kelayakan_pengajian_tinggi,
                    'cgpa' => $request->cgpa_pengajian_tinggi,
                    'kod_ruj_institusi' => $request->institusi_pengajian_tinggi,
                    'nama_sijil' => $request->nama_sijil_pengajian_tinggi,
                    'kod_ruj_pengkhususan' => $request->pengkhususan_pengajian_tinggi,
                    'ins_fln' => $request->fln_pengajian_tinggi,
                    'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_pengajian_tinggi)->format('Y-m-d'),
                    'biasiswa' => $request->biasiswa_pengajian_tinggi,
                ]);
            } else{
                $candidate->update([
                    'peringkat_pengajian' => $request->peringkat_pengajian_tinggi,
                    'tahun_lulus' => $request->tahun_pengajian_tinggi,
                    'kod_ruj_kelayakan' => $request->kelayakan_pengajian_tinggi,
                    'cgpa' => $request->cgpa_pengajian_tinggi,
                    'kod_ruj_institusi' => $request->institusi_pengajian_tinggi,
                    'nama_sijil' => $request->nama_sijil_pengajian_tinggi,
                    'kod_ruj_pengkhususan' => $request->pengkhususan_pengajian_tinggi,
                    'ins_fln' => $request->fln_pengajian_tinggi,
                    'tarikh_senat' => Carbon::createFromFormat('d/m/Y', $request->tarikh_senat_pengajian_tinggi)->format('Y-m-d'),
                    'biasiswa' => $request->biasiswa_pengajian_tinggi,
                ]);
            }

            CalonGarisMasa::create([
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

            $candidateHigherEducation = CalonPengajianTinggi::where('no_pengenalan', $request->noPengenalan)->first();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);

            $candidateHigherEducation->tarikh_senat = ($candidateHigherEducation->tarikh_senat != null) ? Carbon::parse($candidateHigherEducation->tarikh_senat)->format('d/m/Y') : null;
            // }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateHigherEducation]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }
    }

    public function storePsl(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'jenis_peperiksaan' => 'required|string',
                'tarikh_peperiksaan' => 'required|string',
            ],[
                'jenis_peperiksaan.required' => 'Sila pilih jenis peperiksaan',
                'tarikh_peperiksaan.required' => 'Sila pilih tarikh peperiksaan',

            ]);

            CalonPsl::create([
                'no_pengenalan' => $request->psl_no_pengenalan,
                'kod_ruj_kelulusan' => $request->jenis_peperiksaan,
                'tarikh_exam' => Carbon::createFromFormat('d/m/Y', $request->tarikh_peperiksaan)->format('Y-m-d'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->psl_no_pengenalan,
                'details' => 'Tambah Maklumat Pegawai Berkhidmat (PSL)',
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

    public function listPsl(Request $request)
    {
        DB::beginTransaction();
        try {
            $candidatePsl = CalonPsl::where('no_pengenalan', $request->noPengenalan)->with(['qualification'])->get();

            foreach($candidatePsl as $psl){
                $psl->tarikh_exam = ($psl->tarikh_exam != null) ? Carbon::parse($psl->tarikh_exam)->format('d/m/Y') : null;
            }

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            //}

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidatePsl]);

        } catch (\Throwable $e) {

            //DB::rollback();
            return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => $e->getMessage()], 404);
        }

        //return view('maklumat_pemohon.pemohon.maklumat_tatatertib.list_penalty', compact('candidatePenalty'));
    }

    public function updatePsl(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'jenis_peperiksaan' => 'required|string',
                'tarikh_peperiksaan' => 'required|string',
            ],[
                'jenis_peperiksaan.required' => 'Sila pilih jenis peperiksaan',
                'tarikh_peperiksaan.required' => 'Sila pilih tarikh peperiksaan',

            ]);

            CalonPsl::where('id',$request->id_psl)->update([
                'kod_ruj_kelulusan' => $request->jenis_peperiksaan,
                'tarikh_exam' => Carbon::createFromFormat('d/m/Y', $request->tarikh_peperiksaan)->format('Y-m-d'),
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->psl_no_pengenalan,
                'details' => 'Kemaskini Maklumat Pegawai Berkhidmat (PSL)',
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

    public function deletePsl(Request $request){
        $psl = CalonPsl::find($request-> idPsl);

        if (!$psl) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $psl->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function updateExperience(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = CalonPengalaman::where('no_pengenalan', $request->experience_no_pengenalan)->first();

            $request->validate([
                'experience_job_sector' => 'required|string',
                'experience_appoint_date' => 'required',
                'experience_position_level' => 'required|string|exists:ruj_taraf_jawatan,code',
                'experience_skim' => 'required|string|exists:ruj_skim,code',
                'experience_service_group' => 'required|string|exists:ruj_kumpulan_ssm,kod',
                'experience_position_grade' => 'required|string|exists:ruj_gred_gaji_hdr,code',
                'experience_start_date' => 'required',
                'experience_verify_date' => 'required',
                'experience_department_ministry' => 'required|string|exists:ruj_kem_jabatan,kod',
                'experience_department_state' => 'required|string|exists:ruj_negeri,kod',
            ],[
                'experience_job_sector' => 'Sila pilih jenis perkhidmatan',
                'experience_appoint_date.required' => 'Sila pilih tarikh lantikan pertama',
                'experience_position_level.required' => 'Sila pilih taraf jawatan',
                'experience_position_level.exists' => 'Tiada rekod taraf jawatan yang dipilih',
                'experience_skim.required' => 'Sila pilih skim perkhidmatan',
                'experience_skim.exists' => 'Tiada rekod skim perkhidmatan yang dipilih',
                'experience_service_group.required' => 'Sila pilih kumpulan perkhidmatan',
                'experience_service_group.exists' => 'Tiada rekod kumpulan perkhidmatan yang dipilih',
                'experience_position_grade.required' => 'Sila pilih gred jawatan',
                'experience_position_grade.exists' => 'Tiada rekod gred jawatan yang dipilih',
                'experience_start_date.required' => 'Sila pilih tarikh lantikan',
                'experience_verify_date.required' => 'Sila pilih tarikh pengesahan lantikan',
                'experience_department_ministry.required' => 'Sila pilih kementerian/jabatan',
                'experience_department_ministry.exists' => 'Tiada rekod kementerian/jabatan yang dipilih',
                'experience_department_state.required' => 'Sila pilih negeri kementerian/jabatan',
                'experience_department_state.exists' => 'Tiada rekod negeri kementerian/jabatan yang dipilih',
            ]);

            //Check if JENIS_PERKHIDMATAN kod from ruj_kod_pelbagai exists
            $existsJenisPerkhidmatan = KodPelbagai::where('sah_yt', 'Y')->where('kategori', 'JENIS PERKHIDMATAN')->where('kod', $request->experience_job_sector)->first();
            if(!$existsJenisPerkhidmatan){
                return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => 'Tiada rekod jenis perkhidmatan yang dipilih'], 404);
            }

            if(!$candidate){
                CalonPengalaman::create([
                    'no_pengenalan' => $request->experience_no_pengenalan,
                    'sektor_pekerjaan', $request->experience_job_sector,
                    'tarikh_lantik' => Carbon::createFromFormat('d/m/Y', $request->experience_start_date)->format('Y-m-d'),
                    'taraf_jawatan' => $request->experience_position_level,
                    'kod_ruj_skim' => $request->experience_skim,
                    'kump_pkhidmat' => $request->experience_service_group,
                    'kod_ruj_gred_gaji' => $request->experience_position_grade,
                    'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->experience_appoint_date)->format('Y-m-d'),
                    'tarikh_disahkan' => Carbon::createFromFormat('d/m/Y', $request->experience_verify_date)->format('Y-m-d'),
                    'ruj_kem_jabatan' => $request->experience_department_ministry,
                    'negeri_jabatan' => $request->experience_department_state,

                ]);
            } else {
                $candidate->update([
                    'sektor_pekerjaan' => $request->experience_job_sector,
                    'tarikh_lantik' => Carbon::createFromFormat('d/m/Y', $request->experience_start_date)->format('Y-m-d'),
                    'taraf_jawatan' => $request->experience_position_level,
                    'kod_ruj_skim' => $request->experience_skim,
                    'kump_pkhidmat' => $request->experience_service_group,
                    'kod_ruj_gred_gaji' => $request->experience_position_grade,
                    'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->experience_appoint_date)->format('Y-m-d'),
                    'tarikh_disahkan' => Carbon::createFromFormat('d/m/Y', $request->experience_verify_date)->format('Y-m-d'),
                    'ruj_kem_jabatan' => $request->experience_department_ministry,
                    'negeri_jabatan' => $request->experience_department_state,

                ]);
            }

            CalonGarisMasa::create([
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

            $candidateExperience = CalonPengalaman::where('no_pengenalan', $request->noPengenalan)->first();

            $candidateExperience->tarikh_lantik = ($candidateExperience->tarikh_lantik != null) ? Carbon::parse($candidateExperience->tarikh_lantik)->format('d/m/Y') : null;
            $candidateExperience->tarikh_mula = ($candidateExperience->tarikh_mula != null) ? Carbon::parse($candidateExperience->tarikh_mula)->format('d/m/Y') : null;
            $candidateExperience->tarikh_disahkan = ($candidateExperience->tarikh_disahkan != null) ? Carbon::parse($candidateExperience->tarikh_disahkan)->format('d/m/Y') : null;
            $candidateExperience->tarikh_tamat = ($candidateExperience->tarikh_tamat != null) ? Carbon::parse($candidateExperience->tarikh_tamat)->format('d/m/Y') : null;


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

    public function updateTenteraPolis(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidate = CalonTenteraPolis::where('no_pengenalan', $request->tentera_polis_no_pengenalan)->first();

            $request->validate([
                'jenis_perkhidmatan_tentera_polis' => 'required|string|exists:ruj_jenis_perkhidmatan,id',
                'pangkat_tentera_polis' => 'required|string|exists:ruj_pangkat,code',
                'jenis_bekas_tentera_polis' => 'required|string|exists:ruj_jenis_bekas_tentera_polis,code',
            ],[
                'jenis_perkhidmatan_tentera_polis.required' => 'Sila pilih jenis penamatan perkhidmatan',
                'jenis_perkhidmatan_tentera_polis.exists' => 'Tiada rekod jenis penamatan perkhidmatan yang dipilih',
                'pangkat_tentera_polis.required' => 'Sila pilih pangkat dalam tentera',
                'pangkat_tentera_polis.exists' => 'Tiada rekod pangkat dalam tentera yang dipilih',
                'jenis_bekas_tentera_polis.required' => 'Sila pilih kategori',
                'jenis_bekas_tentera_polis.exists' => 'Tiada rekod kategori yang dipilih',
            ]);

            if(!$candidate){
                CalonTenteraPolis::create([
                    'no_pengenalan' =>$request->tentera_polis_no_pengenalan,
                    'jenis_pkhidmat' => $request->jenis_perkhidmatan_tentera_polis,
                    'pangkat_tentera_polis' => $request->pangkat_tentera_polis,
                    'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis,
                ]);
            } else {
                $candidate->update([
                    'jenis_pkhidmat' => $request->jenis_perkhidmatan_tentera_polis,
                    'pangkat_tentera_polis' => $request->pangkat_tentera_polis,
                    'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis,
                ]);
            }

            CalonGarisMasa::create([
                'no_pengenalan' => $request->tentera_polis_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tambahan (Maklumat Bekas Tentera)',
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

    public function tenteraPolisDetails(Request $request)
    {
        DB::beginTransaction();
        try {

            $candidateArmyPolice = CalonTenteraPolis::where('no_pengenalan', $request->noPengenalan)->first();

            // if(!$candidate) {
            //     return response()->json(['title' => 'Gagal', 'status' => 'error', 'detail' => "Data tidak dijumpai"], 404);
            // }

            //DB::commit();
            return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $candidateArmyPolice]);

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
                'penalty_no_pengenalan' => 'required|string|exists:calon,no_pengenalan',
                'penalty' => 'required|string|exists:ruj_tatatertib,code',
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

            $candidatePenalty = CalonTatatertib::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'kod_ruj_penalti' => $request->penalty,
                'tempoh' => $request->penalty_duration,
                'jenis' => $request->penalty_type,
                'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->penalty_start)->format('Y-m-d'),
                'tarikh_tamat' => Carbon::createFromFormat('d/m/Y', $request->penalty_end)->format('Y-m-d'),
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);

            CalonGarisMasa::create([
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

            $candidatePenalty = CalonTatatertib::where('no_pengenalan', $request->noPengenalan)->with('penalty')->get();

            foreach($candidatePenalty as $penalty){
                $penalty->tarikh_mula = ($penalty->tarikh_mula != null) ? Carbon::parse($penalty->tarikh_mula)->format('d/m/Y') : null;
                $penalty->tarikh_tamat = ($penalty->tarikh_tamat != null) ? Carbon::parse($penalty->tarikh_tamat)->format('d/m/Y') : null;
            }

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

    public function updatePenalty(Request $request)
    {
        DB::beginTransaction();
        try {

            $request->validate([
                'penalty_no_pengenalan' => 'required|string',
                'penalty' => 'required|string',
                'penalty_duration' => 'required|integer',
                'penalty_type' => 'required',
                'penalty_start' => 'required',
                'penalty_end' => 'required',
            ],[
                'penalty_no_pengenalan.required' => 'Sila isikan no kad pengenalan',
                'penalty.required' => 'Sila pilih tindakan tatatertib',
                'penalty_duration.required' => 'Sila isikan tempoh hukuman',
                'penalty_type.required' => 'Sila isikan jenis tempoh hukuman',
                'penalty_start.required' => 'Sila isikan tarikh mula hukuman',
                'penalty_end.required' => 'Sila isikan tarikh akhir hukuman',
            ]);

            CalonTatatertib::where('id',$request->id_penalty)->update([
                'kod_ruj_penalti' => $request->penalty,
                'tempoh' => $request->penalty_duration,
                'jenis' => $request->penalty_type,
                'tarikh_mula' => Carbon::createFromFormat('d/m/Y', $request->penalty_start)->format('Y-m-d'),
                'tarikh_tamat' => Carbon::createFromFormat('d/m/Y', $request->penalty_end)->format('Y-m-d'),
            ]);

            CalonGarisMasa::create([
                'no_pengenalan' => $request->penalty_no_pengenalan,
                'details' => 'Kemaskini Maklumat Tatatertib',
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

    public function deletePenalty(Request $request){
        $penalty = CalonTatatertib::find($request-> idPenalty);

        if (!$penalty) {
            return response()->json(['message' => 'Record not found'], 404);
        }
        $penalty->delete();

        return response()->json(['message' => 'Record deleted successfully'], 200);
    }

    public function calculatePenalty(Request $request)
    {
        $duration = $request->duration;
        $type = $request->type;
        $start = $request->start;

        if($type == 'Tahun'){
            $end = Carbon::createFromFormat('d/m/Y', $start)->addYears($duration)->format('d/m/Y');
        } else if($type == 'Bulan'){
            $end = Carbon::createFromFormat('d/m/Y', $start)->addMonths($duration)->format('d/m/Y');
        } else if($type == 'Hari'){
            $end = Carbon::createFromFormat('d/m/Y', $start)->addDays($duration)->format('d/m/Y');
        }

        //$end = $type;
        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $end]);
    }

}
