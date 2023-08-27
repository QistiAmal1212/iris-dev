<?php

namespace App\Http\Controllers;

use App\Models\Reference\Skim;
use Illuminate\Http\Request;

class PGSPAController extends Controller
{
    public function SenaraiSkim(){

        $skims = Skim::all();

        return view('pemerolehan.pgspa.senarai_jawatan', compact('skims'));
    }

    public function SkimBaharu(){

        $skims = Skim::all();

        return view('pemerolehan.pgspa.jawatan_kosong.index', compact('skims'));
    }
}
