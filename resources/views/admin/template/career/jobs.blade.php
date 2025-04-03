<section class="profession">
    <div class="main-container">
        <div class="heading text-center">

        </div>
        <div class="card-wrapper">
            <div class="slide" id="slide">
                @foreach ($jobcategories as $jobcategory)
                    <div class="each-card">
                        <div class="image-container">
                            <img src="{{ Storage::url($jobcategory->icon) }}" alt="Card Image" class="img-fluid">
                        </div>
                        <div class="body">
                            <h3 class="heading">{{ $jobcategory->title }}</h3>
                            <p class="content">{{ $jobcategory->short_description }}</p>
                            <div class="d-flex justify-content-center know-btn">
                                <x-hoverBtn href="{{ route('jobcategory') }}">View Jobs</x-hoverBtn>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</section>
