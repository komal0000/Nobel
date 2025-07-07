<section id="event-list" data-content="News List">
    <div class="main-container">
        <div class="heading text-center mb-4">{{ $newsType->title }}</div>
        <div class="filters">
            <div class="search-field">
                <input type="text" class="form-control rounded-5" placeholder="Search by Topic" id="search-input">
                <i class="bi bi-search"></i>
            </div>
        </div>
        <div class="event-content">
            <div class="row g-2" id="event-cards">
                @php
                    $events = App\Models\Blog::where('blog_category_id', $newsType->id)->get();
                @endphp
                @foreach ($events as $item)
                    <div class="col-xl-4 col-md-6 case-study-item">
                        <div class="slide m-3">
                            <div class="img-wrapper">
                                <img src="{{ asset($item->image) }}" alt="News Image" class="img-fluid">
                                <div class="heading-xs date">{{ \App\Helper::formatTimestampToDateString($item->date) }}
                                </div>
                            </div>
                            <div class="body">
                                <h3 class="title heading-sm mb-2">{{ $item->title }}</h3>
                                <div class="para-wrap location mb-2"><i class="bi bi-geo-alt-fill"></i>
                                    {{ $item->location }}
                                </div>
                                <div class="d-flex justify-content-between know-btn">
                                    <x-hoverBtn href="{{ route('news.single', ['slug' => $item->slug]) }}">View
                                        Details</x-hoverBtn>
                                </div>
                            </div>
                        </div>
                    </div>
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
