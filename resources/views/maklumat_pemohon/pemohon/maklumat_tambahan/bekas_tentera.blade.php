<form 
id="armyPoliceForm"
action="{{ route('army-police.store') }}"
method="POST"
data-refreshFunctionNameIfSuccess="reloadArmyPolice" data-reloadPage="false">
@csrf
<div class="row">
    {{-- <h6>
        <span class="text-muted">Kemaskini terkini: ONLINE 13/03/2023</span>
    </h6> --}}

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Kategori</label>
        <input type="text" class="form-control" value="" disabled>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
        <label class="form-label">Pangkat dalam Tentera</label>
        <select class="select2 form-control" name="army_police_rank" id="army_police_rank" disabled>
            <option value=""></option>
            @foreach($ranks as $rank)
            <option value="{{ $rank->code }}">{{ $rank->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 mb-1">
        <label class="form-label">Jenis Penamatan Perkhidmatan</label>
        <input type="text" class="form-control" value="" disabled>
    </div>
</div>
<div id="button_action_army_police" style="display:none">
        {{-- <button type="button" id="btnEditArmyPolice" hidden onclick="generalFormSubmit(this);"></button> --}}
        <div class="d-flex justify-content-end align-items-center my-1">
            <button type="button" class="btn btn-success float-right" onclick="$('#btnEditArmyPolice').trigger('click');reloadTimeline();">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
</form>

<div class="card-footer">
    <div class="d-flex justify-content-end align-items-center my-1 ">
        <a class="me-3 text-danger" type="button" id="update_army_police" onclick="editArmyPolice()">
            <i class="fa-regular fa-pen-to-square"></i>
            Kemaskini
        </a>
    </div>
</div>

<script>
function editArmyPolice() {
        $('#armyPoliceForm select[name="army_police_rank"]').attr('disabled', false);
        $('#armyPoliceForm select[name="army_police_rank"]').attr('required', true);

        var button_action_army_police = document.getElementById('button_action_army_police').style.display = 'block';
    }

    {{-- function reloadArmyPolice() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadArmyPoliceUrl = "{{ route('army-police.details', ':replaceThis') }}"
        reloadArmyPoliceUrl = reloadArmyPoliceUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadArmyPoliceUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#army_police_rank').val(data.detail.ref_rank_code).trigger('change');
            },
            error: function(data) {
                //
            }
        });
    } --}}
</script>