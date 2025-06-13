@extends('layouts.backend')
@section('content')
    <p><a href="{{route('admin.users.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Thời gian</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
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
                ajax: "{{route('admin.users.data')}}",
                processing: true,
                serverSide: true,
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "group_id" },
                    { "data": "created_at" },
                    { "data": "edit" },
                    { "data": "delete" },
                ]
            })
        })
    </script>
@endsection