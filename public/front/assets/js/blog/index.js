document.addEventListener('DOMContentLoaded', function() {
    // Function to equalize card heights
    function equalizeCardHeight(selector) {
        let maxHeight = 0;
        $(selector).css('height', 'auto').each(function() {
            maxHeight = Math.max(maxHeight, $(this).height());
        });
        $(selector).height(maxHeight);
    }

    // Blog functionality
    const cardPerPage = 4;
    let featuredCount = 0;
    let currentFeaturedCount = 0;
    let allCount = 0;
    let currentAllCount = 0;
    let searchActive = false;
    let searchValue = "";

    // Show more for featured blogs
    function showMoreFeatured() {
        const totalCards = $(".featured-blog-card").length;
        featuredCount += cardPerPage;
        $('.featured-blog-card').slice(currentFeaturedCount, currentFeaturedCount + cardPerPage).fadeIn();
        currentFeaturedCount += cardPerPage;

        if (currentFeaturedCount >= totalCards) {
            $("#load-more-featured").hide();
        }
    }

    // Show more for all blogs considering search filter
    function showMoreAll() {
        let totalCards;

        if (searchActive) {
            // Only count and show visible cards that match the search
            let visibleCards = $(".all-blog-card").filter(function() {
                let title = $(this).find(".blog-title").text().toLowerCase();
                return title.includes(searchValue);
            });

            totalCards = visibleCards.length;
            visibleCards.filter(':hidden').slice(0, cardPerPage).fadeIn();

            // Update counts based on visible matching cards
            currentAllCount = $(".all-blog-card").filter(function() {
                let title = $(this).find(".blog-title").text().toLowerCase();
                return title.includes(searchValue) && $(this).is(':visible');
            }).length;
        } else {
            // Normal behavior when no search is active
            totalCards = $(".all-blog-card").length;
            $('.all-blog-card').slice(currentAllCount, currentAllCount + cardPerPage).fadeIn();
            currentAllCount += cardPerPage;
        }

        // Hide load more button when appropriate
        if (searchActive) {
            let hiddenMatchingCards = $(".all-blog-card").filter(function() {
                let title = $(this).find(".blog-title").text().toLowerCase();
                return title.includes(searchValue) && $(this).is(':hidden');
            }).length;

            $("#load-more-all").toggle(hiddenMatchingCards > 0);
        } else {
            $("#load-more-all").toggle(currentAllCount < totalCards);
        }
    }

    // Filter all blogs
    function filterAllBlogs() {
        searchValue = $("#search-all-blogs").val().toLowerCase();
        searchActive = searchValue.length > 0;
        currentAllCount = 0;
        $(".all-blog-card").hide();

        if (searchActive) {
            // Show the first batch of matching cards
            $(".all-blog-card").filter(function() {
                let title = $(this).find(".blog-title").text().toLowerCase();
                return title.includes(searchValue);
            }).slice(0, cardPerPage).fadeIn();

            // Update currentAllCount
            currentAllCount = $(".all-blog-card").filter(function() {
                let title = $(this).find(".blog-title").text().toLowerCase();
                return title.includes(searchValue) && $(this).is(':visible');
            }).length;

            // Check if there are more matching cards to show
            let totalMatchingCards = $(".all-blog-card").filter(function() {
                let title = $(this).find(".blog-title").text().toLowerCase();
                return title.includes(searchValue);
            }).length;

            $("#load-more-all").toggle(currentAllCount < totalMatchingCards);
        } else {
            // Show first batch of all cards when search is cleared
            $('.all-blog-card').slice(0, cardPerPage).fadeIn();
            currentAllCount = cardPerPage;
            $("#load-more-all").toggle(currentAllCount < $(".all-blog-card").length);
        }
    }

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

    // Event handlers
    $("#load-more-featured").on("click", showMoreFeatured);
    $("#load-more-all").on("click", showMoreAll);
    $("#search-all-blogs").on("keyup", filterAllBlogs);

    // Initial loading
    showMoreFeatured();
    showMoreAll();

    // Make these functions available globally
    window.equalizeCardHeight = equalizeCardHeight;
    window.extendSubMenu = extendSubMenu;
    window.extendKnowledgeSubMenu = extendKnowledgeSubMenu;
    window.expand = expand;
});
