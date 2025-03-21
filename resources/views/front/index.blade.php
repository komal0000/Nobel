@extends('front.layout.app')
@section('css')
    <link rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @includeif('front.cache.home.slider')
    @includeIf('front.cache.home.speciality')
    @includeIf('front.cache.home.teams')
    @includeIf('front.cache.home.care')
    @includeIf('front.cache.home.awards')
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

            $('.award-slide').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="{{ asset('front/assets/img/vector-left.png') }}" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="{{ asset('front/assets/img/vector-right.png') }}" alt="Right Arrow"></button>',
                responsive: [{
                        breakpoint: 1199,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {

                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        })

        function setActive(el) {
            $('.sp-btn').removeClass('active-btn');
            $(el).addClass('active-btn');
        }

        function showList() {
            $('#list-wrap').toggle();
        }
        $('.click-circle').on('click', function(e) {
            console.log('logged');

            e.preventDefault();
            let imgSrc = $(this).attr('datasrc');

            $('.center-image').attr('src', imgSrc);

            let $image = $('.center-image');

            $image.css('transition', 'none');
            $image.css({
                'transform': 'scale(0.01)',
                'opacity': '0'
            });
            $image[0].offsetHeight;

            setTimeout(function() {
                $image.css('transition',
                    'transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.8s ease');

                $image.css({
                    'transform': 'scale(1)',
                    'opacity': '1'
                });
            }, 50);

            $('.click-circle').removeClass('active');
            $(this).addClass('active');
            $('.why-block').removeClass('active-why');
            $(this).closest('.why-block').addClass('active-why');
        });
        $('.center-image').addClass('normal');
    </script>
@endsection
