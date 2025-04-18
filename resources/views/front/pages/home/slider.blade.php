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
                <a href="{{ route('contact') }}" class="btn-action button-secondary feedback-btn">
                    <img src="{{ asset('front/assets/img/feedback.png') }}" alt="Feedback">
                    <span>Feedback</span>
                </a>

                <a href="tel:100" class="btn-action button-primary emergency-btn">
                    <img src="{{ asset('front/assets/img/emergency.png') }}" alt="Emergency">
                    <span>Emergency</span>
                </a>

                <a class="btn-action button-primary" data-bs-toggle="modal" data-bs-target="#callback-modal">
                    <img src="{{ asset('front/assets/img/phone-icon.png') }}" alt="Call Back">
                    <span>Request Call</span>
                </a>

                <a href="#" class="btn-action button-secondary">
                    <img src="{{ asset('front/assets/img/whatsapp.png') }}" alt="WhatsApp">
                    <span>WhatsApp</span>
                </a>
            </div>
        </div>
       
    </div>
</section>
<div class="modal fade" id="callback-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header p-0 pb-3 border-bottom-0">
                <h2 class="modal-title heading-md text-center">Request Call Back</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Full Name *" required>
                            <label for="name">Full Name *</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone Number *"
                                required>
                            <label for="phoneNumber">Phone Number *</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address *"
                                required>
                            <label for="email">Email
                                Address *</label>
                        </div>
                    </div>
                    <div class="col-12 submit-btn">
                        <button class="w-100" id="submit-callback">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
