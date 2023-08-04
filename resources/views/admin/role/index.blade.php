@extends('layouts.app')

@section('header')
{{__('msg.role')}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a> {{__('msg.role')}}</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div id="userFormDiv">
                    @include('admin.role.roleForm')
                </div>
            </div>
        </div>
        <!-- Role cards -->
        <div class="row">

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total 4 users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/2.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/12.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/6.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/11.png')}}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">Administrator</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                    <small class="fw-bolder">Edit Role</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total 7 users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/4.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/1.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/2.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/5.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/7.png')}}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">Manager</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                    <small class="fw-bolder">Edit Role</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total 5 users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/6.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rishi Swaat" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/9.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/12.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/10.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/8.png')}}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">Users</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                    <small class="fw-bolder">Edit Role</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total 3 users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/3.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/9.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/12.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/10.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/11.png')}}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">Support</h4>
                                <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                    <small class="fw-bolder">Edit Role</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total 2 users</span>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/10.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/6.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/3.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/8.png')}}" alt="Avatar" />
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{asset('images/avatars/9.png')}}" alt="Avatar" />
                                </li>
                            </ul>
                        </div>
                    <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                        <div class="role-heading">
                            <h4 class="fw-bolder">Restricted User</h4>
                            <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                                <small class="fw-bolder">Edit Role</small>
                            </a>
                        </div>
                        <a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>
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
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role">
                                    <span class="btn btn-primary mb-1">Add New Role</span>
                                </a>
                                <p class="mb-0">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role cards -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">ROLE</h4>
                @can('admin.role.create')
                    {{-- <a href="{{ route('role.create') }}" class="btn btn-primary float-right hovertext waves-effect waves-float waves-light"> CREATE </a> --}}
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-success btn-sm float-right" onclick="viewRoleForm()">
                            <i class="fa-solid fa-add"></i> Add
                        </button>
                    </div>
                @endcan
            </div>
            <div class="card-body">

                <table class="table header_uppercase table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Display As</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <th>{{ (($roles->currentPage() - 1) * $roles->perPage()) + $loop->iteration }}</th>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->display_name }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Role Action">
                                    @can('admin.role.view')
                                        <a href="{{ route('role.show', $role) }}" class="btn btn-outline-dark waves-effect"> <i class="fas fa-eye"></i> </a>
                                    @endcan

                                    @can('admin.role.update')
                                        {{-- <a href="{{ route('role.edit', $role) }}" class="btn btn-outline-dark waves-effect"> <i class="fas fa-edit"></i> </a> --}}
                                        <a href="{{ route('role.editting', $role->id) }}" class="btn btn-outline-dark waves-effect" onclick="viewRoleForm('{{$role->id}}')"> <i class="fas fa-edit"></i> </a>
                                    @endcan

                                    @can('admin.role.delete')
                                        <a href="#" class="btn btn-outline-dark waves-effect" onclick="event.preventDefault(); document.getElementById('formDestroyRole_{{ $role->id }}').submit();"> <i class="fas fa-trash"></i> </a>
                                        <form id="formDestroyRole_{{ $role->id }}" method="POST" action="{{ route('role.destroy', $role) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE"/>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {!! $roles->links() !!}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    $(document).ready(function(){
        // Swal.fire('Hello');
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
</script>

@endsection
