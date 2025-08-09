@extends('layouts.backend')
@section('title', $pageTitle)
@section('content')
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif
    <table id="datatables" class="table table-bordered">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Học viên</th>
                <th>Giảm giá</th>
                <th>Tổng hoá đơn</th>
                <th>Số tiền phải trả</th>
                <th>Trạng thái đơn hàng</th>
                <th>Thời gian bắt đầu</th>
                <th>Thanh toán vào</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Mã đơn</th>
                <th>Học viên</th>
                <th>Giảm giá</th>
                <th>Tổng hoá đơn</th>
                <th>Số tiền đã trả</th>
                <th>Trạng thái đơn hàng</th>
                <th>Thời gian bắt đầu</th>
                <th>Thanh toán vào</th>
                <th>Hành động</th>
            </tr>
        </tfoot>
        <tbody>

        </tbody>
    </table>
    {{-- Modal xem order --}}
    <div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi tiết đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="order-detail-content">
                    <!-- Nội dung sẽ được đổ vào bằng AJAX -->
                </div>
            </div>
        </div>
    </div>
    @include('parts.backend.delete')
@endsection


@section('scripts')
    <script>
        $(document).ready(function () {
            $('#datatables').DataTable({
                ajax: "{{route('admin.orders.data')}}",
                processing: true,
                serverSide: true,
                columns: [
                    { data: 'id' },
                    { data: 'student_name' },
                    { data: 'coupon_discount' },
                    { data: 'total' },
                    { data: 'final_amount' },
                    { data: 'status' },
                    { data: 'payment_date' },
                    { data: 'payment_complete_date' },
                    { data: 'action', orderable: false, searchable: false },

                ]
            });
        });
    </script>
@endsection