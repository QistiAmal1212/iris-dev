<div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Jenis Lesen</label>
        <input type="text" class="form-control" value="" name="license_type" id="license_type" onchange="checkInput('license_type', 'license_typeAlert')" disabled>
        <div id="license_typeAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Tarikh Tamat</label>
        <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="license_expiry_date" id="license_expiry_date" onchange="checkInput('license_expiry_date', 'license_expiry_dateAlert')" disabled />
        <div id="license_expiry_dateAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Status Senarai Hitam</label>
        <select class="select2 form-control" name="license_blacklist_status" id="license_blacklist_status" disabled>
            <option value=""></option>
            <option value="1">Ya</option>
            <option value="0">Tidak</option>
        </select>
        <div id="date_of_birthAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
        <label class="form-label">Butiran Senarai Hitam</label>
        <textarea rows="3" class="form-control" name="license_blacklist_details" id="license_blacklist_details" onchange="checkInput('license_blacklist_details', 'license_blacklist_detailsAlert')" disabled>
        </textarea>
        <div id="license_blacklist_detailsAlert" style="color: red; font-size: smaller;"></div>
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
