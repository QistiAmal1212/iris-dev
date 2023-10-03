@extends('layouts.app')

@section('header')
    Peranan
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a>Peranan</a></li>
@endsection

@section('content')
<style>
    #RoleList thead th {
        vertical-align: middle;
        text-align: center;
    }

    #RoleList tbody {
        vertical-align: middle;
    }

    #RoleList {
        width: 100% !important;
        /* word-wrap: break-word; */
    }
</style>

<div class="col-md-6 col-sm-12">
    <div class="card">
        <div id="userFormDiv">
            @include('admin.role.roleForm')
        </div>
    </div>
</div>

<div class="row match-height">
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Jumlah Peranan [Dalaman}</span>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="{{asset('images/avatars/2.png')}}" alt="Avatar" />
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                    <div class="role-heading">
                        <h4 class="fw-bolder">{{ $countInternalRoles }}</h4>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#internal_list" aria-controls="internal_list" title="">
                            <i class="fa-solid fa-chevron-down"></i>
                            Lihat Senarai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Jumlah Peranan [Luaran}</span>
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                            <img class="rounded-circle" src="{{asset('images/avatars/4.png')}}" alt="Avatar" />
                        </li>
                    </ul>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                    <div class="role-heading">
                        <h4 class="fw-bolder">{{ $countExternalRoles }}</h4>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#external_list" aria-controls="external_list" title="">
                            <i class="fa-solid fa-chevron-down"></i>
                            Lihat Senarai
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="row">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end justify-content-center h-100">
                        <img src="{{asset('images/illustration/faq-illustrations.svg')}}" class="img-fluid mt-2" alt="Image" width="85"/>
                    </div>
                </div>
                <div class="col-sm-7">
                    {{-- @can('admin.role.create') --}}
                    @if($accessAdd)
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <!-- <a onclick="viewRoleForm()" class="stretched-link text-nowrap add-new-role"> -->
                            <a onclick="viewForm()" class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Tambah Perananan</span>
                            </a>
                            <p class="mb-0 text-muted">Tambah peranan, jika peranan belum wujud.</p>
                        </div>
                    @endif
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Senarai Peranan</h4>
        {{-- @can('admin.role.create') --}}
            {{-- <a href="{{ route('role.create') }}" class="btn btn-primary float-right hovertext waves-effect waves-float waves-light"> CREATE </a> --}}
            {{-- <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-success btn-sm float-right" onclick="viewRoleForm()">
                    <i class="fa-solid fa-add"></i> Add
                </button>
            </div>
        @endcan --}}
    </div>

    <hr>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table header_uppercase table-bordered" id="RoleList">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Peranan</th>
                        <th>Nama Peranan</th>
                        <th>Nama Paparan</th>
                        <th>Penerangan</th>
                        <th>Jenis Peranan</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@include('admin.role.external_roles')
@include('admin.role.internal_roles')
@endsection

@section('script')
<script>
    var action = '';
    //ACTION FORM
    function actionForm(id, FormAction){
        action= FormAction;
        viewForm(id);
    }

    $(function() {
        var table = $('#RoleList').DataTable({
            orderCellsTop: true,
            colReorder: false,
            pageLength: 10,
            processing: true,
            serverSide: true, //enable if data is large (more than 50,000)
            ajax: {
                url: "{{ fullUrl() }}",
                cache: false,
            },
            columns: [{
                    defaultContent: '',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "id",
                    name: "id",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "name",
                    name: "name",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "display_name",
                    name: "display_name",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "description",
                    name: "description",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: "is_internal",
                    name: "is_internal",
                    render: function(data, type, row) {
                        return $("<div/>").html(data).text();
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },

            ],
        });

    });

    viewRoleForm = function(id = null){
        var roleFormModal;
        roleFormModal = new bootstrap.Modal(document.getElementById('roleFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#roleForm').attr('action', '{{route("role.store")}}');
            $('#roleForm input[name="_method"]').attr('value', 'POST');
            $('#roleForm input[name="role_name"]').val("");
            $('#roleForm textarea[name="role_description"]').val("");
            $('#roleForm input[name="role_display"]').val("");
            $('#roleForm select[name="role_level"]').val("");
            $('#roleForm input[name="permissions[]"]').each(function(){
                $(this).removeAttr('checked')
            });
            $('#sub_title').html('Add Role');

            $('#roleFormModal #btnRoleAdd').html('{{__("msg.submit")}}');
            roleFormModal.show();
        }else{
            url = "{{route('role.editting',':replaceThis')}}"
            url = url.replace(':replaceThis',id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    id_used = data.detail.id;
                    // console.log(id_used);
                    url2 = "{{route('role.update',':replaceThis')}}"
                    url2 = url2.replace(':replaceThis',id_used);

                    $('#roleForm').attr('action',url2 );
                    $('#roleForm input[name="_method"]').attr('value','PUT' );
                    $('#roleForm input[name="role_name"]').val(data.detail.name);
                    $('#roleForm textarea[name="role_description"]').val(data.detail.description);
                    $('#roleForm input[name="role_display"]').val(data.detail.display_name);
                    $('#roleForm select[name="role_level"]').val(data.detail.is_internal);
                    $('#roleForm input[name="permissions[]"]').each(function(){
                        if(data.detail.listOfPermission.includes(parseInt(this.value)))
                            $(this).attr('checked','checked')
                        else
                            $(this).removeAttr('checked')
                    });
                    $('#sub_title').html('Edit Role');

                    $('#roleFormModal #btnRoleAdd').html('{{__("msg.update")}}');
                    roleFormModal.show();
                },
            });
        }
    };

    // EDIT FORM
    viewForm = function(id = null){
        var roleFormModal;
        roleFormModal = new bootstrap.Modal(document.getElementById('roleFormModal'), { keyboard: false});

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#roleForm').attr('action', '{{route("role.store")}}');
            $('#roleForm input[name="role_name"]').val("");
            $('#roleForm textarea[name="role_description"]').val("");
            $('#roleForm input[name="role_display"]').val("");
            $('#roleForm select[name="role_level"]').val("").trigger('change');
            $('#roleForm select[name="access_function[]"]').val("").trigger('change');
            $("#level_one").attr("onchange","showListMenu('one')");
            $('#roleForm select[name="level_one[]"]').val("").trigger('change');
            $('#level_two').empty();
            $("#next_two").attr("onclick","showNextMenu('two','one')");
            $("#level_two").attr("onchange","showListMenu('two')");
            $('#roleForm select[name="level_two[]"]').val("").trigger('change');
            $('#level_three').empty();
            $("#next_three").attr("onclick","showNextMenu('three','two')");
            $("#level_three").attr("onchange","showListMenu('three')");
            $('#roleForm select[name="level_three[]"]').val("").trigger('change');

            $('#role-details-trigger').addClass('active');
            $('#menu-one-trigger').removeClass('active');
            $('#menu-two-trigger').removeClass('active');
            $('#menu-three-trigger').removeClass('active');

            $('#role-details').addClass('active dstepper-block');
            $('#menu-one').removeClass('active dstepper-block');
            $('#menu-two').removeClass('active dstepper-block');
            $('#menu-three').removeClass('active dstepper-block');

            $('#title-role').html('Tambah Peranan');

            if(accessAdd == ''){
                $('#btn_fake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btn_fake').attr('hidden', false);
            }

            roleFormModal.show();
        }else{
            url = "{{route('role.editRole',':replaceThis')}}"
            url = url.replace(':replaceThis',id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    id_used = data.detail.id;
                    // console.log(id_used);
                    if(action==='edit'){
                        url2 = "{{route('role.updateRole',':replaceThis')}}"
                        url2 = url2.replace(':replaceThis',id_used);
                    }else{
                        url2 = "{{route('role.store')}}"
                    }

                    $('#roleForm').attr('action',url2 );
                    $('#roleForm input[name="role_name"]').val(data.detail.name);
                    $('#roleForm textarea[name="role_description"]').val(data.detail.description);
                    $('#roleForm input[name="role_display"]').val(data.detail.display_name);
                    $('#roleForm select[name="role_level"]').val(data.detail.is_internal? 1 : 0).trigger('change');
                    $('#roleForm select[name="access_function[]"]').val(data.detail.listFunction).trigger('change');
                    $("#level_one").attr("onchange","showListMenu('one', "+data.detail.id+")");
                    $('#roleForm select[name="level_one[]"]').val(data.detail.levelOne).trigger('change');
                    $('#level_two').empty();
                    $('#level_two').append(data.detail.optionLevel2);
                    $("#next_two").attr("onclick","showNextMenu('two','one', "+data.detail.id+")");
                    $("#level_two").attr("onchange","showListMenu('two', "+data.detail.id+")");
                    $('#roleForm select[name="level_two[]"]').val(data.detail.levelTwo).trigger('change');
                    $('#level_three').empty();
                    $('#level_three').append(data.detail.optionLevel3);
                    $("#next_three").attr("onclick","showNextMenu('three','two', "+data.detail.id+")");
                    $("#level_three").attr("onchange","showListMenu('three', "+data.detail.id+")");
                    $('#roleForm select[name="level_three[]"]').val(data.detail.levelThree).trigger('change');

                    $('#role-details-trigger').addClass('active');
                    $('#menu-one-trigger').removeClass('active');
                    $('#menu-two-trigger').removeClass('active');
                    $('#menu-three-trigger').removeClass('active');

                    $('#role-details').addClass('active dstepper-block');
                    $('#menu-one').removeClass('active dstepper-block');
                    $('#menu-two').removeClass('active dstepper-block');
                    $('#menu-three').removeClass('active dstepper-block');


                    if(action==='edit'){
                        $('#title-role').html('Kemas Kini Peranan');
                    }else{
                        $('#title-role').html('Menyalin Peranan');
                    }

                    if(accessUpdate == ''){
                        $('#btn_fake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btn_fake').attr('hidden', false);
                    }

                    roleFormModal.show();
                },
            });
        }
    };

    // VIEW FORM
    viewOnlyForm = function(id = null){
        var roleFormModal;
        roleFormModal = new bootstrap.Modal(document.getElementById('roleFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#roleForm').attr('action', '{{ route("role.store") }}');
            $('#roleForm input[name="role_name"]').val("").prop('readonly', true);
            $('#roleForm textarea[name="role_description"]').val("").prop('readonly', true);
            $('#roleForm input[name="role_display"]').val("").prop('readonly', true);
            $('#roleForm select[name="role_level"]').val("").prop('disabled', true);
            $('#roleForm select[name="access_function[]"]').val("").trigger('change').prop('disabled', true);
            $("#level_one").attr("onchange","showListMenu('one')");
            $('#roleForm select[name="level_one[]"]').val("").trigger('change').prop('disabled', true);
            $('#level_two').empty();
            $("#next_two").attr("onclick","showNextMenu('two','one')");
            $("#level_two").attr("onchange","showListMenu('two')");
            $('#roleForm select[name="level_two[]"]').val("").trigger('change').prop('disabled', true);
            $('#level_three').empty();
            $("#next_three").attr("onclick","showNextMenu('three','two')");
            $("#level_three").attr("onchange","showListMenu('three')");
            $('#roleForm select[name="level_three[]"]').val("").trigger('change').prop('disabled', true);

            $('#role-details-trigger').addClass('active');
            $('#menu-one-trigger').removeClass('active');
            $('#menu-two-trigger').removeClass('active');
            $('#menu-three-trigger').removeClass('active');

            $('#role-details').addClass('active dstepper-block');
            $('#menu-one').removeClass('active dstepper-block');
            $('#menu-two').removeClass('active dstepper-block');
            $('#menu-three').removeClass('active dstepper-block');

            $('#title-role').html('Role Information');

            $('#roleForm .btn-submit').prop('hidden', true);

            roleFormModal.show();
        }else{
            url = "{{route('role.editRole',':replaceThis')}}"
            url = url.replace(':replaceThis',id);
            $.ajax({
                url: url,
                method: 'GET',
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#roleForm input[name="role_name"]').val(data.detail.name).prop('readonly', true);
                    $('#roleForm textarea[name="role_description"]').val(data.detail.description).prop('readonly', true);
                    $('#roleForm input[name="role_display"]').val(data.detail.display_name).prop('readonly', true);
                    $('#roleForm select[name="role_level"]').val(data.detail.is_internal).prop('disabled', true);
                    $('#roleForm select[name="access_function[]"]').val(data.detail.listFunction).trigger('change').prop('disabled', true);
                    $("#level_one").attr("onchange","showListMenu('one', "+data.detail.id+")").prop('disabled', true);
                    $('#roleForm select[name="level_one[]"]').val(data.detail.levelOne).trigger('change').prop('disabled', true);
                    $('#level_two').empty().prop('disabled', true);
                    $('#level_two').append(data.detail.optionLevel2).prop('disabled', true);
                    $("#next_two").attr("onclick","showNextMenu('two','one', "+data.detail.id+")").prop('disabled', false);
                    $("#level_two").attr("onchange","showListMenu('two', "+data.detail.id+")").prop('disabled', true);
                    $('#roleForm select[name="level_two[]"]').val(data.detail.levelTwo).trigger('change').prop('disabled', true);
                    $('#level_three').empty().prop('disabled', true);
                    $('#level_three').append(data.detail.optionLevel3).prop('disabled', true);
                    $("#next_three").attr("onclick","showNextMenu('three','two', "+data.detail.id+")").prop('disabled', false);
                    $("#level_three").attr("onchange","showListMenu('three', "+data.detail.id+")").prop('disabled', true);
                    $('#roleForm select[name="level_three[]"]').val(data.detail.levelThree).trigger('change').prop('disabled', true);

                    $('#role-details-trigger').addClass('active');
                    $('#menu-one-trigger').removeClass('active');
                    $('#menu-two-trigger').removeClass('active');
                    $('#menu-three-trigger').removeClass('active');

                    $('#role-details').addClass('active dstepper-block');
                    $('#menu-one').removeClass('active dstepper-block');
                    $('#menu-two').removeClass('active dstepper-block');
                    $('#menu-three').removeClass('active dstepper-block');

                    $('#title-role').html('Role Information');

                    $('#roleForm .btn-submit').prop('hidden', true);

                    roleFormModal.show();
                },
            });
        }
    };

</script>
@endsection
