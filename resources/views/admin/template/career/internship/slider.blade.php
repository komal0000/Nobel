<div class="slide-wrapper">
    <div class="intern-slide">
        @foreach ($sliders as $slider )
        <div class="image-card">
            <img src="{{ asset($slider->mobile_image) }}" alt="Staff">
        </div>
        @endforeach
    </div>
</div>
