<section id="per-blog">
    <div class="main-container">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="blog">
                    <div class="blog-header">
                        <div class="heading mb-4">
                            {{ $blog->title }}
                        </div>
                        <div class="heading-sm mb-1">
                            By <strong>{{ $blog->submitted_by }}</strong>
                        </div>
                        <div class="heading-sm date mb-3">{{ App\Helper::formatTimestampToDateString($blog->date) }}
                        </div>
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
                                href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode(url()->current()) }}">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                        <div class="blog-main-img mb-3">
                            @if (!empty($blog->video_link))
                                <a href="{{ asset($blog->video_link) }}" class="glightbox">
                                    <img src="{{ asset($blog->single_page_image) }}" alt="Event Main Image">
                                    <img class="play-icon" src="{{ asset('front/assets/img/play-icon.png') }}"
                                        alt="Play Icon">
                                </a>
                            @else
                                <img src="{{ asset($blog->single_page_image) }}" alt="Event Main Image">
                            @endif
                        </div>
                    </div>
                    <p>
                        {!! $blog->text !!}
                    </p>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="second-col">
                    <div class="recent-blog ">
                        <div class="heading mb-4">Recent Blogs</div>
                        @foreach ($latestBlog as $latest)
                            <div class="blog-card mb-4">
                                <div class="img-wrapper">
                                    <img src="{{ asset($latest->image) }}" alt="Blog Image">
                                </div>
                                <div class="body">
                                    <div class="heading-md "><a
                                            href="{{ route('knowledge.blog.single', ['slug' => $latest->slug]) }}">{{ $latest->title }}</a>
                                    </div>
                                    <div class="date">{{ App\Helper::formatTimestampToDateString($latest->date) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</section>
