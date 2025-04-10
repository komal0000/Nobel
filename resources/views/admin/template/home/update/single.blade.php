<section id="each-update" data-content="Update">
    <div class="main-container">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="single-update">
                    <div class="event-main-img mb-3">
                        <img src="{{ Storage::url($update->single_page_image) }}" alt="Staff">
                    </div>
                    <div class="update-header">
                        <div class="heading mb-4">
                            {{ $update->title }}
                        </div>
                        <div class="heading-sm date mb-3">{{ App\Helper::formatTimestampToDateString($update->date) }} |
                            Read Time</div>
                        <div class="share-links d-flex gap-3 fs-2 mb-5">
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
                    <p class="para-wrap my-3">
                        {!! $update->text !!}
                    </p>
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
                    <div class="recent-event ">
                        <div class="heading mb-4">Recent Updates</div>
                        @foreach ($latestUpdate as $update)
                            <div class="event-card mb-4">
                                <div class="img-wrapper">
                                    <img src="{{ Storage::url($update->image) }}" alt="event Image">
                                </div>
                                <div class="body">
                                    <div class="heading-md "><a href="/each-event">{{ $update->title }}</a></div>
                                    <div class="date">{{ App\Helper::formatTimestampToDateString($update->date) }}
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
