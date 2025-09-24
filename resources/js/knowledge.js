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
  $(".ds-pencil").hover(
    function () {
      $(this).addClass("pencil-hover");
    },
    function () {
      $(this).removeClass("pencil-hover");
    }
  );

  // Hover 1 hàng
  $(".ds-row").hover(
    function(){ $(this).addClass("row-tighten"); },
    function(){ $(this).removeClass("row-tighten"); }
  );

  // Hover từng shape
  $(".ds-head-shape, .ds-hank-shape, .ds-tail-shape").hover(
    function(){ $(this).addClass("glossy"); },
    function(){ $(this).removeClass("glossy"); }
  );
 });

$(function () {
  function renderKnowledgeShapes() {
    const rootEl = document.getElementById('km-module');
    const cssVar = getComputedStyle(rootEl);

    // --- Đọc thông số từ CSS ---
    const sizeShape1 = parseFloat(cssVar.getPropertyValue('--s1-size'));        // kích thước shape1
    const baseWidthShape2 = parseFloat(cssVar.getPropertyValue('--s2-w')) || 400;
    const baseHeightShape2 = parseFloat(cssVar.getPropertyValue('--s2-h')) || 110;
    const gapShape2 = parseFloat(cssVar.getPropertyValue('--s2-gap')) || 6;

    const stageEl = document.querySelector('.km-stage');
    const stageRect = stageEl.getBoundingClientRect();

    // map vị trí left/right cho các shape2
    const sideMap = {1:'left',2:'right',3:'right',4:'right',5:'right',6:'left',7:'left',8:'left'};

    // màu shape2
    const colorShape2 = [
      ["#6a5af9","#2ed3ea"], ["#1fd2ff","#3de39a"],
      ["#ffa85c","#ff6f91"], ["#ff6ec4","#8a5cff"],
      ["#7c4dff","#fca5a5"], ["#00c2ff","#647dee"],
      ["#ff8f70","#ff3d54"], ["#47e891","#1fbfff"]
    ];
    
    // màu chữ trong shape2 
   const textGradients = [
      "linear-gradient(135deg,#ffffff,#ffe082)",
      "linear-gradient(135deg,#ffffff,#ff80ab)", 
      "linear-gradient(135deg,#ffffff,#40c4ff)", 
      "linear-gradient(135deg,#ffffff,#b2ff59)", 
      "linear-gradient(135deg,#ffffff,#ffeb3b)", 
      "linear-gradient(135deg,#ffffff,#ff7043)", 
      "linear-gradient(135deg,#ffffff,#82b1ff)", 
      "linear-gradient(135deg,#ffffff,#f48fb1)"  
    ];

    const textShadows = [
      "2px 2px 4px rgba(70,50,120,0.6)",  
      "2px 2px 4px rgba(0,100,80,0.6)",   
      "2px 2px 4px rgba(200,80,0,0.6)",   
      "2px 2px 4px rgba(100,0,150,0.6)",  
      "2px 2px 4px rgba(50,0,120,0.6)",   
      "2px 2px 4px rgba(0,60,130,0.6)",   
      "2px 2px 4px rgba(120,0,0,0.6)",    
      "2px 2px 4px rgba(0,90,40,0.6)"    
    ];

    // màu icon
    const colorIcons = [
      ["#ff5f6d","#ffc371"], ["#36d1dc","#5b86e5"],
      ["#f7971e","#ffd200"], ["#00c6ff","#0072ff"],
      ["#ff9a9e","#fad0c4"], ["#a18cd1","#fbc2eb"],
      ["#11998e","#38ef7d"], ["#fdc830","#f37335"]
    ];
    const faIcons = [
      "fa-compass","fa-clock","fa-brain","fa-puzzle-piece",
      "fa-lightbulb","fa-chart-line","fa-people-group","fa-bullseye"
    ];

    function darkenColor(hexColor, percent) {
      let hex = hexColor.replace('#', '');
      if (hex.length === 3) {
        hex = hex.split('').map(ch => ch + ch).join('');
      }

      let red   = parseInt(hex.substr(0, 2), 16);
      let green = parseInt(hex.substr(2, 2), 16);
      let blue  = parseInt(hex.substr(4, 2), 16);

      red   = Math.max(0, Math.round(red   * (100 - percent) / 100));
      green = Math.max(0, Math.round(green * (100 - percent) / 100));
      blue  = Math.max(0, Math.round(blue  * (100 - percent) / 100));

      return `rgba(${red},${green},${blue},0.65)`;
    }

    function getRotateBox(idx) {
      if (idx >= 1 && idx <= 4) {
        return 120 + (idx - 1) * 10;
      }
      const mirror = {5:2, 6:1, 7:4, 8:3};
      return 120 + (mirror[idx] - 1) * 10;
    }

    // Paths cho shape1
    const shape1ViewBox = "0 0 1978.66 2296.06";
    const shape2Content = [
      "Định hướng",
      "Quản lý thời gian",
      "Rèn luyện tư duy",
      "Giải quyết vấn đề",
      "Khơi dậy ý tưởng",
      "Theo dõi tiến bộ",
      "Học nhóm",
      "Đạt mục tiêu"
    ];
    const shape1Paths = [
      // path 1
      "M1978.66,242.85l-177.97,433.9c-246.93-180.19-539.77-318.74-879.62-361.81 c-161.88-20.82-360.15-22.82-589.91,23.39L959.64,75.61C1314.72-72.75,1707.78,4.65,1978.66,242.85z",
      // path 2
      "M1389.61,1646.21c-132.05,60.12-239.85,134.67-328.32,216.81c-1.43,1.31-2.79,2.62-4.22,3.94l-0.29,0.29 c-10.44,9.58-20.25,19.17-30.12,28.98c-117.96,118.24-206.66,254.51-266.09,399.85l-89.84-214.58l-19.74-47l-285.26-682.54 L184.7,918.89L0,476.83l331.12-138.55c229.76-46.2,427.97-44.21,589.91-23.39c339.84,43.07,632.69,181.62,879.62,361.81 l-280.75,683.91l-19.45,47.29l-88.41,215.38C1404.67,1631.03,1397.14,1638.62,1389.61,1646.21z"
    ];

    // render shape1
    $('.km-item').each(function(i){
      const idx = i+1, colors=colorShape2[i], border=darkenColor(colors[0],25);
      // const tilt = [-18,-8,2,10,18,12,4,-6][i];
      const ang  = -135 + 45 * i;
      const rotateBox = getRotateBox(idx);
      const gradId = `grad${idx}`;

      const s1 = `
        <div class="km-orbit" style="transform:rotate(${ang}deg);">
          <div class="km-s1-box" data-idx="${idx}"
               style="transform:translateX(${sizeShape1/2.2}px) rotate(${rotateBox}deg); filter:drop-shadow(0 8px 14px ${border});">
            <svg class="km-s1-svg" viewBox="${shape1ViewBox}">
              <defs>
                <linearGradient id="${gradId}" x1="0" y1="0" x2="1" y2="1">
                  <stop offset="0%" stop-color="${colors[0]}"/>
                  <stop offset="100%" stop-color="${colors[1]}"/>
                </linearGradient>
              </defs>
              <path d="${shape1Paths[0]}" fill="url(#${gradId})" stroke="${border}" stroke-width="2"/>
              <path d="${shape1Paths[1]}" fill="url(#${gradId})" stroke="${border}" stroke-width="1" opacity="0.6"/>
            </svg>
            <i class="km-s1-ico fa-solid ${faIcons[i]}"
               style="--ico-g1:${colorIcons[i][0]}; --ico-g2:${colorIcons[i][1]};"></i>
          </div>
        </div>`;
      $(this).html(s1);
    });

    // đo vị trí S1 để căn shape2
    const items = [];
    $('.km-item').each(function(i){
      const idx = i+1;
      const side = sideMap[idx];
      const s1   = $(this).find('.km-s1-box')[0];
      const rect = s1.getBoundingClientRect();
      const midY = (rect.top + rect.bottom)/2 - stageRect.top;
      const joinXViewport = (side==='left' ? rect.right + gapShape2 : rect.left - gapShape2);
      const joinX = joinXViewport - stageRect.left;
      items.push({idx, side, midY, joinX});

    });

    // path cho shape2
    function buildPathShape2(width,height,side){
      const radius = height/2, smooth = 0.45;
      if(side==='left'){
        return `M${width},${height} H${radius} C${radius*smooth},${height} 0,${height-radius*smooth} 0,${height/2}
                C0,${radius*smooth} ${radius*smooth},0 ${radius},0 H${width} V${height} Z`;
      }else{
        return `M0,0 H${width-radius} C${width-radius*smooth},0 ${width},${radius*smooth} ${width},${height/2}
                C${width},${height-radius*smooth} ${width-radius*smooth},${height} ${width-radius},${height} H0 Z`;
      }
    }

    const centerY = stageRect.height / 2;
    const rowGap = baseHeightShape2 + 24; 
    const rowIndexOf = idx => ({1:0, 2:0, 3:1, 8:1, 4:2, 7:2, 5:3, 6:3}[idx]);

    items.forEach(item=>{
      const {idx, side, midY} = item;
      const extraWidth = [1,2,5,6].includes(idx) ? 80 : 0;
      const widthShape2 = baseWidthShape2 + extraWidth;
      const heightShape2 = baseHeightShape2;

      // --- vị trí left/right ---
      let posAttr, posVal;
      if([2,3,4,5].includes(idx)){   
        posAttr = "right"; posVal = 97;
        if([3,4].includes(idx)) posVal = 95; 
      } else {                    
        posAttr = "left"; posVal = 97;
        if([7,8].includes(idx)) posVal = 95;
      }

      // --- top theo cặp ---
      const row = rowIndexOf(idx); 
      const top = centerY + (row - 1.5) * rowGap - heightShape2/2;

      const gradId=`gradS2_${idx}`;
      const border  = darkenColor(colorShape2[idx-1][0],35);
      const numSize = heightShape2 * 0.81;

      const html = `
        <div class="km-s2-box ${side}" data-idx="${idx}" 
            style="${posAttr}:${posVal}px; top:${top}px; width:${widthShape2}px; height:${heightShape2}px;">
          <svg class="km-s2-svg" viewBox="0 0 ${widthShape2} ${heightShape2}">
            <defs>
              <linearGradient id="${gradId}" x1="0" y1="0" x2="1" y2="0">
                <stop offset="0%" stop-color="${colorShape2[idx-1][0]}" stop-opacity="0.2"/>
                <stop offset="30%" stop-color="${colorShape2[idx-1][0]}" stop-opacity="0.7"/>
                <stop offset="100%" stop-color="${colorShape2[idx-1][1]}" stop-opacity="1"/>
              </linearGradient>
            </defs>
            <path d="${buildPathShape2(widthShape2,heightShape2,side)}" 
                  fill="url(#${gradId})" stroke="${border}" stroke-width="2"/>
          </svg>
          <div class="km-s2-num ${side}" 
               style="width:${numSize}px;height:${numSize}px;">
            <span class="number_shape">${String(idx).padStart(2,'0')}</span>
          </div>
          <div class="km-s2-text"
              style="background:${textGradients[idx-1]};
                      -webkit-background-clip:text;
                      -webkit-text-fill-color:transparent;
                      text-shadow:${textShadows[idx-1]};">
            ${shape2Content[idx-1]}
          </div>
        </div>`;
      $('.km-stage').append(html);
    });

    // hover shape1 -> kích hoạt shape2
    $('.km-stage').on('mouseenter', '.km-s1-box', function(){
      const idx = $(this).data('idx');
      $(this).addClass('active');
      $(`.km-s2-box[data-idx="${idx}"]`).addClass('active');
    }).on('mouseleave', '.km-s1-box', function(){
      const idx = $(this).data('idx');
      $(this).removeClass('active');
      $(`.km-s2-box[data-idx="${idx}"]`).removeClass('active');
    });

    // hover shape2
    $('.km-stage').on('mouseenter', '.km-s2-box', function(){
      const idx = $(this).data('idx');
      $(this).addClass('active');
      $(`.km-s1-box[data-idx="${idx}"]`).addClass('active');
    }).on('mouseleave', '.km-s2-box', function(){
      const idx = $(this).data('idx');
      $(this).removeClass('active');
      $(`.km-s1-box[data-idx="${idx}"]`).removeClass('active');
    });


  }

  // --- Gọi hàm render ---
  renderKnowledgeShapes();
});

