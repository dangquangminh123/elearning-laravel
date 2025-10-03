@extends('layouts.backend')
@section('title', $pageTitle)
@section('content')
    <p><a href="{{route('admin.courses.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('courses::messages.name') }}</th>
                <th>{{ __('courses::messages.course_price') }}</th>
                <th>{{ __('courses::messages.course_code') }}</th>
                <th>{{ __('courses::messages.status_course') }}</th>
                <th>{{ __('courses::messages.course_type') }}</th>
                <th>{{ __('courses::messages.time') }}</th>
                <th>{{ __('courses::messages.courses_lesson') }}</th>
                <th style="width: 5%;">{{ __('courses::messages.courses_edit') }}</th>
                <th style="width: 5%;">{{ __('courses::messages.courses_delete') }}</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>{{ __('courses::messages.name') }}</th>
                <th>{{ __('courses::messages.course_price') }}</th>
                <th>{{ __('courses::messages.course_code') }}</th>
                <th>{{ __('courses::messages.status_course') }}</th>
                 <th>{{ __('courses::messages.course_type') }}</th>
                <th>{{ __('courses::messages.time') }}</th>
                <th>{{ __('courses::messages.courses_lesson') }}</th>
                <th>{{ __('courses::messages.courses_edit') }}</th>
                <th>{{ __('courses::messages.courses_delete') }}</th>
            </tr>
        </tfoot>
        <tbody>

        </tbody>
    </table>
    @include('parts.backend.delete')
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            $('#datatables').DataTable({
                ajax: "{{route('admin.courses.data')}}",
                processing: true,
                serverSide: true,
                "columns": [
                    { "data": "name" },
                    { "data": "price" },
                    { "data": "code" },
                    { "data": "status" },
                    { "data": "type_name" },
                    { "data": "created_at" },
                    { "data": "lessons" },
                    { "data": "edit" },
                    { "data": "delete" },
                ]
            })
        })
    </script>
@endsection