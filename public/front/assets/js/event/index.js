// Equalize card heights
function equalizeCardHeight(selector) {
    const $elements = $(selector).css('height', 'auto');
    const maxHeight = Math.max(...$elements.map(function() { return $(this).height(); }).get());
    $elements.height(maxHeight);
}

// Toggle active state for navigation menu items
function extendSubMenu(el) {
    const $el = $(el);
    if ($el.hasClass('active-list')) {
        $el.removeClass('active-list');
        return;
    }
    $('.navbar-item').removeClass('active-list');
    $el.addClass('active-list');
}

// Toggle active state for knowledge submenu items
function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    console.log('clicked');
    const $el = $(el);
    $el.toggleClass('active-knowledge');
}

// Toggle active class for expandable elements
function expand(el) {
    $(el).toggleClass('active');
}

$(document).ready(function() {
    // Initialize event slider
    $('.event-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            { breakpoint: 992, settings: { slidesToShow: 2 } },
            { breakpoint: 650, settings: { slidesToShow: 1 } }
        ]
    });
});
