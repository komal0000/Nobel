<section id="news-letter">
    <div class="main-container">
        <div class="heading mb-4">
            News Letters
        </div>
        <div class="row letter-row g-5">
            <div class="col-md-4">
                <div class="custom-tabs heading-xs">
                    <ul>
                        @foreach ($newsLetterTypes as $type)
                            <li class="{{ $loop->first ? 'active' : '' }}">
                                <a href="#" data-title="{{ Str::slug($type->title) }}">{{ $type->title }} <i
                                        class="bi bi-chevron-right"></i></a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
            @foreach ($newsLetterTypes as $type)
                @php
                    $newsLetters = App\Models\Blog::where('blog_category_id', $type->id)->get();
                @endphp
                <div class="col-md-8 {{ $loop->first ? 'active' : '' }}" data-content="{{ Str::slug($type->title) }}">
                    <div class="row">
                        @foreach ($newsLetters as $letter)
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="letter-card">
                                    <div class="download">
                                        <a href="{{ Storage::url($letter->image) }}" target="_blank">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                    <div class="heading-group">
                                        <div class="title">
                                            {{ $type->title }}
                                        </div>
                                        <div class="para">{{ $letter->title }}</div>
                                        <div class="date mt-2">
                                            {{ \App\Helper::getMonthYear($letter->date) }}
                                        </div>
                                    </div>
                                    <div class="logo">
                                        <img src="{{ asset('front/assets/img/Nobel.png') }}" alt="Hospital Logo">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="pagination-container d-flex justify-content-center mt-4">
                <button id="prevPage" class="left-arrow mx-4"><img
                        src="{{ asset('front/assets/img/vector-left.png') }}" alt="Left Arrow"></button>
                <div id="paginationButtons" class="d-flex"></div>
                <button id="nextPage" class="right-arrow mx-4"><img
                        src="{{ asset('front/assets/img/vector-right.png') }}" alt="Right Arrow"></button>
            </div>
        </div>
    </div>
</section>
