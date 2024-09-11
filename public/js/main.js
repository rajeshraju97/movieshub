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
            autoplayTimeout: 2000, // Time interval between each image (5 seconds)
            autoplayHoverPause: true, // Stop autoplay on hover
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

    var movie_cast = function () {
        $(".movie_cast").owlCarousel({
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
                    items: 7,
                },
                1000: {
                    items: 8,
                },
                1200: {
                    items: 10,
                },
            },
        });
    };

    carousel();
    now_playing();
    movie_cast();
})(jQuery);

$(document).ready(function () {
    $("#language").select2({
        placeholder: "Select a language",
        allowClear: true,
    });
});

function loadVideo(element, videoKey) {
    // Replace the thumbnail image with the iframe
    element.innerHTML = `<iframe width="100%" height="315" src="https://www.youtube.com/embed/${videoKey}?autoplay=1"
                         frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                         allowfullscreen></iframe>`;
}
