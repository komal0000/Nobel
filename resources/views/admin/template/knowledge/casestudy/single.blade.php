<section id="per-case-study" data-content="Case Study">
    <div class="main-container">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="case-study">
                    <div class="case-study-main-img mb-3">
                        <img src="{{ Storage::url($case->image) }}" alt="case-study Image">
                    </div>
                    <div class="case-study-header">
                        <div class="heading mb-4">
                            {{ $case->title }}
                        </div>
                        <div class="heading-sm mb-1">
                            By <strong>{{ $case->submitted_by }}</strong> in <strong>Speciality Name</strong>
                        </div>
                        <div class="heading-sm date mb-3">{{ App\Helper::formatTimestampToDateString($case->date) }}
                        </div>
                        <div class="share-links d-flex gap-3 fs-2 mb-4">
                            <a href="#">
                                <i class="bi bi-link-45deg"></i>
                            </a>
                            <a href="#">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="#">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <a href="#">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="#">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </div>
                    </div>
                    <div class="case-study-content">
                        <p class="para-wrap my-3">
                            {!! $case->text !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="second-col">
                    <div class="query-form mb-4">
                        <form action="">
                            <div class="heading-md">Query Form</div>
                            <div class="input-wrap">
                                <label for="name">Name *</label>
                                <input type="text" name="name" placeholder="Enter Your Name" required>
                            </div>
                            <div class="input-wrap">
                                <label for="mobileNumber">Mobile Number *</label>
                                <input type="text" name="mobileNumber" placeholder="Enter Your Phone Number"
                                    required>
                            </div>
                            <div class="input-wrap">
                                <label for="email">Email Address</label>
                                <input type="text" name="email" placeholder="Enter Your E-mail">
                            </div>
                            <div class="btn-wrap w-100">
                                <button>Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="recent-case-study ">
                        <div class="heading mb-4">Recent case-study</div>
                        @foreach ($latestCase as $caseItem)
                            <div class="case-study-card mb-4">
                                <div class="img-wrapper">
                                    <img src="{{ Storage::url($caseItem->image) }}" alt="case-study Image">
                                </div>
                                <div class="body">
                                    <div class="heading-md "><a href="/single-case-study">{{ $caseItem->title }}</a>
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
