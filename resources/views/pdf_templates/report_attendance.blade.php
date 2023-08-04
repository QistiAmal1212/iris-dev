<!DOCTYPE html>
<html>

<head>
    <title>{{ $report['title'] }} ( {{ $report['month'] }} {{ $report['year'] }} ) </title>
</head>
<style>
    tr.spaceUnder>td {
        padding-bottom: 1em;
    }

    body {
        font-family: "Open Sans", Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 400;
        height: 100%;
        margin-left: 6%;
        line-height: 1.5;
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
        font-smoothing: antialiased;
        -webkit-font-smoothing: antialiased;
    }

    table.center {
        text-align: center;
    }

    .small {
        font-size: 10px;
    }

    .bold {
        font-weight: bold
    }

    .fs10 {
        font-size: 10px;
    }

    table,
    th,
    td {
        border-collapse: collapse;
    }

    table tbody td {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    table { page-break-after:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    td    { page-break-inside:avoid; page-break-after:auto }
    thead { display: table-row-group; }
    tfoot { display:table-footer-group }

    /* #tableKedatangan {
        page-break-inside:auto;
    } */

    /* #tableKedatangan > thead {
        display:table-header-group;
    }

    #tableKedatangan > tbody > tr{
        page-break-inside:avoid!important;
        break-inside: avoid-page !important;
        page-break-after:avoid;
    }

    #tableKedatangan > tbody > tr > td{
        page-break-inside:avoid!important;
        break-inside: avoid-page !important;
    } */

    #tableKedatangan tbody td:nth-child(4),
    #tableKedatangan tbody td:nth-child(5) {
        text-align: right;
    }

    #tableKedatangan tbody td:nth-child(1),
    #tableKedatangan tbody td:nth-child(2),
    #tableKedatangan tbody td:nth-child(4)[colspan]:not([colspan="1"]),
    #tableKedatangan tbody td:nth-child(6) {
        text-align: center;
    }

    #tableKedatangan tbody td:nth-child(3) {
        text-align: left;
    }

</style>
<style>
    div.content {
        border-top: 1px solid black;
    }

    #background {
        position: absolute;
        top: 250px;
        left: 180px;
        z-index: 990;
        display: block;
        min-height: 50%;
        min-width: 50%;
        color: yellow;
    }

    #bg-text {
        color: LightCoral;
        font-size: 250px;
        -webkit-transform: rotate(310deg);
        opacity: 0.3;
    }
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
    <table width="100%">
        <tr>
            <td width="30%">
                <img src="{{ public_path() }}/images/misc/unijayalogo.png" alt="Logo Syarikat Unijaya Resources" align="left"
                    width="auto" height="150">
            </td>
            <td width="70%">
                <h2>{{ $report['title'] }}</h2>
            </td>
        </tr>
    </table>
    <br>
    <hr />
    <br>
    <span class="bold">NAMA SYARIKAT :</span><span class="bold"> UNIJAYA RESOURCES SDN BHD</span>
    <br>
    <span class="bold"> BULAN :</span><span class="bold" style="text-transform: uppercase;"> {{ $report['month'] }} {{ $report['year'] }}</span>
    <br>
    <br>
    <table id="tableKedatangan" border="1" style="border-collapse:collapse" width="100%" >
        <thead style="background-color: #b4d4ac" align="center">
            <tr class="text-center">
                <th class="font-weight-bold" width="10%">HARI</th>
                <th class="font-weight-bold" width="5%">TARIKH</th>
                <th class="font-weight-bold" width="30%">SENARAI NAMA STAF</th>
                <th class="font-weight-bold" width="10%">MASA MASUK</th>
                <th class="font-weight-bold" width="10%">MASA KELUAR</th>
                <th class="font-weight-bold" width="15%">CATATAN</th>
            </tr>
        </thead>
        <tbody align="center">
            @if (!is_null($attendance))
                @php
                    $currentDate = '';
                    $rowspanCount = 0;
                @endphp
                 @foreach($attendance as $day)
                    <tr class="text-center" style="page-break-inside:avoid!important; page-break-before:avoid; page-break-after: avoid">
                        @if($currentDate != Carbon\Carbon::parse($day['work_date'])->format('Y-m-d'))
                            @php
                                $currentDate = Carbon\Carbon::parse($day['work_date'])->format('Y-m-d');
                                $rowspanCount = App\Models\ReportAttendanceStaff::whereIn('report_attendance_details_id',array($day['report_attendance_details_id']))->where('is_re',$is_re)->count();
                            @endphp
                            <td rowspan="{{$rowspanCount}}">{{ Carbon\Carbon::parse($day['work_date'])->format('l') }}</td>
                            <td rowspan="{{$rowspanCount}}">{{ Carbon\Carbon::parse($day['work_date'])->format('d/m') }}</td>
                        @endif

                        <td style="text-align:center"> {{ $day['name'] }} </td>

                        @if ($day['attended'] == 1)
                            <td style="text-align:right!important"> {{ $day['time_in'] }} </td>
                            <td style="text-align:right!important"> {{ $day['time_out']}} </td>
                            <td style="text-align:left!important"> {{ ucwords($day['note']) }} </td>
                        @else
                            <td colspan="3" style="text-align:center!important"> {{ ($day['note'] != null) || ($day['note'] != '') ? ucwords($day['note']) : 'TIDAK HADIR' }} </td>
                        @endif


                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6"> No data </td>
                </tr>
            @endif

        </tbody>
    </table>

    <div class="break-before"></div>
    <table id="tablePengesahan" border="1" style="border-collapse:collapse;margin-top:2rem;" width="100%" >
        <thead style="background-color: #f09c9c" align="center">
            <tr>
                <th class="font-weight-bold" width="50%" colspan="2">PIHAK UNIJAYA</th>
                <th class="font-weight-bold" width="50%" colspan="2">PENGESAHAN IT </th>
            </tr>
        </thead>
        <tbody style="vertical-align: bottom;text-align:left;">
            <tr >
                <td rowspan="2" width="20%"> <span>Disediakan Oleh<br>(Tandatangan)<br>Tarikh</span></td>
                <td style="border-bottom:0px;">
                    <br>
                    <img src="{{ ($signatures['penyedia_signature'] != null) ? public_path($signatures['penyedia_signature']->path) : ' ' }}" align="left"
                    width="100" height="auto" >
                </td>
                <td rowspan="2" width="25%"> <span>Disemak Oleh<br>(Tandatangan & Cop)<br>Tarikh</span></td>
                <td rowspan="2">
                    {{-- <img src="{{ public_path() }}/storage/signature.png" alt="Tandatangan Penyedia" align="left"
                    width="100" height="auto" > --}}
                </td>
            </tr>
            <tr>
                <td style="border-top:0px;">
                    <span >{{ $project->prepared_by_name ?? ' - ' }}</span>
                    <br>
                    <span >{{ $project->prepared_by_role ?? ' - ' }}</span>
                    <br>
                    <span >{{ ($project->prepared_date) ? Carbon\Carbon::parse($project->prepared_date)->format('d F Y') : ' - ' }}</span>
                </td>
            </tr>
            <tr >
                <td rowspan="2" width="20%"> <span>Disahkan Oleh<br>(Tandatangan)<br>Tarikh</span></td>
                <td style="border-bottom:0px;">
                    <br>
                    <img src="{{ ($signatures['pengesah_signature'] != null) ? public_path($signatures['pengesah_signature']->path) : ' ' }}" align="left"
                    width="100" height="auto" >
                </td>
                <td rowspan="2" width="25%">  <span>Disahkan Oleh<br>(Tandatangan & Cop)<br>Tarikh</span></td>
                <td rowspan="2">
                    {{-- <img src="{{ public_path() }}/storage/invisible.png" align="left"
                        width="100" height="auto" > --}}
                </td>
            </tr>
            <tr>
                <td style="border-top:0px;">
                    <span >{{ $project->confirmed_by_name ?? ' - ' }}</span>
                    <br>
                    <span >{{ $project->confirmed_by_role ?? ' - ' }}</span>
                    <br>
                    <span >{{ ($project->confirmed_date) ? Carbon\Carbon::parse($project->confirmed_date)->format('d F Y') : ' - ' }}</span>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
