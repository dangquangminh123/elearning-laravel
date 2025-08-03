@extends('layouts.backend')
@section('title', $pageTitle)

@section('content')
    <p><a href="{{route('admin.coupons.create')}}" class="btn btn-primary">Thêm mới</a></p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Mã</th>
                <th>Loại mã</th>
                <th>Giá trị mã</th>
                <th>Điều kiện mã</th>
                <th>Số lượt sử dụng</th>
                <th>Thời gian bắt đầu</th>
                <th>thời gian kết thúc</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Mã</th>
                <th>Loại mã</th>
                <th>Giá trị mã</th>
                <th>Điều kiện mã</th>
                <th>Số lượt sử dụng</th>
                <th>Thời gian bắt đầu</th>
                <th>thời gian kết thúc</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
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
                ajax: "{{route('admin.coupons.data')}}",
                processing: true,
                serverSide: true,
                "columns": [
                    { "data": "code" },
                    { "data": "discount_type" },
                    { "data": "discount_value" },
                    { "data": "total_condition" },
                    { "data": "count" },
                    { "data": "start_date" },
                    { "data": "end_date" },
                    { "data": "edit" },
                    { "data": "delete" },
                ]
            })
        })
    </script>
@endsection