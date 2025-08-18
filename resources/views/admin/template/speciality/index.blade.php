<section id="all-specialities" data-content="All Specialities">
    <div class="main-container">
        <div class="heading-group mb-4">
            <div class="heading text-center mb-2">
                All {{$specialityLabel['specialityPlural'] ?? 'Specialities'}}
            </div>
            <div class="floating">
                <input type="text" id="search-speciality" name="searchSpeciality" class="form-control"
                    placeholder="Search">
                <div class="search-icon"><i class="bi bi-search"></i></div>
            </div>
        </div>
        <div class="specialities-cards">
            <div class="row">
                @foreach ($specialities as $speciality)
                    <div class="card-col col-lg-3 col-md-6 col-sm-6 p-2">
                        <div class="each-card">
                            <div class="img-wrapper">
                                <img src="{{ asset($speciality->icon) }}" alt="{{ $speciality->title }}">
                            </div>
                            <div class="heading-sm">
                                {{ $speciality->title }}
                            </div>
                            <div class="button d-flex justify-content-center">
                                <x-hoverBtn href="{{ route('speciality.single', $speciality->slug) }}"
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
