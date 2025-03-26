$(document).ready(function() {
    function initCardLoader() {
        let cardsPerPage = 16;
        let totalCards = $(".card-col").length;
        let currentCount = 0;

        function showMoreCards() {
            $(".card-col").slice(currentCount, currentCount + cardsPerPage).fadeIn();
            currentCount += cardsPerPage;

            if (currentCount >= totalCards) {
                $("#load-more").hide();
            }
        }

        showMoreCards();

        $("#load-more").on("click", showMoreCards);
    }

    function initNavigation() {
        $('#toggle-navbar').click(function() {
            $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
        });
    }

    function equalizeCardHeight(selector) {
        let maxHeight = 0;
        $(selector).css('height', 'auto').each(function() {
            maxHeight = Math.max(maxHeight, $(this).height());
        });
        $(selector).height(maxHeight);
    }
    initCardLoader();
    initNavigation();


    $(window).on('resize', function() {
        equalizeCardHeight('.main-card');
    });

    equalizeCardHeight('.main-card');
});

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
