<section id="home-top-banner">
    @includeIf('front.cache.home.slider')
    <div class="main-container">
        <div class="search-wrapper mx-auto">
            <div class="search-field">
                <a href="/doctor-listing" class="btn-action">
                    Search For Doctor
                </a>
            </div>

            <div class="feedback-section">
                <a href="/contact-us" class="btn-action button-secondary feedback-btn">
                    <img src="{{ asset('front/assets/img/feedback.png') }}" alt="Feedback">
                    <span>Feedback</span>
                </a>

                <a href="tel:1068" class="btn-action button-primary emergency-btn">
                    <img src="{{ asset('front/assets/img/emergency.png') }}" alt="Emergency">
                    <span>Emergency</span>
                </a>

                <a href="#" class="btn-action button-primary" data-bs-toggle="modal" data-bs-target="#callback-modal">
                    <img src="{{ asset('front/assets/img/phone-icon.png') }}" alt="Call Back">
                    <span>Request Call</span>
                </a>

                <a href="#" class="btn-action button-secondary">
                    <img src="{{ asset('front/assets/img/whatsapp.png') }}" alt="WhatsApp">
                    <span>WhatsApp</span>
                </a>
            </div>
        </div>
        @includeIf('front.cache.home.sliderNavigation')
    </div>
</section>