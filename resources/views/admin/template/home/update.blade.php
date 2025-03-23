<section class="update">
    <div class="main-container">
        <div class="heading">
            Updates
        </div>
        <div class="update-slider">
            @foreach ($updateData as $data )
            <div class="update-card">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('front/assets/img/care.png') }}" alt="care">
                </div>
                <div class="head">{{$data->title}}</div>
                <div class="content">{{$data->short_description}}</div>
                <x-hoverBtn class="button">Know More</x-hoverBtn>
            </div>
            @endforeach
        </div>
    </div>
</section>
