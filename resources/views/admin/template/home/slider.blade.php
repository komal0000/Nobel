
<div id="home-top-banner">
    <div class="top-banner-slider">
        @foreach ($sliders as $slider)
        <div class="image-card">
            <picture>
                <source media="(min-width: 768px)" srcset="{{ Storage::url($slider->desktop_image) }}">
                <source media="(max-width: 768px)" srcset="{{ Storage::url($slider->mobile_image) }}">
                <img class="img-fluid" src="{{Storage::url($slider->desktop_image) }}" alt="Slider Image">
            </picture>
        </div>
        @endforeach
    </div>
    <div class="search-wrapper mx-auto">
        <div class="search-field">
            <input type="text" name="" id="search-box" class="search-box" placeholder="Search for Doctors">
            <button class="search-icon" type="button" name="search"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class=" slide-list d-flex">
        <div class="swiper-wrapper floating-tab d-flex" id="slick-slider">
            <a href="#" class="swiper-slide left-hover" target="_blank">
                <img src="{{ asset('front/assets/img/calendar-tick.svg') }}" class="me-2" alt="Appointment Image">
                <span>Book Appointment</span>
            </a>

            <a href="#" class="swiper-slide">
                <img src="{{ asset('front/assets/img/doctor.svg') }}" class="me-2" alt="Doctor Image">
                <span>Second Opinion</span>
            </a>

            <a href="#" class="swiper-slide">
                <img src="{{ asset('front/assets/img/checkup.svg') }}" class="me-2" alt="Checkup Image">
                <span>Get Health Checkup</span>
            </a>

            <a href="#" class="swiper-slide">
                <img src="{{ asset('front/assets/img/consultation.svg') }}" class="me-2" alt="Consultation Image">
                <span>Book A Virtual Consultation</span>
            </a>

            <a href="#" class="swiper-slide">
                <img src="{{ asset('front/assets/img/homecare.svg') }}" class="me-2" alt="Home Care Image">
                <span>Home Care</span>
            </a>

            <a href="#" class="swiper-slide right-hover">
                <img src="{{ asset('front/assets/img/test.svg') }}" class="me-2" alt="Test Image">
                <span>Book a Test</span>
            </a>
        </div>
    </div>
</div>

