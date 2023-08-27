@extends('layouts.app')

@section('header')
    Maklumat Jawatan Kosong
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><a> Maklumat Jawatan Kosong</a>
    </li>
@endsection

@section('content')
<div class="row">

    {{-- KRONOLGOI --}}
    <div class="col-lg-3 col-md-3 col-sm-12 order-1 order-lg-1">
        @include('pemerolehan.pgspa.jawatan_kosong.kronologi')
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 order-2 order-lg-2">
        <div class="card">
            <div class="card-body">
                <div class="">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-bolder active" id="kekosongan-tab" data-bs-toggle="tab" href="#kekosongan" aria-controls="kekosongan" role="tab" aria-selected="true">
                                Maklumat Kekosongan
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="kekosongan" role="tabpanel" aria-labelledby="kekosongan-tab">
                            <hr>
                            @include('pemerolehan.pgspa.jawatan_kosong.jawatan_kosong')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
