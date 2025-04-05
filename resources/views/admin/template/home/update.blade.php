<section class="update">
    <div class="main-container">
        <div class="heading">
            Updates
        </div>
        <div class="update-slider">
            @foreach ($updateData as $data)
                <div class="update-card">
                    <div class="d-flex justify-content-center">
                        <img src="{{ Storage::url($data->image) }}" alt="care">
                    </div>
                    <div class="head">{{ $data->title }}</div>
                    <div class="content">{{ $data->short_description }}</div>
                    <x-hoverBtn href="{{ route('update.single', ['update_id' => $data->id]) }}" class="button">Know
                        More</x-hoverBtn>
                </div>
            @endforeach
        </div>
    </div>
</section>
