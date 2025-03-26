$(document).ready(function() {
    $('.letter-slider').slick({
        slidesToShow: 10,
        slidesToScroll: 3,
        infinite: false,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png " alt="Right Arrow"></button>',
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 8,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            }
        ]
    });

    const itemsPerPage = 10;
    let currentPage = 1;
    let selectedLetter = "all";
    const cards = $(".each-card");
    const paginationContainer = $("#paginationButtons");
    const searchBox = $("input[name='searchBox']");
    const letterButtons = $(".char");

    function getAvailableLetters() {
        let letters = new Set();
        cards.each(function() {
            let title = $(this).find(".title").text().trim().toLowerCase();
            if (title.length) letters.add(title.charAt(0));
        });

        letterButtons.each(function() {
            let letter = $(this).text().trim().toLowerCase();
            $(this).prop("disabled", letter !== "all" && !letters.has(letter))
                .toggleClass("disabled", letter !== "all" && !letters.has(letter));
        });
    }

    function filterCards() {
        let searchText = searchBox.val().toLowerCase();
        let filteredCards = cards.filter(function() {
            let title = $(this).find(".title").text().trim().toLowerCase();
            return (selectedLetter === "all" || title.startsWith(selectedLetter)) && title.includes(
                searchText);
        });
        showPage(1, filteredCards);
        createPaginationButtons(filteredCards);
    }

    function showPage(page, filteredCards) {
        currentPage = page;
        cards.hide();
        let start = (page - 1) * itemsPerPage;
        let end = start + itemsPerPage;
        filteredCards.slice(start, end).show();

        $("#prevPage").prop("disabled", page === 1);
        $("#nextPage").prop("disabled", page === Math.ceil(filteredCards.length / itemsPerPage));
        $(".page-btn").removeClass("active");
        $(`#page-${page}`).addClass("active");
    }

    function createPaginationButtons(filteredCards) {
        paginationContainer.empty();
        let pages = Math.ceil(filteredCards.length / itemsPerPage);
        for (let i = 1; i <= pages; i++) {
            let button = $(`<button class="mx-1 page-btn" id="page-${i}">${i}</button>`);

            if (i === 1) {
                button.addClass("active");
            }
            button.click(() => showPage(i, filteredCards));
            paginationContainer.append(button);
        }
    }

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
        if (currentPage < Math.ceil($(".each-card:visible").length / itemsPerPage)) {
            showPage(currentPage + 1, $(".each-card:visible"));
        }
    });

    getAvailableLetters();
    filterCards();
});
