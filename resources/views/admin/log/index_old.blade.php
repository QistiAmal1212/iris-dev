@extends('layouts.app')

@section('header')
<h2 class="customTitle1"> LOG</span></h2>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="{{route('admin-log-index')}}">Log</a></li>
@endsection

@section('content')

<!-- custom search filter -->
<form method="GET">
    <div class="card collapsed-card">
        <div class="card-header border-0">
            <span class="card-title searchTitle m-0"> <i class="fas fa-search mr-1"></i> {{__('msg.advanced_search')}} </span>
            <div class="card-tools">
                <button type="button" class="btn btn-sm" data-card-widget="collapse"> <i class="fas fa-plus"></i> </button>
            </div>
        </div>
        <div class="card-body pt-2">
            <div class="row">
                <div class="form-group col-md-4">
                    <label><strong> Event </strong></label>
                    <select name="event" class="form-control">
                        <option value=""></option>
                        @foreach($eventArr as $key => $event)
                        {{-- <option value="{{ $event }}" {{ $request->event == $event ? 'selected' : '' }}> {{ $event }} </option> --}}
                        <option value="{{ $event }}"> {{ $event }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><strong> Subject Type </strong></label>
                    <select name="subject_type" class="form-control">
                        <option value=""></option>
                        @foreach($subjectTypeArr as $key => $subjectType)
                        {{-- <option value="{{ $subjectType }}" {{ $request->subject_type == $subjectType ? 'selected' : '' }}> {{ $subjectType }} </option> --}}
                        <option value="{{ $subjectType }}"> {{ $subjectType }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label><strong> Causer </strong></label>
                    <select name="causer_id" class="form-control">
                        <option value=""></option>
                        @foreach($users as $user)
                        {{-- <option value="{{ $user->id }}" {{ $request->causer_id == $user->id ? 'selected' : '' }}> {{ $user->name }} </option> --}}
                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label><strong> Date Start </strong></label>
                    {{-- <input type="date" name="date_start" value="{{ $request->date_start }}" class="form-control" /> --}}
                    <input type="date" name="date_start" value="" class="form-control" />
                </div>

                <div class="form-group col-md-4">
                    <label><strong> Date End </strong></label>
                    {{-- <input type="date" name="date_end" value="{{ $request->date_end }}" class="form-control" /> --}}
                    <input type="date" name="date_end" value="" class="form-control" />
                </div>

                <div class="col-2">
                    <label><strong></strong></label>
                    <input type="submit" value="Filter" class="btn btn-block btn-success" />
                </div>

                <div class="col-2">
                    <label><strong></strong></label>
                    <a href="{{ route('admin-log-index') }}" class="btn btn-block btn-secondary"> Reset </a>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- /.custom search filter -->

<div class="row">

    <div class="col-md-12 table-scroll">
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th> ID </th>
                    {{-- <th> Log Name </th> --}}
                    {{-- <th> Description </th> --}}
                    <th> Event </th>
                    <th> Subject Type </th>
                    <th> Subject ID </th>
                    <th> Causer </th>
                    <th> DateTime </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                <tr>
                    <td> {{ $activity->id }} </td>
                    {{-- <td> {{ $activity->log_name }} </td> --}}
                    {{-- <td> {{ $activity->description }} </td> --}}
                    <td> {{ $activity->event }} </td>
                    <td> {{ $activity->subject_type }} </td>
                    <td> {{ $activity->subject_id }} </td>
                    <td> {{ $activity->causer ? $activity->causer->name : '' }} </td>
                    <td> {{ $activity->created_at->format('d/m/Y h:ia') }} </td>
                    <td> <button type="button" class="btn btn-sm btn-default btnViewLog" data-activity="{{ $activity->activity_json }}" data-properties="{{ $activity->properties }}"><i class="fas fa-eye"></i></button> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {!! $activities->links() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="viewLogModal" tabindex="-1" role="dialog" aria-labelledby="viewLogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLogModalLabel">View Log</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">

                        <div class="form-group">
                            <label> Description </label>
                            <input type="text" id="description" name="description" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label> Subject Type </label>
                            <input type="text" id="subject_type" name="subject_type" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label> Event </label>
                            <input type="text" id="event" name="event" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label> Created at </label>
                            <input type="text" id="created_at" name="created_at" class="form-control" disabled>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <pre id="logDetail"></pre>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".btnViewLog").on('click', function(){

        $("#description").val('');
        $("#subject_type").val('');
        $("#event").val('');
        $("#created_at").val('');

        var activity_json = $(this).attr('data-activity');

        try {
            var activity_obj = JSON.parse(activity_json);
            console.log(activity_obj);

            $("#description").val(activity_obj.description);
            $("#subject_type").val(activity_obj.subject_type);
            $("#event").val(activity_obj.event);
            $("#created_at").val(activity_obj.created_at);

        } catch (error) {

        }

        $("#logDetail").html('');
        var data_raw = $(this).attr('data-properties');
        if (isJson(data_raw)) {
            data_raw = JSON.stringify(JSON.parse(data_raw), null, 3);
        }

        $("#logDetail").html(data_raw);
        $("#viewLogModal").modal('show');
    });

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
</script>
@endsection
