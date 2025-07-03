<section id="gallery-images">
    <div class="main-container">
        <div class="row">
            @foreach ($galleries as $type)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                  <div class="img-wrapper">
                    <a href="{{ asset($type->image) }}" class="glightbox" data-gallery="all-gallery"
                        title="{{ $type->title }}"
                        data-glightbox="title: {{$type->title}}; description: {{$type->description}}">
                        <img src="{{ asset($type->image) }}" alt="{{ $type->title }}"
                            class="img-fluid rounded shadow-sm">
                    </a>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
