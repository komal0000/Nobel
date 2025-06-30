<section id="tech" class="tech" data-content="Technology">
    <div class="main-container">
        <div class="heading-group text-center">
            <div class="heading">
                Technology
            </div>
        </div>
        <div class="content-slider">
            @foreach ($technologies as $technology)
                <div class="main-card">
                    <div class="img-wrapper">
                        <img src="{{ asset($technology->image) }}" alt="{{ $technology->title }}"
                            class="img-fluid">
                    </div>
                    <div class="body text-center">
                        <div class="body-head">
                            {{ $technology->title }}
                        </div>
                        <div class="para-wrap">
                            {{ $technology->short_description }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
