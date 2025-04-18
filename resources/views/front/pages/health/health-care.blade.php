<section id="health-care" data-content="health-care">
    <div class="main-container">
        <div class="heading text-center mb-4">
            We're Here To Make Managing Your Healthcare Easier
        </div>
        <div class="desktop-card">
            <div class="row">
                <div class="col-3">
                    <img src="{{ asset('front/assets/img/health-library/health-library-1.jpg') }}" alt="Doctor">
                </div>
                <div class="col-3">
                    <div class="heading-sm mb-3">Our Doctors</div>
                    <x-hoverBtn href="{{ route('doctor.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
                <div class="col-3"> <img src="{{ asset('front/assets/img/health-library/health-library-2.jpg') }}"
                        alt="Doctor"></div>
                <div class="col-3">
                    <div class="heading-sm mb-3">
                        Our Specialities
                    </div>
                    <x-hoverBtn href="{{ route('speciality.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
                <div class="col-3">
                    <div class="heading-sm mb-3">Treatments</div>
                    <x-hoverBtn href="{{ route('treatment.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
                <div class="col-3"> <img src="{{ asset('front/assets/img/health-library/health-library-2.jpg') }}"
                        alt="Doctor"></div>
                <div class="col-3">
                    <div class="heading-sm mb-3">
                        Ailments
                    </div>
                    <x-hoverBtn href="{{ route('aliment.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
                <div class="col-3">
                    <img src="{{ asset('front/assets/img/health-library/health-library-1.jpg') }}" alt="Doctor">
                </div>
            </div>
        </div>
        <div class="mobile-slider">
            <div class="mobile-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/health-library-1.jpg') }}" alt="Doctor">
                </div>
                <div class="body">
                    <div class="heading-sm mb-3">Our Doctors</div>
                    <x-hoverBtn class="heading-xs">Know More</x-hoverBtn>
                </div>
            </div>
            <div class="mobile-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/health-library-2.jpg') }}" alt="Doctor">
                </div>
                <div class="body">
                    <div class="heading-sm mb-3">Our Specialities</div>
                    <x-hoverBtn href="{{ route('speciality.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
            </div>
            <div class="mobile-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/health-library-1.jpg') }}" alt="Doctor">
                </div>
                <div class="body">
                    <div class="heading-sm mb-3">Our Ailments</div>
                    <x-hoverBtn href="{{ route('aliment.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
            </div>
            <div class="mobile-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/health-library-2.jpg') }}" alt="Doctor">
                </div>
                <div class="body">
                    <div class="heading-sm mb-3">Our Treatments</div>
                    <x-hoverBtn href="{{ route('treatment.index') }}" class="heading-xs">Know More</x-hoverBtn>
                </div>
            </div>
        </div>
    </div>
</section>
