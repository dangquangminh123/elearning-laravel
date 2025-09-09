@extends('layouts.client')
@section('title', $pageTitle)

@section('content')

<div class="container py-5">
    <h2 class="recruit-title">Gia Nhập Đội Ngũ Giảng Viên Cùng Chúng Tôi</h2>

    <!-- HÀNG TRÊN (3 item) -->
    <div class="row">
      <div class="col-md-4 position-relative top-item">
       <div class="benefit-item">
          <div class="benefit-icon">
            <span class="icon-inner"><i class="fa-solid fa-chalkboard-user"></i></span>
          </div>
          <div class="benefit-content">
            <div class="benefit-title">Môi trường giảng dạy chuyên nghiệp</div>
            <div class="benefit-desc">Không gian lớp và hệ thống e-learning hiện đại, hỗ trợ giảng dạy online & offline hiệu quả.</div>
          </div>
        </div>
        <div class="connector" aria-hidden="true"></div>
      </div>

      <div class="col-md-4 position-relative top-item">
        <div class="benefit-item">
          <div class="benefit-icon">
            <span class="icon-inner"><i class="fa-solid fa-users"></i></span>
          </div>
           <div class="benefit-content">
            <div class="benefit-title">Mạng lưới chuyên gia & đồng nghiệp</div>
            <div class="benefit-desc">Làm việc cùng các giảng viên đầu ngành, kết nối doanh nghiệp — mở rộng cơ hội hợp tác.</div>
          </div>
        </div>
        <div class="connector" aria-hidden="true"></div>
      </div>

      <div class="col-md-4 position-relative top-item">
        <div class="benefit-item">
          <div class="benefit-icon">
            <span class="icon-inner"><i class="fa-solid fa-graduation-cap"></i></span>
          </div>
          <div class="benefit-content">
            <div class="benefit-title">Phát triển chuyên môn liên tục</div>
            <div class="benefit-desc">Đào tạo nội bộ, hội thảo chuyên đề và hỗ trợ nghiên cứu để nâng cao năng lực giảng dạy.</div>
          </div>
        </div>
        <div class="connector" aria-hidden="true"></div>
      </div>
    </div>

    <!-- HÀNG DƯỚI (3 item tương ứng) -->
    <div class="row mt-4">
      <div class="col-md-4 position-relative bottom-item">
        <div class="benefit-item">
          <div class="benefit-icon">
            <span class="icon-inner"><i class="fa-solid fa-book-open"></i></span>
          </div>
           <div class="benefit-content">
            <div class="benefit-title">Tham gia xây dựng chương trình</div>
            <div class="benefit-desc">Đồng thiết kế giáo trình thực tiễn, đóng góp vào chương trình đào tạo chất lượng cao.</div>
          </div>
        </div>
      </div>

      <div class="col-md-4 position-relative bottom-item">
        <div class="benefit-item">
          <div class="benefit-icon">
            <span class="icon-inner"><i class="fa-solid fa-briefcase"></i></span>
          </div>
          <div class="benefit-content">
            <div class="benefit-title">Chế độ đãi ngộ cạnh tranh</div>
            <div class="benefit-desc">Lương, thưởng và phúc lợi rõ ràng; hỗ trợ chi phí nghiên cứu & tham dự hội thảo.</div>
          </div>
        </div>
      </div>

      <div class="col-md-4 position-relative bottom-item">
        <div class="benefit-item">
          <div class="benefit-icon">
            <span class="icon-inner"><i class="fa-solid fa-lightbulb"></i></span>
          </div>
          <div class="benefit-content">
            <div class="benefit-title">Khuyến khích sáng tạo giảng dạy</div>
            <div class="benefit-desc">Tự do thử nghiệm phương pháp mới, được hỗ trợ để chuyển đổi ý tưởng thành khoá học.</div>
          </div>
        </div>
      </div>
    </div>
</div>

<section class="vin-section">
  <div class="vin-left">
    <div class="lead-icon"><i class="fa-solid fa-gear"></i></div>
    <h1>Không ngừng nỗ lực!<br>Chinh phục đỉnh cao!</h1>
    <p>Để biến những điều không thể thành có thể, Trung tâm R&amp;D của VINATech không ngừng nỗ lực tiến về phía trước với ý chí mạnh mẽ và niềm tin vững chắc.</p>
  </div>

  <div class="vin-right">

    <!-- 1 card (copy 4 lần nếu cần) -->
     <div class="card-item box">
      <div class="card-content">
        <div class="card-title">
          <h3>Mạng lưới toàn cầu</h3>
          <div class="icon-box"><i class="fa-solid fa-globe"></i></div>
        </div>
        <p class="card-body">Những bước chân của VINATech trải dài khắp thế giới.</p>
      </div>

   
        <div class="bnt-more">
          <a href="#">
            <span>More</span>
          </a>
      
      </div>
    </div>

    <div class="card-item box">
      <div class="card-content">
        <div class="card-title">
          <h3>Mạng lưới toàn cầu</h3>
          <div class="icon-box"><i class="fa-solid fa-globe"></i></div>
        </div>
        <p class="card-body">Những bước chân của VINATech trải dài khắp thế giới.</p>
      </div>

   
        <div class="bnt-more">
          <a href="#">
            <span>More</span>
          </a>
        </div>
    </div>

    <div class="card-item box">
      <div class="card-content">
        <div class="card-title">
          <h3>Mạng lưới toàn cầu</h3>
          <div class="icon-box"><i class="fa-solid fa-globe"></i></div>
        </div>
        <p class="card-body">Những bước chân của VINATech trải dài khắp thế giới.</p>
      </div>

   
        <div class="bnt-more">
          <a href="#">
            <span>More</span>
          </a>
        </div>
    </div>
  </div>
</section>

<div class="steps-wrap" id="stepsWrap">
  <h2 class="steps-main-title">Chính sách và Quy trình Tuyển dụng Giảng viên</h2>

  <div class="step-card">
    <div class="step-card-num">1</div>
    <div class="step-card-fold"><div class="step-card-title">Tìm kiếm ứng viên</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Mô tả công việc (JD) hấp dẫn: Rõ ràng về nhiệm vụ, yêu cầu và quyền lợi.</li>
        <li class="step-card-item">Đăng tuyển trên các kênh tuyển dụng chính: website, TopCV, CareerBuilder.</li>
        <li class="step-card-item">Nội bộ: giới thiệu từ nhân viên.</li>
      </ul>
    </div>
  </div>

  <div class="step-card">
    <div class="step-card-num">2</div>
    <div class="step-card-fold"><div class="step-card-title">Sàng lọc hồ sơ</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Lọc hồ sơ theo tiêu chí: kinh nghiệm, kỹ năng, văn hóa công ty.</li>
        <li class="step-card-item">Chia nhóm: tiềm năng, phù hợp, không phù hợp.</li>
      </ul>
    </div>
  </div>

  <div class="step-card">
    <div class="step-card-num">3</div>
    <div class="step-card-fold"><div class="step-card-title">Liên hệ</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Ứng viên phù hợp nhận email mời tham gia phỏng vấn.</li>
        <li class="step-card-item">Email gồm: thời gian, địa điểm/hình thức (trực tiếp/online).</li>
        <li class="step-card-item">Ứng viên phản hồi xác nhận lịch hẹn.</li>
      </ul>
    </div>
  </div>

  <div class="step-card">
    <div class="step-card-num">4</div>
    <div class="step-card-fold"><div class="step-card-title">Phỏng vấn</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Vòng 1: phỏng vấn sơ bộ (HR + trưởng bộ phận): kiểm tra kinh nghiệm, kỹ năng mềm.</li>
        <li class="step-card-item">Vòng 2 (nếu cần): phỏng vấn lãnh đạo, đánh giá phù hợp dài hạn.</li>
      </ul>
    </div>
  </div>

    <div class="step-card">
    <div class="step-card-num">5</div>
    <div class="step-card-fold"><div class="step-card-title">Phỏng vấn</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Vòng 1: phỏng vấn sơ bộ (HR + trưởng bộ phận): kiểm tra kinh nghiệm, kỹ năng mềm.</li>
        <li class="step-card-item">Vòng 2 (nếu cần): phỏng vấn lãnh đạo, đánh giá phù hợp dài hạn.</li>
      </ul>
    </div>
  </div>

    <div class="step-card">
    <div class="step-card-num">6</div>
    <div class="step-card-fold"><div class="step-card-title">Phỏng vấn</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Vòng 1: phỏng vấn sơ bộ (HR + trưởng bộ phận): kiểm tra kinh nghiệm, kỹ năng mềm.</li>
        <li class="step-card-item">Vòng 2 (nếu cần): phỏng vấn lãnh đạo, đánh giá phù hợp dài hạn.</li>
      </ul>
    </div>
  </div>

    <div class="step-card">
    <div class="step-card-num">7</div>
    <div class="step-card-fold"><div class="step-card-title">Phỏng vấn</div></div>
    <div class="step-card-body">
      <ul class="step-card-list">
        <li class="step-card-item">Vòng 1: phỏng vấn sơ bộ (HR + trưởng bộ phận): kiểm tra kinh nghiệm, kỹ năng mềm.</li>
        <li class="step-card-item">Vòng 2 (nếu cần): phỏng vấn lãnh đạo, đánh giá phù hợp dài hạn.</li>
      </ul>
    </div>
  </div>
</div>

<div class="custom-wrapper">
  <!-- TIÊU ĐỀ + MÔ TẢ -->
  <div class="custom-header text-center">
    <h2 class="custom-title">Chính Sách & Lộ Trình Giảng Dạy tại DSCons</h2>
    <p class="custom-desc">
      Tại DSCons, chúng tôi xây dựng môi trường giảng dạy chuyên nghiệp, mang lại thu nhập bền vững
      và hỗ trợ giảng viên phát triển sự nghiệp dài lâu trong lĩnh vực đào tạo trực tuyến.
    </p>
  </div>

  <div class="row align-items-center no-gutters">
    <!-- LEFT -->
    <div class="col-md-5 custom-left">
      <div class="custom-circle-wrap">
        <div class="custom-circle-bg">
          <img src="clients/assets/hoangan.jpg" alt="Giảng viên" class="custom-teacher-img">
        </div>
      </div>
    </div>

    <!-- RIGHT -->
    <div class="col-md-7 custom-right">
      <svg class="custom-curve-svg" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"></svg>

      <!-- Items -->
      <div class="custom-item custom-item1">
        <div class="custom-icon"><i class="fas fa-hand-holding-usd"></i></div>
        <div class="custom-content">
          <h3>Thu nhập ổn định</h3>
          <p>Chính sách chia sẻ doanh thu minh bạch, giúp giảng viên yên tâm gắn bó lâu dài.</p>
        </div>
      </div>

      <div class="custom-item custom-item2">
        <div class="custom-icon"><i class="fas fa-route"></i></div>
        <div class="custom-content">
          <h3>Lộ trình phát triển</h3>
          <p>Từ giảng viên mới → giảng viên chính → trưởng nhóm đào tạo, DSCons hỗ trợ từng bước.</p>
        </div>
      </div>

      <div class="custom-item custom-item3">
        <div class="custom-icon"><i class="fas fa-chalkboard-teacher"></i></div>
        <div class="custom-content">
          <h3>Cơ hội đào tạo</h3>
          <p>Tham gia workshop, tập huấn kỹ năng, nâng cao chuyên môn định kỳ.</p>
        </div>
      </div>

      <div class="custom-item custom-item4">
        <div class="custom-icon"><i class="fas fa-users"></i></div>
        <div class="custom-content">
          <h3>Cộng đồng giảng viên</h3>
          <p>Kết nối cùng hàng trăm đồng nghiệp, chia sẻ kinh nghiệm và mở rộng mối quan hệ.</p>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection