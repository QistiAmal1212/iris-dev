
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection

@php
    $read_only = $read_only ?? null;
    $moduleannouncement = $moduleannouncement ?? null;
@endphp
<div class="modal fade" id="faqFormModal" tabindex="-1" aria-labelledby="#addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50">
                <h1 class="text-center mb-1" id="addNewCardTitle">FAQ Form</h1>
                <p class="text-center" name="sub_title" id="sub_title">Add Question</p>
                <form action="" method="POST" class="form-horizontal" autocomplete="off" name="faqForm" id="faqForm" data-refreshFunctionDivId="tableFaqDiv" data-refreshFunctionURL="{{route('faq.refreshFaqTable')}}">
                    @csrf
                    {{-- <input type="hidden" name="user_id" value="{{$id ?? null}}"> --}}
                    <input type="hidden" name="_method" value="">
                    <div class="form-group">
                        <label for="question" class="form-label">Question <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" id="question" placeholder="Question" name="question" required>
                    </div>
                    <div class="form-group">
                        <label for="answer" class="form-label">Answer <b class="text-danger">*</b></label>
                        <textarea name="answer" id="" cols="30" rows="3" class="form-control" placeholder="Answer" required></textarea>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="faq_language" class="form-label">Language <b class="text-danger">*</b></label>
                                    <select class="form-control select-lg" id="faq_language" name="faq_language" required >
                                        <option value="default">Please Select Language</option>
                                        {{-- @foreach ($MasterAnnouncementType as $announcementType)
                                            <option value="{{ $announcementType->id }}">{{ $announcementType->name }}</option>
                                        @endforeach --}}
                                        <option value="ms">Malay</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="language" class="form-label">Type <b class="text-danger">*</b></label>
                                    <select class="form-control select-lg" id="faq_type" name="faq_type" required >
                                        <option value="default">Please Select Type</option>
                                        @foreach ($master_faq_type as $master_faq_type)
                                            <option value="{{ $master_faq_type->id }}">{{ $master_faq_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-submit float-right">Submit</button>
                        </div>
                    </div> --}}
                    <button type="button" id="btnfaqSubmit" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnfaqAdd" class="btn btn-success" onclick="$('#btnfaqSubmit').trigger('click');">{{__('msg.submit')}}</button>
            </div>
        </div>
    </div>
</div>

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endsection
