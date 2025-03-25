<section class="team">
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
                                <img src="{{ Storage::url($item->icon) }}" alt="{{ $item->title }}" class="img-fluid">
                            </div>
                            <div class="body text-left para-wrap">
                                {{ $item->description  }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="heading-xs team-line">
            <span>{{ $specialityGallery->title ?? 'Heart Team' }}: </span>
            {{ $specialityGallery->description ?? 'Lorem ipsum dolor sit amet consectetur, adipisicing elit.' }}
        </div>
    </div>
</section>
