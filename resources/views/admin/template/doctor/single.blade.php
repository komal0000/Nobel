<section id="dr-banner">
    <div class="main-container">
        <div class="content-wrapper d-flex flex-column flex-lg-row justify-content-center gap-4">
            <div class="img-container">
                <img src="{{ $doctor->image }}" alt="Doctor Image">
            </div>
            <div class="details align-self-center">
                <h4 class="name">Dr. {{ $doctor->title }}</h4>
                <p class="post"> Dr. {{ $doctor->post }}</p>
                <p>
                    @if (!empty(json_decode($doctor->qualification, true)))
                        {{ json_decode($doctor->qualification, true)[0] ?? '' }}
                    @endif
                </p>
                <p class="location"><i class="bi bi-geo-alt">{{ $doctor->location }}</i></p>
                <button class="share-btn" data-bs-toggle="modal" data-bs-target="#shareModal"><i
                        class="bi bi-share"></i> Share Doctor Profile</button>

                <div class="modal" id="shareModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="heading text-center mb-3">
                                    Share Profile Via
                                </div>
                                <div class="share-links d-flex justify-content-center gap-3 fs-2 mb-5">
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
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<section id="dr-about">
    <div class="main-container">
        <div class="heading mb-4">About {{ $doctor->title }}</div>
        <div class="para-wrap">
            {!! $doctor->text !!}
        </div>
    </div>
</section>
<section id="dr-specialization">
    <div class="main-container">
        <x-sliderComponent heading="Specialization & Expertise">
            @foreach ($doctorSpecialities as $doctorSpeciality)
                @php
                    $speciality = App\Models\Specialty::where('id', $doctorSpeciality->speciality_id)->first();
                @endphp
                <div class="each-card">
                    <a>
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ Storage::url($speciality->icon) }}" alt="Treatment Image">
                        </div>
                        <div class="body">
                            {{ $doctorSpeciality->speciality_name }}
                        </div>
                    </a>
                </div>
            @endforeach
        </x-sliderComponent>
    </div>
</section>
<section id="dr-milestone">
    <div class="main-container">
        <x-sliderComponent heading="Milestone Achieved">
            @foreach ($doctorMilestones as $milestone)
                <div class="each-card">
                    <i class="bi bi-check2-circle"></i>
                    <div class="heading-sm">{{ $milestone->description }}</div>
                    <div class="year">{{ $milestone->year }}</div>
                </div>
            @endforeach
        </x-sliderComponent>
    </div>
</section>
