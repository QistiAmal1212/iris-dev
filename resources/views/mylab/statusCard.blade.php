<div class="">
    <h4 class="text-uppercase strong text-nowrap">Application ID: <br>{{ $mylab_application?->application_id }}
    </h4>
    @php
        $module_status_id = $mylab_application->module_status_id;
        $module_status = $mylab_application->moduleStatus;
    @endphp

    <div align="center">
        @include('listing.application.show_status')

    </div>
</div>
