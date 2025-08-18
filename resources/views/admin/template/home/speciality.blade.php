<div class="sp-inner-heading">
    <h4 class="sp-subheading">{{$specialityLabel['specialityPlural'] ?? 'Specialities'}}</h4>
    <h2 class="sp-heading">An Ecosystem for Clinical Excellence</h2>
</div>
<div class="sp-inner-care  fw-bold">
    <div class="sp-wrapper">
        @foreach ($specialities->take(5) as $speciality)
            <a href="{{ route('speciality.single', $speciality->slug) }}">
                <div class="speciality-row">
                    <img src="{{ asset($speciality->icon) }}" alt="icon">
                    <span>
                        {{ $speciality->title }}
                    </span>
                </div> <i class="bi bi-chevron-right"></i>
            </a>
            <hr>
        @endforeach
    </div>
    <div class="hover-button">
        <x-hoverBtn class="hover-btn" href="{{ route('speciality.index') }}">
            View All {{ $specialityLabel['specialityPlural'] ?? 'Specialities' }}
        </x-hoverBtn>
    </div>
</div>
