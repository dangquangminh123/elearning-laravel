@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="all-course py-2 checkout-page">
        <div class="container">
            <h2 class="py-2">Thanh toán đơn hàng <a
                    href="{{ route('students.account.order-detail', $id) }}">#{{ $id }}</a>
                @if (config('checkout.checkout_countdown') > 0)
                    <span class="countdown"><span>00</span>:<span>00</span>
                @endif
            </h2>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h4 class="mb-3">Thông tin đơn hàng</h4>
                    <table class="table table-bordered">
                        <tr>
                            <th width="25%">ID đơn hàng</th>
                            <td>#{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Tổng đơn hàng</th>
                            <td>{{ money($order->total) }}</td>
                        </tr>
                        <tr>
                            <th>Giảm giá</th>
                            <td class="discount-value">{{ money($order->discount, freeText: '0') }}</td>
                        </tr>
                        <tr>
                            <th>Thời gian đặt</th>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td><span class="badge bg-{{ $order->status->color }}">
                                    {{ $order->status->name }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tổng thanh toán</th>
                            <td class="total-value">{{ money($order->total - $order->discount) }}</td>
                        </tr>
                    </table>
                    <h4 class="mb-3">Chi tiết đơn hàng</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th>Tên khóa học</th>
                                <th>Giá</th>
                                <th>Giảng viên</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->detail as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item?->course?->name }}</td>
                                    <td>{{ money($item->price) }}</td>
                                    <td>{{ $item?->course?->teacher?->name }}</td>
                                    <td><span
                                            class="badge bg-{{ $item->course?->status ? 'success' : 'danger' }}">{{ $item->course?->status ? 'Đang hoạt động' : 'Dừng hoạt động' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="/gio-hang" class="btn btn-primary btn-sm">Quay lại giỏ hàng</a>
                    <a href="{{ route('courses.index') }}" class="btn btn-primary btn-sm">Mua thêm khóa học</a>
                </div>
                <div class="col-6">
                    {{-- Coupon --}}
                    @include('students::clients.partials.coupon')
                    <div class="row">
                        <div class="col-6">
                            <h4 class="mb-3">Thông tin thanh toán</h4>
                            <p>Quý khách vui lòng chuyển khoản tới số tài khoản bên dưới hoặc quét mã QR để thực hiện thanh
                                toán. Vui lòng nhập đúng số tiền và nội dung chuyển khoản</p>
                            <hr>
                            <p>- Ngân hàng Vietcombank - Chi nhánh Thăng Long</p>
                            <p>- Số tài khoản: <span>049100035576</span> <i class="bank-copy fa-regular fa-copy"></i>
                            </p>
                            <p>- Chủ tài khoản: Tạ Hoàng An</p>
                            <p>- Số tiền: <span class="total-value">{{ money($order->total - $order->discount) }}</span>
                            </p>
                            <p>- Nội dung: <span>thanh toán {{ $id }}</span> <i
                                    class="bank-copy fa-regular fa-copy"></i>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <img class="qr-img" style="width: 230px"
                                    src="https://img.vietqr.io/image/techcombank-19039119170014-compact2.jpg?amount={{ $order->total - $order->discount }}&addInfo=thanh+toan+{{ $id }}"
                                    alt="">
                                <button class="btn btn-success btn-sm download-qr">Tải QR Code</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection