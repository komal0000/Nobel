<section id="all-videos" data-content="All Videos">
    <div class="main-container">
        <div class="heading-group mb-4 d-flex justify-content-center flex-wrap gap-3">
            <div class="select-field">
                <div class="default-select d-flex" id="default-select">
                    <span class="default-item text-truncate">All</span>
                    <span class="anchor-down-btn" style="border-color: #000"></span>
                </div>
                <div class="select-wrap" id="select-wrap">
                    <ul class="select-list" id="select-list">
                        <li>All</li>
                        @foreach ($academicProgramTypes as $type)
                            <li data-value="{{ trim($type->title) }}">{{ $type->title }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="find-doc-speciality" id="find-doc-speciality-input">
                </div>
            </div>
            <div class="floating">
                <input type="text" id="search-all-video" name="allVideo" class="form-control"
                    placeholder="Search All Videos">
                <div class="search-icon"><i class="bi bi-search"></i></div>
            </div>
        </div>
        <div class="row g-4">
            @foreach ($academicProgramTypes as $type)
                @php
                    $academicPrograms = App\Models\Blog::where('blog_category_id', $type->id)->get();
                @endphp
                @foreach ($academicPrograms as $academicProgram)
                    <a class="col-md-4 col-lg-3"
                        href="{{ route('academicprogram.single', ['slug' => $academicProgram->slug]) }}">
                        <div class="col-md-6 col-xl-4 all-card" data-content="{{ trim($type->title) }}">
                            <div class="each-card">
                                <div class="img-wrapper">
                                    <img src="{{ asset($academicProgram->image) }}" alt="Thumbnail" class="img-fluid">
                                </div>
                                <div class="body">
                                    <div class="heading-sm">
                                        {{ $academicProgram->title }}
                                    </div>
                                    <div class="para-wrap">
                                        {{ $academicProgram->short_description }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="btn-container d-flex justify-content-center">
        <button id="load-more-all" class="load-more heading-xs">Load More</button>
    </div>
</section>
