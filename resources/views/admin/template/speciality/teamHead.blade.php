@php
    $doctor = \App\Models\Doctor::where('id', $teamHead->doctor_id)->first();
@endphp
<section class="message">
    <div class="main-container">
        <div class="content d-flex flex-xl-row flex-column">
            <div class="para align-self-center fst-italic">
                {{ $doctor->short_description }}
            </div>
            <div class="img-block align-self-center text-center">
                <img src="{{ Storage::url($doctor->image) }}" alt="Chairman Image">
            </div>
            <div class="detail align-self-center text-center">
                <div class="heading-lg name">
                    Dr. {{ $doctor->title }}
                </div>
                <div class="heading-sm role">
                    {{ $doctor->position }}
                </div>
            </div>
        </div>
    </div>
</section>
