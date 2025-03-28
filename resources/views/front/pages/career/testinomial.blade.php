<section class="employee-section">
    <div class="main-container">
        <div class="heading text-center">
            Empowering Lives, Inspiring Excellence
        </div>
        <div class="tabs text-center">
            <button class="tab active-tab" onclick="changeTab(this)" data-tab="#tab-1">Employees & Awards</button>
            <button class="tab" onclick="changeTab(this)" data-tab="#tab-2">Our Philosophy</button>
        </div>
        <div class="content-main active" id="tab-1">
            <div class="employee-flex d-flex justify-content-between flex-nowrap flex-lg-row flex-column">
                @includeIf('front.cache.career.testimonials')
                @includeIf('front.cache.career.awards')
            </div>
        </div>
        <div class="content-main" id="tab-2">
            @includeIf('front.cache.career.philosophy')
        </div>
    </div>
</section>
