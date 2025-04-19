<section id="about-us-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)" srcset="{{ asset('front/assets/img/about-us/banner.jpg') }}" width="1920"
            height="500" alt="About Us">
        <source media="(min-width: 320px)" srcset="{{ asset('front/assets/img/about-us/banner-md.jpg') }}" width="480"
            height="320" alt="About Us">
        <img src="{{ asset('front/assets/img/about-us/banner.jpg') }}" class="img-fluid w-100 object-fit-cover h-100"
            alt="About Us">
    </picture>
</section>
@foreach ($abouts as $about)
    <section id="about-nobel">
        <div class="main-container">
            <div class="d-flex flex-column flex-md-row gap-4">
                <div class="img-wrap">
                    <img src="{{ Storage::url($about->image) }}" alt="About Nobel Image">
                </div>
                <div class="content align-self-center d-flex flex-column gap-4">
                    <div class="heading">
                        {{ $about->title }}
                    </div>
                    <div class="para-wrap">
                        {!! $about->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endforeach
<section id="about-award">
    <div class="main-container">
        <x-sliderComponent mainClass="awardSlider" heading="Awards & Recognitions">
            @foreach ($awards as $award)
                <div class="slide-card">
                    <div class="leaf-left">
                        <img src="{{ asset('front/assets/img/leaf-left.png') }}" alt="leaf">
                    </div>
                    <div class="year sm-heading">
                        {{ $award->year }}
                    </div>
                    <div class="content heading-xs">
                        {{ $award->short_description }}
                    </div>
                    <div class="leaf-right">
                        <img src="{{ asset('front/assets/img/leaf-right.png') }}" alt="leaf">
                    </div>
                </div>
            @endforeach
        </x-sliderComponent>
    </div>
</section>
