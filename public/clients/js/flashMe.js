/*
* flashMe.js
* version 1.0
* */
(function ($) {
    $.fn.flashMe = function (options) {
        var settings = $.extend({
            colors: "surprise",
            backgroundColors: false,
            interval: 1000,
            transition: false,
        }, options);

        var el = this;

        setInterval(function () {
            var c;
            var bc;
            
            if (settings.colors !== false) {
                if (settings.colors == "surprise") {
                    c = "#" + ((1 << 24) * Math.random() | 0).toString(16);
                } else if (Array.isArray(settings.colors)) {
                    c = settings.colors[Math.floor(Math.random() * settings.colors.length)];
                } else {
                    c = settings.colors;
                }
                el.css("color", c);
                if (settings.transition !== false) {
                    el.css("transition", "color " + settings.transition + "ms linear");
                }
            }

            if (settings.backgroundColors !== false) {
                if (settings.backgroundColors == "surprise") {
                    bc = "#" + ((1 << 24) * Math.random() | 0).toString(16);
                } else if (Array.isArray(settings.backgroundColors)) {
                    bc = settings.backgroundColors[Math.floor(Math.random() * settings.backgroundColors.length)];
                } else {
                    bc = settings.backgroundColors;
                }
                el.css("background-color", bc);
                if (settings.transition !== false) {
                    el.css("transition", "background-color " + settings.transition + "ms linear");
                }
            }
        }, settings.interval);
    };
}(jQuery));