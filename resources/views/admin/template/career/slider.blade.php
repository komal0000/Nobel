<section class="top-banner">
    <div class="main-container">
        <div class="slider" id="slick-slider">
            @foreach ($sliders as $slider)
            <div class="image-card">
                <picture>
                    <source media="(min-width: 768px)" srcset="{{ asset($slider->desktop_image) }}">
                    <source media="(max-width: 767px)" srcset="{{ asset($slider->mobile_image) }}">
                    <img class="img-fluid" src="{{ asset($slider->desktop_image) }}" alt="Slider Image">
                </picture>

            </div>
            @endforeach
        </div>
        <x-hoverBtn class="explore-btn" href="{{ route('jobs.jobcategory') }}">Explore Jobs</x-hoverBtn>
    </div>
</section>
