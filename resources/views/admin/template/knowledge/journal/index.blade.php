<section id="case-studies" data-content="Journal">
    <div class="main-container">
        <div class="heading text-center mb-4">Journals</div>
        <div class="filters">
            <div class="select-field">
                <div class="default-select d-flex" id="default-select">
                    <span class="default-item text-truncate">All</span>
                    <span class="anchor-down-btn"></span>
                </div>
                <div class="select-wrap" id="select-wrap">
                    <ul class="select-list" id="select-list">
                        <li data-target="All">All</li>

                        @foreach ($journalTypes as $type)
                            <li data-target="{{ Str::slug($type->title) }}">{{ $type->title }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="find-case-study" id="find-case-study-input">
                </div>
            </div>
            <div class="search-field">
                <input type="text" class="form-control rounded-5" placeholder="Search by Topic" id="search-input">
                <i class="bi bi-search"></i>
            </div>
        </div>
        <div class="case-study-content">
            <div class="row g-2" id="case-study-list">
                @foreach ($journalTypes as $type)
                    @php
                        $journals = App\Models\Blog::where('blog_category_id', $type->id)->get();
                    @endphp
                    @foreach ($journals as $journal)
                        <div class="col-xl-4 col-md-6 case-study-item" data-content="{{ Str::slug($type->title) }}">
                            <div class="slide m-3">
                                <a href="{{ route('knowledge.journal.single', ['slug' => $journal->slug]) }}">
                                    <div class="img-wrapper">
                                        <img src="{{ asset($journal->image) }}" alt="Service Image"
                                            class="img-fluid w-100">
                                        <div class="heading-xs date">
                                            {{ App\Helper::formatTimestampToDateString($journal->date) }}</div>
                                    </div>
                                </a>
                                <div class="body">
                                    <div class="para-wrap">{{$type->title}}</div>
                                    <a href="{{ route('knowledge.journal.single', ['slug' => $journal->slug]) }}">
                                        <h3 class="title heading-sm">{{ $journal->title }}</h3>
                                    </a>
                                    @if ($journal->submitted_by)
                                        <div class="name-post">
                                            <span class="name">
                                                Dr {{ $journal->submitted_by }}
                                            </span>
                                            <br>
                                            <span class="post">{{ $journal->position }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="pagination-container d-flex justify-content-center mt-4">
            <button id="prevPage" class="left-arrow mx-4"><img src="{{ asset('front/assets/img/vector-left.png') }}"
                    alt="Left Arrow"></button>
            <div id="paginationButtons" class="d-flex"></div>
            <button id="nextPage" class="right-arrow mx-4"><img src="{{ asset('front/assets/img/vector-right.png') }}"
                    alt="Right Arrow"></button>
        </div>
    </div>
</section>
