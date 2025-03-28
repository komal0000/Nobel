/**
 * Equalizes the height of elements matching the selector
 * @param {string} selector - CSS selector for elements to equalize
 */
function equalizeCardHeight(selector) {
    let maxHeight = 0;

    $(selector).css('height', 'auto').each(function() {
        maxHeight = Math.max(maxHeight, $(this).height());
    });

    $(selector).height(maxHeight);
}

$(document).ready(function() {
    let $slider = $('#slick-slider');

    function initSlider() {
        if ($(window).width() <= 1299) {
            if (!$slider.hasClass('slick-initialized')) {
                $slider.slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                    nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                    responsive: [{
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                slidesToShow: 2,
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                arrows: false
                            }
                        }
                    ]
                });
            }
        } else {
            if ($slider.hasClass("slick-initialized")) {
                $slider.slick("unslick");
            }
        }

        if ($(window).width() <= 768) {
            $('.slick-prev, .slick-next').hide();
        } else {
            $('.slick-prev, .slick-next').show();
        }
    }

    initSlider();
    $(window).on("resize", function() {
        initSlider();
    });
    function setActive(el) {
        $('.sp-btn').removeClass('active-btn');
        $(el).addClass('active-btn');
    }
    $('#default-speciality-wrap').click(function() {
        if ($('#list-wrap').css('display') == 'block') {
            $('#list-wrap').css('display', 'none');
            return;
        }
        $('#list-wrap').css('display', 'block');
    });

    $('#list-wrap ul li').click(function() {
        const selectedText = $(this).text();
        const selectedValue = $(this).data('value');

        $('#default-speciality-wrap span.default-speciality-item').text(selectedText);
        $('#find-doc-location-input').val(selectedValue);
        $('#list-wrap').css('display', 'none');
    });

    $('.click-circle').on('click', function(e) {
        e.preventDefault();
        let imgSrc = $(this).attr('datasrc');

        $('.center-image').attr('src', imgSrc);

        let $image = $('.center-image');

        $image.css('transition', 'none');
        $image.css({
            'transform': 'scale(0.01)',
            'opacity': '0'
        });
        $image[0].offsetHeight;

        setTimeout(function() {
            $image.css('transition', 'transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.8s ease');
            $image.css({
                'transform': 'scale(1)',
                'opacity': '1'
            });
        }, 50);

        $('.click-circle').removeClass('active');
        $(this).addClass('active');
        $('.why-block').removeClass('active-why');
        $(this).closest('.why-block').addClass('active-why');
    });

    $('.center-image').addClass('normal');

    $('.service-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });

    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    $('.video-wrapper').slick({
        slidesToShow: 3,
        infinite: true,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 2,
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    // Update slider initialization
    $('.update-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // Award slider initialization
    $('.award-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    // Custom slider initialization
    $('.slider-67e651c3b9ea1').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                },
            },
        ],
    });

    // Navbar toggle
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar');
        $('#navbar').css({
            'transform': 'scale(1)'
        });
    });
});

// Tab changing functionality
function changeTab(el) {
    let tabId = $(el).data('target');
    $('.tab').removeClass('active-tab');
    $(el).addClass('active-tab');

    $('.event-list').removeClass('active').hide();
    $('#' + tabId).addClass('active').fadeIn();
}

// Menu interaction functions
function extendSubMenu(el) {
    if ($(el).hasClass('active-list')) {
        $(el).removeClass('active-list');
        return;
    }
    $('.navbar-item').removeClass('active-list');
    $(el).addClass('active-list');
}

function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    if ($(el).hasClass('active-knowledge')) {
        $(el).removeClass('active-knowledge');
        return;
    }
    $(el).addClass('active-knowledge');
}

function expand(el) {
    $(el).toggleClass('active');
}
