@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('report_helpdesk.list', $reportHelpdesk->project_id) }}">Helpdesk Report</a>
    </li>
    <li class="breadcrumb-item"> Form</li>
@endsection

@section('header')
    {{ $reportHelpdesk->title }}
@endsection

@section('content')
    <style>
        .info-box .progress {
            height: 10px;
        }

        .progress-bar {
            background-color: white !important;
        }

        .card-title {
            margin-bottom: 0px;
        }

        .card-header .breadcrumb {
            background-color: transparent;
            margin-bottom: 0;
            padding: 0.0rem 1rem
        }


        .form-group{
            margin-bottom:1rem;
        }
        .file-hidden {
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .tableWrapper {
            display: block;
            overflow-x: scroll;
        }

        .tableHelpdeskIssue th:not(:nth-child(1)),
        .tableHelpdeskIssue td:not(:nth-child(1)) {
            min-width: 100px;
        }
        
        .chip-input {
            border: 1px solid #d8d6de00!important;
        }
    </style>
    <div class="row">
        <div class="col-md-12 d-flex flex-row">
            {{-- This is error message box, retrieved by ajax call after submit form --}}
            <div class="col-5">
                <div class="alert alert-danger" id="bahagianErrorBox" style="display: none;">
                </div>
            </div>
            {{-- End error message box --}}
            <div class="col"></div>
            <div class="col-4">
            </div>
        </div>
        <div class="col-md-12">

            <!-- /.info-box -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="text-uppercase nav-link active" id="formA-tab" data-bs-toggle="tab" href="#formA" aria-controls="formA" role="tab" aria-selected="true">{{ __('msg.information') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="text-uppercase nav-link" id="formB-tab" data-bs-toggle="tab" href="#formB" aria-controls="formB" role="tab" aria-selected="true">{{ __('msg.declaration') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="text-uppercase nav-link" id="formC-tab" data-bs-toggle="tab" href="#formC" aria-controls="formC" role="tab" aria-selected="true">EMAIL</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="formA" role="tabpanel" aria-labelledby="formA-tab">
                    @include('report_helpdesk.borang.tab1')
                </div>
                <div class="tab-pane fade" id="formB" role="tabpanel" aria-labelledby="formB-tab">
                    @include('report_helpdesk.borang.tab2')
                </div>
                <div class="tab-pane fade" id="formC" role="tabpanel" aria-labelledby="formC-tab">
                    @include('report_helpdesk.borang.tab3')
                </div>
            </div>
        </div>
    </div>

    <div id="modal-div"></div>
@endsection

@section('script')
    <script>
        $(function() {
            // Start initiliaze dropify (input type file tapi boleh tunjuk gambar)
            $('.dropify').dropify({
                messages: {
                    'default': '',
                    'replace': '',
                    'remove': 'Remove',
                    'error': ''
                },
            });
            // End initiliaze dropify (input type file tapi boleh tunjuk gambar)

            //AJAX + Validate
            //Default Jquery Validator
            $.validator.setDefaults({
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });

            //setup ajax error handling
            $.ajaxSetup({
                error: function(data) {
                    var errors = data.responseJSON;
                    if (errors) {

                        $('#bahagianErrorBox').html(""); //clear error message
                        $('#bahagianErrorBox').show(); //show
                        errorsHtml = "<ul><li> " + errors.detail.toUpperCase() + "</li></ul>";
                        $('#bahagianErrorBox').html(errorsHtml); //put error message into box
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'fast'); // scroll to the top

                    }
                }
            });

        });
    </script>

    //Bahagian Tab Maklumat Isu
    <script>
        $(function() {

            //Used for initialize flatpickr
            $('#date_issued').flatpickr({
                dateFormat: 'd/m/Y H:i',
                allowInput: true,
                enableTime: true,
                time_24hr: true,
                enable: [{
                    from: "{{ $reportHelpdesk->start_date->startOfMonth()->format('d/m/Y H:i') }}",
                    to: "{{ $reportHelpdesk->end_date->lastOfMonth()->format('d/m/Y H:i') }}"
                }],
                maxDate: "{{ $reportHelpdesk->end_date->lastOfMonth()->format('d/m/Y H:i') }}",
            });

            // Form Tambah Issue
            $('#addIssueForm').validate({

                messages: {
                    "master_medium_id": {
                        required: "Ruangan ini diperlukan",
                    },
                    "status": {
                        required: "Ruangan ini diperlukan",
                    },
                    "date_issued": {
                        required: "Ruangan ini diperlukan",
                    },
                    "explanation": {
                        required: "Ruangan ini diperlukan",
                    },
                },

                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData($(form)[0]),
                        async: true,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            Swal.fire(data.title, "", data.status);
                            event.preventDefault();
                            refreshListViewIssueContainer();
                        },
                    });
                }
            });
            //End Form Tambah Isu
        });

        //Function Refresh list Issue
        refreshListViewIssueContainer = function() {
            $.get(`{{ route('report_helpdesk.refreshListViewIssueContainer', $reportHelpdesk) }}`, function(data) {
                document.getElementById('tableListIssueContainer').innerHTML = data;
            });
        }
        //End Function Refresh list Issue

        //Function View Issue
        viewIssueFunction = function(button) {

            var url = $(button).data('url');

            $.ajax({
                url: url,
                method: "GET",
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    var issue = data.issue;
                    $('#addIssueForm #issue_id').val(issue.id);
                    $('#addIssueForm #api_id').val(issue.api_id);
                    $('#addIssueForm #report_helpdesk_id').val(issue.report_helpdesk_id);
                    $('#addIssueForm #title').append('<option value="' + issue.title +
                        '" selected hidden>' + issue.title + '</option>');
                    $('#addIssueForm #title').val(issue.title);
                    $('#addIssueForm #master_medium_id').val(issue.master_medium_id);
                    $('#addIssueForm #explanation').val(issue.explanation);
                    $('#addIssueForm #category').val(issue.category);
                    $('#addIssueForm #date_issued').val(issue.date_issued_updated);
                    $('#addIssueForm #status').val(issue.status);
                    $('#addIssueForm #tracking_id').val(issue.tracking_id);
                    $('#addIssueForm #nama_pengguna').val(issue.nama_pengguna);
                    $('#addIssueForm #issue_group').val(issue.issue_group);
                    $('#addIssueForm #date_completed').val(issue.date_completed_updated);
                    $('#addIssueForm #date_response').val(issue.date_response_updated);
                    $('#addIssueForm #action').val(issue.action);

                    $('#addIssueForm #buttonSave').fadeOut(500, function() {
                        $(this).text("{{ __('msg.update') }}").fadeIn(500);
                    });
                },
                error: function(data) {
                    var data = data.responseJSON;
                    Swal.fire(data.title, data.detail, data.status);
                }
            });
        }
        //End Function View Issue

        //Function Deleting Issues
        deleteIssueFunction = function(button) {

            var formId = $(button).data('form-id');
            var form = $('#' + formId);

            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData($(form)[0]),
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {
                    Swal.fire(data.title, "", data.status);
                    event.preventDefault();
                    refreshListViewIssueContainer();
                },
                error: function(data) {
                    var data = data.responseJSON;
                    Swal.fire(data.title, data.detail, data.status);
                }
            });
        }
        //End Function Deleting Issues

        //Function for adding value inside select option
        checkNote = function() {
            var titleInput = $('#addIssueForm #title');
            var otherTitle = $('#addIssueForm #otherTitle');
            var addNoteTitle = $('#addIssueForm #addNoteTitle');

            if (titleInput.val() == 'OTHERS') {
                otherTitle.show();
                addNoteTitle.show();
            } else {
                otherTitle.hide();
                addNoteTitle.hide();
            }
        }

        addValue = function() {
            var titleInput = $('#addIssueForm #title');
            var otherTitle = $('#addIssueForm #otherTitle');
            var addNoteTitle = $('#addIssueForm #addNoteTitle');

            titleInput.append('<option value="' + otherTitle.val() + '" selected>' + otherTitle.val() + '</option>');
            titleInput.val(otherTitle.val());

            otherTitle.hide();
            addNoteTitle.hide();
        }
        //End Function for adding value inside select option

        //Update Button Save Name from Kemaskini to Simpan
        updateButtonSaveName = function() {
            $('#addIssueForm #buttonSave').fadeOut(500, function() {
                $(this).text("{{ __('msg.save') }}").fadeIn(500);
            });
        }
        //End Update Button Save Name from Kemaskini to Simpan

        //Function Button UPDATE API - Retrieve Data Manual From API
        RetrieveDataManualFromAPI = function(project_id, month, year) {

            let url =
                "{{ route('api_helpdesk.retrieve', ['replaceThisWithProjectID', 'replaceThisWithMonth', 'replaceThisWithYear']) }}";
            url = url.replace('replaceThisWithProjectID', project_id);
            url = url.replace('replaceThisWithMonth', month);
            url = url.replace('replaceThisWithYear', year);

            $('#updateAPIButton').text('UPDATING...');
            $('#updateAPIButton').addClass('blink_50_fast');

            $.ajax({
                url: url,
                method: "GET",
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {

                    $('#updateAPIButton').text('SUCCESS');
                    $('#updateAPIButton').removeClass('blink_50_fast');

                    toastr.success(data.detail);

                    setTimeout(() => {
                        location_reload();
                    }, 1000);

                },
                error: function(data) {
                    var data = data.responseJSON;
                    toastr.error(data.detail);

                    $('#updateAPIButton').text('UPDATE API');
                    $('#updateAPIButton').removeClass('blink_50_fast');

                }
            });
        }
        //End Function Button UPDATE API - Retrieve Data Manual From API

        //Function Button Autofill From API
        autofillFromAPI = function(elem) {

            var report_helpdesk_id = $(elem).attr('data-report-helpdesk-id');
            let url = "{{ route('report_helpdesk.autofillFromAPI', 'replaceThisWithID') }}";
            url = url.replace('replaceThisWithID', report_helpdesk_id);

            $(elem).text('UPDATING...');
            $(elem).addClass('blink_50_fast');

            $.ajax({
                url: url,
                method: "POST",
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {

                    $(elem).text('SUCCESS');
                    $(elem).removeClass('blink_50_fast');

                    toastr.success(data.detail);

                    refreshListViewIssueContainer();

                },
                error: function(data) {
                    var data = data.responseJSON;
                    toastr.error(data.detail);

                    $(elem).text('AutoFill From API');
                    $(elem).removeClass('blink_50_fast');

                }
            });
        }
        //End Function Button Autofill From API

        //Function to retrieve data from API_Helpdesk_Issue to fill inside box
        retrieveDataFromAPI = function(elem) {
            var selectElem = $("#addIssueForm #" + elem.id + " :selected");
            if (selectElem.attr('data-isApi')) {

                let url = "{{ route('report_helpdesk.getDataAPI_Issues', 'replaceThisWithID') }}";
                url = url.replace('replaceThisWithID', selectElem.val());

                $.ajax({
                    url: url,
                    method: "GET",
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                        var issue = data.issue;
                        $('#addIssueForm #issue_id').val("");
                        $('#addIssueForm #api_id').val("");
                        $('#addIssueForm #report_helpdesk_id').val(issue.report_helpdesk_id);
                        $('#addIssueForm #title').append('<option value="' + issue.title +
                            '" selected hidden>' + issue.title + '</option>');
                        $('#addIssueForm #title').val(issue.title);
                        $('#addIssueForm #master_medium_id').val(issue.medium ?? 1);
                        $('#addIssueForm #explanation').val(issue.explanation);
                        $('#addIssueForm #category').val(issue.category);
                        $('#addIssueForm #date_issued').val(issue.date_issued_updated);
                        $('#addIssueForm #tracking_id').val(issue.tracking_id);
                        $('#addIssueForm #nama_pengguna').val(issue.nama_pengguna);
                        $('#addIssueForm #issue_group').val(issue.issue_group);
                        $('#addIssueForm #date_completed').val(issue.date_completed_updated);
                        $('#addIssueForm #date_response').val(issue.date_response_updated);
                        $('#addIssueForm #action').val(issue.action);
                        updateButtonSaveName();
                    },
                    error: function(data) {
                        var data = data.responseJSON;
                        Swal.fire(data.title, data.detail, data.status);
                    }
                });
            }
        }
        //End Function to retrieve data from API_Helpdesk_Issue

        // To load Helpdesk Report PDF
        generatePDF = function(elem) {
            var report_helpdesk_id = $(elem).attr('data-report-helpdesk-id');
            let url = "{{ route('report_helpdesk.loadPDF', 'replaceThisWithID') }}";
            url = url.replace('replaceThisWithID', report_helpdesk_id);
            event.preventDefault();
            $("#modal-div").load(url);
        };
        // End load Helpdesk Report PDF
    </script>
    //End Bahagian Tab Maklumat Isu

    //Bahagian Tab Deklarasi
    <script>
        $(function() {

            //Used for initialize flatpickr
            $('#tarikh_disahkan,#tarikh_disediakan').flatpickr({
                dateFormat: 'd/m/Y',
                allowInput: true
            });

            //Form Update Deklarasi
            @foreach ($allOfReport as $eachReport)
                $('#deklarasiForm_{{ $eachReport->id }}').validate({

                    submitHandler: function(form) {
                        $.ajax({
                            url: $(form).attr('action'),
                            method: $(form).attr('method'),
                            data: new FormData($(form)[0]),
                            async: true,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                Swal.fire(data.title, "", data.status);
                                setTimeout(() => {
                                    location.reload()
                                }, 1000);
                            },
                            error: function(data) {
                                var data = data.responseJSON;
                                Swal.fire(data.title, data.detail, data.status);
                            }
                        });
                    }
                });
            @endforeach

            //End Form Update Deklarasi
        });
    </script>
    //End Bahagian Tab Deklarasi

    //Bahagian Email
    <script>
        $(function() {


            //Form Add Penerima Email
            // $('#addPenerimaForm').validate({
            //     messages: {
            //         "nama_penerima": {
            //             required: "Ruangan ini diperlukan",
            //         },
            //         "emel_penerima": {
            //             required: "Ruangan ini diperlukan",
            //         },
            //     },

            //     submitHandler: function(form){
            //         $.ajax({
            //             url: $(form).attr('action'),
            //             method: $(form).attr('method'),
            //             data: new FormData($(form)[0]),
            //             async: true,
            //             contentType: false,
            //             processData: false,
            //             success: function(data) {
            //                 Swal.fire(data.title, "", data.status);
            //                 event.preventDefault();
            //             },
            //         });
            //     }
            // });
            //End Form Add Penerima Email


            chipClickHandler = function(id, elem) {

                var fd = new FormData();
                fd.append("email_recipient_id", id);
                fd.append("_method", "delete");
                $.ajax({
                    url: "{{ route('email.deleteEmail') }}",
                    method: "POST",
                    data: fd,
                    async: true,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#chips_to_"+elem).load(" #chips_to_"+elem);
                        $("#chips_cc_"+elem).load(" #chips_cc_"+elem);
                        $("#chips_bcc_"+elem).load(" #chips_bcc_"+elem);

                    },
                    error: function(data) {
                        var data = data.responseJSON;
                        toastr.error(data.message);
                    }
                });
            };

            @foreach ($allOfReport as $eachReport)
                var inputTo{{ $eachReport->id }} = document.querySelector("#email_to_{{ $eachReport->id }}");
                var chipsTo{{ $eachReport->id }} = document.querySelector("#chips_to_{{ $eachReport->id }}");
                document.querySelector("#form-field-to_{{ $eachReport->id }}")
                    .addEventListener('click', () => {
                        inputTo{{ $eachReport->id }}.style.display = 'block';
                        inputTo{{ $eachReport->id }}.focus();
                    });

                //When press enter, submit data and show the email
                inputTo{{ $eachReport->id }}.addEventListener('keypress', function(event) {
                    if (event.which === 13) {
                        event.preventDefault();

                        var fd = new FormData();
                        fd.append("entity_type", inputTo{{ $eachReport->id }}.getAttribute(
                            'data-entity-type'));
                        fd.append("entity_id", inputTo{{ $eachReport->id }}.getAttribute(
                        'data-entity-id'));
                        fd.append("email_type", inputTo{{ $eachReport->id }}.getAttribute(
                            'data-email-type'));
                        fd.append("email", inputTo{{ $eachReport->id }}.value);

                        $.ajax({
                            url: "{{ route('email.addEmail') }}",
                            method: "POST",
                            data: fd,
                            async: true,
                            contentType: false,
                            processData: false,
                            success: function(data) {

                                toastr.success('Berjaya');
                                $('#chips_to_'+{{$eachReport->id}}).load(" #chips_to_"+{{$eachReport->id}});
                                //Clear div chips and readded new email

                                //End Clear div chips and readded new email
                            },
                            error: function(data) {
                                var data = data.responseJSON;
                                toastr.error(data.message);
                            }
                        });

                        inputTo{{ $eachReport->id }}.value = '';
                        inputTo{{ $eachReport->id }}.focus();

                    }
                });
            @endforeach

            @foreach ($allOfReport as $eachReport)
                var inputCc{{ $eachReport->id }} = document.querySelector("#email_cc_{{ $eachReport->id }}");
                var chipsCc{{ $eachReport->id }} = document.querySelector("#chips_cc_{{ $eachReport->id }}");
                document.querySelector("#form-field-cc_{{ $eachReport->id }}")
                    .addEventListener('click', () => {
                        inputCc{{ $eachReport->id }}.style.display = 'block';
                        inputCc{{ $eachReport->id }}.focus();
                    });

                //When press enter, submit data and show the email
                inputCc{{ $eachReport->id }}.addEventListener('keypress', function(event) {
                    if (event.which === 13) {
                        event.preventDefault();

                        var fd = new FormData();
                        fd.append("entity_type", inputCc{{ $eachReport->id }}.getAttribute(
                            'data-entity-type'));
                        fd.append("entity_id", inputCc{{ $eachReport->id }}.getAttribute(
                        'data-entity-id'));
                        fd.append("email_type", inputCc{{ $eachReport->id }}.getAttribute(
                            'data-email-type'));
                        fd.append("email", inputCc{{ $eachReport->id }}.value);

                        $.ajax({
                            url: "{{ route('email.addEmail') }}",
                            method: "POST",
                            data: fd,
                            async: true,
                            contentType: false,
                            processData: false,
                            success: function(data) {

                                toastr.success('Berjaya');
                                $('#chips_cc_'+{{$eachReport->id}}).load(" #chips_cc_"+{{$eachReport->id}});
                                //Clear div chips and readded new email
                                //End Clear div chips and readded new email
                            },
                            error: function(data) {
                                var data = data.responseJSON;
                                toastr.error(data.message);
                            }
                        });



                        inputCc{{ $eachReport->id }}.value = '';
                        inputCc{{ $eachReport->id }}.focus();

                    }
                });
            @endforeach

            @foreach ($allOfReport as $eachReport)
                var inputBcc{{ $eachReport->id }} = document.querySelector("#email_bcc_{{ $eachReport->id }}");
                var chipsBcc{{ $eachReport->id }} = document.querySelector("#chips_bcc_{{ $eachReport->id }}");
                document.querySelector("#form-field-bcc_{{ $eachReport->id }}")
                    .addEventListener('click', () => {
                        inputBcc{{ $eachReport->id }}.style.display = 'block';
                        inputBcc{{ $eachReport->id }}.focus();
                    });

                //When press enter, submit data and show the email
                inputBcc{{ $eachReport->id }}.addEventListener('keypress', function(event) {
                    if (event.which === 13) {
                        event.preventDefault();

                        var fd = new FormData();
                        fd.append("entity_type", inputBcc{{ $eachReport->id }}.getAttribute(
                            'data-entity-type'));
                        fd.append("entity_id", inputBcc{{ $eachReport->id }}.getAttribute(
                            'data-entity-id'));
                        fd.append("email_type", inputBcc{{ $eachReport->id }}.getAttribute(
                            'data-email-type'));
                        fd.append("email", inputBcc{{ $eachReport->id }}.value);

                        $.ajax({
                            url: "{{ route('email.addEmail') }}",
                            method: "POST",
                            data: fd,
                            async: true,
                            contentType: false,
                            processData: false,
                            success: function(data) {

                                toastr.success('Berjaya');
                                $('#chips_bcc_'+{{$eachReport->id}}).load(" #chips_bcc_"+{{$eachReport->id}});
                                //Clear div chips and readded new email

                                //End Clear div chips and readded new email
                            },
                            error: function(data) {
                                var data = data.responseJSON;
                                toastr.error(data.message);
                            }
                        });



                        inputBcc{{ $eachReport->id }}.value = '';
                        inputBcc{{ $eachReport->id }}.focus();

                    }
                });
            @endforeach


        });



        //Function Save Title
        saveTitle = function(action) {

            var report_helpdesk_id = $('#report_helpdesk_id').val();
            var title = $('#reportTitle').val();
            var fd = new FormData();
            fd.append("id", report_helpdesk_id);
            fd.append("title", title);
            fd.append("action", action);

            $.ajax({
                url: "{{ route('report_helpdesk.updateTitle') }}",
                method: "POST",
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    Swal.fire(data.title, "", data.status);
                    event.preventDefault();
                    $("#card-header-title").text(data.reportTitle);
                    $("#reportTitle").val(data.reportTitle);
                },
                error: function(data) {
                    var data = data.responseJSON;
                    Swal.fire(data.title, data.detail, data.status);
                }
            });
        };
        //End Function Save Title

        sendEmail = function(elem) {

            var reportHelpdeskID = $(elem).attr('data-report-helpdesk-id');
            let url = "{{ route('report_helpdesk.sendEmail', 'replaceThisWithID') }}";
            url = url.replace('replaceThisWithID', reportHelpdeskID);

            $.ajax({
                url: url,
                method: "GET",
                async: true,
                contentType: false,
                processData: false,
                success: function(data) {

                    toastr.success('Berjaya');

                },
                error: function(data) {
                    var data = data.responseJSON;
                    Swal.fire(data.title, data.detail, data.status);
                }
            });
        }

        //Function Refresh list Issue
        reloadEmailTab = function(entity_id) {

            let url = "{{ route('report_helpdesk.reloadEmailTab', 'replaceThisWithID') }}";
            url = url.replace('replaceThisWithID', entity_id);
            $.get(url, function(data) {
                document.getElementById('weekEmail' + entity_id).innerHTML = data;
            });
        }
        //End Function Refresh list Issue
    </script>
    //End Bahagian Email
@endsection
