<section id="home-career" class="home-career" data-content="Career">
    <div class="main-container">
        <div class="heading text-center">
            Jobs
        </div>
        <x-hoverBtn class="common-button d-flex justify-content-center" href="{{ route('jobs.jobcategory') }}">View All
            Jobs</x-hoverBtn>
        <div class="career-slider" id="career-slider">
            @if ($careers->isNotEmpty())
                @foreach ($careers as $career)
                    <div class="career-slide m-3">
                        <div class="header d-flex justify-content-start gap-4">
                            <div class="img-wrapper">
                                <img src="{{ asset($career->category_icon) }}" alt="Job Icon" class="img-fluid">
                            </div>
                                <h3 class="title category-title fs-4 fw-bold mb-0">{{ $career->category_title ?? 'Job Category' }}</h3>
                        </div>
                        <div class="body mt-4 d-flex justify-content-between gap-2">
                            <p class="career-title fw-semibold fs-5 mb-0">{{ $career->title }}</p>
                            <div class="d-flex justify-content-center know-btn">
                                <x-hoverBtn
                                    href="{{ route('jobs.jobDetail.jobDetail', ['slug' => $career->slug]) }}">View</x-hoverBtn>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center my-3">
                    <h4>We’re not hiring at the moment.</h4>
                </div>
            @endif
        </div>
    </div>
</section>
