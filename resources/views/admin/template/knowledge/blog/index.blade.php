<div id="blogs" class="border-bottom pb-5">
    <section id="all-blogs">
        <div class="main-container">
            <div class="heading mb-4">Featured Blogs</div>
            <div class="row g-4">
                @foreach ($featuredBlogs as $blog)
                    <div class="col-md-6 col-xl-3 all-blog-card">
                        @php
                            $blogType = App\Models\BlogCategory::where('id', $blog->blog_category_id)->first();
                        @endphp
                        <div class="blog-card ">
                            <div class="img-wrapper">
                                <img src="{{ Storage::url($blog->image) }}" alt="Blog Title">
                            </div>
                            <div class="body">
                                <div class="type para-wrap mb-3">{{ $blogType->title }}</div>
                                <div class="heading-md blog-title mb-3">
                                    {{ $blog->title }}
                                </div>
                                <div class="date-name para-wrap">
                                    <span
                                        class="date">{{ App\Helper::formatTimestampToDateString($blog->date) }}</span>
                                    <span class="name">Dr Name</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="btn-container d-flex justify-content-center">
            <button id="load-more-featured" class="load-more heading-xs">Load More</button>
        </div>
    </section>
    <section id="all-blogs">
        <div class="main-container">
            <div class="heading-group mb-4">
                <div class="heading mb-2">All Blogs</div>
                <div class="floating">
                    <input type="text" id="search-all-blogs" name="allBlogs" class="form-control"
                        placeholder="Search All Blogs">
                    <div class="search-icon"><i class="bi bi-search"></i></div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($indexBlogs as $blog)
                    <div class="col-md-6 col-xl-3 all-blog-card">
                        @php
                            $blogType = App\Models\BlogCategory::where('id', $blog->blog_category_id)->first();
                        @endphp
                        <div class="blog-card ">
                            <div class="img-wrapper">
                                <img src="{{ Storage::url($blog->image) }}" alt="Blog Title">
                            </div>
                            <div class="body">
                                <div class="type para-wrap mb-3">{{ $blogType->title }}</div>
                                <div class="heading-md blog-title mb-3">
                                    {{ $blog->title }}
                                </div>
                                <div class="date-name para-wrap">
                                    <span
                                        class="date">{{ App\Helper::formatTimestampToDateString($blog->date) }}</span>
                                    <span class="name">Dr Name</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="btn-container d-flex justify-content-center">
            <button id="load-more-all" class="load-more heading-xs">Load More</button>
        </div>
    </section>
</div>
