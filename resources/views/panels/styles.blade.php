<!-- BEGIN: Vendor CSS-->
@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors-rtl.min.css')) }}" />
@else
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}" />
@endif

@yield('vendor-style')

<link rel="stylesheet" href="{{ asset(mix('fonts/font-awesome/css/all.min.css')) }}" >
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/pickadate/pickadate.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

<!-- END: Vendor CSS-->

<!-- BEGIN: Theme CSS-->
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/themes/dark-layout.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/themes/bordered-layout.css')) }}" />
<link rel="stylesheet" href="{{ asset(mix('css/base/themes/semi-dark-layout.css')) }}" />

@php $configData = Helper::applClasses(); @endphp

<!-- BEGIN: Page CSS-->
@if ($configData['mainLayoutType'] === 'horizontal')
  <link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/horizontal-menu.css')) }}" />
@else
  <link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/vertical-menu.css')) }}" />
@endif

{{-- Page Styles --}}
@yield('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-faq.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
<style>
    /*--applies to all---*/

    /*--card border--*/
    .border-dark {
        border: 1px solid #b8c2cc!important;
    }

    /*--paginator--*/
    .pagination{
        margin-top: 1rem!important;
    }

    .page-item .page-link,
    .page-item.active {
       border-radius: 5rem !important;
    }

     /*--Modal Right Side Login Page--*/
    .modal.login.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(110%, 60%, 0);
        transform: translate3d(110%, 60%, 0);
        max-width: 30%;
    }

    /*--Modal Custom Height: 70% of resolution height--*/
    .modal .modal-body.height-70 {
        height: 70vh;
    }

    /*--Modal Custom Height: 40% of resolution height--*/
    .modal .modal-body.height-40{
        height: 40vh;
    }

     /*--Modal Make Scrollable Y Stay--*/
     .modal-body.modal-force-scroll-y{
        overflow-y:scroll !important;
    }

    /*--Modal Make Scrollable X Stay--*/
     .modal-body.modal-force-scroll-x{
        overflow-x:scroll !important;
    }

    /*--Fixed FormLabel sizing from bootstrap--*/
    .form-label {
        font-size: var(--bs-body-font-size);
    }
    .col-form-label{
        font-size: var(--bs-body-font-size);
    }

    /*--Fixed Form Group margin too near--*/
    .form-group{
        margin-bottom:1rem;
    }

    /*--Fixed Width of Form Wizard --*/
    .bs-stepper.vertical .bs-stepper-content {
        width: 83.333% !important;
    }
    .bs-stepper.vertical .bs-stepper-header {
        width: 16.667% !important;
    }

    /*- Make table able to scroll horizontally --*/
    .tableWrapper {
        display: block;
        overflow-x: scroll;
    }

    /*-- Datatable --*/
    .table-hover tbody tr,
    .table-hover tbody td {
        cursor: default
    }

    .btn-floating{
        bottom: 5%;
        position: fixed;
        right: 2%;
        z-index: 1031;
    }
    /*- Fix Dropify Font Size --*/
    .dropify-wrapper .dropify-message span.file-icon {
       font-size:2rem !important;
    }

    .required-border {
        border: 1px solid red;
    }

    div .faq-search {
        div .faq-search-input {
            div .input-group {
                width: 576px;
                margin: 0 auto;
            }
        }
    }

</style>
<!-- BEGIN: Laravel Style CSS-->
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}" />

<!-- BEGIN: Custom CSS-->

@if ($configData['direction'] === 'rtl' && isset($configData['direction']))
  <link rel="stylesheet" href="{{ asset(mix('css-rtl/custom-rtl.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('css-rtl/style-rtl.css')) }}" />

@else
<!-- BEGIN: Custom User CSS-->
  <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />
@endif
