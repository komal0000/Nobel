<section id="downloads" data-content="Downloads">
    <div class="main-container">
        <div class="tabs-container mb-4">
            <button class="tab active">All</button>
            @foreach ($downloadMainType as $type)
                <button class="tab" data-target="{{ $type->title }}">{{ $type->title }}</button>
            @endforeach
        </div>
        <div class="row content-row">
            <div class="col-md-4 filter-desktop">
                <div class="form-floating mb-4">
                    <input type="text" name="name" class="form-control" placeholder="Search">
                    <label for="name">Search</label>
                    <div class="search-icon"><i class="bi bi-search"></i></div>
                </div>
                <div class="filter-list">
                    <ul>

                    </ul>
                </div>
            </div>
            <div class="col-md-8 content-col">
                <div class="row g-3 card-row">
                    @foreach ($downloads as $download)
                        @php
    $type = App\Models\DownloadCategory::where('id', $download->download_category_id)->first(['title']);
                        @endphp
                        <div class="col-md-6 col-xl-4" data-content="{{ $type->title }}">
                            <div class="download-card p-4">
                                <h3 class="title heading-sm mb-4">{{ $download->title }}</h3>
                                <div class="date-download d-flex justify-content-between">
                                    <div class="para-wrap date">{{ $download->uploaded_date }}</div>
                                    <a class="z-1" href="{{ asset($download->link) }}">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
