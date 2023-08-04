<form id="testForm_submitSectionASubA_form" class="row" action="{{route('testFormNoFMF.submitSectionASubA')}}" method="POST" data-refreshFunctionNameIfSuccess="goToSectionATabB" >
    @csrf
    <input type="text" hidden id="test_form_id" name="test_form_id" value="{{$testForm->id}}">

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="user_full_name">Full Name <span style="color:red;">*</span></label>
            <input type="text" class="form-control" id="user_full_name" name="user_full_name" value="{{$testForm->user_full_name ?? ""}}" required>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="user_ic">IC Number <span style="color:red;">*</span>
                <span data-toggle="tooltip" data-placement="top" title="tanpa dash (-) "><i class="fas fa-circle-info text-primary "></i></span>
            </label>
            <input type="text" class="form-control" id="user_ic" name="user_ic" oninput="onlyNumberOnInputText(this)" value="{{$testForm->user_ic ?? ""}}" required>
        </div>
    </div>

    <div class="col-md-3 col-12">
        <div class="form-group">
            <label class="form-label" for="user_birth_date">Birth Date <span style="color:red;">*</span></label>
            <input type="text" class="form-control flatpickr-y-m-d" id="user_birth_date" name="user_birth_date" value="{{$testForm->user_birth_date ?? ""}}" required>
        </div>
    </div>

    <div class="col-md-3 col-12">
        <div class="form-group">
            <label class="form-label" for="user_gender"> Gender <span style="color:red;">*</span></label>
            <select type="text" class="form-control select2" id="user_gender" name="user_gender" required>
                <option value="1" {{ $testForm->user_gender == 1 ? "selected" : "" }}> {{__('msg.male')}}</option>
                <option value="2" {{ $testForm->user_gender == 2 ? "selected" : "" }}> {{__('msg.female')}}</option>
            </select>
        </div>
    </div>

    <div class="col-md-6 col-12">
        <label class="form-check-label mb-50" for="user_is_married">Is Married?</label>
        <div class="form-check form-switch form-check-primary">
            <input type="checkbox" class="form-check-input" id="user_is_married" name="user_is_married" {{ $testForm->user_is_married ? "checked" : "" }} />
        </div>
    </div>

    <div class="col-md-6 col-12">
        <div class="form-group">
            <label class="form-label" for="user_address">Home Address <span style="color:red;">*</span></label>
            <textarea class="form-control" id="user_address" row="4" name="user_address" required>{!! $testForm->user_address ?? ""!!}</textarea>
        </div>
    </div>

    <button id="testForm_submitSectionASubA_btn" type="button" hidden onclick="generalFormSubmit(this);"></button>
</form>

<div class="d-flex justify-content-between">
    <button class="btn btn-outline-secondary btn-prev" disabled>
        <span class="align-middle d-sm-inline-block d-none">
            <i class="fa-solid fa-arrow-left" class="align-middle ms-sm-25 ms-0"></i> Kembali
        </span>
    </button>

    <button class="btn btn-success" onclick="$('#testForm_submitSectionASubA_btn').trigger('click')">
        <span class="align-middle d-sm-inline-block d-none">
            Submit <i class="fa-solid fa-arrow-right"></i>
        </span>
    </button>
</div>
