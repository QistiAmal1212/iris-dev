<section>
    <div class="bs-stepper vertical vertical-wizard col-12">
        <div class="bs-stepper-header">
            @if($tab2SubA_view)
            <div class="step" data-target="#secBtabA-vertical" role="tab" id="secBtabA-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">A</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Deklarasi PL 2</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
            <hr />
            @endif
            @if($tab2SubB_view)
            <div class="step" data-target="#secBtabB-vertical" role="tab" id="secBtabB-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">B</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Deklarasi Admin</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
            @endif
        </div>

        <div class="bs-stepper-content">
            @if($tab2SubA_view)
            <div id="secBtabA-vertical" class="content" role="tabpanel" aria-labelledby="secBtabA-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">PL1</h5>
                    <small class="text-muted"></small>
                </div>
                <div class="">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="">a. Grant Name:
                                    <b> Prototype Grant Programme KPT</b>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="">b. Project Name:
                                    <b> Optimize the Use of Battery in IoT Devices</b>
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <h6 class="mb-1">I hereby declare that,</h6>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <div class="demo-spacing">
                                <div class="form-check form-check mb-1">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" {{$tab2SubA_edit ? "required" : "disabled"}} {{$hasValue ? "checked=''" : ""}}/>
                                    <label class="form-check-label">All information provided within these documents are true and correct
                                        when give. If any information is untrue, inaccurate or misleading, Ministry of Higher Education has
                                        the right to not process the application, reject the application or to withdraw the offer without
                                        prior notice.</label>
                                </div>
                                <div class="form-check form-check mb-1">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="" {{$tab2SubA_edit ? "required" : "disabled"}} {{$hasValue ? "checked=''" : ""}} />
                                    <label class="form-check-label">The same application cannot be applied simultaneously for any other
                                        funding (grants) at other Ministries and Agencies within the same year.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <button class="btn btn-outline-secondary btn-prev" disabled>
                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        @if($tab2SubA_edit)
                        <button class="btn btn-success btn-next" onclick="fakeSuccess('Submitted',''); window.location='{{route('testForm.index',['id'=>3])}}'">
                            <span class="align-middle d-sm-inline-block d-none">Submit</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        @else
                        <button class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none">Seterusnya</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        @endif
                    </div>

                </div>
            </div>
            @endif

            @if($tab2SubB_view)
            <div id="secBtabB-vertical" class="content" role="tabpanel" aria-labelledby="secBtabB-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Admin</h5>
                    <small></small>
                </div>
                <div class="">
                    <h6 class="mb-1">I hereby declare that,</h6>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <div class="demo-spacing">
                                <div class="form-check form-check mb-1">
                                    <input class="form-check-input" type="checkbox" id="tab2SubB_cb1" name="tab2SubB_cb1" value="" {{$tab2SubB_edit ? "required" : "disabled" }} {{$hasValue ? "checked=''" : ""}} />
                                    <label class="form-check-label" for="tab2SubB_cb1">All information provided within these documents are true and correct when give.</label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                       <label class="form-label" for="tab2SubB_inputA">A <span style="color:red;">*</span></label>
                                       <textarea type="text" id="tab2SubB_inputA" name="tab2SubB_inputA" class="form-control" rows="2"  {{$tab2SubB_edit ? "required" : "readonly" }}>{{$hasValue ? $loret : ""}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between pt-2">
                        <button class="btn btn-outline-secondary btn-prev" disabled>
                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        @if($tab2SubA_edit)
                        <button class="btn btn-success btn-next" onclick="fakeSuccess('Submitted',''); window.location='{{route('testForm.index',['id'=>4])}}'">
                            <span class="align-middle d-sm-inline-block d-none">Submit</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        @else
                        <button class="btn btn-primary btn-next" disabled>
                            <span class="align-middle d-sm-inline-block d-none">Seterusnya</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
