@props(['heading' => 'Default Heading', 'subHeading' => '', 'sliderId' => uniqid('slider-')])

<div  class="slider-component">
    @if ($subHeading)
        <div class="heading-group">
            <div class="heading">{{ $heading }}</div>
            <div class="heading-xs">{{ $subHeading }}</div>
        </div>
    @else
        <div class="heading">{{ $heading }}</div>
    @endif
    <div class="{{$sliderId}}">
        {{ $slot }}
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {

            $('.{{$sliderId}}').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="{{ asset('front/img/vector-left.png') }}" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="{{ asset('front/img/vector-right.png') }}" alt="Right Arrow"></button>',

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
@endpush
