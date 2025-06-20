document.addEventListener('DOMContentLoaded', function() {
    toggleSectionNav(true);

    // Search and letter functions
    function setMostSearched(el) {
        el.preventDefault();
        console.log('click');
    }

    function setLetter(el) {
        // Implementation needed
    }
    // Initialize slick sliders with common options
    function initSlider(selector, options) {
        const defaultOptions = {
            arrows: true,
            prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
            nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        };

        $(selector).slick({...defaultOptions, ...options});
    }

    // Initialize all sliders
    initSlider('.health-library-slide', {
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: false,
        responsive: [{
            breakpoint: 1199,
            settings: { slidesToShow: 3 }
        },{
            breakpoint: 991,
            settings: { slidesToShow: 2 }
        },{
            breakpoint: 768,
            settings: { slidesToShow: 1, centerMode: true }
        }]
    });

    initSlider('.mobile-slider', {
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 991,
            settings: { slidesToShow: 2 }
        },{
            breakpoint: 768,
            settings: { slidesToShow: 1, centerMode: true }
        }]
    });

    initSlider('.technology-slider', {
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [{
            breakpoint: 768,
            settings: { slidesToShow: 1, centerMode: true }
        }]
    });

    initSlider('.mobile-blog-slide', {
        slidesToShow: 1,
        slidesToScroll: 1
    });

    initSlider('.download-slider', {
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: false,
        responsive: [{
            breakpoint: 1599,
            settings: { slidesToShow: 3 }
        }, {
            breakpoint: 991,
            settings: { slidesToShow: 2 }
        }, {
            breakpoint: 768,
            settings: { slidesToShow: 1, centerMode: true }
        }]
    });

    initSlider('.event-slider', {
        slidesToShow: 4,
        slidesToScroll: 1,
        adaptiveHeight: false,
        responsive: [{
            breakpoint: 1599,
            settings: { slidesToShow: 3 }
        },{
            breakpoint: 991,
            settings: { slidesToShow: 2 }
        },{
            breakpoint: 768,
            settings: { slidesToShow: 1, centerMode: true }
        }]
    });

    // Initialize lightbox
    const lightBox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true
    });

    // Tab-based slider functionality
    function initTabSlider(tabId) {
        $("#" + tabId)
            .find(".tab-slider")
            .not(".slick-initialized")
            .slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                responsive: [{
                    breakpoint: 991,
                    settings: { slidesToShow: 2 }
                }, {
                    breakpoint: 768,
                    settings: { slidesToShow: 1, centerMode: true }
                }]
            });
    }

    $(".tab").on("click", function() {
        let tabId = $(this).data('tab');

        $(".tab").removeClass("active");
        $(this).addClass("active");

        $(".tab-panel").removeClass("active").hide();
        $("#" + tabId).addClass("active").fadeIn();

        initTabSlider(tabId);
    });

    // Initialize first tab slider
    initTabSlider("tab-1");

    // Navigation functions
    window.extendSubMenu = function(el) {
        if ($(el).hasClass('active-list')) {
            $(el).removeClass('active-list');
            return;
        }
        $('.navbar-item').removeClass('active-list');
        $(el).addClass('active-list');
    };

    window.extendKnowledgeSubMenu = function(el, event) {
        event.stopPropagation();
        if ($(el).hasClass('active-knowledge')) {
            $(el).removeClass('active-knowledge');
            return;
        }
        $(el).addClass('active-knowledge');
    };

    // Feedback toggle function
    function toggleFeedback() {
        if ($(window).width() < 481) {
            $(window).on("scroll", function() {
                $(".feedback-contact").toggleClass('hide-feedback', $(window).scrollTop() > 100);
            });
        } else {
            $(window).off("scroll");
        }
    }

    toggleFeedback();
    $(window).on("resize", toggleFeedback);

    // Section navigation
    const $sections = $('section[data-content]');
    const $sectionLinks = $('#sectionLinks');

    // Generate navigation links from sections
    $sections.each(function() {
        const sectionId = $(this).attr('id');
        const sectionName = $(this).data('content');

        const $listItem = $('<li>');
        const $link = $('<a>')
            .attr('href', `#${sectionId}`)
            .text(sectionName)
            .on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $(`#${sectionId}`).offset().top - 120
                }, 800);
            });

        $listItem.append($link);
        $sectionLinks.append($listItem);
    });

    // Active link highlighting when scrolling
    $(window).on('scroll', function() {
        let current = '';

        $sections.each(function() {
            const sectionTop = $(this).offset().top;
            if ($(window).scrollTop() >= (sectionTop - 150)) {
                current = $(this).attr('id');
            }
        });

        $('#sectionLinks a').removeClass('active');
        $(`#sectionLinks a[href="#${current}"]`).addClass('active');
    });

    // Expansion function
    window.expand = function(el) {
        $(el).toggleClass('active');
    };
});
