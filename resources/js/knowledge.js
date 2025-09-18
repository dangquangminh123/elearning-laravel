$(function(){
  // Accordion: luôn chỉ mở 1 tab
  $('.intro-savista').on('click', '.acc-head', function(){
    const $item = $(this).closest('.acc-item');
    const $wrap = $item.closest('.intro-acc');

    if($item.hasClass('is-open')){
      // Đóng tab đang mở
      $item.removeClass('is-open')
           .find('.acc-panel').stop(true,true).slideUp(180);
      $item.find('.chev').removeClass('fa-chevron-down').addClass('fa-chevron-right');
    }else{
      // Đóng các tab khác
      $wrap.find('.acc-item.is-open')
           .removeClass('is-open')
           .find('.acc-panel').stop(true,true).slideUp(180);
      $wrap.find('.acc-item .chev')
           .removeClass('fa-chevron-down').addClass('fa-chevron-right');

      // Mở tab vừa click
      $item.addClass('is-open')
           .find('.acc-panel').stop(true,true).slideDown(200);
      $item.find('.chev').removeClass('fa-chevron-right').addClass('fa-chevron-down');
    }
  });

  // phase
   $(".phase-row").each(function(){
    let $row = $(this);
    let $shape1 = $row.find(".phase-shape1");
    let $shape2 = $row.find(".phase-shape2-wrap");

    // hover vào shape1
    $shape1.hover(
      function(){
        $shape1.addClass("shape1-hover");
        $shape2.addClass("shape2-hover");
      },
      function(){
        $shape1.removeClass("shape1-hover");
        $shape2.removeClass("shape2-hover");
      }
    );

    // hover vào shape2
    $shape2.hover(
      function(){
        $shape2.addClass("shape2-hover");
        $shape1.addClass("shape1-hover");
      },
      function(){
        $shape2.removeClass("shape2-hover");
        $shape1.removeClass("shape1-hover");
      }
    );
  });

  // method study
  // Hover bút chì
  $(".ds-pencil").hover(
    function () {
      $(this).addClass("pencil-hover");
    },
    function () {
      $(this).removeClass("pencil-hover");
    }
  );

  // Hover cả 1 hàng
  $(".ds-row").hover(
    function () {
      $(this).addClass("row-hover");
    },
    function () {
      $(this).removeClass("row-hover");
    }
  );

  // Hover từng shape riêng
  $(".ds-head-shape, .ds-hank-shape, .ds-tail-shape").hover(
    function () {
      $(this).addClass("shape-hover");
    },
    function () {
      $(this).removeClass("shape-hover");
    }
  );
  
});

