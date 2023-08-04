@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message')
<span>{{ $exception ? $exception->getMessage() : __('Not Found') }}</span>
@endsection
