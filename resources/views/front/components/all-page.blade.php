 <section id="all-section">
     <div class="main-container">
         <div class="heading mb-4 text-center">{{ $title }}</div>
         <div class="letter-slider">
             <div class="char-wrapper"><button class="char char-all active">All</button></div>
             <div class="char-wrapper"><button class="char char-a">A</button></div>
             <div class="char-wrapper"><button class="char char-b">B</button></div>
             <div class="char-wrapper"><button class="char char-c">C</button></div>
             <div class="char-wrapper"><button class="char char-d">D</button></div>
             <div class="char-wrapper"><button class="char char-e">E</button></div>
             <div class="char-wrapper"><button class="char char-f">F</button></div>
             <div class="char-wrapper"><button class="char char-g">G</button></div>
             <div class="char-wrapper"><button class="char char-h">H</button></div>
             <div class="char-wrapper"><button class="char char-i">I</button></div>
             <div class="char-wrapper"><button class="char char-j">J</button></div>
             <div class="char-wrapper"><button class="char char-k">K</button></div>
             <div class="char-wrapper"><button class="char char-l">L</button></div>
             <div class="char-wrapper"><button class="char char-m">M</button></div>
             <div class="char-wrapper"><button class="char char-n">N</button></div>
             <div class="char-wrapper"><button class="char char-o">O</button></div>
             <div class="char-wrapper"><button class="char char-p">P</button></div>
             <div class="char-wrapper"><button class="char char-q">Q</button></div>
             <div class="char-wrapper"><button class="char char-r">R</button></div>
             <div class="char-wrapper"><button class="char char-s">S</button></div>
             <div class="char-wrapper"><button class="char char-t">T</button></div>
             <div class="char-wrapper"><button class="char char-u">U</button></div>
             <div class="char-wrapper"><button class="char char-v">V</button></div>
             <div class="char-wrapper"><button class="char char-w">W</button></div>
             <div class="char-wrapper"><button class="char char-x">X</button></div>
             <div class="char-wrapper"><button class="char char-y">Y</button></div>
             <div class="char-wrapper"><button class="char char-z">Z</button></div>
         </div>
         <div class="search-input mb-4">
             <form action="">
                 <div class="form-floating">
                     <input type="text" name="searchBox" class="form-control" placeholder="Search for Treatments">
                     <label for="searchBox">Search for {{ $title }}</label>
                     <i class="bi bi-search"></i>
                 </div>
             </form>
         </div>
         <div class="cards-container">
             <div class="row g-4">
                 {{ $slot }}
             </div>
         </div>
         <div class="pagination-container d-flex justify-content-center mt-4">
             <button id="prevPage" class="left-arrow mx-4"><img src="{{ asset('front/img/vector-left.png') }}"
                     alt="Left Arrow"></button>
             <div id="paginationButtons" class="d-flex"></div>
             <button id="nextPage" class="right-arrow mx-4"><img src="{{ asset('front/img/vector-right.png') }}"
                     alt="Right Arrow"></button>
         </div>

     </div>
 </section>
 @push('js')
     <script>
         $(document).ready(function() {
             $('.letter-slider').slick({
                 slidesToShow: 10,
                 slidesToScroll: 3,
                 infinite: false,
                 arrows: true,
                 prevArrow: '<button class="slick-prev left-arrow"><img src="{{ asset('front/img/vector-left.png') }}" alt="Left Arrow"></button>',
                 nextArrow: '<button class="slick-next right-arrow"><img src="{{ asset('front/img/vector-right.png') }}" alt="Right Arrow"></button>',
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
     </script>
 @endpush
