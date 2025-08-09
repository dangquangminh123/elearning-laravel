$(document).on('click', '.btn-view', function(e) {
    e.preventDefault();
    const url = $(this).attr('href');

    $('#order-detail-content').html('<p>Đang tải dữ liệu...</p>');
    $('#orderDetailModal').modal('show');

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const o = response.order;

                const statusName = o.status ?? 'Không rõ';
                let statusClass = '';
                let paymentAmount = '0đ';
                let paymentCompleteDate = 'Không có';

                switch (statusName.toLowerCase()) {
                    case 'chờ thanh toán':
                        statusClass = 'status-pending';
                        break;
                    case 'đã thanh toán':
                        statusClass = 'status-success';
                        break;
                    case 'thanh toán thất bại':
                        statusClass = 'status-failed';
                        break;
                    case 'hủy thanh toán':
                    case 'đã huỷ':
                        statusClass = 'status-cancelled';
                        break;
                    default:
                        statusClass = 'status-unknown';
                }

                let html = `
                    <div class="order-info">
                        <p><strong>Mã đơn hàng:</strong> <span>${o.id}</span></p>
                        <p><strong>Học viên:</strong> <span>${o.student?.name ?? 'Không có'}</span></p>
                        <p><strong>Trạng thái:</strong> <span class="order-status ${statusClass}">${statusName}</span></p>
                        <p><strong>Tổng tiền:</strong> <span class="text-secondary">${o.total}</span></p>
                        <p><strong>Giảm giá:</strong> <span class="text-warning">${o.discount.formatted}</span></p>
                        <p><strong>Loại mã giảm giá:</strong> <span>${o.discount.type}</span></p>
                        <p><strong>Số tiền đã thanh toán:</strong> <span class="paid-amount">${o.payment_amount}</span></p>
                        <p><strong>Ngày đặt:</strong> <span>${o.payment_date}</span></p>
                        <p><strong>Ngày hoàn tất thanh toán:</strong> <span>${o.payment_complete_date}</span></p>
                        <p><strong>Ghi chú:</strong> <span>${o.note ?? 'Không có'}</span></p>
                    </div>
                    <hr>
                    <h5>Danh sách khoá học:</h5>
                    <ul class="course-list">
                `;
                o.courses.forEach(c => {
                    html += `<li><strong class="course-name">${c.name}</strong> - <span>${c.price}</span></li>`;
                });
                html += `</ul>`;

                $('#order-detail-content').html(html);
            } else {
                $('#order-detail-content').html('<p>Không tìm thấy dữ liệu đơn hàng.</p>');
            }
        },
        error: function() {
            $('#order-detail-content').html('<p>Lỗi khi tải dữ liệu đơn hàng.</p>');
        }
    });
});

// Xoá nội dung modal khi đóng
$('#orderDetailModal').on('hidden.bs.modal', function () {
    $('#order-detail-content').html(''); // Clear nội dung modal
});
