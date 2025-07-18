<section id="technology" data-content="Technology">
    <div class="main-container">
        <div class="heading-group mb-4">
            <div class="heading text-center">Technology</div>
        </div>
        <div class="technology-slider">
            @foreach ($technologiesLatest as $technology)
                <div class="tech-card d-flex flex-column flex-xl-row-reverse m-3 rounded-4 overflow-hidden">
                    <div class="img-wrapper">
                        <img class="w-100 img-fluid" src="{{ asset($technology->image) }}" alt="Doctor">
                        alt="Doctor">
                    </div>
                    <div class="body d-flex flex-column justify-content-center p-4">
                        <div class="heading-sm mb-3">{{ $technology->title }}</div>
                        <p class="para-wrap">
                            {{ $technology->short_description }}
                        </p>
                        <x-hoverBtn href="{{ route('technology.single', ['slug' => $technology->slug]) }}"
                            class="heading-xs">Know More</x-hoverBtn>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mobile-btn">
            <x-hoverBtn href="{{ route('technology.index') }}">View All </x-hoverBtn>
        </div>
    </div>
</section>
