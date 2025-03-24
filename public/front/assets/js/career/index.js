$(document).ready(function() {
    function slickToggler() {
        let $slider = $('#slide');

        if ($(window).width() < 1199) {
            if (!$slider.hasClass('slick-initialized')) {
                $slider.slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                    nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2,

                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                            }
                        }
                    ]
                });
            }
        } else {
            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }
        }
    }
    slickToggler();
    $(window).resize(slickToggler);
    $('.employee-slider').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        centerMode: false,
        infinite: true,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    function toggleAward() {
        if ($(window).width() < 992) {
            if (!$('.award-slider').hasClass('.slick-initialized')) {
                $('.award-slider').slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                    nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                    responsive: [{
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }]
                })
            } else {
                if ($('.award-slider').hasClass('slick-initialized')) {
                    $('.award-slider').unslick();
                }
            }
        }

    }
    toggleAward();
    $(window).resize(toggleAward);
    function changeTab(el) {
        console.log('click');

        $('.tab').removeClass('active-tab');
        $(el).addClass('active-tab');
    }
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
    });
    $('#slick-slider').slick({
        // autoplay: true,
        // autoplaySpeed: 2000,
        arrows: false,
        dots: true
    })
});
