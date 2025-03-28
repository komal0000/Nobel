/**
 * Nobel Home Page JavaScript
 * Consolidated and optimized from multiple scripts
 */
$(document).ready(function () {
    // Initialize lightbox for videos
    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Initialize all sliders
    initSliders();

    // Setup responsive behaviors
    setupResponsiveBehaviors();

    // Initialize UI components
    initUIComponents();

    // Equalize card heights after everything is loaded
    equalizeCardHeight('.card-content');
});

/**
 * Utility function to equalize heights of elements
 * @param {string} selector - CSS selector for elements to equalize
 */
function equalizeCardHeight(selector) {
    let maxHeight = 0;
    $(selector).css('height', 'auto').each(function () {
        maxHeight = Math.max(maxHeight, $(this).height());
    });
    $(selector).height(maxHeight);
}

/**
 * Initialize all sliders with appropriate configurations
 */
function initSliders() {
    // Common slider configuration
    const commonConfig = {
        arrows: true,
        infinite: true,
        slidesToScroll: 1,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
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
    };

    // Initialize standard 3-column sliders
    $('.service-slider, .update-slider, .award-slide, .slider-67e64d13a4fc2, .video-wrapper').each(function () {
        $(this).slick({
            ...commonConfig,
            slidesToShow: 3
        });
    });

    // Initialize specialized sliders
    const $storySlider = $('#story-slider');
    const $mainSlider = $('#slick-slider');

    // Initialize responsive sliders based on screen size
    function handleResponsiveSliders() {
        // Story slider
        if ($(window).width() < 1100) {
            if (!$storySlider.hasClass('slick-initialized')) {
                $storySlider.slick({
                    ...commonConfig,
                    slidesToShow: 2,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            centerMode: false
                        }
                    }]
                });
            }
        } else if ($storySlider.hasClass('slick-initialized')) {
            $storySlider.slick('unslick');
        }

        // Main slider
        if ($(window).width() <= 1299) {
            if (!$mainSlider.hasClass('slick-initialized')) {
                $mainSlider.slick({
                    ...commonConfig,
                    slidesToShow: 2,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                arrows: false,
                                slidesToShow: 2
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
        } else if ($mainSlider.hasClass('slick-initialized')) {
            $mainSlider.slick('unslick');
        }

        // Toggle arrow visibility based on screen size
        $('.slick-prev, .slick-next').toggle($(window).width() > 768);
    }

    // Initialize responsive sliders
    handleResponsiveSliders();

    // Re-evaluate on window resize
    $(window).on('resize', handleResponsiveSliders);
}

/**
 * Setup responsive behaviors for interactive elements
 */
function setupResponsiveBehaviors() {
    // Navbar toggle
    $('#toggle-navbar').click(function () {
        $('#navbar').toggleClass('show-navbar').css({
            'transform': 'scale(1)'
        });
    });

    // Image transition effect
    $('.click-circle').on('click', function (e) {
        e.preventDefault();
        const imgSrc = $(this).attr('datasrc');
        const $image = $('.center-image');

        // Remove active classes
        $('.click-circle').removeClass('active');
        $('.why-block').removeClass('active-why');

        // Add active classes
        $(this).addClass('active');
        $(this).closest('.why-block').addClass('active-why');

        // Apply animation
        $image.css('transition', 'none')
            .css({
                'transform': 'scale(0.01)',
                'opacity': '0'
            });

        // Force browser reflow
        $image[0].offsetHeight;

        // Change image and animate in
        $image.attr('src', imgSrc);
        setTimeout(function () {
            $image.css('transition', 'transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.8s ease')
                .css({
                    'transform': 'scale(1)',
                    'opacity': '1'
                });
        }, 50);
    });

    // Initialize center image
    $('.center-image').addClass('normal');
}

/**
 * Initialize UI components and interactions
 */
function initUIComponents() {
    // Speciality dropdown
    $('#default-speciality-wrap').click(function () {
        const $listWrap = $('#list-wrap');
        $listWrap.toggle($listWrap.css('display') !== 'block');
    });

    $('#list-wrap ul li').click(function () {
        const selectedText = $(this).text();
        const selectedValue = $(this).data('value');

        $('#default-speciality-wrap span.default-speciality-item').text(selectedText);
        $('#find-doc-location-input').val(selectedValue);
        $('#list-wrap').hide();
    });

    // Initialize tabs
    $('.tab').click(function () {
        changeTab(this);
    });

    // If there's an initial active tab, trigger it
    const $initialActiveTab = $('.tab.active-tab');
    if ($initialActiveTab.length) {
        changeTab($initialActiveTab[0]);
    }
}

/**
 * Set active state for buttons
 * @param {HTMLElement} el - Button element to activate
 */
function setActive(el) {
    $('.sp-btn').removeClass('active-btn');
    $(el).addClass('active-btn');
}

/**
 * Change tab and show corresponding content
 * @param {HTMLElement} el - Tab element to activate
 */
function changeTab(el) {
    const tabId = $(el).data('target');
    $('.tab').removeClass('active-tab');
    $(el).addClass('active-tab');

    $('.event-list').removeClass('active').hide();
    $('#' + tabId).addClass('active').fadeIn();
}

/**
 * Toggle submenu expansion
 * @param {HTMLElement} el - Menu item to toggle
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
 * Toggle knowledge submenu expansion
 * @param {HTMLElement} el - Knowledge menu item to toggle
 * @param {Event} event - Click event
 */
function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    $(el).toggleClass('active-knowledge');
}

/**
 * Toggle active class for expandable elements
 * @param {HTMLElement} el - Element to expand/collapse
 */
function expand(el) {
    $(el).toggleClass('active');
}

// Handle window resize
$(window).resize(function () {
    // Re-equalize card heights when window is resized
    equalizeCardHeight('.card-content');
});
