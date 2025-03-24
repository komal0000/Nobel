<section class="top-banner">
    <div class="main-container">
        <div class="slider" id="slick-slider">
            <div class="image-card">
                <picture>
                    <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/career/slide-banner-1.jpg') }}">
                    <source media="(max-width: 767px)" srcset="{{ asset('front/assets/img/career/slide-banner-mob-1.jpg') }}">
                    <img class="img-fluid" src="{{ asset('front/assets/img/career/slide-banner-1.jpg') }}" alt="Slider Image">
                </picture>

            </div>
            <div class="image-card">
                <picture>
                    <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/career/slide-banner-2.jpg') }}">
                    <source media="(max-width: 767px)" srcset="{{ asset('front/assets/img/career/slide-banner-mob-2.jpg') }}">
                    <img class="img-fluid" src="{{ asset('front/assets/img/career/slide-banner-2.jpg') }}" alt="Slider Image">
                </picture>

            </div>
            <div class="image-card">
                <picture>
                    <source media="(min-width:768px)" srcset="{{ asset('front/assets/img/career/slide-banner-3.png') }}">
                    <source media="(max-width:767px)" srcset="{{ asset('front/assets/img/career/slide-banner-mob-3.jpg') }}">
                    <img src="{{ asset('front/assets/img/career/slide-banner-3.png') }}" alt="Slider Image" class="img-fluid">
                </picture>
            </div>
        </div>
        <x-hoverBtn class="explore-btn">Explore Jobs</x-hoverBtn>
    </div>
</section>
