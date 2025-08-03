
$(document).ready(function () {
    // Xử lý thêm class active cho bài học được click
    $('.lesson-item').on('click', function () {
        $('.lesson-item').removeClass('active-lesson');
        $(this).addClass('active-lesson');
    });

    // Gắn sự kiện click cho mỗi bài học
    $('.play-video').on('click', function () {
        handleLessonClick($(this));
    });
});

// Hàm xử lý khi người dùng click vào bài học
function handleLessonClick($element) {
    const videoUrl = $element.data('video-url');
    const lessonName = $element.data('lesson-name');
    const docUrl = $element.data('doc-url');
    const docName = $element.data('doc-name');

    if (!videoUrl) {
        showMissingVideoAlert(lessonName);
        return;
    }

    playVideo(videoUrl);
    updateLessonName(lessonName);
    updateDocument(docUrl, docName);
}

// Phát video
function playVideo(videoUrl) {
    const mainVideo = $('#main-video');
    if (mainVideo.length) {
        mainVideo.attr('src', videoUrl)[0].load();
        mainVideo[0].play();
    }
}

// Cập nhật tên bài học
function updateLessonName(lessonName) {
    $('#main-lesson-name').text(lessonName);
}

// Cập nhật tài liệu đính kèm
function updateDocument(docUrl, docName) {
    const docButton = $('.doc-button');
    if (docButton.length && docUrl && docName) {
        docButton.attr('href', docUrl)
                 .html(`<i class="fas fa-file-alt"></i> ${docName}`)
                 .show();
    } else {
        docButton.hide();
    }
}

// Thông báo khi không có video
function showMissingVideoAlert(lessonName) {
    Swal.fire({
        icon: 'warning',
        title: 'Bài học chưa có video',
        text: `Bài "${lessonName}" hiện chưa được cập nhật video.`,
        confirmButtonText: 'Đã hiểu'
    });
}

