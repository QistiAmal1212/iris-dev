<section>
    <div class="bs-stepper vertical vertical-wizard">
        <div class="bs-stepper-header">
            <div class="step" data-target="#secAtabA2-vertical" role="tab" id="secAtabA2-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">A</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Personal <br />Information</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
            <hr />

            <div class="step" data-target="#secAtabD2-vertical" role="tab" id="secAtabD2-vertical-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">B</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Family <br />Informations</span>
                        <span class="bs-stepper-subtitle"><i></i></span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <div id="secAtabA2-vertical" class="content" role="tabpanel" aria-labelledby="secAtabA2-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">TAB 1 SUB A</h5>
                    <small class="text-muted">Please Enter Information</small>
                </div>
                <div class="">
                    <form class="row" action="{{route('testForm.submitTabASubA')}}" method="POST" data-reloadPage="true">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="example_upload_one_file">Document Image (One File) <span style="color:red;">*</span></label>
                                <input type="file" class="form-control dropify" name="example_upload_one_file" id="example_upload_one_file"
                                    data-allowed-file-extensions="png webp jpg jpeg"
                                    data-default-file="{{ $testForm?->uploadedFiles('example_upload_one_file')->first() ? asset($testForm->uploadedFiles('example_upload_one_file')->first()->path) : ""}}"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="example_upload_multiple_file">Document List (Multiple File) <span style="color:red;">*</span></label>
                                <input type="file" class="form-control" name="example_upload_multiple_file[]" id="example_upload_multiple_file[]" multiple />
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="70%" style="text-align:center">Document</th>
                                            <th width="30%" style="text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($testForm?->uploadedFiles('example_upload_multiple_file')->get() as $key => $value)
                                        <tr>
                                            <td>{{$value->original_filename ?? "-"}}</td>
                                            <td style="text-align:center">
                                                <a href="{{ asset($value->path) }}" target="_blank"><i class="fa-solid fa-download"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="inputA">A <span style="color:red;">*</span></label>
                                <textarea type="text" id="inputA" name="inputA" class="form-control" rows="2" {{$tab1_edit ? "required" : "readonly"}}>{{$hasValue ? $loret : ""}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="inputB">B <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" id="inputB" name="inputB" {{$tab1_edit ? "required" : "readonly"}} value="{{$hasValue ? "Hafiz" : ""}}">
                            </div>
                        </div>
                        <button id="testForm_submitTabASubA_btn" type="button" hidden onclick="generalFormSubmit(this);"></button>
                    </form>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev" disabled>
                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                        </button>
                        <button class="btn btn-success" @if($tab1_edit) onclick="$('#testForm_submitTabASubA_btn').trigger('click');" @endif >
                            <span class="align-middle d-sm-inline-block d-none">Submit</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        <button class="btn btn-primary btn-next" >
                            <span class="align-middle d-sm-inline-block d-none">Seterusnya</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div id="secAtabD2-vertical" class="content" role="tabpanel" aria-labelledby="secAtabD2-vertical-trigger">
                <div class="content-header">
                    <h5 class="mb-0">TAB 1 SUB B</h5>
                    <small class="text-muted">Please Enter Information</small>
                </div>
                <div class="">
                    <form class="row" action="{{route('testForm.submitTabBSubB')}}" method="post" data-reloadPage="true">
                        <input type="hidden" name="testform_id" value="{{$testForm->id}}">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="inputName">Father Name<span style="color:red;">*</span></label>
                                <input id="inputName" name="father_name" value="{{$testForm->father_name}}" type="text" class="form-control" {{$tab1_edit ? "required" : "readonly"}}>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="inputIC">Father IC<span style="color:red;">*</span></label>
                                <input id="inputIC" name="father_ic" value="{{$testForm->father_ic}}" type="text" class="form-control" {{$tab1_edit ? "required" : "readonly"}}>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="inputaddress">Address<span style="color:red;">*</span></label>
                                <textarea type="text" id="inputaddress" name="father_address" class="form-control" rows="2" {{$tab1_edit ? "required" : "readonly"}}>{{$testForm->father_address}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="status">Status<span style="color:red;">*</span></label>
                                <select id="status" name="father_status" class="form-control">
                                    <option value="0" {{$testForm->father_status == 0 ? "selected" : ""}}>Hensem</option>
                                    <option value="1" {{$testForm->father_status == 1 ? "selected" : ""}}>Tak Hensem</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="form-label" for="inputdate">Tarikh Lahir<span style="color:red;">*</span></label>
                                <input id="inputdate" name="father_birthdate" type="text" class="form-control flatpickr" {{$tab1_edit ? "required" : "readonly"}}>
                            </div>
                        </div>
                        <button id="testForm_submitTabBSubB_btn" type="button" hidden onclick="generalFormSubmit(this);"></button>
                    </form>
                    <div class=" d-flex justify-content-between">
                        <button class="btn btn-outline-secondary btn-prev">
                            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                        </button>
                        @if($tab1_edit)
                        <button class="btn btn-success btn-next" onclick="$('#testForm_submitTabBSubB_btn').trigger('click');">
                            <span class="align-middle d-sm-inline-block d-none">Submit</span>
                            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                        </button>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
