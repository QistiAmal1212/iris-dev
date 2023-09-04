<div class="row">
    {{-- ALAMAT TETAP --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder">Alamat Tetap</span>
    </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" value="" name="permanent_address_1" id="permanent_address_1" disabled>
        <br>
        <input type="text" class="form-control" value="" name="permanent_address_2" id="permanent_address_2" disabled>
        <br>
        <input type="text" class="form-control" value="" name="permanent_address_3" id="permanent_address_3" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Poskod</label>
        <input type="text" class="form-control" value="" name="permanent_poscode" id="permanent_poscode" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Bandar</label>
        <input type="text" class="form-control" value="" name="permanent_city" id="permanent_city" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="permanent_state" id="permanent_state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>

    {{-- ALAMAT SURAT MENYURAT --}}
    <h6>
        <span class="badge badge-light-primary fw-bolder mt-1">Alamat Surat Menyurat</span>
    </h6>
    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Alamat</label>
        <input type="text" class="form-control" value="" name="address_1" id="address_1" disabled>
        <br>
        <input type="text" class="form-control" value="" name="address_2" id="address_2" disabled>
        <br>
        <input type="text" class="form-control" value="" name="address_3" id="address_3" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Poskod</label>
        <input type="text" class="form-control" value="" name="poscode" id="poscode" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Bandar</label>
        <input type="text" class="form-control" value="" name="city" id="city" disabled>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Negeri</label>
        <select class="select2 form-control" name="state" id="state" disabled>
            <option value=""></option>
            @foreach($states as $state)
            <option value="{{ $state->code }}">{{ $state->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="reset" href="#">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>