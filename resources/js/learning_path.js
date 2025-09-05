$(function(){
  $('.roadmap-item').hover(
    function(){
      $(this).find('.roadmap-box').css('transform','translateY(-8px)');
    },
    function(){
      $(this).find('.roadmap-box').css('transform','translateY(0)');
    }
  );

});



$(function(){
  const SVG_NS = "http://www.w3.org/2000/svg";
  const create = tag => document.createElementNS(SVG_NS, tag);
  const cx = 550, cy = 450;
  const centerR = 120;
  const arcR = 220;
  const arcThickness = 50;
  const outerR = arcR + arcThickness/2;
  const innerR = arcR - arcThickness/2;
  const nodeR = 64;
  const nodeDist = outerR + 100;
  const dotR = 14;

  const items = [
    {label:["Truyền Đạt","Kiến Thức",""], color:"#f57c00", grad:"g0"},
    {label:["Truyền","Cảm Hứng","Học Tập"], color:"#5e35b1", grad:"g1"},
    {label:["Đồng Hành","Cùng","Học Viên"], color:"#2e7d32", grad:"g2"},
    {label:["Chia Sẻ","Kinh Nghiệm","Thực Tiễn"], color:"#1565c0", grad:"g3"},
    {label:["Xây Dựng","Tương Lai","Tri Thức"], color:"#ad1457", grad:"g4"}
  ];

  function polar(r, ang){ return [cx + r*Math.cos(ang), cy - r*Math.sin(ang)]; }
  function polarPoint(r, ang){ const [x,y] = polar(r,ang); return { x:+x.toFixed(4), y:+y.toFixed(4) }; }
  function sectorPath(rOut,rIn,a0,a1){
    const p0 = polarPoint(rOut,a0), p1 = polarPoint(rOut,a1);
    const q0 = polarPoint(rIn,a1), q1 = polarPoint(rIn,a0);
    const delta = a1 - a0;
    const large = Math.abs(delta) > Math.PI ? 1 : 0;
    return `M ${p0.x} ${p0.y} A ${rOut} ${rOut} 0 ${large} 0 ${p1.x} ${p1.y} L ${q0.x} ${q0.y} A ${rIn} ${rIn} 0 ${large} 1 ${q1.x} ${q1.y} Z`;
  }
  function centerAnnularSlicePath(rOut, rIn, a0, a1){
    const p0 = polarPoint(rOut, a0), p1 = polarPoint(rOut, a1);
    const q0 = polarPoint(rIn, a1), q1 = polarPoint(rIn, a0);
    const delta = a1 - a0;
    const large = Math.abs(delta) > Math.PI ? 1 : 0;
    return `M ${p0.x} ${p0.y} 
            A ${rOut} ${rOut} 0 ${large} 1 ${p1.x} ${p1.y} 
            L ${q0.x} ${q0.y} 
            A ${rIn} ${rIn} 0 ${large} 0 ${q1.x} ${q1.y} 
            Z`;
  }

  // 1) half doughnut
  const layerArc = document.getElementById("erp-arcLayer");
  const startArc = 0, endArc = Math.PI;
  const arcStep = (endArc - startArc) / items.length;
  items.forEach((d,i)=>{
    const a0 = startArc + i*arcStep;
    const a1 = startArc + (i+1)*arcStep;
    const seg = create("path");
    seg.setAttribute("d", sectorPath(outerR, innerR, a0, a1));
    seg.setAttribute("fill", `url(#${d.grad})`);
    layerArc.appendChild(seg);
    const mid = (a0 + a1)/2;
    d.arcPt = polar(arcR, mid);
  });

  // 2) nodes + links
  const layerLinks = document.getElementById("erp-linkLayer");
  const layerNodes = document.getElementById("erp-nodeLayer");
  items.forEach((d,i)=>{
    const a0 = startArc + i*arcStep;
    const a1 = startArc + (i+1)*arcStep;
    const midAng = (a0 + a1)/2;
    const [nx,ny] = polar(nodeDist, midAng);

    const ring = create("circle");
    ring.setAttribute("cx", nx); ring.setAttribute("cy", ny); ring.setAttribute("r", nodeR);
    ring.setAttribute("stroke", d.color); ring.setAttribute("fill", "#fff"); ring.setAttribute("class", "erp-node-ring");
    layerNodes.appendChild(ring);

    const txt = create("text");
    txt.setAttribute("x", nx); txt.setAttribute("y", ny);
    txt.setAttribute("text-anchor", "middle"); txt.setAttribute("dominant-baseline", "middle");
    const t1 = create("tspan"); t1.setAttribute("x", nx); t1.setAttribute("dy", "-0.6em"); t1.setAttribute("class","erp-node-text-main"); t1.textContent = d.label[0] || "";
    const t2 = create("tspan"); t2.setAttribute("x", nx); t2.setAttribute("dy", "1.2em"); t2.setAttribute("class","erp-node-text-main"); t2.textContent = d.label[1] || "";
    const t3 = create("tspan"); t3.setAttribute("x", nx); t3.setAttribute("dy", "1.2em"); t3.setAttribute("class","erp-node-text-sub"); t3.textContent = d.label[2] || "";
    txt.appendChild(t1); txt.appendChild(t2); txt.appendChild(t3);
    layerNodes.appendChild(txt);

    const startPt = polarPoint(nodeDist - nodeR + 12, midAng);
    const endPt = { x: d.arcPt[0], y: d.arcPt[1] };
    const link = create("path");
    link.setAttribute("d", `M ${startPt.x} ${startPt.y} L ${endPt.x} ${endPt.y}`);
    link.setAttribute("stroke", d.color); link.setAttribute("class", "erp-link");
    layerLinks.appendChild(link);

    const dot = create("circle");
    dot.setAttribute("cx", endPt.x); dot.setAttribute("cy", endPt.y); dot.setAttribute("r", dotR);
    dot.setAttribute("fill", d.color); dot.setAttribute("class", "erp-dot");
    layerLinks.appendChild(dot);
  });

  // 3) CENTER slices
  const layerCenter = document.getElementById("erp-centerLayer");
  const base = create("circle");
  base.setAttribute("cx", cx); base.setAttribute("cy", cy); base.setAttribute("r", centerR);
  base.setAttribute("class", "erp-center-base");
  layerCenter.appendChild(base);

  const padAnglesDeg = [20,40,15,30,25,35,55];
  let acc = -Math.PI/2;
  const sliceGrads = ["g0","g1","g2","g3","g4","g0","g1"];
  for (let i=0;i<padAnglesDeg.length;i++){
    const rad = padAnglesDeg[i] * Math.PI / 180;
    const a0 = acc;
    const a1 = acc - rad;
    const pathD = centerAnnularSlicePath(centerR, centerR - 20, a0, a1);
    const seg = create("path");
    seg.setAttribute("d", pathD);
    seg.setAttribute("fill", `url(#${sliceGrads[i] || 'centerGrad'})`);
    seg.setAttribute("class", "erp-center-slice");
    layerCenter.appendChild(seg);
    acc = a1;
  }

  // CENTER text
  const title = create("text"); 
  title.setAttribute("x", cx); title.setAttribute("y", cy - 10);
  title.setAttribute("class", "erp-center-title"); 
  title.setAttribute("text-anchor", "middle");
  title.setAttribute("dominant-baseline", "middle");
  title.setAttribute("textLength", centerR*1.6);
  title.setAttribute("lengthAdjust", "spacingAndGlyphs");
  title.textContent = "ĐIỂM NHẤN"; 
  layerCenter.appendChild(title);

  const sub = create("text"); 
  sub.setAttribute("x", cx); sub.setAttribute("y", cy + 28);
  sub.setAttribute("class", "erp-center-sub"); 
  sub.setAttribute("text-anchor", "middle");
  sub.setAttribute("dominant-baseline", "middle");
  sub.setAttribute("textLength", centerR*1.2);
  sub.setAttribute("lengthAdjust", "spacingAndGlyphs");
  sub.textContent = "DSCons"; 
  layerCenter.appendChild(sub);
});
