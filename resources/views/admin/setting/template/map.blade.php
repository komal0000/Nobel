@php
    $data = App\Helper::getSetting('contact') ??
        (object) [
            'map' => '',
        ];
@endphp
<section class="find-us">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Find Us Here
        </div>
        <div class="map px-3">
            <iframe
                src="{{ $data->map }}"
                 allowfullscreen="true" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
