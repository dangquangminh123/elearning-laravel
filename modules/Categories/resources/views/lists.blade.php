@extends('layouts.backend')
@section('content')
    <p><a href="{{route('admin.categories.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Link</th>
                <th>Thời gian</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tên</th>
                <th>Link</th>
                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xoá</th>
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