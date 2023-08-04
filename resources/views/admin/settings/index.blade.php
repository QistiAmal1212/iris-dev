@extends('layouts.app')


@section('header')
{{ __('msg.system_config') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#"> {{ __('msg.home') }}</a></li>
    <li class="breadcrumb-item active"> {{ __('msg.system_config') }}</li>
@endsection

@section('content')
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="system-tab" href="#system" aria-controls="system" data-bs-toggle="tab" role="tab" aria-selected="true">
                <span>{{ __('msg.system') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="database-tab" href="#database" aria-controls="database" data-bs-toggle="tab" role="tab" aria-selected="true">
                <span> Database </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="email-tab" href="#email" aria-controls="email" data-bs-toggle="tab" role="tab" aria-selected="true">
                <span> Email </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="maintenance-tab" href="#maintenance" aria-controls="maintenance" data-bs-toggle="tab" role="tab" aria-selected="true">
                <span> Maintenance </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="general-tab" href="#general" aria-controls="general" data-bs-toggle="tab" role="tab" aria-selected="true">
                <span> General </span>
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="system" aria-labelledby="system-tab" role="tabpanel">
            <div class="">
                @include('admin.settings.tab1')
            </div>
        </div>
        <div class="tab-pane fade" id="database" aria-labelledby="database-tab" role="tabpanel">
            <div class="">
                @include('admin.settings.tab2')
            </div>
        </div>
        <div class="tab-pane fade" id="email" aria-labelledby="email-tab" role="tabpanel">
            <div class="">
                @include('admin.settings.tab3')
            </div>
        </div>
        <div class="tab-pane fade" id="maintenance" aria-labelledby="maintenance-tab" role="tabpanel">
            <div class="">
                @include('admin.settings.tab4')
            </div>
        </div>
        <div class="tab-pane fade" id="general" aria-labelledby="general-tab" role="tabpanel">
            <div class="">
                @include('admin.settings.tab5')
            </div>
        </div>
    </div>
@endsection

@section('developer-script')

<script type="text/javascript">
    $(document).ready(function() {
        $('.dropify').dropify();
        $('#configForm').on('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                }
            });
        });

        $('.configForm2').on('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: "Berjaya!",
                text: "Data berjaya disimpan!",
                icon: "success",
            }).then((result) => {
                $('.preloader').removeClass('is-loading');
            });
        });

    });
</script>
@endsection
