@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.service.' . $slug)
@endsection

@section('content')
    @includeIf('front.cache.service.single.overview.' . $service->id)
    @includeIf('front.cache.service.single.package.' . $service->id)
    @includeIf('front.cache.service.single.benefit.' . $service->id)
    @includeIf('front.cache.service.single.faqs.' . $service->id)
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
            $('.why-labs-slider').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                prevArrow: '<button class="slick-prev left-arrow"><img src="{{ asset('front/assets/img/vector-left.png') }}" alt="Left Arrow"></button>',
                nextArrow: '<button class="slick-next right-arrow"><img src="{{ asset('front/assets/img/vector-right.png') }}" alt="Right Arrow"></button>',

                responsive: [{
                        breakpoint: 1299,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 500,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            })

            $('.question').on('click', function() {
                if ($(this).closest('.question-answer').hasClass('active')) {
                    $('.question-answer').removeClass('active');
                    return;
                }
                $('.question-answer').removeClass('active');
                $(this).closest('.question-answer').addClass('active');
            });

            // Package filter functionality
            $('.default-select').on('click', function() {
                $(this).closest('.filter').toggleClass('active');
            });

            let selectedGender = '';
            let selectedCategory = '';

            $('.list li').on('click', function() {
                let $filter = $(this).closest('.filter');

                $filter.find('.name').text($(this).text());

                if ($filter.hasClass('gender-filter')) {
                    selectedGender = $(this).data('gender-target');
                } else if ($filter.hasClass('package-category-filter')) {
                    selectedCategory = $(this).data('category-target');
                }

                $filter.removeClass('active');
            });

            $('.go-btn').on('click', function() {
                filterCards();
            });

            function filterCards() {
                // Show all cards first
                $('.package-card-col').show();

                if (selectedGender) {
                    $('.package-card-col').not(`[data-gender="${selectedGender}"]`).hide();
                }

                if (selectedCategory && selectedCategory !== 'all') {
                    $('.package-card-col').not(`[data-category="${selectedCategory}"]`).hide();
                }
            }
        });
    </script>
@endsection
