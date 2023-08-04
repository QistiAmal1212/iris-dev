<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset(mix('vendors/js/ui/jquery.sticky.js')) }}"></script>
@yield('vendor-script')

<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

{{-- Form-Wizard All  --}}
<script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/unijaya/form-wizard-all.js')) }}"></script>

@if ($configData['blankPage'] === false)
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')

<!-- END: Page JS-->
<!-- BEGIN: Developer Code JS-->
@yield('developer-script')
@yield('script')
@stack('js')

<script>
    //Custom Initializer General FlatPickr (Datepicker)
    initializeFlatpickr = function() {
        $('.flatpickrDeklarasi').flatpickr({
            dateFormat: 'd/m/Y',
            allowInput: true
        });

        $('.flatpickr-y-m-d').flatpickr({
            dateFormat: 'Y-m-d',
            allowInput: true
        });

        $('.flatpickr').flatpickr({
            dateFormat: 'd/m/Y',
            allowInput: true
        });
        $('.flatpickrLimit').flatpickr({
            dateFormat: 'd/m/Y',
            maxDate: 'today',
            allowInput: true
        });
    }
    //End Custom Initializer General FlatPickr
    //Custom Initializer General FlatPickr (Datepicker)
    initializeDropify = function() {
        $('.dropify').dropify()
    }
    //End Custom Initializer General FlatPickr

    // $(function() is equivalent to $(document).ready()
    $(function() {
        initializeFlatpickr();
        initializeDropify();
    });

    //Default: Ajax Request

    // jQuery Validation Global Defaults
    if (typeof jQuery.validator === 'function') {
        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorPlacement: function(error, element) {
                if (
                    element.parent().hasClass('input-group') ||
                    element.hasClass('select2') ||
                    element.attr('type') === 'checkbox'
                ) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('form-check-input')) {
                    error.insertAfter(element.parent().siblings(':last'));
                } else {
                    error.insertAfter(element);
                }

                if (element.parent().hasClass('input-group')) {
            element.parent().addClass('is-invalid');
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('error');
                if ($(element).parent().hasClass('input-group')) {
                    $(element).parent().addClass('is-invalid');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('error');
                if ($(element).parent().hasClass('input-group')) {
                    $(element).parent().removeClass('is-invalid');
                }
            }
        });
    }
    //setup ajax error handling
    $.ajaxSetup({
        error: function(data) {
            var data = data.responseJSON;
            // console.log(data);
            if (data.errors === undefined) {
                Swal.fire(data.title, data.detail, 'error');
            } else {
                $('#bahagianErrorBox').html(""); //clear error message
                $('#bahagianErrorBox').show(); //show
                let errorsHtml = "<ul>";
                $.each(data.errors, function(key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                errorsHtml += '</ul>';
                $('#bahagianErrorBox').html(errorsHtml); //put error message into box
                $('html, body').animate({
                    scrollTop: 0
                }, 'fast'); // scroll to the top
            }
        }
    });
    //End setup ajax error handling
    //Show SweetAlert Confirmation Window
    confirmBeforeSubmit = function(elem) {
        event.preventDefault();
        Swal.fire({
            title: 'Confirm action?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                generalFormSubmit(elem);
            } else {
                return false;
            }
        });
    }
    //End Show SweetAlert Confirmation Window

    // Custom Checking Required Form Field (Whole Tab) (Trigger by next button)
    function checkFormRequire(formTarget,btn) {
        var required_tags = $('.required-tag').children();
        $.each(required_tags, function(i, required_tag) {
            if (required_tag.innerHTML == '{{ __("msg.form.required") }}') {
                required_tag.parentNode.remove();
                // delete all required-tag where the message is same as {{ __("msg.form.required") }} (This field is required / Ruangan ini perlu diisi)
            }
        });
        var formTarget = checkForm(formTarget);
        addFormRequiredTag(formTarget);
        addTableRequiredTag(formTarget);
        checkProceed(formTarget,btn)
    }

    // Auto save

    function setupAutoSave(formId) {
        var field = $('#' + formId)[0].querySelectorAll('input, textarea, select');
        field.forEach((el) => el.addEventListener('change', autoSaveApplication));
    }

    function autoSaveApplication(e) {
        // Get URL from Form tag
        let url = e.target.closest('form').getAttribute('data-autosave-url');
        var formId = e.target.closest('form').getAttribute('id');
        var fieldId = e.target.getAttribute('id');

        // If URL not found then try again to find it from input field.
        if (!url) {
            url = e.target.getAttribute('data-autosave-url');
        }
        let form = new FormData();

        form.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        // if not input[type='file']
        if (e.target.getAttribute('type') != 'file') { // input type other than file

            form.append(e.target.getAttribute('name'), e.target.value);

        } else { // input type is file

            var file = document.getElementsByName(e.target.getAttribute('name'))[0];

            if (file.files.length > 0) {
                for (var i = 0; i < file.files.length; i++) {
                    var name = file.files[i].name;
                    form.append(file.getAttribute('name'), file.files[i]);
                }
            }
        }

        fetch(url, {
            method: 'POST',
            body: form,
            contentType: false,
            processData: false,
        }).then(function(response) {
            response.json().then(data => {
                if (data.status == 'success') {
                    if (e.target.getAttribute('type') == 'file') {
                        reloadDiv(formId, fieldId);
                    }
                    checkRequiredTag(formId, fieldId);
                } else if (data.status == 'error') {
                    checkRequiredTag(formId, fieldId, data.detail);
                }
            });

        });
    }
    // End Auto save

    //To use this, please refer Report Example or Module blade page
    generalFormSubmit = function(elem) {
        const event = new Event("event");
        var form = $(elem).closest('form');
        var refreshFunctionName = form.attr('data-refreshFunctionName');
        var refreshFunctionNameIfSuccess = form.attr('data-refreshFunctionNameIfSuccess');
        var refreshFunctionURL = form.attr('data-refreshFunctionURL');
        var refreshFunctionDivId = form.attr('data-refreshFunctionDivId');
        var reloadPage = form.attr('data-reloadPage');
        var message = form.attr('data-swal');

        event.preventDefault();
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData($(form)[0]),
            async: true,
            contentType: false,
            processData: false,
            success: function(data) {
                event.preventDefault();

                if (message != null) {
                    if (message != 'false') {
                        swalSuccessAfterSubmit('{{ __("msg.information") }}', message)
                            .then((result) => {
                                // showing swal then proceed
                                proceed();
                            })
                    } else {
                        // without showing prompt then proceed
                        proceed();
                    }
                } else {
                    // showing prompt then proceed
                    toastr.success(data.title ?? "Saved");
                    proceed();
                }

                function proceed() {

                    //If data-reloadPage exists, then reload the page
                    if (reloadPage) {
                        if (reloadPage == "true") {
                            location.reload();
                            return false;
                        }
                    }

                    //If redirect page exists, then redirect to the page
                    if (data.redirectRoute ?? false) {
                        window.location.href = data.redirectRoute;
                        return false;
                    }

                    //You either can put your refresh function inside your blade page
                    //or put the div id directly to load with the url
                    if (refreshFunctionDivId) {
                        if (refreshFunctionURL) {
                            $('#' + refreshFunctionDivId).load(refreshFunctionURL, function() {

                                if (refreshFunctionName) {
                                    executeFunctionByName(refreshFunctionName);
                                }
                                if (refreshFunctionNameIfSuccess) {
                                    executeFunctionByName(refreshFunctionNameIfSuccess);
                                }

                            });
                        }
                    } else {

                        if (refreshFunctionName) {
                            executeFunctionByName(refreshFunctionName);
                        }
                        if (refreshFunctionNameIfSuccess) {
                            executeFunctionByName(refreshFunctionNameIfSuccess);
                        }
                    }
                }
                return false;

            },
            error: function(data) {
                var data = data.responseJSON;
                // console.log(data);
                if (data.errors === undefined) {
                    var message = data.detail.replace(/\(and \d+ more error(?:s)?\)/, '');
                    Swal.fire(data.title, message, 'error');
                } else { // original
                    $('#bahagianErrorBox').html(""); //clear error message
                    $('#bahagianErrorBox').show(); //show
                    let errorsHtml = "<ul>";
                    $.each(data.errors, function(key, value) {
                        errorsHtml += '<li>' + value + '</li>';
                    });
                    errorsHtml += '</ul>';
                    $('#bahagianErrorBox').html(errorsHtml); //put error message into box
                    $('html, body').animate({
                        scrollTop: 0
                    }, 'fast'); // scroll to the top
                }

                //You either can put your refresh function inside your blade page
                //or put the div id directly to load with the url
                if (refreshFunctionDivId) {
                    if (refreshFunctionURL) {
                        $('#' + refreshFunctionDivId).load(refreshFunctionURL, function() {

                            if (refreshFunctionName) {
                                executeFunctionByName(refreshFunctionName);
                            }

                        });
                    }
                } else {

                    if (refreshFunctionName) {
                        executeFunctionByName(refreshFunctionName);
                    }
                }
                return false;
            },
        });
    }

    getModalContent = (elem) => {
        $.get(elem.dataset.action, function(response) {

            $("#modal-div").html(response);
            $("#baseAjaxModalContent").modal("show");
            initializeFlatpickr();
            initializeDropify();
        });
    }

    closeModalContent = () => {
        $("#baseAjaxModalContent").modal("hide");
    }
    //End Default: Ajax Request

    // Swal message pre-setup
    // Swal message after submit (example : application successfully submitted)
    swalSuccessAfterSubmit = function(title, message) {
        return Swal.fire({
            text: message,
            title: title,
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    }

    swalError = function(title, message) {
        return Swal.fire({
            text: message,
            title: title,
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    }
    // End Swal message pre-setup

    // Prototype Purposes
    fakeSuccess = function(title, text) {
        Swal.fire({
            title: title,
            text: text,
            icon: 'success',
            confirmButtonText: 'OK',
        }).then((result) => {
            // console.log(result)
            if (result.isConfirmed) {
                // location.reload();
            } else {
                return false;
            }

        });
    }
    // End Prototype Purposes
</script>

<!-- END: Developer Code JS-->
