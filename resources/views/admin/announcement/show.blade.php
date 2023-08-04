<div class="card-header bg-transparent">
    <h4 class="card-title w-100">View Announcement</h4>
</div>
<div class="row" style="width: 100%;">
    <div class="col-md-12">
        <form action="{{ route('announcement.update', $announcement->id) }}" method="POST" class="form-horizontal" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group row">
                <label for="inputTitle" class="col-sm-2 col-form-label">Title <b class="text-danger"></b></label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Title" value="{{ $announcement->title }}" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputDescription" class="col-sm-2 col-form-label">Description <b class="text-danger"></b></label>
                <div class="col-sm-10">
                    <textarea name="description" class="form-control" rows="3" placeholder="Description" disabled>{{ $announcement->description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputAnnouncementType" class="col-sm-2 col-form-label">Announcement Type <b class="text-danger"></b></label>
                <div class="col-sm-10">
                    <select class="custom-select rounded-0" id="inputAnnouncementType" name="announcement_type_id" disabled>
                        <option value="">Please Select</option>
                        @foreach ($MasterAnnouncementType as $announcementType)
                            <option value="{{ $announcementType->id }}" {{ $announcementType->id == $announcement->type->id ? 'selected' : '' }}>{{ $announcementType->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputAnnouncementTarget" class="col-sm-2 col-form-label">Announcement Target</label>
                <div class="col-sm-10">
                    <select class="select2" multiple="multiple" id="inputAnnouncementTarget" name="announcement_target[]" data-placeholder="Select If Applicable" disabled style="width: 100%">
                        @foreach ($Role as $r)
                            <option value="{{ $r->id }}">{{ $r->description }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="inputDateStart" class="col-sm-6 col-form-label">Date Start <b class="text-danger"></b></label>
                    <div class="input-group date" id="inputDateStart" data-target-input="nearest">
                        <input name="date_start" type="text" class="form-control datetimepicker-input" data-target="#inputDateStart" value="{{ \Carbon\Carbon::parse($announcement->date_start)->format('d/m/Y') }}" disabled />
                        <div class="input-group-append" data-target="#inputDateStart" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label for="inputDateEnd" class="col-sm-6 col-form-label">Date End <b class="text-danger"></b></label>
                    <div class="input-group date" id="inputDateEnd" data-target-input="nearest">
                        <input name="date_end" type="text" class="form-control datetimepicker-input" data-target="#inputDateEnd" value="{{ \Carbon\Carbon::parse($announcement->date_end)->format('d/m/Y') }}" disabled />
                        <div class="input-group-append" data-target="#inputDateEnd" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#inputAnnouncementTarget').val(@json($AnnouncementTarget));
        $('.select2').select2();
        $('.date[data-target-input]').datepicker({
            format: 'dd/mm/yyyy'
        }).on('hide', function(e) {
            e.stopPropagation();
        });
    });
</script>
