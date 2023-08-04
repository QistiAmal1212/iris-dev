@extends('layouts.app')

@section('header')
    Simple Test Form
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a href="#"> List Test Form </a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">PROJEK: One System</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="testFormListTable">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" width="1%">NO</th>
                                <th class="text-center" width="33%">MODULE</th>
                                <th class="text-center" width="33%">STATUS</th>
                                <th class="text-center" width="33%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
                            {{-- @if(!count($listOfTestForm))
                                <tr class="text-center">
                                    <td colspan="4"><span class='label label-lg label-light-warning'>{{__('msg.unable_generate')}}</span></td>
                                </tr>
                            @endif
                            @foreach($listOfTestForm as $testForm)
                                <tr>
                                    <th class="text-center">{{ (($listOfTestForm->currentPage() - 1) * $listOfTestForm->perPage()) + $loop->iteration }}</th>
                                    <td class="text-center">{{ $testForm->module->module_name }}</td>
                                    <td class="text-center">{{ $testForm->moduleStatus->status_name }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm d-flex justify-content-center" role="group" aria-label="Action">
                                            @if(FMF::checkPermission($testForm->module_id, $testForm->moduleStatus->status_index, 'View_Btn_Table'))
                                                <a href="{{route('testForm.index',["id"=>$testForm->id])}}" class="btn btn-xs btn-default" title=""> <i class="fas fa-eye text-primary"></i> </a>
                                            @endif
                                            @if(FMF::checkPermission($testForm->module_id, $testForm->moduleStatus->status_index, 'Edit_Btn_Table'))
                                                <a href="{{route('testForm.index',["id"=>$testForm->id])}}" class="btn btn-xs btn-default" title=""> <i class="fas fa-pencil text-warning"></i> </a>
                                            @endif
                                            @if(FMF::checkPermission($testForm->module_id, $testForm->moduleStatus->status_index, 'Delete_Btn_Table'))
                                                <a href="{{route('testForm.index',["id"=>$testForm->id])}}" class="btn btn-xs btn-default" title=""> <i class="fas fa-trash text-danger"></i> </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){

        var table = $('#testFormListTable').DataTable({
            orderCellsTop: true,
            colReorder: true,
            dom: "<'d-flex flex-row justify-content-between'<'px-2'l><'px-2'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                extend: 'colvis',
                text: 'Toggle Show/Hide Column',
                className: 'btn btn-outline-primary'
            }],
            pageLength: 2,
            processing: true,
            serverSide: false, //enable if data is large (more than 50,000)
            ajax: "{{ fullUrl() }}",
            columns:  [
                { data: 'id', defaultContent: '', orderable: false, searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                { data: "module", name: "module.module_name", render: function(data, type, row){
                    return $("<div/>").html(data).text();
                }},
                { data: "status", name: "status", render: function(data, type, row){
                    return $("<div/>").html(data).text();
                }},
                { data: "action", name: "action", orderable: false, searchable: false},
            ]
        });

    })
</script>
@endsection


