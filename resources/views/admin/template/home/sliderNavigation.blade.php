<div class=" slide-list d-flex">
    <div class="swiper-wrapper floating-tab d-flex" id="slick-slider">
        @foreach ($navigations as $navigation)
            <a href="{{ $navigation->link }}" class="swiper-slide left-hover" target="_blank">
                <img src="{{ Storage::url($navigation->icon) }}" class="me-2" alt="Appointment Image">
                <span>{{ $navigation->title }}</span>
            </a>
        @endforeach
    </div>
</div>
