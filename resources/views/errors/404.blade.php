{{-- @extends('errors::minimal')
@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('layouts.client')

@section('title', $pageTitle ? $pageTitle : 'Không tìm thấy')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">404 - Không tìm thấy</h1>
    <p class="lead">
        {{ $message ?? 'Trang bạn yêu cầu không tồn tại hoặc đã bị xóa.' }}
    </p>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Quay lại</a>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3 ml-2">Trang chủ</a>
</div>
@endsection


