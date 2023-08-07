
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@php
    $read_only = $read_only ?? null;
    $moduleRole = $moduleRole ?? null;
@endphp

<div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="statusFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body px-sm-2 mx-50">
                <form id="userFormModal" action="" method="POST" data-reloadPage="true" name="FormUserModal">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$id ?? null}}">
                        <input type="hidden" name="_method" value="">

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="full_name">Full Name <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="full_name" name="full_name" value="" class="form-control" placeholder="Full Name" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="role_description">IC Number <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="ic_number" name="ic_number" class="form-control" maxlength="12" placeholder="IC" oninput="onlyNumberOnInputText(this)">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="role_description">Email Address <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mb-1">
                                <div class="d-flex justify-content-between">
                                    <label name="label_password" class="form-label" for="password">Password <span class="text text-danger">*</span></label>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="1" autofocus/>
                                    <span class="input-group-text cursor-pointer" name="the_eye_2">
                                        <i data-feather="eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mb-1">
                                <div class="d-flex justify-content-between">
                                    <label name="label_retype_password" class="form-label" for="reset-password-confirm">Confirm Password <span class="text text-danger">*</span></label>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input type="password" class="form-control form-control-merge" id="retype_password" name="retype_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="2"/>
                                    <span class="input-group-text cursor-pointer" name="the_eye">
                                        <i data-feather="eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <label class="form-label" for="select2-multiple">Role <span class="text text-danger">*</span></label>
                                <select class="select2 form-select" id="select2-multiple" name="roles[]" multiple>
                                    @foreach ($role as $role)
                                        <option value={{$role->id}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50" for="customSwitch3">Status <span class="text text-danger">*</span></label>
                                    <div class="form-check form-check-primary form-switch">
                                        <span> Inactive</span>
                                        <input type="checkbox" checked class="form-check-input" id="customSwitch3" value="1" name="status" />
                                        <span>Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="btnUpdateUserForm" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnUpdateFake" class="btn btn-primary" onclick="$('#btnUpdateUserForm').trigger('click');">{{__('msg.submit')}}</button>
            </div>
        </div>
    </div>
</div>

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
