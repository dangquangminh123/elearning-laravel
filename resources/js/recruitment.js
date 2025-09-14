$(function () {

  /**
   * Hover handler cho card-item trên mobile
   */
  function initCardItemHover() {
    if (!$('.card-item').length) return;

    var isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    if (!isTouch) return;

    $('.card-item').on('touchstart', function (e) {
      e.stopPropagation();
      var $this = $(this);
      if (!$this.hasClass('is-hover')) {
        $('.card-item').removeClass('is-hover');
        $this.addClass('is-hover');
      } else {
        $this.removeClass('is-hover');
      }
    });

    $(document).on('touchstart click', function (e) {
      if ($(e.target).closest('.card-item').length === 0) {
        $('.card-item').removeClass('is-hover');
      }
    });
  }

  /**
   * Kẻ connectors giữa 2 hàng icon (top row & bottom row)
   */
  function initColumnConnectors() {
    if (!$('.connector').length) return;

    function updateConnectors() {
      $('.connector').hide();

      if ($(window).width() < 768) return; // mobile stacked => bỏ

      var $topCols = $('.row').first().find('.col-md-4');
      var $botCols = $('.row').last().find('.col-md-4');

      $topCols.each(function (index) {
        var $topCol = $(this);
        var $botCol = $botCols.eq(index);
        var $topIcon = $topCol.find('.icon-inner');
        var $botIcon = $botCol.find('.icon-inner');
        var $connector = $topCol.find('.connector');

        if (!$topIcon.length || !$botIcon.length || !$connector.length) return;

        var topIconBottom = $topIcon.offset().top + $topIcon.outerHeight();
        var botIconTop = $botIcon.offset().top;
        var colTop = $topCol.offset().top;

        var connTop = topIconBottom - colTop;
        var connHeight = botIconTop - topIconBottom;

        if (connHeight > 6) {
          $connector.css({
            top: Math.round(connTop) + 'px',
            height: Math.round(connHeight) + 'px',
            display: 'block'
          });
        }
      });
    }

    $(window).on('load', updateConnectors);
    $(window).on('resize', function () {
      clearTimeout(window._recalcConnectors);
      window._recalcConnectors = setTimeout(updateConnectors, 120);
    });
  }

  /**
   * Hover + responsive font cho step
   */
  function initSteps() {
    if (!$('.step').length) return;

    const steps = document.querySelectorAll('.step');

    steps.forEach(s => {
      s.addEventListener('mouseenter', () => s.classList.add('is-hover'));
      s.addEventListener('mouseleave', () => s.classList.remove('is-hover'));
    });

    function adjustNumFont() {
      const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
      let fs = 18;
      if (vw < 380) fs = 14;
      if (vw > 1200) fs = 20;
      steps.forEach(s => {
        const num = s.querySelector('.num');
        if (num) num.style.fontSize = fs + 'px';
      });
    }

    $(window).on('resize', adjustNumFont);
    adjustNumFont();
  }

  /**
   * Curve connectors giữa circle và custom-item
   */
  function initCurveConnectors() {
    if (!$('.custom-right').length) return;

    function drawConnectors() {
      var $right = $('.custom-right');
      var $svg = $right.find('.custom-curve-svg');
      if (!$svg.length) return;
      var svg = $svg[0];

      // clear cũ
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

      var bulgeFactor = 0.9;
      var cpOffset = Math.max(36, Math.round((rightW - ctrlBase) * 0.18 * bulgeFactor));
      var cpX = Math.min(rightW - 12, ctrlBase + cpOffset);

      var cpY1 = Math.round(rightH * 0.18);
      var cpY2 = Math.round(rightH * 0.82);

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
  }

  // ======= TRIGGER CÁC MODULE ======= //
  initCardItemHover();
  initColumnConnectors();
  initSteps();
  initCurveConnectors();

});


 $(document).ready(function(){
      const $container = $('.core-values-container');
      const $svg = $container.find('.core-values-lines');
      $svg.empty();

      const W = $container.width();
      const H = $container.height();
      const centerX = Math.round(W / 2);
      const centerY = Math.round(H / 2);

      const iconRadius = Math.round(Math.min(W,H) * 0.22) + 10; 
      const textGap = 56;
      const items = $container.find('.core-values-item');
      const total = items.length;
      const angleStep = (2 * Math.PI) / total;

      // ensure svg has same pixel size
      $svg.attr('width', W).attr('height', H);

     items.each(function(index){
        const $wrap = $(this);
        const $iconInner = $wrap.find('.core-values-icon');
        const $textInner = $wrap.find('.core-values-text');

        const $icon = $('<div class="cv-icon"></div>').html($iconInner.html());
        const $text = $('<div class="cv-text"></div>').html($textInner.html());
        $container.append($icon);
        $container.append($text);

        const angle = index * angleStep - Math.PI / 2;

        // vị trí tâm icon (chưa trừ size)
        const iconCenterX = centerX + iconRadius * Math.cos(angle);
        const iconCenterY = centerY + iconRadius * Math.sin(angle);

        // đo kích thước icon
        const iconW = $icon.outerWidth();
        const iconH = $icon.outerHeight();

        // đặt icon vào đúng tâm
        $icon.css({
          left: (iconCenterX - iconW/2) + 'px',
          top: (iconCenterY - iconH/2) + 'px'
        });

        // ==== fix quan trọng: tính điểm dừng line sát ngoài icon ====
        const halfDiag = Math.sqrt(Math.pow(iconW/2, 2) + Math.pow(iconH/2, 2));
        const lineEndX = centerX + (iconRadius - halfDiag - 6) * Math.cos(angle);
        const lineEndY = centerY + (iconRadius - halfDiag - 6) * Math.sin(angle);

        // vẽ line
        const line = document.createElementNS("http://www.w3.org/2000/svg","line");
        line.setAttribute("x1", centerX);
        line.setAttribute("y1", centerY);
        line.setAttribute("x2", lineEndX);
        line.setAttribute("y2", lineEndY);
        $svg.append(line);

       const radialGap = 15; // khoảng cách đều giữa icon và mép text (bạn chỉnh ở đây)
        const vX = Math.cos(angle);
        const vY = Math.sin(angle);

        // đo kích thước text
        const textW = $text.outerWidth();
        const textH = $text.outerHeight();
        const halfW = textW / 2;
        const halfH = textH / 2;

        // "support function" của hình chữ nhật theo hướng v = (vX, vY)
        // -> khoảng cách từ tâm text đến mép text theo phương v
        const support = Math.abs(vX) * halfW + Math.abs(vY) * halfH;

        // bán kính đến TÂM của text = (đến mép icon) + (khoảng hở đều) + (support của text)
        const textR = iconRadius + halfDiag + radialGap + support;

        // toạ độ tâm text
        const textCenterX = centerX + textR * vX;
        const textCenterY = centerY + textR * vY;

        // đặt text theo TÂM (không thêm translateX/translateY nào nữa)
        $text.css({
          left: (textCenterX - halfW) + 'px',
          top: (textCenterY - halfH) + 'px'
        });

        // căn text-align cho đẹp mắt, KHÔNG dùng transform dịch ngang nữa
        const deg = (angle * 180 / Math.PI + 360) % 360;
        if (deg > 315 || deg <= 45) {
          $text.css('text-align', 'center');
        } else if (deg > 45 && deg <= 135) {
          $text.css('text-align', 'left');
        } else if (deg > 135 && deg <= 225) {
          $text.css('text-align', 'center');
        } else {
          $text.css('text-align', 'right');
        }
      });


      // remove old wrappers (để tránh duplicates)
      items.remove();
    });
