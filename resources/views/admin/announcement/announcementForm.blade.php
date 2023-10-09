
@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@endsection

@php
    $read_only = $read_only ?? null;
    $moduleannouncement = $moduleannouncement ?? null;
@endphp
<div class="modal fade" id="announcementFormModal" tabindex="-1" aria-labelledby="#addNewCardTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-0 bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-2 mx-50">
                <h1 class="text-center mb-1" id="addNewCardTitle">Announcement Form</h1>
                <p class="text-center" name="sub_title" id="sub_title">Add Announcement</p>
                <form action="" method="POST" class="form-horizontal" autocomplete="off" name="announcementFormModal" id="announcementFormModal" data-refreshFunctionDivId="tableAnnouncement" data-refreshFunctionURL="{{route('announcement.refreshAnnouncementTable')}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$id ?? null}}">
                    <input type="hidden" name="_method" value="">
                    <div class="form-group">
                        <label for="inputTitle" class="form-label">Title <b class="text-danger">*</b></label>
                        <input type="text" class="form-control" id="announcement_title" placeholder="Title" name="announcement_title" required>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="form-label">Description <b class="text-danger">*</b></label>
                        <textarea name="announcement_description" id="" cols="30" rows="3" class="form-control" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Announcement Type <b class="text-danger">*</b></label>
                        <select class="form-control select-lg" id="inputAnnouncementType" name="announcement_type_id" required>
                            <option value="default">Please Select</option>
                            @foreach ($MasterAnnouncementType as $announcementType)
                                <option value="{{ $announcementType->id }}">{{ $announcementType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputAnnouncementTarget" class="form-label">Announcement Target</label>
                        <select class="select2" multiple="multiple" id="inputAnnouncementTarget" name="announcement_target[]" data-placeholder="Select If Applicable" style="width: 100%">
                            @foreach ($Role as $r)
                                <option value="{{ $r->id }}">{{ $r->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="inputDateStart" class="col-sm-6 col-form-label">Date Start <b class="text-danger">*</b></label>
                            <div class="input-group date" id="inputDateStart" data-target-input="nearest">
                                <input name="date_start" type="text" class="form-control datetimepicker-input" data-target="#inputDateStart" required/>
                                <div class="input-group-append" data-target="#inputDateStart" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="inputDateEnd" class="col-sm-6 col-form-label">Date End <b class="text-danger">*</b></label>
                            <div class="input-group date" id="inputDateEnd" data-target-input="nearest">
                                <input name="date_end" type="text" class="form-control datetimepicker-input" data-target="#inputDateEnd" required/>
                                <div class="input-group-append" data-target="#inputDateEnd" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar lg"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-submit float-right">Submit</button>
                        </div>
                    </div> --}}
                    <button type="button" id="btnannouncementSubmit" hidden onclick="generalFormSubmit(this);"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnannouncementAdd" class="btn btn-success" onclick="$('#btnannouncementSubmit').trigger('click');">{{__('msg.submit')}}</button>
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
