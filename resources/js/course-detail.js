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

$(document).ready(function() {
      // Định nghĩa các cặp màu nền và màu chữ cho từng loại khóa học
    const courseColors = {
        '.badge-course-foundation.badge-course': { bg: '#D63031', text: '#FAD390' },
        '.badge-course-advanced.badge-course': { bg: '#0984E3', text: '#DFF9FB' },
        '.badge-course-hot.badge-course': { bg: '#FDCB6E', text: '#2D3436' },
        '.badge-course-skill.badge-course': { bg: '#6C5CE7', text: '#FDCB6E' },
        '.badge-course-free.badge-course': { bg: '#2ecc71', text: '#ffffff' } 
    };

    // Áp dụng hiệu ứng flash-me cho từng loại khóa học
    for (const selector in courseColors) {
        if ($(selector).length > 0) {
            const colors = courseColors[selector];
            $(selector).flashMe({
                // ĐÃ SỬA: Thêm một màu thứ hai vào mảng
                'backgroundColors': [colors.bg, '#681414'], 
                'colors': [colors.text, '#D7CCB6'],
                'interval': 3000, 
                'transition': 500
            });
   
        }
    }
});