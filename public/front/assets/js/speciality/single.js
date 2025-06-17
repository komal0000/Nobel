$(document).ready(function() {
    // Initialize utility functions
    function equalizeCardHeight(selector) {
        let maxHeight = 0;
        $(selector).css('height', 'auto').each(function() {
            maxHeight = Math.max(maxHeight, $(this).height());
        });
        $(selector).height(maxHeight);
    }

    // Common slider arrow configuration
    const arrowConfig = {
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/img/vector-right.png" alt="Right Arrow"></button>'
    };

    // Common responsive settings
    const responsiveConfig = [
        {
            breakpoint: 1199,
            settings: {
                slidesToShow: 2
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1
            }
        }
    ];


    $('.team-slider, .content-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        ...arrowConfig,
        responsive: responsiveConfig
    });

    $('.sub-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: false,
        arrows: true,
        ...arrowConfig,
        responsive: [...responsiveConfig.slice(0, -1), {
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
                    ...arrowConfig,
                    responsive: [{
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
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

    // Tab functionality
    $(document).on('click', '.type-2-tab', function() {
        const componentContainer = $(this).closest('.type-2');
        componentContainer.find('.type-2-tab').removeClass('active-btn');
        componentContainer.find('.type-2-tabs').removeClass('active');

        $(this).addClass('active-btn');

        const targetId = $(this).data('target');
        const targetContent = componentContainer.find(`.type-2-tabs[data-content="${targetId}"]`);

        if (targetContent.length) {
            targetContent.addClass('active');
            targetContent.find('.type-2-tab').addClass('active-btn');
        }
    });

    // Toggle navbar
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
    });

    // Initialize and handle resize events
    lifeHereSlider();
    equalizeCardHeight('.main-card');

    $(window).on('resize', function() {
        equalizeCardHeight('.main-card');
        lifeHereSlider();
    });
});

// Menu functions
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

function setTreatmentActive(el) {
    setTabActive(el, 'treatment-tab', 'treatment-tabs');
}

function setAilmentActive(el) {
    setTabActive(el, 'ailment-tab', 'ailment-tabs');
}
