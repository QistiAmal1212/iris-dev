<!DOCTYPE html>
<html>

<head>
    <title>{{$reportHelpdesk->title ?? "LAPORAN MEJA BANTU "}}</title>
</head>
<style>

    body {
        font-family: "Open Sans", Helvetica, Arial, sans-serif;
        font-size: 14px;
        font-weight: 400;
        height: 100%;
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

    .uppercase {
        text-transform:uppercase;
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

    /* tr {
        page-break-inside: avoid !important;
        page-break-after: auto !important;
    } */

    table { page-break-after:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    td    { page-break-inside:avoid; page-break-after:auto }
    thead { display: table-row-group; }
    tfoot { display:table-footer-group }

    //Start Table HelpdeskIssue RE CSS
    .tableHelpdeskIssue thead {
        text-align: center;
    }
    .tableHelpdeskIssue tbody td:nth-child(2),
    .tableHelpdeskIssue tbody td:nth-child(3),
    .tableHelpdeskIssue tbody td:nth-child(9),
    .tableHelpdeskIssue tbody td:nth-child(10) {
        text-align: right;
    }

    .tableHelpdeskIssue tbody td:nth-child(1),
    .tableHelpdeskIssue tbody td:nth-child(12) {
        text-align: center;
    }

    .tableHelpdeskIssue tbody td:nth-child(4),
    .tableHelpdeskIssue tbody td:nth-child(5),
    .tableHelpdeskIssue tbody td:nth-child(6),
    .tableHelpdeskIssue tbody td:nth-child(7),
    .tableHelpdeskIssue tbody td:nth-child(8),
    .tableHelpdeskIssue tbody td:nth-child(11), {
        text-align: left;
    }
    //End Table HelpdeskIssue RE CSS


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
                <h2>{{$reportHelpdesk->title ?? "LAPORAN MEJA BANTU "}}</h2>
            </td>
        </tr>
    </table>
    <br>
    <hr />
    <br>
    <table border="1" class="tableHelpdeskIssue" style="border-collapse:collapse" width="100%" >
        <thead style="background-color: #b4d4ac" align="center">
            <tr>
                <th class="font-weight-bold" width="02%">No</th>
                <th class="font-weight-bold" width="06%">TARIKH TERIMA</th>
                <th class="font-weight-bold" width="06%">MASA TERIMA</th>
                <th class="font-weight-bold" width="06%">MEKANISMA</th>
                <th class="font-weight-bold" width="06%">ID</th>
                <th class="font-weight-bold" width="06%">NAMA PENGGUNA</th>
                <th class="font-weight-bold" width="06%">KUMPULAN ISU</th>
                <th class="font-weight-bold" width="25%">PENERANGAN</th>
                <th class="font-weight-bold" width="06%">MASA RESPON</th>
                <th class="font-weight-bold" width="06%">MASA SELESAI</th>
                <th class="font-weight-bold" width="25%">TINDAKAN</th>
                <th class="font-weight-bold" width="06%">STATUS</th>
            </tr>
        </thead>
        <tbody >
            @foreach($issues as $issue)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $issue->date_issued?->format('d/m/Y') ?? '-' }}</td>
                <td>{{ $issue->date_issued?->format('g:i A') ?? '-' }}</td>
                <td>{{ $issue->masterMedium->name ?? '-'}}</td>
                <td>{{ $issue->tracking_id ?? '-'}}</td>
                <td>{{ $issue->nama_pengguna ?? '-'}}</td>
                <td>{{ $issue->issue_group ?? '-'}}</td>
                <td>{{ $issue->explanation ?? '-'}}</td>
                <td>{{ $issue->date_response?->format('d/m/Y g:i A') ?? '-'}}</td>
                <td>{{ $issue->date_completed?->format('d/m/Y g:i A') ?? '-'}}</td>
                <td>{{ $issue->action ?? '-'}}</td>
                <td>{{ $issue->masterStatus?->name ?? '-'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br><br>
    <table class="break-before" id="tablePengesahan" border="1" style="border-collapse:collapse;margin-top:20px;" width="100%" >
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
                    <img src="{{ $reportHelpdesk->uploadedFiles('signature_penyedia')->first() ? public_path($reportHelpdesk->uploadedFiles('signature_penyedia')->first()->path) : ''}}"
                    align="left" width="100" height="auto" >
                </td>
                <td rowspan="2" width="25%"> <span>Disemak Oleh<br>(Tandatangan & Cop)<br>Tarikh</span></td>
                <td rowspan="2">  <img src="{{ public_path() }}/images/misc/invisible.png" align="left"
                    width="100" height="auto" >
                </td>
            </tr>
            <tr>
                <td style="border-top:0px;">
                    <span class="uppercase"> {{$reportHelpdesk->nama_penyedia  ?? ''}}</span>
                    <br>
                    <span class="uppercase"> {{$reportHelpdesk->jawatan_penyedia  ?? ''}}</span>
                    <br>
                    <span class="uppercase"> {{$reportHelpdesk->tarikh_disediakan ? $reportHelpdesk->tarikh_disediakan->format('d F Y') :''}}</span>
                </td>
            </tr>
            <tr >
                <td rowspan="2" width="20%"> <span>Disahkan Oleh<br>(Tandatangan)<br>Tarikh</span></td>
                <td style="border-bottom:0px;">
                    <br>
                    <img src="{{ $reportHelpdesk->uploadedFiles('signature_pengesah')->first() ? public_path($reportHelpdesk->uploadedFiles('signature_pengesah')->first()->path) : ''}}"
                    align="left" width="100" height="auto" >
                </td>
                <td rowspan="2" width="25%">  <span>Disahkan Oleh<br>(Tandatangan & Cop)<br>Tarikh</span></td>
                <td rowspan="2">
                    <img src="{{ public_path() }}/images/misc/invisible.png" align="left"
                        width="100" height="auto" >
                </td>
            </tr>
            <tr>
                <td style="border-top:0px;">
                    <span class="uppercase"> {{$reportHelpdesk->nama_pengesah ?? ''}}</span>
                    <br>
                    <span class="uppercase"> {{$reportHelpdesk->jawatan_pengesah ?? ''}}</span>
                    <br>
                    <span class="uppercase"> {{$reportHelpdesk->tarikh_disahkan ? $reportHelpdesk->tarikh_disahkan->format('d F Y') : ''}}</span>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
