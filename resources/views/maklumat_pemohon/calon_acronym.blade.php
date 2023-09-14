@extends('layouts.app')

@section('header')
Calon Acronym
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="#"> Calon Acronym </a></li>
@endsection

@section('content')
<div class="row">
    <div class="card">
        <div class="card-body">
            <div class="row mt-2 mb-2">
                <form 
                id="acronymForm"
                action="{{ route('acronym.search') }}"
                method="POST"
                data-refreshFunctionNameIfSuccess="reloadAcronym" 
                data-reloadPage="false">
                @csrf
                
                <h3>Subjek PMR</h3>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 1</label>
                        <select class="select2 form-control" name="pmr[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekPmr as $pmr)
                            <option value="{{ $pmr->code }}">{{ $pmr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 1 Gred</label>
                        <select class="select2 form-control" name="gred_pmr[]">
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 2</label>
                        <select class="select2 form-control" name="pmr[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekPmr as $pmr)
                            <option value="{{ $pmr->code }}">{{ $pmr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 2 Gred</label>
                        <select class="select2 form-control" name="gred_pmr[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 3</label>
                        <select class="select2 form-control" name="pmr[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekPmr as $pmr)
                            <option value="{{ $pmr->code }}">{{ $pmr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 3 Gred</label>
                        <select class="select2 form-control" name="gred_pmr[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 4</label>
                        <select class="select2 form-control" name="pmr[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekPmr as $pmr)
                            <option value="{{ $pmr->code }}">{{ $pmr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 4 Gred</label>
                        <select class="select2 form-control" name="gred_pmr[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 5</label>
                        <select class="select2 form-control" name="pmr[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekPmr as $pmr)
                            <option value="{{ $pmr->code }}">{{ $pmr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">PMR 5 Gred</label>
                        <select class="select2 form-control" name="gred_pmr[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h3>Subjek SPM</h3>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 1</label>
                        <select class="select2 form-control" name="spm[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekSpm as $spm)
                            <option value="{{ $spm->code }}">{{ $spm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 1 Gred</label>
                        <select class="select2 form-control" name="gred_spm[]">
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 2</label>
                        <select class="select2 form-control" name="spm[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekSpm as $spm)
                            <option value="{{ $spm->code }}">{{ $spm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 2 Gred</label>
                        <select class="select2 form-control" name="gred_spm[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 3</label>
                        <select class="select2 form-control" name="spm[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekSpm as $spm)
                            <option value="{{ $spm->code }}">{{ $spm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 3 Gred</label>
                        <select class="select2 form-control" name="gred_spm[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 4</label>
                        <select class="select2 form-control" name="spm[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekSpm as $spm)
                            <option value="{{ $spm->code }}">{{ $spm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 4 Gred</label>
                        <select class="select2 form-control" name="gred_spm[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 5</label>
                        <select class="select2 form-control" name="spm[]">
                            <option value="">Sila Pilih</option>
                            @foreach($subjekSpm as $spm)
                            <option value="{{ $spm->code }}">{{ $spm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 mb-1">
                        <label class="form-label">SPM 5 Gred</label>
                        <select class="select2 form-control" name="gred_spm[]">
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="">Sila Pilih</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                            <option value="4">D</option>
                            <option value="5">E</option>
                        </select>
                    </div>
                </div>
                <button type="button" id="btnAcronym" hidden onclick="generalFormSubmit(this);"></button>
                <div class="d-flex justify-content-end align-items-center my-1">
                    <a class="me-3" type="button" id="reset" href="#">
                        <span class="text-danger"> Set Semula </span>
                    </a>
                    {{-- <button type="button" class="btn btn-success float-right" onclick="$('#btnAcronym').trigger('click');"> --}}
                    <button type="button" class="btn btn-success float-right" onclick="listCalon()">
                        <i class="fa fa-save"></i> Carian
                    </button>
                </div>
                </form>

                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered table-hovered" id="table-acronym">
                        <thead>
                            <tr>
                                <th>Bil.</th>
                                <th>No Pengenalan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function listCalon() {
        var pmr = document.getElementsByName('pmr[]');
        var array_pmr = [];
        for (var i = 0; i < pmr.length; i++) {
            var a = pmr[i];
            array_pmr.push(a.value);
        }

        var gred_pmr = document.getElementsByName('gred_pmr[]');
        var array_gred_pmr = [];
        for (var i = 0; i < gred_pmr.length; i++) {
            var b = gred_pmr[i];
            array_gred_pmr.push(b.value);
        }

        var spm = document.getElementsByName('spm[]');
        var array_spm = [];
        for (var i = 0; i < spm.length; i++) {
            var c = spm[i];
            array_spm.push(c.value);
        }

        var gred_spm = document.getElementsByName('gred_spm[]');
        var array_gred_spm = [];
        for (var i = 0; i < gred_spm.length; i++) {
            var d = gred_spm[i];
            array_gred_spm.push(d.value);
        }

        $.ajax({
            url: "{{ route('acronym.search') }}",
            method: 'POST',
            data : {
                pmr : array_pmr,
                gred_pmr : array_gred_pmr,
                spm : array_spm,
                gred_spm : array_gred_spm,
            },
            success: function(data) {

                $('#table-acronym tbody').empty();

                var tr = '';
                var bil = 0;
                $.each(data.detail, function (i, item) {
                    bil += 1;
                    tr += '<tr>';
                    tr += '<td align="center">' + bil + '</td>'
                    tr += '<td>' + item.no_pengenalan + '</td>';
                    tr += '</tr>';
                });
                $('#table-acronym tbody').append(tr);
            },
            error: function(data) {
                //
            }
        });
    }
</script>