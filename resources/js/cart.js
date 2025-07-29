import { showMessage } from "./utils";
import Swal from 'sweetalert2';

$(document).ready(function () {

    // Add to cart
    $('.btn-add-to-cart').on('click', function (e) {
       
        e.preventDefault();

        const form = $(this).closest('form');
        const courseId = form.find('input[name="course_id"]').val();
        const csrfToken = document.head.querySelector('[name="csrf_token"]').content;

        $.ajax({
            type: 'POST',
            url: '/cart/add',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                course_id: courseId
            },
            success: function (response) {
                if (response.success) {
                    updateCartCount(response.cart_count);
                    flashCartIcon();
                    showMessage("Thêm khoá học thành công");
                }
            },
            error: function () {
                showMessage("Có lỗi xảy ra khi thêm giỏ hàng.");
            }
        });
    });

    
    // Popup cart
    $('.cart').hover(
        function () {
            $('.cart-popup').stop().fadeIn(200);
        },
        function () {
            $('.cart-popup').stop().fadeOut(200);
        }
    );

    // API POPUP cart
    $('.cart').on('mouseenter', function () {
        reloadCartPopup(); // luôn luôn gọi khi hover
    });


    function reloadCartPopup() {
        $.ajax({
            url: '/cart/popup-items',
            method: 'GET',
            success: function (res) {
                const popup = $('.cart-popup ul.cart-items');
                popup.empty();

                if (res.items.length) {
                    res.items.forEach(item => {
                        popup.append(`
                            <li>
                                <span title="${item.name}">${item.name}</span>
                                <span>${item.price}₫</span>
                            </li>
                        `);
                    });
                } else {
                    popup.append('<li>Giỏ hàng trống</li>');
                }

                $('.cart .cart-count').toggleClass('d-none', res.count === 0).text(res.count);
            }
        });
    }
    //animate add
    function flashCartIcon() {
        const $icon = $('.cart i');

        $icon.addClass('sparkle');

        setTimeout(() => {
            $icon.removeClass('sparkle');
        }, 1500); // sau 3s thì trở lại bình thường
    }

    //Sự kiện xoá từng item
    $('.remove-item-form').on('submit', function (e) {
        e.preventDefault();
        const courseId = $(this).data('id');
        const $row = $(this).closest('tr');
        handleRemoveItem(courseId, $row);
    });

    // Bắt sự kiện xoá toàn bộ giỏ hàng
    $('#clear-cart-form').on('submit', function (e) {
        e.preventDefault();
        handleClearCart();
    });

    function handleRemoveItem(courseId, $row) {
        // const csrfToken = $('meta[name="csrf-token"]').attr('content');
        const csrfToken = document.head.querySelector('[name="csrf_token"]').content;
        $.ajax({
            type: 'POST',
            url: '/cart/remove',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            data: { course_id: courseId },
            success: function (response) {
                if (response.success) {
                    $row.remove(); // Xoá dòng tương ứng
                    updateCartTotal(); // Cập nhật tổng tiền
                    updateCartCount(response.cart_count); // Cập nhật icon cart
                    reloadCartPopup(); // cập nhật lại popup cart
                    showMessage("Đã xoá khoá học");
                }
            },
            error: function () {
                 showMessage("Có lỗi xảy ra khi xoá");
            }
        });
    }

    function handleClearCart() {
        const csrfToken = document.head.querySelector('[name="csrf_token"]').content;

        Swal.fire({
            title: 'Bạn có muốn xoá toàn bộ không?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xoá hết',
            cancelButtonText: 'Huỷ',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/cart/clear',
                    method: 'POST',
                    data: {
                        _token: csrfToken
                    },
                    success: function (res) {
                        if (res.success) {
                            // Xoá hết bảng hiện tại
                            $('.table').remove();

                            // Thêm thông báo bên dưới khu vực bảng
                            $('#cart-wrapper').html(`
                                <div class="alert alert-info mt-3">Giỏ hàng của bạn đang trống.</div>
                            `);

                            // Optional: cập nhật số lượng giỏ hàng
                            $('#cart-count').text(res.cart_count);
                            reloadCartPopup(); // cập nhật lại popup cart
                            showMessage("Xoá toàn bộ khoá học thành công!");
                        }
                    },
                    error: function () {
                       showMessage("Có lỗi xảy ra khi xoá");
                    }
                });
            }
        });
    }

    // Cập nhập lại giỏ hàng
    function updateCartTotal() {
        let total = 0;

        $('tbody tr').each(function () {
            const priceText = $(this).find('td').eq(3).text().replace(/[^\d]/g, '');
            total += parseInt(priceText || 0);
        });

        const formatted = total.toLocaleString('vi-VN') + 'đ';
        $('.cart-summary .total-price').text(formatted);

        if (total === 0) {
            $('.cart-summary').remove();
            $('tbody').append('<tr><td colspan="5" class="text-center">Giỏ hàng trống.</td></tr>');
        }
    }

    // Cập nhập số lượng giỏ hàng
    function updateCartCount(count) {
        $('.cart .cart-count').toggleClass('d-none', count === 0).text(count);
    }


});
