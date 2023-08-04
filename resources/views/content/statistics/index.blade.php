@extends('layouts.contentLayoutMaster')

@section('header')
    <h2 class="customTitle1"> {{__('msg.statistics')}}</h2>
    <span class="customTitle1"> {{__('msg.statisticsDescription')}}</span>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><span> {{__('msg.statistics')}}</span></li>
@endsection

@section('content')
<style>
label {
    margin-bottom: 0.1rem;
    margin-top: 0.2rem;
}
</style>
<div class="row">
    <div class="col-md-12">

        {{-- <div class="pb-3">
            <h3><b>LAPORAN CERAPAN STESEN PENGAWASAN</b></h3>
        </div> --}}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label >
                        REGION <span class="text-danger" >*</span>
                    </label>
                    <select id="region" class="select-normal full-width custom-select border border-default " required="" data-error-msg="Ruangan ini perlu dipilih." data-init-plugin="select2" onchange="changeRegion(this);checkAllRequirementSubmit();">
                        <option value="CENTRAL">CENTRAL</option>
                        <option value="EASTERN">EASTERN</option>
                        <option value="NORTHERN">NORTHERN</option>
                        <option value="SOUTHERN">SOUTHERN</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="selectrequired">
                        BRANCH OFFICE <span class="text-danger" >*</span>
                    </label>
                    <select id="branch_office" class="select-normal full-width custom-select border border-default " required="" data-error-msg="Ruangan ini perlu dipilih." data-init-plugin="select2" onchange="checkAllRequirementSubmit();">
                       <option value='' hidden selected> Select </option>
                       <option value='SHAH ALAM'>SHAH ALAM</option>
                       <option value='PUTRAJAYA'>PUTRAJAYA</option>
                       <option value='KUALA LUMPUR'>KUALA LUMPUR</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="row m-0">
                        <label class="" for="selectrequired">
                            DURATION TYPE <span class="text-danger" >*</span>
                        </label>
                    </div>
                    <div class="row form-group m-0">
                        <div class="form-check ">
                            <input class="form-check-input " type="radio" name="isMonthly" id="inlineRadio1" value="1" checked>
                            <label class="form-check-label " for="inlineRadio1">MONTHLY</label>
                            </div>
                            <div class="form-check ml-2">
                            <input class="form-check-input " type="radio" name="isMonthly" id="inlineRadio2" value="0">
                            <label class="form-check-label " for="inlineRadio2">YEARLY</label>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="startYear"> START YEAR <span class="text-danger" >*</span></label>
                    <select id="startYear" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." onchange="checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="2020" >2020</option>
                        <option value="2021" >2021</option>
                        <option value="2022" >2022</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="startMonth"> START MONTH <span class="text-danger" >*</span></label>
                    <select id="startMonth" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." onchange="checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="endYear"> END YEAR <span class="text-danger" >*</span></label>
                    <select id="endYear" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." onchange="checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="endMonth"> END MONTH <span class="text-danger" >*</span></label>
                    <select id="endMonth" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." onchange="checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="facility_type">
                        FACILITY TYPE <span class="text-danger" >*</span>
                    </label>
                    <select id="facility_type" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." data-init-plugin="select2" onchange="changeFacilityType(this);checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="pipeline">Pipeline</option>
                        <option value="station">Station</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="selectrequired">
                        PIPELINE TYPE <span class="text-danger" >*</span>
                    </label>
                    <select id="pipelinetype" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." data-init-plugin="select2" onchange="checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="ALL">ALL</option>
                        <option value="TOTAL">TOTAL</option>
                        <option value="STEEL">STEEL</option>
                        <option value="PE">PE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="" for="selectrequired">
                        STATION TYPE <span class="text-danger" >*</span>
                    </label>
                    <select id="stationtype" class="select-normal full-width custom-select border border-default" required="" data-error-msg="Ruangan ini perlu dipilih." data-init-plugin="select2" onchange="checkAllRequirementSubmit();">
                        <option value="" hidden selected>Select</option>
                        <option value="ALL">ALL</option>
                        <option value="CITY">CITY</option>
                        <option value="ODORISER">ODORISER</option>
                        <option value="SERVICE">SERVICE</option>
                        <option value="DISTRICT">DISTRICT</option>
                        <option value="REGULATING">REGULATING</option>
                        <option value="COMMERCIAL">COMMERCIAL</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 d-flex flex-row align-items-end">
                <a id="resetSP" data-toggle="tooltip" title="" class="btn btn-default btn-lg" style="" type="button" onclick="" data-original-title="Tetapkan semula"><span style="color:#fff"> <i class="fas fa-undo text-danger" ></i></span></a>
                <button value="" class="btn btn-primary btn-cons from-left pull-right" id="btnsubmit" onclick="generateChart()">
                    <span>GENERATE</span>
                </button>
            </div>
        </div>

        <div class="mt-3">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

    $(function(){ //similar to $('document').ready()
        $('#stationtype').prop('disabled', true);
        $('#pipelinetype').prop('disabled', true);
        $('#btnsubmit').prop('disabled', true);
    });

    function changeRegion(elem){
        var region = $(elem).val();
        if(region == "CENTRAL"){
            $('#branch_office').empty();
            $('#branch_office').prop( "disabled", false );
            $('#branch_office').append("<option value='' hidden selected> Select </option>");
            $('#branch_office').append("<option value='SHAH ALAM'>SHAH ALAM</option>");
            $('#branch_office').append("<option value='PUTRAJAYA'>PUTRAJAYA</option>");
            $('#branch_office').append("<option value='KUALA LUMPUR'>KUALA LUMPUR</option>");
        }
        if(region == "EASTERN"){
            $('#branch_office').empty();
             $('#branch_office').prop( "disabled", false );
            $('#branch_office').append("<option value='' hidden selected> Select </option>");
            $('#branch_office').append("<option value='GEBENG'>GEBENG</option>");
        }
        if(region == "NORTHERN"){
            $('#branch_office').empty();
             $('#branch_office').prop( "disabled", false );
            $('#branch_office').append("<option value='' hidden selected> Select </option>");
            $('#branch_office').append("<option value='PRAI'>PRAI</option>");
            $('#branch_office').append("<option value='IPOH'>IPOH</option>");
            $('#branch_office').append("<option value='SERI MANJUNG'>SERI MANJUNG</option>");
        }
        if(region == "SOUTHERN"){
            $('#branch_office').empty();
             $('#branch_office').prop( "disabled", false );
            $('#branch_office').append("<option value='' hidden selected> Select </option>");
            $('#branch_office').append("<option value='PASIR GUDANG'>PASIR GUDANG</option>");
            $('#branch_office').append("<option value='AYER KEROH'>AYER KEROH</option>");
            $('#branch_office').append("<option value='KLUANG'>KLUANG</option>");
            $('#branch_office').append("<option value='SENAWANG'>SENAWANG</option>");
        }
    }

    function changeFacilityType(elem){
        var factype = $(elem).val();
        if(factype == ""){
           $('#stationtype').prop('disabled', true);
           $('#pipelinetype').prop('disabled', true);
        }
        if(factype == "pipeline"){
            $('#stationtype').prop('disabled', true);
            $('#pipelinetype').prop('disabled', false);
        }
        if(factype == "station"){
            $('#stationtype').prop('disabled', false);
            $('#pipelinetype').prop('disabled', true);
        }
    }

    function checkAllRequirementSubmit(){

        if(
            $('#branch_office').val() != '' &&
            $('#startMonth').val() != '' &&
            $('#endMonth').val() != '' &&
            $('#startYear').val() != '' &&
            $('#endYear').val() != '' &&
            $('#facility_type').val() != '' &&
            ($('#pipelinetype').val() != '' || $('#stationtype').val() != '')
        ){
            if(checkCorrectDate()){
                $('#btnsubmit').prop('disabled',false);
                return;
            }
        }
        $('#btnsubmit').prop('disabled',true);
    }

    function checkCorrectDate(){

        var startMonth = $('#startMonth').val() ;
        var endMonth= $('#endMonth').val() ;
        var startYear = $('#startYear').val() ;
        var endYear = $('#endYear').val() ;

        if(endYear > startYear){
            return true;
        }else if(endYear == startYear){
            if(endMonth > startMonth){
                return true;
            }
        }
        return false;
    }

    function generateChart(){

        var region = $('#region').val();
        var branch_office = $('#branch_office').val();
        var isMonthly = $('[name="isMonthly"]:checked').val();
        var tahunAkhir = $('#tahunAkhirSP').val();
        var startYear = $('#startYear').val();
        var startMonth = $('#startMonth').val();
        var endYear = $('#endYear').val();
        var endMonth = $('#endMonth').val();
        var facility_type = $('#facility_type').val();
        var value_type = facility_type == 'pipeline' ? $('#pipelinetype').val() : $('#stationtype').val();

        $.ajax({
            url: "{{ route('statistics.generate') }}",
            method: "POST",
            data : {
                region : region ,
                branch_office : branch_office ,
                isMonthly : isMonthly ,
                tahunAkhir : tahunAkhir ,
                startYear : startYear ,
                startMonth : startMonth ,
                endYear : endYear ,
                endMonth : endMonth ,
                facility_type : facility_type ,
                value_type : value_type ,
            },
            success: function(response) {
                console.log(response);
                chartCreator(response,'myChart');

            },
            error: function(response) {
                console.log(response);
            }
        });
    }



    var myChart;
    function chartCreator(datum,canvasName){

        config = datum.config;
        console.log(config);

        if(myChart != null){
            myChart.destroy();
        }
        $("#myChart").parent().height('450px')
        myChart = new Chart(
            document.getElementById(canvasName),
            config
        );
        $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
    }

</script>
@endsection
