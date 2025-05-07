<section id="each-update" data-content="Update">
    <div class="main-container">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="single-update">
                    <div class="event-main-img mb-3">
                     @if (!empty($news->video_link))
                           <a href="{{ asset($news->video_link) }}" class="glightbox">
                              <img src="{{ asset($news->single_page_image) }}" alt="News Main Image">
                              <img class="play-icon" src="{{ asset('front/assets/img/play-icon.png') }}" alt="Play Icon">
                           </a>
                        @else
                           <img src="{{ asset($news->single_page_image) }}" alt="News Main Image">
                        @endif
                    </div>
                    <div class="update-header">
                        <div class="heading mb-4">
                            {{ $news->title }}
                        </div>
                        <div class="heading-sm date mb-3">{{ App\Helper::formatTimestampToDateString($news->date) }} |
                            Read Time</div>
                        <div class="share-links d-flex gap-3 fs-2 mb-5">
                            <a id="copyBtn" href="#" class="position-relative text-decoration-none">
                                <i class="bi bi-link-45deg"></i>
                                <span id="copiedText"
                                    class="position-absolute bottom-0 start-0 d-none border-gray-100 bg-transparent text-gray-700 rounded-1">
                                    Copied!
                                </span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank"
                                rel="noopener noreferrer">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a
                                href="mailto:?subject={{ urlencode($news->title) }}&body={{urlencode(url()->current())}}">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                    <p class="para-wrap my-3">
                        {!! $news->text !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="second-col">
                    <div class="recent-event ">
                        <div class="heading mb-4">Recent News</div>
                        @foreach ($latestNews as $news)
                            <div class="event-card mb-4">
                                <div class="img-wrapper">
                                    <img src="{{ asset($news->image) }}" alt="event Image">
                                </div>
                                <div class="body">
                                    <div class="heading-md "><a href="{{ route('news.single', $news->slug) }}">{{ $news->title }}</a></div>
                                    <div class="date">{{ App\Helper::formatTimestampToDateString($news->date) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
