@extends('layouts.app')

@section('header')
    @if($type == "internal")
        {{__('msg.userinternaledit')}}
    @else
        {{__('msg.userexternaledit')}}
    @endif
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    @if($type == "internal")
    <li class="breadcrumb-item"><a href="{{ route('user.index',["type" => $type]) }}">{{__('msg.userinternalindex')}}</a>
    <li class="breadcrumb-item"><a>{{__('msg.userinternaledit')}}</a></li>
    @else
    <li class="breadcrumb-item"><a href="{{ route('user.index',["type" => $type]) }}">{{__('msg.userexternalindex')}}</a>
    <li class="breadcrumb-item"><a>{{__('msg.userexternaledit')}}</a></li>
    @endif
@endsection

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card px-2">
            <div class="card-header">
                <h4 class="card-title">
                    @if($type == "internal")
                        {{__('msg.userinternalshow')}}
                    @else
                        {{__('msg.userexternalshow')}}
                    @endif
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update', $user) }}" method="POST" class="form-horizontal" autocomplete="off">
                    @csrf
                    <input type="hidden" name="_method" value="PUT"/>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputName" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputIsActive" class="col-sm-2 col-form-label">Active</label>
                        <div class="col-sm-10">
                            <select name="is_active" class="form-control" id="inputIsActive" required>
                                <option value=""></option>
                                <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}> Active </option>
                                <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}> Inactive </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputRole" class="col-sm-2 col-form-label">Roles</label>
                        @foreach($roles as $role)
                        <div class="col-sm-2">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="roles[]" value="{{ $role->name }}" type="checkbox" id="roleCB_{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }} />
                                <label for="roleCB_{{ $role->id }}" class="custom-control-label"> {{ $role->name }} </label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="form-group row">
                        <label for="inputIsClient" class="col-sm-2 col-form-label">Is Client?</label>
                        <div class="col-sm-2">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" name="isClient" value="1" type="radio" id="isClient_1" />
                                <label for="isClient_1" class="custom-control-label"> Yes </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" name="isClient" value="0" type="radio" id="isClient_2" />
                                <label for="isClient_2" class="custom-control-label"> No </label>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="inputPermission" class="col-sm-2 col-form-label">Permissions</label>
                        <div class="col-sm-10 row">
                            @foreach($permissions as $permission)
                            <div class="col-sm-3 mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" name="permissions[]" value="{{ $permission->name }}" type="checkbox" id="permissionCB_{{ $permission->id }}" {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }} />
                                    <label for="permissionCB_{{ $permission->id }}" class="custom-control-label"> {{ $permission->name }} </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> --}}

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
