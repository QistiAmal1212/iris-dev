<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function DashboardIntegration (){
        return view('admin.integrasi.integrasi');
    }
}
