<section class="employee-section">
    <div class="main-container">
        <div class="heading text-center">
            Empowering Lives, Inspiring Excellence
        </div>
        <div class="tabs text-center">
            <button class="tab active-tab" onclick="changeTab(this)">Employees & Awards</button>
            <button class="tab" onclick="changeTab(this)">Our Philosophy</button>
        </div>
        <div class="content-main">
            <div class="employee-flex d-flex justify-content-between flex-nowrap flex-lg-row flex-column">
                @includeIf('front.cache.career.testimonials')
                @includeIf('front.cache.career.awards')
            </div>
        </div>
    </div>
</section>
