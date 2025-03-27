$(document).ready(function() {
    function equalizeCardHeight(selector) {
        let maxHeight = 0;
        $(selector).css('height', 'auto').each(function() {
            maxHeight = Math.max(maxHeight, $(this).height());
        });
        $(selector).height(maxHeight);
    }

    // Initialize letter slider
    $('.letter-slider').slick({
        slidesToShow: 10,
        slidesToScroll: 3,
        infinite: false,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {breakpoint: 1200, settings: {slidesToShow: 8, slidesToScroll: 3}},
            {breakpoint: 992, settings: {slidesToShow: 6, slidesToScroll: 3}},
            {breakpoint: 768, settings: {slidesToShow: 4, slidesToScroll: 2}},
            {breakpoint: 576, settings: {slidesToShow: 3, slidesToScroll: 2}}
        ]
    });

    // Pagination and filtering setup
    const itemsPerPage = 10;
    let currentPage = 1;
    let selectedLetter = "all";
    const cards = $(".each-card");
    const paginationContainer = $("#paginationButtons");
    const searchBox = $("input[name='searchBox']");
    const letterButtons = $(".char");

    // Get available letters for filtering
    function getAvailableLetters() {
        const letters = new Set();
        cards.each(function() {
            const title = $(this).find(".title").text().trim().toLowerCase();
            if (title.length) letters.add(title.charAt(0));
        });

        letterButtons.each(function() {
            const letter = $(this).text().trim().toLowerCase();
            const isDisabled = letter !== "all" && !letters.has(letter);
            $(this).prop("disabled", isDisabled).toggleClass("disabled", isDisabled);
        });
    }

    // Filter cards based on selected letter and search text
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

    // Show specific page of filtered cards
    function showPage(page, filteredCards) {
        currentPage = page;
        cards.hide();

        const start = (page - 1) * itemsPerPage;
        filteredCards.slice(start, start + itemsPerPage).show();

        // Update pagination UI
        $("#prevPage").prop("disabled", page === 1);
        $("#nextPage").prop("disabled", page === Math.ceil(filteredCards.length / itemsPerPage));
        $(".page-btn").removeClass("active");
        $(`#page-${page}`).addClass("active");
    }

    // Create pagination buttons based on filtered results
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

    // Navigation functions
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

    // Toggle navbar for mobile
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
    });

    // Initialize the page
    getAvailableLetters();
    filterCards();

    // Make functions available globally
    window.equalizeCardHeight = equalizeCardHeight;
    window.extendSubMenu = extendSubMenu;
    window.extendKnowledgeSubMenu = extendKnowledgeSubMenu;
    window.expand = expand;
});
