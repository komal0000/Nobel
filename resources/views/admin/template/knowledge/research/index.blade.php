<section id="case-studies" data-content="Research">
    <div class="main-container">
        <div class="heading text-center mb-4">Researches</div>
        <div class="filters">
            <div class="select-field">
                <div class="default-select d-flex" id="default-select">
                    <span class="default-item text-truncate">All</span>
                    <span class="anchor-down-btn"></span>
                </div>
                <div class="select-wrap" id="select-wrap">
                    <ul class="select-list" id="select-list">
                        <li data-target="All">All</li>

                        @foreach ($researchTypes as $type)
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
                @foreach ($researchTypes as $type)
                    @php
                        $researches = App\Models\Blog::where('blog_category_id', $type->id)->get();
                    @endphp
                    @foreach ($researches as $research)
                        <div class="col-xl-4 col-md-6 case-study-item" data-content="{{ Str::slug($type->title) }}">
                            <div class="slide m-3">
                                <a href="{{ route('knowledge.research.single', ['slug' => $research->slug]) }}">
                                    <div class="img-wrapper">
                                        <img src="{{ asset($research->image) }}" alt="Service Image"
                                            class="img-fluid w-100">
                                        <div class="heading-xs date">
                                            {{ App\Helper::formatTimestampToDateString($research->date) }}</div>
                                    </div>
                                </a>
                                <div class="body">
                                    <div class="para-wrap">Research</div>
                                    <a href="{{ route('knowledge.research.single', ['slug' => $research->slug]) }}">
                                        <h3 class="title heading-sm">{{ $research->title }}</h3>
                                    </a>
                                    @if ($research->submitted_by)
                                        <div class="name-post">
                                            <span class="name">
                                                Dr {{ $research->submitted_by }}
                                            </span>
                                            <br>
                                            <span class="post">{{ $research->position }}</span>
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

<section id="research-committee">
    <div class="main-container">
        <div class="heading text-center mb-4">Research Committee</div>

        <div class="committee-grid">
            @foreach ($researchCommittee as $item)
                <div class="committee-card">
                    <div class="committee-avatar">
                        @if(!empty($item->icon))
                            <img src="{{ asset($item->icon) }}" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('front/assets/img/default-avatar.png') }}" alt="{{ $item->name }}">
                        @endif
                    </div>
                    <div class="committee-name">{{ $item->name }}</div>
                    <div class="committee-post">{{ $item->post }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
