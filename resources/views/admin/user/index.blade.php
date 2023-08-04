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
<div class="row" id="listOfUser">
    <div class="col-md-12">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div id="userFormDiv">
                    @include('admin.user.userForm')
                </div>
            </div>
        </div>
        <div class="row">
            <div class={{$type=='internal' ? "col-lg-4 col-sm-6" : "col-lg-3 col-sm-6"}}>
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{$totalUser}}</h3>
                            <span>Total User</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                                <i data-feather="user-plus" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{$activeUser}}</h3>
                            <span>Active User</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                                <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">{{$inactiveUser}}</h3>
                            <span>Inactive User</span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                                <i data-feather="user-x" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    @if($type == "internal")
                        {{__('msg.userinternalindex')}}
                    @else
                        {{__('msg.userexternalindex')}}
                    @endif
                </h4>
                @can('admin.user.create')
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-success btn-sm float-right" onclick="viewUserForm()">
                            <i class="fa-solid fa-add"></i> Add
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body" style="width:100%">
                @include($type == 'internal' ? 'admin.user.tableUserInternal' : 'admin.user.tableUserExternal')
            </div>
        </div>
    </div>
</div>

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
