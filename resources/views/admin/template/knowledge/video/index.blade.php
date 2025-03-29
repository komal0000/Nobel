<section id="videos-top-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)"
            srcset="{{ asset('front/assets/img/health-library/knowledge/video-banner.jpg') }}" width="1920"
            height="500" alt="video">
        <source media="(min-width: 320px)"
            srcset="{{ asset('front/assets/img/health-library/knowledge/video-banner-md.jpg') }}" width="480"
            height="320" alt="video">
        <img src="{{ asset('front/assets/img/health-library/knowledge/video-banner.jpg') }}" width="1920"
            height="500" alt="video" class="img-fluid w-100">
        <div class="banner-title">Videos</div>
    </picture>
</section>

@foreach ($videoTypes as $type)
    <section id="doctor-videos">
        <div class="main-container">
            <div class="heading-group">
                <div class="heading text-center">{{ $type->title }}</div>
                <x-hoverBtn class="button" href="/all-videos">View All</x-hoverBtn>
            </div>
            @php
                $videos = App\Models\Video::where('video_type_id', $type->id)->get();
            @endphp
            <div class="doctor-slider">
                @foreach ($videos as $video)
                    <div class="video-card doctor-card">
                        <div class="img-wrapper">
                            <a href="https://www.youtube.com/embed/{{ $video->video_link }}" class="glightbox">
                                <img src="{{ $video->video_image }}" alt="Staff">
                                <img class="play-icon" src="{{ asset('front/assets/img/youtube.png') }}"
                                    alt="Play Icon">
                            </a>
                        </div>
                        <div class="body">
                            <div class="heading-sm">
                                {{ $video->title }}
                            </div>
                            <div class="para-wrap">
                                <span>Dr Name </span>
                                | Field of Doctor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mobile-btn">
                <x-hoverBtn href="/all-videos">View All</x-hoverBtn>
            </div>
        </div>
    </section>
@endforeach
