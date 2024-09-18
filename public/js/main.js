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

    var recommendations = function () {
        $(".recommendations").owlCarousel({
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
    movie_cast();
    recommendations();
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

document.addEventListener("DOMContentLoaded", function () {
    console.log("Flash message script started.");

    setTimeout(function () {
        let flashMessage = document.getElementById("flash-message");
        if (flashMessage) {
            console.log("Flash message found:", flashMessage);

            // Remove Bootstrap's "show" class, which controls visibility
            flashMessage.classList.remove("show");
            console.log('Removed Bootstrap "show" class for fading.');

            // Set opacity to 0 for a fading effect
            flashMessage.style.opacity = "0";
            console.log("Flash message is fading out...");

            // Wait for the fade effect to complete, then remove from DOM
            setTimeout(function () {
                // Finally, apply display: none to hide it
                flashMessage.style.display = "none";
                console.log(
                    "Flash message removed from DOM and display set to none."
                );

                // Optionally, completely remove it from the DOM
                flashMessage.remove();
                console.log("Flash message removed from DOM.");
            }, 1000); // Duration of fade effect
        } else {
            console.log("No flash message found.");
        }
    }, 2000); // Start fading after 2 seconds
});
