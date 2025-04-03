<section id="job-career">
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
                        <li data-target="no-result">For No Result</li>
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
                            <x-hoverBtn>Apply</x-hoverBtn>
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
<section id="job-bottom-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/jobs/banner.jpg') }}" width="1920"
            height="500">
        <source media="(min-width: 320px)" srcset="{{ asset('front/assets/img/jobs/banner-md.jpg') }}" width="480"
            height="320">
        <img srcset="{{ asset('front/assets/img/jobs/banner.jpg') }}" width="1920" height="500">
    </picture>
    <div class="banner-desc">
        <div class="banner-title">Not Sure Where you fit in?</div>
        <button class="resume-btn" data-bs-toggle="modal" data-bs-target="#resumeModal">Submit your Resume</button>
    </div>
</section>
<div class="modal fade" id="resumeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content p-4">
            <div class="modal-header p-0 pb-3 border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Full Name *"
                                required>
                            <label for="name">Full Name *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone Number *"
                                required>
                            <label for="phoneNumber">Phone Number *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email Address *"
                                required>
                            <label for="email">Email
                                Address *</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="location" placeholder="Location*" required>
                            <label for="location">Location *</label>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="resumeFile">Upload File (accepted only pdf, docx) *</label>
                        <input type="file" name="resumeFile" class="form-control" accept=".pdf,.docx" required>
                    </div>
                    <div class="col-md-6">
                        <div class="submit-btn">
                            <button id="submit-resume">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
