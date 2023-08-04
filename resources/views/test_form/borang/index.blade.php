@extends('layouts.app')

@section('header')
    Simple Test Form
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a href="#"> Test Form </a></li>
@endsection

@section('content')

    <?php
        $hasValue = true;
        $module_id = $testForm?->module_id;
        $moduleStatus = $testForm?->moduleStatus;
        $module_status_id = $testForm?->moduleStatus?->id;
        $loret = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pharetra diam ac leo pretium fringilla. Maecenas sodales odio ac risus auctor accumsan. Mauris malesuada mauris odio, quis ultrices mi viverra vel. Vivamus congue in libero a efficitur. Sed nibh dolor, accumsan sed eros id, congue ultricies augue.";
        $tab1_view = FMF::checkPermission($module_id,$module_status_id,'Tab1_View');
        $tab1_edit = FMF::checkPermission($module_id,$module_status_id,'Tab1_Edit');
        $tab2_view = FMF::checkPermission($module_id,$module_status_id,'Tab2_View');
        $tab2_edit = FMF::checkPermission($module_id,$module_status_id,'Tab2_Edit');
        $tab2SubA_view = FMF::checkPermission($module_id,$module_status_id,'Tab2_SectionA_View');
        $tab2SubA_edit = FMF::checkPermission($module_id,$module_status_id,'Tab2_SectionA_Edit');
        $tab2SubB_view = FMF::checkPermission($module_id,$module_status_id,'Tab2_SectionB_View');
        $tab2SubB_edit = FMF::checkPermission($module_id,$module_status_id,'Tab2_SectionB_Edit');
    ?>
    <div class="col-md-3 col-12">
        <div class="card mb-0">
            <div class="card-body">
                <span class="bs-stepper-label">
                    <h4 class="text-uppercase strong">Application ID: 001200</h4>
                    @if($moduleStatus)
                        <p><span class="badge rounded-pill badge-light-warning me-1">{{$moduleStatus->status_name}}</span></p>
                    @else
                        <p><span class="badge rounded-pill badge-light-warning me-1">Draft</span></p>
                    @endif
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <ul class="nav nav-pills nav-justified pt-2" role="tablist">
            @if($tab1_view)
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link active" id="testFormTab1-tab" data-bs-toggle="tab" href="#testFormTab1"
                    aria-controls="testFormTab1" role="tab" aria-selected="true"><b>SECTION A:</b><br/> GENERAL INFORMATION
                </a>
            </li>
            @endif
            @if($tab2_view)
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link " id="testFormTab2-tab" data-bs-toggle="tab" href="#testFormTab2"
                    aria-controls="testFormTab2" role="tab" aria-selected="true"><B>SECTION B:</B><BR /> DECLARATION
                </a>
            </li>
            @endif
            <li class="nav-item" role="presentation">
                <a class="text-uppercase nav-link " id="testFormTab3-tab" data-bs-toggle="tab" href="#testFormTab3"
                    aria-controls="testFormTab3" role="tab" aria-selected="true"><B>SECTION C:</B><BR /> Contoh Modal dari Table
                </a>
            </li>
        </ul>

        <div class="tab-content" id="testFormContent">
            @if($tab1_view)
            <div class="tab-pane fade show active" id="testFormTab1" role="tabpanel" aria-labelledby="testFormTab1-tab">
                @include('test_form.borang.tab1.indexTab1')
            </div>
            @endif
            @if($tab2_view)
            <div class="tab-pane fade" id="testFormTab2" role="tabpanel" aria-labelledby="testFormTab2-tab">
                @include('test_form.borang.tab2.indexTab2')
            </div>
            @endif
            <div class="tab-pane fade" id="testFormTab3" role="tabpanel" aria-labelledby="testFormTab3-tab">
                @include('test_form.borang.tab3.indexTab3')
            </div>
        </div>
    </div>

    <div class="offcanvas-end-example">
        <div class="btn-floating">
            @foreach(FMF::listAction($module_id,$module_status_id   ) as $value)
                {{-- <form action="{{route('testForm.submit')}}" method="POST" data-reloadPage="true">
                    <input type="hidden" name="action" value="{{$value->action}}">
                    <input type="hidden" name="id" value="{{$testForm->id ?? null}}">
                    <button type="button" id="{{$value->action."Btn"}}" onclick="generalFormSubmit(this);" hidden></button>
                </form> --}}
                <button class="btn btn-success waves-effect waves-float waves-light" type="button" onclick="$('{{'#'.$value->action.'Btn'}}').trigger('click'); fakeSuccess('Submitted','Next Status is '+'{{ucwords($value->nextStatus->status_name)}}')">
                    {{ucwords($value->action)}}
                </button>
            @endforeach
        </div>
    </div>
@endsection

@push('js')

<script>
    $(function(){

        $('.dropify').dropify()

    })
</script>
@endpush

