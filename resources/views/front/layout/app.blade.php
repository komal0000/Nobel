<!DOCTYPE html>
<html lang="en">
@php
    $data = App\Helper::getSetting('top_favicon', true);
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('meta')">
    <link rel="icon" href="{{ Storage::url($data) }}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="stylesheet" href="{{ asset('front/assets/css/index.css') }}">
    <title>@yield('title')</title>
    @yield('css')
    @includeIf('front.cache.colorScheme')
    <style>
        body {
            color: #58595B;
            font-family: var(--font-main);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('front.layout.header')
        <main>
            @yield('content')
        </main>
        @include('front.layout.footer')
        @include('front.layout.mobile-nav')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    @yield('js')
    <script>
        // Toggle submenu active state
        function extendSubMenu(el) {
            const $el = $(el);
            if ($el.hasClass('active-list')) {
                $el.removeClass('active-list');
                return;
            }
            $('.navbar-item').removeClass('active-list');
            $el.addClass('active-list');
        }

        // Toggle knowledge submenu
        function extendKnowledgeSubMenu(el, event) {
            event.stopPropagation();
            $(el).toggleClass('active-knowledge');
        }

        // Show/hide feedback based on scroll position on mobile
        function toggleFeedback() {
            if ($(window).width() < 481) {
                $(window).on("scroll", function() {
                    $(".feedback-contact").toggleClass('hide-feedback', $(window).scrollTop() > 100);
                });
            } else {
                $(window).off("scroll");
            }
        }

        // Toggle active class
        function expand(el) {
            $(el).toggleClass('active');
        }

        // Document ready handler
        $(document).ready(function() {
            // Initialize feedback visibility
            toggleFeedback();

            // Handle window resize
            $(window).on("resize", toggleFeedback);

            // Mobile navbar toggle
            $('#toggle-navbar').click(function() {
                $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
            });
        });
    </script>
</body>

</html>
