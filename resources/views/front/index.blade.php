@extends('front.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @includeif('front.cache.home.slider')
    @includeIf('front.cache.home.speciality')
    @includeIf('front.cache.home.teams')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let $slider = $('#slick-slider');

            function initSlider() {
                if ($(window).width() <= 1299) {

                    if (!$slider.hasClass('slick-initialized')) {
                        $slider.slick({
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            prevArrow: '<button class="slick-prev left-arrow"><img src="{{ asset('front/assets/img/vector-left.png') }}" alt="Left Arrow"></button>',
                            nextArrow: '<button class="slick-next right-arrow"><img src="{{ asset('front/assets/img/vector-right.png') }}" alt="Right Arrow"></button>',
                            responsive: [{
                                    breakpoint: 768,
                                    settings: {
                                        arrows: false,
                                        slidesToShow: 2,

                                    }
                                },
                                {
                                    breakpoint: 480,
                                    settings: {
                                        slidesToShow: 1,
                                        arrows: false
                                    }
                                }
                            ]
                        })
                    }
                } else {
                    if ($slider.hasClass("slick-initialized")) {
                        $slider.slick("unslick");
                    }
                }
            }
            initSlider();
            $(window).on("resize", function() {
                initSlider();
            });
        })
        function setActive(el) {
            $('.sp-btn').removeClass('active-btn');
            $(el).addClass('active-btn');
        }
        function showList(){
            console.log('clicked');
            $('#list-wrap').show();
        }
    </script>
@endsection
