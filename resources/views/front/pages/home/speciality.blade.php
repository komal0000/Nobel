<section class="specialities">
    <div class="main-container">
        <div class="specialities-inner d-flex flex-column flex-xl-row gap-2">
            <div class="sp-inner-heading">
                <h4 class="sp-subheading">Specialities</h4>
                 @includeIf('front.cache.home.specialityTitle')
            </div>
            <div class="sp-inner-care p-3 pt-0 fw-bold">
               @includeIf('front.cache.home.speciality')
                <div class="hover-button">
                    <x-hoverBtn class="hover-btn" href="https://www.google.com" target="_blank">
                        View All Specialities
                    </x-hoverBtn>
                </div>
            </div>
            <div class="sp-inner-search p-3 pt-0">
                <div class="sp-wrapper">
                    <h4 class="sp-subheading">Search By</h4>
                    <div class="sp-search-by d-flex justify-content-evenly gap-1">
                        <button class="flex-fill sp-btn active-btn" onclick="setActive(this)">Ailments</button>
                        <button class="flex-fill sp-btn" onclick="setActive(this)">Treatments</button>
                        <button class="flex-fill sp-btn" onclick="setActive(this)">Technologies</button>
                    </div>
                    <div class="sp-search-letter">
                        <div class="letter-wrap"><button class=""><span class="">a</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">b</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">c</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">d</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">e</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">f</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">g</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">h</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">i</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">j</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">k</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">l</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">m</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">n</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">o</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">p</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">q</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">r</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">s</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">t</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">u</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">v</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">w</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">x</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">y</span></button>
                        </div>
                        <div class="letter-wrap"><button class=""><span class="">z</span></button>
                        </div>
                    </div>
                </div>
                <div class="hover-button">
                    <x-hoverBtn class="hover-btn" href="#">View All Technologies</x-hoverBtn>
                </div>

            </div>
        </div>
    </div>
    </div>

</section>

