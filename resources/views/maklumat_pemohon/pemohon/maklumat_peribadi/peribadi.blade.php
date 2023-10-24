<style>
    .flatpickr-input[disabled]{
        background-color: #efefef;
    }
    input[type="number"]::-webkit-outer-spin-button, 
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

{{-- <div class="nav-vertical"> --}}
    <div class="row">
        <div class="col-md-2 col-sm-12">
            <ul class="nav nav-tabs nav-left flex-column" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-wrap active" id="baseVerticalLeft-tab1" data-bs-toggle="tab" aria-controls="tabVerticalLeft1" href="#tabVerticalLeft1" role="tab" aria-selected="true">
                        Maklumat Peribadi
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-wrap" id="baseVerticalLeft-tab2" data-bs-toggle="tab" aria-controls="tabVerticalLeft2" href="#tabVerticalLeft2" role="tab" aria-selected="false">
                        Jejak Audit ok
                    </a>
                </li> -->
            </ul>
        </div>

        <div class="col-md-10 col-sm-12">
            <div class="tab-content">
                <div class="tab-pane active" id="tabVerticalLeft1" role="tabpanel" aria-labelledby="baseVerticalLeft-tab1">
                    <div id="update_personal" style="display:none">
                        <div class="d-flex justify-content-end align-items-center mb-1">
                            <a class="me-3 text-danger" type="button" onclick="editPersonal()">
                                <i class="fa-regular fa-pen-to-square"></i>
                                Kemaskini
                            </a>
                        </div>
                    </div>

                    <form id="personalForm" action="{{ route('personal.update') }}" method="POST" data-refreshFunctionName="reloadTimeline" data-refreshFunctionNameIfSuccess="reloadPersonal" data-reloadPage="false">
                        @csrf
                        <div id="div_personal">
                            <input type="hidden" name="personal_no_pengenalan" id="personal_no_pengenalan" value="">

                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <label class="form-label">Jantina</label>
                                    <select class="select2 form-control" name="gender" id="gender" disabled>
                                        <option value=""></option>
                                        @foreach($genders as $gender)
                                        <option value="{{ $gender->kod }}">{{ strtoupper($gender->diskripsi) }}</option>
                                        @endforeach
                                    </select>
                                    <div id="genderAlert" style="color: red; font-size: smaller;"></div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <label class="form-label">Agama</label>
                                    <select class="select2 form-control" name="religion" id="religion" disabled>
                                        <option value=""></option>
                                        @foreach($religions as $religion)
                                        <option value="{{ $religion->kod }}">{{ $religion->diskripsi }}</option>
                                        @endforeach
                                    </select>
                                    <div id="religionAlert" style="color: red; font-size: smaller;"></div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <label class="form-label">Keturunan</label>
                                    <select class="select2 form-control" name="race" id="race" disabled>
                                        <option value=""></option>
                                        @foreach($races as $race)
                                        <option value="{{ $race->kod }}">{{ $race->diskripsi }}</option>
                                        @endforeach
                                    </select>
                                    <div id="raceAlert" style="color: red; font-size: smaller;"></div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Tarikh Lahir</label>
                                    <input type="text" class="form-control flatpickr" placeholder="DD/MM/YYYY" value="" name="date_of_birth" id="date_of_birth" oninput="checkInput('date_of_birth', 'date_of_birthAlert')" disabled />
                                    <div id="date_of_birthAlert" style="color: red; font-size: smaller;"></div>
                                </div>

                                {{-- <div class="col-sm-4 col-md-4 col-lg-4 mb-1">
                                    <label class="form-label">Umur</label>
                                    <input type="text" class="form-control" value="" name="age" id="age" disabled>
                                </div> --}}

                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Taraf Perkahwinan</label>
                                    <select class="select2 form-control" name="marital_status" id="marital_status" disabled>
                                        <option value=""></option>
                                        @foreach($maritalStatuses as $maritalStatus)
                                        <option value="{{ $maritalStatus->kod }}">{{ $maritalStatus->diskripsi }}</option>
                                        @endforeach
                                    </select>
                                    <div id="marital_statusAlert" style="color: red; font-size: smaller;"></div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">No. Telefon</label>
                                    <input type="text" class="form-control" value="" name="phone_number" id="phone_number" oninput="checkInput('phone_number', 'phone_numberAlert')" onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                                    <div id="phone_numberAlert" style="color: red; font-size: smaller;"></div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                                    <label class="form-label">Alamat Emel</label>
                                    <input type="text" class="form-control" value="" name="email" id="email" oninput="checkInput('email', 'emailAlert')" disabled>
                                    <div id="emailAlert" style="color: red; font-size: smaller;"></div>
                                </div>
                            </div>
                        </div>

                        <div id="button_action_personal" style="display:none">
                            <button type="button" id="btnEditPersonal" hidden onclick="generalFormSubmit(this);"></button>
                            <div class="d-flex justify-content-end align-items-center my-1">
                                <button type="button" class="btn btn-success float-right" onclick="confirmSubmit('btnEditPersonal', {
                                    gender: $('#gender').find(':selected').text(),
                                    religion: $('#religion').find(':selected').text(),
                                    race: $('#race').find(':selected').text(),
                                    date_of_birth: $('#date_of_birth').val(),
                                    marital_status: $('#marital_status').find(':selected').text(),
                                    phone_number: $('#phone_number').val(),
                                    email: $('#email').val()
                                },{
                                    gender: 'Jantina',
                                    religion: 'Agama',
                                    race: 'Keturunan',
                                    date_of_birth: 'Tarikh Lahir',
                                    marital_status: 'Taraf Perkahwinan',
                                    phone_number: 'No. Telefon',
                                    email: 'Alamat Emel'
                                }
                                );">
                                    <i class="fa fa-save"></i> Simpan
                                </button>
                            </div>
                        </div>
                    <input type="hidden" name="tukar_log"  id= "tukar_log">
                    </form>
                    <input type="hidden" name="editbutton" value=0 id= "editbutton">

                    <textarea id="currentvalues" style="display:none;"></textarea>
                </div>
                <div class="tab-pane" id="tabVerticalLeft2" role="tabpanel" aria-labelledby="baseVerticalLeft-tab2">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Tarikh Mula</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                            <label class="form-label">Tarikh Akhir</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="d-flex justify-content-end align-items-center">
                            <a class="me-3" type="button" id="reset" href="#">
                                <span class="text-danger"> Set Semula </span>
                            </a>
                            <button type="submit" class="btn btn-success float-right">
                                <i class="fa fa-search"></i> Cari
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive mb-1 mt-1">
                        <table class="table header_uppercase table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Maklumat</th>
                                    <th>Status</th>
                                    <th>Tarikh</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

<script>
 
    function editPersonal() {
        $('#personalForm select[name="gender"]').attr('disabled', false);
        $('#personalForm select[name="religion"]').attr('disabled', false);
        $('#personalForm select[name="race"]').attr('disabled', false);
        $('#personalForm input[name="date_of_birth"]').attr('disabled', false);
        $('#personalForm select[name="marital_status"]').attr('disabled', false);
        $('#personalForm input[name="phone_number"]').attr('disabled', false);
        $('#personalForm input[name="email"]').attr('disabled', false);

        $("#button_action_personal").attr("style", "display:block");

        var editbuttoncount = $('#editbutton').val();
        if (editbuttoncount <= 0) {
            // firsttime
            $('#editbutton').val(1)
            var check_data = {
                gender: $('#gender').find(':selected').text(),
                religion: $('#religion').find(':selected').text(),
                race: $('#race').find(':selected').text(),
                date_of_birth: $('#date_of_birth').val(),
                marital_status: $('#marital_status').find(':selected').text(),
                phone_number: $('#phone_number').val(),
                email: $('#email').val()
            };
            $('#currentvalues').val(JSON.stringify(check_data));
        } else {
            checkkemaskini();
        }

    }
    function checkkemaskini() {
        
        var datachanged = false;
        var checkValue = JSON.parse($('#currentvalues').val());
   
        if (checkValue.gender != $('#gender').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.religion != $('#religion').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.race != $('#race').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.date_of_birth != $('#date_of_birth').val()) {
            datachanged = true;
        }
        if (checkValue.marital_status != $('#marital_status').find(':selected').text()) {
            datachanged = true;
        }
        if (checkValue.phone_number != $('#phone_number').val()) {
            datachanged = true;
        }
        if (checkValue.email != $('#email').val()) {
            datachanged = true;
        }
        if (!datachanged) {
            $('#editbutton').val(0);
            disbalefields();
        }
    }
    function disbalefields() {
        $('#personalForm select[name="gender"]').attr('disabled', true);
            $('#personalForm select[name="religion"]').attr('disabled', true);
            $('#personalForm select[name="race"]').attr('disabled', true);
            $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
            $('#personalForm select[name="marital_status"]').attr('disabled', true);
            $('#personalForm input[name="phone_number"]').attr('disabled', true);
            $('#personalForm input[name="email"]').attr('disabled', true);
    }

    function reloadPersonal() {
        var no_pengenalan = $('#candidate_no_pengenalan').val();

        var reloadPersonalUrl = "{{ route('personal.details', ':replaceThis') }}"
        reloadPersonalUrl = reloadPersonalUrl.replace(':replaceThis', no_pengenalan);
        $.ajax({
            url: reloadPersonalUrl,
            method: 'GET',
            async: true,
            success: function(data) {
                $('#personalForm select[name="gender"]').val(data.detail.jan_kod).trigger('change');
                $('#personalForm select[name="gender"]').attr('disabled', true);
                $('#personalForm select[name="religion"]').val(data.detail.agama).trigger('change');
                $('#personalForm select[name="religion"]').attr('disabled', true);
                $('#personalForm select[name="race"]').val(data.detail.ket_kod).trigger('change');
                $('#personalForm select[name="race"]').attr('disabled', true);
                $('#personalForm input[name="date_of_birth"]').val(data.detail.tarikh_lahir);
                $('#personalForm input[name="date_of_birth"]').attr('disabled', true);
                $('#personalForm select[name="marital_status"]').val(data.detail.taraf_perkahwinan).trigger('change');
                $('#personalForm select[name="marital_status"]').attr('disabled', true);
                $('#personalForm input[name="phone_number"]').val(data.detail.no_tel);
                $('#personalForm input[name="phone_number"]').attr('disabled', true);
                $('#personalForm input[name="email"]').val(data.detail.e_mel);
                $('#personalForm input[name="email"]').attr('disabled', true);

                $("#button_action_personal").attr("style", "display:none");
            },
            error: function(data) {
                //
            }
        });
    }
</script>
