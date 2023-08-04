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
                <h4 class="card-title">Senarai Maklumat Pengguna </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="testFormListTable" class="table">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center" width="1%">BIL</th>
                                <th class="text-center" width="33%">NAMA PENGGUNA </th>
                                <th class="text-center" width="33%">NO IC PENGGUNA</th>
                                <th class="text-center" width="33%">TINDAKAN</th>
                            </tr>
                        </thead>
                        <tbody class="table-hover">
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

        // change the id of table accordingly <table id="testFormListTable">
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
            pageLength: 5,
            processing: true,
            serverSide: false, //enable if data is large (more than 50,000)
            ajax: "{{ fullUrl() }}",
            columns:  [
                { data: 'id', defaultContent: '', orderable: false, searchable: false, render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }},
                // adjust column accordingly from here
                { data: "nama_pengguna", name: "nama_pengguna", render: function(data, type, row){
                    return $("<div/>").html(data).text();
                }},
                { data: "no_ic_pengguna", name: "no_ic_pengguna", render: function(data, type, row){
                    return $("<div/>").html(data).text();
                }},
                // until here
                { data: "action", name: "action", orderable: false, searchable: false},
            ]
        });

    })
</script>
@endsection


