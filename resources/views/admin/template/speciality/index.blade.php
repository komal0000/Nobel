<section id="all-specialities" data-content="All Specialities">
    <div class="main-container">
        <div class="heading text-center mb-4">
            All Specialities
        </div>
        <div class="specialities-cards">
            <div class="row">
                @foreach ($specialities as $speciality)
                    <div class="card-col col-lg-3 col-md-6 col-sm-6 p-2">
                        <div class="each-card">
                            <div class="img-wrapper">
                                <img src="{{ Storage::url($speciality->icon) }}" alt="{{ $speciality->title }}">
                            </div>
                            <div class="heading-sm">
                                {{ $speciality->title }}
                            </div>
                            <div class="button d-flex justify-content-center">
                                <x-hoverBtn href="{{ route('speciality.single', ['speciality_id' => $speciality->id]) }}"
                                    class="btn">Know More</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="btn-container d-flex justify-content-center mt-3">
            <button id="load-more" class=" heading-xs">Load More</button>
        </div>
    </div>
</section>
