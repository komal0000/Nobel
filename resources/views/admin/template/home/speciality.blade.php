<div class="sp-wrapper">
    @foreach ($specialities->take(5) as $speciality)
        <a href="{{ route('speciality.single', $speciality->slug) }}">
            <div class="speciality-row">
                <img src="{{ asset($speciality->icon) }}" alt="Heart">
                <span>
                    {{ $speciality->title }}
                </span>
            </div> <i class="bi bi-chevron-right"></i>
        </a>
        <hr>
    @endforeach
</div>
