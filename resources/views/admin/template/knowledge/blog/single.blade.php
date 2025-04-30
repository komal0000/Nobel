<section id="per-blog">
    <div class="main-container">
        <div class="row g-5">
            <div class="col-lg-9">
                <div class="blog">
                    <div class="blog-header">
                        <div class="heading mb-4">
                            {{$blog->title}}
                        </div>
                        <div class="heading-sm mb-1">
                            By <strong>{{$blog->submitted_by}}</strong>
                        </div>
                        <div class="heading-sm date mb-3">{{ App\Helper::formatTimestampToDateString($blog->date) }}</div>
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
                        <div class="blog-main-img mb-3">
                            <img src="{{ asset($blog->image) }}" alt="Blog Image">
                        </div>
                    </div>
                    {{-- <div class="blog-content">
                        <h3 class="table-count-title">TABLE OF CONTENTS</h3>
                        <ol class="toc">
                            <li>
                                <a href="#to-scroll-1">First One</a>
                            </li>
                            <li>
                                <a href="#to-scroll-2">second One</a>
                            </li>
                            <li>
                                <a href="#to-scroll-3">third One</a>
                            </li>
                        </ol>
                    </div>
                    <p class="para-wrap my-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, assumenda quidem. Molestiae,
                        rem
                        reprehenderit sint, assumenda libero illum omnis ea non laborum distinctio aspernatur molestias
                        dolorem dolor eligendi. Repellendus corporis minima ipsa ipsam, molestiae consequuntur mollitia
                        aperiam architecto atque culpa doloribus temporibus tempora eaque laudantium libero dolor eos!
                        Sit,
                        explicabo.
                    </p>
                    <div id="to-scroll-1">
                        <h2>testing heading</h2>
                        <p>testing para Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, amet aut
                            deleniti
                            aliquam neque distinctio asperiores earum nisi fugit assumenda.</p>
                    </div>
                    <div id="to-scroll-2">
                        <h2>testing heading</h2>
                        <p>testing para Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, amet aut
                            deleniti
                            aliquam neque distinctio asperiores earum nisi fugit assumenda.</p>
                    </div>
                    <div id="to-scroll-3">
                        <h2>testing heading</h2>
                        <p>testing para Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente, amet aut
                            deleniti
                            aliquam neque distinctio asperiores earum nisi fugit assumenda.</p>
                    </div>
                    <div class="author-profile">
                        <div class="author-img">
                            <img src="{{ asset('front/img/speciality/chairman.png') }}" alt="Author Image">
                        </div>
                        <div class="author-desc">
                            <div class="heading-sm">Author Name</div>
                            <div class="para-wrap mb-3">Speciality</div>
                            <a href="/doctor-profile">View Profile</a>
                        </div>
                    </div> --}}
                    <p>
                        {!! $blog->text !!}
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
                                <input type="text" name="mobileNumber" placeholder="Enter Your Phone Number" required>
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
                    <div class="recent-blog ">
                        <div class="heading mb-4">Recent Blog</div>
                        @foreach ($latestBlog as $latest)
                            <div class="blog-card mb-4">
                                <div class="img-wrapper">
                                    <img src="{{ asset($latest->image) }}"
                                        alt="Blog Image">
                                </div>
                                <div class="body">
                                    <div class="heading-md "><a href="{{ route('knowledge.blog.single', ['slug'=> $latest->slug]) }}">{{$latest->title}}</a></div>
                                    <div class="date">{{ App\Helper::formatTimestampToDateString($latest->date) }}</div>
                                </div>
                            </div>

                        @endforeach
                </div>
            </div>
        </div>
    </div>
</section>