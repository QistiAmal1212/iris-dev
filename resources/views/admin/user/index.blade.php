@extends('layouts.app')

@section('header')
    @if($type == "internal")
        {{__('msg.userinternalindex')}}
    @else
        {{__('msg.userexternalindex')}}
    @endif
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item">
        <a>
            @if($type == "internal")
                {{__('msg.userinternalindex')}}
            @else
                {{__('msg.userexternalindex')}}
            @endif
        </a>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div id="userFormDiv">
                    {{-- @include('admin.role.roleForm') --}}
                </div>
            </div>
        </div>
        <!-- Role cards -->
        <div class="row match-height">

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total Users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('images/avatars/3.png') }}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{ $totalUser }}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
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
                            <span>Total Active Users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('images/avatars/10.png') }}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{ $activeUser }}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
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
                            <span>Total Inactive Users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Kim Merchent" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('images/avatars/10.png') }}"
                                        alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{ $inactiveUser }}</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                    data-bs-target="#addRoleModal">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"></h4>
                {{-- @can('admin.user.create') --}}
                @hasanyrole('admin|superadmin')
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary btn-md float-right" onclick="viewUserForm()">
                            <i class="fa-solid fa-add"></i> 
                            Add User
                        </button>
                    </div>
                @endhasanyrole
                {{-- @endcan --}}
            </div>
            <div class="card-body" style="width:100%">
                @include($type == 'internal' ? 'admin.user.tableUserInternal' : 'admin.user.tableUserExternal')
            </div>
        </div>
    </div>
</div>

@include("admin.user.userForm")
    <div class="col-12" id="showUser"></div>
@endsection

@section('script')
<script>
    backtoListingFunction = function(){
        $('#listOfUser').show(500);
        $('#showUser').hide(500);
        $('#backtoListingSection').hide(500);
    };

    viewUserForm = function(id = null){
        var userFormModal;
        userFormModal = new bootstrap.Modal(document.getElementById('userFormModal'), { keyboard: false});

        event.preventDefault();
        if(id === null){
            $('#userFormModal input[name="full_name"]').val("");
            $('#userFormModal input[name="ic_number"]').val("");
            $('#userFormModal input[name="email"]').val("");
            $('#userFormModal input[name="password"]').val("");
            $('#userFormModal input[name="retype_password"]').val("");
            $('#userFormModal select[name="role"]:checked').val();+
            $('#userFormModal checkbox[name="status"]').val("satu");
            $('#userFormModal input[name="password"]').attr('disabled', false);
            $('#userFormModal input[name="password"]').attr('hidden', false);
            $('#userFormModal input[name="retype_password"]').attr('disabled', false);
            $('#userFormModal input[name="retype_password"]').attr('hidden', false);
            $('#userFormModal label[name="label_password"]').attr('hidden', false);
            $('#userFormModal label[name="label_retype_password"]').attr('hidden', false);
            $('#userFormModal span[name="the_eye"]').attr('hidden', false);
            $('#userFormModal span[name="the_eye_2"]').attr('hidden', false);
            $('#userFormModal form[name="FormUserModal"]').attr('action', '{{route("user.store")}}');
            $('#userFormModal input[name="_method"]').attr('value', 'POST');
            $('#userFormModal select[name="roles[]"] option').each(function(){
                $(this).removeAttr('selected')
            });
            $('select[name="roles[]"]').trigger('change');
            $('#userFormModal #btnUpdateFake').html('{{__("msg.submit")}}');
            userFormModal.show();
        }else{
            url = "{{route('user.getUser',':replaceThis')}}"
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
                    url2 = "{{route('user.update',':replaceThis')}}"
                    url2 = url2.replace(':replaceThis',id_used);
                    $('#userFormModal input[name="full_name"]').val(data.detail.name);
                    $('#userFormModal input[name="ic_number"]').val(data.detail.no_ic);
                    $('#userFormModal input[name="email"]').val(data.detail.email);
                    $('#userFormModal input[name="email"]').val(data.detail.email);
                    $('#userFormModal input[name="password"]').attr('disabled', true);
                    $('#userFormModal input[name="password"]').attr('hidden', true);
                    $('#userFormModal input[name="retype_password"]').attr('disabled', true);
                    $('#userFormModal input[name="retype_password"]').attr('hidden', true);
                    $('#userFormModal label[name="label_password"]').attr('hidden', true);
                    $('#userFormModal label[name="label_retype_password"]').attr('hidden', true);
                    $('#userFormModal span[name="the_eye"]').attr('hidden', true);
                    $('#userFormModal span[name="the_eye_2"]').attr('hidden', true);
                    $('#userFormModal span[name="the_eye_2"]').attr('hidden', true);
                    $('#userFormModal form[name="FormUserModal"]').attr('action',url2 );
                    $('#userFormModal input[name="_method"]').attr('value','PUT' );

                    if(data.detail.is_active == 1)
                        $('#userFormModal input[name="status"]').prop('checked', true);
                    else
                        $('#userFormModal input[name="status"]').prop('checked', false);

                    $('#userFormModal select[name="roles[]"] option').each(function(){
                        if(data.detail.listOfRole.includes(parseInt(this.value)))
                            $(this).attr('selected','selected')
                        else
                            $(this).removeAttr('selected')
                    });
                    $('select[name="roles[]"]').trigger('change');

                    $('#userFormModal #btnUpdateFake').html('{{__("msg.update")}}');
                    userFormModal.show();
                },
            });
        }
    };
</script>
@endsection
