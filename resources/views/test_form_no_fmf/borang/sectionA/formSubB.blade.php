
<form class="row" id="testForm_submitSectionASubB_form" action="{{route('testFormNoFMF.submitSectionASubB')}}" method="POST"
    data-refreshFunctionDivId="testForm_submitSectionASubB_form_div" data-refreshFunctionURL="{{route("testFormNoFMF.viewSectionASubB", ['testFormId'=>$testForm->id])}}"
    data-refreshFunctionNameIfSuccess="goToSectionBTabA"
    >
    @csrf
    <input type="text" hidden id="test_form_id" name="test_form_id" value="{{$testForm->id}}">

    {{-- Single Upload File using Dropify --}}
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="example_upload_one_file_dropify"> Image (Single File) <span style="font-style:italic">Using Dropify</span> <span style="color:red;">*</span></label>
            <input type="file" class="form-control dropify" name="example_upload_one_file_dropify" id="example_upload_one_file_dropify"
                data-allowed-file-extensions="png webp jpg jpeg"
                data-default-file="{{ $testForm?->uploadedFiles('example_upload_one_file_dropify')->first() ? asset($testForm->uploadedFiles('example_upload_one_file_dropify')->first()->path) : ""}}"/>
        </div>
    </div>
    {{-- END Single Upload File using Dropify --}}

    {{-- Multiple Upload File Without Delete Previous Upload --}}
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="example_upload_multiple_file_but_delete_previous">Document List (Multiple Files) Without Delete Previous Upload <span style="color:red;">*</span></label>
            <input type="file" class="form-control" name="example_upload_multiple_file_but_delete_previous[]" id="example_upload_multiple_file_but_delete_previous[]" multiple />
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
                    @foreach($testForm?->uploadedFiles('example_upload_multiple_file_but_delete_previous')->get() as $key => $value)
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
    {{-- END Multiple Upload File Without Delete Previous Upload  --}}

    {{-- Single Upload File --}}
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="example_upload_one_file"> Document (Single File) <span style="color:red;">*</span></label>
            <input type="file" class="form-control" name="example_upload_one_file" id="example_upload_one_file"/>
        </div>
        @if($testForm?->uploadedFiles('example_upload_one_file')->count() >= 1)
            <a href="{{ asset($testForm?->uploadedFiles('example_upload_one_file')->first()?->path) }}" target="_blank">
                <i class="fa-solid fa-download"></i> {{ $testForm?->uploadedFiles('example_upload_one_file')->first()?->original_filename ?? "-" }}
            </a>
        @endif
    </div>
    {{-- END Single Upload File --}}

    {{-- Multiple Upload File --}}
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="example_upload_multiple_file">Document List (Multiple Files) <span style="color:red;">*</span></label>
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
    {{-- END Multiple Upload File --}}

    <button id="testForm_submitTabBSubB_btn" type="button" hidden onclick="generalFormSubmit(this);"></button>
</form>

<div class=" d-flex justify-content-between">
    <button class="btn btn-outline-secondary btn-prev">
        <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
        <span class="align-middle d-sm-inline-block d-none">Kembali</span>
    </button>

    <button class="btn btn-success btn-next" onclick="$('#testForm_submitTabBSubB_btn').trigger('click');">
        <span class="align-middle d-sm-inline-block d-none">Submit</span>
        <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
    </button>
</div>

<script>
    $(function(){
        initializeDropify();
    })
</script>
