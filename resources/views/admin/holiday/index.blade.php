@extends('layouts.app')

@section('header')
    <h2 class="customTitle1"> {{__('msg.holiday')}}</span></h2>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item active"> {{__('msg.holiday')}}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs nav-fill" id="tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ !request()->tab || request()->tab == 1 ? 'active' : '' }}" id="formA-tab" data-toggle="tab" href="#formA" role="tab" aria-controls="formA" aria-selected="true">Calendar</a>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->tab == 2 ? 'active' : '' }}" id="formB-tab" data-toggle="tab" href="#formB" role="tab" aria-controls="formB" aria-selected="false">Public Holiday </a>
            </li> --}}
            {{-- <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->tab == 3 ? 'active' : '' }}" id="formC-tab" data-toggle="tab" href="#formC" role="tab" aria-controls="formC" aria-selected="false">Public Holiday </a>
            </li> --}}
            <li class="nav-item" role="presentation">
                <a class="nav-link {{ request()->tab == 4 ? 'active' : '' }}" id="formD-tab" data-toggle="tab" href="#formD" role="tab" aria-controls="formD" aria-selected="false">Weekend </a>
            </li>
        </ul>

        <div class="tab-content" id="tabContent">

            <div class="tab-pane fade {{ !request()->tab || request()->tab == 1 ? 'show active' : '' }}" id="formA" role="tabpanel" aria-labelledby="formA-tab">
                <div id="calendar"></div>
            </div>
            
            <div class="tab-pane fade {{ request()->tab == 2 ? 'show active' : '' }}" id="formB" role="tabpanel" aria-labelledby="formB-tab">
                
            </div>
            
            <div class="tab-pane fade {{ request()->tab == 3 ? 'show active' : '' }}" id="formC" role="tabpanel" aria-labelledby="formC-tab">
                
            </div>
            
            <div class="tab-pane fade {{ request()->tab == 4 ? 'show active' : '' }}" id="formD" role="tabpanel" aria-labelledby="formD-tab">
                <form action="{{ route('holiday.update_weekend') }}" method="POST">
                    @csrf
                    <div class="row pt-2 pb-2">
                        <div class="col-md-12 table-scroll">
                           
                            <table class="table" dt width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>State</th>
                                        <th>Weekend</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!count($states))
                                    <tr class="text-center">
                                        <td colspan="3">No data yet</td>
                                    </tr>
                                    @endif
                    
                                    @foreach($states as $state)
                                    <tr>
                                        <th>{{ (($states->currentPage() - 1) * $states->perPage()) + $loop->iteration }}</th>
                                        <td>{{ $state->name }}</td>
                                        <td>
                                            <div class="row pl-2">
                                                <div class="custom-control custom-switch mr-5">
                                                    <input name="is_friday_weekend{{ $state->id }}" type="radio" class="custom-control-input" id="inputWeekend{{ $state->id }}1" value="1" {{ $state->is_friday_weekend ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="inputWeekend{{ $state->id }}1">Friday / Saturday</label>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input name="is_friday_weekend{{ $state->id }}" type="radio" class="custom-control-input" id="inputWeekend{{ $state->id }}0" value="0" {{ !$state->is_friday_weekend ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="inputWeekend{{ $state->id }}0">Saturday / Sunday</label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-success float-right">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-end mr-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="viewContent" class="d-flex flex-column justify-content-center align-items-center">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<link rel="stylesheet" href="{{ asset('/plugins/fullcalendar/main.css') }}">
<script src="{{ asset('/plugins/fullcalendar/main.js') }}"></script>
<script>
    function viewModal(url) {
        $('#viewContent').load(url);
    }

    $(document).ready(function(){
        $('#viewModal').on('hide.bs.modal', function() {
            $('#viewContent').html('');
        });

        var date = new Date();
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()
        var Calendar = FullCalendar.Calendar;
        var calendar = new Calendar($('#calendar')[0], {
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth'
            },
            themeSystem: 'bootstrap',
            events: @json($events),
            editable  : false,
            droppable : false,
        });

        calendar.render();
        $('#formA-tab').on('shown.bs.tab', function (e) {
            calendar.render();
        });
    });
</script>
@endsection
