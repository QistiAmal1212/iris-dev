@extends('layouts.app')

@section('header')
    @if($type == "internal")
        {{__('msg.userinternalshow')}}
    @else
        {{__('msg.userexternalshow')}}
    @endif
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    @if($type == "internal")
    <li class="breadcrumb-item"><a href="{{ route('user.index',["type" => $type]) }}">{{__('msg.userinternalindex')}}</a>
    <li class="breadcrumb-item"><a>{{__('msg.userinternalshow')}}</a></li>
    @else
    <li class="breadcrumb-item"><a href="{{ route('user.index',["type" => $type]) }}">{{__('msg.userexternalindex')}}</a>
    <li class="breadcrumb-item"><a>{{__('msg.userexternalshow')}}</a></li>
    @endif
@endsection

@section('content')
<div class="d-flex flex-row align-items-start">
    <!--<button type="button" class="btn btn-labeled btn-default pe-1" onclick="backtoListingFunction();">
        <span class="btn-label" style="display: inline-block;padding: 6px 12px;background: rgba(0, 0, 0, 0.15);">
            <i class="fa fa-chevron-left"></i>
        </span>
    </button> -->

    <div class="card" style="width:100%" id="showUser">
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
            <div class="row">
                <div class="col-12">
                    <form hidden action="{{ route("emptyResponse") }}" method="get" data-refreshFunctionDivId="showUser" data-refreshFunctionURL="{{ route('user.update', $user) }}">
                        @csrf
                        <button type="button" id="btnView{{ $user->id }}" hidden
                            onclick="generalFormSubmit(this)"></button>
                    </form>
                    {{-- <form action="{{ route('user.update', $user) }}" data-refreshFunctionDivId="criteriaSection" method="POST" class="form-horizontal" autocomplete="off"> --}}
                        @csrf

                        <input type="hidden" name="_method" value="PUT"/>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <h6 class="fw-bolder mb-1 mt-1">1. Name</h6>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputName" placeholder="Name" required disabled>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <h6 class="fw-bolder mb-1 mt-1">2. Email</h6>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail" placeholder="Email" required disabled>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <h6 class="fw-bolder mb-1 mt-1">3. Password</h6>
                                <input type="password" name="********" class="form-control" id="inputPassword" placeholder="Password" disabled>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <h6 class="fw-bolder mb-1 mt-1">4. User Status</h6>
                                <select name="is_active" class="form-control select2" id="inputIsActive" required disabled>
                                    <option value=""></option>
                                    <option value="1" {{ $user->is_active == 1 ? 'selected' : '' }}> Active </option>
                                    <option value="0" {{ $user->is_active == 0 ? 'selected' : '' }}> Inactive </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <h6 class="fw-bolder mb-1 mt-1">5. Roles</h6>
                                <div class="col-sm-12 row">
                                    @foreach($roles as $role)
                                        <div class="col-md-4 col-12 mb-1">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="roles[]" value="{{ $role->name }}" type="checkbox" disabled id="roleCB_{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }} />
                                                <label for="roleCB_{{ $role->id }}" class="custom-control-label"> {{ $role->name }} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <h6 class="fw-bolder mb-1 mt-1">6. Permission</h6>
                                <div class="col-sm-12 row">
                                    @foreach($permissions as $permission)
                                        <div class="col-md-3 col-12 mb-1">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" name="permissions[]" value="{{ $permission->name }}" type="checkbox" disabled id="permissionCB_{{ $permission->id }}" {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }} />
                                                <label for="permissionCB_{{ $permission->id }}" class="custom-control-label"> {{ $permission->name }} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
                                {{-- <button type="button" id="btnView" hidden onclick="generalFormSubmit(this)"></button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    backtoListingFunction = function(){
        $('#listOfUser').show(500);
        $('#showUser').hide(500);
        $('#backtoListingSection').show(500);
    };
    </script>
@endsection
