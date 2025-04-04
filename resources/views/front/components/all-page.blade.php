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
             <button id="prevPage" class="left-arrow mx-4"><img src="{{ asset('front/assets/img/vector-left.png') }}"
                     alt="Left Arrow"></button>
             <div id="paginationButtons" class="d-flex"></div>
             <button id="nextPage" class="right-arrow mx-4"><img src="{{ asset('front/assets/img/vector-right.png') }}"
                     alt="Right Arrow"></button>
         </div>

     </div>
 </section>

