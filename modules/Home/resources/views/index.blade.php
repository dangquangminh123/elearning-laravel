@extends('layouts.client')
@section('title', $pageTitle)

@section('content')


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
                        <img src="/clients/assets/slider-1.jpeg" alt="" />
                    </div>
                    <div class="banner-slider-inner">
                        <img src="/clients/assets/slider-2.jpeg" alt="" />
                    </div>
                    <div class="banner-slider-inner">
                        <img src="/clients/assets/slider-3.jpeg" alt="" />
                    </div>
                </div>
            </div>
            <div class="d-none d-lg-block col-lg-3">
                <div class="banner-right">
                    <div class="banner-right__img">
                        <img src="/clients/assets/banner.png" alt="" />
                    </div>
                    <div class="banner-right__img">
                        <img src="/clients/assets/banner.png" alt="" />
                    </div>
                    <div class="banner-right__img">
                        <img src="/clients/assets/banner.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="banner-full">
                <img src="/clients/assets/banner-full.jpeg" alt="" />
            </div>
        </div>
    </div>
</section>

<section class="features-hero">
  <div class="wrap">
    <!-- LEFT: HEX RING -->
    <div class="hex-left">
      <div class="hex-ring" id="hexRing">
        <!-- Hex trung tâm (ảnh) -->
        <div class="hex hex-center">
          <img src="/clients/assets/slider-2.jpeg" alt="center" />
        </div>

        <!-- 6 hex xếp vòng tròn, data-angle (độ) để định vị -->
        <button class="hex hex-item active" data-index="0" data-angle="270" aria-label="Theo dõi học tập">
          <i class="fa-solid fa-bell"></i>
          <span>Theo dõi học tập</span>
        </button>

        <button class="hex hex-item" data-index="1" data-angle="330" aria-label="E-learning">
          <i class="fa-solid fa-display"></i>
          <span>Hệ thống E-Learning</span>
        </button>

        <button class="hex hex-item" data-index="2" data-angle="30" aria-label="Hỗ trợ học tập">
          <i class="fa-solid fa-user-graduate"></i>
          <span>Hỗ trợ học tập</span>
        </button>

        <button class="hex hex-item" data-index="3" data-angle="90" aria-label="Dự án thực tế">
          <i class="fa-solid fa-file-code"></i>
          <span>Dự án thực tế</span>
        </button>

        <button class="hex hex-item" data-index="4" data-angle="150" aria-label="Kết nối việc làm">
          <i class="fa-solid fa-handshake"></i>
          <span>Kết nối việc làm</span>
        </button>

        <button class="hex hex-item" data-index="5" data-angle="210" aria-label="Thảo luận ngoài giờ">
          <i class="fa-solid fa-comments"></i>
          <span>Thảo luận ngoài giờ</span>
        </button>
      </div>
    </div>

    <!-- RIGHT: CONTENT + NAV -->
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

@foreach($courseTypes as $type)
<section class="{{ course_section_class_by_name($type->name ?? null) }}">
    <div class="container padding">
        <x-course-type-badge :type="$type->name ?? null" />

        <div class="row">
            @forelse($coursesByType[$type->id] ?? [] as $course)
                <div class="col-12 col-lg-6">
                    <div class="d-flex course">
                        <div class="banner-course">
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

<section class="partner">
    <div class="container">
        <h3>Đối tác doanh nghiệp chúng tôi đào tạo</h3>
        <div class="row">
            <div class="col-6 col-lg-3">
                <div class="partner-img">
                    <img src="/clients/assets/partner.jpeg" alt="" />
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="partner-img">
                    <img src="/clients/assets/partner.jpeg" alt="" />
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="partner-img">
                    <img src="/clients/assets/partner.jpeg" alt="" />
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="partner-img">
                    <img src="/clients/assets/partner.jpeg" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>
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