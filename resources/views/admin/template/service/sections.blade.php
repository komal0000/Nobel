@if ($section->image_placement == 'left')
    <section id="single-service-qn">
        <div class="main-container">
            <div class="heading text-center text-capitalize mb-4">
                {{ $section->title }}
            </div>
            <div class="qn-body">
                <div class="qn-list">
                    <div class="qn-picture"> {{-- image aspect ratio: 4:2 --}}
                        <img src="{{ asset($section->image) }}" height="400" width="800"
                            alt="Second Opinion Image">
                    </div>
                    <div class="qn-list">
                        {!! $section->short_desc1 !!}
                    </div>
                </div>

            </div>
        </div>
    </section>
@elseif($section->image_placement == 'right')
    <section id="single-service-qn">
        <div class="main-container">
            <div class="heading text-center text-capitalize mb-4">
                {{ $section->title }}
            </div>
            <div class="qn-body">
                <div class="qn-list">
                    {!! $section->short_desc1 !!}
                </div>
                <div class="qn-picture"> {{-- image aspect ratio: 4:2 --}}
                    <img src="{{ asset($section->image) }}" height="400" width="800"
                        alt="Second Opinion Image">
                </div>
            </div>
        </div>
    </section>
@elseif($section->image_placement == 'center')
    <section id="single-service-middle-image">
        <div class="main-container">
            <div class="heading text-center mb-4">
                {{ $section->title }}
            </div>
            <div class="image-main">
                <div class="image-left">
                    {{ $section->short_desc1 }}
                </div>
                <div class="image-middle">
                    <picture>
                        <img height="300" width="300" src="{{ asset($section->image) }}" alt="">
                    </picture>
                </div>
                <div class="image-right">
                    {{ $section->short_desc2 }}
                </div>
            </div>
        </div>
    </section>
@endif
