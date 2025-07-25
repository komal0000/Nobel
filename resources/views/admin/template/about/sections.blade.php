@foreach ($abouts as $about)
    {{-- <section id="about-nobel">
        <div class="main-container">
            <div class="d-flex flex-column flex-md-row gap-4">
                <div class="img-wrap">
                    <img src="{{ asset($about->image) }}" alt="About Nobel Image">
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
    </section> --}}
    <section id="about-mission">
        <div class="main-container">
            <div class="heading text-center mb-4">{{ $about->title }}</div>
            <div class="content">
                <div class="img-wrapper">
                    <img src="{{ asset($about->image) }}" alt="Mission Image">
                </div>
                <div class="heading-sm text-center">
                    {!! $about->description !!}
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
