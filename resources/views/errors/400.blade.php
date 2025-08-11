{{-- <h1>Bad Request</h1>
<h2>{{ $exception->getMessage() }}</h2> --}}


@extends('layouts.client')

@section('title', $pageTitle ? $pageTitle : 'Lỗi xảy ra')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">400 - Lỗi xảy ra</h1>
    <p class="lead">
        {{ $message ?? 'Trang bạn yêu cầu bị sai hoặc không tồn tại.' }}
    </p>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Quay lại</a>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3 ml-2">Trang chủ</a>
</div>
@endsection