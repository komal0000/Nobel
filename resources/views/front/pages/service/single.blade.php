@extends('front.layout.app')

@section('title', $service->title)
@section('meta', $service->title)

@section('content')
    @includeIf('front.cache.service.' . $service_id)
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            const $para = $('.para-wrap');
            const $btn = $('.read-more-btn');

            function checkOverflow() {
                const $clone = $para.clone()
                    .css({
                        display: 'block',
                        visibility: 'hidden',
                        position: 'absolute',
                        width: $para.width(),
                        maxHeight: 'none',
                        overflow: 'visible'
                    })
                    .appendTo('body');

                const fullHeight = $clone[0].scrollHeight;
                const displayHeight = $para.height();

                $clone.remove();
                return fullHeight > displayHeight;
            }

            if (checkOverflow()) {
                $btn.show();
                $para.addClass('collapsed');
            } else {
                $btn.hide();
                $para.removeClass('collapsed');
            }

            $btn.on('click', function() {
                $para.toggleClass('collapsed');
                $(this).html($para.hasClass('collapsed') ? 'Read More <i class="bi bi-chevron-down"></i>' :
                    'Read Less <i class="bi bi-chevron-up"></i>');
            });
            $('.serviceSingle').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',

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
            $('.question').on('click', function() {
                if ($(this).closest('.question-answer').hasClass('active')) {
                    $('.question-answer').removeClass('active');
                    return;
                }
                $('.question-answer').removeClass('active');
                $(this).closest('.question-answer').addClass('active');
            });
        });
    </script>
@endsection
