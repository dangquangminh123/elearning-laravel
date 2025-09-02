document.addEventListener("DOMContentLoaded", () => {
  

    const section = document.querySelector(".tab-section");
    if (!section) return;

    const tabs = section.querySelectorAll(".tab");
    const contents = section.querySelectorAll(".content");

    tabs.forEach(tab => {
        tab.addEventListener("click", () => {
        tabs.forEach(t => t.classList.remove("active"));
        contents.forEach(c => c.classList.remove("active"));
        
        tab.classList.add("active");
        const target = section.querySelector(`#${tab.dataset.tab}`);
        target.classList.add("active");
        });
    });


    const container = document.querySelector(".features");
  if (!container) return; // tránh lỗi nếu trang không có

  const features = container.querySelectorAll(".feature");
  const animations = [
    "slideInLeft",
    "slideInRight",
    "fadeInUp",
    "zoomIn",
    "bounceIn",
    "rotateIn"
  ];

  features.forEach((feature, i) => {
    const animationName = animations[i % animations.length];

    const title = feature.querySelector("h3");
    const text = feature.querySelector("p");
    const image = feature.querySelector("img");

    const animateEl = (el, delayExtra = 0) => {
      if (!el) return;

      // gán class animate tạm
      el.classList.add("animate-temp");
      el.style.animationName = animationName;
      el.style.animationDelay = `${i * 0.3 + delayExtra}s`;

      // khi animation kết thúc → reset lại như ban đầu
      el.addEventListener("animationend", () => {
        el.classList.remove("animate-temp");
        el.style.animationName = "";
        el.style.animationDelay = "";
      }, { once: true });
    };

    animateEl(title, 0);
    animateEl(text, 0.15);
    animateEl(image, 0.3);
  });

});

$(document).ready(function() {
    // Thêm hiệu ứng hover cho các item
    $('.d-flex.align-items-start').hover(
        function() {
            // Khi chuột vào
            $(this).find('.item-icon').css('background-color', '#ffb74d');
            $(this).find('h3').css('color', '#ff9900');
        },
        function() {
            // Khi chuột rời đi
            $(this).find('.item-icon').css('background-color', '#ff9900');
            $(this).find('h3').css('color', '#333');
        }
    );
});

