if ("ontouchstart" in window) {
	var click = "touchstart";
} else {
	var click = "click";
}

$("div.burger").on(click, function () {
	if (!$(this).hasClass("open")) {
		openMenu();
	} else {
		closeMenu();
	}
});

$("div.menu ul li a").on(click, function (e) {
	e.preventDefault();
	closeMenu();
});

function openMenu() {
	$("div.burger").addClass("open");
	$("div.y").fadeOut(100);
	$("div.screen").addClass("animate");

	setTimeout(function () {
		$("div.x").addClass("rotate30");
		$("div.z").addClass("rotate150");
		$(".menu").addClass("animate");

		setTimeout(function () {
			$("div.x").addClass("rotate45");
			$("div.z").addClass("rotate135");
		}, 100);
	}, 10);
}


$(document).ready(function() {
    // flip book teacher overview
    var flip = $('#flipbook');
    if (flip.length === 0) return; // Không có flipbook thì thoát ngay

    var pages = [];
    function preloadImages(imageUrls, callback) {
        var loaded = 0, total = imageUrls.length;
        if (total === 0) { callback(); return; }
        imageUrls.forEach(function(url){
        var img = new Image();
        img.onload = img.onerror = function() {
            loaded++;
            if (loaded === total) callback();
        };
        img.src = url;
        });
    }

  
    $('#flipbook img').each(function(){
        var src = $(this).attr('src');
        if (src) pages.push(src);
    });

    preloadImages(pages, function(){
        
          var autoFlipInterval = null;
          var resumeTimer = null;
          var flipForward = true;
          var lockUntil = 0; // timestamp (ms) : nếu Date.now() < lockUntil thì autoFlip sẽ không thực hiện
          flip.turn({
              autoCenter: true,
              when: {
                  start: function() {
                  var view = flip.turn('view') || [];
                  $('#flipbook .page').removeClass('page-visible');
                  view.forEach(function(p){ $('#flipbook .p' + p).addClass('page-visible'); });
                  },
                  turned: function(event, page, view) {
                  $('#flipbook .page').removeClass('page-visible');
                  view.forEach(function(p){ $('#flipbook .p' + p).addClass('page-visible'); });

                  // Nếu người dùng lật tay (manual), tạm dừng auto flip
                  userInteracted();
                  }
              }
          });
      function autoFlip(){
        if (Date.now() < lockUntil) return;       // đang lock vì user vừa tương tác
        if (!flip.turn) return;                   // safety
        var current = flip.turn('page');
        var total = flip.turn('pages');

        if (flipForward) {
          if (current < total) flip.turn('next');
          else { flipForward = false; flip.turn('previous'); }
        } else {
          if (current > 1) flip.turn('previous');
          else { flipForward = true; flip.turn('next'); }
        }
      }

      function startAutoFlip(){
        if (autoFlipInterval) return;             // tránh tạo interval thứ hai
        autoFlipInterval = setInterval(autoFlip, 3000);
      }

      function stopAutoFlip(){
        if (!autoFlipInterval) return;
        clearInterval(autoFlipInterval);
        autoFlipInterval = null;
      }

      // khi user tương tác: khóa autoFlip trong 5s và restart sau 5s
      function userInteracted(){
        lockUntil = Date.now() + 5000;

        // dừng interval hiện tại ngay (nếu có)
        stopAutoFlip();

        // xóa timer cũ nếu có
        if (resumeTimer) clearTimeout(resumeTimer);

        // sau 5s, bỏ lock và start lại autoFlip (nếu chưa có)
        resumeTimer = setTimeout(function(){
          lockUntil = 0;
          startAutoFlip();
        }, 5000);
      }

      $(document).on('mousedown touchstart wheel keydown', userInteracted);
      startAutoFlip();

    }); 


    // course nổi bật
    const viewAllBtn = $('.view-all-btn');
    viewAllBtn.addClass('animate-tada');

    // Sau 20 giây, xóa class để dừng animation
    setTimeout(function() {
          viewAllBtn.removeClass('animate-tada');
    }, 20000);

	// Hiệu ứng lấp lánh cho hình ảnh lớn khi di chuột vào promo-card
    $('.promo-card').hover(
        function() {
            $(this).sparkle({
                count: 50,
                color: ["#12CBC4","#EE5A24", "#FFC312", "#EA2027", "#D980FA", "#0652DD"],
                overlap: 50,
				minSize: 10,
				maxSize: 20,
				direction: "both",
            });
        },
        function() {
            // Loại bỏ sparkles khi di chuột ra
            $(this).sparkle('destroy');
        }
    );

	 $('.small-heading').hover(
        function() {
            $(this).sparkle({
                count: 50,
                color: ["#12CBC4","#EE5A24", "#FFC312", "#EA2027", "#D980FA", "#0652DD"],
                overlap: 50,
				minSize: 5,
				direction: "both",
            });
        },
        function() {
            $(this).sparkle('destroy');
        }
    );

    // flash me type course
    $('.course-item').hover(
        function() {
            $(this).find('.course-icon-container, .course-title').sparkle({
                count: 20,
                color: '#EE5A24',
                overlap: 20,
				minSize: 5,
            });
        },
        function() {
            $(this).find('.course-icon-container, .course-title').sparkle('destroy');
        }
    );

    // bse block
    const labels = [
      "Tư vấn khóa học PHP & Laravel",
      "Tư vấn khóa học ReactJS",
      "Tư vấn dịch vụ học trực tuyến",
      "Hỗ trợ đăng ký tài khoản",
      "Chương trình khuyến mãi",
      "Học thử miễn phí",
      "Lộ trình học tập cá nhân",
      "Hỗ trợ kỹ thuật 24/7"
    ];

    const classes = [
      "leaf--elearn","leaf--bank","leaf--ticket","leaf--insure",
      "leaf--24h","leaf--cyber","leaf--stock","leaf--biz"
    ];

    const icons = [
      "fa-solid fa-code", 
      "fa-brands fa-react", 
      "fa-solid fa-laptop", 
      "fa-solid fa-user-plus",
      "fa-solid fa-gift", 
      "fa-solid fa-graduation-cap", 
      "fa-solid fa-road", 
      "fa-solid fa-headset"
    ];


  const $rows = $(".bse .rows .bse-row");

  for (let r = 0; r < 4; r++) {
    const iL = r * 2, iR = r * 2 + 1;
     const wL = labels[iL].length * 12 + 220;
      const wR = labels[iR].length * 12 + 220;

    const left = `
      <div class="leaf left ${classes[iL]}">
        <span class="leaf-glow"></span>
        <span class="leaf-shape"></span>
        <span class="leaf-overlay"></span>
        <div class="leaf__content">
          <span class="leaf-icon"><i class="${icons[iL]}"></i></span>
          <span class="leaf-label">${labels[iL]}</span>
        </div>
      </div>`;

    const right = `
      <div class="leaf right ${classes[iR]}">
        <span class="leaf-glow"></span>
        <span class="leaf-shape"></span>
        <span class="leaf-overlay"></span>
        <div class="leaf__content">
          <span class="leaf-icon"><i class="${icons[iL]}"></i></span>
          <span class="leaf-label">${labels[iL]}</span>
        </div>
      </div>`;

  //  const left = `
  //   <div class="leaf left ${classes[iL]}" style="--leafW:${wL}px">
  //     <span class="leaf-glow"></span>
  //     <span class="leaf-shape"></span>
  //     <span class="leaf-overlay"></span>
  //     <div class="leaf__content">
  //       <span class="leaf-icon"><i class="${icons[iL]}"></i></span>
  //       <span class="leaf-label">${labels[iL]}</span>
  //     </div>
  //   </div>`;

  // const right = `
  //   <div class="leaf right ${classes[iR]}" style="--leafW:${wR}px">
  //     <span class="leaf-glow"></span>
  //     <span class="leaf-shape"></span>
  //     <span class="leaf-overlay"></span>
  //     <div class="leaf__content">
  //       <span class="leaf-icon"><i class="${icons[iR]}"></i></span>
  //       <span class="leaf-label">${labels[iR]}</span>
  //     </div>
  //   </div>`;

    $rows.eq(r).append(left).append(right);
  }
});


$('.partner-slider.center').slick({
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1900,
  arrows: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});