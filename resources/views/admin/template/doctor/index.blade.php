<section id="listing-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/doctor-listing/banner.jpg') }}"
            width="1920" height="500" alt="Medical Experts">
        <source media="(min-width: 320px)" srcset="{{ asset('front/assets/img/doctor-listing/banner-md.jpg') }}"
            width="480" height="320" alt="Medical Experts">
        <img src="https://medanta.s3.ap-south-1.amazonaws.com/banners/October2023/u6JyySMlXNGHQESP34oHfVViZp7IJc-metaRG9jdG9yLUxpc3RpbmcuanBn-.jpg"
            class="img-fluid w-100" alt="Medical Experts">
    </picture>
    <div class="banner-title">Medical Experts</div>
</section>
<section id="doctor-list" data-content="Doctor List">
    <div class="main-container">
        <div class="filter d-flex justify-content-start">
            <div class="select-field">
                <div class="default-select d-flex" id="default-select">
                    <span class="default-item text-truncate">All Specialities</span>
                    <span class="anchor-down-btn" style="border-color: #000"></span>
                </div>
                <div class="select-wrap" id="select-wrap">
                    <ul class="select-list" id="select-list">
                        <li data-target="all">All Specialities</li>
                        @foreach ($specialties as $specialty)
                            <li>{{ $specialty->title }}</li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="find-doc-speciality" id="find-doc-speciality-input">
                </div>
            </div>
        </div>
        <div class="list mt-4 mb-2">
            <div class="row">
                @foreach ($doctors as $doctor)
                    <div class="col-md-6 col-xl-4 doctor-card-col">
                        <div class="doctor-card">
                            <div class="header">
                                <div class="doc-img">
                                    <img src="{{ Storage::url($doctor->image) }}" alt="Doctor Image">
                                </div>
                                <div class="doc-desc">
                                    <button class="share-btn">
                                        <i class="bi bi-share"></i>
                                    </button>
                                    <div class="heading-sm">
                                        Dr. {{ $doctor->title }}
                                    </div>
                                    <div class="post">
                                        {{ $doctor->position }}
                                    </div>
                                    <div class="doc-specialization">
                                        <span>Specialization Name</span>
                                        <a href="/doctor-profile">View Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="tabs d-flex justify-content-evenly">
                                    <button class="tab active">SPECIALIZATION</button>
                                    <button class="tab">QUALIFICATION</button>
                                </div>
                                <div class="tab-container">
                                    <div class="tab-panel for-specialization active">
                                        <ul>
                                            @php
    $speciality = App\Models\DoctorSpeciality::where(
        'doctor_id',
        $doctor->id,
    )->get();
                                            @endphp
                                            @foreach ($speciality as $speciality)
                                                <li>
                                                    <span> <i class="bi bi-check2-circle"></i>
                                                        {{ $speciality->speciality_name }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-panel">
                                        <ul>
                                            @foreach (json_decode($doctor->qualification, true) as $qualification)
                                                @if (!empty($qualification))
                                                    <li>
                                                        <span><i class="bi bi-check2-circle"></i></span>
                                                        {{ $qualification }}
                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <a href="/doctor-profile" class="meet-doc">Meet The Doctor</a>
                        </div>
                    </div>
                @endforeach
            </div>
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
