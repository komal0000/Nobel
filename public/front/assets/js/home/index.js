// Initialize when document is ready
$(document).ready(function() {
    // Setup lightbox for videos
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
});

// Utility function to equalize heights of elements
function equalizeCardHeight(selector) {
    let maxHeight = 0;
    $(selector).css('height', 'auto').each(function() {
        maxHeight = Math.max(maxHeight, $(this).height());
    });
    $(selector).height(maxHeight);
}

// Initialize all sliders with shared configuration
function initSliders() {
    // Configure common slider settings
    const commonSliderConfig = {
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
    };

    // Standard 3-column slider config
    const standard3ColConfig = {
        ...commonSliderConfig,
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        responsive: [{
            breakpoint: 1199,
            settings: { slidesToShow: 2 }
        }, {
            breakpoint: 768,
            settings: { slidesToShow: 1 }
        }]
    };

    // Initialize regular sliders
    $('.service-slider, .update-slider, .award-slide, .slider-67e53dc039493').each(function() {
        $(this).slick(standard3ColConfig);
    });

    // Initialize specialized sliders
    initSpecializedSliders(commonSliderConfig);
}

// Initialize sliders with special configurations
function initSpecializedSliders(commonSliderConfig) {
    // Story slider (responsive)
    const $storySlider = $('#story-slider');
    toggleStorySlider();
    $(window).resize(toggleStorySlider);

    // Main slider (responsive)
    const $mainSlider = $('#slick-slider');
    toggleMainSlider();
    $(window).resize(toggleMainSlider);

    // Helper function for story slider
    function toggleStorySlider() {
        if ($(window).width() < 1100) {
            if (!$storySlider.hasClass('slick-initialized')) {
                $storySlider.slick({
                    ...commonSliderConfig,
                    slidesToShow: 2,
                    infinite: true,
                    slidesToScroll: 1,
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
    }

    // Helper function for main slider
    function toggleMainSlider() {
        if ($(window).width() <= 1299) {
            if (!$mainSlider.hasClass('slick-initialized')) {
                $mainSlider.slick({
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    ...commonSliderConfig,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            arrows: false,
                            slidesToShow: 2,
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            arrows: false
                        }
                    }]
                });
            }
        } else if ($mainSlider.hasClass('slick-initialized')) {
            $mainSlider.slick('unslick');
        }

        // Show/hide arrows based on screen size
        $('.slick-prev, .slick-next').toggle($(window).width() > 768);
    }
}

// Setup responsive behaviors
function setupResponsiveBehaviors() {
    // Show/hide navbar toggle
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
    });

    // Image transition effect
    $('.click-circle').on('click', function(e) {
        e.preventDefault();
        const imgSrc = $(this).attr('datasrc');
        const $image = $('.center-image');

        // Remove active classes from other elements
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

        // Force reflow
        $image[0].offsetHeight;

        // Change image and animate in
        $image.attr('src', imgSrc);
        setTimeout(function() {
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

// Initialize UI components
function initUIComponents() {
    // Speciality dropdown
    $('#default-speciality-wrap').click(function() {
        const $listWrap = $('#list-wrap');
        $listWrap.toggle($listWrap.css('display') !== 'block');
    });

    $('#list-wrap ul li').click(function() {
        const selectedText = $(this).text();
        const selectedValue = $(this).data('value');

        $('#default-speciality-wrap span.default-speciality-item').text(selectedText);
        $('#find-doc-location-input').val(selectedValue);
        $('#list-wrap').hide();
    });

    // Setup tabs and buttons
    $('.tab').click(function() {
        changeTab(this);
    });
}

// UI Helper Functions
function setActive(el) {
    $('.sp-btn').removeClass('active-btn');
    $(el).addClass('active-btn');
}

function changeTab(el) {
    const tabId = $(el).data('target');
    $('.tab').removeClass('active-tab');
    $(el).addClass('active-tab');

    $('.event-list').removeClass('active').hide();
    $('#' + tabId).addClass('active').fadeIn();
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
