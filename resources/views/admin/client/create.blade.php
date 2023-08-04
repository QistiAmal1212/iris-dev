@extends('layouts.app')

@section('header')
{{__('msg.client')}}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
<li class="breadcrumb-item"><a> {{__('msg.client')}} </a></li>
@endsection

@section('content')
<div class="form-group row d-flex flex-col align-items-stretch">
    <div class="col-md-6 col-sm-12 p-2">
        <div class="card">
            <div class="card-header"><b>CLIENT INFORMATION</b> </div>
            <div class="card-body">
                <form action="{{ route('client.store') }}" method="POST" class="form-horizontal" autocomplete="off">
                    @csrf
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-label" for="name">Client Name<span class="text text-danger">*</span> </label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label class="form-label" for="name_short">Client Short Name<span class="text text-danger">*</span> </label>
                            <div class="input-group">
                                <input type="text" name="name_short" class="form-control" id="name_short" placeholder="name_short" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center my-1">
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fa-solid fa-file-print"></i> Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
