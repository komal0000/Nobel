@php
    $data = App\Helper::getSetting('contact') ??
        (object) [
            'map' => '',
        ];
@endphp
<section id="find-us" class="find-us" data-content="Find Us">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Find Us Here
        </div>
        <div class="map px-3">
            <iframe
                src="https://maps.google.com/maps?q={{$data->map}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                 allowfullscreen="true" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>
