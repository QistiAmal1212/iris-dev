@extends('layouts.app')

@section('header')
    <h2 class="customTitle1"> {{__('msg.notify')}}</span></h2>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item active"> {{__('msg.notify')}}</li>
@endsection

@section('content')
<div class="row mb-10">
    <div class="col-md-2">
        <a href="{{ route('notify.create') }}" class="btn btn-block btn-sm btn-new"> CREATE </a>
    </div>
    <br/><br/>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table" dt>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Notify</th>
                    <th width="10%"></th>
                </tr>
            </thead>
            <tbody>
                @if(!count($notifys))
                <tr class="text-center">
                    <td colspan="5">No data yet</td>
                </tr>
                @endif

                @foreach($notifys as $notify)
                <tr>
                    <th>{{ (($notifys->currentPage() - 1) * $notifys->perPage()) + $loop->iteration }}</th>
                    <td>{{ $notify->name }}</td>
                    <td>{!! $notify->message !!}</td>
                    <td>
                        @can('admin.notify')
                            <a href="javascript:" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#shootModal" onclick="modalShootNotify('{{ route('notify.send-view', $notify->id) }}')">
                                <i class="fas fa-paper-plane"></i>
                            </a>
                        @endcan
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Role Action">
                            @can('admin.notify.view')
                                <a href="javascript:" class="btn btn-xs btn-default" data-toggle="modal" data-target="#viewModal" onclick="viewNotify('{{ route('notify.show', $notify->id) }}')">
                                    <i class="fas fa-eye text-info"></i>
                                </a>
                            @endcan

                            @can('admin.notify.update')
                                <a href="javascript:" class="btn btn-xs btn-default" data-toggle="modal" data-target="#editModal" onclick="editNotify('{{ route('notify.edit', $notify->id) }}')">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                            @endcan
                            
                            @can('admin.notify.delete')
                                <a href="javascript:" class="btn btn-xs btn-default" onclick="destroyNotify('#formDestroyNotify_{{ $notify->id }}')"> <i class="fas fa-trash text-danger"></i> </a>
                                <form id="formDestroyNotify_{{ $notify->id }}" method="POST" action="{{ route('notify.destroy', $notify) }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE"/>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            {!! $notifys->links() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="shootModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-end mr-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="viewShootContent" class="d-flex flex-column justify-content-center align-items-center">
                </div>
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

<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row justify-content-end mr-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div id="editContent" class="d-flex flex-column justify-content-center align-items-center">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function modalShootNotify(url) {
        $('#viewShootContent').load(url);
    }

    function viewNotify(url) {
        $('#viewContent').load(url);
    }
    
    function editNotify(url) {
        $('#editContent').load(url);
    }

    function destroyNotify(formDestroyNotify) {
        Swal.fire({
            title: 'Are you sure to delete?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                $(formDestroyNotify).trigger('submit');
            }
            return false;
        });
    }

    function shootNotify(formShootNotify) {
        Swal.fire({
            title: 'Are you sure to send notification to this user?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                $(formShootNotify).trigger('submit');
            }
            return false;
        });
    }

    $(document).ready(function(){
        $('#shootModal').on('hide.bs.modal', function() {
            $('#viewShootContent').html('');
        });

        $('#viewModal').on('hide.bs.modal', function() {
            $('#viewContent').html('');
        });
        
        $('#editModal').on('hide.bs.modal', function() {
            $('#editContent').html('');
        });
    });
</script>
@endsection
