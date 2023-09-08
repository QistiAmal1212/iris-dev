<div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tempat Lahir</label>
        <select class="select2 form-control" name="place_of_birth" id="place_of_birth" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tempat Lahir Ayah</label>
        <select class="select2 form-control" name="father_place_of_birth" id="father_place_of_birth" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tempat Lahir Ibu</label>
        <select class="select2 form-control" name="mother_place_of_birth" id="mother_place_of_birth" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="reset" hidden href="#">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>