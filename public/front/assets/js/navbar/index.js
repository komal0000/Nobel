
function extendSubMenu(el) {
    if ($(window).width() < 1200) {
        if ($(el).hasClass('active-list')) {
            $(el).removeClass('active-list');
            return;
        }
        $('.navbar-item').removeClass('active-list');
        $(el).addClass('active-list');
    }
}

function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    
    if (window.innerWidth < 1200) {
        $(el).toggleClass('active-knowledge');
    }
}

function toggleFeedback() {
    if ($(window).width() < 481) {
        $(window).on("scroll", function () {
            $(".feedback-contact").toggleClass('hide-feedback', $(window).scrollTop() > 100);
        });
    } else {
        $(window).off("scroll");
    }
}

$('#toggle-navbar').on('click', function () {
    $('#navbar').toggleClass('show-navbar');
    $('#navbar').css({
        'transform': 'scale(1)',
        'transition': 'transform 0.3s ease'
    });
    console.log('toggle');
    if ($('#navbar').hasClass('show-navbar')) {
        $('body').css('overflow', 'hidden');
    } else {
        $('body').css('overflow', 'auto');
    }

    // Toggle icon
    $('.open-icon, .close-icon').toggleClass('d-none');
});

$('.footer-block').on('click', function () {
    expand(this);
});

toggleFeedback();
$(window).on('resize', toggleFeedback);