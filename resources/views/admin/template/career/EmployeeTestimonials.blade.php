<div class="employee">
    <div class="heading-sm mb-4">
        Employee Speak
    </div>
    <div class="employee-slider" id="slide">
        @foreach ($testimonials as $testimonial)
        <div class="each-card">
            <div class="image-container">
                <img src="{{ asset($testimonial->image) }}" alt="Card Image" class="img-fluid">
            </div>
            <div class="body">
                <h3 class="heading">{{$testimonial->title}}</h3>
                <p class="card-content">{{$testimonial->short_description}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
