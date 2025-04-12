<section id="dr-media">
    <div class="main-container">
        <x-sliderComponent heading="Media" mainClass="drVideoSlider">
            @foreach ($videos as $video)
                <a href="https://www.youtube.com/watch?v={{ $video->video_link }}" class="glightbox m-3">
                    <div class="each-video">
                        <img src="{{ $video->video_image }}" alt="Thumbnail">
                        <img class="play-icon" src="{{ asset('front/assets/img/youtube.png') }}" alt="Play Icon">
                        <div class="heading-sm">{{ $video->title }}</div>
                    </div>
                </a>
            @endforeach
        </x-sliderComponent>
        <div class="all-btn">
            <x-hoverBtn>View All Media</x-hoverBtn>
        </div>
    </div>
</section>
