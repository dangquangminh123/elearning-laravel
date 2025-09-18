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
  
});

(function($){
const onReady = function(){
// Hover đồng bộ: rê 1 item làm nổi cả hàng
$(document).on('mouseenter','[data-row]',function(){
const r=$(this).data('row');
$('[data-row]').removeClass('active').filter('[data-row="'+r+'"]').addClass('active');
}).on('mouseleave','[data-row]',function(){
$('[data-row]').removeClass('active');
});
};
$(onReady);
})(jQuery);