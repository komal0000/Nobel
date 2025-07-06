$(function() {
   // Cache selectors
   const $cards = $(".each-card");
   const $pagination = $("#paginationButtons");
   const $searchBox = $("input[name='searchBox']");
   const $letterBtns = $(".char");
   const $prevPage = $("#prevPage");
   const $nextPage = $("#nextPage");

   const itemsPerPage = 10;
   let currentPage = 1;
   let selectedLetter = "all";
   let filteredCards = $cards;

   // Slick slider init
   $('.letter-slider').slick({
      slidesToShow: 10,
      slidesToScroll: 3,
      infinite: false,
      arrows: true,
      prevArrow: `<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>`,
      nextArrow: `<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>`,
      responsive: [
         { breakpoint: 1200, settings: { slidesToShow: 8, slidesToScroll: 3 } },
         { breakpoint: 992,  settings: { slidesToShow: 6, slidesToScroll: 3 } },
         { breakpoint: 768,  settings: { slidesToShow: 4, slidesToScroll: 2 } },
         { breakpoint: 576,  settings: { slidesToShow: 3, slidesToScroll: 2 } }
      ]
   });

   function getAvailableLetters() {
      const letters = new Set($cards.map(function() {
         return $(this).find(".title").text().trim().toLowerCase().charAt(0);
      }).get());

      $letterBtns.each(function() {
         const $btn = $(this);
         const letter = $btn.text().trim().toLowerCase();
         const isAvailable = letter === "all" || letters.has(letter);
         $btn.prop("disabled", !isAvailable).toggleClass("disabled", !isAvailable);
      });
   }

   function filterCards() {
      const searchText = $searchBox.val().toLowerCase();
      filteredCards = $cards.filter(function() {
         const title = $(this).find(".title").text().trim().toLowerCase();
         return (selectedLetter === "all" || title.startsWith(selectedLetter)) && title.includes(searchText);
      });
      showPage(1);
      createPaginationButtons();
   }

   function showPage(page) {
      currentPage = page;
      $cards.hide();
      const start = (page - 1) * itemsPerPage;
      filteredCards.slice(start, start + itemsPerPage).show();

      $prevPage.prop("disabled", page === 1);
      $nextPage.prop("disabled", page === Math.ceil(filteredCards.length / itemsPerPage));
      $pagination.find(".page-btn").removeClass("active");
      $pagination.find(`#page-${page}`).addClass("active");
   }

   function createPaginationButtons() {
      $pagination.empty();
      const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
      for (let i = 1; i <= totalPages; i++) {
         $pagination.append(`<button class="mx-1 page-btn" id="page-${i}">${i}</button>`);
      }
      $pagination.find(`#page-1`).addClass("active");
   }

   // Letter filter
   $letterBtns.click(function() {
      if ($(this).is(":disabled")) return;
      $letterBtns.removeClass("active");
      $(this).addClass("active");
      selectedLetter = $(this).text().trim().toLowerCase();
      filterCards();
   });

   // Search filter
   $searchBox.on("input", filterCards);

   // Pagination events
   $pagination.on("click", ".page-btn", function() {
      const page = parseInt(this.textContent, 10);
      showPage(page);
   });

   $prevPage.click(() => {
      if (currentPage > 1) showPage(currentPage - 1);
   });

   $nextPage.click(() => {
      const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
      if (currentPage < totalPages) showPage(currentPage + 1);
   });

   // URL param letter
   function getUrlParameter(name) {
      const regex = new RegExp(`[?&]${name}=([^&#]*)`);
      const results = regex.exec(location.search);
      return results ? decodeURIComponent(results[1].replace(/\+/g, ' ')) : '';
   }

   getAvailableLetters();

   let paramLetter = getUrlParameter('letter').toLowerCase();
   if (paramLetter) {
      const $btn = $(`.char-${paramLetter}`);
      if ($btn.length && !$btn.hasClass("disabled")) {
         $letterBtns.removeClass("active");
         $btn.addClass("active");
         selectedLetter = paramLetter;
      } else {
         selectedLetter = "all";
         $letterBtns.removeClass("active");
         $('.char-all').addClass('active');
         alert('No Result Found For Letter ' + (paramLetter).toUpperCase());
      }
   }

   filterCards();
});
