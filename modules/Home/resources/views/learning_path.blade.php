@extends('layouts.client')
@section('title', $pageTitle)

@section('content')
<div class="roadmap container my-4">
    <div class="roadmap-title">Tiến trình đào tạo của chúng tôi</div>

   <div class="roadmap-row">
      <div class="roadmap-item q1">
        <div class="roadmap-circle">Bước 1</div>
        <div class="roadmap-box">
          <span class="left-stripe" aria-hidden="true">
            <span class="fold-top"></span>
            <span class="bar-top"></span>
            <span class="fold-bottom"></span>
            <span class="bar-bottom"></span>
          </span>

          <div class="box-inner">
            <div class="icon"><i class="fa-brands fa-html5"></i></div>
            <h5>HTML & CSS</h5>
            <div class="spotlight" aria-hidden="true"></div>
            <p class="desc">Bắt đầu với những kiến thức nền tảng về HTML và CSS để xây dựng giao diện website, làm quen với các thẻ và kiểu dáng cơ bản.</p>
          </div>
        </div>
      </div>

      <div class="roadmap-item q2">
        <div class="roadmap-circle">Bước 2</div>
        <div class="roadmap-box">
          <span class="left-stripe" aria-hidden="true">
            <span class="fold-top"></span>
            <span class="bar-top"></span>
            <span class="fold-bottom"></span>
            <span class="bar-bottom"></span>
          </span>

          <div class="box-inner">
            <div class="icon"><i class="fa-brands fa-js"></i></div>
            <h5>JS & jQuery</h5>
            <div class="spotlight" aria-hidden="true"></div>
            <p class="desc">Học cách tạo các hiệu ứng động, tương tác người dùng với JavaScript và jQuery, giúp trang web trở nên sống động và linh hoạt hơn.</p>
          </div>
        </div>
      </div>

      <div class="roadmap-item q3">
        <div class="roadmap-circle">Bước 3</div>
        <div class="roadmap-box">
          <span class="left-stripe" aria-hidden="true">
            <span class="fold-top"></span>
            <span class="bar-top"></span>
            <span class="fold-bottom"></span>
            <span class="bar-bottom"></span>
          </span>

          <div class="box-inner">
            <div class="icon"><i class="fa-brands fa-php"></i></div>
            <h5>PHP & AJAX</h5>
            <div class="spotlight" aria-hidden="true"></div>
            <p class="desc">Phát triển các ứng dụng web động bằng PHP và xử lý dữ liệu không đồng bộ với AJAX, giúp tạo ra các trang web có tính năng mạnh mẽ hơn.</p>
          </div>
        </div>
      </div>

      <div class="roadmap-item q4">
        <div class="roadmap-circle">Bước 4</div>
        <div class="roadmap-box">
          <span class="left-stripe" aria-hidden="true">
            <span class="fold-top"></span>
            <span class="bar-top"></span>
            <span class="fold-bottom"></span>
            <span class="bar-bottom"></span>
          </span>

          <div class="box-inner">
            <div class="icon"><i class="fa-brands fa-react"></i></div>
            <h5>ReactJS & Laravel</h5>
            <div class="spotlight" aria-hidden="true"></div>
            <p class="desc">Đi sâu vào các framework hiện đại như ReactJS và Laravel để xây dựng các ứng dụng một trang (SPA) và hệ thống backend vững chắc.</p>
          </div>
        </div>
      </div>

      <div class="roadmap-item q5">
        <div class="roadmap-circle">Bước 5</div>
        <div class="roadmap-box">
          <span class="left-stripe" aria-hidden="true">
            <span class="fold-top"></span>
            <span class="bar-top"></span>
            <span class="fold-bottom"></span>
            <span class="bar-bottom"></span>
          </span>

          <div class="box-inner">
            <div class="icon"><i class="fa-brands fa-linux"></i></div>
            <h5>Deploy & Linux</h5>
            <div class="spotlight" aria-hidden="true"></div>
            <p class="desc">Tìm hiểu cách triển khai ứng dụng lên server Linux, quản lý môi trường và đưa sản phẩm của bạn đến với người dùng thực tế.</p>
          </div>
        </div>
      </div>

    </div>
</div>

<div class="container my-5">
    <h2 class="section_title">CÁCH THỨC GIẢNG DẠY CỦA CHÚNG TÔI</h2>
    <div class="row align-items-center">
        <div class="col-12 col-lg-8">
            <div class="row card-grid">
                <div class="col-12 col-sm-6 mb-4">
                    <div class="method_item method-1">
                        <div class="icon_wrapper"><i class="fa-solid fa-graduation-cap"></i></div>
                        <div class="card_method">
                            <h4>Phương pháp hiệu quả</h4>
                            <p>Đội ngũ giảng viên áp dụng các phương pháp giảng dạy hiện đại, tập trung vào thực hành và giải quyết vấn đề thực tế, giúp học viên tiếp thu kiến thức nhanh chóng.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-4">
                    <div class="method_item method-2">
                        <div class="icon_wrapper"><i class="fa-solid fa-lightbulb"></i></div>
                        <div class="card_method">
                            <h4>Cá nhân hóa lộ trình</h4>
                            <p>Mỗi học viên được xây dựng một lộ trình học tập riêng biệt, phù hợp với năng lực và mục tiêu cá nhân, đảm bảo tiến bộ vững chắc sau mỗi buổi học.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-4">
                    <div class="method_item method-3">
                        <div class="icon_wrapper"><i class="fa-solid fa-people-group"></i></div>
                        <div class="card_method">
                            <h4>Hỗ trợ 1-1 chuyên sâu</h4>
                            <p>Giảng viên luôn sẵn sàng hỗ trợ, giải đáp thắc mắc và đưa ra phản hồi chi tiết cho từng bài tập, giúp học viên không gặp khó khăn trong quá trình tự học.</p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 mb-4">
                    <div class="method_item method-4">
                        <div class="icon_wrapper"><i class="fa-solid fa-clipboard-check"></i></div>
                        <div class="card_method">
                            <h4>Kiểm tra đánh giá toàn diện</h4>
                            <p>Học viên được tham gia các buổi kiểm tra, đánh giá định kỳ để đo lường mức độ tiếp thu, từ đó giảng viên có thể điều chỉnh phương pháp dạy phù hợp.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4 teacher-col">
            <div class="learning-teacher">
                <img src="clients/assets/giangvien.png" alt="Giáo viên đang làm việc" class="img-fluid teacher-image">
            </div>
        </div>
    </div>
</div>

<div class="erp-wrap">
  <!-- TITLE -->
  <h1 class="erp-title">TÂM HUYẾT & KIM CHỈ NAM GIẢNG VIÊN DS CONS</h1>

  <!-- CHART -->
  <svg id="erp-chart" viewBox="0 0 1100 850" role="img" aria-label="Half doughnut">
    <defs>
      <!-- gradients -->
      <linearGradient id="g0" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#fbc02d"/><stop offset="100%" stop-color="#f57c00"/>
      </linearGradient>
      <linearGradient id="g1" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#9575cd"/><stop offset="100%" stop-color="#5e35b1"/>
      </linearGradient>
      <linearGradient id="g2" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#66bb6a"/><stop offset="100%" stop-color="#2e7d32"/>
      </linearGradient>
      <linearGradient id="g3" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#42a5f5"/><stop offset="100%" stop-color="#1565c0"/>
      </linearGradient>
      <linearGradient id="g4" x1="0%" y1="0%" x2="100%" y2="0%">
        <stop offset="0%" stop-color="#f48fb1"/><stop offset="100%" stop-color="#ad1457"/>
      </linearGradient>
      <linearGradient id="centerGrad" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#f57c00"/>
        <stop offset="20%" stop-color="#5e35b1"/>
        <stop offset="40%" stop-color="#2e7d32"/>
        <stop offset="60%" stop-color="#1565c0"/>
        <stop offset="100%" stop-color="#ad1457"/>
      </linearGradient>
    </defs>

    <!-- layers -->
    <g id="erp-arcLayer"></g>
    <g id="erp-linkLayer"></g>
    <g id="erp-nodeLayer"></g>
    <g id="erp-centerLayer"></g>
  </svg>
</div>

@endsection