/**
 * Event page JavaScript functionality
 */
$(document).ready(function() {
    // Initialize all sliders with common configuration
    const sliderClasses = ['.news-slider', '.cme-slider', '.opd-slider', '.webinar-slider'];

    sliderClasses.forEach(function(sliderClass) {
        $(sliderClass).slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button class="slick-prev left-arrow"><img src="/front/img/vector-left.png" alt="Left Arrow"></button>',
            nextArrow: '<button class="slick-next right-arrow"><img src="/front/img/vector-right.png" alt="Right Arrow"></button>',
            responsive: [
                {
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
    });

    // Equalize card heights after sliders are initialized
    equalizeCardHeight('.card-content');

    // Toggle mobile navbar
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar').css({
            'transform': 'scale(1)'
        });
    });
});

/**
 * Equalize the height of elements matching the selector
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
 * Toggle active state for navigation menu items
 * @param {HTMLElement} el - The element to toggle
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
 * Toggle active state for knowledge submenu items
 * @param {HTMLElement} el - The element to toggle
 * @param {Event} event - The click event
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
 * Toggle active class for expandable elements
 * @param {HTMLElement} el - The element to toggle
 */
function expand(el) {
    $(el).toggleClass('active');
}

// Handle window resize events for responsive adjustments
$(window).resize(function() {
    // Re-equalize card heights when window is resized
    equalizeCardHeight('.card-content');
});
