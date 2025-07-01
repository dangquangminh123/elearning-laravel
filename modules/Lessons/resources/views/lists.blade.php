@extends('layouts.backend')
@section('content')
    <p>
        <a href="{{route('admin.courses.index')}}" class="btn btn-info text-white">Quay lại khoá học</a>
        <a href="{{route('admin.lessons.sort', $course)}}" class="btn btn-success">Sắp xếp bài giảng</a>
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
                <th>Thời lượng</th>
                <th style="width: 7%;">Thêm</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xoá</th>
            </tr>
        </thead>
        <tfoot>
            
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
                processing: true,
                serverSide: true,
                // pageLength: 10,
                ajax: "{{route('admin.lessons.data', $course->id)}}",
                "columns": [
                    { data: "name" },
                    { data: "is_trial" },
                    { data: "view" },
                    { data: "durations" },
                    { data: "add" },
                    { data: 'edit' },
                    { data: 'delete' },
                ]
            })
        })
    </script>
@endsection