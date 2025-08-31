document.addEventListener('DOMContentLoaded',function(){
  var container=document.getElementById('carouselContainer');
  var scene=document.getElementById('scene');
  var carousel=document.getElementById('carousel');
  var items=carousel.querySelectorAll('.carouselItem');
  if(!container||items.length===0)return;

  var itemCount=items.length;
  var rotationY=0,velocity=0,isDragging=false,lastX=0;
  var AUTO_ROTATE=1;    // tốc độ tự xoay
  var DRAG_FACTOR=0.6;
  var FRICTION=0.92;
  var MIN_SCALE=0.9,MAX_SCALE=1.0,currentScale=1,radius=0;

  function computeRadius(){
    var inner=items[0].querySelector('.carouselItemInner');
    var itemW=inner.offsetWidth;
    var safe=8;
    // góc giữa các item
    var angleStep=(2*Math.PI)/Math.max(3,itemCount);
    // bán kính hình học để không đè nhau
    var geomRadius=(itemW/2)/Math.tan(angleStep/2)+60;
    var maxRadiusX=(container.clientWidth/2)-(itemW/2)-safe;
    radius=Math.max(140,Math.min(maxRadiusX,geomRadius));

    // nếu item nhiều quá -> scale nhỏ thẻ
    var idealScale=Math.min(1, Math.max(0.5, (container.clientWidth/(itemCount*itemW))*2 ));
    items.forEach(function(it){
      it.querySelector('.carouselItemInner').style.transform="scale("+idealScale+")";
    });
  }

  function computeMaxScale(){
    var cRect=container.getBoundingClientRect();
    var card=items[0].querySelector('.carouselItemInner');
    var cardRect=card.getBoundingClientRect();
    var maxW=(cRect.width-16)/cardRect.width;
    var maxH=(cRect.height-16)/cardRect.height;
    MAX_SCALE=Math.min(1.0,Math.max(0.8,Math.min(maxW,maxH)));
  }

  function animateInItem(el,index,finalProps){
    var rx=(Math.random()*800)-400;
    var ry=(Math.random()*600)-300;
    var rz=(Math.random()*800)-400;
    TweenMax.set(el,{x:rx,y:ry,z:rz,rotationY:0,autoAlpha:0});
    TweenMax.to(el,1.0+(index*0.05),{
      x:0,y:0,z:0,rotationY:finalProps.rotationY,autoAlpha:1,
      ease:Power3.easeOut,delay:index*0.06,
      onComplete:function(){ TweenMax.set(el,finalProps); }
    });
  }

  function layoutItems(withAnimation){
    computeRadius();
    computeMaxScale();
    var step=360/itemCount;
    TweenMax.set(carousel,{xPercent:-50,yPercent:-50,transformPerspective:1200});
    for(var i=0;i<itemCount;i++){
      var el=items[i];
      var theta=i*step;
      var finalProps={
        rotationY:theta,
        z:radius,
        xPercent:-50,
        yPercent:-50,
        autoAlpha:1,
        scale:1,
        transformOrigin:"50% 50% "+(-radius)+"px"
      };
      if(withAnimation) animateInItem(el,i,finalProps);
      else TweenMax.set(el,finalProps);
    }
    TweenMax.set(scene,{z:-radius,scale:currentScale});
  }

  function applyTransforms(){
    currentScale=Math.max(MIN_SCALE,Math.min(MAX_SCALE,currentScale));
    TweenMax.set(scene,{scale:currentScale});
    TweenMax.set(carousel,{rotationY:rotationY,force3D:true});
  }

  function rafLoop(){
    if(!isDragging){
      velocity+=(AUTO_ROTATE-velocity)*0.02;
      velocity*=FRICTION;
    } else velocity*=0.98;
    rotationY+=velocity;
    if(rotationY>36000||rotationY<-36000) rotationY%=360;
    applyTransforms();
    requestAnimationFrame(rafLoop);
  }

  function onPointerDown(e){
    isDragging=true;
    lastX=(e.clientX||(e.touches&&e.touches[0].clientX)||0);
    velocity=0;
    container.classList.add('grabbing');
  }
  function onPointerMove(e){
    if(!isDragging)return;
    var clientX=(e.clientX||(e.touches&&e.touches[0].clientX)||0);
    var dx=clientX-lastX;
    lastX=clientX;
    var deltaAngle=dx*DRAG_FACTOR;
    rotationY+=deltaAngle;
    velocity=deltaAngle*0.85;
  }
  function onPointerUp(){
    isDragging=false;
    container.classList.remove('grabbing');
  }

  container.addEventListener('wheel',function(e){
    e.preventDefault();
    var newScale=currentScale+(e.deltaY<0?0.05:-0.05);
    newScale=Math.max(MIN_SCALE,Math.min(MAX_SCALE,newScale));
    TweenMax.to({s:currentScale},0.4,{
      s:newScale,ease:Power2.easeOut,
      onUpdate:function(){ currentScale=this.target.s; applyTransforms(); }
    });
  },{passive:false});

  container.addEventListener('pointerdown',onPointerDown,{passive:true});
  window.addEventListener('pointermove',onPointerMove,{passive:true});
  window.addEventListener('pointerup',onPointerUp);
  window.addEventListener('resize',function(){ layoutItems(false); });

  layoutItems(true);
  requestAnimationFrame(rafLoop);
});
