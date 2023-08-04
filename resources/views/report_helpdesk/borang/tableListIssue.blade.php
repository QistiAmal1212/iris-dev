<div class="form-row pt-1">
    <div class="col pe-0">
        <div class="form-group">
            <div class="d-flex justify-content-end align-items-center">
                <button class="btn btn-success me-1 hovertext"
                data-hover="@if($helpdeskIssue->count() > 0 )
                                Require Empty Table
                            @else
                                Autofill {{$eachReport->week == 0 ? "Month" : "Week ".$eachReport->week}}
                            @endif"
                    {{$helpdeskIssue->count() > 0 ? 'disabled' :''}}
                    onclick="autofillFromAPI(this)" data-report-helpdesk-id="{{$eachReport->id}}">
                    AutoFill From API
                </button>
                <button type="button" onclick="generatePDF(this)" data-report-helpdesk-id="{{$eachReport->id}}"
                    class="btn btn-primary float-right hovertext"
                    data-hover="{{$eachReport->week == 0 ? "Month" : "Week ".$eachReport->week }}">
                    <i class="fa-solid fa-file-pdf pr-1"></i> Preview Report
                </button>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col p-0 m-0">
        <div class="form-group tableWrapper">
            <table class="table table-striped tableHelpdeskIssue">
                <thead>
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
                        <th class="font-weight-bold" width="09%" >TINDAKAN PENGGUNA</th>
                </thead>
                <tbody>
                    @if($helpdeskIssue->count() == 0)
                    <tr>
                        <td colspan="13">TIADA DATA</td>
                    </tr>
                    @endif
                    @foreach($helpdeskIssue as $issue)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $issue->date_issued?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $issue->date_issued?->format('H:i') ?? '-' }}</td>
                        <td>{{ $issue->masterMedium->name ?? '-'}}</td>
                        <td>{{ $issue->tracking_id ?? '-'}}</td>
                        <td>{{ $issue->nama_pengguna ?? '-'}}</td>
                        <td>{{ $issue->issue_group ?? '-'}}</td>
                        <td>{{ $issue->explanation ?? '-'}}</td>
                        <td>{{ $issue->date_response?->format('d/m/Y g:i A') ?? '-'}}</td>
                        <td>{{ $issue->date_completed?->format('d/m/Y g:i A') ?? '-'}}</td>
                        <td>{{ $issue->action ?? '-'}}</td>
                        <td>{{ $issue->masterStatus?->name ?? '-'}}</td>

                        <td>
                            <div class="btn-group btn-group-sm d-flex justify-content-center"  role="group" aria-label="Action">
                                <button class="btn btn-xs btn-default" onclick="viewIssueFunction(this)" data-url="{{ route('report_helpdesk.viewIssue', $issue) }}"> <i class="fas fa-edit text-warning"></i> </button>
                                <button class="btn btn-xs btn-default" onclick="deleteIssueFunction(this)" data-form-id="formDestroyIssue_{{ $issue->id }}"> <i class="fas fa-trash text-danger"></i> </button>
                                <form class="formDestroyIssue" id="formDestroyIssue_{{ $issue->id }}" method="POST" action="{{ route('report_helpdesk.deleteIssue', $issue) }}" >
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE"/>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
