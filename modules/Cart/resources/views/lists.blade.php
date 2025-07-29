@extends('layouts.client')
@section('content')
<div class="container my-4">
    <h2 class="mb-4">Giỏ Hàng Của Bạn</h2>
     <div id="cart-wrapper">
        @if(count($cart) > 0)
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tên Khóa Học</th>
                    <th>Hình Ảnh</th>
                    <th>Giảng Viên</th>
                    <th>Giá Tiền</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody class="cart_course">
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $total += $item['sale_price']; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <img src="{{ asset($item['thumbnail']) }}" alt="{{ $item['name'] }}" style="width: 100px; height: auto;">
                        </td>
                        <td>{{ $item['teacher_name'] ?? 'N/A' }}</td>
                        <td>{{ number_format($item['sale_price'], 0, ',', '.') }}đ</td>
                        <td class="text-end">
                            <form class="remove-item-form" data-id="{{ $item['id'] }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                {{-- Hàng tổng cộng --}}
                <tr class="cart-summary">
                    <td colspan="3" class="fw-bold">Tổng cộng:</td>
                    <td class="fw-bold total-price">{{ number_format($total).'đ' }}</td>
                    <td class="fw-bold text-danger text-end">
                        
                        <form action="" id="clear-cart-form" method="POST" class="d-inline ms-3">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Xoá tất cả</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        @else
            <div class="alert alert-info">Giỏ hàng của bạn đang trống.</div>
        @endif

        {{-- Button --}}
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('courses.index') }}" class="btn btn-outline-primary">
                 Tiếp tục mua khoá học
            </a>

            <form id="proceed-form" action="{{ route('orders.proceed') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">
                    Tiếp tục thanh toán →
                </button>
            </form>
        </div>

    </div>
</div>
@endsection