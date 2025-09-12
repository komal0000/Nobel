<section id="overview" class="overview" data-content="Overview">
    <div class="main-container">
        <div class="col-wrapper d-flex justify-content-center align-items-center flex-column flex-xl-row">
            <div class="left">
                <h1 class="heading-lg text-center">
                   {{ $speciality->title }}
                </h1>
                <div class="buttons">
                    <a href="{{ route('contact') }}" class="btn me-3 mt-3">
                        Enquire Now
                    </a>
                    <a href="{{ route('doctor.index') }}" class="btn mt-3">
                        Find A Doctor
                    </a>
                </div>
            </div>
            <div class="right">
                <div class="img-block">
                    <div class="lg-img">
                        <img src="{{ asset($speciality->single_page_image) }}" alt="Desktop Heart Image">
                    </div>
                    <div class="md-img">
                        <img src="{{ asset($speciality->single_page_image) }}" alt="Mobile Heart Image">
                    </div>
                </div>
                <div class="btn-mobile ">
                    <a href="{{ route('contact') }}" class="btn">
                        Enquire Now
                    </a>
                    <a href="{{ route('doctor.index') }}" class="btn">
                        Find A Doctor
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

