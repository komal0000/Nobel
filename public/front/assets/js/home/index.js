// Main JS for home page
document.addEventListener('DOMContentLoaded', function () {
    // Initialize sliders
    initSliders();

    // Set up event listeners
    setupEventListeners();

    // Initialize lightbox
    initLightbox();

    // Show homepage modal with slight delay
    setTimeout(function () {
        $("#homepageModal").modal("show");
    }, 500);

    // Initialize section navigation
    initSectionNavigation();
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

    // Mobile event slider (dynamic class name)
    $('.slider-67ea3ffc514bf, .slider-67ef8e64cc278').slick({
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
                    infinite: false,
                    arrows: true,
                    prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                    nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: { slidesToShow: 2 }
                        },
                        {
                            breakpoint: 480,
                            settings: { slidesToShow: 1 }
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
 * Initialize section navigation
 */
function initSectionNavigation() {
    // Get all sections with data-content attribute
    const $sections = $('section[data-content]');
    const $sectionLinks = $('#sectionLinks');

    // Generate navigation links from sections
    $sections.each(function () {
        const sectionId = $(this).attr('id');
        const sectionName = $(this).data('content');

        // Create the list item and link
        const $listItem = $('<li>');
        const $link = $('<a>')
            .attr('href', `#${sectionId}`)
            .text(sectionName)
            .on('click', function (e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $(`#${sectionId}`).offset().top - 120
                }, 800);
            });

        // Append elements to the navigation
        $listItem.append($link);
        $sectionLinks.append($listItem);
    });

    // Active link highlighting when scrolling
    $(window).on('scroll', function () {
        let current = '';

        $sections.each(function () {
            const sectionTop = $(this).offset().top;
            if ($(window).scrollTop() >= (sectionTop - 150)) {
                current = $(this).attr('id');
            }
        });

        // Update active class
        $('#sectionLinks a').removeClass('active');
        $(`#sectionLinks a[href="#${current}"]`).addClass('active');
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
    $('.accor-list li, .list-accor li').on('click', function () {
        expand(this);
    });

    // Responsive list items
    $('.resp-li').on('click', function () {
        expandRespLi(this);
    });

    // Speciality search
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

    // Initialize responsive feedback toggle
    toggleFeedback();
    $(window).on("resize", toggleFeedback);
}

/**
 * Utility Functions
 */

// Set active class on speciality button
function setActive(el) {
    $('.sp-btn').removeClass('active-btn');
    $(el).addClass('active-btn');

    // Handle category selection functionality
    const category = $(el).text().trim().toLowerCase();

    let targetUrl = '/aliment'; // Default
    if (category === 'treatment') {
        targetUrl = '/treatment';
    } else if (category === 'technologies') {
        targetUrl = '/technology';
    }

    // Store the current category URL for letter buttons to use
    $('.sp-search-letter').attr('data-current-category', category);
    $('.sp-search-letter').attr('data-current-url', targetUrl);

    // Update the hover button href and text without changing inner structure
    $('.hover-button-sp .hover-btn').each(function () {
        // Update href
        $(this).attr('href', targetUrl);

        // Try to find a text element to update
        let textEl = $(this).find('.hover-text');
        if (textEl.length === 0) {
            // If no dedicated text element exists, update text carefully
            const newText = 'View All ' + category.charAt(0).toUpperCase() + category.slice(1);

            // Clone to work with its contents
            const $clone = $(this).clone();
            $clone.children().remove();

            // Store original HTML
            const originalHTML = $(this).html();

            // Replace the text content
            const originalText = $clone.text().trim();
            if (originalText) {
                const newHTML = originalHTML.replace(originalText, newText);
                $(this).html(newHTML);
            }
        } else {
            // If we found a dedicated text element, just update it
            textEl.text('View All ' + category.charAt(0).toUpperCase() + category.slice(1));
        }
    });
}

// Handle letter button clicks for specialty search
function setActiveLetter(letterButton) {
    // Add active class to clicked letter
    $('.sp-search-letter .letter-wrap button').removeClass('active');
    $(letterButton).addClass('active');

    // Get the letter from the button
    const letter = $(letterButton).find('span').text().trim().toLowerCase();

    // Get the current category base URL from data attribute
    const categoryUrl = $('.sp-search-letter').attr('data-current-url') || '/aliment';

    // Directly navigate to the category+letter page
    window.location.href = `${categoryUrl}?letter=${letter}`;
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

// Expand responsive list item
function expandRespLi(el) {
    $('.resp-li').removeClass('active');
    $(el).addClass('active');
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

// Show/hide feedback based on scroll position on mobile
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

// Search and navigate to speciality
function SearchSpeciality(id) {
    if (!id) return;
    window.location.href = `/speciality/single/${id}`;
}

// Show speciality dropdown list
function showList() {
    const $listWrap = $('#list-wrap');
    $listWrap.toggle();
}
