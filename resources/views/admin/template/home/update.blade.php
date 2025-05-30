<section id="update" class="update" data-content="Update">
    <div class="main-container">
        <div class="heading">
            Updates
        </div>
        <div class="update-slider">
            @foreach ($updateData as $data)
                <div class="update-card">
                    <div class="card-image d-flex justify-content-center">
                        <img src="{{ asset($data->image) }}" alt="care">
                    </div>
                    <div class="head">{{ $data->title }}</div>
                    <div class="content">{{ $data->short_description }}</div>
                    <x-hoverBtn href="{{ route('update.single', $data->slug) }}" class="button">Know
                        More</x-hoverBtn>
                </div>
            @endforeach
        </div>
    </div>
</section>
