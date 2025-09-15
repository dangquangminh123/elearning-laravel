@extends('layouts.client')
@section('title', $pageTitle)

@section('content')
<div class="intro-savista">
  <div class="intro-grid">
    <!-- Trái trên -->
    <article class="intro-card">
      <div class="intro-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
      <h3 class="intro-card__title">Tầm nhìn</h3>
      <p class="intro-card__desc">
        Trở thành trung tâm đào tạo lập trình trực tuyến <b>thực chiến</b> hàng đầu,
        kết nối <b>học viên – dự án – doanh nghiệp</b>.
      </p>
    </article>

    <!-- Phải: Sứ mệnh + Accordion (chiếm 2 hàng) -->
    <article class="intro-card intro-card--right">
      <div class="intro-card__icon"><i class="fa-solid fa-atom"></i></div>
      <h3 class="intro-card__title">Sứ mệnh</h3>

      <div class="intro-acc">
        <!-- Tab 1 (mặc định mở) -->
        <div class="acc-item is-open">
          <button class="acc-head" type="button">
            <span>Kiến thức nền tảng & tư duy</span>
            <i class="fa-solid fa-chevron-down chev"></i>
          </button>
          <div class="acc-panel" style="display:block;">
            <ul>
              <li>Cấu trúc dữ liệu – giải thuật đủ dùng cho dự án.</li>
              <li>Git/GitHub workflow: branch, PR, review, release.</li>
              <li>Linux cơ bản, CLI, VS Code, debug, quy ước code.</li>
            </ul>
          </div>
        </div>

        <!-- Tab 2 -->
        <div class="acc-item">
          <button class="acc-head" type="button">
            <span>Frontend thực chiến</span>
            <i class="fa-solid fa-chevron-right chev"></i>
          </button>
          <div class="acc-panel">
            <ul>
              <li>HTML5/CSS3/Responsive; BEM, Flex/Grid.</li>
              <li>JavaScript ES6+, TypeScript; Async/Fetch.</li>
              <li>React/Vue cơ bản, Router, State management.</li>
              <li>UX pattern, A11y, tối ưu hiệu năng.</li>
            </ul>
          </div>
        </div>

        <!-- Tab 3 -->
        <div class="acc-item">
          <button class="acc-head" type="button">
            <span>Backend & RESTful API</span>
            <i class="fa-solid fa-chevron-right chev"></i>
          </button>
          <div class="acc-panel">
            <ul>
              <li>Node.js/Express hoặc PHP/Laravel theo hướng dự án.</li>
              <li>Thiết kế API, JWT/OAuth, rate limit, logging.</li>
              <li>Queue/Job, cache, upload, email, background tasks.</li>
            </ul>
          </div>
        </div>

        <!-- Tab 4 -->
        <div class="acc-item">
          <button class="acc-head" type="button">
            <span>Cơ sở dữ liệu</span>
            <i class="fa-solid fa-chevron-right chev"></i>
          </button>
          <div class="acc-panel">
            <ul>
              <li>MySQL/PostgreSQL: mô hình hoá, index, tối ưu truy vấn.</li>
              <li>ORM/Query Builder, migration, transaction.</li>
              <li>Bảo mật dữ liệu & sao lưu.</li>
            </ul>
          </div>
        </div>

        <!-- Tab 5 -->
        <div class="acc-item">
          <button class="acc-head" type="button">
            <span>DevOps & Cloud</span>
            <i class="fa-solid fa-chevron-right chev"></i>
          </button>
          <div class="acc-panel">
            <ul>
              <li>Docker & Compose; cấu hình Nginx/SSL.</li>
              <li>CI/CD (GitHub Actions/GitLab CI) – build, test, deploy.</li>
              <li>Giám sát & cảnh báo: logs, metrics.</li>
            </ul>
          </div>
        </div>

        <!-- Tab 6 -->
        <div class="acc-item">
          <button class="acc-head" type="button">
            <span>QA/Testing & Kỹ năng dự án</span>
            <i class="fa-solid fa-chevron-right chev"></i>
          </button>
          <div class="acc-panel">
            <ul>
              <li>Unit/Integration/E2E (Jest, PHPUnit); Postman/Newman.</li>
              <li>Agile/Scrum; viết tài liệu, báo cáo tiến độ.</li>
              <li>Portfolio, CV, phỏng vấn, teamwork.</li>
            </ul>
          </div>
        </div>
      </div>
    </article>

    <!-- Trái dưới -->
    <article class="intro-card">
      <div class="intro-card__icon"><i class="fa-solid fa-bullseye"></i></div>
      <h3 class="intro-card__title">Phương châm hoạt động</h3>
      <p class="intro-card__desc">
        <b>Học – Làm – Phản hồi nhanh.</b> Dạy qua dự án thực tế, mentor kèm 1–1,
        code review kỹ, sẵn sàng đi làm.
      </p>
    </article>
  </div>
</div>


<div class="phases-wrapper">
  <h2 class="phases-title">5 Giai đoạn học tập để trở thành chiến binh Developer</h2>

  <div class="phases-rows">

    <!-- Phase 1 -->
    <div class="phase-row phase-1">
      <div class="phase-shape1-wrap">
        <div class="phase-shape1">
          <span class="phase-num">01</span>
          <i class="phase-ico fa-solid fa-brain"></i>
        </div>
      </div>
      <div class="phase-shape2-wrap">
  <span class="phase-shape2-stroke"></span>
        <div class="phase-shape2-mask"></div>
        <div class="phase-shape2-content">
          <h3 class="phase-title">Giai đoạn 1: Tư duy logic</h3>
          <p class="phase-desc">Rèn luyện tư duy logic, cấu trúc dữ liệu, giải thuật, làm quen Git/GitHub và Linux cơ bản.</p>
        </div>
      </div>
    </div>

    <!-- Phase 2 -->
    <div class="phase-row phase-2">
      <div class="phase-shape1-wrap">
        <div class="phase-shape1">
          <span class="phase-num">02</span>
          <i class="phase-ico fa-solid fa-laptop-code"></i>
        </div>
      </div>
      <div class="phase-shape2-wrap">
  <span class="phase-shape2-stroke"></span>
        <div class="phase-shape2-mask"></div>
        <div class="phase-shape2-content">
          <h3 class="phase-title">Giai đoạn 2: Lập trình cơ bản</h3>
          <p class="phase-desc">Nắm vững cú pháp, lập trình hướng đối tượng, giải bài tập và dự án mini.</p>
        </div>
      </div>
    </div>

    <!-- Phase 3 -->
    <div class="phase-row phase-3">
      <div class="phase-shape1-wrap">
        <div class="phase-shape1">
          <span class="phase-num">03</span>
          <i class="phase-ico fa-solid fa-server"></i>
        </div>
      </div>
      <div class="phase-shape2-wrap">
  <span class="phase-shape2-stroke"></span>
        <div class="phase-shape2-mask"></div>
        <div class="phase-shape2-content">
          <h3 class="phase-title">Giai đoạn 3: Backend & Database</h3>
          <p class="phase-desc">Học về cơ sở dữ liệu SQL/NoSQL, xây dựng API, quản lý server và bảo mật cơ bản.</p>
        </div>
      </div>
    </div>

    <!-- Phase 4 -->
    <div class="phase-row phase-4">
      <div class="phase-shape1-wrap">
        <div class="phase-shape1">
          <span class="phase-num">04</span>
          <i class="phase-ico fa-solid fa-database"></i>
        </div>
      </div>
      <div class="phase-shape2-wrap">
  <span class="phase-shape2-stroke"></span>
        <div class="phase-shape2-mask"></div>
        <div class="phase-shape2-content">
          <h3 class="phase-title">Giai đoạn 4: Frontend nâng cao</h3>
          <p class="phase-desc">Thành thạo React, Vue hoặc Angular, tối ưu giao diện và trải nghiệm người dùng.</p>
        </div>
      </div>
    </div>

    <!-- Phase 5 -->
    <div class="phase-row phase-5">
      <div class="phase-shape1-wrap">
        <div class="phase-shape1">
          <span class="phase-num">05</span>
          <i class="phase-ico fa-solid fa-rocket"></i>
        </div>
      </div>
      <div class="phase-shape2-wrap">
        <span class="phase-shape2-stroke"></span>
        <div class="phase-shape2-mask"></div>
        <div class="phase-shape2-content">
          <h3 class="phase-title">Giai đoạn 5: Triển khai & Thực chiến</h3>
          <p class="phase-desc">Triển khai dự án lên cloud, CI/CD, tối ưu hiệu năng và tham gia dự án thực tế.</p>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection