@props(['heading' => 'Default Heading', 'subHeading' => '', 'mainClass' => ''])

<div class="slider-component">
    @if ($heading)
        <div class="heading-group mb-4">
            @if ($subHeading)
                <div class="heading mb-2">{{ $heading }}</div>
                <div class="heading-xs">{{ $subHeading }}</div>
            @else
                <div class="heading">{{ $heading }}</div>
            @endif
        </div>
    @endif
    <div class="{{$mainClass}}">
        {{ $slot }}
    </div>
</div>
@section('js')
    <script>
        $(document).ready(function () {

            $('.{{$mainClass}}').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="front/assets/img/vector-right.png" alt="Right Arrow"></button>',

                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                    },
                },
                {
                    breakpoint: 650,
                    settings: {
                        slidesToShow: 1,
                    },
                },
                ],
            })
        });
    </script>
@endsection