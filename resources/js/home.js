if ("ontouchstart" in window) {
	var click = "touchstart";
} else {
	var click = "click";
}

$("div.burger").on(click, function () {
	if (!$(this).hasClass("open")) {
		openMenu();
	} else {
		closeMenu();
	}
});

$("div.menu ul li a").on(click, function (e) {
	e.preventDefault();
	closeMenu();
});

function openMenu() {
	$("div.burger").addClass("open");
	$("div.y").fadeOut(100);
	$("div.screen").addClass("animate");

	setTimeout(function () {
		$("div.x").addClass("rotate30");
		$("div.z").addClass("rotate150");
		$(".menu").addClass("animate");

		setTimeout(function () {
			$("div.x").addClass("rotate45");
			$("div.z").addClass("rotate135");
		}, 100);
	}, 10);
}

function closeMenu() {
	$("div.screen, .menu").removeClass("animate");
	$("div.y").fadeIn(150);
	$("div.burger").removeClass("open");
	$("div.x").removeClass("rotate45").addClass("rotate30");
	$("div.z").removeClass("rotate135").addClass("rotate150");

	setTimeout(function () {
		$("div.x").removeClass("rotate30");
		$("div.z").removeClass("rotate150");
	}, 50);
	setTimeout(function () {
		$("div.x, div.z").removeClass("collapse");
	}, 70);
}

/* Slide Feature*/
const featureData = [
  {
    title: 'Theo dõi học tập toàn diện',
    text: 'Hệ thống giúp bạn theo dõi toàn bộ hành trình học tập một cách chi tiết và trực quan. Từ tiến trình học, số buổi điểm danh, tổng thời lượng xem video bài giảng cho đến mức độ hoàn thành các bài tập và quiz. Tất cả dữ liệu được cập nhật theo thời gian thực, giúp bạn luôn nắm bắt được hiệu suất của mình để có lộ trình học tập hiệu quả nhất.'
  },
  {
    title: 'Nền tảng E-Learning thế hệ mới',
    text: 'Nền tảng học trực tuyến được thiết kế hiện đại, tối ưu hóa cho mọi thiết bị từ máy tính, tablet đến điện thoại. Bạn có thể dễ dàng truy cập kho bài giảng video chất lượng cao, tham gia các bài kiểm tra ngắn (quiz), thảo luận trực tiếp với giảng viên và các bạn học khác, đồng thời ghi chú ngay trên bài giảng để xem lại bất cứ lúc nào.'
  },
  {
    title: 'Hỗ trợ học tập 1-1 từ Mentor',
    text: 'Bạn sẽ không bao giờ cảm thấy bơ vơ. Đội ngũ Mentor luôn sẵn sàng trả lời mọi thắc mắc của bạn một cách nhanh chóng. Họ sẽ review code, đưa ra những gợi ý tài liệu học tập chuyên sâu và định hướng lộ trình phát triển nghề nghiệp phù hợp với năng lực và mục tiêu của bạn.'
  },
  {
    title: 'Thực chiến với dự án thực tế',
    text: 'Kiến thức được củng cố ngay lập tức thông qua các bài tập và dự án thực tế. Các dự án được xây dựng dựa trên quy trình làm việc chuẩn trong các doanh nghiệp. Ngay sau mỗi buổi học, bạn sẽ có thể áp dụng kiến thức để code các phần của dự án, sau đó triển khai (deploy) và kiểm thử (test) để thấy ngay kết quả của mình.'
  },
  {
    title: 'Cầu nối vững chắc với việc làm',
    text: 'Chúng tôi không chỉ đào tạo mà còn đồng hành cùng bạn trên con đường sự nghiệp. Chương trình bao gồm việc liên kết trực tiếp với các doanh nghiệp, training kỹ năng phỏng vấn, hỗ trợ xây dựng CV và portfolio chuyên nghiệp, và giới thiệu các vị trí thực tập hoặc Fresher phù hợp với năng lực của bạn.'
  },
  {
    title: 'Cộng đồng học viên năng động',
    text: 'Tham gia vào cộng đồng học viên sôi nổi, nơi bạn có thể hỏi đáp các vấn đề gặp phải 24/7, chia sẻ kinh nghiệm học tập và làm việc. Đặc biệt, bạn có thể tham gia các buổi pair-programming để cùng nhau giải quyết những bài toán phức tạp và học hỏi lẫn nhau.'
  }
];

const ring   = document.getElementById('hexRing');
const items  = ring.querySelectorAll('.hex-item');
const title  = document.getElementById('featTitle');
const text   = document.getElementById('featText');
const prev   = document.getElementById('prevBtn');
const next   = document.getElementById('nextBtn');

let activeIndex = 0;

// Layout items around circle using their data-angle

function setActive(index){
  items.forEach(i=>i.classList.remove('active'));
  items[index].classList.add('active');
  activeIndex = index;

  // update right panel
  const d = featureData[index];
  title.textContent = d.title;
  text.textContent  = d.text;
}

items.forEach(btn=>{
  btn.addEventListener('click', ()=> setActive(+btn.dataset.index));
});

prev.addEventListener('click', ()=>{
  setActive( (activeIndex - 1 + items.length) % items.length );
});
next.addEventListener('click', ()=>{
  setActive( (activeIndex + 1) % items.length );
});

// keyboard support
document.addEventListener('keydown', (e)=>{
  if(e.key === 'ArrowLeft')  prev.click();
  if(e.key === 'ArrowRight') next.click();
});

