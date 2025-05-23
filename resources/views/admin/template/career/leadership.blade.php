<section id="leader" class="leader" data-content="Leadership">
    <div class="main-container">
        <h4 class="heading text-center">
            Meet Our Leadership
        </h4>
        <div class="leader-wrapper">
            <div class="slider-for">
                @foreach ($leaderships as $leadership)
                    <div class="each-card">
                        <div class="detail">
                            <div class="heading-md mb-2">{{ $leadership->title }}</div>
                            <div class="heading-sm mb-2">{{ $leadership->position }}</div>
                            <div class="para">{{ $leadership->description }}</div>
                        </div>
                        <img src="{{ asset($leadership->image) }}" alt="Position Name">
                    </div>
                @endforeach
            </div>
            <div class="slider-nav">
                @foreach ($leaderships as $leadership)
                    <div class="each-card-nav">
                        <img src="{{ asset($leadership->image) }}" alt="Position Name">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
