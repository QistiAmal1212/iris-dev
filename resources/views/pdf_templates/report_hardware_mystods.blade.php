<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>LAPORAN PENYELENGGARAAN {{$project->name}}</title>
</head>

<style>

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
        line-height: 1px!important;
        padding-top: 1px;
        padding-bottom: 1px;
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
        padding-top: 20px !important;
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

    .purple-bold{
        color: #7d0f76;
        font-weight: 800;
    }

    .green-light-header{
        background-color: #D8EAD2;
        color: #000000;
        font-weight: 800;
    }

    .silver-header{
        background-color: #e5e5e5;
        color: #000000;
    }
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
    <div style=" margin-left: auto;margin-right: auto;width: 100%; margin-top:10%!important;">
        <table class="cover_page_table" width="100%" height="100%" style="margin-top:10%!important;">
            <tr>
                <td colspan="2" class="text-center">
                    <img src="{{ public_path() }}/images/misc/jata-negara.png" alt="Logo Syarikat Unijaya Resources"
                        width="auto" height="100">
                    <h2>DOKUMEN</br>LAPORAN CORRECTIVE MAINTENANCE</br>APLIKASI SISTEM {{$project->name}}</h2>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <h2>BULAN:</br>{{ strtoupper(Carbon\Carbon::parse($cm_report->date_reported)->format('M Y')) ?? '-' }}
                    </br>(Tempoh laporan: 1-31 Aug 2022)
                    </h2>
                </td>
            </tr>
        </table>
        <br>
        <br>
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

    {{-- SEMAKAN DAN PENGESAHAN DOKUMEN --}}
    <div class="break-before">
        <br>
        <h2>SEMAKAN DAN PENGESAHAN DOKUMEN</h2>
        <br>
        <h2 style="font-weight: normal; ">
            Pegawai yang terlibat untuk menurunkan tandatangan sebagai semakan dan pengesahan kepada maklumat-maklumat yang terkandung di dalam dokumen.
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
                    <td><h3 style="font-weight: normal;">Haryati Moktar</h3></td>
                    <td><h3 style="font-weight: normal;">Pengurus Projek</h3></td>
                    <td>
                        {{-- <img src="{{
                        (count($pm_report->uploadedFiles('signature_pengesah')->get())) ? public_path($pm_report->uploadedFiles('signature_pengesah')->latest()->first()->path) : ' '
                        }}" align="left" width="100" height="auto" > --}}
                    </td>
                    <td>31 August 2022</td>
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
                    <td><h3 style="font-weight: normal;">Pn. Fauziah Binti Che Mustafa</h3></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                    <td>

                    </td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                </tr>
                <tr >
                    <td><h3 style="font-weight: normal;">Tn. Mohd Zaidi bin Zakeria@Bakri</h3></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                    <td></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                </tr>
                <tr >
                    <td><h3 style="font-weight: normal;">Tn. Arnold Denis Paut</h3></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                    <td></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                </tr>
                <tr >
                    <td><h3 style="font-weight: normal;">Tn. Fazlee bin Abu Bakar</h3></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                    <td></td>
                    <td><h3 style="font-weight: normal;"></h3></td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- LAPORAN CORRECTIVE MAINTENANCE --}}
    <div class="break-before">
        <br>
        <h2>LAPORAN CORRECTIVE MAINTENANCE {{$project->name}}</h2>
        <br>
        {{-- PENYEDIA DETAILS --}}
        <table width="100%">
            <tr style="line-height: 1px;">
                <td width="25%" style="text-align: left"><h2><b>DISEDIAKAN OLEH : </b></h2></td>
                <td width="35%" style="text-align: left"><h2 style="font-weight: 500!important;">Adli Ikhwan</h2></td>
                <td width="15%" style="text-align: left"><h2><b>TARIKH : </b></h2></td>
                <td width="25%" style="text-align: left"><h2 style="font-weight: 500!important;">31/08/2022</h2></td>
            </tr>
            <tr style="line-height: 1px;">
                <td width="25%" style="text-align: left"><h2><b>JAWATAN : </b></h2></td>
                <td width="35%" style="text-align: left"><h2 style="font-weight: 500!important;">Pengurus Teknikal</h2></td>
                <td width="15%" style="text-align: left"><h2><b>DOKUMEN : </b></h2></td>
                <td width="25%" style="text-align: left"><h2 style="font-weight: 500!important;">v1.0</h2></td>
            </tr>
        </table>
        <br>
        {{-- PROJECT INFO --}}
        <div class="subHeader center">
            <h2>PROJECT INFORMATION</h2>
        </div>
        <br>
        <table width="100%" border="1" >
            <tbody>
                <tr style="line-height: 20px;">
                    <td width="30%" class="mainTheme"><h2>NAMA PROJEK</h2></td>
                    <td width="70%">
                        <h2 style="font-weight: 500!important;">PEMBAHARUAN LESEN PERISIAN DAN PENYELENGGARAAN SISTEM CUKAI PERKHIDMATAN KE ATAS PERKHIDMATAN DIGITAL (MySToDS)</h2>
                    </td>
                </tr>
                <tr style="line-height: 1px;">
                    <td width="30%" class="mainTheme"><h2>NAMA KEMENTERIAN</h2>
                    <td width="70%">
                        <h2 style="font-weight: 500!important;">{{$pm_report->project->client?->name ?? "-"}}</h2>
                    </td>
                </tr>
                <tr style="line-height: 1px;">
                    <td width="30%" class="mainTheme"><h2>TARIKH MULA PROJECT</h2>
                    <td width="70%">
                         <h2 style="font-weight: 500!important;">{{strtoupper(Carbon::createFromDate($pm_report->end_date, 1)->format('d M Y'))}}</h2>
                    </td>
                </tr>
                <tr style="line-height: 1px;">
                    <td width="30%" class="mainTheme" ><h2>TARIKH AKHIR PM</h2>
                    <td width="70%">
                        <h2 style="font-weight: 500!important;">{{strtoupper(Carbon::createFromDate($pm_report->end_date, 1)->format('d M Y'))}}</h2>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="subHeader center">
            <h2>INTRODUCTION</h2>
        </div>
        <br>
        <h2>IDENTITI PROJEK</h2>
        <h2 style="font-weight: 500!important;">Glosari yang akan terlibat di dalam Laporan ini adalah seperti jadual di bawah :</h2>
        <br>
        <table class="abreviasi_table" width="100%" border="1" >
            <thead>
                <tr class="mainTheme center" style="line-height: 1px;">
                    <td><h2>ABREVIASI</h2></td>
                    <td><h2>KETERANGAN</h2></td>
                </tr>
            </thead>
            <tbody>
                @if(!is_null($project_abbvr))
                    @foreach ($project_abbvr as $abvr)
                        <tr style="line-height: 1px;">
                            <td><h2 style="font-weight: 500!important;">{{$abvr->abbreviation}}</h2></td>
                            <td><h2 style="font-weight: 500!important;">{{$abvr->description}}</h2></td>
                        </tr>
                    @endforeach
                @else
                    <tr style="line-height: 1px;">
                        <td colspan="2" align='center'><h2 style="font-weight: 500!important;">TIADA REKOD</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- OBJECTIVE --}}
    <div class="break-before">
        <br>
        <h2>Objektif</h2>
        <h2 style="font-weight: 500!important;">Objektif laporan ini adalah untuk makluman kepada pihak BTM,
            statistik dan laporan terperinci bagi semua insiden yang telah di laporkan mengikut segmen-segmen berikut :</h2>
        <br>
        <ol>
            <li>Infrastruktur :</li>
            <ol type="a">
                <li>VM Application</li>
                <li>VM DB</li>
                <li>VM DRC</li>
            </ol>
            <li>Aplikasi</li>
            <li>Chatting</li>
        </ol>
        <br>
        <div class="subHeader center">
            <h2>RINGKASAN LAPORAN</h2>
        </div>
        <h2 style="font-weight: 500!important;">Ringkasan Laporan Keseluruhan Penyelenggaraan untuk
        <span class="purple-bold">Bulan August 2022</span> adalah seperti berikut :</h2>
        <table class="evaluation_table" width="100%" border="1">
            <thead>
                <tr class="silver-header">
                    <th>MASALAH MENGIKUT APLIKASI DAN INFRASTRUKTUR</th>
                    <th>SELESAI</th>
                    <th>DALAM PROSES</th>
                    <th>MAKLUMBALAS PENGGUNA</th>
                    <th>CR-CHANGE REQUEST</th>
                    <th>TANGGUH</th>
                    <th>JUMLAH KESELURUHAN KES MENGIKUT APLIKASI</th>
                </tr>
                <tr>
                    <th class="green-light-header" colspan="7" style="text-align: center;">
                        INFRASTRUKTUR
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>VM Application</td>
                   <td>0</td>
                   <td>0</td>
                   <td>0</td>
                   <td>0</td>
                   <td>0</td>
                   <td>0</td>
                </tr>
                <tr>
                    <td>VM DB</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                 </tr>
                 <tr>
                    <td>VM DRC</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                 </tr>
                 <tr>
                    <td class="green-light-header">APLIKASI</td>
                    <td>14</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>14</td>
                 </tr>
                 <tr>
                    <td class="green-light-header">CHATTING</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                 </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td> JUMLAH KES MENGIKUT STATUS</td>
                    <td>14</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>14</td>
                </tr>
            </tfoot>
        </table>
        <br>
        <h2 style="font-weight: 500!important;">Laporan ralat terperinci bagi VM Aplikasi, VM Database, VM DRC & Chatting disenaraikan
        di <span class="purple-bold">APENDIKS 1(sekiranya ada)</span>. Manakala laporan ralat bagi Aplikasi terdapat di Application Report.
        Contoh laporan Corrective Maintenance berada di <span class="purple-bold">APENDIKS 2</span>.</h2>
    </div>

    {{-- APPENDIX --}}
    <div class="break-before">
        <h2 class="purple-bold">APENDIKS 1</h2>
        <table width="100%" height="100%" border="1" style="font-size: 12px;">
            @if (count($cm_report->appendix()->get()))
                @foreach ($cm_report->appendix as $form)
                {{-- {{dd(html_entity_decode($form->issue_reported))}} --}}
                    <tr>
                        <td width="20%" class="defaultTheme">Isu Dilaporkan</td>
                        <td width="80%">
                            {!! html_entity_decode($form->issue_reported) ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" class="defaultTheme">Kelas Isu</td>
                        <td width="80%">
                            {{$form->issue_class}}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" class="defaultTheme">Tindakan</td>
                        <td width="80%">
                            {!! html_entity_decode($form->action) ?? '' !!}
                        </td>
                    </tr>
                    <tr>
                        <td width="20%" class="defaultTheme">Status</td>
                        <td width="80%">
                            {!! html_entity_decode($form->status) ?? '' !!}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="2">Tiada Isu dilaporkan</td>
                </tr>
            @endif
        </table>
    </div>

    {{-- signature --}}
    <div class="break-before"></div>
    <table width="100%" height="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <td colspan="2"><strong>UNIJAYA RESOURCES SDN BHD</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">
                                <img src="{{
                                    (count($cm_report->uploadedFiles('staff_signature')->get())) ? public_path($cm_report->uploadedFiles('staff_signature')->latest()->first()->path) : ''
                                    }}" align="left" width="100" height="auto" >
                                    <br>
                                    _______________
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Tandatangan
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Nama
                            </td>
                            <td width="80%">
                                {{ $cm_report->staff_name ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Tarikh
                            </td>
                            <td width="80%">
                                {{ $cm_report->signature_date ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                No Telefon
                            </td>
                            <td width="80%">
                                {{ $cm_report->staff_phone_no ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">
                                <img src="{{
                                    (count($cm_report->uploadedFiles('staff2_signature')->get())) ? public_path($cm_report->uploadedFiles('staff2_signature')->latest()->first()->path) : ''
                                    }}" align="left" width="100" height="auto" >
                                   <br>
                                   _______________
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Tandatangan
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Nama
                            </td>
                            <td width="80%">
                                {{ $cm_report->staff2_name ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Tarikh
                            </td>
                            <td width="80%">
                                {{ $cm_report->signature_date ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                No Telefon
                            </td>
                            <td width="80%">
                                {{ $cm_report->staff2_phone_no ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table width="100%" height="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <td colspan="2"><strong>JABATAN HAL EHWAL KESATUAN SEKERJA, KEMENTERIAN SUMBER MANUSIA</strong></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">_______________</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Tandatangan
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Nama
                            </td>
                            <td width="80%">

                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Tarikh
                            </td>
                            <td width="80%">

                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                No Telefon
                            </td>
                            <td width="80%">

                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td colspan="2">_______________</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Tandatangan
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Nama
                            </td>
                            <td width="80%">

                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                Tarikh
                            </td>
                            <td width="80%">

                            </td>
                        </tr>
                        <tr>
                            <td width="20%">
                                No Telefon
                            </td>
                            <td width="80%">

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
