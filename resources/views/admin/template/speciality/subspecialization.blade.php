<section class="sub">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Know More About Sub-Specialization
        </div>
        <div class="sub-slider">
            @php
                $subSpecialties = App\Models\Speciality::where('parent_speciality_id', $speciality->id)->get();
            @endphp

            @foreach($subSpecialties as $subSpecialty)
                <div class="sub-card">
                    <div class="img-wrapper">
                        <img src="{{ Storage::url($subSpecialty->icon) }}" alt="{{ $subSpecialty->title }}">
                    </div>
                    <div class="heading-sm">
                        {{ $subSpecialty->title }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
