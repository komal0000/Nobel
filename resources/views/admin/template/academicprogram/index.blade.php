<section id="videos-top-banner">
    <picture class="img-wrap">
        <source media="(min-width: 768px)"
            srcset="{{ asset('front/assets/img/health-library/knowledge/video-banner.jpg') }}" width="1920"
            height="500" alt="video">
        <source media="(min-width: 320px)"
            srcset="{{ asset('front/assets/img/health-library/knowledge/video-banner-md.jpg') }}" width="480"
            height="320" alt="video">
        <img src="{{ asset('front/assets/img/health-library/knowledge/video-banner.jpg') }}" width="1920"
            height="500" alt="video" class="img-fluid w-100">
        <div class="banner-title">Academic Program</div>
    </picture>
</section>

@foreach ($academicProgramTypes as $type)
    <section id="doctor-videos" data-content="Doctor Videos">
        <div class="main-container">
            <div class="heading-group">
                <div class="heading text-center">{{ $type->title }}</div>
                <x-hoverBtn class="button" href="{{ route('academicprogram.list') }}">View All</x-hoverBtn>
            </div>
            @php
                $academicPrograms = App\Models\Blog::where('blog_category_id', $type->id)->get();
            @endphp
            <div class="doctor-slider">
                @foreach ($academicPrograms as $academicProgram)
                    <a href="{{ route('academicprogram.single', ['slug' => $academicProgram->slug]) }}">
                        <div class="video-card doctor-card">
                            <div class="img-wrapper">
                                <img src="{{ Storage::url($academicProgram->image) }}" alt="Staff">
                            </div>
                            <div class="body">
                                <div class="heading-sm">
                                    {{ $academicProgram->title }}
                                </div>
                                <div class="para-wrap">
                                    {{ $academicProgram->short_description }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mobile-btn">
                <x-hoverBtn href="{{ route('academicprogram.list') }}">View All</x-hoverBtn>
            </div>
        </div>
    </section>
@endforeach
