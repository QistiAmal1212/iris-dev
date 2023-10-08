<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\PemohonRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidateLicense;
use App\Models\Candidate\CandidateOku;
use App\Models\Candidate\CandidateSkim;
use App\Models\Candidate\CandidateSchoolResult;
use App\Models\Candidate\CandidateSvm;
use App\Models\Candidate\CandidateSkm;
use App\Models\Candidate\CandidateMatriculation;
use App\Models\Candidate\CandidateHigherEducation;
use App\Models\Candidate\CandidateProfessional;
use App\Models\Candidate\CandidateExperience;
use App\Models\Candidate\CandidatePsl;
use App\Models\Candidate\CandidateArmyPolice;
use App\Models\Candidate\CandidateLanguage;
use App\Models\Candidate\CandidateTalent;
use Carbon;

class PemohonController extends ApiController
{
    public function store(PemohonRequest $request)
    {
        //$data = $this->bookingService->bookingOptions($request->validated());
        $request->validated();

        $noPengenalan = $request->no_kp;

        if($request->jantina == 'L' || $request->jantina == '1'){
            $jantina = '1';
        } else if($request->jantina == 'P' || $request->jantina == '2'){
            $jantina = '2';
        } else {
            $jantina = null;
        }

        // if($request->kewarganegaraan == "Kewarganegaraan"){
        //     $kewarganegaraan = 1;
        // } else {
        //     $kewarganegaraan = null;
        // }

        $agama = str_replace('0', '', $request->agama);

        $tempatLahir = $this->getKodNegeri($request->tempat_lahir);
        $tempatLahirBapa = $this->getKodNegeri($request->tempat_lahir_bapa);
        $tempatLahirIbu = $this->getKodNegeri($request->tempat_lahir_ibu);

        $jenisLesen = null;
        if(isset($request->jenis_lesen) || $request->jenis_lesen != null){
            $jenisLesen = str_replace('CDL - ', '', $request->jenis_lesen);
        }

        // return $data = [
        //     'nama_penuh' => $request->nama_penuh,
        //     'no_pengenalan' => $noPengenalan,
        //     'no_kp_baru' => $request->no_kp,
        //     'emel' => $request->emel,
        //     'no_tel' => $request->no_tel,
        //     'tarikh_lahir' => $request->tarikh_lahir,
        //     'kod_ruj_jantina' => $jantina,
        //     'kod_ruj_agama' => $agama,
        //     'kod_ruj_keturunan' => $request->keturunan,
        //     'kod_ruj_status_kahwin' => $request->status_kahwin,
        //     //'kewarganegaraan' => $kewarganegaraan,
        //     'kewarganegaraan' => 1,
        //     'tempat_lahir' => $tempatLahir,
        //     'tempat_lahir_bapa' => $tempatLahirBapa,
        //     'tempat_lahir_ibu' => $tempatLahirIbu,
        //     'alamat_1_tetap' => $request->alamat1_tetap,
        //     'alamat_2_tetap' => $request->alamat2_tetap,
        //     'alamat_3_tetap' => $request->alamat3_tetap,
        //     'poskod_tetap' => $request->poskod_tetap,
        //     'bandar_tetap' => $request->bandar_tetap,
        //     'negeri_tetap' => $request->negeri_tetap,
        //     'alamat_1' => $request->alamat1_surat,
        //     'alamat_2' => $request->alamat2_surat,
        //     'alamat_3' => $request->alamat3_surat,
        //     'poskod' => $request->poskod_surat,
        //     'bandar' => $request->bandar_surat,
        //     'negeri' => $request->negeri_surat,
        //     'tinggi' => $request->tinggi,
        //     'berat' => $request->berat,
        //     'pusat_temuduga' => $request->pusat_temuduga,
        //     'jenis_lesen' => $jenisLesen,
        //     'tempoh_tamat' => $request->tempoh_tamat_lesen,
        //     'status_senaraihitam' => $request->status_senaraihitam_lesen,
        //     'msg_senaraihitam' => $request->msg_senaraihitam_lesen,
        //     'kecacatan_calon' => ($request->no_daftar_rujukan_oku != null || $request->jenis_bantuan_oku != null) ? 'O' : null,
        //     'no_daftar_jkm' => $request->no_daftar_rujukan_oku,
        //     'kategori_oku' => $request->jenis_bantuan_oku,
        //     'sub_oku' => $request->sub_kategori_oku,
        //     'status_oku' => $request->status_oku,
        //     'skim' => $request->skim, //Manually add column : sah_yt,status,tmp_status
        //     'daftar_calon' => $request->daftar_calon, //Manually add column : J_DAFTAR:03,STATUS_AKAUN:1 //Copy tarikh_daftar masuk tarik_daftar1
        //     'tingkatan_3' => $request->tingkatan_3, //Manually add column : mpel_tkt //handle value jenis_peperiksaan PMR:1,SRP:2,LCE:3,LAIN-LAIN:4,PT3:5,ELSE:'',
        //     'tingkatan_5' => $request->tingkatan_5, //Manually add column : mpel_tkt,
        //     'tingkatan_6' => $request->tingkatan_6, //Manually add column : mpel_tkt,
        //     'svm' => $request->svm,
        //     'skm' => $request->skm,
        //     'matrikulasi' => $request->matrikulasi,
        //     'pengajian_tinggi' => $request->pengajian_tinggi,
        //     'profesional' => $request->profesional,
        //     'psl' => $request->psl,
        //     'pengalaman' => $request->pengalaman,
        //     'tentera_polis' => $request->tentera_polis,
        //     'bakat' => $request->bakat,
        //     'bahasa' => $request->bahasa,

        // ];

        try {
            DB::beginTransaction();

            $calon = Candidate::create([
                'nama_penuh' => $request->nama_penuh,
                'no_pengenalan' => $noPengenalan,
                'no_kp_baru' => $request->no_kp,
                'emel' => $request->emel,
                'no_tel' => $request->no_tel,
                'tarikh_lahir' => $request->tarikh_lahir,
                'kod_ruj_jantina' => $jantina,
                'kod_ruj_agama' => $agama,
                'kod_ruj_keturunan' => $request->keturunan,
                'kod_ruj_status_kahwin' => $request->status_kahwin,
                'kewarganegaraan' => 1,
                'tempat_lahir' => $tempatLahir,
                'tempat_lahir_bapa' => $tempatLahirBapa,
                'tempat_lahir_ibu' => $tempatLahirIbu,
                'alamat_1_tetap' => $request->alamat1_tetap,
                'alamat_2_tetap' => $request->alamat2_tetap,
                'alamat_3_tetap' => $request->alamat3_tetap,
                'poskod_tetap' => $request->poskod_tetap,
                'bandar_tetap' => $request->bandar_tetap,
                'negeri_tetap' => $request->negeri_tetap,
                'alamat_1' => $request->alamat1_surat,
                'alamat_2' => $request->alamat2_surat,
                'alamat_3' => $request->alamat3_surat,
                'poskod' => $request->poskod_surat,
                'bandar' => $request->bandar_surat,
                'negeri' => $request->negeri_surat,
                'tinggi' => $request->tinggi,
                'berat' => $request->berat,
                'pusat_temuduga' => $request->pusat_temuduga,
            ]);

            $lesen = null;
            if($jenisLesen != null){
                if($calon->license != null){
                    return "ADA LESEN";
                } else {
                    $lesen = CandidateLicense::create([
                        'no_pengenalan' => $noPengenalan,
                        'jenis_lesen' => $jenisLesen,
                        'tempoh_tamat' => $request->tempoh_tamat_lesen,
                        'status_senaraihitam' => $request->status_senaraihitam_lesen,
                        'msg_senaraihitam' => ($request->status_senaraihitam_lesen == true) ? $request->msg_senaraihitam_lesen : null,
                    ]);
                }
            }

            $oku = null;
            if($request->no_daftar_rujukan_oku != null || $request->jenis_bantuan_oku != null){
                if($calon->oku != null){
                    return "ADA OKU";
                } else {
                    $oku = CandidateOku::create([
                        'no_pengenalan' => $noPengenalan,
                        'kecacatan_calon' => ($request->no_daftar_rujukan_oku != null || $request->jenis_bantuan_oku != null) ? 'O' : null,
                        'no_daftar_jkm' => $request->no_daftar_rujukan_oku,
                        'kategori_oku' => $request->jenis_bantuan_oku,
                        'sub_oku' => $request->sub_kategori_oku,
                        'status_oku' => $request->status_oku,
                    ]);
                }
            }

            $skimDipohon = null;
            if($request->skim != null){
                // if(count($calon->skim) > 0) {
                //     return "ADA SKIM";
                // } else {
                    foreach($request->skim as $skim) {
                        $dataSkim = [
                            'no_pengenalan' => $noPengenalan,
                            'tarikh_daftar' => $skim['tarikh_daftar'],
                            'kod_ruj_skim' => $skim['skim'],
                            'no_kelompok' => $skim['no_kelompok'],
                            'no_siri' => $skim['no_siri'],
                            'pusat_td_pilihan' => $request->pusat_temuduga,
                        ];
                        $insertSkim = CandidateSkim::create($dataSkim);

                        if($insertSkim){
                            $skimDipohon[] = $dataSkim;
                        }
                    }
                //}
            }

            $daftarCalon = null;
            if($request->daftar_calon != null){
                //Kalau ada relationship between calon and calon daftar tmbh logic mcm calon skim
                foreach($request->daftar_calon as $daftar) {
                    $dataDaftar = [
                        'no_pengenalan' => $noPengenalan,
                        'skim' => $daftar['skim'],
                        'tarikh_daftar' => $daftar['tarikh_daftar'],
                        'tarikh_daftar_1' => $daftar['tarikh_daftar'],
                        'j_daftar' => '03',
                        'keutamaan' => $daftar['keutamaan'],
                        'status_akaun' => '1',
                    ];
                    $insertDaftar = DB::table('calon_daftar')->insert($dataDaftar);

                    if($insertDaftar){
                        $daftarCalon[] = $dataDaftar; 
                    }
                }
            }

            //Validate kod matapelajaran utk setiap tingkatan

            $tingkatan3 = null;
            if($request->tingkatan_3 != null){
                foreach($request->tingkatan_3 as $tkt3){
                    if($tkt3['jenis_sijil'] == 'PMR' || $tkt3['jenis_sijil'] == '1'){
                        $sijilTkt3 = 1;
                    } else if($tkt3['jenis_sijil'] == 'SRP' || $tkt3['jenis_sijil'] == '2') {
                        $sijilTkt3 = 2;
                    } else if($tkt3['jenis_sijil'] == 'LCE' || $tkt3['jenis_sijil'] == '3') {
                        $sijilTkt3 = 3;
                    } else if($tkt3['jenis_sijil'] == 'LAIN-LAIN' || $tkt3['jenis_sijil'] == '4') {
                        $sijilTkt3 = 4;
                    } else {
                        $sijilTkt3 = null;
                    }

                    $dataTkt3 = [
                        'no_pengenalan' => $noPengenalan,
                        'jenis_sijil' => $sijilTkt3,
                        'kep_terbuka' => $tkt3['keputusan_terbuka'],
                        'tahun' => $tkt3['tahun'],
                        'mpel_tkt' => '3',
                        'mpel_kod' => $tkt3['mata_pelajaran'],
                        'gred' => $tkt3['gred'],
                    ];

                    $insertTkt3 = CandidateSchoolResult::create($dataTkt3);

                    if($insertTkt3){
                        $tingkatan3[] = $dataTkt3;
                    }
                }
            }

            $tingkatan5 = null;
            if($request->tingkatan_5 != null){
                foreach($request->tingkatan_5 as $tkt5){
                    if($tkt5['jenis_sijil'] == 'PMR' || $tkt5['jenis_sijil'] == '1'){
                        $sijilTkt5 = 1;
                    } else if($tkt5['jenis_sijil'] == 'SRP' || $tkt5['jenis_sijil'] == '2') {
                        $sijilTkt5 = 2;
                    } else if($tkt5['jenis_sijil'] == 'LCE' || $tkt5['jenis_sijil'] == '3') {
                        $sijilTkt5 = 3;
                    } else if($tkt5['jenis_sijil'] == 'LAIN-LAIN' || $tkt5['jenis_sijil'] == '4') {
                        $sijilTkt5 = 4;
                    } else {
                        $sijilTkt5 = null;
                    }

                    $dataTkt5 = [
                        'no_pengenalan' => $noPengenalan,
                        'jenis_sijil' => $sijilTkt5,
                        'kep_terbuka' => $tkt5['keputusan_terbuka'],
                        'tahun' => $tkt5['tahun'],
                        'mpel_tkt' => '5',
                        'mpel_kod' => $tkt5['mata_pelajaran'],
                        'gred' => $tkt5['gred'],
                    ];

                    $insertTkt5 = CandidateSchoolResult::create($dataTkt5);

                    if($insertTkt5){
                        $tingkatan5[] = $dataTkt5;
                    }
                }
            }

            $tingkatan6 = null;
            if($request->tingkatan_6 != null){
                foreach($request->tingkatan_6 as $tkt6){
                    if($tkt6['jenis_sijil'] == 'PMR' || $tkt6['jenis_sijil'] == '1'){
                        $sijilTkt6 = 1;
                    } else if($tkt6['jenis_sijil'] == 'SRP' || $tkt6['jenis_sijil'] == '2') {
                        $sijilTkt6 = 2;
                    } else if($tkt6['jenis_sijil'] == 'LCE' || $tkt6['jenis_sijil'] == '3') {
                        $sijilTkt6 = 3;
                    } else if($tkt6['jenis_sijil'] == 'LAIN-LAIN' || $tkt6['jenis_sijil'] == '4') {
                        $sijilTkt6 = 4;
                    } else {
                        $sijilTkt6 = null;
                    }

                    $dataTkt6 = [
                        'no_pengenalan' => $noPengenalan,
                        'jenis_sijil' => $sijilTkt6,
                        'kep_terbuka' => $tkt6['keputusan_terbuka'],
                        'tahun' => $tkt6['tahun'],
                        'mpel_tkt' => '6',
                        'mpel_kod' => $tkt6['mata_pelajaran'],
                        'gred' => $tkt6['gred'],
                    ];

                    $insertTkt6 = CandidateSchoolResult::create($dataTkt6);

                    if($insertTkt6){
                        $tingkatan6[] = $dataTkt6;
                    }
                }
            }

            $svmCalon = null;
            if($request->svm != null){
                foreach($request->svm as $svm){
                    $dataSvm = [
                        'no_pengenalan' => $noPengenalan,
                        'kod_ruj_kelulusan' => $svm['kelulusan'],
                        'tahun_lulus' => $svm['tahun_lulus'],
                        'pngka' => $svm['pngka'],
                        'pngkv' => $svm['pngkv'],
                        'mata_pelajaran' => $svm['mata_pelajaran'],
                        'gred' => $svm['gred']
                    ];

                    $insertSvm = CandidateSvm::create($dataSvm);

                    if($insertSvm){
                        $svmCalon[] = $dataSvm;
                    }
                }
            }

            $skmCalon = null;
            if($request->skm != null){
                foreach($request->skm as $skm){
                    $dataSkm = [
                        'no_pengenalan' => $noPengenalan,
                        'kod_ruj_kelulusan' => $skm['kelulusan'],
                        'tahun_lulus' => $skm['tahun_lulus'],
                    ];

                    $insertSkm = CandidateSkm::create($dataSkm);

                    if($insertSkm){
                        $skmCalon[] = $dataSkm;
                    }
                }
            }

            $matrikulasi = null;
            if($request->matrikulasi != null){
                foreach($request->matrikulasi as $matrik){
                    $dataMatrik = [
                        'no_pengenalan' => $noPengenalan,
                        'no_matrik' => $matrik['no_matrik'],
                        'jurusan' => $matrik['jurusan'],
                        'sesi' => $matrik['sesi'],
                        'semester' => $matrik['semester'],
                        'kolej' => $matrik['kolej'],
                        'kod_subjek' => $matrik['subjek'],
                        'gred' => $matrik['gred'],
                        'pngk' => $matrik['pngk'],
                    ];

                    $insertMatrik = CandidateMatriculation::create($dataMatrik);

                    if($insertMatrik){
                        $matrikulasi[] = $dataMatrik;
                    }
                }
            }

            $pengajianTinggi = null;
            if($request->pengajian_tinggi != null){
                foreach($request->pengajian_tinggi as $pengajian){
                    $dataPengajian = [
                        'no_pengenalan' => $noPengenalan,
                        'kod_ruj_institusi' => $pengajian['institusi'],
                        'kod_ruj_kelayakan' => $pengajian['kelayakan'],
                        'kod_ruj_pengkhususan' => $pengajian['pengkhususan'],
                        'tahun_lulus' => $pengajian['tahun'],
                        'cgpa' => $pengajian['cgpa'],
                        'ins_fln' => $pengajian['institusi_francais'],
                        'nama_sijil' => $pengajian['nama_sijil'],
                        'tarikh_senat' => $pengajian['tarikh_senat'],
                        'peringkat_pengajian' => $pengajian['peringkat'],
                        'biasiswa' => $pengajian['biasiswa'],
                    ];

                    $insertPengajian = CandidateHigherEducation::create($dataPengajian);

                    if($insertPengajian){
                        $pengajianTinggi[] = $dataPengajian;
                    }
                }
            }

            $profesionalCalon = null;
            if($request->profesional != null){
                foreach($request->profesional as $profesional){
                    $dataProfesional = [
                        'no_pengenalan' => $noPengenalan,
                        'kod_ruj_kelulusan' => $profesional['kelulusan'],
                        'no_ahli' => $profesional['no_ahli'],
                        'tarikh' => $profesional['tarikh']
                    ];

                    $insertProfesional = CandidateProfessional::create($dataProfesional);

                    if($insertProfesional){
                        $profesionalCalon[] = $dataProfesional;
                    }
                }
            }

            $pengalaman = null;
            if($request->pengalaman_skim != null){
                $pengalaman = CandidateExperience::create([
                    'no_pengenalan' => $noPengenalan,
                    'sektor_pekerjaan' => $request->pengalaman_jenis_perkhidmatan,
                    'taraf_jawatan' => $request->pengalaman_jenis_lantikan,
                    'tarikh_lantik' => $request->pengalaman_tarikh_lantikan_pertama,
                    'tarikh_mula' => $request->pengalaman_tarikh_lantikan,
                    'tarikh_disahkan' => $request->pengalaman_tarikh_sah,
                    'kod_ruj_skim' => $request->pengalaman_skim,
                    'kod_ruj_gred_gaji' => $request->pengalaman_gred_gaji,
                    'kod_ruj_kementerian' => $request->pengalaman_kementerian,
                    'kod_ruj_negeri' => $request->pengalaman_negeri_bertugas,
                    'daerah_bertugas' => $request->pengalaman_daerah_bertugas,
                    'tarikh_tamat_kontrak' => $request->pengalaman_tarikh_tamat_kontrak,
                    'kump_pkhidmat' => $request->pengalaman_kumpulan_pkhidmat,
                ]);
            }

            $pslCalon = null;
            if($request->psl != null){
                foreach($request->psl as $psl){
                    $dataPsl = [
                        'no_pengenalan' => $noPengenalan,
                        'kod_ruj_kelulusan' => $psl['kelulusan'],
                        'tarikh_exam' => $psl['tarikh_exam'],
                    ];

                    $insertPsl = CandidatePsl::create($dataPsl);

                    if($insertPsl){
                        $pslCalon[] = $dataPsl;
                    }
                }
            }

            $tenteraPolis = null;
            if($request->kategori_tentera_polis != null || $request->pangkat_tentera_polis != null){
                $tenteraPolis = CandidateArmyPolice::create([
                    'no_pengenalan' => $noPengenalan,
                    'status_pkhidmat' => $request->kategori_tentera_polis,
                    'pangkat_tentera_polis' => $request->pangkat_tentera_polis,
                    'jenis_bekas_tentera' => $request->jenis_bekas_tentera_polis
                ]);
            }

            $bahasaCalon = null;
            if($request->bahasa != null){
                foreach($request->bahasa as $bahasa){
                    $dataBahasa = [
                        'no_pengenalan' => $noPengenalan,
                        'jenis_bahasa' => $bahasa['bahasa'],
                        'penguasaan' => $bahasa['penguasaan']
                    ];

                    $insertBahasa = CandidateLanguage::create($dataBahasa);

                    if($insertBahasa){
                        $bahasaCalon[] = $dataBahasa;
                    }
                }
            }
            
            $bakatCalon = null;
            if($request->bakat != null){
                foreach($request->bakat as $bakat){
                    $dataBakat = [
                        'no_pengenalan' => $noPengenalan,
                        'bakat' => $bakat['bakat'],
                        'bakat_detail' => $bakat['bakat_detail']
                    ];

                    $insertBakat = CandidateTalent::create($dataBakat);

                    if($insertBakat){
                        $bakatCalon[] = $dataBakat;
                    }
                }
            }

            // return $data = [
            //     'calon' => $calon,
            //     'lesen' => $lesen,
            //     'oku' => $oku,
            //     'skim' => $skimDipohon,
            //     'daftar_calon' => $daftarCalon,
            //     'tingkatan3' => $tingkatan3,
            //     'tingkatan5' => $tingkatan5,
            //     'tingkatan6' => $tingkatan6,
            //     'svm' => $svmCalon,
            //     'skm' => $skmCalon,
            //     'matrikulasi' => $matrikulasi,
            //     'pengajian_tinggi' => $pengajianTinggi,
            //     'profesional' => $profesionalCalon,
            //     'pengalaman' => $pengalaman,
            //     'psl' => $pslCalon,
            //     'tentera_polis' => $tenteraPolis,
            //     'bahasa' => $bahasaCalon,
            //     'bakat' => $bakatCalon,
            // ];

            DB::commit();
            $response = config('status.status_codes.success');
        //} catch (Exception $e) {
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Store Pemohon API Error: ' . $e);

            $response = config('status.status_codes.internal_server_error');
        }

        if($response == config('status.status_codes.internal_server_error')){
            return $this->errorResponseFormat(
                config('status.status_codes.internal_server_error'),
                'Internal server error!',
                [],
                config('status.http_codes.internal_server_error')
            );
        }

        return $this->successResponseFormat(
            $response,
            'Data berjaya disimpan.',
            []
        );
    }

    private static function getKodNegeri($kod){

        if($kod == '01' || $kod == '21' || $kod == '22' || $kod == '23' || $kod == '24') {
            $kodNegeri = '01';
        } else if($kod == '02' || $kod == '25' || $kod == '26' || $kod == '27') {
            $kodNegeri = '02';
        } else if($kod == '03' || $kod == '28' || $kod == '29') {
            $kodNegeri = '03';
        } else if($kod == '04' || $kod == '30') {
            $kodNegeri = '04';
        } else if($kod == '05' || $kod == '31' || $kod == '59') {
            $kodNegeri = '05';
        } else if($kod == '06' || $kod == '32' || $kod == '33') {
            $kodNegeri = '06';
        } else if($kod == '07' || $kod == '34' || $kod == '35') {
            $kodNegeri = '07';
        } else if($kod == '08' || $kod == '36' || $kod == '37' || $kod == '38' || $kod == '39') {
            $kodNegeri = '08';
        } else if($kod == '09' || $kod == '40') {
            $kodNegeri = '09';
        } else if($kod == '10' || $kod == '41' || $kod == '42' || $kod == '43' || $kod == '44') {
            $kodNegeri = '10';
        } else if($kod == '11' || $kod == '45' || $kod == '46') {
            $kodNegeri = '11';
        } else if($kod == '12' || $kod == '47' || $kod == '48' || $kod == '49') {
            $kodNegeri = '12';
        } else if($kod == '13' || $kod == '50' || $kod == '51' || $kod == '52' || $kod == '53') {
            $kodNegeri = '13';
        } else if($kod == '14' || $kod == '54' || $kod == '55' || $kod == '56' || $kod == '57') {
            $kodNegeri = '14';
        } else if($kod == '15' || $kod == '58') {
            $kodNegeri = '15';
        } else if($kod == '82') {
            $kodNegeri = '82';
        } else if($kod == '99') {
            $kodNegeri = '99';
        } else {
            $kodNegeri = '99';
        }

        return $kodNegeri;
    }
}