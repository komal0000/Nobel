<section id="downloads">
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
                    @foreach ($downloads as $download )
                    @php
                        $type_name = App\Model\DownloadType::where('id', $download->type_id)->first(['title']);
                    @endphp
                    <div class="col-md-6 col-xl-4" data-content="{{ $type_name->title }}">
                        <div class="download-card" data-bs-target="#disease-modal">
                            <div class="img-wrapper">
                                <img src="{{ Storage::url($download->pdf) }}" alt="Service Image"
                                    class="w-100 img-fluid">
                                <div class="logo d-flex justify-content-between">
                                    <a class="" href="#" target="_blank">
                                        <i class="bi bi-file-earmark"></i>
                                    </a>
                                    <div class="end d-flex gap-3">
                                        <a class="" href="#">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a class="" href="#">
                                            <i class="bi bi-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <h3 class="title heading-sm mb-2">{{ $i }}{{ $i }} for
                                    info-graphics Title</h3>
                                <div class="para-wrap date">12/12/2081</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
