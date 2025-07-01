<section id="technology-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            @if ($treatment->single_page_image)
                <source media="(min-width: 768px)" srcset="{{ asset($treatment->single_page_image) }}" type="image/webp">
                <source media="(min-width: 320px)" srcset="{{ asset($treatment->single_page_image) }}" type="image/webp">
                <img src="{{ asset($treatment->single_page_image) }}" class="img-fluid" alt="Treatment Banner Image">
            @endif
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
                {{ $treatment->title }}
            </div>
        </div>
    </div>
    <div class="callback-form">
        <form action="{{ route('admin.setting.addRequestCallBack') }}">
            <div class="heading-md">Request a Callback</div>
            <div class="input-wrap">
                <label for="name">Name *</label>
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-wrap">
                <label for="mobileNumber">Mobile Number *</label>
                <input type="text" name="mobileNumber" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="input-wrap">
                <label for="email">Email Address</label>
                <input type="text" name="email" placeholder="Enter Your E-mail">
            </div>
            <div class="input-wrap">
                <label for="message">Message</label>
                <input type="text" name="message" placeholder="Enter Your Message">
            </div>
            <div class="btn-wrap w-100">
                <button>Submit</button>
            </div>
        </form>
    </div>
</section>
@foreach ($treatmentSections as $section)
    @if ($section->style_type == 1)
        <section id="how" data-content="How is it Done?">
            @php
                $sectionSteps = App\Models\TreatmentStep::where('treatment_section_id', $section->id)->get();
            @endphp
            <div class="main-container">
                <x-type1 heading="{{ $section->title }}" subHeading="{{ $section->description }}"
                    :items="$sectionSteps"></x-type1>
            </div>
        </section>
    @elseif($section->style_type == 2)
        @php
            $sectionSteps = App\Models\TreatmentStep::where('treatment_section_id', $section->id)->get();
        @endphp
        <section id="benefit-risk" data-content="Benefits & Risks">
            <div class="main-container">
                <x-type2 heading="{{ $section->title }}" subHeading="{{ $section->description }}"
                    :items="$sectionSteps"></x-type2>
            </div>
        </section>
    @endif
@endforeach
{{-- <section id="treated">
    <div class="main-container">
       <x-sliderComponent mainClass="treatmentSlider" heading="Get Treated In Our Specialised Get Treated In Our Specialised Institutes & Departments">
          <div class="each-card">
             <a href="#">
                <div class="img-wrapper d-flex justify-content-center">
                   <img src="{{ asset('front/assets/img/heart.svg') }}" alt="Treatment Image">
                </div>
                <div class="body">
                   This is for testing
                </div>
             </a>
          </div>
          <div class="each-card">
             <a href="#">
                <div class="img-wrapper d-flex justify-content-center">
                   <img src="{{ asset('front/assets/img/heart.svg') }}" alt="Treatment Image">
                </div>
                <div class="body">
                   This is for testing
                </div>
             </a>
          </div>
          <div class="each-card">
             <a href="#">
                <div class="img-wrapper d-flex justify-content-center">
                   <img src="{{ asset('front/assets/img/heart.svg') }}" alt="Treatment Image">
                </div>
                <div class="body">
                   This is for testing
                </div>
             </a>
          </div>
       </x-sliderComponent >
    </div>
</section> --}}
