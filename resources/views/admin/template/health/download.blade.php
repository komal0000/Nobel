<section id="health-library-download" data-content="Downloads">
    <div class="main-container">
        <div class="heading-group">
            <div class="heading text-center">Downloads</div>
        </div>
        <div class="download-slider">
            @foreach ($downloads as $download)
            <div class="download-card p-4">
                <h3 class="title heading-sm mb-4">{{$download->title}}</h3>
                <div class="date-download d-flex justify-content-between">
                    <div class="para-wrap date">{{App\Helper::formatTimestampToDateString($download->uploaded_date)}}</div>
                    <a class="z-1" href="{{ asset($download->link) }}" download>
                        <i class="bi bi-download"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mobile-btn">
            <x-hoverBtn  href="{{ route('download.index') }}" >View All Downloads </x-hoverBtn>
        </div>
    </div>
</section>
