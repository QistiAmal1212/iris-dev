/*=========================================================================================
  File Name: custom.js
  Description: Created by Unijaya Quickstart team to maintain the old way of loading js.

  ----------------------------------------------------------------------------------------
    Do npm install and put require inside here. settle
==========================================================================================*/

try {

    window.$ = window.jQuery = require('jquery');
    //window.$ = $.extend(require('jquery-ui'));
    window.Swal = require('sweetalert2');
    window.toastr = require('toastr');
    window.validate = require('jquery-validation');
    window.flatpickr = require("flatpickr");
    window.dragula = require('dragula');
    window.moment = require('moment');
    window.numeral = require('numeral');


    // require('select2');
    require('switchery');
    require('dropify');
    require('summernote');
    require('summernote/dist/summernote.css');
    require('summernote/dist/summernote.js');

    /*-- Datatables Jquery with all extension --*/
    window.JSZip = require('jszip');
    require('datatables.net-bs5');
    require('datatables.net-buttons/js/dataTables.buttons');
    require('datatables.net-buttons/js/buttons.flash');
    require('datatables.net-buttons/js/buttons.html5');
    require('datatables.net-buttons/js/buttons.print');
    require('datatables.net-buttons/js/buttons.colVis');
    require('datatables.net-autofill');
    require('datatables.net-colreorder');
    require('datatables.net-datetime');
    require('datatables.net-fixedcolumns');
    require('datatables.net-fixedheader');
    require('datatables.net-keytable');
    require('datatables.net-rowgroup');
    require('datatables.net-rowreorder');
    require('datatables.net-scroller');
    require('datatables.net-searchbuilder');
    require('datatables.net-searchpanes');
    require('datatables.net-select');
    require('datatables.net-staterestore');
    window.pdfMake = require('pdfmake/build/pdfmake');
    window.pdfFonts = require('pdfmake/build/vfs_fonts');
    pdfMake.vfs = pdfFonts.pdfMake.vfs;
    /*-- End Datatables Jquery with all extension --*/

} catch (e) { }

// Handle jquery ajax header
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Only allowed input of numbers (even copy paste), insert this inside input
// oninput="onlyNumberOnInputText(this)"
window.onlyNumberOnInputText = function (input) {
    let value = input.value;
    let numbers = value.replace(/[^0-9]/g, "");
    input.value = numbers;
}

//Use this function to reset form
window.resetForm = function (element) {
    $(element).closest('form').trigger('reset');
}

// Add or Remove Loader. Just call them inside your javascript to looks like loading
// addLoader()
window.addLoader = function(){
    $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
}
// removeLoader()
window.removeLoader = function(){
    $( "#loadingDiv" ).fadeOut(500, function() {
        // fadeOut complete. Remove the loading div
        $( "#loadingDiv" ).remove(); //makes page more lightweight
    });
}

// Execute on page ready
$(document).ready(function () {
    // initalize tooltip
    $('[data-toggle="tooltip"]').tooltip();

    var Inputmask = require('inputmask');

    // select2
    // $(".select2").select2();

    // toastr config
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $(".confirmClickLink").on('click', function(e){
        e.preventDefault();
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
                window.location = $(this).attr('href');
            }
        })
    });
});

//Custom Function Execute By Name
//Used in generalFormSubmit
window.executeFunctionByName = function ( functionName, context /*, args */ ) {
    var args, namespaces, func;

    if( typeof functionName === 'undefined' ) { throw 'function name not specified'; }

    if( typeof eval( functionName ) !== 'function' ) { throw functionName + ' is not a function'; }

    if( typeof context !== 'undefined' ) {
        if( typeof context === 'object' && context instanceof Array === false ) {
            if( typeof context[ functionName ] !== 'function' ) {
                throw context + '.' + functionName + ' is not a function';
            }
            args = Array.prototype.slice.call( arguments, 2 );

        } else {
            args = Array.prototype.slice.call( arguments, 1 );
            context = window;
        }

    } else {
        context = window;
    }

    namespaces = functionName.split( "." );
    func = namespaces.pop();

    for( var i = 0; i < namespaces.length; i++ ) {
        context = context[ namespaces[ i ] ];
    }

    return context[ func ].apply( context, args );
}

//Custom Autosave Function by Ahyew
    // Custom Checking Required Form Field (Whole Tab) (Trigger by next button)
    window.checkForm = function(formTarget){
        var form;
        // all form within the tab
        if($('#' + formTarget).closest('[role = "tabpanel"]')[0] != null){
            form = $('#' + formTarget).closest('[role = "tabpanel"]')[0];
        }
        // specific form
        else{
            form = $('#' + formTarget)[0];
        }
        return form;
    }

    window.checkProceed = function(formTarget,btn) {

        var count = formTarget.querySelectorAll('.required-tag').length;
        if (count == 0) {
            btn.parentNode.querySelector('.btn-next').click();
        }
    }

    // Whole Tab
    window.addFormRequiredTag = function(formTarget) {
        var fields = formTarget.querySelectorAll(
            'select[required], textarea[required], input[required]'); // get all field required within same tab
        $.each(fields, function(i, field) {
            addFieldRequiredTag(field);
        });
    }

    // Whole Tab
    window.addTableRequiredTag = function(formTarget) {
        var table = formTarget.querySelectorAll(
            ".required-table"
            ); // get all table required within same tab // add required-table class into table class=""

        $.each(table, function(i, tb) {
            if (tb.children[1].children.length == 0) {
                const child = document.createElement('div');
                child.classList.add('required-tag');
                child.innerHTML = '<span class="badge badge-light-danger me-1">' + '{{ __("msg.form.required") }}' + '</span>';
                tb.parentNode.appendChild(child);
                tb.classList.add('required-border'); // make table border to red and 1px width
            }
        });
    }
    // End Custom Checking Required Form Field (Whole Tab) (Trigger by next button)

    // Custom Marking Required Field (Specific Field) (Trigger by autosave)
    window.checkRequiredTag = function(formId, fieldId, errormsg = null) {

        var field = $('#' + formId + ' #' + fieldId)[0]; // get field by formId and fieldId

        deleteFieldRequiredTag(field);
        addFieldRequiredTag(field, errormsg);

    }

    window.addFieldRequiredTag = function(field, errormsg = null) {
        if (field.hasAttribute('required')) {
            if (field.value == '' || errormsg != null) {
                if (field.getAttribute('type') == "file") { // input type is file
                    var reloadSectionId = field.id + 'ReloadSection';
                    if ($('#' + reloadSectionId)[0].children.length <= 1 || errormsg != null) {
                        addtag(field, errormsg);
                    }
                } else { // input type other than file
                    addtag(field, errormsg);
                }

                function addtag(field, errormsg = null) {
                    field.classList.add('required-border'); // make field border to red and 1px width
                    const child = document.createElement('div');
                    child.classList.add('required-tag');
                    if (errormsg == null) {
                        errormsg = '{{ __("msg.form.required") }}';
                    }
                    child.innerHTML = '<span class="badge badge-light-danger me-1">' +
                        errormsg + '</span>';
                    if (field.parentNode.classList.contains('input-group')) {
                        if (field.parentNode.parentNode.querySelectorAll('.required-tag').length == 0) {
                            field.parentNode.parentNode.appendChild(child);
                        }
                    } else {
                        field.parentNode.appendChild(child);
                    }
                }
            }
        }
    }

    window.deleteFieldRequiredTag = function(field) {

        if (field.parentNode.classList.contains('input-group')) {
            if (field.parentNode.parentNode.querySelectorAll(".required-tag:last-child").length > 0) {
                field.parentNode.parentNode.lastElementChild.closest(".required-tag").remove();
            }
        } else {
            if (field.parentNode.querySelectorAll(".required-tag:last-child").length > 0) {
                field.parentNode.lastElementChild.closest(".required-tag").remove();
            }
        }
        field.classList.remove('required-border'); // make field border back to default
    }
    // End Custom Marking Required Field (Specific Field) (Trigger by autosave)

    // Custom Reload After Upload
    window.reloadDiv = function(formId, uploadFieldId) {
        var reloadSectionId = uploadFieldId + 'ReloadSection';
        if (!$("#" + formId + " #" + uploadFieldId)[0].value == "") { // is not empty upload or cancel upload
            $("#" + formId + " #" + reloadSectionId).load(window.location.href + "#" + formId + " #" + reloadSectionId,
                function() {
                    $(this).replaceWith($(this).children());
                });
            var field = $("#" + formId + " #" + uploadFieldId);
            field[0].classList.remove('required-border');
        }
        return;
    }
    // End Custom Reload After Upload


