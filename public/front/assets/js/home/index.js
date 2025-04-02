// Main JS for home page
document.addEventListener('DOMContentLoaded', function () {
    // Initialize sliders
    initSliders();

    // Set up event listeners
    setupEventListeners();

    // Initialize lightbox
    initLightbox();
    $("#homepageModal").modal("show");
});

/**
 * Initialize all sliders
 */
function initSliders() {
    // Top banner slider
    $('.top-banner-slider').slick({
        arrows: false,
        dots: true
    });

    // Floating tabs slider - responsive
    initFloatingTabsSlider();

    // Service slider
    $('.service-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: { slidesToShow: 2 }
            },
            {
                breakpoint: 650,
                settings: { slidesToShow: 1 }
            }
        ]
    });

    // Patient stories slider
    $('.video-wrapper').slick({
        slidesToShow: 3,
        infinite: true,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {
                breakpoint: 1199,
                settings: { slidesToShow: 2 }
            },
            {
                breakpoint: 768,
                settings: { slidesToShow: 1 }
            }
        ]
    });

    // Update slider
    $('.update-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {
                breakpoint: 1199,
                settings: { slidesToShow: 2 }
            },
            {
                breakpoint: 768,
                settings: { slidesToShow: 1 }
            }
        ]
    });

    // Awards slider
    $('.award-slide').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {
                breakpoint: 1199,
                settings: { slidesToShow: 2 }
            },
            {
                breakpoint: 768,
                settings: { slidesToShow: 1 }
            }
        ]
    });

    // Mobile event slider
    $('.slider-67ea3ffc514bf').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: { slidesToShow: 2 }
            },
            {
                breakpoint: 650,
                settings: { slidesToShow: 1 }
            }
        ]
    });
}

/**
 * Initialize floating tabs slider based on screen width
 */
function initFloatingTabsSlider() {
    const $slider = $('#slick-slider');

    function configureSlider() {
        if ($(window).width() <= 1299) {
            if (!$slider.hasClass('slick-initialized')) {
                $slider.slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: true,
                    prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                    nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
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
    }

    // Initial setup and resize listener
    configureSlider();
    $(window).on('resize', configureSlider);
}

/**
 * Initialize lightbox for videos
 */
function initLightbox() {
    GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });
}

/**
 * Set up all event listeners
 */
function setupEventListeners() {
    // Speciality filter
    $('.sp-btn').on('click', function () {
        setActive(this);
    });

    // Find doctor speciality dropdown
    $('#default-speciality-wrap').on('click', function () {
        const $listWrap = $('#list-wrap');
        if ($listWrap.css('display') === 'block') {
            $listWrap.css('display', 'none');
            return;
        }
        $listWrap.css('display', 'block');
    });

    $('#list-wrap ul li').on('click', function () {
        const selectedText = $(this).text();
        const selectedValue = $(this).data('value');

        $('#default-speciality-wrap span.default-speciality-item').text(selectedText);
        $('#find-doc-location-input').val(selectedValue);
        $('#list-wrap').css('display', 'none');
    });

    // Model of care - center image changing
    $('.click-circle').on('click', function (e) {
        e.preventDefault();
        const imgSrc = $(this).attr('datasrc');
        const $image = $('.center-image');

        // Animate image change
        $image.css('transition', 'none');
        $image.css({
            'transform': 'scale(0.01)',
            'opacity': '0'
        });

        // Force reflow
        $image[0].offsetHeight;

        setTimeout(function () {
            $image.css('transition', 'transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.8s ease');
            $image.css({
                'transform': 'scale(1)',
                'opacity': '1'
            });
        }, 50);

        // Update active states
        $('.click-circle').removeClass('active');
        $(this).addClass('active');
        $('.why-block').removeClass('active-why');
        $(this).closest('.why-block').addClass('active-why');

        // Change image source
        $image.attr('src', imgSrc);
    });

    // Add normal class to center image
    $('.center-image').addClass('normal');

    // Tab functionality for events
    $('.tab').on('click', function () {
        changeTab(this);
    });

    // Mobile nav toggle
    $('#toggle-navbar').on('click', function () {
        $('#navbar').toggleClass('show-navbar');
        $('#navbar').css({
            'transform': 'scale(1)'
        });

        // Toggle icon
        $('.open-icon, .close-icon').toggleClass('d-none');
    });

    // Menu toggles for header dropdowns
    $('.navbar-item').on('click', function () {
        extendSubMenu(this);
    });

    // Knowledge submenu toggle (with stop propagation)
    $('.knowledge-drop').on('click', function (e) {
        extendKnowledgeSubMenu(this, e);
    });

    // Footer accordion for mobile
    $('.footer-block').on('click', function () {
        expand(this);
    });

    // Why us mobile accordion
    $('.accor-list li').on('click', function () {
        expand(this);
    });
}

/**
 * Utility Functions
 */

// Set active class on speciality button
function setActive(el) {
    $('.sp-btn').removeClass('active-btn');
    $(el).addClass('active-btn');
}

// Change tab for events section
function changeTab(el) {
    const tabId = $(el).data('target');
    $('.tab').removeClass('active-tab');
    $(el).addClass('active-tab');

    $('.event-list').removeClass('active').hide();
    $('#' + tabId).addClass('active').fadeIn();
}

// Expand/collapse elements (for footer and mobile accordions)
function expand(el) {
    $(el).toggleClass('active');
}

// Handle submenu display in header
function extendSubMenu(el) {
    if ($(el).hasClass('active-list')) {
        $(el).removeClass('active-list');
        return;
    }
    $('.navbar-item').removeClass('active-list');
    $(el).addClass('active-list');
}

// Handle knowledge submenu display in header
function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    if ($(el).hasClass('active-knowledge')) {
        $(el).removeClass('active-knowledge');
        return;
    }
    $(el).addClass('active-knowledge');
}

// Equalize card heights for consistent UI
function equalizeCardHeight(selector) {
    let maxHeight = 0;

    $(selector).css('height', 'auto').each(function () {
        maxHeight = Math.max(maxHeight, $(this).height());
    });

    $(selector).height(maxHeight);
}
document.querySelectorAll('.list-accor li').forEach(element => {
    element.addEventListener('click', function () {
        console.log('clicked');
        this.classList.toggle('active');
    });
});

/**
 * Show speciality dropdown list
 */
function showList() {
    const $listWrap = $('#list-wrap');
    $listWrap.toggle();
}
$(document).ready(function () {
    $('#speciality-search').on('input', function () {
        const searchText = $(this).val().toLowerCase();
        $('#find-doc-speciality li').each(function () {
            const text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(searchText));
        });
    });

    $('#find-doc-speciality li').on('click', function () {
        const selectedText = $(this).text();
        const selectedValue = $(this).data('value');

        $('.default-speciality-item').text(selectedText);
        $('#find-doc-speciality-input').val(selectedValue);
        $('#list-wrap').hide();
    });
});
function toggleFeedback() {
    if ($(window).width() < 481) {
        $(window).on("scroll", function () {
            if ($(window).scrollTop() > 100) {
                $(".feedback-contact").addClass('hide-feedback');

            } else {
                $(".feedback-contact").removeClass('hide-feedback');
            }
        });
    } else {
        $(window).off("scroll");
    }
}

toggleFeedback();
$(window).on("resize", toggleFeedback);
