@extends('layouts.client')
@section('content')
<div class="container my-5">
    <h2 class="mb-4">Thông tin đơn hàng của  <span class="fw-bold text-warning fs-3 text-decoration-underline">
        {{ $order->student->name ?? 'Học viên' }}
    </span></h2>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tên khóa học</th>
                    <th>Hình ảnh</th>
                    <th>Giảng viên</th>
                    <th class="text-end">Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->detail as $item)
                    <tr>
                        <td>{{ $item->course->name }}</td>
                        <td style="width: 120px">
                            <img src="{{ $item->course->thumbnail ?? '/images/default-course.png' }}" 
                                 alt="{{ $item->course->name }}" 
                                 class="img-fluid rounded" 
                                 style="max-height: 80px;">
                        </td>
                        <td>{{ $item->course->teacher->name ?? 'Không rõ' }}</td>
                        <td class="text-end text-danger fw-bold">
                            {{ number_format($item->price, 0, ',', '.') }}đ
                        </td>
                    </tr>
                @endforeach
                <tr class="fw-bold bg-light">
                    <td colspan="3" class="text-end">Tổng tiền phải thanh toán:</td>
                    <td class="text-success text-end">
                        {{ number_format($order->detail->sum('price'), 0, ',', '.') }}đ
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-3 text-end">
        <a href="#" class="btn btn-primary">Tiến hành thanh toán</a>
    </div>
</div>
@endsection