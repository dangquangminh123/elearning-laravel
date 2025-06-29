@extends('layouts.backend')
@section('content')
    <p><a href="{{route('admin.courses.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mã khoá</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th>Bài giảng</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tên</th>
                <th>Giá</th>
                <th>Mã khoá</th>
                <th>Trạng thái</th>
                <th>Thời gian</th>
                <th>Bài giảng</th>
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
                ajax: "{{route('admin.courses.data')}}",
                processing: true,
                serverSide: true,
                "columns": [
                    { "data": "name" },
                    { "data": "price" },
                    { "data": "code" },
                    { "data": "status" },
                    { "data": "created_at" },
                    { "data": "lessons" },
                    { "data": "edit" },
                    { "data": "delete" },
                ]
            })
        })
    </script>
@endsection