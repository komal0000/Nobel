$(document).ready(function () {
   let cardsPerPage = 10;
   let totalCards = $(".card-col").length;
   let currentCount = 0;
   let searchActive = false;
   let searchValue = '';

   // Initial setup - hide all cards except first batch
   $(".card-col").hide();
   $(".card-col").slice(0, cardsPerPage).fadeIn();
   currentCount = cardsPerPage;

   function showMoreCards() {
      if (searchActive) {
         // Important: Use the searchValue variable here
         $('.card-col').filter(function () {
            let title = $(this).find('.heading-sm').text().toLowerCase();
            return title.includes(searchValue) && !$(this).is(':visible');
         }).slice(0, cardsPerPage).fadeIn();

         currentCount = $('.card-col').filter(function () {
            return $(this).is(':visible');
         }).length;

         let matchingCards = $('.card-col').filter(function () {
            let title = $(this).find('.each-card .heading-sm').text().toLowerCase();
            return title.includes(searchValue);
         }).length;

         if (currentCount >= matchingCards) {
            $("#load-more").hide();
         } else {
            $("#load-more").show();
         }
      } else {
         $(".card-col").slice(currentCount, currentCount + cardsPerPage).fadeIn();
         currentCount += cardsPerPage;

         if (currentCount >= totalCards) {
            $("#load-more").hide();
         } else {
            $("#load-more").show();
         }
      }
   }

   $("#load-more").on("click", function () {
      showMoreCards();
   });

   function filterSpeciality() {
      searchValue = $('#search-speciality').val().toLowerCase(); // Update the shared variable
      searchActive = searchValue.length > 0;

      // Reset and hide all cards
      $(".card-col").hide();
      currentCount = 0;

      if (searchActive) {
         $('.card-col').filter(function () {
            let title = $(this).find('.each-card .heading-sm').text().toLowerCase();
            return title.includes(searchValue);
         }).slice(0, cardsPerPage).fadeIn();

         currentCount = $('.card-col').filter(function () {
            return $(this).is(':visible');
         }).length;

         let matchingSpeciality = $('.card-col').filter(function () {
            let title = $(this).find('.each-card .heading-sm').text().toLowerCase();
            return title.includes(searchValue);
         }).length;

         if (currentCount >= matchingSpeciality) {
            $("#load-more").hide();
         } else {
            $("#load-more").show();
         }
      } else {
         $('.card-col').slice(0, cardsPerPage).fadeIn();
         currentCount = cardsPerPage;
         if (currentCount >= totalCards) {
            $("#load-more").hide();
         } else {
            $("#load-more").show();
         }
      }
   }

   function debounce(func, wait) {
      let timeout;
      return function () {
         const context = this;
         const args = arguments;
         clearTimeout(timeout);
         timeout = setTimeout(() => {
            func.apply(context, args);
         }, wait);
      };
   }

   $('#search-speciality').on("keyup", debounce(filterSpeciality, 300));
});