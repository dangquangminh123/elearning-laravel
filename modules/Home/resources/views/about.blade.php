@extends('layouts.client')
@section('title', $pageTitle)

@section('content')
<div class="section-head">
    <svg class="logo-icon" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M32 6 2 20l30 14 24-11.2V40h6V20L32 6Z" fill="#7fd3ff"/>
      <path d="M8 28v10c0 6 11 12 24 12s24-6 24-12V26l-24 11-24-9Z" fill="#9aa8ff" opacity=".85"/>
    </svg>
    <h2>VỀ CHÚNG TÔI</h2>
</div>

<div class="features">
  <!-- 1. Giảng viên kinh nghiệm lâu năm -->
  <section class="feature">
    <div class="feature-inner">
      <div class="f-text">
        <h3>Giảng viên kinh nghiệm lâu năm</h3>
        <p>Đội ngũ giảng viên có trên 8–12 năm giảng dạy và triển khai dự án thực tế. Mỗi buổi học đều gắn với tình huống thật, code review chuẩn nghề, giúp học viên “học để làm” ngay từ tuần đầu.
            Một giảng viên kinh nghiệm lâu năm không chỉ là người truyền đạt kiến thức mà còn là người định hướng và truyền cảm hứng. Họ có khả năng biến những lý thuyết phức tạp thành những bài học dễ hiểu thông qua các ví dụ thực tế và câu chuyện cá nhân. Với sự am hiểu sâu sắc về chuyên môn, họ có thể giải đáp mọi thắc mắc, khơi gợi sự tò mò và khuyến khích sinh viên tư duy phản biện. Hơn thế nữa, họ còn là những người thầy tâm huyết, luôn sẵn lòng chia sẻ kinh nghiệm sống, hỗ trợ sinh viên vượt qua khó khăn và phát triển toàn diện cả về tri thức lẫn nhân cách.
             Sự tận tâm, uyên bác và nhân ái chính là những phẩm chất làm nên giá trị của một giảng viên gạo cội.
        </p>
      </div>
      <div class="f-media">
        <div class="media-card">
          <img src="clients/assets/hoangan.jpg" alt="Giảng viên nhiều kinh nghiệm">
        </div>
      </div>
    </div>
  </section>

  <!-- 2. Lộ trình đào tạo chuyên sâu -->
  <section class="feature">
    <div class="feature-inner">
      <div class="f-text">
        <h3>Lộ trình đào tạo chuyên sâu & chất lượng</h3>
        <p>Giáo trình chia module rõ ràng: nền tảng → chuyên sâu → dự án cuối khóa. Nội dung cập nhật theo nhu cầu doanh nghiệp, có checklist kỹ năng và rubric đánh giá minh bạch cho từng giai đoạn.</p>
      </div>
      <div class="f-media">
        <div class="media-card">
          <img src="clients/assets/traning.png" alt="Lộ trình chuyên sâu">
        </div>
      </div>
    </div>
  </section>

  <!-- 3. Tài liệu & bài giảng chi tiết -->
  <section class="feature">
    <div class="feature-inner">
      <div class="f-text">
        <h3>Tài liệu & bài giảng chi tiết, rõ ràng</h3>
        <p>Slide, code mẫu, bài tập và ghi hình mỗi buổi đều được cung cấp. Học viên có thể xem lại không giới hạn, kèm tài liệu tra cứu nhanh và bộ câu hỏi ôn tập sau chương.</p>
      </div>
      <div class="f-media">
        <div class="media-card">
          <img src="clients/assets/document.png" alt="Tài liệu chi tiết">
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Môi trường học tập & hỗ trợ nhiệt tình -->
  <section class="feature">
    <div class="feature-inner">
      <div class="f-text">
        <h3>Môi trường học tập tốt, hỗ trợ nhiệt tình</h3>
        <p>Lớp trực tuyến tương tác hai chiều, mentor trực ca hỗ trợ, group thảo luận 24/7. Mọi vướng mắc đều được giải đáp nhanh qua chat, call hoặc remote máy.</p>
      </div>
      <div class="f-media">
        <div class="media-card">
          <img src="clients/assets/environment.png" alt="Môi trường học tập tốt">
        </div>
      </div>
    </div>
  </section>

  <!-- 5. Chia sẻ phương pháp học hiệu quả -->
  <section class="feature">
    <div class="feature-inner">
      <div class="f-text">
        <h3>Chia sẻ phương pháp học & tiếp thu hiệu quả</h3>
        <p>Áp dụng phương pháp Pomodoro, Spaced Repetition, kỹ thuật note Zettelkasten và checklist “before/after class” giúp tăng tốc độ tiếp thu và ghi nhớ dài hạn.</p>
      </div>
      <div class="f-media">
        <div class="media-card">
          <img src="clients/assets/share.png" alt="Phương pháp học hiệu quả">
        </div>
      </div>
    </div>
  </section>

  <!-- 6. Cam kết chuẩn đầu ra -->
  <section class="feature">
    <div class="feature-inner">
      <div class="f-text">
        <h3>Cam kết chuẩn đầu ra phù hợp doanh nghiệp</h3>
        <p>Hoàn thành khóa học, học viên đạt chuẩn kỹ năng đầu ra theo JD thực tế: portfolio dự án, phỏng vấn thử cùng mentor, kết nối doanh nghiệp & hỗ trợ CV/LinkedIn đến khi nhận việc.</p>
      </div>
      <div class="f-media">
        <div class="media-card">
          <img src="clients/assets/commitment.png" alt="Chuẩn đầu ra doanh nghiệp">
        </div>
      </div>
    </div>
  </section>
</div>

<div class="core-title text-center">
  Giá trị cốt lõi của chúng tôi!
</div>

<div class="container my-5 tab-section">
    <div class="row mb-3">
      <div class="col-12">
          <div class="tabs d-flex">
              <button class="tab active flex-fill p-1" data-tab="tab1">
                  <i class="fa-solid fa-graduation-cap me-2"></i> Chất lượng giảng dạy
              </button>
              <button class="tab flex-fill p-1" data-tab="tab2">
                  <i class="fa-solid fa-laptop-code me-2"></i> Nền tảng học tập hiện đại
              </button>
              <button class="tab flex-fill p-1" data-tab="tab3">
                  <i class="fa-solid fa-chalkboard-teacher me-2"></i> Giảng viên chuyên nghiệp
              </button>
              <button class="tab flex-fill p-1" data-tab="tab4">
                  <i class="fa-solid fa-award me-2"></i> Cam kết thành tựu
              </button>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 tab-content p-4">
        <div id="tab1" class="content active">
          <h3 class="mb-3">Chất lượng giảng dạy</h3>
          <p class="mb-3">Chúng tôi mang đến chương trình học chuẩn quốc tế, nội dung luôn được cập nhật, phương pháp giảng dạy khoa học và dễ hiểu.</p>
          <ul class="mb-0">
            <li>Bài giảng được biên soạn bởi chuyên gia.</li>
            <li>Nội dung đa dạng, từ cơ bản đến nâng cao.</li>
            <li>Tích hợp bài tập thực hành liên tục.</li>
          </ul>
        </div>

        <div id="tab2" class="content">
          <h3 class="mb-3">Nền tảng học tập hiện đại</h3>
          <p>Giao diện học trực tuyến thân thiện, học mọi lúc mọi nơi, theo dõi tiến độ và kết quả ngay trên hệ thống.</p>
        </div>

        <div id="tab3" class="content">
          <h3 class="mb-3">Đội ngũ giảng viên chuyên nghiệp</h3>
          <p>Được đào tạo bài bản, nhiều kinh nghiệm thực tiễn, luôn đồng hành cùng học viên trong suốt khóa học.</p>
        </div>

        <div id="tab4" class="content">
          <h3 class="mb-3">Cam kết thành tựu học viên</h3>
          <p>Chúng tôi đảm bảo chất lượng đầu ra, hỗ trợ định hướng nghề nghiệp, và cấp chứng chỉ có giá trị.</p>
        </div>
      </div>
    </div>
</div>

<div class="container d-flex justify-content-center align-items-center py-5">
    <div class="card p-0 border-0 rounded-4">
        <div class="row g-0">
            <div class="col-lg-6 col-12 d-flex justify-content-center align-items-center position-relative hero-image-section">
                <div class="hero-shape-1"></div>
                <div class="hero-shape-2"></div>
                <img src="clients/assets/laravel.png" class="img-fluid rounded-start z-3" alt="DSCons student">
            </div>

            <div class="col-lg-6 col-12 d-flex flex-column justify-content-center p-5 hero-content-section">
                <div class="mb-4">
                    <h2 class="fw-bold display-6 text-dark">Nên học DSCons hay không</h2>
                    <h4 class="text-orange fw-normal mt-2">Tiện lợi và hiệu quả</h4>
                </div>
                
                <div class="item-list">
                    <div class="d-flex align-items-start mb-4">
                        <div class="item-icon flex-shrink-0 me-3">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="item-content flex-grow-1">
                            <h3 class="h5 fw-bold mb-1">Tiện lợi</h3>
                            <p class="text-secondary mb-0">Học trực tuyến mọi lúc, mọi nơi, không cần đến lớp, tiết kiệm thời gian di chuyển.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="item-icon flex-shrink-0 me-3">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="item-content flex-grow-1">
                            <h3 class="h5 fw-bold mb-1">Hiệu quả</h3>
                            <p class="text-secondary mb-0">Chương trình học được thiết kế tối ưu, đội ngũ giảng viên chuyên nghiệp, đảm bảo đầu ra chất lượng.</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="item-icon flex-shrink-0 me-3">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="item-content flex-grow-1">
                            <h3 class="h5 fw-bold mb-1">Cộng đồng</h3>
                            <p class="text-secondary mb-0">Hỗ trợ học tập 24/7, tham gia vào cộng đồng học viên năng động, cùng nhau phát triển.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container contact-section">
    <div class="row">
      <!-- Bên trái: Form liên hệ -->
      <div class="col-lg-9 col-md-8">
        <h2>Liên hệ với chúng tôi</h2>
        <p class="subtitle">Địa chỉ email của bạn sẽ không được công khai. Các trường bắt buộc được đánh dấu *</p>
        <form class="contact-form">
          <input type="text" class="form-control" placeholder="Họ và tên *" required>
          <input type="email" class="form-control" placeholder="Địa chỉ email *" required>
          <textarea class="form-control" rows="5" placeholder="Nội dung tin nhắn *" required></textarea>
          <button type="submit">
            Gửi tin nhắn →
          </button>
        </form>
      </div>

      <!-- Bên phải: Thông tin liên hệ -->
      <div class="col-lg-3 col-md-4">
        <div class="info-box">
          <div class="info-box-icon">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <div>
            <h5>Liên hệ</h5>
            <p>Gọi ngay: +(406) 555-0120</p>
            <p>Email: support@example.com</p>
          </div>
        </div>
        <div class="info-box">
          <div class="info-box-icon">
            <i class="fa-solid fa-clock"></i>
          </div>
          <div>
            <h5>Giờ làm việc</h5>
            <p>Thứ 2 - Thứ 7: 7:00 - 20:00</p>
            <p>Chủ nhật: 8:00 - 18:00</p>
          </div>
        </div>
        <div class="info-box">
          <div class="info-box-icon">
            <i class="fa-solid fa-location-dot"></i>
          </div>
          <div>
            <h5>Văn phòng</h5>
            <p>9c9 Trần Quốc Hoàn<br>Cầu Giấy Hà Nội</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection