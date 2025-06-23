// Toggle active class for expandable elements
function expand(el) {
    $(el).toggleClass('active');
}

$(document).ready(function() {
    // Initialize event slider
    $('.event-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 2 } },
            { breakpoint: 650, settings: { slidesToShow: 1 } }
        ]
    });
});
