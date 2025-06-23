<section id="sub" class="sub" data-content="Sub-Specialization">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Know More About Sub-Specialization
        </div>
        <div class="sub-slider">
            @php
                $subSpecialties = App\Models\Speciality::where('parent_speciality_id', $speciality->id)->get();
            @endphp

            @foreach ($subSpecialties as $subSpecialty)
                <div class="sub-card">
                    <a href="{{ $subSpecialty->slug }}">
                        <div class="img-wrapper">
                            <img src="{{ asset($subSpecialty->icon) }}" alt="{{ $subSpecialty->title }}">
                        </div>
                        <div class="heading-sm">
                            {{ $subSpecialty->title }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
