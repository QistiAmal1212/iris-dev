<section>
    <div class="bs-stepper vertical vertical-wizard">
        <div class="bs-stepper-header">
            <div class="step" data-target="#secAtabA-vertical" role="tab" id="secAtabA-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">A</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Basic <br />Input</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
            <hr />

            <div class="step" data-target="#secAtabB-vertical" role="tab" id="secAtabB-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">B</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Upload <br />Document</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>

            <div class="step" data-target="#secAtabC-vertical" role="tab" id="secAtabC-vertical-trigger">
                <form action="{{route('emptyResponse')}}" data-refreshFunctionDivId="testForm_submitSectionASubC_form_div" data-refreshFunctionURL="{{route("testFormNoFMF.viewSectionASubC", ['testFormId'=>$testForm->id])}}" data-swal="false">
                    <button id="refreshSecATabC_btn" hidden type="button" onclick="generalFormSubmit(this)"></button>
                </form>
                <button type="button" class="step-trigger" onclick="$('#refreshSecATabC_btn').trigger('click')">
                    <span class="bs-stepper-box">C</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">
                            Autosave <br>Form<br><small>(Same for as Tab A)</small>
                        </span>
                        <span class="bs-stepper-subtitle">

                            <i {{$testForm?->isSectionASubCCompleted() ? "" : "hidden"}}  id="checkmarkSectionATabC" class="fa-solid fa-square-check text-success"></i>
                        </span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <div id="secAtabA-vertical" class="content" role="tabpanel" aria-labelledby="secAtabA-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">SECTION A SUB A</h5>
                    <small class="text-muted">Please Enter Information</small>
                </div>
                <div id="testForm_submitSectionASubA_form_div">
                    @include('test_form_no_fmf.borang.sectionA.formSubA')
                </div>
            </div>

            <div id="secAtabB-vertical" class="content" role="tabpanel" aria-labelledby="secAtabB-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">SECTION A SUB B</h5>
                    <small class="text-muted">Please Upload All Necessary Document</small>
                </div>
                <div id="testForm_submitSectionASubB_form_div">
                    @include('test_form_no_fmf.borang.sectionA.formSubB')
                </div>

            </div>

            <div id="secAtabC-vertical" class="content" role="tabpanel" aria-labelledby="secAtabC-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">SECTION A SUB C</h5>
                    <small class="text-muted">Fill in required field and press check button</small>
                </div>
                <div id="testForm_submitSectionASubC_form_div">
                    @include('test_form_no_fmf.borang.sectionA.formSubC')
                </div>

            </div>

        </div>
    </div>
</section>


<script>
    goToSectionATabA = function(){
        $('#secAtabA-vertical-trigger .step-trigger').trigger('click');
    }

    goToSectionATabB = function(){
        $('#secAtabB-vertical-trigger .step-trigger').trigger('click');
    }

    goToSectionATabC = function(){
        $('#secAtabC-vertical-trigger .step-trigger').trigger('click');
    }
</script>
