$(function(){
  $('.roadmap-item').hover(
    function(){
      $(this).find('.roadmap-box').css('transform','translateY(-8px)');
    },
    function(){
      $(this).find('.roadmap-box').css('transform','translateY(0)');
    }
  );


    const svg = $("#mychart");
      const cx = 550, cy = 400; // tâm svg
      const nodeRadius = 70;
      const nodeDistance = 300;
      const arcRadius = 220;
      const dotRadius = 16;
      const centerR = 150;

      const colors = [
        {c:"#F3A623", label:["Quản Lý","Quan Hệ","Khách Hàng"]},
        {c:"#6657C8", label:["Quản Lý","Nhân Sự","Tiền Lương"]},
        {c:"#2F9E5A", label:["Quản Lý","Tòa Nhà",""]},
        {c:"#2A7FDB", label:["Quản Lý","Tài Chính",""]},
        {c:"#E15583", label:["Văn Phòng","Điện Tử",""]}
      ];

      const gLinks = $("#mychart-links");
      const gArc   = $("#mychart-arc");
      const gNodes = $("#mychart-nodes");
      const gCenter= $("#mychart-center");

      function polar(r, ang){
        return [cx + r * Math.cos(ang), cy + r * Math.sin(ang)];
      }

      function arcPath(r, a0, a1){
        const [x1,y1]=polar(r,a0), [x2,y2]=polar(r,a1);
        return `M${x1},${y1} A${r},${r} 0 0 1 ${x2},${y2}`;
      }

      // vẽ nửa vòng cung (chia 5 đoạn màu)
      const start = Math.PI, end = 0, step = (start-end)/colors.length;
      colors.forEach((d,i)=>{
        const a0 = start - i*step, a1 = start - (i+1)*step;
        const path = arcPath(arcRadius, a0, a1);
        $("<path>").attr({d:path, stroke:d.c})
          .addClass("mychart-arc-path").appendTo(gArc);

        const mid = (a0+a1)/2;
        const [dx,dy] = polar(arcRadius,mid);
        $("<circle>").attr({cx:dx,cy:dy,r:dotRadius,fill:d.c})
          .addClass("mychart-arc-dot mychart-shadow").appendTo(gArc);

        d.arcPt = {x:dx,y:dy,ang:mid};
      });

      // vẽ nodes + links
      colors.forEach((d,i)=>{
        const midAng = start - (i+0.5)*step;
        const [nx,ny] = polar(nodeDistance, midAng);

        $("<circle>").attr({cx:nx,cy:ny,r:nodeRadius,stroke:d.c})
          .addClass("mychart-node-ring mychart-shadow").appendTo(gNodes);

        const txt = $("<text>").attr({x:nx,y:ny-10});
        txt.append($("<tspan>").attr({x:nx,dy:0})
          .addClass("mychart-node-text-main").text(d.label[0]));
        txt.append($("<tspan>").attr({x:nx,dy:18})
          .addClass("mychart-node-text-main").text(d.label[1]));
        txt.append($("<tspan>").attr({x:nx,dy:18})
          .addClass("mychart-node-text-sub").text(d.label[2]));
        gNodes.append(txt);

        $("<line>").attr({
          x1:nx,y1:ny, x2:d.arcPt.x,y2:d.arcPt.y, stroke:d.c
        }).addClass("mychart-link").appendTo(gLinks);
      });

      // vẽ trung tâm (7 slice padAngle nửa trái)
      const padAngles = [20,40,15,30,25,35,55];
      let acc = Math.PI; 
      padAngles.forEach((deg,i)=>{
        const rad = deg*Math.PI/180;
        const [x1,y1]=polar(centerR,acc);
        const [x2,y2]=polar(centerR,acc+rad);
        const d=`M${cx},${cy} L${x1},${y1} A${centerR},${centerR} 0 0 1 ${x2},${y2} Z`;
        $("<path>").attr({d,fill:colors[i%colors.length].c})
          .addClass("mychart-center-slice mychart-shadow").appendTo(gCenter);
        acc+=rad;
      });

      $("<text>").attr({x:cx,y:cy-10})
        .text("PadAngle").addClass("mychart-center-title").appendTo(gCenter);
      $("<text>").attr({x:cx,y:cy+30})
        .text("7 slices").addClass("mychart-center-sub").appendTo(gCenter);
  
});
