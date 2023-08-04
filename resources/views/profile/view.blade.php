@extends('layouts.app')

@section('header')
View Profile
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">
        
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                </div>
                
                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                
                <p class="text-muted text-center">{{ $user->email }}</p>
                
            </div>
        </div>
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">About</h3>
            </div>
            <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Roles </strong>
                    <ul>
                        @foreach($user->getRoleNames() as $role)
                        <li>{{ $role }}</li>
                        @endforeach
                    </ul>
                <hr>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#update" data-toggle="tab">Update</a></li>
                </ul>
                <div class="card-body">
                    <div class="tab-content">
                        
                        <div class="tab-pane active" id="update">
                            <form action="{{ route('profile-update') }}" method="POST" class="form-horizontal" autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
        