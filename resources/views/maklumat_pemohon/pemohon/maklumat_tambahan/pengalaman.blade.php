<div class="card" id="" style="display:none">
    <div class="d-flex justify-content-end align-items-center my-1">
        <a class="me-3 text-danger" type="button" onclick="">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>
<form id="" action="#" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="" data-reloadPage="false">
    @csrf
    <div class="row mt-2 mb-2">
       <!--  <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
            <label class="form-label">Jawatan yang Dimohon</label>
            <select class="select2 form-control" name="" id="" disabled>
                <option value="" hidden>Jawatan yang Dimohon</option>
                    {{-- @foreach($states as $state)
                    <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
                    @endforeach --}}
            </select>
        </div>
 -->
       <!--  <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Tarikh Mula</label>
            <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="" id=""disabled />
        </div>

        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
            <label class="form-label">Tarikh Akhir</label>
            <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="" id="" disabled />
        </div>

        <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
            <label class="form-label">Peringkat Pengalaman</label>
            <select class="select2 form-control" name="" id="" disabled>
                <option value="" hidden>Peringkat Pengalaman</option>
                    {{-- @foreach($states as $state)
                    <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
                    @endforeach --}}
            </select>
        </div> -->

        <!-- <div class="col-sm-8 col-md-8 col-lg-8 mb-1">
            <label class="form-label">Jenis Pengalaman</label>
            <select class="select2 form-control" name="" id="" disabled>
                <option value="" hidden>Jenis Pengalaman</option>
                {{-- @foreach($states as $state)
                <option value="{{ $state->kod }}">{{ $state->diskripsi }}</option>
                @endforeach --}}
            </select>
        </div> -->
    </div>
    <div id="" style="display:none">
        <button type="button" id="" hidden onclick="generalFormSubmit(this);"></button>
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-danger float-right" onclick="">
                <i class="fa fa-refresh"></i>
            </button>&nbsp;&nbsp;
            <button type="button" class="btn btn-success float-right" id="" onclick="$('#').trigger('click');">
                <i class="fa fa-save"></i> Tambah
            </button>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table class="table header_uppercase table-bordered table-hovered" id="">
        <thead>
            <tr>
                <th>Bil.</th>
                <th>Jawatan yang Dimohon</th>
                <th>Tarikh Mula</th>
                <th>Tarikh Akhir</th>
                <th>Peringkat Pengalaman</th>
                <th>Jenis Pengalaman</th>
                <!-- <th>Kemaskini</th> -->
            </tr>
        </thead>
        <tbody> <tr>
            <td align="center" colspan="6" >Tiada Maklumat</td>
        </tr></tbody>
    </table>
</div>
