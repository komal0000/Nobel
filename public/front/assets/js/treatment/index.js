$(document).ready(function() {
    // Initialize components
    initLetterSlider();
    initNavigation();
    initScrollFunctions();
    initFilterAndPagination();

    // Toggle navbar for mobile
    $('#toggle-navbar').click(toggleNavbar);
});

// Initialize letter slider
function initLetterSlider() {
    $('.letter-slider').slick({
        slidesToShow: 10,
        slidesToScroll: 3,
        infinite: false,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            { breakpoint: 1200, settings: { slidesToShow: 8, slidesToScroll: 3 } },
            { breakpoint: 992, settings: { slidesToShow: 6, slidesToScroll: 3 } },
            { breakpoint: 768, settings: { slidesToShow: 4, slidesToScroll: 2 } },
            { breakpoint: 576, settings: { slidesToShow: 3, slidesToScroll: 2 } }
        ]
    });
}

// Initialize filter and pagination
function initFilterAndPagination() {
    const itemsPerPage = 10;
    let currentPage = 1;
    let selectedLetter = "all";
    const cards = $(".each-card");
    const paginationContainer = $("#paginationButtons");
    const searchBox = $("input[name='searchBox']");
    const letterButtons = $(".char");


    // Initialize
    getAvailableLetters();
    filterCards();

    function getAvailableLetters() {
        const letters = new Set();
        cards.each(function() {
            const title = $(this).find(".title").text().trim().toLowerCase();
            if (title.length) letters.add(title.charAt(0));
        });

        letterButtons.each(function() {
            const letter = $(this).text().trim().toLowerCase();
            const disabled = letter !== "all" && !letters.has(letter);
            $(this).prop("disabled", disabled).toggleClass("disabled", disabled);
        });
    }

    function filterCards() {
        const searchText = searchBox.val().toLowerCase();
        const filteredCards = cards.filter(function() {
            const title = $(this).find(".title").text().trim().toLowerCase();
            return (selectedLetter === "all" || title.startsWith(selectedLetter)) &&
                   title.includes(searchText);
        });

        showPage(1, filteredCards);
        createPaginationButtons(filteredCards);
    }

    function showPage(page, filteredCards) {
        currentPage = page;
        cards.hide();
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        filteredCards.slice(start, end).show();

        $("#prevPage").prop("disabled", page === 1);
        $("#nextPage").prop("disabled", page === Math.ceil(filteredCards.length / itemsPerPage));
        $(".page-btn").removeClass("active");
        $(`#page-${page}`).addClass("active");
    }

    function createPaginationButtons(filteredCards) {
        paginationContainer.empty();
        const pages = Math.ceil(filteredCards.length / itemsPerPage);

        for (let i = 1; i <= pages; i++) {
            const button = $(`<button class="mx-1 page-btn${i === 1 ? ' active' : ''}" id="page-${i}">${i}</button>`);
            button.click(() => showPage(i, filteredCards));
            paginationContainer.append(button);
        }
    }

    // Event handlers
    letterButtons.click(function() {
        if ($(this).is(":disabled")) return;

        letterButtons.removeClass("active");
        $(this).addClass("active");
        selectedLetter = $(this).text().trim().toLowerCase();
        filterCards();
    });

    searchBox.on("input", filterCards);

    $("#prevPage").click(() => {
        if (currentPage > 1) showPage(currentPage - 1, $(".each-card:visible"));
    });

    $("#nextPage").click(() => {
        const visibleCards = $(".each-card:visible");
        if (currentPage < Math.ceil(visibleCards.length / itemsPerPage)) {
            showPage(currentPage + 1, visibleCards);
        }
    });

    

    // Check for letter parameter in URL
    const paramLetter = getUrlParameter('letter');
    if (paramLetter) {
        console.log('Letter parameter:', paramLetter);
        const letter = paramLetter.toLowerCase();
        const letterButton = $(`.char-${letter}`);

        if (letterButton.length && !letterButton.hasClass("disabled")) {
            letterButtons.removeClass("active");
            letterButton.addClass("active");
            selectedLetter = letter;
        } else {
            selectedLetter = "all";
            letterButtons.removeClass("active");
            $('.char-all').addClass('active');
            alert('No Result Found For Letter ' + paramLetter);
        }
    }

}

// Navigation and UI functions
function initNavigation() {
    const $sections = $('section[data-content]');
    const $sectionLinks = $('#sectionLinks');

    if ($sections.length && $sectionLinks.length) {
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
    }
}

function initScrollFunctions() {
    toggleFeedback();
    $(window).on("resize", toggleFeedback);
}

function toggleFeedback() {
    if ($(window).width() < 481) {
        $(window).on("scroll", function() {
            $(".feedback-contact").toggleClass('hide-feedback', $(window).scrollTop() > 100);
        });
    } else {
        $(window).off("scroll");
        $(".feedback-contact").removeClass('hide-feedback');
    }
}


function expand(el) {
    $(el).toggleClass('active');
}

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    const results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}

window.extendKnowledgeSubMenu = extendKnowledgeSubMenu;
window.expand = expand;
window.getUrlParameter = getUrlParameter;
