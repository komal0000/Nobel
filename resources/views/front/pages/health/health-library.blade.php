<section id="health-library"  data-content="health-library">
    <div class="main-container">
        <div class="heading mb-4 text-center">
            Health Service Provides
        </div>
        <div class="health-library-slide">
            <div class="health-library-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/diseases.png') }}" alt="Diseases">
                </div>
                <div class="heading-sm">
                    Diseases & Conditions
                </div>
                <x-hoverBtn href="{{ route('aliment.index') }}" class="btn heading-xs">Know More</x-hoverBtn>
            </div>
            <div class="health-library-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/treatment.png') }}" alt="Treatments">
                </div>
                <div class="heading-sm">
                    Treatments & Procedures
                </div>
                <x-hoverBtn href="{{ route('treatment.index') }}" class="btn heading-xs">Know More</x-hoverBtn>
            </div>
            <div class="health-library-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/diagnostic.png') }}" alt="Diagnostics">
                </div>
                <div class="heading-sm">
                    Diagnostics & Testing
                </div>
                <x-hoverBtn class="btn heading-xs">Know More</x-hoverBtn>
            </div>
            <div class="health-library-card">
                <div class="img-wrapper">
                    <img src="{{ asset('front/assets/img/health-library/technology.png') }}" alt="Technology">
                </div>
                <div class="heading-sm">
                    Technology & Devices
                </div>
                <x-hoverBtn href="{{ route('technology.index') }}" class="btn heading-xs">Know More</x-hoverBtn>
            </div>
        </div>
    </div>
</section>
