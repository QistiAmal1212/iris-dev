@extends('layouts.app')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
@endsection

@section('content')
    <style>
        .bs-stepper-header {
            width: 22% !important;
        }

        .bs-stepper-content {
            width: 78% !important;
        }
    </style>

    <div class="col-md-12" id="maintab">
        <ul class="nav nav-pills nav-justified pt-2" role="tablist">
                <li onclick="checkSecCompletionStatus()" class="nav-item" role="presentation">
                    <a class="text-uppercase nav-link active" id="tab1-tab" data-bs-toggle="tab" href="#tab1"
                        aria-controls="tab1" role="tab" aria-selected="true"><B>Section A: <i
                                class="fa-solid fa-circle-check text-success d-inline-block position-absolute section-a-tick-icon section-tick-icon d-none"></i></B><BR />
                        Required Tag Form</a>
                </li>
        </ul>

        <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
                    @include('mylab.sectionA.index')
                </div>
        </div>
    </div>

@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    <script>

        $(function() {
            setupAutoSave('saveseksyenA_A1'); // autosave setup (remember form also need to add data-autosave-url="ROUTE INFORMATION")
            Identification();
            showInsertion1();
            Recommendation();
        })


        // IC Or passport dropdown 1
        Identification = function() {
            if ($("#saveseksyenA_B1 #identification").val() == '1') {
                $("#saveseksyenA_B1 #divIdentificationIC").show();
                $("#saveseksyenA_B1 #divIdentificationPassport").hide();
            } else if ($("#saveseksyenA_B1 #identification").val() == '2') {
                $("#saveseksyenA_B1 #divIdentificationIC").hide();
                $("#saveseksyenA_B1 #divIdentificationPassport").show();
            } else if ($("#saveseksyenA_B1 #identification").val() == '') {
                $("#saveseksyenA_B1 #divIdentificationIC").hide();
                $("#saveseksyenA_B1 #divIdentificationPassport").hide();
            }
        }

        // show extra insertion
        showInsertion1 = function() {
            if ($("#saveseksyenB_B3 #ngo_kolaborator").val() == '21') {
                $("#saveseksyenB_B3 #divOthers").show();
            } else {
                $("#saveseksyenB_B3 #divOthers").hide();
            }
        }

        //Recommendation VC dropdown
        Recommendation = function() {
            if ($("#saveseksyenE_D1 #recommendation").val() == 'yes') {
                $("#saveseksyenE_D2 #divRecommend").show();
                $("#saveseksyenE_D2 #divNotRecommend").hide();
            } else if ($("#saveseksyenE_D1 #recommendation").val() == 'no') {
                $("#saveseksyenE_D2 #divRecommend").hide();
                $("#saveseksyenE_D2 #divNotRecommend").show();
            } else if ($("#saveseksyenE_D1 #recommendation").val() == '') {
                $("#saveseksyenE_D2 #divRecommend").hide();
                $("#saveseksyenE_D2 #divNotRecommend").hide();
            }
        }
    </script>

    <script>
        /*
         * Belongs to Section completion(tick) status
         */
        window.addEventListener('load', (event) => {
            checkSecCompletionStatus(true);
        });

        async function checkSecCompletionStatus(isOnload = false) {
            // wait 1.5sec
            if (!isOnload) {
                await new Promise(resolve => setTimeout(resolve, 1500));
            }

            // fetch status
            let res = await fetch(
                '{{ route('mylab.application.sectionsStatus') }}?id={{ $mylab_application->id }}')
            let json = await res.json();

            // hide all tick icon
            document.querySelectorAll('.section-tick-icon').forEach(el => {
                el.classList.add('d-none');
            });

            // now show only those icons, are completed.
            for (const key in json) {
                if (json[key]) {
                    document.getElementsByClassName('section-' + key + '-tick-icon')[0].classList.remove('d-none');
                }
            }
        }
    </script>
@endsection
