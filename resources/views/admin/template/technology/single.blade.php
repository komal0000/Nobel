<section id="technology-banner" >
    <div class="wrapper">
        <picture class="img-wrap">
            @if ($technology->image)
                <source media="(min-width: 768px)" srcset="{{ asset($technology->single_page_image) }}">
                <source media="(min-width: 320px)" srcset="{{ asset($technology->single_page_image) }}">

                <img src="{{ asset($technology->single_page_image) }}" class="img-fluid"
                    alt="Treatment Banner Image">
            @endif
        </picture>
        <div class="banner-wrapper">
            <div class="banner-title">
                {{ $technology->title }}
            </div>
        </div>
    </div>
    <div class="callback-form">
        <form action="{{ route('setting.addRequestCallBack') }}" method="post" id="callback-form">
            <div class="heading-md">Request a Callback</div>
            <div class="input-wrap">
                <label for="name">Name *</label>
                <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
            </div>
            <div class="input-wrap">
                <label for="phoneNumber">Mobile Number *</label>
                <input type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter Your Phone Number" required>
            </div>
            <div class="input-wrap">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter Your E-mail">
            </div>
            <div class="input-wrap">
               <label for="message">Message *</label>
               <input type="text" name="message" id="message" placeholder="Enter Your Message" required>
           </div>
            <div class="btn-wrap w-100">
                <button>Submit</button>
            </div>
        </form>
    </div>
</section>
@foreach ($technologySections as $section)
    @if ($section->design_type == 1)
        @php
        $items = App\Models\TechnologySectionData::where('technology_section_id', $section->id)
            ->where('technology_id', $technology->id)
            ->get();
        @endphp
        <section id="technology-help" data-content="How does it help?">
            <div class="main-container">
                <x-type1 heading="{{ $section->title }}" subHeading="{{ $section->short_description }}"
                    :items="$items"></x-type1>
            </div>
        </section>
    @elseif($section->design_type == 2)
        @php
        $items = App\Models\TechnologySectionData::where('technology_section_id', $section->id)
            ->where('technology_id', $technology->id)
            ->get();
        @endphp
        <section id="benefit-risk" data-content="Benifits & Risks">
            <div class="main-container">
                <x-type2 heading="{{ $section->title }}" subHeading="{{ $section->short_description }}"
                    :items="$items"></x-type2>
            </div>
        </section>
    @elseif ($section->design_type == 3)
        <section id="technology-description" data-content="About {{$technology->title}}">
            <div class="main-container">
                <x-type3 heading="{{ $section->title }}" content="{{ $section->short_description }}"
                    href="{{ asset($section->image) }}"></x-type3>
            </div>
        </section>
    @endif
@endforeach
