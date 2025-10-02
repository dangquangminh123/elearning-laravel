@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')
    <p><a href="{{route('admin.categories.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('categories::messages.name') }}</th>
                <th>{{ __('categories::messages.link') }}</th>
                <th>{{ __('categories::messages.duration') }}</th>
                <th style="width: 5%;">{{ __('categories::messages.edit') }}</th>
                <th style="width: 5%;">{{ __('categories::messages.delete') }}</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>{{ __('categories::messages.name') }}</th>
                <th>{{ __('categories::messages.link') }}</th>
                <th>{{ __('categories::messages.duration') }}</th>
                <th>{{ __('categories::messages.edit') }}</th>
                <th>{{ __('categories::messages.delete') }}</th>
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
                ajax: "{{route('admin.categories.data')}}",
                processing: true,
                serverSide: true,
                pageLength: 10,
                "columns": [
                    { "data": "name" },
                    { data: 'link', orderable: false, searchable: false },
                    { "data": "created_at" },
                    { data: 'edit', orderable: false, searchable: false },
                    { data: 'delete', orderable: false, searchable: false },
                ]
            })
        })
    </script>
@endsection