<section id="per-case-study" data-content="Journal">
    <div class="main-container">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="case-study">
                    <div class="case-study-main-img mb-3">
                        @if (!empty($journal->video_link))
                            <a href="{{ asset($journal->video_link) }}" class="glightbox">
                                <img src="{{ asset($journal->single_page_image) }}" alt="Journal Main Image">
                                <img class="play-icon" src="{{ asset('front/assets/img/play-icon.png') }}"
                                    alt="Play Icon">
                            </a>
                        @else
                            <img src="{{ asset($journal->single_page_image) }}" alt="Notice Main Image">
                        @endif
                    </div>
                    <div class="case-study-header">
                        <div class="heading mb-4">
                            {{ $journal->title }}
                        </div>
                        <div class="heading-sm mb-1">
                            @if ($journal->submitted_by)
                                By <strong>{{ $journal->submitted_by }}</strong>
                            @endif
                        </div>
                        <div class="heading-sm date mb-3">{{ App\Helper::formatTimestampToDateString($journal->date) }}
                        </div>
                        <div class="share-links d-flex gap-3 fs-2 mb-4">
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
                                href="mailto:?subject={{ urlencode($journal->title) }}&body={{ urlencode(url()->current()) }}">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                    <div class="case-study-content">
                        <p class="para-wrap my-3">
                            {!! $journal->text !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="second-col">
                    <div class="recent-case-study ">
                        <div class="heading mb-4">Recent Journals</div>
                        @foreach ($latestJournal as $caseItem)
                            <div class="case-study-card mb-4">
                                <div class="img-wrapper">
                                    <img src="{{ asset($caseItem->image) }}" alt="case-study Image">
                                </div>
                                <div class="body">
                                    <div class="heading-md "><a
                                            href="{{ route('knowledge.journal.single', $caseItem->slug) }}">{{ $caseItem->title }}</a>
                                    </div>
                                    <div class="date">{{ App\Helper::formatTimestampToDateString($caseItem->date) }}
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
