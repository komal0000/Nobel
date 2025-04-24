<div class=" slide-list d-flex">
    <div class="swiper-wrapper floating-tab" id="slick-slider">
        @foreach ($navigations as $navigation)
            <a href="{{ $navigation->link }}" class="swiper-slide">
                <img src="{{ asset($navigation->icon) }}" class="me-2" alt="Appointment Image">
                <span>{{ $navigation->title }}</span>
            </a>
        @endforeach
    </div>
</div>
