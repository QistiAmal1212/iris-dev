@php
    $read_only = $read_only ?? null;
    $moduleRole = $moduleRole ?? null;
@endphp

<div class="modal fade" id="userFormModal" tabindex="-1" aria-labelledby="statusFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">New User Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-sm-2 mx-50">
                <form id="userFormModal" action="" method="POST" data-reloadPage="true" name="FormUserModal">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$id ?? null}}">
                    <input type="hidden" name="_method" value="">

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> No. Kad Pengenalan </label>
                                <div class="input-group">
                                    <input type="text" id="ic_number" name="ic_number" class="form-control" maxlength="12" oninput="onlyNumberOnInputText(this)">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> Nama Penuh </label>
                                <div class="input-group">
                                    <input type="text" id="full_name" name="full_name" value="" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> Emel </label>
                                <div class="input-group">
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> No Telefon </label>
                                <div class="input-group">
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" maxlength="11" oninput="onlyNumberOnInputText(this)">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> Nama Kementerian </label>
                                <select class="select2 form-select" name="department_ministry_code" id="department_ministry_code" required>
                                    <option value=""></option>
                                    @foreach($departmentMinistry as $department)
                                    <option value="{{ $department->code }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> Bahagian </label>
                                <div class="input-group">
                                    <input type="text" id="bahagian" name="bahagian" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label fw-bolder"> Jawatan </label>
                                <select class="select2 form-select" name="skim_code" id="skim_code" required>
                                    <option value=""></option>
                                    @foreach($skim as $scheme)
                                    <option value="{{ $scheme->code }}">{{ $scheme->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label fw-bolder" name="label_password"> Kata Laluan </label>
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
                                <label class="form-label fw-bolder" name="label_retype_password"> Sahkan Kata Laluan </label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password" class="form-control form-control-merge" id="retype_password" name="retype_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="2"/>
                                <span class="input-group-text cursor-pointer" name="the_eye">
                                    <i data-feather="eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-8 col-12">
                            <label class="form-label fw-bolder"> Pilih Peranan </label>
                            <select class="select2 form-select" id="select2-multiple" name="roles[]" multiple>
                                @foreach ($role as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 col-12">
                            <label class="form-check-label fw-bolder"> Status Pengguna </label>
                            <div class="demo-inline-spacing">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="customSwitch3" value="1" name="status" />
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
