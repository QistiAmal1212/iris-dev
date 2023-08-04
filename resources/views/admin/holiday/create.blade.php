@extends('layouts.app')

@section('header')
    Holiday Create
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/holiday') }}">Holiday</a></li>
    <li class="breadcrumb-item active">Create Holiday</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('holiday.store') }}" method="POST" class="form-horizontal" autocomplete="off">
                @csrf
                <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Title <b class="text-danger">*</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputMessage" class="col-sm-2 col-form-label">Message <b class="text-danger">*</b></label>
                    <div class="col-sm-10">
                        <textarea name="message" class="form-control" rows="3" placeholder="Message" required></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Activeness:</label>
                    <div class="row col-sm-10 pt-2">
                      <div class="custom-control custom-switch mr-5">
                        <input name="is_active_emel" type="checkbox" class="custom-control-input" id="inputIsActiveEmel" value="1">
                        <label class="custom-control-label" for="inputIsActiveEmel">Email</label>
                      </div>
                      <div class="custom-control custom-switch">
                        <input name="is_active_system" type="checkbox" class="custom-control-input" id="inputIsActiveSystem" value="1">
                        <label class="custom-control-label" for="inputIsActiveSystem">Inbox System</label>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-success float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
