@extends('layouts.app')

@section('header')
    Simple Test Form
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a href="#"> Test Form No FMF </a></li>
@endsection

@section('content')

    <div class="col-md-3 col-12">
        <div class="card mb-0">
            <div class="card-body">
                <span class="bs-stepper-label">
                    <h4 class="text-uppercase strong">Application ID: {{$testForm->id}}</h4>
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified pt-2" role="tablist">

            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link active" id="testFormSectionA-tab" data-bs-toggle="tab" href="#testFormSectionA"
                    aria-controls="testFormSectionA" role="tab" aria-selected="true"><b>SECTION A:</b><br/> SIMPLE FORM
                </a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link " id="testFormSectionB-tab" data-bs-toggle="tab" href="#testFormSectionB"
                    aria-controls="testFormSectionB" role="tab" aria-selected="true"><B>SECTION B:</B><BR /> MODAL IN TABLE
                </a>
            </li>

        </ul>

        <div class="tab-content" id="testFormContent">

            <div class="tab-pane fade show active" id="testFormSectionA" role="tabpanel" aria-labelledby="testFormSectionA-tab">
                @include('test_form_no_fmf.borang.sectionA.indexSectionA')
            </div>

            <div class="tab-pane fade" id="testFormSectionB" role="tabpanel" aria-labelledby="testFormSectionB-tab">
                @include('test_form_no_fmf.borang.sectionB.indexSectionB')
            </div>

        </div>
    </div>
@endsection

@push('js')
<script>
    //put your script here
</script>
@endpush
