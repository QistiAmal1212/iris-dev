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
    <table class="cover_page_table" width="100%" height="100%" style="margin-top:5%!important;">
        <tr>
            <td colspan="2" class="text-center">
                {{-- <img src="{{ public_path() }}/images/jata-negara.png" alt="Logo Syarikat Unijaya Resources"
                    width="auto" height="100"> --}}
                <h2><u>LAPORAN PENYELENGGARAAN</u></h2>
            </td>
        </tr>
        <tr>
            <td width="20%">
                <img src="{{ public_path() }}/images/misc/unijayalogo.png" alt="Logo Syarikat Unijaya Resources"
                    align="left" width="auto" height="60">
            </td>
            <td width="90%" style="text-align: left; padding-left:5%!important;">
                <h2>LAPORAN KERJA-KERJA PENYELENGGARAAN {{$project->name}}</h2>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="left">
                <table border="1" width="40%" style="margin-top:3%;">
                    <tr>
                        <td width="40%;" class="defaultTheme">
                            <strong>AKTIVITI</strong>
                        </td>
                        <td width="60%;">
                            CM {{ $cm_report->id ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td width="40%;" class="defaultTheme">
                            <strong>NAMA SISTEM</strong>
                        </td>
                        <td width="60%;">
                            {{$project->name}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table width="100%" height="100%" border="1" style="font-size: 12px;">
        <thead>
            <tr>
                <td style="text-align: center;" colspan="4">
                    <strong>MAKLUMAT AM</strong>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="defaultTheme">
                    <strong>Lokasi<br>Penyelenggaraan</strong>
                </td>
                <td colspan="3">
                    <strong>{{$server_location->address}}</strong>
                </td>
            </tr>
            <tr>
                <td class="defaultTheme"><strong>Tarikh (Hari)</strong></td>
                <td>{{ $cm_report->date_reported ?? '-' }}</td>
                <td class="defaultTheme"><strong>Masa</strong></td>
                <td>{{ $cm_report->time_reported ?? '-' }}</td>
            </tr>
            <tr>
                <td class="defaultTheme"><strong>Nama Pegawai Bertugas</strong></td>
                <td></td>
                <td class="defaultTheme"><strong>Nama Kakitangan (Unijaya)</strong></td>
                <td>{{ $cm_report->staff_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="defaultTheme"><strong>Jawatan</strong></td>
                <td></td>
                <td class="defaultTheme"><strong>Jawatan</strong></td>
                <td>{{ $cm_report->staff_role ?? '-' }}</td>
            </tr>
            <tr>
                <td class="defaultTheme"><strong>No Telefon<br>(Untuk dihubungi)</strong></td>
                <td></td>
                <td class="defaultTheme"><strong>No Telefon<br>(Untuk dihubungi)</strong></td>
                <td>{{ $cm_report->staff_phone_no ?? '-' }}</td>
            </tr>
            <tr>
                <td class="defaultTheme"><strong>Email</strong></td>
                <td></td>
                <td class="defaultTheme"><strong>Email</strong></td>
                <td>{{ $cm_report->staff_email ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    {{-- reported incidents --}}
    <div class="break-before"></div>
    <table width="100%" height="100%" border="1" style="font-size: 12px;">
        @if (count($cm_report->appendix()->get()))
            @foreach ($cm_report->appendix as $form)
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
