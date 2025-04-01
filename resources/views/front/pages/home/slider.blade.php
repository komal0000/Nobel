<section id="home-top-banner">
    @includeIf('front.cache.home.slider')
    <div class="main-container">
        <div class="search-wrapper mx-auto">
            <div class="search-field">
                <input type="text" name="" id="search-box" class="search-box" placeholder="Search for Doctors">
                <button class="search-icon" type="button" name="search"><i class="bi bi-search"></i></button>
            </div>
        </div>
        @includeIf('front.cache.home.sliderNavigation')
    </div>
</section>
