/**
 * JavaScript for the doctor single page
 */

// Global configuration
window.appConfig = window.appConfig || {};
window.appConfig.showSectionNav = false;

/**
 * Toggle the section navigation visibility
 * @param {boolean} show - Whether to show the section nav
 */
function toggleSectionNav(show) {
    window.appConfig.showSectionNav = show;

    if (show) {
        $('.sectionNavbarMainContainer').show().removeClass('d-none');
    } else {
        $('.sectionNavbarMainContainer').hide();
    }
}

/**
 * Adjust main content margin based on header height
 */
function adjustMainMargin() {
    $('.site-header').css('display', 'none').height();
    $('.site-header').css('display', '');

    let headerBaseHeight = $('.site-header').outerHeight();

    if (!window.appConfig.showSectionNav && $('.sectionNavbarMainContainer').length) {
        headerBaseHeight -= $('.sectionNavbarMainContainer').outerHeight();
    }

    $('main').css('margin-top', headerBaseHeight + 'px');
}

// Breadcrumbs functionality
let breadcrumbsVisible = false;

/**
 * Generate breadcrumbs based on current URL
 */
function generateBreadcrumbs() {
    const pathname = window.location.pathname;
    const pathSegments = pathname.split('/').filter(segment => segment !== '');
    const breadcrumbsContainer = $('#dynamic-breadcrumbs');
    breadcrumbsContainer.empty();

    // Always add Home as the first item
    breadcrumbsContainer.append(`<li class="breadcrumb-item"><a href="/">Home</a></li>`);

    // Build up the path
    let currentPath = '';

    // Map common path segments to readable names
    const segmentNames = {
        'doctors': 'Doctors',
        'doctor-profile': 'Doctor Profile',
        'medical-experts': 'Medical Experts',
        'services': 'Services',
        'about': 'About Us',
        'contact': 'Contact Us'
    };

    // Add intermediate paths
    for (let i = 0; i < pathSegments.length; i++) {
        const segment = pathSegments[i];
        currentPath += '/' + segment;

        const displayName = segmentNames[segment] ||
            segment.replace(/-/g, ' ').replace(/\b\w/g, l => l.toUpperCase());

        // If it's the last segment, mark it as active
        if (i === pathSegments.length - 1) {
            breadcrumbsContainer.append(`<li class="breadcrumb-item active" aria-current="page">${displayName}</li>`);
        } else {
            breadcrumbsContainer.append(`<li class="breadcrumb-item"><a href="${currentPath}">${displayName}</a></li>`);
        }
    }

    // If we're at the root path, add a default second item
    if (pathSegments.length === 0) {
        breadcrumbsContainer.append(`<li class="breadcrumb-item active" aria-current="page">Home</li>`);
    }
}

/**
 * Toggle breadcrumbs visibility
 * @param {boolean|null} show - Whether to show breadcrumbs
 * @returns {boolean} The current visibility state
 */
function toggleBreadcrumbs(show = null) {
    breadcrumbsVisible = show !== null ? show : !breadcrumbsVisible;

    const breadcrumbsSection = $('#breadcrumbs-section');

    if (breadcrumbsVisible) {
        generateBreadcrumbs();
        breadcrumbsSection.removeClass('d-none').addClass('show');
    } else {
        breadcrumbsSection.removeClass('show').addClass('d-none');
    }

    return breadcrumbsVisible;
}

/**
 * Initialize section navigation
 */
function initSectionNav() {
    const $sections = $('section[data-content]');
    const $sectionLinks = $('#sectionLinks');
    const $mainSectionNavbarContainer = $('.sectionNavbarMainContainer');
    let scrolling = false;
    let scrollTimeout;

    if (window.appConfig.showSectionNav && $sectionLinks.length) {
        $mainSectionNavbarContainer.show();

        $sections.each(function() {
            const sectionId = $(this).attr('id');
            const sectionName = $(this).data('content');

            $('<li>')
                .append(
                    $('<a>')
                        .attr('href', `#${sectionId}`)
                        .text(sectionName)
                        .on('click', function(e) {
                            e.preventDefault();
                            scrolling = true;

                            $('#sectionLinks a').removeClass('active');
                            $(this).addClass('active');

                            $('html, body').animate({
                                scrollTop: $(`#${sectionId}`).offset().top - 120
                            }, 10, function() {
                                setTimeout(() => scrolling = false, 100);
                            });

                            scrollActiveLinkIntoView();
                        })
                )
                .appendTo($sectionLinks);
        });

        $(window).on('scroll', function() {
            if (scrolling) return;

            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                let currentId = '';

                $($sections.get().reverse()).each(function() {
                    if ($(window).scrollTop() >= $(this).offset().top - 150) {
                        currentId = $(this).attr('id');
                        return false;
                    }
                });

                if (currentId) {
                    $('#sectionLinks a').removeClass('active');
                    $(`#sectionLinks a[href="#${currentId}"]`).addClass('active');
                    scrollActiveLinkIntoView();
                }
            }, 100);
        });
    } else {
        $mainSectionNavbarContainer.hide();
    }
}

/**
 * Scroll active section link into view
 */
function scrollActiveLinkIntoView() {
    if ($(window).width() < 1200) {
        const $activeLink = $('#sectionLinks a.active');

        if ($activeLink.length) {
            const $ul = $('#sectionLinks');
            const linkOffset = $activeLink.parent().position().left + 23;

            $ul.css({
                'transition': 'transform 0.3s ease',
                'transform': `translateX(${-linkOffset}px)`
            });
        }
    }
}

/**
 * Toggle submenu display on mobile
 */
function extendSubMenu(el) {
    if ($(window).width() < 1300) {
        if ($(el).hasClass('active-list')) {
            $(el).removeClass('active-list');
            return;
        }
        $('.navbar-item').removeClass('active-list');
        $(el).addClass('active-list');
    }
}

/**
 * Toggle knowledge submenu display
 */
function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    $(el).toggleClass('active-knowledge');
}

/**
 * Toggle element expansion
 */
function expand(el) {
    $(el).toggleClass('active');
}

/**
 * Initialize sliders
 */
function initSliders() {
    const sliderConfig = {
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/img/vector-right.png" alt="Right Arrow"></button>',
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
        }]
    };

    $('.slider-67fa0aabb99db, .slider-67fa0aabe0fac, .slider-67fa0aac332da, .slider-67fa0aac84342').slick(sliderConfig);
}

/**
 * Initialize feedback toggle functionality
 */
function toggleFeedback() {
    if ($(window).width() < 481) {
        $(window).on("scroll", function() {
            $(".feedback-contact").toggleClass('hide-feedback', $(window).scrollTop() > 100);
        });
    } else {
        $(window).off("scroll");
    }
}

// Document ready initialization
$(document).ready(function() {
    // Initialize sliders
    initSliders();

    // Initialize lightbox
    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Initialize navbar toggle
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar');
        $('#navbar').css({
            'transform': 'scale(1)'
        });
    });

    // Initialize section navigation
    initSectionNav();

    // Setup feedback toggle
    toggleFeedback();
    $(window).on('resize', toggleFeedback);

    // Adjust margins
    setTimeout(() => {
        adjustMainMargin();
    }, 1);
});
