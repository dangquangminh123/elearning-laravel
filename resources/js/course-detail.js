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
       '.badge-course-foundation.badge-course': { 
            bg: [
                'linear-gradient(135deg, #C3272B, #C3272B)',
                'linear-gradient(135deg, #C3272B, #C3272B)'
            ],
            text: ['#426666', '#426666']
        },
        '.badge-course-free.badge-course': { 
            bg: [
                'linear-gradient(135deg, #146654, #146654)',
                'linear-gradient(135deg, #146654, #146654)'
            ],
            text: ['#f05510', '#f05510']
        },
        '.badge-course-hot.badge-course': { 
            bg: [
                'linear-gradient(135deg, #564232, #564232)',
                'linear-gradient(135deg, #564232, #564232)'
            ],
            text: ['#327A58', '#327A58']
        },
        '.badge-course-skill.badge-course': { 
            bg: [
                'linear-gradient(135deg, #4781C3, #4781C3)',
                'linear-gradient(135deg, #4781C3, #4781C3)'
            ],
            text: ['#DE7565', '#DE7565']
        },
        '.badge-course-advanced.badge-course': { 
            bg: [
                'linear-gradient(135deg, #6F9Bc6, #6F9Bc6)',
                'linear-gradient(135deg, #6F9Bc6, #6F9Bc6)'
            ],
            text: ['#F3993A', '#F3993A']
        }
    };

    // Áp dụng hiệu ứng flash-me cho từng loại khóa học
    for (const selector in courseColors) {
        if ($(selector).length > 0) {
            const colors = courseColors[selector];
            $(selector).flashMe({
                backgroundColors: [
                       'linear-gradient(135deg, #F7BDCB, #F7BDCB)',
                        'linear-gradient(135deg, #F7BDCB, #F7BDCB)',
                    ...colors.bg                             
                ],
                colors: [
                    '#5654A2',                                 
                    ...colors.text                           
                ],
                interval: 3000,
                transition: 1500
            });   
        }
    }
});