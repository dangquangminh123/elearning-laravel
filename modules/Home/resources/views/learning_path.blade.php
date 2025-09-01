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
@endsection