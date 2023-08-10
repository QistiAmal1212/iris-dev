<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaklumatPemohonController extends Controller
{
    public function searchPemohon (){
        return view('maklumat_pemohon.carian_pemohon');
    }

    public function viewMaklumatPemohon(){
        return view('maklumat_pemohon.index_pemohon');
    }

}
