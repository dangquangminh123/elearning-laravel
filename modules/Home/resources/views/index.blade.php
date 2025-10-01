@extends('layouts.client')
@section('title', $pageTitle)

@section('content')

{{-- Banner --}}
<section class="banner">
    <div class="container padding">
        <div class="row">
            <div class="d-none d-md-block col-md-4 col-lg-3">
                <div class="banner-left">
                    @foreach($courseGroups as $group)
                        <div class="course-group pt-3">
                            <p class="{{ $group['class'] }}">{{ $group['type']->name }}</p>
                            <ul>
                                @foreach($group['courses'] as $course)
                                    <li>
                                        <a href="{{ route('courses.detail', ['slug' => $course->slug]) }}">
                                            {{ $course->name }}
                                        </a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('courses.index') }}">Xem thêm</a>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                      {{-- <div class="course-group">
                        <p>khoá học free</p>
                        <ul>
                            <li><a href="#">Học Family MEP cơ bản</a></li>
                            <li><a href="#">Học Revit MEP từ con số 0</a></li>
                            <li><a href="#">Nền tảng lập trình Dynamo</a></li>
                            <li><a href="#">Diễn họa Enscape trong Revit</a></li>
                            <li><a href="#">Xem thêm</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-6">
                <div class="banner-slider">
                    <div class="banner-slider-inner">
                        <img src="/clients/assets/slider1.png" alt="" />
                    </div>
                    <div class="banner-slider-inner">
                        <img src="/clients/assets/slider2.png" alt="" />
                    </div>
                    <div class="banner-slider-inner">
                        <img src="/clients/assets/slider3.png" alt="" />
                    </div>
                     <div class="banner-slider-inner">
                        <img src="/clients/assets/slider4.png" alt="" />
                    </div>
                    <div class="banner-slider-inner">
                        <img src="/clients/assets/slider5.png" alt="" />
                    </div>
                      <div class="banner-slider-inner">
                        <img src="/clients/assets/slider6.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-3">
                <div class="banner-right">
                    <div class="banner-right__img">
                        <img src="/clients/assets/banner1.png" alt="" />
                    </div>
                    <div class="banner-right__img">
                        <img src="/clients/assets/banner2.png" alt="" />
                    </div>
                    <div class="banner-right__img">
                        <img src="/clients/assets/banner3.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="banner-full">
                <img src="/clients/assets/banner-full.png" alt="" />
            </div>
        </div>
    </div>
</section>

{{-- icons services --}}
<section class="ft-services-section">
  <div class="ft-services-container">

    <div class="ft-service-item">
      <div class="ft-service-icon ft-icon-quality">
        <i class="fas fa-graduation-cap"></i>
      </div>
      <div class="ft-service-content">
        <h3 class="ft-title ft-title-quality">Khoá học chất lượng</h3>
        <p class="ft-description">Tất cả các khoá học được đánh giá và cập nhật thường xuyên.</p>
      </div>
    </div>

    <div class="ft-service-item">
      <div class="ft-service-icon ft-icon-support">
        <i class="fas fa-headset"></i>
      </div>
      <div class="ft-service-content">
        <h3 class="ft-title ft-title-support">Hỗ trợ 24/7</h3>
        <p class="ft-description">Đội ngũ hỗ trợ luôn sẵn sàng giải đáp thắc mắc của bạn.</p>
      </div>
    </div>

    <div class="ft-service-item">
      <div class="ft-service-icon ft-icon-anytime">
        <i class="fas fa-mobile-alt"></i>
      </div>
      <div class="ft-service-content">
        <h3 class="ft-title ft-title-anytime">Học mọi lúc, mọi nơi</h3>
        <p class="ft-description">Truy cập bài giảng trên mọi thiết bị, không giới hạn thời gian.</p>
      </div>
    </div>

    <div class="ft-service-item">
      <div class="ft-service-icon ft-icon-moneyback">
        <i class="fas fa-undo"></i>
      </div>
      <div class="ft-service-content">
        <h3 class="ft-title ft-title-moneyback">Hoàn tiền 7 ngày</h3>
        <p class="ft-description">Đảm bảo hài lòng với chính sách hoàn tiền trong 7 ngày.</p>
      </div>
    </div>

  </div>
</section>

{{-- Banner gallery sale off --}}
<section class="image-section">
    <div class="image-wrapper">
        <img src="/clients/assets/banner1.png" alt="Melty Cake">
        <div class="hover-overlay-1"></div>
        <div class="hover-overlay-2"></div>
    </div>

    <div class="image-wrapper">
        <img src="/clients/assets/banner2.png" alt="Juicy Cup">
        <div class="hover-overlay-1"></div>
        <div class="hover-overlay-2"></div>
    </div>
</section>

{{-- Services us --}}
<div class="container py-5">
    <header class="text-center mb-5">
            <p class="service-subtitle">CHÚNG TÔI LÀM GÌ?</p>
            <h1 class="service-title-main">DỊCH VỤ TỐT NHẤT MÀ CHÚNG TÔI CUNG CẤP</h1>
            <p class="service-description-main">
                Với nhiều năm kinh nghiệm trong lĩnh vực giáo dục trực tuyến, chúng tôi tự tin mang đến các giải pháp học tập toàn diện, từ phát triển nội dung, hệ thống quản lý học tập (LMS), đến ứng dụng công nghệ để nâng cao trải nghiệm người học.
            </p>
    </header>

    <section class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa-solid fa-desktop fa-2xl"></i>
                    </div>
                    <h3 class="service-card-title">Khóa Học Trực Tuyến</h3>
                    <p class="service-card-description">
                        Phát triển và cung cấp các khóa học đa dạng cho nhiều lĩnh vực, từ công nghệ thông tin, kinh doanh đến kỹ năng mềm, phù hợp với mọi đối tượng.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa-solid fa-book-open fa-2xl"></i>
                    </div>
                    <h3 class="service-card-title">Hệ Thống LMS</h3>
                    <p class="service-card-description">
                        Xây dựng và tùy chỉnh hệ thống quản lý học tập (LMS) mạnh mẽ, giúp theo dõi tiến độ, đánh giá và tương tác hiệu quả.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa-solid fa-mobile-screen-button fa-2xl"></i>
                    </div>
                    <h3 class="service-card-title">Ứng Dụng Học Tập</h3>
                    <p class="service-card-description">
                        Phát triển ứng dụng học tập trên nền tảng di động (iOS/Android) và web, cho phép học viên học mọi lúc, mọi nơi.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa-solid fa-users fa-2xl"></i>
                    </div>
                    <h3 class="service-card-title">Hệ Thống Tương Tác</h3>
                    <p class="service-card-description">
                        Cung cấp các giải pháp công nghệ để nâng cao tương tác giữa học viên và giảng viên, bao gồm phòng học ảo, diễn đàn và trò chuyện.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa-solid fa-robot fa-2xl"></i>
                    </div>
                    <h3 class="service-card-title">Tích Hợp AI & VR/AR</h3>
                    <p class="service-card-description">
                        Áp dụng công nghệ trí tuệ nhân tạo (AI) và thực tế ảo/tăng cường (VR/AR) vào các bài giảng, mang lại trải nghiệm học tập sinh động và trực quan.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-item">
                    <div class="icon">
                        <i class="fa-solid fa-chart-line fa-2xl"></i>
                    </div>
                    <h3 class="service-card-title">Tư Vấn & Triển Khai</h3>
                    <p class="service-card-description">
                        Cung cấp dịch vụ tư vấn chiến lược và hỗ trợ triển khai các giải pháp giáo dục trực tuyến, đảm bảo hiệu quả tối ưu cho tổ chức.
                    </p>
                </div>
            </div>
    </section>
</div>

{{-- Course promotion --}}
<div class="row g-0">
            <div class="col-12 col-lg-5 p-0 d-flex justify-content-center">
                <div class="promo-card">
                    <img src="{{ asset('/clients/assets/intro_course.png') }}" alt="Khuyến mãi khóa học" class="img-fluid promo-img">
                </div>
            </div>

            <div class="col-12 col-lg-7 p-0">
                <div class="content-wrapper">
                    <div class="main-title-group">
                        <p class="small-heading">KHÓA HỌC NỔI BẬT</p>
                        <h2 class="large-heading">CÔNG NGHỆ CHUYÊN SÂU</h2>
                    </div>

                    <div class="course-list">
                        <div class="course-item">
                            <div class="course-icon-container">
                                <img src="{{ asset('/clients/assets/avatar.png') }}" alt="Icon Laravel" class="course-thumb">
                            </div>
                            <div class="course-details">
                                <h3 class="course-title sparkling">Lập Trình Web với Laravel</h3>
                                <p class="course-description">Nắm vững framework PHP phổ biến nhất để xây dựng các ứng dụng web mạnh mẽ, hiệu quả và an toàn.</p>
                            </div>
                        </div>

                        <div class="course-item">
                            <div class="course-icon-container">
                                <img src="{{ asset('/clients/assets/avatar.png') }}" alt="Icon React" class="course-thumb">
                            </div>
                            <div class="course-details">
                                <h3 class="course-title sparkling">Phát Triển Ứng Dụng với React</h3>
                                <p class="course-description">Học cách tạo giao diện người dùng tương tác, hiệu suất cao bằng thư viện JavaScript hàng đầu hiện nay.</p>
                            </div>
                        </div>
                        
                        <div class="course-item">
                            <div class="course-icon-container">
                                <img src="{{ asset('/clients/assets/avatar.png') }}" alt="Icon Node.js" class="course-thumb">
                            </div>
                            <div class="course-details">
                                <h3 class="course-title sparkling">Phát Triển Backend với Node.js</h3>
                                <p class="course-description">Xây dựng các API mạnh mẽ và server-side applications với JavaScript, sử dụng framework Express.js.</p>
                            </div>
                        </div>
                    </div>

                    <a href="/khoa-hoc" class="btn view-all-btn">
                        XEM TOÀN BỘ KHOÁ HỌC <i class="fas fa-arrow-right icon-arrow"></i>
                    </a>
                </div>
            </div>
</div>

{{-- overview academy HEXAGON --}}
<section class="features-hero">
  <div class="wrap">
    <div class="hex-left">
      <div class="hex-ring" id="hexRing">
        <div class="hex-wrap hex-center-wrap">
          <div class="hex hex-center">
            <img src="/clients/assets/avatar.png" alt="center" />
          </div>
        </div>

        <div class="hex-wrap active-wrap">
          <button class="hex hex-item active" data-index="0" data-angle="270" aria-label="Theo dõi học tập">
            <i class="fa-solid fa-bell"></i>
            <span>Theo dõi học tập</span>
          </button>
        </div>

        <div class="hex-wrap">
          <button class="hex hex-item" data-index="1" data-angle="330" aria-label="E-learning">
            <i class="fa-solid fa-display"></i>
            <span>Hệ thống E-Learning</span>
          </button>
        </div>

        <div class="hex-wrap">
          <button class="hex hex-item" data-index="2" data-angle="30" aria-label="Hỗ trợ học tập">
            <i class="fa-solid fa-user-graduate"></i>
            <span>Hỗ trợ học tập</span>
          </button>
        </div>

        <div class="hex-wrap">
          <button class="hex hex-item" data-index="3" data-angle="90" aria-label="Dự án thực tế">
            <i class="fa-solid fa-file-code"></i>
            <span>Dự án thực tế</span>
          </button>
        </div>

        <div class="hex-wrap">
          <button class="hex hex-item" data-index="4" data-angle="150" aria-label="Kết nối việc làm">
            <i class="fa-solid fa-handshake"></i>
            <span>Kết nối việc làm</span>
          </button>
        </div>

        <div class="hex-wrap">
          <button class="hex hex-item" data-index="5" data-angle="210" aria-label="Thảo luận ngoài giờ">
            <i class="fa-solid fa-comments"></i>
            <span>Thảo luận ngoài giờ</span>
          </button>
        </div>
      </div>
    </div>

    <div class="feat-right">
      <div class="feat-content">
        <h2 id="featTitle">Dự án - bài tập thực tế</h2>
        <p id="featText">
          Hệ thống bài tập, dự án thực tế áp dụng vào từng buổi học. Ngay sau buổi học, học viên đã có thể code các phần của dự án, bài luyện tập chuyên sâu.
        </p>
      </div>

      <div class="feat-nav">
        <button class="nav-btn" id="prevBtn" aria-label="Previous">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button class="nav-btn" id="nextBtn" aria-label="Next">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </div>
</section>

{{-- List course and types --}}
@foreach($courseTypes as $type)
<section class="{{ course_section_class_by_name($type->name ?? null) }}">
    <div class="container padding">
        <x-course-type-badge :type="$type->name ?? null" />
        <div class="row">
            @forelse($coursesByType[$type->id] ?? [] as $course)
                <div class="col-12 col-lg-6">
                    <div class="d-flex course">
                        <div class="banner-course">
                            <span class="course-tag-wrap">
                                <span class="course-tag {{ course_type_class($type->name) }}">
                                    {!! course_type_icon($type->name) !!}
                                </span>
                            </span>
                            <img src="{{ $course->thumbnail ?? '/clients/assets/banner-course.png' }}" alt="{{ $course->name }}" />
                        </div>
                        <div class="descreption-course">
                            <div class="descreption-top">
                                <p><i class="fa-solid fa-clock"></i>{{ $course->durations ?? 'N/A' }}</p>
                                <p><i class="fa-solid fa-video"></i>{{ $course->lessons->count() }} bài</p>
                                <p><i class="fa-solid fa-eye"></i>{{ $course->orderDetail->count() }}</p>
                            </div>
                            <h5 class="descreption-title">
                                <a href="{{ route('courses.detail', ['slug' => $course->slug]) }}">
                                    {{ $course->name }}
                                </a>
                            </h5>
                            <div class="descreption-teacher">
                                <img src="{{ $course->teacher->image ?? '/clients/assets/course-teacher.png' }}" alt="{{ $course->teacher->name }}" />
                                <span>{{ $course->teacher->name }}</span>
                            </div>
                            <p class="descreption-price">
                                @if($course->sale_price)
                                    <span class="sale">{{ number_format($course->price, 0, ',', '.') }}đ</span>
                                    <span>{{ number_format($course->sale_price, 0, ',', '.') }}đ</span>
                                @else
                                    <span>{{ number_format($course->price, 0, ',', '.') }}đ</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                 <div class="col-12 col-lg-6">
                    <div class="d-flex course">
                        <div class="banner-course">
                            <span class="course-tag-wrap">
                                <span class="course-tag badge-course-default">
                                    <i class="fa-solid fa-circle-question" aria-hidden="true"></i>
                                </span>
                            </span>
                            <img src="/clients/assets/banner-course.png" alt="" />
                        </div>
                        <div class="descreption-course">
                            <div class="descreption-top">
                                <p><i class="fa-solid fa-clock"></i>1,5h học</p>
                                <p><i class="fa-solid fa-video"></i>4 phần/18 bài</p>
                                <p><i class="fa-solid fa-eye"></i>1000</p>
                            </div>
                            <h5 class="descreption-title">
                                <a href="#">
                                    Kiểm soát mô hình 3D ngay trên Điện thoại - Máy tính
                                </a>
                            </h5>
                            <div class="descreption-teacher">
                                <img src="/clients/assets/course-teacher.png" alt="" />
                                <span>Nguyễn Chí Ngọc</span>
                            </div>
                            <p class="descreption-price">
                                <span class="sale">400.000đ</span>
                                <span>200.000đ</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endforeach

{{-- Why choose Us --}}
<section class="question">
    <div class="container padding">
        <h3>vì sao nên học tại dscons</h3>
         <div class="row">
            <!-- Nhóm 1 -->
            <div class="col-12 col-lg-6">
                <div class="group">
                    <div class="group-icon icon-blue">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="group-title">
                        <p>Giảng viên chất lượng</p>
                        <ul>
                            <li>Đội ngũ giảng viên có chứng chỉ quốc tế</li>
                            <li>Trực tiếp hướng dẫn từng học viên</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Nhóm 2 -->
            <div class="col-12 col-lg-6">
                <div class="group">
                    <div class="group-icon icon-orange">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="group-title">
                        <p>Phương pháp học hiện đại</p>
                        <ul>
                            <li>Kết hợp học Offline & Zoom</li>
                            <li>Giáo trình cập nhật liên tục</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Nhóm 3 -->
            <div class="col-12 col-lg-6">
                <div class="group">
                    <div class="group-icon icon-green">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="group-title">
                        <p>Cộng đồng đông đảo</p>
                        <ul>
                            <li>Hơn 1000 học viên & 14 doanh nghiệp</li>
                            <li>Chia sẻ tài liệu, hỗ trợ sau khóa học</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Nhóm 4 -->
            <div class="col-12 col-lg-6">
                <div class="group">
                    <div class="group-icon icon-purple">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div class="group-title">
                        <p>Chứng chỉ uy tín</p>
                        <ul>
                            <li>Được công nhận bởi nhiều tổ chức</li>
                            <li>Hỗ trợ hồ sơ nghề nghiệp & việc làm</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Reviews us Academy --}}
<div class="container-fluid vh-100-row">
  <div class="row g-0 h-100">
    <!-- LEFT: carousel -->
    <div class="col-6 left-col d-flex align-items-center justify-content-center">
      <div id="fps" style="display:none">FPS</div>
      <div class="carousel-container" id="carouselContainer">
        <div class="scene" id="scene">
          <div id="carousel">
            <!-- sample items -->
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <figure class="carouselItem">
              <div class="carouselItemInner">
                <img class="student-photo" src="clients/assets/hoangan.jpg" alt="Học viên 1">
                <div class="student-name">Nguyễn Văn A</div>
                <i class="fa-solid fa-quote-left quote-icon"></i>
                <div class="star-rating">★★★★★</div>
                <div class="course-name">Khóa học: Lập trình Web</div>
                <div class="review-text">Khóa học rất tuyệt vời, giảng viên nhiệt tình, nội dung có nhiều ví dụ thực tế và bài tập thực hành.</div>
              </div>
            </figure>
            <!-- thêm nhiều item khác của bạn -->
          </div>
        </div>
      </div>
    </div>

    <div class="col-6 right-col d-flex flex-column justify-content-center align-items-center text-center">
      
      <!-- 1. Logo -->
      <div class="mb-4">
        <img class="logo-img" src="clients/assets/logo.png" alt="Logo">
      </div>

      <!-- 2. Tiêu đề -->
      <div class="section-title" style="">
        Cảm nhận học viên về Trung tâm
      </div>

      <!-- 3. Lời mô tả -->
      <p class="lead px-4 my-4" style="">
        Các khóa học trực tuyến chất lượng cao, giảng viên giàu kinh nghiệm, chương trình giảng dạy hiện đại và nội dung thực tiễn.
      </p>

      <!-- 4. Thông tin nổi bật (2x2) -->
      <div class="w-100 px-4">
        <div class="row g-0 text-center highlight-box">
          
          <!-- Ô 1 -->
          <div class="col-6">
            <div class="info-card">
              <div class="info-text">
                Đội ngũ hơn<br>
                <span class="info-number">11 NĂM</span><br>
                kinh nghiệm thực chiến
              </div>
            </div>
          </div>
          
          <div class="col-6">
            <div class="info-card">
              <div class="info-text">
                Hơn<br>
                <span class="info-number">50+</span><br>
                giảng viên chất lượng
              </div>
            </div>
          </div>
          
          <div class="col-6">
            <div class="info-card">
              <div class="info-text">
                Hợp tác với<br>
                <span class="info-number">200+</span><br>
                doanh nghiệp lớn
              </div>
            </div>
          </div>
          
          <div class="col-6">
            <div class="info-card">
              <div class="info-text">
                Vinh dự đạt<br>
                <span class="info-number">TOP 5</span><br>
                trung tâm trực tuyến
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

{{-- Roading map training --}}
<div class="main-container">
        <h1 class="main-title">LỘ TRÌNH ĐÀO TẠO TẠI DSMART</h1>
        <img class="background-image" src="/clients/assets/line_wavy.jpg" alt="Background Line">
        <div class="roadmap-container">
            <div class="roadmap-components-wrapper">
                <!-- Component 1: HTML/CSS -->
                <div class="component-group step-1">
                    <div class="step-circle">
                        <i class="fab fa-html5"></i>
                    </div>
                    <div class="step-label">
                        <div class="label-line"></div>
                        <span class="label-text">HTML / CSS</span>
                    </div>
                    <div class="step-description">
                        Nền tảng của phát triển web, tạo cấu trúc và kiểu dáng.
                    </div>
                </div>

                <!-- Component 2: JavaScript/Bootstrap -->
                <div class="component-group step-2">
                    <div class="step-description">
                        Thêm tính tương tác và thiết kế web responsive.
                    </div>
                    <div class="step-label">
                        <div class="label-line"></div>
                        <span class="label-text">JS / Bootstrap</span>
                    </div>
                    <div class="step-circle">
                        <i class="fab fa-js"></i>
                    </div>
                </div>

                <!-- Component 3: jQuery/AJAX -->
                <div class="component-group step-3">
                    <div class="step-circle">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <div class="step-label">
                        <div class="label-line"></div>
                        <span class="label-text">jQuery / AJAX</span>
                    </div>
                    <div class="step-description">
                        Đơn giản hóa việc xử lý kịch bản client-side và tải dữ liệu bất đồng bộ.
                    </div>
                </div>

                <!-- Component 4: PHP/Node.js -->
                <div class="component-group step-4">
                    <div class="step-description">
                        Phát triển logic phía máy chủ và back-end của ứng dụng web. Phát triển logic phía máy chủ và back-end của ứng dụng web.
                        Phát triển logic phía máy chủ và back-end của ứng dụng web.

                    </div>
                    <div class="step-label">
                        <div class="label-line"></div>
                        <span class="label-text">PHP / Node.js</span>
                    </div>
                    <div class="step-circle">
                        <i class="fab fa-php"></i>
                    </div>
                </div>

                <!-- Component 5: Laravel/Nest.js -->
                <div class="component-group step-5">
                    <div class="step-circle">
                        <i class="fab fa-laravel"></i>
                    </div>
                    <div class="step-label">
                        <div class="label-line"></div>
                        <span class="label-text">Laravel / Nest.js</span>
                    </div>
                    <div class="step-description">
                        Sử dụng các framework để xây dựng ứng dụng web mạnh mẽ, hiệu quả.
                    </div>
                </div>

                <!-- Component 6: Linux/DevOps -->
                <div class="component-group step-6">
                    <div class="step-description">
                        Triển khai và quản lý ứng dụng trên máy chủ, đảm bảo hoạt động trơn tru.
                    </div>
                    <div class="step-label">
                        <div class="label-line"></div>
                        <span class="label-text">Linux / DevOps</span>
                    </div>
                    <div class="step-circle">
                        <i class="fas fa-server"></i>
                    </div>
                </div>
            </div>
        </div>
</div>
    
{{-- Teacher overview --}}
<div class="flipbook-wrapper">
    <h2 class="flipbook-title">
        Giảng viên giảng dạy trực tiếp các môn tại DSCons
    </h2>

    <div class="turnjs-container">
        <div id="flipbook">
            <div class="hard"><img src="clients/assets/hoangan.jpg"></div>
            @php $page = 1; @endphp
            @foreach($teachersWithCourses as $item)
                {{-- Trang lẻ: giảng viên --}}
                <div>
                    <img src="{{ asset($item['teacher']->image ?? '/clients/assets/react.jpg') }}">
                    <span class="page-number">{{ $page }}</span>
                </div>
                @php $page++; @endphp

                {{-- Trang chẵn: khóa học hoặc mặc định --}}
                @php $course = $item['courses']->first(); @endphp
                <div>
                    @if($course)
                        <img src="{{ $course->thumbnail ?? 'clients/assets/react.jpg' }}">
                        <span class="page-number">{{ $page }}</span>
                    @else
                        <img src="{{ asset('clients/assets/react.jpg') }}">
                        <span class="page-number">{{ $page }}</span>
                    @endif
                </div>
                @php $page++; @endphp
            @endforeach
            <div class="hard"><img src="clients/assets/paper_last.jpg"></div>
        </div>
    </div>
</div>

{{-- programme circle --}}
<section class="features-circle">
  <div class="wrap">
    <div class="circle-left">
      <div class="circle-ring" id="circleRing">
        <div class="circle-ring-inner"></div>

        <div class="circle circle-center">
          <p id="centerText">
            Chương trình huấn luyện của 1HV được lên kế hoạch cân thân, chi tiết, nhằm từng bước xây dựng vững chắc các kỹ năng chuyên môn và phát triển nghề nghiệp dựa trên khả năng của mỗi HV. Mỗi HV luôn có một huấn luyện viên hỗ trợ và huấn luyện.
          </p>
        </div>
        
        <div class="circle-item-container" id="circleItemContainer">
          <button class="circle circle-item active" data-index="0">
            <i class="fa-solid fa-fire"></i>
          </button>
          <button class="circle circle-item" data-index="1">
            <i class="fa-solid fa-people-group"></i>
          </button>
          <button class="circle circle-item" data-index="2">
            <i class="fa-solid fa-briefcase"></i>
          </button>
          <button class="circle circle-item" data-index="3">
            <i class="fa-solid fa-chart-line"></i>
          </button>
          <button class="circle circle-item" data-index="4">
            <i class="fa-solid fa-chalkboard-user"></i>
          </button>
        </div>
        
      </div>
    </div>

    <div class="circle-right">
      <h2 id="featTitle">Cá nhân hóa</h2>
      <p id="featText">
        Chương trình huấn luyện của 1HV được lên kế hoạch cân thân, chi tiết, nhằm từng bước xây dựng vững chắc các kỹ năng chuyên môn và phát triển nghề nghiệp dựa trên khả năng của mỗi HV. Mỗi HV luôn có một huấn luyện viên hỗ trợ và huấn luyện.
      </p>
    </div>
  </div>
</section>

{{-- partner us --}}
<section class="partner">
  <div class="container">
    <h3>Đối tác doanh nghiệp chúng tôi đào tạo</h3>
    <div class="partner-slider center">
      <div class="partner-img">
        <img src="/clients/assets/partner.jpeg" alt="">
      </div>
      <div class="partner-img">
        <img src="/clients/assets/laravel_partner.png" alt="">
      </div>
      <div class="partner-img">
        <img src="/clients/assets/nodejs.png" alt="">
      </div>
    <div class="partner-img">
        <img src="/clients/assets/php_partner.png" alt="">
      </div>
      <div class="partner-img">
        <img src="/clients/assets/reactjs.png" alt="">
      </div>
     <div class="partner-img">
        <img src="/clients/assets/php_partner.png" alt="">
      </div>
      <div class="partner-img">
        <img src="/clients/assets/jquery_ui.png" alt="">
      </div>
      <div class="partner-img">
        <img src="/clients/assets/jquery.png" alt="">
      </div>
    </div>
  </div>
</section>

{{-- statistical --}}
<section class="progress-section">
    <div class="wrap">
        <div class="stat-item" data-percent="20" data-color="blue">
            <h4 class="progress-year">Tỷ Lệ Học Viên Có Việc</h4>
            <div class="half-doughnut-chart">
                <svg viewBox="0 0 200 100" class="chart-svg"></svg>
            </div>
            <div class="chart-content">
                <span class="percent">20%</span>
            </div>
            <p class="description">
                Hơn 98% học viên của chúng tôi đạt được việc làm ngay sau khi tốt nghiệp.
            </p>
        </div>
        <div class="stat-item" data-percent="40" data-color="green">
            <h4 class="progress-year">Học Viên Đã Tốt Nghiệp</h4>
            <div class="half-doughnut-chart">
                <svg viewBox="0 0 200 100" class="chart-svg"></svg>
            </div>
            <div class="chart-content">
                <span class="percent">40%</span>
            </div>
            <p class="description">
                Chúng tôi đã đào tạo thành công hơn 1500 học viên, giúp họ thành công trong sự nghiệp.
            </p>
        </div>
        <div class="stat-item" data-percent="60" data-color="orange">
            <h4 class="progress-year">Đối Tác Doanh Nghiệp</h4>
            <div class="half-doughnut-chart">
                <svg viewBox="0 0 200 100" class="chart-svg"></svg>
            </div>
            <div class="chart-content">
                <span class="percent">60%</span>
            </div>
            <p class="description">
                Liên kết với hơn 30 đối tác doanh nghiệp uy tín, cung cấp cơ hội việc làm tốt nhất.
            </p>
        </div>
        <div class="stat-item" data-percent="80" data-color="red">
            <h4 class="progress-year">Năm Thành Lập</h4>
            <div class="half-doughnut-chart">
                <svg viewBox="0 0 200 100" class="chart-svg"></svg>
            </div>
            <div class="chart-content">
                <span class="percent">80%</span>
            </div>
            <p class="description">
                Thành lập từ năm 2012, chúng tôi tự hào với hơn một thập kỷ kinh nghiệm trong ngành.
            </p>
        </div>
    </div>
</section>

{{-- bse block --}}
<div class="bse">
  <div class="wrap">
    <section class="copy">
      <p class="eyebrow">Liên hệ ngay</p>
      <h1 class="headline txt-grad-title">LIÊN HỆ TRỰC TIẾP VỚI CHÚNG TÔI</h1>
      <h3 class="subhead txt-grad-sub">Để được tư vấn miễn phí</h3>
      <p class="para txt-grad-body">
        Chúng tôi sẵn sàng hỗ trợ bạn tìm hiểu về các khóa học, dịch vụ và chương trình khuyến mãi của trung tâm.  
        Đội ngũ tư vấn sẽ giải đáp mọi thắc mắc và đưa ra lộ trình học tập phù hợp nhất.
      </p>
    </section>

    <section class="visual">
      <div class="tree">
        <div class="drop-top">
          <div class="drop-shape">
            <span class="drop-icon"><i class="fa-solid fa-headset"></i></span>
          </div>
        </div>

        <div class="rows">
          <div class="bse-row"></div>
          <div class="bse-row"></div>
          <div class="bse-row"></div>
          <div class="bse-row"></div>
        </div>

        <div class="phone-wire">
          <div class="phone-glow"></div>
          <div class="phone"></div>
          <div class="wire"></div>
        </div>
      </div>
    </section>
  </div>
</div>

<section class="about-us">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="text">
                    <a href="#">đi tới web site học online</a>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-3 mt-md-0">
                <div class="text">
                    <a href="#">đi tới fanpage facebook</a>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-md-12 mt-3 mt-lg-0">
                <div class="text">
                    <a href="#">đi tới kênh youtube dscons</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection