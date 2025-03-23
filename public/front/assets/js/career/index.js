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
                    nextArrow: '<button class="slick-next right-arrow"><img src="/front/img/vector-right.png" alt="Right Arrow"></button>',
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
});
