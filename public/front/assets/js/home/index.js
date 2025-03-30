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

/**
 * Changes the active tab
 * @param {HTMLElement} el - Tab element to activate
 */
function changeTab(el) {
    let tabId = $(el).data('target');
    $('.tab').removeClass('active-tab');
    $(el).addClass('active-tab');

    $('.event-list').removeClass('active').hide();
    $('#' + tabId).addClass('active').fadeIn();
}

/**
 * Sets the active speciality button
 * @param {HTMLElement} el - Button element to activate
 */
function setActive(el) {
    $('.sp-btn').removeClass('active-btn');
    $(el).addClass('active-btn');
}

/**
 * Handles submenu extension
 * @param {HTMLElement} el - Menu element to extend
 */
function extendSubMenu(el) {
    if ($(el).hasClass('active-list')) {
        $(el).removeClass('active-list');
        return;
    }
    $('.navbar-item').removeClass('active-list');
    $(el).addClass('active-list');
}

/**
 * Handles knowledge submenu extension
 * @param {HTMLElement} el - Submenu element to extend
 * @param {Event} event - Click event
 */
function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    if ($(el).hasClass('active-knowledge')) {
        $(el).removeClass('active-knowledge');
        return;
    }
    $(el).addClass('active-knowledge');
}

/**
 * Toggles element expansion
 * @param {HTMLElement} el - Element to expand
 */
function expand(el) {
    $(el).toggleClass('active');
}

$(document).ready(function() {
    // Initialize slick slider
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

    // Specialty dropdown
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

    // Circle click animation
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

    // Initialize all sliders
    const slidersConfig = {
        common: {
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
                        slidesToShow: 1,
                    }
                }
            ]
        },
        serviceSlider: {
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        }
    };

    // Initialize service slider
    $('.service-slider').slick({
        ...slidersConfig.common,
        ...slidersConfig.serviceSlider
    });

    // Initialize GLightbox
    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Initialize video wrapper slider
    $('.video-wrapper').slick({
        ...slidersConfig.common,
        infinite: true
    });

    // Initialize update slider
    $('.update-slider').slick(slidersConfig.common);

    // Initialize award slider
    $('.award-slide').slick({
        ...slidersConfig.common,
        infinite: true
    });

    // Initialize custom slider (both IDs for compatibility)
    $('.slider-67e651c3b9ea1, .slider-67e92fa812d89').slick({
        ...slidersConfig.common,
        ...slidersConfig.serviceSlider
    });

    // Toggle navbar
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar');
        $('#navbar').css({
            'transform': 'scale(1)'
        });
    });
});
