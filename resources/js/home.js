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
  const App = {
    // --- Flipbook ---
    initFlipbook() {
      const flip = $('#flipbook');
      if (!flip.length) return;

      let pages = [];
      $('#flipbook img').each(function() {
        const src = $(this).attr('src');
        if (src) pages.push(src);
      });

      const preloadImages = (urls, cb) => {
        let loaded = 0, total = urls.length;
        if (total === 0) return cb();
        urls.forEach(url => {
          const img = new Image();
          img.onload = img.onerror = () => {
            loaded++;
            if (loaded === total) cb();
          };
          img.src = url;
        });
      };

      preloadImages(pages, () => {
        let autoFlipInterval = null;
        let resumeTimer = null;
        let flipForward = true;
        let lockUntil = 0;

        flip.turn({
          autoCenter: true,
          when: {
            start: function() {
              const view = flip.turn('view') || [];
              $('#flipbook .page').removeClass('page-visible');
              view.forEach(p => $('#flipbook .p' + p).addClass('page-visible'));
            },
            turned: function(event, page, view) {
              $('#flipbook .page').removeClass('page-visible');
              view.forEach(p => $('#flipbook .p' + p).addClass('page-visible'));
              userInteracted();
            }
          }
        });

        function autoFlip() {
          if (Date.now() < lockUntil) return;
          if (!flip.turn) return;
          const current = flip.turn('page');
          const total = flip.turn('pages');
          if (flipForward) {
            if (current < total) flip.turn('next');
            else { flipForward = false; flip.turn('previous'); }
          } else {
            if (current > 1) flip.turn('previous');
            else { flipForward = true; flip.turn('next'); }
          }
        }

        function startAutoFlip() {
          if (!autoFlipInterval) autoFlipInterval = setInterval(autoFlip, 3000);
        }

        function stopAutoFlip() {
          if (autoFlipInterval) {
            clearInterval(autoFlipInterval);
            autoFlipInterval = null;
          }
        }

        function userInteracted() {
          lockUntil = Date.now() + 5000;
          stopAutoFlip();
          if (resumeTimer) clearTimeout(resumeTimer);
          resumeTimer = setTimeout(() => {
            lockUntil = 0;
            startAutoFlip();
          }, 5000);
        }

        $(document).on('mousedown touchstart wheel keydown', userInteracted);
        startAutoFlip();
      });
    },

    // --- View All Btn ---
    initViewAllBtn() {
      const btn = $('.view-all-btn');
      if (!btn.length) return;
      btn.addClass('animate-tada');
      setTimeout(() => btn.removeClass('animate-tada'), 20000);
    },

    // --- Sparkle Effects ---
    initSparkleEffects() {
      if ($('.promo-card').length) {
        $('.promo-card').hover(
          function() {
            $(this).sparkle({
              count: 50,
              color: ["#12CBC4","#EE5A24","#FFC312","#EA2027","#D980FA","#0652DD"],
              overlap: 50, minSize: 10, maxSize: 20, direction: "both"
            });
          },
          function() { $(this).sparkle('destroy'); }
        );
      }

      if ($('.small-heading').length) {
        $('.small-heading').hover(
          function() {
            $(this).sparkle({
              count: 50,
              color: ["#12CBC4","#EE5A24","#FFC312","#EA2027","#D980FA","#0652DD"],
              overlap: 50, minSize: 5, direction: "both"
            });
          },
          function() { $(this).sparkle('destroy'); }
        );
      }
    },

    // --- Course Sparkle ---
    initCourseSparkle() {
      if (!$('.course-item').length) return;
      $('.course-item').hover(
        function() {
          $(this).find('.course-icon-container, .course-title').sparkle({
            count: 20, color: '#EE5A24', overlap: 20, minSize: 5
          });
        },
        function() {
          $(this).find('.course-icon-container, .course-title').sparkle('destroy');
        }
      );
    },

    // --- BSE Block ---
    initBseBlock() {
      if (!$('.bse .rows').length) return;

      const labels = [
        "Tư vấn khóa học ReactJS","Tư vấn khóa học PHP & Laravel",
        "Hỗ trợ đăng ký tài khoản","Tư vấn dịch vụ học trực tuyến",
        "Học thử miễn phí","Chương trình khuyến mãi",
        "Hỗ trợ kỹ thuật 24/7","Lộ trình học tập cá nhân"
      ];
      const classes = ["leaf--elearn","leaf--bank","leaf--ticket","leaf--insure","leaf--24h","leaf--cyber","leaf--stock","leaf--biz"];
      const icons   = ["fa-brands fa-react","fa-solid fa-code","fa-solid fa-user-plus","fa-solid fa-laptop","fa-solid fa-graduation-cap","fa-solid fa-gift","fa-solid fa-headset","fa-solid fa-road"];

      const clamp = (v,min,max)=>Math.max(min,Math.min(max,v));
      const wordCount = t => (t||"").trim().split(/\s+/).filter(Boolean).length;
      const sizeFromWords = lbl => wordCount(lbl)<2?"small":(wordCount(lbl)<5?"medium":"large");

      function dimsFor(label) {
        const size = sizeFromWords(label);
        const len  = (label || "").length;
        let wBase, h;
        if (size === "small") { wBase = 340; h = 200; }
        else if (size === "medium") { wBase = 370; h = 210; }
        else { wBase = 400; h = 230; }
        const extra = size==="large"?0:clamp((len-12)*4, 0, 60);
        const w = clamp(wBase + extra, 350, 400);
        h = clamp(h, 200, 230);
        return { w, h };
      }

      const offsetFor = (size, side) => side==="left"
        ? (size==="small"?"left:13%;":"left:1%;")
        : (size==="small"?"right:12%;":"right:0.8%;");

      function makeLeaf(side, klass, icon, label){
        const { w, h } = dimsFor(label);
        const offset = offsetFor(sizeFromWords(label), side);
        return `
          <div class="leaf ${side} ${klass}" style="--leafW:${w}px; --leafH:${h}px; ${offset}">
            <span class="leaf-glow"></span>
            <span class="leaf-shape"></span>
            <div class="leaf__content">
              <span class="leaf-icon"><i class="${icon}"></i></span>
              <span class="leaf-label">${label}</span>
            </div>
          </div>`;
      }

      const $rows = $(".bse .rows .bse-row");
      for (let r = 0; r < 4; r++) {
        $rows.eq(r)
          .append(makeLeaf("left", classes[r*2], icons[r*2], labels[r*2]))
          .append(makeLeaf("right", classes[r*2+1], icons[r*2+1], labels[r*2+1]));
      }

      function playBubblesAnimation() {
        $(".phone").addClass("ringing");
        $(".tree").addClass("floating");
        $(".wire").addClass("floating");
        setTimeout(() => {
          $(".phone").removeClass("ringing");
          $(".tree").removeClass("floating");
          $(".wire").removeClass("floating");
        }, 5000);
        setTimeout(playBubblesAnimation, 6000);
      }
      playBubblesAnimation();
    },

    // --- Partner Slider ---
    initPartnerSlider() {
      if (!$('.partner-slider.center').length) return;
      $('.partner-slider.center').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1900,
        arrows: false,
        responsive: [
          { breakpoint: 768, settings: { centerMode: true, centerPadding: '40px', slidesToShow: 2 }},
          { breakpoint: 480, settings: { centerMode: true, centerPadding: '40px', slidesToShow: 1 }}
        ]
      });
    },

    // --- Init all ---
    init() {
      this.initFlipbook();
      this.initViewAllBtn();
      this.initSparkleEffects();
      this.initCourseSparkle();
      this.initBseBlock();
      this.initPartnerSlider();
    }
  };

  // Run all
  App.init();
});

