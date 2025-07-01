@php
    $title = App\Helper::getSetting('home_description_TeamTitle', true);
    $description = App\Helper::getSetting('home_description_TeamDescription', true);
    $image = App\Helper::getSetting('home_description_TeamImage', true);
    $mobileimage = App\Helper::getSetting('home_description_TeamMobileImage', true);

@endphp
<section class="team-section">
    <div class="main-container">
        <div class="meet-doc-content">
            <h3 class="text-center fw-bold mb-4 meet-doc-title">{{ $title }}</h3>
            <div class="text-center mb-5">
                <p>
                    {{ $description }}
                </p>
            </div>
            @includeIf('front.cache.home.teams')
        </div>
    </div>
    <picture class="image-block">
        <source media="(min-width:768px)" srcset="{{ asset($image) }}" alt="meet-our-doctors">
        <source media="(min-width:320px)" srcset="{{ asset($mobileimage) }}"
            alt="meet-our-doctors">
        <img class="img-fluid w-100" src="{{ asset($image) }}" alt="meet-our-doctors">
    </picture>
</section>
