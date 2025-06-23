<section id="single-service-why-our-labs">
    <div class="main-container">
        <div class="heading text-center mb-4">Benefits</div>
        <div class="why-labs-slider">
            @foreach ($benefits as $benefit)
                <div class="why-labs-card">
                    <div class="logo overflow-hidden d-flex justify-content-center align-items-center"
                        style="height: 100px; width:100px;">
                        <img class="h-100 w-100" style="object-fit: cover;" src="{{ asset($benefit->icon) }}"
                            alt="">
                    </div>
                    <div class="card-title">
                        {{ $benefit->title }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
