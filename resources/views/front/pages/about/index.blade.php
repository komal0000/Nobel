@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.aboutUs')
@endsection

@section('content')
    @includeIf('front.cache.about.index')
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.awardSlider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 650,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>
@endsection
