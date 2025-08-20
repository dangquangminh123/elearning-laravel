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
const ring = document.getElementById('hexRing');

// Check if the hexRing element exists before proceeding.
if (ring) {
  const items = ring.querySelectorAll('.hex-item');
  const wraps = ring.querySelectorAll('.hex-wrap');
  const title = document.getElementById('featTitle');
  const text = document.getElementById('featText');
  const prev = document.getElementById('prevBtn');
  const next = document.getElementById('nextBtn');

  let activeIndex = 0;

  function setActive(index) {
    items.forEach(i => i.classList.remove('active'));
    wraps.forEach(w => w.classList.remove('active-wrap'));

    items[index].classList.add('active');
    items[index].parentElement.classList.add('active-wrap');
    
    activeIndex = index;

    const d = featureData[index];
    title.textContent = d.title;
    text.textContent = d.text;
  }

  items.forEach(btn => {
    btn.addEventListener('click', () => setActive(+btn.dataset.index));
  });

  prev.addEventListener('click', () => {
    setActive((activeIndex - 1 + items.length) % items.length);
  });
  next.addEventListener('click', () => {
    setActive((activeIndex + 1) % items.length);
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') prev.click();
    if (e.key === 'ArrowRight') next.click();
  });

  window.addEventListener('load', () => {
    setActive(activeIndex);
  });
}


const circleData = [
  {
    title: 'Cá nhân hóa',
    text: 'Chương trình huấn luyện của 1HV được lên kế hoạch cân thân, chi tiết, nhằm từng bước xây dựng vững chắc các kỹ năng chuyên môn và phát triển nghề nghiệp dựa trên khả năng của mỗi HV. Mỗi HV luôn có một huấn luyện viên hỗ trợ và huấn luyện.'
  },
  {
    title: 'Đổi mới sáng tạo',
    text: 'Unicode sử dụng ứng dụng công nghệ Giáo dục vào trong mọi ngóc ngách của giải pháp đào tạo của mình, từ đó mang lại trải nghiệm và hiệu quả học tập tốt nhất cho học viên. Đội ngũ Nghiên cứu và Phát triển của Unicode luôn sáng tạo và tích hợp nhiều kỹ thuật dạy và học tiên tiến.'
  },
  {
    title: 'Đồng bộ hóa',
    text: 'Unicode tự hào là đơn vị đầu tiên ở Việt Nam triển khai thành công mô hình Coding Bootcamp. Đây là một mô hình đào tạo lập trình hiệu quả cao giúp học viên nhanh chóng trưởng thành và đạt được trình độ sẵn sàng tham gia ngay vào thị trường việc làm.'
  },
  {
    title: 'Tăng cường tương tác',
    text: 'Chương trình học tập của chúng tôi luôn tăng cường tương tác giữa học viên với giảng viên, với các bạn học khác, và với cộng đồng. Điều này giúp các học viên có thể học hỏi, trao đổi kiến thức và kinh nghiệm một cách hiệu quả nhất, giúp các học viên có được sự tự tin và kinh nghiệm làm việc thực tế.'
  },
  {
    title: 'Học tập hiệu quả',
    text: 'Chúng tôi xây dựng một lộ trình học tập hiệu quả, giúp học viên có thể tiếp thu kiến thức một cách nhanh chóng và hiệu quả. Các học viên sẽ được học những kiến thức cần thiết để làm việc thực tế, và được thực hành trên các dự án thực tế để rèn luyện kỹ năng.'
  },
];

const circleRing = document.getElementById('circleRing');

if (circleRing) {
  const circleItems = circleRing.querySelectorAll('.circle-item');
  const circleItemContainer = document.getElementById('circleItemContainer');
  const featTitle = document.getElementById('featTitle');
  const featText = document.getElementById('featText');
  const centerText = document.getElementById('centerText');
  const icons = circleItemContainer.querySelectorAll('.circle-item i'); // Lấy tất cả icons một lần

  let activeCircleIndex = 0;
  let autoRotateInterval;
  const degreesPerItem = 72;
  const radius = 13; // 13rem cho màn hình lớn
  const responsiveRadius = 9; // 9rem cho màn hình nhỏ
  
  let currentRotation = 0;
  let isMobile = window.matchMedia("(max-width: 62rem)").matches;

  // Hàm tính toán và đặt vị trí ban đầu của các item
  function setInitialPositions() {
    const r = isMobile ? responsiveRadius : radius;
    circleItems.forEach((item, index) => {
      const angle = (90 + index * degreesPerItem);
      const radians = (angle * Math.PI) / 180;
      const x = r * Math.cos(radians);
      const y = r * Math.sin(radians);
      item.style.top = `calc(50% - ${y}rem)`;
      item.style.left = `calc(50% + ${x}rem)`;
      // Đảm bảo item luôn ở giữa
      item.style.transform = `translate(-50%, -50%)`;
      
      const icon = item.querySelector('i');
      if(icon) {
        icon.style.transform = `rotate(${-currentRotation}deg)`;
      }
    });
  }

  // Hàm cập nhật trạng thái active và nội dung
  function setCircleActive(index) {
    circleItems.forEach(i => i.classList.remove('active'));
    circleItems[(index % circleItems.length + circleItems.length) % circleItems.length].classList.add('active');
    activeCircleIndex = index;

    const d = circleData[(index % circleData.length + circleData.length) % circleData.length];
    featTitle.textContent = d.title;
    featText.textContent = d.text;
    centerText.textContent = d.text;
  }

  // Hàm xoay tự động
  function autoRotate() {
    autoRotateInterval = setInterval(() => {
      const nextIndex = (activeCircleIndex + 1) % circleItems.length;

      // Xoay theo chiều kim đồng hồ
      currentRotation += degreesPerItem;
      circleItemContainer.style.transform = `rotate(${currentRotation}deg)`;
      
      // Xoay ngược lại icons để chúng luôn thẳng đứng
      icons.forEach(icon => {
        icon.style.transform = `rotate(${-currentRotation}deg)`;
      });

      setCircleActive(nextIndex);
    }, 3000);
  }

  circleItems.forEach((btn, index) => {
    btn.addEventListener('click', () => {
      clearInterval(autoRotateInterval);
      const newIndex = +btn.dataset.index;
      
      // Tính toán sự khác biệt về chỉ số
      let indexDifference = newIndex - activeCircleIndex;
      
      // Nếu di chuyển từ item cuối cùng về item đầu tiên,
      // chúng ta phải đi thêm một vòng
      if (indexDifference < 0) {
        indexDifference += circleItems.length;
      }
      
      // Tính toán góc xoay dựa trên sự khác biệt chỉ số
      const rotationDifference = indexDifference * degreesPerItem;
      currentRotation += rotationDifference;
      
      circleItemContainer.style.transform = `rotate(${currentRotation}deg)`;
      
      // Xoay ngược lại icons để chúng luôn thẳng đứng
      icons.forEach(icon => {
        icon.style.transform = `rotate(${-currentRotation}deg)`;
      });

      setCircleActive(newIndex);
    });
  });

  window.addEventListener('load', () => {
    setInitialPositions();
    setCircleActive(activeCircleIndex);
    autoRotate();
  });

  window.addEventListener('resize', () => {
    isMobile = window.matchMedia("(max-width: 62rem)").matches;
    setInitialPositions();
  });
}