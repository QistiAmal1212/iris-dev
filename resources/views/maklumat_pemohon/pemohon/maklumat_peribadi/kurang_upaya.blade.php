<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">No. Pendaftaran OKU</label>
        <input type="text" class="form-control" value="" name="oku_registration_no" id="oku_registration_no" onchange="checkInput('oku_registration_no', 'oku_registration_noAlert')" disabled>
        <div id="oku_registration_noAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Status OKU</label>
        <input type="text" class="form-control" value="" name="oku_status" id="oku_status" onchange="checkInput('oku_status', 'oku_statusAlert')" disabled>
        <div id="oku_statusAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Kategori OKU</label>
        <input type="text" class="form-control" value="" name="oku_category" id="oku_category" onchange="checkInput('oku_category', 'oku_categoryAlert')" disabled>
        <div id="oku_categoryAlert" style="color: red; font-size: smaller;"></div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Sub- Kategori OKU</label>
        <input type="text" class="form-control" value="" name="oku_sub" id="oku_sub" onchange="checkInput('oku_sub', 'oku_subAlert')" disabled>
        <div id="oku_subAlert" style="color: red; font-size: smaller;"></div>
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
