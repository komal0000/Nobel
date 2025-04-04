<section class="specialities">

    <div class="main-container">
        <div class="specialities-inner d-flex flex-column flex-xl-row gap-2">
            <div class="sp-inner-heading">
                <h4 class="sp-subheading">Specialities</h4>
                <h2 class="sp-heading">An Ecosystem for Clinical Excellence</h2>
            </div>
            <div class="sp-inner-care  fw-bold">
                @includeIf('front.cache.home.speciality')
                <div class="hover-button">
                    <x-hoverBtn class="hover-btn" href="https://www.google.com" target="_blank">
                        View All Specialities
                    </x-hoverBtn>
                </div>
            </div>
            <div class="sp-inner-search">
                <div class="sp-wrapper">
                    <h4 class="sp-subheading">Search By</h4>
                    <div class="sp-search-by d-flex justify-content-evenly gap-1">
                        <button class="flex-fill sp-btn active-btn" onclick="setActive(this)">Ailments</button>
                        <button class="flex-fill sp-btn" onclick="setActive(this)">Treatments</button>
                        <button class="flex-fill sp-btn" onclick="setActive(this)">Technologies</button>
                    </div>
                    <div class="sp-search-letter">
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>a</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>b</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>c</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>d</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>e</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>f</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>g</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>h</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>i</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>j</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>k</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>l</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>m</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>n</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>o</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>p</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>q</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>r</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>s</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>t</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>u</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>v</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>w</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>x</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>y</span></button>
                        </div>
                        <div class="letter-wrap"><button onclick="setActiveLetter(this)"><span>z</span></button>
                        </div>
                    </div>
                </div>
                <div class="hover-button-sp active">
                    <x-hoverBtn class="hover-btn" href="{{ route('aliment.index') }}" data-content="ailments"><span
                            class="hover-text">View All Ailments</span></x-hoverBtn>
                </div>
                <div class="hover-button-sp">
                    <x-hoverBtn class="hover-btn" href="{{ route('treatment.index') }}" data-content="treatments"><span
                            class="hover-text">View All Treatments</span></x-hoverBtn>
                </div>
                <div class="hover-button-sp">
                    <x-hoverBtn class="hover-btn" href="{{ route('technology.index') }}"
                        data-content="technologies"><span class="hover-text">View All Technologies</span></x-hoverBtn>
                </div>
            </div>
        </div>
    </div>
</section>
