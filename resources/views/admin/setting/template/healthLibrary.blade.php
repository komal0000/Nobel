<section id="health-care" data-content="health-care">
    <div class="main-container">
        <div class="heading text-center mb-4">
            We're Here To Make Managing Your Healthcare Easier
        </div>
        <div class="desktop-card">
            <div class="row">
                @if(isset($data) && is_array($data) && count($data) >= 4)
                    <!-- First item: Image left, content right -->
                    <div class="col-3">
                        <img src="{{ asset($data[0]['image']) }}" alt="{{ $data[0]['title'] }}">
                    </div>
                    <div class="col-3">
                        <div class="heading-sm mb-3">{{ $data[0]['title'] }}</div>
                        <x-hoverBtn href="{{ route($data[0]['link'].'.index') }}" class="heading-xs">Know More</x-hoverBtn>
                    </div>

                    <!-- Second item: Image right, content left -->
                    <div class="col-3">
                        <img src="{{ asset($data[1]['image']) }}" alt="{{ $data[1]['title'] }}">
                    </div>
                    <div class="col-3">
                        <div class="heading-sm mb-3">{{ $data[1]['title'] }}</div>
                        <x-hoverBtn href="{{ route($data[1]['link'].'.index') }}" class="heading-xs">Know More</x-hoverBtn>
                    </div>

                    <!-- Third item: Content left, image right -->
                    <div class="col-3">
                        <div class="heading-sm mb-3">{{ $data[2]['title'] }}</div>
                        <x-hoverBtn href="{{ route($data[2]['link'].'.index') }}" class="heading-xs">Know More</x-hoverBtn>
                    </div>
                    <div class="col-3">
                        <img src="{{ asset($data[2]['image']) }}" alt="{{ $data[2]['title'] }}">
                    </div>

                    <!-- Fourth item: Content left, image right -->
                    <div class="col-3">
                        <div class="heading-sm mb-3">{{ $data[3]['title'] }}</div>
                        <x-hoverBtn href="{{ route($data[3]['link'].'.index') }}" class="heading-xs">Know More</x-hoverBtn>
                    </div>
                    <div class="col-3">
                        <img src="{{ asset($data[3]['image']) }}" alt="{{ $data[3]['title'] }}">
                    </div>
                @endif
            </div>
        </div>
        <div class="mobile-slider">
            @if(isset($data) && is_array($data))
                @foreach($data as $item)
                    <div class="mobile-card">
                        <div class="img-wrapper">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}">
                        </div>
                        <div class="body">
                            <div class="heading-sm mb-3">{{ $item['title'] }}</div>
                            <x-hoverBtn href="{{ route($item['link'].'.index') }}" class="heading-xs">Know More</x-hoverBtn>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
