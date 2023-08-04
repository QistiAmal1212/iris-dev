@extends('layouts/contentLayoutMaster')

@section('title', 'Inbox')

@section('header')
    <h2 class="customTitle1"> {{__('msg.inbox')}}</h2>
    <span class="customTitle1"> {{__('msg.customDescription', ['item' => __('msg.inbox')])}}</span>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}"> {{__('msg.home')}}</a></li>
    <li class="breadcrumb-item"><span> {{__('msg.inbox')}}</span></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="form-horizontal">
            <table class="table table-bordered table-hover" width="100%">
                <thead>
                    <tr class="table-success">
                        <th width="5%">No</th>
                        <th>Title</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!count($inboxs))
                    <tr class="text-center">
                        <td colspan="3">No data yet</td>
                    </tr>
                    @endif

                    @foreach($inboxs as $inbox)
                    <tr>
                        <th>{{ (($inboxs->currentPage() - 1) * $inboxs->perPage()) + $loop->iteration }}</th>
                        <td>{{ $inbox->subject }}</td>
                        <td>{!! $inbox->message !!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
