@extends('layouts.app')

@section('header')
    Faq Create
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/admin/faq') }}">Faq</a></li>
    <li class="breadcrumb-item active">Create Faq</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('faq.store') }}" method="POST" class="form-horizontal" autocomplete="off">
                @csrf
                <div class="form-group row">
                    <label for="inputQuestion" class="col-sm-2 col-form-label">Question <b class="text-danger">*</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="question" class="form-control" id="inputQuestion" placeholder="Question" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAnswer" class="col-sm-2 col-form-label">Answer <b class="text-danger">*</b></label>
                    <div class="col-sm-10">
                        <input type="text" name="answer" class="form-control" id="inputAnswer" placeholder="Answer" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputFaqType" class="col-sm-2 col-form-label">Faq Type <b class="text-danger">*</b></label>
                    <div class="col-sm-10">
                        <select class="custom-select rounded-0" id="inputFaqType" name="faq_type_id" required>
                            <option value="">Please Select</option>
                            @foreach ($MasterFaqType as $faqType)
                                <option value="{{ $faqType->id }}">{{ $faqType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputLocale" class="col-sm-2 col-form-label">Locale <b class="text-danger">*</b></label>
                    <div class="col-sm-10">
                        <select class="custom-select rounded-0" id="inputLocale" name="lang" required>
                            <option value="">Please Select</option>
                            @foreach ($FaqLang as $lang)
                                <option value="{{ $lang }}">{{ strtoupper($lang) }}</option>
                            @endforeach
                        </select>
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
