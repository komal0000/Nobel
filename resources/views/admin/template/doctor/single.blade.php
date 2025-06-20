<section id="dr-banner">
    <div class="main-container">
        <div class="content-wrapper d-flex flex-column flex-lg-row justify-content-center">
            <div class="img-container">
                <img src="{{ asset($doctor->image) }}" alt="Doctor Image">
            </div>
            <div class="details align-self-center position-relative z-10">
                <h4 class="name">Dr. {{ $doctor->title }}</h4>
                <p class="post">{{ $doctor->position }}</p>
                <p>
                    @if (!empty(json_decode($doctor->qualification, true)))
                        {{ json_decode($doctor->qualification, true)[0] ?? '' }}
                    @endif
                </p>
                <p class="location"><i class="bi bi-geo-alt">{{ $doctor->location }}</i></p>

            </div>

        </div>
    </div>
</section>
<section id="dr-about" data-content="About" class="position-relative z-10 bg-white">
    <div class="main-container">
        <div class="heading mb-4">About {{ $doctor->title }}</div>
        <div class="para-wrap">
            {{$doctor->short_description}}
        </div>
    </div>
</section>
<section id="dr-specialization" data-content="Specialization">
    <div class="main-container">
        <x-sliderComponent mainClass="drSpecialSlider" heading="Specialization & Expertise">
            @foreach ($doctorSpecialities as $doctorSpeciality)
                @php
                    $speciality = App\Models\Speciality::where('id', $doctorSpeciality->speciality_id)->first();
                @endphp
                <div class="each-card">
                    <a>
                        <div class="img-wrapper d-flex justify-content-center">
                            <img src="{{ asset($speciality->icon) }}" alt="Treatment Image">
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
<section id="dr-milestone" data-content="Milestone">
    <div class="main-container">
        <x-sliderComponent heading="Milestone Achieved" mainClass="milestoneSlider">
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
