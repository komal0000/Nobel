<section id="services" class="services" data-content="Services">
    <div class="main-container">
        <div class="heading">
            Services
        </div>
        <div class="service-slider" id="service-slider">
            @foreach ($homeServices as $service)
                <div class="slide m-3">
                    <div class="img-wrapper">
                        <img src="{{ Storage::url($service->image) }}" alt="Service Image" class="img-fluid">
                    </div>
                    <div class="body">
                        <h3 class="title heading-md">{{ $service->title }}</h3>
                        <p class="para-wrap content">{{ $service->short_desc }}</p>
                        <div class="d-flex justify-content-between know-btn">
                            <x-hoverBtn href="{{ route('service.single', ['slug' => $service->slug]) }}">Know
                                More</x-hoverBtn>
                            <div class="service-logo">
                                <img src="{{ Storage::url($service->icon) }}" alt="Home Care">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
