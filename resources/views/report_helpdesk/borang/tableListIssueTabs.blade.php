<ul class="nav nav-pills nav-justified" role="tablist" style="white-space: nowrap;">
    @foreach ($allOfReport as $eachReport)
        <li class="nav-item" role="presentation">
            <a class=" nav-link {{$loop->iteration == 1 ? "active" : ""}}" id="week{{$eachReport->week}}tab" data-bs-toggle="tab" href="#week{{$eachReport->week}}" role="tab"
                aria-controls="week{{$eachReport->week}}" aria-selected="true">
            @if ($eachReport->week == 0)
                Month<br>
                {{$eachReport->start_date->format('M')}} {{$eachReport->end_date->format('Y')}}
            @else
                Week {{$eachReport->week}}<br>
                ( {{$eachReport->start_date->format('d/m')}} - {{$eachReport->end_date->format('d/m')}} )
            @endif
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content" id="listIssueContainer">
@foreach ($allOfReport as $eachReport)
    <div class="tab-pane fade show {{$loop->iteration == 1 ? "active" : ""}}" id="week{{$eachReport->week}}" role="tabpanel" aria-labelledby="week{{$eachReport->week}}tab">
        @include('report_helpdesk.borang.tableListIssue',['helpdeskIssue' => $eachReport->week != 0 ? $eachReport->getIssues : $allIssues, 'reportHelpdesk' => $eachReport])
    </div>
@endforeach
</div>
