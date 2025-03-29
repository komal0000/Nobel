$(document).ready(function() {
    // Initialize lightbox
    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Initialize sliders with common settings
    $('.doctor-slider, .testimonials-slider, .animated-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
            breakpoint: 991,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                centerMode: true
            }
        }]
    });

    // Combine the resize events for performance
    $(window).on('load resize', function() {
        equalizeCardHeight('.doctor-card');
        equalizeCardHeight('.testimonials-card');
        equalizeCardHeight('.animated-card');
    });
});
