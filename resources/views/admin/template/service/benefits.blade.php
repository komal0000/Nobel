<section id="single-service-why-our-labs">
    <div class="main-container">
        <div class="heading text-center mb-4">Benefits</div>
        <div class="why-labs-slider">
            @foreach ($benefits as $benefit)
                <div class="why-labs-card">
                    <div class="logo overflow-hidden d-flex justify-content-center align-items-center"
                        style="height: 100px; width:100px;">
                        <img class="h-100 w-100" style="object-fit: cover;" src="{{ Storage::url($benefit->icon) }}"
                            alt="">
                    </div>
                    <div class="card-title">
                        {{ $benefit->short_desc }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
