
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@php
    $read_only = $read_only ?? null;
    $moduleRole = $moduleRole ?? null;
@endphp
<div class="modal fade" id="roleFormModal" tabindex="-1" aria-labelledby="#addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50">
                <h1 class="text-center mb-1" id="addNewCardTitle">Role Form</h1>
                <p class="text-center" name="sub_title" id="sub_title">Add Role</p>

                <form id="roleForm" action="{{route('role.store')}}" method="POST" data-reloadPage="true">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$id ?? null}}">
                    <input type="hidden" name="_method" value="">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="form-label" for="role_name">Name <span class="text text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" id="role_name" name="role_name" value="" class="form-control" placeholder="Role Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="form-label" for="role_description">Descriptions <span class="text text-danger">*</span> </label>
                                <div class="input-group">
                                    <textarea class="form-control" rows = 4 placeholder="Role Descriptions" name="role_description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="form-label" for="role_display">Display Role As <span class="text text-danger">*</span> </label>
                                <div class="input-group">
                                    <input type="text" id="role_display" class="form-control" placeholder="Display Role As" name="role_display" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="form-label" for="role_level">Role Level <span class="text text-danger">*</span> </label>
                                <div class="input-group">
                                <select id="role_level" class="form-control" name="role_level" required>
                                    <option value=""></option>
                                    <option value="1">Internal</option>
                                    <option value="0">External</option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label class="form-label" for="role_description">Permissions <span class="text text-danger">*</span> </label>
                                <div class="input-group">
                                    @foreach($permissions as $permission)
                                    <div class="col-sm-6 mt-1 mb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" name="permissions[]" value="{{ $permission->id }}" type="checkbox" id="permissionCB_{{ $permission->id }}" />
                                            <label for="permissionCB_{{ $permission->id }}" class="custom-control-label"> {{ $permission->name }} </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btnUpdateRoleForm" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnRoleAdd" class="btn btn-success" onclick="$('#btnUpdateRoleForm').trigger('click');">{{__('msg.submit')}}</button>
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
