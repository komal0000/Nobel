<section id="admission-banner">
    <picture class="img-wrap">
        <img src="{{ asset($admissionData->image) }}" width="1920" height="480" alt="Admission Banner Image">
    </picture>
    <div class="banner-wrapper">
        <div class="banner-title">
            Admission
        </div>
    </div>
</section>
<section id="admission-nobel-1">
    <div class="main-container">
        <p class="para-wrap">
            {!! $admissionData->{'section-1'} !!}
        </p>
    </div>
</section>

<section id="admission-nobel-2">
    <div class="main-container">
        <p class="para-wrap">
            {!! $admissionData->{'section-2'} !!}
        </p>
    </div>
</section>
