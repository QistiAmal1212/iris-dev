{{-- Do Not Change the ID: baseAjaxModalContent if you are using getModalContent function - Hafiz R --}}
<div class="modal fade" id="baseAjaxModalContent" tabindex="-1" aria-labelledby="statusFormModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50">
                <h1 class="text-center mb-1" id="addNewCardTitle">Family Form</h1>
                <p class="text-center">{{$testFamily ? 'Edit' : 'Add'}} Family Member</p>

                <form id="familyForm" action="{{$testFamily ? route('testFormNoFMF.updateFamily') : route('testFormNoFMF.createFamily')}}" method="POST"  name="familyForm"
                    data-refreshFunctionDivId="tableFamilyDiv" data-refreshFunctionURL="{{route('testFormNoFMF.refreshFamilyTable',$testForm->id)}}"
                    data-refreshFunctionNameIfSuccess="closeModalContent">
                        @csrf
                        <input type="hidden" name="test_form_no_fmf_id" value="{{$testForm?->id ?? null}}">

                        <input type="hidden" name="test_form_no_fmf_family_id" value="{{$testFamily?->id ?? null}}">

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required value="{{$testFamily?->name ?? ""}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="age">Age <span class="text text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" id="age" name="age" class="form-control" placeholder="Age" required value="{{$testFamily?->age ?? ""}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="select2-multiple">Gender <span class="text text-danger">*</span></label>
                                <select class="select2 form-select" id="select2-multiple" name="gender">
                                    <option value="" hidden>Please Choose Gender</option>
                                    <option value="Lelaki" {{$testFamily?->gender == "Lelaki" ? "selected" : ""}}>Lelaki</option>
                                    <option value="Perempuan" {{$testFamily?->gender == "Perempuan" ? "selected" : ""}}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" id="btnUpdateUserForm" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="btnUpdateFake" class="btn btn-success" onclick="$('#btnUpdateUserForm').trigger('click');">{{__('msg.submit')}}</button>
            </div>
        </div>
    </div>
</div>

<script>
    hideThisModal = function(element){
        $()
    }
</script>
