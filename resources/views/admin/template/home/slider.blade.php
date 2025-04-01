<div class="top-banner-slider">
    @foreach ($sliders as $slider)
        <div class="image-card">
            <picture>
                <source media="(min-width: 768px)" srcset="{{ Storage::url($slider->desktop_image) }}">
                <source media="(max-width: 768px)" srcset="{{ Storage::url($slider->mobile_image) }}">
                <img class="img-fluid" src="{{ Storage::url($slider->desktop_image) }}" alt="Slider Image">
            </picture>
        </div>
    @endforeach
</div>
