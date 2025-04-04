<div class="tab-panel" id="tab-2">
    <div class="tab-slider">
        @foreach ($videos as $video)
            <div class="video-card">
                <div>
                    <a href="https://www.youtube.com/embed/{{ $video->video_link }}" class="glightbox">
                        <img src="{{ $video->video_image }}" alt="Staff">
                        <img class="play-icon" src="{{ asset('front/assets/img/youtube.png') }}" alt="Play Icon">
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
