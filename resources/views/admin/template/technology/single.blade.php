<section id="technology-banner">
    <div class="wrapper">
        <picture class="img-wrap">
            @if ($technology->image)
                <source media="(min-width: 768px)" srcset="{{ Storage::url($technology->single_page_image) }}">
                <source media="(min-width: 320px)" srcset="{{ Storage::url($technology->single_page_image) }}">

                <img src="{{ Storage::url($technology->single_page_image) }}" class="img-fluid"
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
        <form action="">
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
@foreach ($technologySections as $section)
    @if ($section->design_type == 1)
        @php
            $items = App\Models\TechnologySectionData::where('technology_section_id', $section->id)
                ->where('technology_id', $technology->id)
                ->get();
        @endphp
        <section id="technology-help">
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
        <section id="benefit-risk">
            <div class="main-container">
                <x-type2 heading="{{ $section->title }}" subHeading="{{ $section->short_description }}"
                    :items="$items"></x-type2>
            </div>
        </section>
    @elseif ($section->design_type == 3)
        <section id="technology-description">
            <div class="main-container">
                <x-type3 heading="{{ $section->title }}" content="{{ $section->short_description }}"
                    href="{{ Storage::url($section->image) }}"></x-type3>
            </div>
        </section>
    @endif
@endforeach
