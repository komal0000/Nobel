<section id="team" class="team" data-content="Team">
    <div class="main-container text-center">
        <div class="flex-container d-flex flex-column">
            <div class="heading-lg title">
                {{ $specialityGallery->title }}
            </div>
            <div class="heading-xs para text-center align-self-center">
                {{ $specialityGallery->description }}
            </div>
            <div class="team-slider">
                @if (isset($galleryItems) && count($galleryItems) > 0)
                    @foreach ($galleryItems as $item)
                        <div class="main-card">
                            <div class="img-wrapper">
                                <img src="{{ asset($item->icon) }}" alt="{{ $item->title }}" class="img-fluid">
                            </div>
                            <div class="body text-left para-wrap">
                                {{ $item->description  }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
