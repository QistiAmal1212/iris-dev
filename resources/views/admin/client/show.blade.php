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
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="name">Client Name<span class="text text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" name="name" value="{{ $client->name }}" class="form-control" id="name" placeholder="name" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label class="form-label" for="name_short">Client Short Name<span class="text text-danger">*</span> </label>
                        <div class="input-group">
                            <input type="text" name="name_short" value="{{ $client->name_short }}" class="form-control" id="name_short" placeholder="name_short" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
