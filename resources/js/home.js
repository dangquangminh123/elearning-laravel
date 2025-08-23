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

    // Thêm class để bắt đầu animation lặp lại
    viewAllBtn.addClass('animate-tada');

    // Sau 20 giây, xóa class để dừng animation
    setTimeout(function() {
        viewAllBtn.removeClass('animate-tada');
    }, 20000); // 20000 milliseconds = 20 giây
});