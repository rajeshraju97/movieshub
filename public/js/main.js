(function ($) {
    "use strict";

    var fullHeight = function () {
        $(".js-fullheight").css("height", $(window).height());
        $(window).resize(function () {
            $(".js-fullheight").css("height", $(window).height());
        });
    };
    fullHeight();

    var carousel = function () {
        $(".home-slider").owlCarousel({
            loop: true,
            autoplay: true,
            margin: 0,
            animateOut: "fadeOut",
            animateIn: "fadeIn",
            nav: true,
            dots: true,
            autoplayHoverPause: false,
            items: 1,
            navText: [
                "<span class='ion-ios-arrow-back'></span>",
                "<span class='ion-ios-arrow-forward'></span>",
            ],
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 1,
                },
            },
        });
    };

    //carosel for the now playing
    var now_playing = function () {
        $(".now-playing").owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            animateOut: "fadeOut",
            animateIn: "fadeIn",
            nav: true,
            dots: false,
            autoplayHoverPause: false,
            items: 8,
            navText: [
                "<span class='ion-ios-arrow-back'></span>",
                "<span class='ion-ios-arrow-forward'></span>",
            ],
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 5,
                },
                1000: {
                    items: 6,
                },
                1200: {
                    items: 8,
                },
            },
        });
    };

    carousel();
    now_playing();
})(jQuery);
