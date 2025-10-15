<section id="home-top-banner">
    @includeIf('front.cache.home.slider')
    <div class="main-container">
        @includeIf('front.cache.home.sliderNavigation')
        <div class="search-wrapper mx-auto">
            <div class="search-field">
                <a href="{{ route('doctor.index') }}" class="btn-action">
                    Search For Doctor
                </a>
            </div>

            <div class="feedback-section">
                <a href="{{ route('contact') }}" class="btn-action button-primary feedback-btn">
                    <img src="{{ asset('front/assets/img/feedback.png') }}" alt="Feedback">
                    <span>Feedback</span>
                </a>

                <a href="tel:102" class="btn-action button-primary">
                    <img src="{{ asset('front/assets/img/emergency.png') }}" alt="Emergency">
                    <span>Emergency</span>
                </a>

                <a class="btn-action button-primary" style="cursor: pointer;" data-bs-toggle="modal"
                    data-bs-target="#callback-modal">
                    <img src="{{ asset('front/assets/img/phone-icon.png') }}" alt="Call Back">
                    <span>Request Call</span>
                </a>
            </div>
            
            <div class="feedback-section">
                <a href="https://reports.kmc.edu.np/login" target="_blank" class="btn-action button-primary feedback-btn">
                    {{-- <img src="{{ asset('front/assets/img/feedback.png') }}" alt="Feedback"> --}}
                    <span>Online Lab Report</span>
                </a>

                <a href="https://appointment.merodoctor.com/hospitals/service" target="_blank" class="btn-action button-primary feedback-btn">
                    {{-- <img src="{{ asset('front/assets/img/emergency.png') }}" alt="Emergency"> --}}
                    <span>Online Appointment</span>
                </a>

                <a href="{{ route('knowledge.newsletter') }}" class="btn-action button-primary" style="cursor: pointer;">
                    <span>News Letter</span>
                </a>
            </div>
        </div>

    </div>
</section>

