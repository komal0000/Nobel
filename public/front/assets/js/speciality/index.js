$(document).ready(function() {
    let cardsPerPage = 16;
    let totalCards = $(".card-col").length;
    let currentCount = 0;

    function showMoreCards() {
        $(".card-col").slice(currentCount, currentCount + cardsPerPage).fadeIn();
        currentCount += cardsPerPage;
        console.log($('.card-col'), currentCount);


        if (currentCount >= totalCards) {
            $("#load-more").hide();
        }
    }

    showMoreCards();
    $("#load-more").on("click", function() {
        console.log("Load more clicked");
        showMoreCards();
    });
});
