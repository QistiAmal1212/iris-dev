@extends('layouts.app')

@section('header')
    Senarai Pengguna
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item">
        <a>
            Senarai Pengguna
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
                            <span>Jumlah Pengguna</span>
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
                            <span>Jumlah Pengguna Aktif</span>
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
                            <span>Jumlah Pengguna Tidak Aktif</span>
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
                {{-- @hasanyrole('admin|superadmin') --}}
                    @if($accessAdd)
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-primary btn-md float-right" onclick="viewUserForm()">
                            <i class="fa-solid fa-add"></i>
                            Tambah Pengguna
                        </button>
                    </div>
                    @endif
                {{-- @endhasanyrole --}}
                {{-- @endcan --}}
            </div>
            <hr>

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
    function confirmResetPassword(email) {
    Swal.fire({
        title: 'Reset Kata Laluan',
        text: 'Reset kata laluan untuk pengguna ini',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sahkan',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) {
            resetPassword(email);
        }
    });
}

// function resetPassword(email) {
//     var form = document.createElement('form');
//     form.method = 'POST';
//     form.action = "{{ route('password.email') }}";
//     form.style.display = 'hidden';

//     var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//     var inputEmail = document.createElement('input');
//     inputEmail.type = 'email';
//     inputEmail.name = 'email';
//     inputEmail.value = email;

//     var inputToken = document.createElement('input');
//     inputToken.type = 'hidden';
//     inputToken.name = '_token';
//     inputToken.value = csrfToken;

//     form.appendChild(inputEmail);
//     form.appendChild(inputToken);

//     document.body.appendChild(form);
//     form.submit();
// }
function resetPassword(email) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send an AJAX request to reset the password
    $.ajax({
        url: "{{ route('password.email') }}",
        method: 'POST',
        async: true,
        data: {
            _token: csrfToken,
            email: email
        },
        success: function(data) {
            Swal.fire('Berjaya', 'Emel telah dihantar', 'success');
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}


    backtoListingFunction = function(){
        $('#listOfUser').show(500);
        $('#showUser').hide(500);
        $('#backtoListingSection').hide(500);
    };

    viewUserForm = function(id = null){
        var userFormModal;
        userFormModal = new bootstrap.Modal(document.getElementById('userFormModal'), { keyboard: false});
        var div_div_disclaimer = document.getElementById('div_disclaimer');

        var accessAdd = '{{ $accessAdd }}';
        var accessUpdate = '{{ $accessUpdate }}';

        event.preventDefault();
        if(id === null){
            $('#userFormModal input[name="full_name"]').val("");
            $('#userFormModal input[name="ic_number"]').val("");
            $('#userFormModal input[name="email"]').val("");
            $('#userFormModal input[name="phone_number"]').val("");
            $('#userFormModal input[name="password"]').val("");
            $('#userFormModal input[name="password_confirmation"]').val("");
            $('#userFormModal select[name="role"]:checked').val();+
            $('#userFormModal input[name="status"]').prop('checked', true);
            $('#userFormModal input[name="password"]').attr('disabled', false);
            $('#userFormModal input[name="password"]').attr('hidden', false);
            $('#userFormModal input[name="password_confirmation"]').attr('disabled', false);
            $('#userFormModal input[name="password_confirmation"]').attr('hidden', false);
            $('#userFormModal label[name="label_password"]').attr('hidden', false);
            $('#userFormModal label[name="label_password_confirmation"]').attr('hidden', false);
            $('#userFormModal span[name="the_eye"]').attr('hidden', false);
            $('#userFormModal span[name="the_eye_2"]').attr('hidden', false);
            $('#userFormModal form[name="FormUserModal"]').attr('action', '{{route("user.store")}}');
            $('#userFormModal form[name="FormUserModal"]').attr('data-swal', 'Pengguna berjaya ditambah. Email telah dihantar kepada pengguna.');
            $('#userFormModal input[name="_method"]').attr('value', 'POST');
            $('#userFormModal select[name="department_ministry_code"]').val("").trigger('change');
            $('#userFormModal select[name="skim_code"]').val("").trigger('change');
            $('#userFormModal select[name="roles[]"] option').each(function(){
                $(this).removeAttr('selected')
            });
            $('select[name="roles[]"]').trigger('change');
            $('#userFormModal #btnUpdateFake').html('{{__("msg.submit")}}');

            if(accessAdd == ''){
                $('#btnUpdateFake').attr('hidden', true);
            } else if (accessAdd != ''){
                $('#btnUpdateFake').attr('hidden', false);
            }

            div_div_disclaimer.style.display = 'block';
            userFormModal.show();
        }else{
            url = "{{route('user.getUser',':replaceThis').'?route='.$route}}"
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
                    $('#userFormModal input[name="phone_number"]').val(data.detail.phone_number);
                    $('#userFormModal input[name="password"]').attr('disabled', true);
                    $('#userFormModal input[name="password"]').attr('hidden', true);
                    $('#userFormModal input[name="password_confirmation"]').attr('disabled', true);
                    $('#userFormModal input[name="password_confirmation"]').attr('hidden', true);
                    $('#userFormModal label[name="label_password"]').attr('hidden', true);
                    $('#userFormModal label[name="label_password_confirmation"]').attr('hidden', true);
                    $('#userFormModal span[name="the_eye"]').attr('hidden', true);
                    $('#userFormModal span[name="the_eye_2"]').attr('hidden', true);
                    $('#userFormModal span[name="the_eye_2"]').attr('hidden', true);
                    $('#userFormModal form[name="FormUserModal"]').attr('action',url2 );
                    $('#userFormModal form[name="FormUserModal"]').attr('data-swal', 'Maklumat berjaya dikemaskini.');
                    $('#userFormModal input[name="_method"]').attr('value','PUT' );
                    $('#userFormModal select[name="department_ministry_code"]').val(data.detail.ref_department_ministry_code).trigger('change');
                    $('#userFormModal select[name="skim_code"]').val(data.detail.ref_skim_code).trigger('change');

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

                    if(accessUpdate == ''){
                        $('#btnUpdateFake').attr('hidden', true);
                    } else if (accessUpdate != ''){
                        $('#btnUpdateFake').attr('hidden', false);
                    }

                    div_div_disclaimer.style.display = 'none';
                    userFormModal.show();
                },
            });
        }
    };
</script>
@endsection
