<section class="awards">
    <div class="main-container">
        <div class="heading text-center">Awards and Recognitions</div>
        <div class="award-slide">
            @if ($awards->count() <= 2)
                @foreach ($awards as $award)
                    <div class="slide-card half-width">
                        <div class="leaf-left">
                            <img src="{{ asset('front/assets/img/leaf-left.png') }}" alt="leaf">
                        </div>
                        <div class="year sm-heading">
                            {{ $award->year }}
                        </div>
                        <div class="content heading-xs">
                            {{ $award->short_description }}
                        </div>
                        <div class="leaf-right">
                            <img src="{{ asset('front/assets/img/leaf-right.png') }}" alt="leaf">
                        </div>
                    </div>
                @endforeach
            @else
                @foreach ($awards as $award)
                    <div class="slide-card " >
                        <div class="leaf-left">
                            <img src="{{ asset('front/assets/img/leaf-left.png') }}" alt="leaf">
                        </div>
                        <div class="year sm-heading">
                            {{ $award->year }}
                        </div>
                        <div class="content heading-xs">
                            {{ $award->short_description }}
                        </div>
                        <div class="leaf-right">
                            <img src="{{ asset('front/assets/img/leaf-right.png') }}" alt="leaf">
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
