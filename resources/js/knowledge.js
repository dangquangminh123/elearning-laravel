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
  const root = document.getElementById('km-module');
  const css  = getComputedStyle(root);

  const S1   = parseFloat(css.getPropertyValue('--s1-size'));
  const S2_W = parseFloat(css.getPropertyValue('--s2-w')) || 400;
  const S2_H = parseFloat(css.getPropertyValue('--s2-h')) || 110;
  const S2_GAP = parseFloat(css.getPropertyValue('--s2-gap')) || 6; 

  const stage  = document.querySelector('.km-stage');
  const stRect = stage.getBoundingClientRect();

  const sideMap = {1:'left',2:'right',3:'right',4:'right',5:'right',6:'left',7:'left',8:'left'};

  // màu nền thanh
  const g = [
    ["#6a5af9","#2ed3ea"], ["#1fd2ff","#3de39a"],
    ["#ffa85c","#ff6f91"], ["#ff6ec4","#8a5cff"],
    ["#7c4dff","#fca5a5"], ["#00c2ff","#647dee"],
    ["#ff8f70","#ff3d54"], ["#47e891","#1fbfff"]
  ];
  // màu icon (khác nền)
  const gIcons = [
    ["#ff5f6d","#ffc371"], ["#36d1dc","#5b86e5"],
    ["#f7971e","#ffd200"], ["#00c6ff","#0072ff"],
    ["#ff9a9e","#fad0c4"], ["#a18cd1","#fbc2eb"],
    ["#11998e","#38ef7d"], ["#fdc830","#f37335"]
  ];
  const faList = [
    "fa-compass","fa-clock","fa-brain","fa-puzzle-piece",
    "fa-lightbulb","fa-chart-line","fa-people-group","fa-bullseye"
  ];
  const darken=(hex,p)=>{
    let c=hex.replace('#',''); if(c.length===3) c=c.split('').map(x=>x+x).join('');
    let r=parseInt(c.substr(0,2),16),g=parseInt(c.substr(2,2),16),b=parseInt(c.substr(4,2),16);
    r=Math.max(0,Math.round(r*(100-p)/100));
    g=Math.max(0,Math.round(g*(100-p)/100));
    b=Math.max(0,Math.round(b*(100-p)/100));
    return `rgba(${r},${g},${b},0.65)`;
  };

  // SHAPE1
  const shape1Paths = [
    "M87.34,52.78C71.9,32.52,57.7,22.32,49.59,17.37c-2.12-1.29-6.18-3.65-11.85-5.6c0,0-15.86-5.42-34.27,0.89c-0.38,0.13-2.3,0.79-3.05,2.13c0.39-0.78,1.06-1.44,1.93-1.8L26.43,2.88C45.19-5,66.78,3.83,74.66,22.59L87.34,52.78z",
    "M85.29,57.81L30.78,80.7c-1.96,0.82-4.21-0.1-5.03-2.05L0.3,18.03c-0.05-0.11-0.09-0.22-0.12-0.33c-0.03-0.09-0.06-0.18-0.07-0.27c-0.02-0.07-0.03-0.14-0.05-0.21c-0.02-0.1-0.03-0.2-0.05-0.3c0,0-0.01-0.1-0.01-0.26c0-0.06,0-0.14,0.01-0.22c0.01-0.08,0.01-0.17,0.02-0.26c0.01-0.12,0.03-0.23,0.05-0.35c0.02-0.16,0.06-0.33,0.12-0.5c0.02-0.06,0.03-0.11,0.06-0.17c0.01-0.02,0.02-0.04,0.02-0.06C0.3,15.06,0.31,15.03,0.33,15c0.02-0.07,0.06-0.14,0.09-0.2c0.75-1.34,2.66-2,3.05-2.13c18.4-6.31,34.27-0.89,34.27-0.89c5.68,1.94,9.74,4.31,11.85,5.6c8.11,4.95,22.31,15.15,37.75,35.41C88.17,54.74,87.24,56.98,85.29,57.81z"
  ];

  $('.km-item').each(function(i){
    const idx = i+1, colors=g[i], border=darken(colors[0],25);
    const tilt = [-18,-8,2,10,18,12,4,-6][i];
    const ang  = -135 + 45*i;
    const gradId = `grad${idx}`;

    const s1 = `
      <div class="km-orbit" style="transform:rotate(${ang}deg);">
        <div class="km-s1-box"
             style="transform:translateX(${S1/1.3 }px) rotate(${tilt}deg); filter:drop-shadow(0 8px 14px ${border});">
          <svg class="km-s1-svg" viewBox="0 0 87.64 81">
            <defs>
              <linearGradient id="${gradId}" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="${colors[0]}"/>
                <stop offset="100%" stop-color="${colors[1]}"/>
              </linearGradient>
            </defs>
            <path d="${shape1Paths[0]}" fill="url(#${gradId})" stroke="${border}" stroke-width="2"/>
            <path d="${shape1Paths[1]}" fill="url(#${gradId})" stroke="${border}" stroke-width="1" opacity="0.6"/>
          </svg>
          <i class="km-s1-ico fa-solid ${faList[i]}"
             style="transform:rotate(${-(ang)}deg); --ico-g1:${gIcons[i][0]}; --ico-g2:${gIcons[i][1]};"></i>
        </div>
      </div>`;
    $(this).html(s1);
  });

  // đo vị trí S1 (để S2 bám đúng mép thật của S1)
  const items = [];
  $('.km-item').each(function(i){
    const idx = i+1;
    const side = sideMap[idx];
    const s1   = $(this).find('.km-s1-box')[0];
    const r    = s1.getBoundingClientRect();
    const midY = (r.top + r.bottom)/2 - stRect.top;
    const joinXViewport = (side==='left' ? r.right + S2_GAP : r.left - S2_GAP);
    const joinX = joinXViewport - stRect.left; // về hệ tọa độ của stage
    items.push({idx, side, midY, joinX});
  });

  // path 1 đầu tròn – 1 đầu vuông
  function s2Path(W,H,side){
    const r = H/2, k = 0.45; // k làm tròn mềm
    if(side==='left'){
      return `M${W},${H} H${r} C${r*k},${H} 0,${H-r*k} 0,${H/2}
              C0,${r*k} ${r*k},0 ${r},0 H${W} V${H} Z`;
    }else{
      return `M0,0 H${W-r} C${W-r*k},0 ${W},${r*k} ${W},${H/2}
              C${W},${H-r*k} ${W-r*k},${H} ${W-r},${H} H0 Z`;
    }
  }

  const pairMap = {
    "1": [1,2],
    "2": [3,8],
    "3": [4,7],
    "4": [5,6]
  };

  // tạm lưu top theo cặp
  const pairTop = {};
  
  items.forEach(x=>{
    const {idx, side, midY, joinX} = x;
    const extra = [1,2,5,6].includes(idx) ? 80 : 0;
    const W = S2_W + extra, H = S2_H;

    // --- LEFT / RIGHT ---
    let posAttr, posVal;
    if([2,3,4,5].includes(idx)){   
      posAttr = "right";
      posVal  = 97;              
      if([3,4].includes(idx)) posVal = 97 - 2; 
    } else {                    
      posAttr = "left";
      posVal  = 97;
      if([7,8].includes(idx)) posVal = 97 - 2;
    }

    // --- TOP theo cặp ---
    const pairKey = Object.keys(pairMap).find(k => pairMap[k].includes(idx));
    if(!pairTop[pairKey]) pairTop[pairKey] = midY - H/2;
    const top = pairTop[pairKey];

    const gradId=`gradS2_${idx}`;
    const border  = darken(g[idx-1][0],35);
    const bubble  = darken(g[idx-1][0],45);

    const html = `
       <div class="km-s2-box ${side}" 
        style="${posAttr}:${posVal}px; top:${top}px; width:${W}px; height:${H}px;">
      <svg class="km-s2-svg" viewBox="0 0 ${W} ${H}">
        <defs>
          <linearGradient id="${gradId}" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="${g[idx-1][0]}"/>
            <stop offset="100%" stop-color="${g[idx-1][1]}"/>
          </linearGradient>
        </defs>
        <path d="${s2Path(W,H,side)}" fill="url(#${gradId})" stroke="${border}" stroke-width="2"/>
      </svg>
      <div class="km-s2-num ${side}" style="--h:${H}px; background:${bubble};">
        ${String(idx).padStart(2,'0')}
      </div>
    </div>`;
    $('.km-stage').append(html);
  });
});
