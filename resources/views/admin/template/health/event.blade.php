<section id="events" data-content="Events">
    <div class="main-container">
        <div class="heading-group">
            <div class="heading text-center">Events</div>
        </div>
        <div class="event-slider">
            @foreach ($eventData as $data)
                <div class="event-card">
                    <div>
                        <div>
                            <div class="img-wrapper">
                                <img src="{{ asset($data->image) }}" alt="Staff">
                            </div>
                            <div class="content p-3">
                                <div class="heading-sm mb-3">{{ $data->title }} </div>
                                <p class="para-wrap">{{ $data->short_description }}</p>
                                <x-hoverBtn href="{{ route('event.single', ['slug' => $data->slug]) }}"
                                    class="heading-xs">Read Post</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mobile-btn">
            <x-hoverBtn href="{{ route('event') }}"> View All Events </x-hoverBtn>
        </div>
    </div>
</section>
