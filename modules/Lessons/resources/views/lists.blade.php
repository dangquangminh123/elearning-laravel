@extends('layouts.backend')
@section('content')
    <p>
        <a href="{{route('admin.courses.index')}}" class="btn btn-info text-white">Quay lại khoá học</a>
        <a href="{{route('admin.lessons.create', $course)}}" class="btn btn-primary">Thêm mới</a>
    </p>
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Học thử</th>
                <th>Lượt xem</th>
                <th>Thứ tự</th>
                <th>Thời gian</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
          
        </tfoot>
        <tbody>

        </tbody>
    </table>
    {{-- @include('parts.backend.delete') --}}
@endsection

{{-- 
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
@endsection --}}