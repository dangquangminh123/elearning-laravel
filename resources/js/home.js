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

// course nổi bật
$(document).ready(function() {
    const viewAllBtn = $('.view-all-btn');
    viewAllBtn.addClass('animate-tada');

    // Sau 20 giây, xóa class để dừng animation
    setTimeout(function() {
        viewAllBtn.removeClass('animate-tada');
    }, 20000);

	// Hiệu ứng lấp lánh cho hình ảnh lớn khi di chuột vào promo-card
    $('.promo-card').hover(
        function() {
            $(this).sparkle({
                count: 50,
                color: ["#12CBC4","#EE5A24", "#FFC312", "#EA2027", "#D980FA", "#0652DD"],
                overlap: 50,
				minSize: 10,
				maxSize: 20,
				direction: "both",
            });
        },
        function() {
            // Loại bỏ sparkles khi di chuột ra
            $(this).sparkle('destroy');
        }
    );

	 $('.small-heading').hover(
        function() {
            $(this).sparkle({
                count: 50,
                color: ["#12CBC4","#EE5A24", "#FFC312", "#EA2027", "#D980FA", "#0652DD"],
                overlap: 50,
				minSize: 5,
				direction: "both",
            });
        },
        function() {
            $(this).sparkle('destroy');
        }
    );

    $('.course-item').hover(
        function() {
            $(this).find('.course-icon-container, .course-title').sparkle({
                count: 20,
                color: '#EE5A24',
                overlap: 20,
				minSize: 5,
            });
        },
        function() {
            $(this).find('.course-icon-container, .course-title').sparkle('destroy');
        }
    );
});