function equalizeCardHeight(selector) {
    let maxHeight = 0;
    $(selector).css('height', 'auto').each(function() {
        maxHeight = Math.max(maxHeight, $(this).height());
    });
    $(selector).height(maxHeight);
}

function setTabActive(el, tabClass, tabsClass) {
    let targetId = $(el).attr('data-target');
    $(`.${tabClass}`).removeClass('active-btn');
    $(`.${tabsClass}`).removeClass('active');
    $(el).addClass('active-btn');

    if ($(el).closest('.desktop-list').length) {
        $(`.${tabsClass}[data-content="${targetId}"]`).addClass('active');
        $(`.${tabsClass}[data-content="${targetId}"] .${tabClass}`).addClass('active-btn');
    } else {
        $(el).closest(`.${tabsClass}`).addClass('active');
    }
}

function setTreatmentActive (el) {
    setTabActive(el, 'treatment-tab', 'treatment-tabs');
}

function setAilmentActive(el) {
    setTabActive(el, 'ailment-tab', 'ailment-tabs');
}

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
    $(el).toggleClass('active-knowledge');
}

function expand(el) {
    $(el).toggleClass('active');
}

$(document).ready(function() {
    // Initialize all sliders
    $('.top-banner-slide').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
        arrows: false
    });

    const sliderConfig = {
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }]
    };

    $('.team-slider, .content-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        ...sliderConfig
    });

    $('.sub-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: false,
        ...sliderConfig,
        responsive: [{
            breakpoint: 1199,
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

    // Initialize lightbox
    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Mobile slider initialization
    function lifeHereSlider() {
        if ($(window).width() < 992) {
            if (!$('.mobile-slide').hasClass('slick-initialized')) {
                $('.mobile-slide').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                    nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                    responsive: [{
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                        }
                    }]
                });
            }
        } else if ($('.award-slider').hasClass('slick-initialized')) {
            $('.award-slider').slick('unslick');
        }
    }

    // Read more functionality
    $('.read-more').on('click', function() {
        $('.text-container').toggleClass('expanded');
        $('.arrow').toggleClass('arrowToggle');

        if ($('.text-container').hasClass('expanded')) {
            $(this).text('Read Less');
            $('.fade-effect').hide();
        } else {
            $(this).text('Read More');
            $('.fade-effect').show();
        }
    });

    // Toggle navbar
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
    });

    // Initialize slider and handle resize
    lifeHereSlider();

    // Use one window resize event handler
    $(window).on('load resize', function() {
        equalizeCardHeight('.main-card');
        lifeHereSlider();
    });
});
