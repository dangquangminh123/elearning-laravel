import { showMessage } from "./utils";
// Xử lý nút "Vào học ngay"
const csrfToken = document.head.querySelector('[name="csrf_token"]').content;
    function handleGoLearn() {
        $('.go-learn').on('click', function () {
            const slug = $(this).data('course-slug');
            if (slug) {
                window.location.href = `/khoa-hoc/${slug}/learn`;
            }
        });
    }

    // Xử lý nút "Thêm vào giỏ hàng" và điều hướng
    function handleAddToCartAndRedirect() {
        $('.payment, .activate-course').on('click', function () {
            const courseId = $(this).data('course-id');

            if (!courseId) {
                showMessage('Không tìm thấy ID khoá học.');
                return;
            }

            $.ajax({
                url: '/cart/add',
                type: 'POST',
                data: {
                    course_id: courseId,
                    _token: csrfToken
                },
                success: function (res) {
                    if (res.success) {
                        window.location.href = '/cart/list';
                    } else {
                        showMessage(res.message || 'Đã xảy ra lỗi khi thêm vào giỏ hàng.');
                    }
                },
                error: function () {
                    showMessage('Lỗi hệ thống. Vui lòng thử lại sau.');
                }
            });
        });
    }
    handleGoLearn();
    handleAddToCartAndRedirect();