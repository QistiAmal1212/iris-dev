<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reference\Subject;

class AcronymController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() 
    {
        $subjekTerasPmr = [
            '0' => '021',
            '1' => '002',
            '2' => '012',
            '3' => '023',
            '4' => '045',
            '5' => '076',
            '6' => '077',
            '7' => '078',
            '8' => '051',
            '9' => '046',
        ];

        $subjekAgamaPmr = [
            '0' => '042',
            '1' => '041',
            '2' => '096',
            '3' => '098',
            '4' => '097',
            '5' => '073',
            '6' => '071',
        ];

        $subjekKemahiranPmr = [
            '0' => '066',
            '1' => '067',
            '2' => '068',
            '3' => '069',
            '4' => '094',
            '5' => '095',
            '6' => '093',
            '7' => '092',
            '8' => '079',
        ];

        $subjekTerasSpm = [
            '0' => '018',
            '1' => '101',
            '2' => '102',
            '3' => '103',
            '4' => '223',
            '5' => '249',
            '6' => '320',
            '7' => '321',
            '8' => '322',
            '9' => '449',
            '10' => '511',
            '11' => '230',
            '12' => '671',
        ];

        $subjeckBahasaSpm = [
            '0' => '363',
            '1' => '205',
            '2' => '215',
            '3' => '216',
            '4' => '217',
            '5' => '351',
            '6' => '354',
            '7' => '361',
            '8' => '362',
            '9' => '303',
            '10' => '378',
            '11' => '390',
            '12' => '397',
            '13' => '398',
            '14' => '399',
            '15' => '355',
            '16' => '356',
            '17' => '302',
            '18' => '301',
            '19' => '104',
            '20' => '403',
        ];

        $subjekAgamaSpm = [
            '0' => '222',
            '1' => '224',
            '2' => '221',
            '3' => '226',
            '4' => '227',
            '5' => '228',
            '6' => '225',
            '7' => '290',
            '8' => '293',
            '9' => '401',
            '10' => '402',
            '11' => '105',
            '12' => '100',
        ];

        $filterSubjekPmr = array_merge($subjekTerasPmr, $subjekAgamaPmr, $subjekKemahiranPmr);
        $filterSubjekSpm = array_merge($subjekTerasSpm, $subjeckBahasaSpm, $subjekAgamaSpm);
        $subjekPmr = Subject::whereIn('code', $filterSubjekPmr)->orderBy('code', 'asc')->get();
        $subjekSpm = Subject::whereIn('code', $filterSubjekSpm)->orderBy('code', 'asc')->get();

        return view('maklumat_pemohon.calon_acronym', compact('subjekPmr', 'subjekSpm'));
    }

    public function search(Request $request) 
    {
        $pmr = $request->pmr;
        $gredPmr = $request->gred_pmr;
        $spm = $request->spm;
        $gredSpm = $request->gred_spm;

        $subjekTerasPmr = [
            '021' => '0',
            '002' => '1',
            '012' => '2',
            '023' => '3',
            '045' => '4',
            '076' => '5',
            '077' => '6',
            '078' => '7',
            '051' => '8',
            '046' => '9',
        ];

        $subjekAgamaPmr = [
            '042' => '0',
            '041' => '1',
            '096' => '2',
            '098' => '3',
            '097' => '4',
            '073' => '5',
            '071' => '6',
        ];

        $subjekKemahiranPmr = [
            '066' => '0',
            '067' => '1',
            '068' => '2',
            '069' => '3',
            '094' => '4',
            '095' => '5',
            '093' => '6',
            '092' => '7',
            '079' => '8',
        ];

        $subjekTerasSpm = [
            '018' => '0',
            '101' => '1',
            '102' => '2',
            '103' => '3',
            '223' => '4',
            '249' => '5',
            '320' => '6',
            '321' => '7',
            '322' => '8',
            '449' => '9',
            '511' => '10',
            '230' => '11',
            '671' => '12',
        ];

        $subjeckBahasaSpm = [
            '363' => '0',
            '205' => '1',
            '215' => '2',
            '216' => '3',
            '217' => '4',
            '351' => '5',
            '354' => '6',
            '361' => '7',
            '362' => '8',
            '303' => '9',
            '378' => '10',
            '390' => '11',
            '397' => '12',
            '398' => '13',
            '399' => '14',
            '355' => '15',
            '356' => '16',
            '302' => '17',
            '301' => '18',
            '104' => '19',
            '403' => '20',
        ];

        $subjekAgamaSpm = [
            '222' => '0',
            '224' => '1',
            '221' => '2',
            '226' => '3',
            '227' => '4',
            '228' => '5',
            '225' => '6',
            '290' => '7',
            '293' => '8',
            '401' => '9',
            '402' => '10',
            '105' => '11',
            '100' => '12',
        ];

        $selectTerasPmr = array_fill(0, 10, 0);
        $selectAgamaPmr =  array_fill(0, 7, 0);
        $selectKemahiranPmr = array_fill(0, 9, 0);
        $selectTerasSpm = array_fill(0, 13, 0);
        $selectBahasaSpm =  array_fill(0, 21, 0);
        $selectAgamaSpm = array_fill(0, 13, 0);

        foreach($pmr as $key => $subjek){
            if(array_key_exists($subjek, $subjekTerasPmr)){
                $selectTerasPmr[$subjekTerasPmr[$subjek]] = $gredPmr[$key];
            }
            if(array_key_exists($subjek, $subjekAgamaPmr)){
                $selectAgamaPmr[$subjekAgamaPmr[$subjek]] = $gredPmr[$key];
            }
            if(array_key_exists($subjek, $subjekKemahiranPmr)){
                $selectKemahiranPmr[$subjekKemahiranPmr[$subjek]] = $gredPmr[$key];
            }
        }

        foreach($spm as $key => $subjek){
            if(array_key_exists($subjek, $subjekTerasSpm)){
                $selectTerasSpm[$subjekTerasSpm[$subjek]] = $gredSpm[$key];
            }
            if(array_key_exists($subjek, $subjeckBahasaSpm)){
                $selectBahasaSpm[$subjeckBahasaSpm[$subjek]] = $gredSpm[$key];
            }
            if(array_key_exists($subjek, $subjekAgamaSpm)){
                $selectAgamaSpm[$subjekAgamaSpm[$subjek]] = $gredSpm[$key];
            }
        }

        // $parameterTerasPmr = implode($selectTerasPmr);
        // $parameterAgamaPmr = implode($selectAgamaPmr);
        // $parameterKemahiranPmr = implode($selectKemahiranPmr);

        $calonList = DB::table('calon_acronym_pmr')->get();

        $resultPmr = [];

        foreach($calonList as $calon){

            $valueTerasPmr = $valueAgamaPmr = $valueKemahiranPmr = [];

            if($calon->teras != null){
                $teras = str_split($calon->teras);
                foreach($selectTerasPmr as $key => $dataTeras) {
                    if($dataTeras != 0){
                        if($dataTeras >= $teras[$key]){
                            $valueTerasPmr[] = true;
                        } else {
                            $valueTerasPmr[] = false;
                        }
                    }
                }
            } else {
                $valueTerasPmr[] = false;
            }

            if($calon->agama != null){
                $agama= str_split($calon->agama);
                foreach($selectAgamaPmr as $key => $dataAgama) {
                    if($dataAgama != 0){
                        if($dataAgama >= $agama[$key]){
                            $valueAgamaPmr[] = true;
                        } else {
                            $valueAgamaPmr[] = false;
                        }
                    }
                }
            }

            if($calon->kemahiran != null){  
                $kemahiran = str_split($calon->kemahiran);
                foreach($selectKemahiranPmr as $key => $dataKemahiran) {
                    if($dataKemahiran != 0) {
                        if($dataKemahiran >= $kemahiran[$key]){
                            $valueKemahiranPmr[] = true;
                        } else {
                            $valueKemahiranPmr[] = false;
                        }
                    }
                }
            }

           if(!in_array(false, $valueTerasPmr) && !in_array(false, $valueAgamaPmr) && !in_array(false, $valueKemahiranPmr)){
                
                $resultPmr[] = $calon->no_pengenalan;
                //$result[] = DB::table('calon_acronym')->where('no_pengenalan', $calon->no_pengenalan)->first();
                // $result[] = [
                //     'id' => $calon->id,
                //     'core' => $calonCore,
                //     'agama' => $calonAgama,
                //     'kemahiran' => $calonKemahiran,
                // ];

            }
        }
        //return count($resultPmr);
        $result = [];

        $resultCalonPmr = DB::table('calon_acronym_spm')->whereIn('no_pengenalan', $resultPmr)->get();

        //$count = 0;
        foreach($resultCalonPmr as $calonSpm){
            //if( $count == 1000) break;
            $valueTerasSpm = $valueBahasaSpm = $valueAgamaSpm = [];

            //$calonSpm = DB::table('calon_acronym_spm')->where('no_pengenalan', $calonPmr)->first();

            if($calonSpm->teras != null){
                $teras = str_split($calonSpm->teras);
                foreach($selectTerasSpm as $key => $dataTeras) {
                    if($dataTeras != 0){
                        if($dataTeras >= $teras[$key]){
                            $valueTerasSpm[] = true;
                        } else {
                            $valueTerasSpm[] = false;
                        }
                    }
                }
            } else {
                $valueTerasSpm[] = false;
            }

            if($calonSpm->bahasa != null){  
                $bahasa = str_split($calonSpm->bahasa);
                foreach($selectBahasaSpm as $key => $dataBahasa) {
                    if($dataBahasa != 0) {
                        if($dataBahasa >= $bahasa[$key]){
                            $valueBahasaSpm[] = true;
                        } else {
                            $valueBahasaSpm[] = false;
                        }
                    }
                }
            }

            if($calonSpm->agama != null){
                $agama= str_split($calonSpm->agama);
                foreach($selectAgamaSpm as $key => $dataAgama) {
                    if($dataAgama != 0){
                        if($dataAgama >= $agama[$key]){
                            $valueAgamaSpm[] = true;
                        } else {
                            $valueAgamaSpm[] = false;
                        }
                    }
                }
            }

            if(!in_array(false, $valueTerasSpm) && !in_array(false, $valueBahasaSpm) && !in_array(false, $valueAgamaSpm)){
                $result[] = $calonSpm;
            }
            //$count++;
        }
        
        // foreach($result as $calon){
        //     return DB::table('calon_acronym_spm')->where('no_pengenalan', $calon->no_pengenalan)->first();
        // }



        return response()->json(['title' => 'Berjaya', 'status' => 'success', 'message' => "Berjaya", 'detail' => $result]);

        // return [
        //     'teras' => $selectTerasPmr,
        //     'agama' => $selectAgamaPmr,
        //     'kemahiran' => $selectKemahiranPmr
        // ];

        //return $request;
        //DB::table('candidate_acronym')->get();
    }

    public function insertData()
    {
        // $dataArray=[];

        // $candidate = DB::table('candidate')->select('no_pengenalan', 'full_name')->get();

        // foreach($candidate as $calon) {
        //     $dataCore = [];
        //     $dataCore[0] = rand(1, 5);
        //     $dataCore[1] = rand(1, 5);
        //     $dataCore[2] = rand(1, 5);
        //     $dataCore[3] = rand(1, 5);
        //     $dataCore[4] = rand(1, 5);
        //     $dataCore[5] = rand(1, 5);
        //     $dataCore[6] = rand(1, 5);
        //     $dataCore[7] = rand(1, 5);
        //     $dataCore[8] = rand(1, 5);
        //     $dataCore[9] = rand(1, 5);
        //     $dataCore[10] = rand(1, 5);
        //     $dataCore[11] = rand(1, 5);
        //     $dataCore[12] = rand(1, 5);

        //     $dataBahasa = [];
        //     $dataBahasa[0] = rand(1, 5);
        //     $dataBahasa[1] = rand(1, 5);
        //     $dataBahasa[2] = rand(1, 5);
        //     $dataBahasa[3] = rand(1, 5);
        //     $dataBahasa[4] = rand(1, 5);
        //     $dataBahasa[5] = rand(1, 5);
        //     $dataBahasa[6] = rand(1, 5);
        //     $dataBahasa[7] = rand(1, 5);
        //     $dataBahasa[8] = rand(1, 5);
        //     $dataBahasa[9] = rand(1, 5);
        //     $dataBahasa[10] = rand(1, 5);
        //     $dataBahasa[11] = rand(1, 5);
        //     $dataBahasa[12] = rand(1, 5);
        //     $dataBahasa[13] = rand(1, 5);
        //     $dataBahasa[14] = rand(1, 5);
        //     $dataBahasa[15] = rand(1, 5);
        //     $dataBahasa[16] = rand(1, 5);
        //     $dataBahasa[17] = rand(1, 5);
        //     $dataBahasa[18] = rand(1, 5);
        //     $dataBahasa[19] = rand(1, 5);
        //     $dataBahasa[20] = rand(1, 5);

        //     $dataAgama = [];
        //     $dataAgama[0] = rand(1, 5);
        //     $dataAgama[1] = rand(1, 5);
        //     $dataAgama[2] = rand(1, 5);
        //     $dataAgama[3] = rand(1, 5);
        //     $dataAgama[4] = rand(1, 5);
        //     $dataAgama[5] = rand(1, 5);
        //     $dataAgama[6] = rand(1, 5);
        //     $dataAgama[7] = rand(1, 5);
        //     $dataAgama[8] = rand(1, 5);
        //     $dataAgama[9] = rand(1, 5);
        //     $dataAgama[10] = rand(1, 5);
        //     $dataAgama[11] = rand(1, 5);
        //     $dataAgama[12] = rand(1, 5);
        //     $dataAgama[13] = rand(1, 5);
        //     $dataAgama[14] = rand(1, 5);
        //     $dataAgama[15] = rand(1, 5);
        //     $dataAgama[16] = rand(1, 5);
        //     $dataAgama[17] = rand(1, 5);

        //     $core = implode($dataCore);
        //     $bahasa = implode($dataBahasa);
        //     $agama = implode($dataAgama);

        //     $dataArray = [
        //         'no_pengenalan' => $calon->no_pengenalan,
        //         'teras' => $core,
        //         'bahasa' => $bahasa,
        //         'agama' => $agama,
        //     ];
            
        //     DB::table('calon_acronym_spm')->insert($dataArray);
        
        // }

        return 'Berjaya';
    }

    public function updateData()
    {
        //$bilCalonPmr = count(DB::table('calon_acronym_pmr')->get());
        // $bilCalonPmr = 681282;

        // for($i=1000; $i<=$bilCalonPmr;$i+=100){
        //     $calon = DB::table('calon_acronym_pmr')->where('id', $i)->first();
        //     $calonUpdate = DB::table('calon_acronym_pmr')->where('id', $i);

        //     $randomTeras = rand(0,1);
        //     $randomAgama = rand(0,1);
        //     $randomKemahiran = rand(0,1);

        //     $calonUpdate->update([
        //         'teras' => ($randomTeras == 1) ? null : $calon->teras,
        //         'agama' => ($randomAgama == 1) ? null : $calon->agama,
        //         'kemahiran' => ($randomKemahiran == 1) ? null : $calon->kemahiran,
        //     ]);
        // }

        // return 'Berjaya';

        $bilCalonPmr = DB::table('calon_acronym_pmr')->where('teras', null)->orWhere('agama', null)->orWhere('kemahiran', null)->get();

        foreach($bilCalonPmr as $pmr){

            $teras = null;
            if($pmr->teras != null){
                $teras = 'A';
            }

            $agama = null;
            if($pmr->agama != null){
                $agama = 'B';
            }

            $kemahiran = null;
            if($pmr->kemahiran != null){
                $kemahiran = 'C';
            }


            $data = null;

            if($teras != null){
                $data = $teras;
            }

            if($agama != null){
                if($data != null){
                    $data = $data.",".$agama;
                } else {
                    $data = $agama;
                }
            }

            if($kemahiran != null){
                if($data != null){
                    $data = $data.",".$kemahiran;
                } else {
                    $data = $kemahiran;
                }
            }

            if($data != null){
                DB::table('calon_acronym')->where('no_pengenalan', $pmr->no_pengenalan)->update([
                    'pmr' => $data
                ]);
            }

        }

        return 'Berjaya';
    }
}
