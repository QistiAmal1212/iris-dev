@extends('layouts.app')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
@endsection

@section('header')
Maklumat Integrasi
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('msg.home') }}</a></li>
<li class="breadcrumb-item"><a href="{{ route('dashboard_integration') }}">Pengurusan Integrasi</a></li>
<li class="breadcrumb-item"><a>Maklumat Integrasi</a></li>
@endsection

@section('content')
<style>
    #integrationInformation thead th {
        vertical-align: middle;
        text-align: center;
    }

    #integrationInformation tbody {
        vertical-align: middle;
        text-align: center;
    }

    #integrationInformation {
        width: 100% !important;
        /* word-wrap: break-word; */
    }

</style>


<div class="row">
    <div class="col-md-3 col-lg-3 col-xl-3 col-12">
        <div class="card">
            <div class="card-body">
                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <div class="user-info text-center">
                            <h4 class="fw-bolder">ID API: {{ "API".substr(str_repeat(0, 3).$api->id, - 3); }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="card">
            <div class="card-header align-items-start pb-0">
                <div>
                    <h2 class="fw-bolder">Penyambungan Berjaya</h2>
                    <p class="card-text text-muted">Selama 48 Jam Terakhir</p>
                </div>
            </div>
            <div id="line-area-chart-6"></div>
        </div>

        <div class="card">
            <div class="card-header align-items-start pb-0">
                <div>
                    <h2 class="fw-bolder">Average Latency (ms)</h2>
                    <p class="card-text text-muted">Selama 48 Jam Terakhir</p>
                </div>
            </div>
            <div id="line-area-chart-5"></div>
        </div> --}}
    </div>

    <div class="col-md-9 col-lg-9 col-xl-9 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Maklumat Log Integrasi</h4>
            </div>

            <hr>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table header_uppercase table-bordered table-responsive" id="integrationInformation">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th>Tarikh</th>
                                <th>Masa</th>
                                <th>Kod HTTP</th>
                                <th>Nama</th>
                                <th width="10%">Execution Time </th>
                                <th width="10%">Size Request</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach($api->log as $log)
                            <tr>
                                <td>{{ $i ++ }}</td>
                                <td>{{ $log->tarikh_cipta->format('d/m/Y') }}</td>
                                <td>{{ $log->tarikh_cipta->format('H:i:s') }}</td>
                                <td>
                                    {{-- <span class="badge badge-rounded badge-light-primary fw-bolder mb-1">Prod</span>
                                    <br> --}}
                                    @if($log->kod_http == '200')
                                    <span class="badge badge-rounded badge-light-success fw-bolder">{{ $log->kod_http }}</span>
                                    @else
                                    <span class="badge badge-rounded badge-light-danger fw-bolder">{{ $log->kod_http }}</span>
                                    @endif
                                </td>
                                <td>{{ $log->nama }}</td>
                                <td>{{ number_format($log->execution_time, 2, '.', '').'ms' }}</td>
                                <td>{{ number_format($log->size_request, 2, '.', '').'Kb' }}</td>
                                <td>
                                    @if($log->kod_http == '200')
                                    <span class="badge badge-rounded badge-light-success fw-bolder mb-1">Berjaya</span>
                                    @else
                                    <span class="badge badge-rounded badge-light-danger fw-bolder mb-1">Gagal</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
<script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('js/scripts/cards/card-statistics.js')) }}"></script>
@endsection
