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

    <script>
        window.appConfig = window.appConfig || {};
        window.appConfig.showSectionNav = false;


        function toggleSectionNav(show) {
            window.appConfig.showSectionNav = show;

            if (show) {
                $('.sectionNavbarMainContainer').show().removeClass('d-none');
            } else {
                $('.sectionNavbarMainContainer').hide();
            }
        }

        function adjustMainMargin() {

            $('.site-header').css('display', 'none').height();
            $('.site-header').css('display', '');

            let headerBaseHeight = $('.site-header').outerHeight();

            if (!window.appConfig.showSectionNav && $('.sectionNavbarMainContainer').length) {
                
                headerBaseHeight -= $('.sectionNavbarMainContainer').outerHeight();
            }

            console.log($('.site-header').outerHeight(), 'outer');

            $('main').css('margin-top', headerBaseHeight + 'px');
        }


    </script>


    <script>
        $(function () {
            const $sections = $('section[data-content]');
            const $sectionLinks = $('#sectionLinks');
            const $mainSectionNavbarContainer = $('.sectionNavbarMainContainer');
            let scrolling = false;
            let scrollTimeout;

            // Generate section nav links

            if (window.appConfig.showSectionNav && $sectionLinks.length) {
                $mainSectionNavbarContainer.show();

                $sections.each(function () {
                    const sectionId = $(this).attr('id');
                    const sectionName = $(this).data('content');

                    $('<li>')
                        .append(
                            $('<a>')
                                .attr('href', `#${sectionId}`)
                                .text(sectionName)
                                .on('click', function (e) {
                                    e.preventDefault();
                                    scrolling = true;

                                    $('#sectionLinks a').removeClass('active');
                                    $(this).addClass('active');

                                    $('html, body').animate({
                                        scrollTop: $(`#${sectionId}`).offset().top - 120
                                    }, 10, function () {
                                        setTimeout(() => scrolling = false, 100);
                                    });

                                    scrollActiveLinkIntoView();
                                })
                        )
                        .appendTo($sectionLinks);
                });

                $(window).on('scroll', function () {
                    if (scrolling) return;

                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        let currentId = '';

                        $($sections.get().reverse()).each(function () {
                            if ($(window).scrollTop() >= $(this).offset().top - 150) {
                                currentId = $(this).attr('id');
                                return false;
                            }
                        });

                        if (currentId) {
                            $('#sectionLinks a').removeClass('active');
                            $(`#sectionLinks a[href="#${currentId}"]`).addClass('active');
                            scrollActiveLinkIntoView();
                        }
                    }, 100);
                });
            } else {
                $mainSectionNavbarContainer.hide();
            }

            function scrollActiveLinkIntoView() {
                if ($(window).width() < 1200) {
                    const $activeLink = $('#sectionLinks a.active');

                    if ($activeLink.length) {
                        const $ul = $('#sectionLinks');
                        const linkOffset = $activeLink.parent().position().left + 23;

                        $ul.css({
                            'transition': 'transform 0.3s ease',
                            'transform': `translateX(${-linkOffset}px)`
                        });
                    }
                }
            }


        });

        function extendSubMenu(el) {
            if ($(window).width() < 1300) {
                if ($(el).hasClass('active-list')) {
                    $(el).removeClass('active-list');
                    return;
                }
                $('.navbar-item').removeClass('active-list');
                $(el).addClass('active-list');
            }
        }

        function extendKnowledgeSubMenu(el, event) {
            event.stopPropagation();
            $(el).toggleClass('active-knowledge');
        }

        function toggleFeedback() {
            if ($(window).width() < 481) {
                $(window).on("scroll", function () {
                    $(".feedback-contact").toggleClass('hide-feedback', $(window).scrollTop() > 100);
                });
            } else {
                $(window).off("scroll");
            }
        }

        toggleFeedback();
        $(window).on('resize', toggleFeedback);


    </script>
    <script>
        let breadcrumbsVisible = false;

        function generateBreadcrumbs() {
            const pathname = window.location.pathname;
            const pathSegments = pathname.split('/').filter(segment => segment !== '');

            const breadcrumbsContainer = $('#dynamic-breadcrumbs');
            breadcrumbsContainer.empty();

            breadcrumbsContainer.append(`
        <li class="breadcrumb-item">
          <a href="/">Home</a>
        </li>
      `);

            let currentPath = '';

            const segmentNames = {
                'doctors': 'Doctors',
                'doctor-profile': 'Doctor Profile',
                'medical-experts': 'Medical Experts',
                'services': 'Services',
                'about': 'About Us',
                'contact': 'Contact Us'
            };

            for (let i = 0; i < pathSegments.length; i++) {
                const segment = pathSegments[i];
                currentPath += '/' + segment;

                const displayName = segmentNames[segment] ||
                    segment.replace(/-/g, ' ')
                        .replace(/\b\w/g, l => l.toUpperCase());

                if (i === pathSegments.length - 1) {
                    breadcrumbsContainer.append(`
            <li class="breadcrumb-item active" aria-current="page">${displayName}</li>
          `);
                } else {
                    breadcrumbsContainer.append(`
            <li class="breadcrumb-item">
              <a href="${currentPath}">${displayName}</a>
            </li>
          `);
                }
            }

            if (pathSegments.length === 0) {
                breadcrumbsContainer.append(`
          <li class="breadcrumb-item active" aria-current="page">Home</li>
        `);
            }
        }

        function toggleBreadcrumbs(show = null) {
            breadcrumbsVisible = show !== null ? show : !breadcrumbsVisible;

            const breadcrumbsSection = $('#breadcrumbs-section');

            if (breadcrumbsVisible) {
                generateBreadcrumbs();
                breadcrumbsSection.removeClass('d-none').addClass('show');
            } else {
                breadcrumbsSection.removeClass('show').addClass('d-none');
            }

            return breadcrumbsVisible;
        }

        // Example of how to call the function:
        // toggleBreadcrumbs(true); // Show breadcrumbs
        // toggleBreadcrumbs(false); // Hide breadcrumbs
        // toggleBreadcrumbs(); // Toggle current state
    </script>
    @yield('js')
    <script>
        setTimeout(() => {
            adjustMainMargin();
            console.log('working');

        }, 1);
    </script>
</body>

</html>