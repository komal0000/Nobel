<section id="home-story">
    <div class="main-container">
        <div class="heading">
            {{ $VideoType->title }}
        </div>
        <div class="videos">
            <div class="video-wrapper" id="story-slider">
                @foreach ($homeVideos as $video)
                    <a href="https://www.youtube.com/embed/{{ $video->video_link }}" class="glightbox col-xl-4 col-xxl-3">
                        <div class="each-video">
                            <img src="{{ $video->video_image }}" alt="Thumbnail">
                            <img class="play-icon" src="{{ asset('front/assets/img/youtube.png') }}" alt="Play Icon">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="main-container text-center">
        <x-hoverBtn href="{{ route('knowledge.video') }}" class="view-all">View All Videos </x-hoverBtn>
    </div>
</section>
