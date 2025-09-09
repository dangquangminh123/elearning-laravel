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


$(document).ready(function () {

  function drawConnectors() {
    var $right = $('.custom-right');
    var $svg = $right.find('.custom-curve-svg');
    if (!$svg.length) return;
    var svg = $svg[0];

    // clear old
    while (svg.firstChild) svg.removeChild(svg.firstChild);
    $right.find('.custom-curve-dot').remove();

    var rightW = Math.max(320, Math.round($right.width()));
    var rightH = Math.max(320, Math.round($right.height()));
    svg.setAttribute('viewBox', '0 0 ' + rightW + ' ' + rightH);
    svg.setAttribute('preserveAspectRatio', 'none');

    var svgClient = svg.getBoundingClientRect();
    if (!svgClient.width || !svgClient.height) return;
    var scaleX = svgClient.width / rightW;
    var scaleY = svgClient.height / rightH;

    var ns = "http://www.w3.org/2000/svg";

    var $circle = $('.custom-circle-bg');
    var circleRightUserX = null;
    var radiusUser = null;
    if ($circle.length) {
      var cRect = $circle[0].getBoundingClientRect();
      circleRightUserX = ((cRect.left + cRect.width) - svgClient.left) / scaleX;
      radiusUser = (cRect.width) / scaleX / 2;
    }

    var startX, ctrlBase;
    if (circleRightUserX !== null) {
      var gap = Math.max(4, Math.round(radiusUser * 0.04));
      ctrlBase = Math.min(Math.round(rightW * 0.45), Math.max(12, circleRightUserX + gap));
      startX = Math.max(4, Math.round(circleRightUserX - Math.max(12, radiusUser * 0.12)));
    } else {
      startX = Math.max(40, Math.round(rightW * 0.08));
      ctrlBase = startX + Math.min(80, Math.round(rightW * 0.16));
    }

    // bulge params
    var bulgeFactor = 0.9;
    var cpOffset = Math.max(36, Math.round((rightW - ctrlBase) * 0.18 * bulgeFactor));
    var cpX = Math.min(rightW - 12, ctrlBase + cpOffset);

    var cpY1 = Math.round(rightH * 0.18);
    var cpY2 = Math.round(rightH * 0.82);

    // main curve
    var path = document.createElementNS(ns, 'path');
    var pathD = 'M' + startX + ',0 ' +
                'C' + cpX + ',' + cpY1 + ' ' +
                      cpX + ',' + cpY2 + ' ' +
                      startX + ',' + rightH;
    path.setAttribute('d', pathD);
    path.setAttribute('stroke', '#f39c12');
    path.setAttribute('stroke-width', 3.5);
    path.setAttribute('fill', 'none');
    path.setAttribute('stroke-linecap', 'round');
    path.setAttribute('stroke-linejoin', 'round');
    svg.appendChild(path);

    function getPointAtY(pathEl, targetY) {
      var total = pathEl.getTotalLength();
      var lo = 0, hi = total, eps = 0.5;
      while ((hi - lo) > eps) {
        var mid = (lo + hi) / 2;
        var p = pathEl.getPointAtLength(mid);
        if (p.y < targetY) lo = mid; else hi = mid;
      }
      return pathEl.getPointAtLength((lo + hi) / 2);
    }

    var rightRect = $right[0].getBoundingClientRect();

    // connectors
    $right.find('.custom-item').each(function () {
      var rect = this.getBoundingClientRect();

      var pageX = rect.left;
      var pageY = rect.top + rect.height / 2;

      var sx = (pageX - svgClient.left) / scaleX;
      var sy = (pageY - svgClient.top) / scaleY;

      sx = Math.max(0, Math.min(rightW, sx));
      sy = Math.max(0, Math.min(rightH, sy));

      var pt = getPointAtY(path, sy);

      var line = document.createElementNS(ns, 'line');
      line.setAttribute('x1', sx);
      line.setAttribute('y1', sy);
      line.setAttribute('x2', pt.x);
      line.setAttribute('y2', pt.y);
      line.setAttribute('stroke', '#f39c12');
      line.setAttribute('stroke-width', 2.6);
      line.setAttribute('stroke-linecap', 'round');
      line.setAttribute('stroke-dasharray', '8 6');
      svg.appendChild(line);

      var cssDotX = svgClient.left + (pt.x * scaleX);
      var cssDotY = svgClient.top + (pt.y * scaleY);

      var relLeft = cssDotX - rightRect.left;
      var relTop = cssDotY - rightRect.top;

      var $dot = $('<div class="custom-curve-dot"></div>');
      $dot.css({ left: relLeft + 'px', top: relTop + 'px' });
      $right.append($dot);
    });
  }

  drawConnectors();

  var resizeTimer = null;
  $(window).on('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(drawConnectors, 120);
  });

  $('.custom-item').css({ opacity: 0, transform: 'translateY(6px)' })
    .each(function (i, el) {
      setTimeout(function () {
        $(el).animate({ opacity: 1 }, 360).css('transform', 'none');
      }, i * 140);
    });

});