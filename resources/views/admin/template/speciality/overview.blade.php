<section id="overview" class="overview" data-content="Overview">
    <div class="main-container">
        <div class="col-wrapper d-flex justify-content-center align-items-center flex-column flex-xl-row">
            <div class="left">
                <h1 class="heading-lg">
                   {{ $speciality->title }}
                </h1>
                <div class="buttons">
                    <button class="btn me-3 mt-3">
                        Enquire Now
                    </button>
                    <button class="btn mt-3">
                        Find A Doctor
                    </button>
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
                <div class="top-banner-slide">
                    <div class="each-slide">
                        <div class="heading-xs">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, aut.</div>
                    </div>
                    <div class="each-slide">
                        <div class="heading-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium nemo qui excepturi tenetur minima rerum.</div>
                    </div>
                    <div class="each-slide">
                        <div class="heading-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt eum sit voluptatum nihil obcaecati excepturi ipsum vel, in voluptates commodi.</div>
                    </div>
                </div>
                <div class="btn-mobile ">
                    <button class="btn">
                        Enquire Now
                    </button>
                    <button class="btn">
                        Find A Doctor
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

