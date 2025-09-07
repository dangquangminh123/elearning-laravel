 (function(){
    var isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (!isTouch) return;

    $('.card-item').on('touchstart', function (e) {
      e.stopPropagation();
      var $this = $(this);
      if (!$this.hasClass('is-hover')) {
        $('.card-item').removeClass('is-hover');
        $this.addClass('is-hover');
      } else { $this.removeClass('is-hover'); }
    });

    $(document).on('touchstart click', function (e){
      if ($(e.target).closest('.card-item').length === 0){
        $('.card-item').removeClass('is-hover');
      }
    });
  })();

   function updateConnectors(){
      // hide connectors by default
      $('.connector').hide();

      // trên mobile (stacked), ẩn connectors (do layout 1 cột)
      if ($(window).width() < 768) return;

      // lấy các cột ở hàng trên & hàng dưới
      var $topCols = $('.row').first().find('.col-md-4');
      var $botCols = $('.row').last().find('.col-md-4');

      $topCols.each(function(index){
        var $topCol = $(this);
        var $botCol = $botCols.eq(index);
        var $topIcon = $topCol.find('.icon-inner');
        var $botIcon = $botCol.find('.icon-inner');
        var $connector = $topCol.find('.connector');

        if (!$topIcon.length || !$botIcon.length || !$connector.length) return;

        // vị trí dưới cùng của icon trên (tính so với document)
        var topIconBottom = $topIcon.offset().top + $topIcon.outerHeight();
        // vị trí trên cùng của icon dưới
        var botIconTop = $botIcon.offset().top;
        // vị trí top của column chứa connector
        var colTop = $topCol.offset().top;

        // connector start (so với top của col) và chiều cao
        var connTop = topIconBottom - colTop;
        var connHeight = botIconTop - topIconBottom;

        // nếu khoảng cách > 6px thì show
        if (connHeight > 6) {
          $connector.css({
            top: Math.round(connTop) + 'px',
            height: Math.round(connHeight) + 'px',
            display: 'block'
          });
        } else {
          $connector.hide();
        }
      });
    }

    // Update khi load + resize + fonts/DOM ổn định
    $(window).on('load', updateConnectors);
    $(window).on('resize', function(){
      // throttle resize
      clearTimeout(window._recalcConnectors);
      window._recalcConnectors = setTimeout(updateConnectors, 120);
    });

 (function(){
      const steps = document.querySelectorAll('.step');

      steps.forEach(s => {
        s.addEventListener('mouseenter', () => s.classList.add('is-hover'));
        s.addEventListener('mouseleave', () => s.classList.remove('is-hover'));
      });

      function adjustNumFont(){
        const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        let fs = 18;
        if(vw < 380) fs = 14;
        if(vw > 1200) fs = 20;
        steps.forEach(s => {
          const num = s.querySelector('.num');
          if(num) num.style.fontSize = fs + 'px';
        });
      }

      window.addEventListener('resize', adjustNumFont);
      adjustNumFont();
    })();