@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')
    <p><a href="{{route('admin.teacher.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Điện thoại/zalo</th>
                <th>Kinh nghệm</th>
                <th>Thời gian</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Điện thoại/zalo</th>
                <th>Kinh nghệm</th>
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
                ajax: "{{route('admin.teacher.data')}}",
                processing: true,
                serverSide: true,
                "columns": [
                    { "data": "image" },
                    { "data": "name" },
                    { "data": "phone_zalo" },
                    { "data": "exp" },
                    { "data": "created_at" },
                    { "data": "edit" },
                    { "data": "delete" },
                ]
            })
        })
    </script>
@endsection