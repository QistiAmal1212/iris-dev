@extends('layouts.app')

@section('header')
{{__('msg.role')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a> {{__('msg.role')}}</a></li>
@endsection

@section('content')
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
                    <span>Total Internal Roles</span>
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
                            View List
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
                    <span>Total External Roles</span>
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
                            View List
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
                    @can('admin.role.create')
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <!-- <a onclick="viewRoleForm()" class="stretched-link text-nowrap add-new-role"> -->
                            <a onclick="viewForm()" class="stretched-link text-nowrap add-new-role">
                                <span class="btn btn-primary mb-1">Add New Role</span>
                            </a>
                            <p class="mb-0 text-muted">Add role, if it does not exist</p>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4 class="card-title">List of Roles</h4>
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
            <table class="table header_uppercase table-bordered table-responsive" id="RoleList" style="width: 300%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Display Name</th>
                        <th>Description</th>
                        <th>Role Level</th>
                        <th>Action</th>
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

    viewForm = function(id = null){
        var roleFormModal;
        roleFormModal = new bootstrap.Modal(document.getElementById('roleFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#roleForm').attr('action', '{{route("role.store")}}');
            $('#roleForm input[name="role_name"]').val("");
            $('#roleForm textarea[name="role_description"]').val("");
            $('#roleForm input[name="role_display"]').val("");
            $('#roleForm select[name="role_level"]').val("");
            $('#roleForm select[name="access_function[]"]').val("").trigger('change');
            $('#roleForm select[name="level_one[]"]').val("").trigger('change');
            $('#roleForm select[name="level_two[]"]').val("").trigger('change');
            $('#roleForm select[name="level_three[]"]').val("").trigger('change');

            $('#role-details-trigger').addClass('active');
            $('#menu-one-trigger').removeClass('active');
            $('#menu-two-trigger').removeClass('active');
            $('#menu-three-trigger').removeClass('active');

            $('#role-details').addClass('active dstepper-block');
            $('#menu-one').removeClass('active dstepper-block');
            $('#menu-two').removeClass('active dstepper-block');
            $('#menu-three').removeClass('active dstepper-block');

            $('#title-role').html('Add Role');

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
                    url2 = "{{route('role.updateRole',':replaceThis')}}"
                    url2 = url2.replace(':replaceThis',id_used);

                    $('#roleForm').attr('action',url2 );
                    $('#roleForm input[name="role_name"]').val(data.detail.name);
                    $('#roleForm textarea[name="role_description"]').val(data.detail.description);
                    $('#roleForm input[name="role_display"]').val(data.detail.display_name);
                    $('#roleForm select[name="role_level"]').val(data.detail.is_internal);
                    $('#roleForm select[name="access_function[]"]').val(data.detail.listFunction).trigger('change');
                    $('#roleForm select[name="level_one[]"]').val(data.detail.levelOne).trigger('change');
                    $('#roleForm select[name="level_two[]"]').val(data.detail.levelTwo).trigger('change');
                    $('#roleForm select[name="level_three[]"]').val(data.detail.levelThree).trigger('change');

                    $('#role-details-trigger').addClass('active');
                    $('#menu-one-trigger').removeClass('active');
                    $('#menu-two-trigger').removeClass('active');
                    $('#menu-three-trigger').removeClass('active');

                    $('#role-details').addClass('active dstepper-block');
                    $('#menu-one').removeClass('active dstepper-block');
                    $('#menu-two').removeClass('active dstepper-block');
                    $('#menu-three').removeClass('active dstepper-block');

                    $('#title-role').html('Edit Role');

                    roleFormModal.show();
                },
            });
        }
    };
</script>
@endsection
