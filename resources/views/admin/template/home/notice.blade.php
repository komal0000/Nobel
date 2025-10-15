<section id="notice" class="notice" data-content="Notice">
    <div class="main-container">
        <div class="heading text-center">
            Notice
        </div>
        <x-hoverBtn class="common-button d-flex justify-content-center" href="{{ route('knowledge.notice.index') }}">View All Notices</x-hoverBtn>
        <div class="notice-slider" id="notice-slider">
            @foreach ($homeNotices as $notice)
                <div class="slide m-3">
                    <div class="img-wrapper">
                        <img src="{{ asset($notice->image) }}" alt="Service Image" class="img-fluid">
                    </div>
                    <div class="body">
                        <h3 class="title heading-md">{{ $notice->title }}</h3>
                        <p class="para-wrap content">{{ $notice->short_description }}</p>
                        <div class="d-flex justify-content-between know-btn">
                            <x-hoverBtn href="{{ route('knowledge.notice.single', ['slug' => $notice->slug]) }}">Know
                                More</x-hoverBtn>
                        </div>
                    </div>
                </div>
            @endforeach
        </div> 
    </div>
</section>
