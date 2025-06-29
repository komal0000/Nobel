<section id="job-career" data-content="Jobs">
    <div class="main-container">
        <div class="heading mb-3">
            Join Our Team
        </div>
        <div class="para-wrap mb-3">
            We are committed to building a team that represents the diverse communities we serve, and we believe that
            our differences make us stronger. If you are looking for a rewarding career where you can make a meaningful
            impact, we encourage you to explore our current openings and consider joining our team.
        </div>
        <div class="filters mb-4">
            <div class="select-field">
                <div class="default-select d-flex" id="default-select">
                    <span class="default-item text-truncate">All</span>
                    <span class="anchor-down-btn"></span>
                </div>
                <div class="select-wrap" id="select-wrap">
                    <ul class="select-list" id="select-list">
                        <li data-target="all">All</li>
                        @foreach ($jobcategories as $category)
                            <li data-target="{{ $category->title }}">{{ $category->title }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="find-job" id="find-job-input">
                </div>
            </div>
        </div>
        <div class="job-list">
            @foreach ($jobcategories as $category)
                @php
                    $jobs = App\Models\Job::where('job_category_id', $category->id)->get();
                @endphp
                @foreach ($jobs as $job)
                    <div class="job" data-content="{{ $category->title }}">
                        <div class="desc">
                            <div class="heading-sm mb-2">{{ $job->title }}</div>
                            <div class="category-type mb-1 para-wrap">
                                <div class="category">Category: <strong>{{ $category->title }}</strong></div>
                                <div class="type">
                                    Type: <strong>{{ $job->type }}</strong>
                                </div>
                            </div>
                            <div class="date">
                                <i class="bi bi-calendar"></i> :
                                <strong>{{ \App\Helper::formatTimestampToDateString($job->date) }}</strong>
                            </div>
                        </div>
                        <div class="apply-btn">
                            <x-hoverBtn href="{{ route('jobs.jobDetail.jobDetail', ['slug' => $job->slug]) }}">Apply</x-hoverBtn>
                        </div>
                    </div>
                @endforeach
            @endforeach
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
