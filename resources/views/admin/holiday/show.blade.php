<div class="card-header bg-transparent">
    <h4 class="card-title w-100">View Holiday</h4>
</div>
<div class="row" style="width: 100%;">
    <div class="col-md-12">
        <form action="{{ route('holiday.update', $holiday->id) }}" method="POST" class="form-horizontal" autocomplete="off">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>
            <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Title <b class="text-danger"></b></label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" required disabled value="{{ $holiday->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputMessage" class="col-sm-2 col-form-label">Message <b class="text-danger"></b></label>
                <div class="col-sm-10">
                    <textarea name="message" class="form-control" rows="3" placeholder="Message" required disabled>{!! $holiday->message !!}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Activeness:</label>
                <div class="row col-sm-10 pt-2">
                  <div class="custom-control custom-switch mr-5">
                    <input name="is_active_emel" type="checkbox" class="custom-control-input" id="inputIsActiveEmel" value="1" disabled {{ $holiday->is_active_emel ? 'checked' : '' }}>
                    <label class="custom-control-label" for="inputIsActiveEmel">Email</label>
                  </div>
                  <div class="custom-control custom-switch">
                    <input name="is_active_system" type="checkbox" class="custom-control-input" id="inputIsActiveSystem" value="1" disabled {{ $holiday->is_active_system ? 'checked' : '' }}>
                    <label class="custom-control-label" for="inputIsActiveSystem">Inbox System</label>
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