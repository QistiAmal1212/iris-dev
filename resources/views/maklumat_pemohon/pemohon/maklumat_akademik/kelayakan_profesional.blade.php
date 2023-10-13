<div class="d-flex justify-content-end align-items-center mb-1" id="" style="display:none">
    <a class="me-3 text-danger" type="button" onclick="">
        <i class="fa-regular fa-pen-to-square"></i>
        Kemaskini
    </a>
</div>

<form id="" action="" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="" data-reloadPage="false">
    @csrf

    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
            <label class="form-label">No. Ahli</label>
            <input type="text" class="form-control" value="" id="" name="" disabled>
        </div>

        <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
            <label class="form-label">Kelayakan Profesional/ Ikhtisas</label>
            <input type="text" class="form-control" value="" id="" name="" disabled>
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2 mb-1">
            <label class="form-label">Tarikh Keahlian</label>
            <input type="text" class="form-control form-control flatpickr" placeholder="DD/MM/YYYY" value="" id="" name="" disabled>
        </div>

        <div id="" style="display:none">
            <button type="button" id="" hidden onclick="generalFormSubmit(this);"></button>
            <div class="d-flex justify-content-end align-items-center my-1">
                <button type="button" class="btn btn-danger me-1" onclick="">
                    <i class="fa fa-refresh"></i>
                </button>
                <button type="button" class="btn btn-success float-right" id="" onclick="">
                    <i class="fa fa-save"></i> Tambah
                </button>
            </div>
        </div>
    </div>
</form>

<div class="row mt-2 mb-2">
    <div class="table-responsive">
        <table class="table header_uppercase table-bordered table-hovered" id="table-professional">
            <thead>
                <tr>
                    <th>Bil.</th>
                    <th>No. Ahli</th>
                    <th>Kelayakan Profesional/ Ikhtisas</th>
                    <th>Tarikh Keahlian</th>
                    <th>Kemaskini</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
