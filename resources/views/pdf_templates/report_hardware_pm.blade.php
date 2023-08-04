<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{$pm_report->title ?? "LAPORAN CORRECTIVE MAINTENANCE"}}</title>
</head>

<style>

    @media print {
        .landscape {
            -webkit-transform: rotate(270deg);
            -moz-transform: rotate(270deg);
            -o-transform: rotate(270deg);
            -ms-transform: rotate(270deg);
            transform: rotate(270deg);
        }
    }

    body{
        font-family: Raleway-Regular,sans-serif;
        font-size: 12px;
        font-weight: 400;
        height: 100%;
        margin-left: 6%;
        line-height: 1.5;
        letter-spacing: normal;
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
        font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
    }

    p, span, ol li, ul li {
        font-family: Raleway-Regular,sans-serif;
        font-size: 16px;
        font-weight: 400;
    }

    table th td{
        font-family: Raleway-Regular,sans-serif;
    }

    /* .landscape{
        transform: rotate(270deg) translate(-276mm, 0);
        transform-origin: 0 0;
    } */


    .mainTheme {
        background-color: #204484;
        color:white;
    }

    .defaultTheme {
        background-color: #efefef;
        color:black;
    }

    table.center {
        text-align: center;
    }


    .bold {
        font-weight: bold
    }

    .h2 {
        font-size:14px;
        white-space: pre-wrap;
        word-wrap: break-word;
    }

    .fs12em{
        font-size:1.2em;
    }

    .fs10 {
        font-size: 10px;
    }

    .small {
        font-size: 10px;
    }

    .subHeader {
        text-shadow: none;
        background-color: #204484;
        color: white;
        letter-spacing: 0.06em ;
        padding-left: 9px;
        padding-right: 9px;
        padding-top: 4px;
        padding-bottom: 4px;
        border-radius: 0px;
        width: 100% !important;
    }
    .subHeader.center{
        text-align:center;
    }

    .center{
        text-align: center;
    }

    table,
    th,
    td {
        border-collapse: collapse;
    }

    table thead td,
    table thead th,
    table tfoot td,
    table tbody td {
        padding: 0.5rem;
    }

    tr.spaceUnder>td {
        padding-bottom: 1em;
    }

    table { page-break-after:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    td    { page-break-inside:avoid; page-break-after:auto }
    thead { display: table-row-group; }
    tfoot { display:table-footer-group }

    .cover_page_table tr:not(:nth-child(1)) td {
        text-align: center;
        margin: 0rem !important;
        padding: 0rem !important;
    }
    .cover_page_table tr:nth-child(1) td {
        text-align: center;
        padding-bottom: 2rem !important;
        padding-top: 80px !important;
    }

    .cover_page_table td h1{
       margin: 0rem !important;
       padding: 0rem !important;
    }

    .cover_detail_table td:nth-child(1),
    .cover_detail_table td:nth-child(2) {
        background-color: #204484;
        color:white;
    }

    .semak_sah_table thead td {
        font-size:1.5em;
        background-color:#e8e4e4;
        padding-top:0.5em;
        padding-bottom:0.5em;
    }

    .semak_sah_table thead tr,
    .semak_sah_table tbody td:nth-child(4) {
        text-align: center;
    }

    .abreviasi_table tbody span {
        font-weight: normal;
    }

    .abreviasi_table tbody td:nth-child(1) {
        text-align: center;
    }

    .evaluation_table thead th,
    .evaluation_table tfoot td {
        font-weight: bold;
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
    }

    .evaluation_table th{
        text-align: center!important;
    }

    .evaluation_table td{
        text-align: left!important;
    }

    .evaluation_table tfoot td {
        vertical-align: bottom;
    }

    /*---- checklist table -----*/
    .checklist_table{
        font-family: "Raleway-Regular";
        font-size:12px;
    }

    .checklist_table thead th,
    .checklist_table tfoot td {
        font-weight: bold;
        padding-top: 0.7rem;
        padding-bottom: 0.7rem;
    }

    .checklist_table th{
        text-align: center!important;
    }

    .checklist_table td{
        font-family: "Raleway-Regular";
        text-align: left!important;
    }

    .checklist_table tfoot td {
        vertical-align: bottom;
    }

    .checklist_table tr:(:first-child){

    }

    .checklist_table tbody td:nth-child(1)[rowspan]{
        text-align: center!important;
    }

    .checklist_table tbody td:nth-child(2)[rowspan="2"]{
        text-align: center!important;
        background-color:#ffffff;
    }

    /* .checklist_table tbody td:nth-child(5):not([rowspan="2"]){
        background-color:#efefef!important;
    } */

    /* .checklist_table tbody td:nth-child(7){
        background-color:#efefef!important;
    } */

    /* .checklist_table tbody td:nth-child(3):not(:first-child,[rowspan]){
        background-color:#efefef!important;
    } */

    /* .checklist_table tbody td:nth-child(5):not([rowspan]){
        background-color:#efefef!important;
    } */

    /* td:nth-child(4)[colspan]:not([colspan="1"]) */
</style>
<style>
    .keep-together {
        page-break-inside: avoid;
    }

    .break-before {
        page-break-before: always;
        margin-top: 200px;
    }

    .break-after {
        page-break-after: always;
    }
</style>

<body>
    <table class="cover_page_table" width="100%" height="100%">
        <tr>
            <td>
                <img src="{{ public_path() }}/images/misc/jata-negara.png" alt="Logo Syarikat Unijaya Resources"
                    width="auto" height="100">
            </td>
        </tr>
        <tr>
            <td>
                <h1>DOKUMEN</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h1>LAPORAN PREVENTIVE MAINTENANCE REPORT</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h1>{{strtoupper(Carbon::createFromDate($pm_report->end_date, 1)->format('M Y'))}}</h1>

            </td>
        </tr>
    </table>
    <br>
    <br>
    <div style=" margin-left: auto;margin-right: auto;width: 95%;">
        <table class="cover_detail_table" width="100%" border="1" >
            <tbody>
                <tr >
                    <td width="30%"><h2>NAMA AGENSI</h2></td>
                    <td width="03%"><h2>:</h2></td>
                    <td width="67%"><h2>{{$project->client->name}} {{$project->client->name_short}}</h2></td>
                </tr>
                <tr >
                    <td width="30%"><h2>TARIKH DOKUMEN</h2></td>
                    <td width="03%"><h2>:</h2></td>
                    <td width="67%"><h2>{{strtoupper(Carbon::createFromDate($pm_report->end_date, 1)->format('d M Y'))}}</h2></td>
                </tr>
                <tr >
                    <td width="30%"><h2>VERSI DOKUMEN</h2></td>
                    <td width="03%"><h2>:</h2></td>
                    <td width="67%"><h2>1.0</h2></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="break-before"></div>
    <div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h2>SEMAKAN DAN PENGESAHAN DOKUMEN</h2>
        <h2 style="font-weight: normal; ">Pegawai yang terlibat untuk menurunkan tandatangan sebagai semakan dan pengesahan kepada maklumat-maklumat yang terkandung di dalam dokumen.
        </h2>
        <br>
        <h2>SEMAKAN DOKUMEN</h2>
        <table class="semak_sah_table" width="100%" border="1" >
            <thead>
                <tr>
                    <td width="27%">Disemak Oleh</td>
                    <td width="23%">Jawatan</td>
                    <td width="25%">Tandatangan</td>
                    <td width="25%">Tarikh Semakan</td>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td><h3 style="font-weight: normal;">{{ $pm_report->confirmed_by_name ?? ""}}</h3></td>
                    <td><h3 style="font-weight: normal;">{{ $pm_report->confirmed_by_role ?? ""}}</h3></td>
                    <td>
                        <img src="{{
                        (count($pm_report->uploadedFiles('signature_pengesah')->get())) ? public_path($pm_report->uploadedFiles('signature_pengesah')->latest()->first()->path) : ' '
                        }}" align="left" width="100" height="auto" >
                    </td>
                    <td><h3 style="font-weight: normal;">{{ $pm_report->confirmed_date ?? "" }}</h3></td>
                </tr>
            </tbody>
        </table>
        <br>
        <h2>PENGESAHAN DOKUMEN</h2>
        <table class="semak_sah_table" width="100%" border="1" >
            <thead>
                <tr>
                    <td width="27%">Disahkan Oleh</td>
                    <td width="23%">Jawatan</td>
                    <td width="25%">Tandatangan</td>
                    <td width="25%">Tarikh Pengesahan</td>
                </tr>
            </thead>
            <tbody>
                <tr >
                    <td><h3 style="font-weight: normal;">{{ $pm_report->confirmed_by_name ?? ""}}</h3></td>
                    <td><h3 style="font-weight: normal;">{{ $pm_report->confirmed_by_role ?? ""}}</h3></td>
                    <td>
                        <img src="{{
                        (count($pm_report->uploadedFiles('signature_pengesah')->get())) ? public_path($pm_report->uploadedFiles('signature_pengesah')->latest()->first()->path) : ' '
                        }}" align="left" width="100" height="auto" >
                    </td>
                    <td><h3 style="font-weight: normal;">{{ $pm_report->confirmed_date ?? "" }}</h3></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="break-before"></div>
    <div>
        <br>
        <br>
        <br>
        <br>
        <h2>PREVENTIVE MAINTENANCE (PM) REPORT</h2>
        <table width="100%">
            <tbody class="fs12em">
                <tr>
                    <td width="20%" class="bold"><span>DISEDIAKAN OLEH</span></td>
                    <td width="1%"><span>:</span></td>
                    <td width="29%"><span>{{ $pm_report->prepared_by_name ?? ""}}</span></td>
                    <td width="15%"></td>
                    <td width="5%" class="bold"><span>TARIKH</span></td>
                    <td width="1%"><span>:</span></td>
                    <td width="29%"><span>{{ $pm_report->prepared_date ?? ""}}</span></td>
                </tr>
                <tr>
                    <td width="20%" class="bold"><span>TITLE</span></td>
                    <td width="1%"><span>:</span></td>
                    <td width="29%"><span>{{ $pm_report->prepared_by_role ?? ""}}</span></td>
                    <td width="15%"></td>
                    <td width="5%" class="bold"><span>DOKUMEN</span></td>
                    <td width="1%"><span>:</span></td>
                    <td width="29%"><span>V1.0</span></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="subHeader center">
            <span class="h2 bold">PROJECT INFORMATION</span>
        </div>
        <br>
        <table width="100%" border="1" >
            <tbody>
                <tr >
                    <td width="30%" class="mainTheme" ><span class="h2 bold">NAMA PROJEK</span></td>
                    <td width="70%">
                        <span class="h2" style="font-weight: normal;">{!!$pm_report->project->description ?? "-"!!}</span>
                    </td>
                </tr>
                <tr >
                    <td width="30%" class="mainTheme" ><span class="h2 bold">NAMA KEMENTERIAN</span></td>
                    <td width="70%">
                        <span class="h2" style="font-weight: normal;">{{$pm_report->project->client?->name ?? "-"}}</span>
                    </td>
                </tr>
                <tr >
                    <td width="30%" class="mainTheme" ><span class="h2 bold">TARIKH MULA PM</span></td>
                    <td width="70%">
                        {{-- <span class="h2" style="font-weight: normal;">{{$pm_report->start_date ? strtoupper($pm_report->start_date->format('j F Y')) : "-"}}</span>
                         --}}
                        <span class="h2" style="font-weight: normal;">{{strtoupper(Carbon::createFromDate($pm_report->end_date, 1)->format('d M Y'))}}</span>
                    </td>
                </tr>
                <tr >
                    <td width="30%" class="mainTheme" ><span class="h2 bold">TARIKH AKHIR PM</span></td>
                    <td width="70%">
                        <span class="h2" style="font-weight: normal;">{{strtoupper(Carbon::createFromDate($pm_report->end_date, 1)->format('d M Y'))}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="subHeader center">
            <span class="h2 bold">INTRODUCTION</span>
        </div>
        <br>
        <span class="h2 bold">IDENTITI PROJEK</span>
        <br>
        <h2 style="font-weight: normal; ">{!! html_entity_decode($pm_report->intro) ?? '' !!}</h2>
        <br>
        <table class="abreviasi_table" width="100%" border="1" >
            <thead>
                <tr class="mainTheme center">
                    <td><span class="h2 bold">ABREVIASI</span></td>
                    <td><span class="h2 bold">KETERANGAN</span></td>
                </tr>
            </thead>
            <tbody>
                @if(!is_null($pm_report->project->getAbbreviations))
                    @foreach ($pm_report->project->getAbbreviations as $abvr)
                        <tr>
                            <td> <span class="h2">{{$abvr->abbreviation}} </span></td>
                            <td> <span class="h2">{{$abvr->description}}</span></td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="2" align='center'> <span class="h2">-</span></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- OBJECTIVE --}}
    <div class="break-before"></div>
    <div>

        <div class="subHeader center">
            <span class="h2 bold">OBJEKTIF</span>
        </div>
        <br>
        <h2 style="font-weight: normal">{!! html_entity_decode($pm_report->objective) ?? '' !!}</h2>

    </div>


    {{-- EVALUATION SUMMARY > CHECKLIST --}}

    @if(!is_null($server_locations))
        @foreach ( $server_locations as $server_location)

        @if (!$server_location->servers()->exists())
            @php
                continue;
            @endphp
        @endif

        <div>
            <div class="break-before"></div>
            <div class="subHeader center">
                <span class="h2 bold">EVALUATION SUMMARY - {{ ($server_location->type == 'DC') ? 'DATA CENTRE' : ' DISASTER RECOVERY CENTRE'}}</span>
            </div>
            <h2 style="font-weight: normal; ">Tumpuan penilaian adalah untuk mengukur kestabilan Perkakasan & Perisian bagi Sistem {{$project->name}}.
                Sekiranya terdapat permasalah, pembetulan akan di logkan di dalam Laporan Corrective Maintenance.
            </h2>
            <br>
            <h2 style="font-weight: normal; ">SERVER INFORMATION</h2>
            <h3 style="font-weight: normal; ">{{ ($server_location->type == 'DC') ? 'DATA CENTRE' : ' DISASTER RECOVERY CENTRE'}}</h3>

            @foreach ( $server_location->servers as $no_server => $server)
                <table class="evaluation_table" width="100%" border="1">
                    <thead>
                        <tr class="mainTheme">
                            <td colspan="2" class="text-center" style="text-align:center!important;">PHYSICAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-left">
                            <td class="text-left font-weight-bold" style="text-align:left!important; font-weight: normal;">System Type (Brand / Model)</td>
                            <td class="text-left">{{$server->server_brand}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Serial Number </td>
                            <td class="text-left">{{$server->serial_number}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">CPU</td>
                            <td class="text-left">{{$server->cpu}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Memory</td>
                            <td class="text-left">{{$server->memory}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Hard Disk</td>
                            <td class="text-left">{{$server->hdd}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Tape Drive</td>
                            <td class="text-left">{{$server->tape_drive}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Graphic IO</td>
                            <td class="text-left">{{$server->graphic_io}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Power Supply</td>
                            <td class="text-left">{{$server->power_supply}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Other I/O</td>
                            <td class="text-left">{{$server->other_io}}</td>
                        </tr>
                        <tr class="mainTheme">
                            <td colspan="2" class="text-center">APPLICATION</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Operating System</td>
                            <td class="text-left">{{$server->server_os}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Kernel Version</td>
                            <td class="text-left">{{$server->server_kernal}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Patches Level</td>
                            <td class="text-left">{{$server->server_patches}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">IP Address</td>
                            <td class="text-left">{{$server->ip_address_info}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Default Gateway</td>
                            <td class="text-left">{{$server->server_gateway}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">DNS Server</td>
                            <td class="text-left">{{$server->server_dns}}</td>
                        </tr>
                        <tr>
                            <td class="text-left font-weight-bold">Hostname</td>
                            <td class="text-left">{{$server->server_hostname}}</td>
                        </tr>
                    </tbody>
                </table>
                @foreach ( $server->ip_address as $no_ip => $ip_address)
                    @if (!$ip_address->server_checklist()->exists())
                        @php
                            continue;
                        @endphp
                    @endif

                    {{-- CHECKLIST --}}
                    <div class="break-before"></div>
                    @if ($loop->first)
                        <h3 class="font-weight-light">Ringkasan Laporan Keseluruhan Penyelenggaraan untuk Bulan {{Carbon::createFromDate($pm_report->end_date, 1)->format('M Y') ?? '-'}} adalah seperti berikut:</h3>
                    @endif
                        @php
                            $get_checklist = $ip_address->server_checklist->sortByDesc('created_at')->first();
                        @endphp
                        <table class="checklist_table" width="100%" border="1">
                            <thead>
                                <tr class="defaultTheme">
                                    <td colspan="8" style="text-align:center!important;">
                                        <b>SERVER IP : {{ $ip_address->ip_address }}</b>
                                    </td>
                                </tr>
                                <tr class="mainTheme">
                                    <th class="text-center" width="5%">NO</th>
                                    <th class="text-center" width="15%">DESCRIPTION</th>
                                    <th colspan="5" class="text-center" width="55%">STATUS</th>
                                    <th class="text-center" width="25%">NOTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 1. system reboot --}}
                                <tr class="text-left">
                                    <td rowspan="2" align="text-align:center!important;">1</td>
                                    <td rowspan="2"><b>System Boot</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->system_boot_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->system_boot_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('system_boot_reboot')->get())) ? ucwords($get_checklist->notes('system_boot_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ (!is_null($get_checklist->system_boot_error) == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->system_boot_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('system_boot_error')->get())) ? ucwords($get_checklist->notes('system_boot_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 2. operating system --}}
                                <tr class="text-left">
                                    <td rowspan="2" align="text-align:center!important;">2</td>
                                    <td rowspan="2"><b>Operating System</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->os_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->os_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('os_reboot')->get())) ? ucwords($get_checklist->notes('os_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->os_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->os_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('os_error')->get())) ? ucwords($get_checklist->notes('os_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 3. hardware --}}
                                <tr class="text-left">
                                    <td rowspan="7" >3</td>
                                    <td colspan="7" style="text-align: center!important;"><b>Hardware</b></td>
                                </tr>
                                {{-- a.fan --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>Fan</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->fan_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->fan_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('fan_reboot')->get())) ? ucwords($get_checklist->notes('fan_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->fan_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->fan_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('fan_error')->get())) ? ucwords($get_checklist->notes('fan_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- b.psu --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>PSU</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->psu_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->psu_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('psu_reboot')->get())) ? ucwords($get_checklist->notes('psu_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->psu_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->psu_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('psu_error')->get())) ? ucwords($get_checklist->notes('psu_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- c.cable --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>Cable Integrity</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->cable_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->cable_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('cable_reboot')->get())) ? ucwords($get_checklist->notes('cable_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->cable_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->hardware->cable_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('cable_error')->get())) ? ucwords($get_checklist->notes('cable_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 4. firewall --}}
                                <tr class="text-left">
                                    <td rowspan="1" style="text-align:center!important;">4</td>
                                    <td rowspan="1" style="text-align:center!important;"><b>Firewall</b></td>
                                    <td>Hardening</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->firewall_harden == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->firewall_harden == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('firewall_harden')->get())) ? ucwords($get_checklist->notes('firewall_harden')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 5. password --}}
                                <tr class="text-left">
                                    <td rowspan="1" style="text-align:center!important;">5</td>
                                    <td rowspan="1" style="text-align:center!important;"><b>Password</b></td>
                                    <td>Hardening</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->password_harden == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->password_harden == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('password_harden')->get())) ? ucwords($get_checklist->notes('password_harden')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 6.resources --}}
                                <tr class="text-left">
                                    <td rowspan="11" >6</td>
                                    <td colspan="7" style="text-align: center!important;"><b>Resources</b></td>
                                </tr>
                                {{-- a.cpu --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>CPU</b></td>
                                    <td>Availability</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->cpu_avail == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->cpu_avail == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('cpu_avail')->get())) ? ucwords($get_checklist->notes('cpu_avail')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->cpu_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->cpu_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('cpu_error')->get())) ? ucwords($get_checklist->notes('cpu_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- b.memory --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>Memory</b></td>
                                    <td>Availability</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->mem_avail == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->mem_avail == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('mem_avail')->get())) ? ucwords($get_checklist->notes('mem_avail')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->mem_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->mem_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('mem_error')->get())) ? ucwords($get_checklist->notes('mem_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- c.disk status --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>Disk Status</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_st_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_st_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('disk_st_reboot')->get())) ? ucwords($get_checklist->notes('disk_st_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_st_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_st_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('disk_st_error')->get())) ? ucwords($get_checklist->notes('disk_st_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- d.disk usage --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>Disk Usage</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_us_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_us_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('disk_us_reboot')->get())) ? ucwords($get_checklist->notes('disk_us_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_us_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->disk_us_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('disk_us_error')->get())) ? ucwords($get_checklist->notes('disk_us_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- e.network --}}
                                <tr class="text-left">
                                    <td rowspan="2" style="text-align: center!important;"><b>Network</b></td>
                                    <td>Ping</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->net_ping == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->net_ping == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('net_ping')->get())) ? ucwords($get_checklist->notes('net_ping')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->net_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->resources->net_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('net_error')->get())) ? ucwords($get_checklist->notes('net_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 7.services --}}
                                <tr class="text-left">
                                    <td rowspan="2" align="text-align:center!important;">7</td>
                                    <td rowspan="2"><b>Services</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->service_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->service_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('service_reboot')->get())) ? ucwords($get_checklist->notes('service_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->service_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->service_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('service_error')->get())) ? ucwords($get_checklist->notes('service_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 8.admin tool --}}
                                <tr class="text-left">
                                    <td rowspan="2" >8</td>
                                    <td colspan="1" style="text-align: center!important;"><b>Administration Tools</b></td>
                                    <td>Availability</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->admin_tool->availability == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->admin_tool->availability == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('admin_availability')->get())) ? ucwords($get_checklist->notes('admin_availability')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                {{-- a.User accounts --}}
                                <tr class="text-left">
                                    <td style="text-align: center!important;"><b>User Accounts</b></td>
                                    <td>Cleanup</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->admin_tool->account_cleanup == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->admin_tool->account_cleanup == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('account_cleanup')->get())) ? ucwords($get_checklist->notes('account_cleanup')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 9.cleanup --}}
                                <tr class="text-left">
                                    <td rowspan="2" align="text-align:center!important;">9</td>
                                    <td rowspan="2"><b>Cleanup</b></td>
                                    <td>Log</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->clean_log == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->clean_log == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('clean_log')->get())) ? ucwords($get_checklist->notes('clean_log')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Cache</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->clean_cache == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->clean_cache == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('clean_cache')->get())) ? ucwords($get_checklist->notes('clean_cache')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        {{-- APPLICATION ---}}
                        <div class="break-before"></div>
                        <table class="checklist_table" width="100%" border="1">
                            <thead>
                                <tr class="defaultTheme">
                                    <td colspan="8" style="text-align:center!important;">
                                        <b>APPLICATION</b>
                                    </td>
                                </tr>
                                <tr class="mainTheme">
                                    <th class="text-center" width="5%">NO</th>
                                    <th class="text-center" width="15%">DESCRIPTION</th>
                                    <th colspan="5" class="text-center" width="55%">STATUS</th>
                                    <th class="text-center" width="25%">NOTE</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 1. resources usage --}}
                                <tr class="text-left">
                                    <td rowspan="2" align="text-align:center!important;">1</td>
                                    <td rowspan="2"><b>Resource Usage</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_us_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_us_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('app_us_reboot')->get())) ? ucwords($get_checklist->notes('app_us_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_us_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_us_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('app_us_error')->get())) ? ucwords($get_checklist->notes('app_us_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 2. updates --}}
                                <tr class="text-left">
                                    <td rowspan="2" align="text-align:center!important;">2</td>
                                    <td rowspan="2"><b>Updates</b></td>
                                    <td>Reboot</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_up_reboot == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">OK</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_up_reboot == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('app_up_reboot')->get())) ? ucwords($get_checklist->notes('app_up_reboot')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>
                                <tr class="text-left">
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_up_error == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_up_error == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('app_up_error')->get())) ? ucwords($get_checklist->notes('app_up_error')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- 3. services --}}
                                <tr class="text-left">
                                    <td rowspan="1" style="text-align:center!important;">3</td>
                                    <td rowspan="1" style="text-align:center!important;"><b>Backup</b></td>
                                    <td>Error</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_backup == 1) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">YES</td>
                                    <td style="text-align: center!important;">
                                        {{ ($get_checklist->app_backup == 0) ? 'X' : '' }}
                                    </td>
                                    <td style="background-color:#efefef!important;">NO</td>
                                    <td>
                                        {{ (count($get_checklist->notes('app_backup')->get())) ? ucwords($get_checklist->notes('app_backup')->latest()->first()->notes) : '' }}
                                    </td>
                                </tr>

                                {{-- RATE --}}
                                <tr class="text-left">
                                    <td colspan="5" style="text-align:right!important;">Score</td>
                                    <td colspan="2" style="text-align:center!important;"><b>{{ $get_checklist->count ?? 0 }}/12</b></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                        <br>
                        <h2 style="font-weight: normal; ">Hasil aktiviti mendapati Server IP : {{ $ip_address->ip_address }} berada di kadar <b>{{ ($get_checklist->status == 1) ? 'OPTIMUM' : 'BUKAN OPTIMUM' }}</b>.
                            Laporan Terperinci aktiviti Preventive Maintenance telah disenaraikan di APENDIKS {{ ($no_server + 1).'.'.($no_ip+1) }}
                        </h2>
                        <br>

                    {{-- APPENDIX --}}

                    <div class="break-before"></div>

                        <h3 style="font-weight: bold; ">APENDIKS {{ ($no_server+1).'.'.($no_ip+1) }}</h3>
                        <table class="checklist_table" width="100%" border="1">
                            <thead>
                                <tr class="defaultTheme">
                                    <td colspan="8" style="text-align:center!important;">
                                        <b>SERVER</b>
                                    </td>
                                </tr>
                                <tr class="mainTheme">
                                    <th class="font-weight-bold text-center" width="5%">NO</th>
                                    <th class="font-weight-bold text-center" width="20%" colspan="2">CHECKLIST</th>
                                    <th class="font-weight-bold text-center" width="35%" colspan="2">SCREENSHOT</th>
                                    <th class="font-weight-bold text-center" width="30%">EXPLANATION</th>
                                    <th class="font-weight-bold text-center" width="10%">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($get_checklist->appendix))
                                    @foreach ( $get_checklist->appendix as $app_no => $appendix)
                                        <tr>
                                            <td>{{($app_no + 1)}}</td>
                                            <td colspan="2">{{($appendix->type) ? str_replace('_', ' ', $appendix->type) : ''}}</td>
                                            <td colspan="2">
                                                @if (!is_null($appendix->uploadedFiles($appendix->type)))
                                                    <img src="{{ public_path($appendix->uploadedFiles($appendix->type)->first()->path) }}"
                                                    align="left" width="350" height="auto" >
                                                @else
                                                No screenshot
                                                @endif
                                            </td>
                                            <td>{{$appendix->explanation}}</td>
                                            <td>{{($appendix->status == 1) ? 'Baik' : 'Tidak Baik';}}</td>
                                        </tr>

                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">TIADA DATA</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    <div class="break-before"></div>
                @endforeach
            @endforeach
        </div>
        @endforeach
    @endif
    {{-- {{dd($server_locations)}} --}}
</body>

</html>
