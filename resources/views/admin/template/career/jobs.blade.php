<section class="profession">
    <div class="main-container">
        <div class="heading text-center">

        </div>
        <div class="card-wrapper">
            <div class="slide" id="slide">
                @foreach ($jobs as $job)
                    <div class="each-card">
                        <div class="image-container">
                            <img src="{{ Storage::url($job->image) }}" alt="Card Image" class="img-fluid">
                        </div>
                        <div class="body">
                            <h3 class="heading">{{ $job->title }}</h3>
                            <p class="content">{{ $job->description }}</p>
                            <div class="d-flex justify-content-center know-btn">
                                <x-hoverBtn>View Jobs</x-hoverBtn>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</section>
@push('js')

@endpush
