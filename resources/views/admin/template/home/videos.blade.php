<section class="story">
    <div class="main-container">
        <div class="heading">
            {{ $VideoType->title }}
        </div>
        <div class="videos">
            <div class="video-wrapper row" id="story-slider">
                @foreach ($homeVideos as $video)
                    <a href="https://www.youtube.com/embed/{{ $video->video_link }}" class="glightbox col-xl-4 col-xxl-3">
                        <div class="each-video m-3">
                            <img src="{{ $video->video_image }}" alt="Thumbnail">
                            <img class="play-icon" src="{{ asset('front/assets/img/youtube.png') }}" alt="Play Icon">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="main-container text-center">
        <x-hoverBtn href="#" class="view-all">View All Patients</x-hoverBtn>
    </div>
</section>
