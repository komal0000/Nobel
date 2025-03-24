<div class="award">
    <div class="heading-sm mb-3">
        Awards
    </div>
    <div class="award-slider d-flex flex-row flex-lg-column">
        @foreach ($awards as $award)
        <div class="slide-card">
            <div class="leaf-left">
                <img src="{{ asset('front/assets/img/leaf-left.png') }}" alt="leaf">
            </div>
            <div class="d-flex flex-column justify-content-center h-100">
                <div class="year sm-heading">
                    {{ $award->year }}
                </div>
                <div class="content heading-xs">
                    {{ $award->short_description }}
                </div>
            </div>
            <div class="leaf-right">
                <img src="{{ asset('front/assets/img/leaf-right.png') }}" alt="leaf">
            </div>
        </div>
        @endforeach
    </div>
</div>
