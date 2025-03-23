<div class="sp-wrapper">
    @foreach ($specialities as $speciality)
        <a href="#">
            <div class="speciality-row">
                <img src="{{ Storage::url($speciality->icon) }}" alt="Heart">
                <span>
                    {{ $speciality->title }}
                </span>
            </div> <i class="bi bi-chevron-right"></i>
        </a>
        <hr>
    @endforeach
</div>
