@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item">{{__('msg.applicationlist')}}</li>
@endsection

@section('header')
   HELPDESK REPORT
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">PROJEK: {{$project->name}}</h4>
            </div>
            <div class="card-body">

            <table class="table header_uppercase table-bordered table-responsive">
                <thead>
                    <tr class="text-center">
                        <th width="5%" orderable class="text-center">MONTH</th>
                        <th width="5%" orderable class="text-center">YEAR</th>
                        <th width="15%" orderable class="text-center">STATUS</th>
                        <th width="5%" name="action_btn" class="text-center">ACTION</th>
                    </tr>
                </thead>
                <tbody class="table-hover">
                    @php
                        $currentMonth = 0;
                        $index = 0;
                    @endphp
                    @if ($listOfReport->count() > 0)
                        @foreach($listOfReport as $report)
                            <tr class="text-center">
                                {{-- new --}}
                                @if($currentMonth != $report->month)
                                    @php
                                        $currentMonth = $report->month;
                                    @endphp
                                    <td  class="text-center">{{ Carbon\Carbon::parse($report->start_date)->format('M') }}</td>

                                    <td  class="text-center">{{ $report->year }}</td>
                                    <td>
                                        @if($report->status == 1)
                                            <span class="badge rounded-pill badge-light-success me-1">SELESAI</span>
                                        @elseif($report->status == 2)
                                            <span class='label label-lg label-light-warning blink_50 label-inline' style='white-space:nowrap !important'>BELUM SELESAI</span>
                                        @else
                                            <span class="badge rounded-pill badge-light-warning me-1">BELUM SELESAI</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Action">
                                            <a type="button" class="btn btn-outline-dark waves-effect" href="{{route('report_helpdesk.viewborang',[$report->id, 0])}}">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a type="button" class="btn btn-outline-dark waves-effect" href="{{route('report_helpdesk.viewPDF',  [$report->id, 2] ).'#view=FitH' }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Report Team" target="_blank">
                                                <i data-feather="download"></i>
                                            </a>
                                        </div>
                                    </td>

                                @else
                                    @php
                                        continue;
                                    @endphp

                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="5"><span class='label label-lg label-light-warning'>{{__('msg.unable_generate')}}</span></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {!! $listOfReport->links() !!}
            </div>

        </div>
    </div>

    </div>
</div>
@endsection


