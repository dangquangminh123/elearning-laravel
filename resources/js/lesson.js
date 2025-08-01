    document.querySelectorAll('.play-video').forEach(item => {
        item.addEventListener('click', function () {
            const videoUrl = this.getAttribute('data-video-url');
            const lessonName = this.getAttribute('data-lesson-name');
            const docUrl = this.getAttribute('data-doc-url');
            const docName = this.getAttribute('data-doc-name');

            const mainVideo = document.getElementById('main-video');
            const mainLessonName = document.getElementById('main-lesson-name');

            if (mainVideo && videoUrl) {
                mainVideo.src = videoUrl;
                mainVideo.load();
                mainVideo.play();
            }

            if (mainLessonName) {
                mainLessonName.textContent = lessonName;
            }

            const docButton = document.querySelector('.doc-button');
            if (docButton && docUrl && docName) {
                docButton.href = docUrl;
                docButton.innerHTML = `<i class="fas fa-file-alt"></i> ${docName}`;
                docButton.style.display = 'inline-block';
            } else if (docButton) {
                docButton.style.display = 'none';
            }
        });
    });
