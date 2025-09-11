<!DOCTYPE html>
<html lang="en">
@php
    $data = App\Helper::getSetting('top_favicon', true);
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{--
    <meta name="description" content="@yield('meta')"> --}}

    {{-- <title>@yield('title', 'Kathmandu Medical College')</title> --}}

    @yield('metaData')
    <meta name="geo.region" content="NP">
    <meta name="geo.placename" content="Biratnagar">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="canonical" href="{{ request()->url() }}">

    <link rel="icon" href="{{ asset($data) }}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <link rel="stylesheet" href="{{ asset('front/assets/css/index.css') }}?ver={{config('app.ver',1)}}">

    @yield('css')
    @includeIf('front.cache.extra.colorScheme')
    <style>
        body {
            color: #58595B;
            font-family: var(--font-main);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        #copiedText {
            margin-top: 1.5rem;
            z-index: 10;
            font-size: 12px;
            top: 16px;
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
        <div class="modal fade" id="callback-modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4">
                    <div class="modal-header p-0 pb-3 border-bottom-0">
                        <h2 class="modal-title heading-md text-center">Request Call Back</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('setting.addRequestCallBack') }}" id="callback-form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name*"
                                        required>
                                    <label for="name">Full Name*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" name="phoneNumber"
                                        placeholder="Phone Number*" required>
                                    <label for="phoneNumber">Phone Number*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Email Address">
                                    <label for="email">Email
                                        Address</label>
                                </div>
                            </div>
                            <div class="col-12">
                              <div class="form-floating mb-3">
                                  <input type="text" class="form-control" name="message"
                                      placeholder="Enter Your Message*" required>
                                  <label for="message">Enter Your Message*</label>
                              </div>
                          </div>

                            <div class="col-12 submit-btn">
                                <button class="w-100" id="submit-callback" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script src="{{ asset('front/assets/js/navbar/index.js') }}?ver={{config('app.ver')}}"></script>

    <script>
        window.appConfig = window.appConfig || {};
        window.appConfig.showSectionNav = false;


        function toggleSectionNav(show) {
            window.appConfig.showSectionNav = show;

            if (show) {
                $('.sectionNavbarMainContainer').removeClass('d-none');
            } else {
                $('.sectionNavbarMainContainer').addClass('d-none');
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

        $('#copyBtn').on('click', function(e) {
            e.preventDefault();
            const link = window.location.href;
            navigator.clipboard.writeText(link).then(() => {
                const copiedText = $('#copiedText');
                copiedText.removeClass('d-none');
                setTimeout(() => copiedText.addClass('d-none'), 1000);
            }).catch((err) => {
                console.error('Failed to copy:', err);
            });
        });

        $(document).ready(function() {
            const lightBox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true
            });
        });
    </script>

    <script>
        $(function() {
            const $sections = $('section[data-content]');
            const $sectionLinks = $('#sectionLinks');
            const $mainSectionNavbarContainer = $('.sectionNavbarMainContainer');
            let scrolling = false;
            let scrollTimeout;

            // Generate section nav links

            if (window.appConfig.showSectionNav && $sectionLinks.length) {
                toggleSectionNav(true);
                $sectionLinks.empty();

                $sections.each(function() {
                    const sectionId = $(this).attr('id');
                    const sectionName = $(this).data('content');

                    $('<li>')
                        .append(
                            $('<a>')
                            .attr('href', `#${sectionId}`)
                            .text(sectionName)
                            .on('click', function(e) {
                                e.preventDefault();
                                scrolling = true;

                                $('#sectionLinks a').removeClass('active');
                                $(this).addClass('active');

                                window.scrollTo({
                                    top: $(`#${sectionId}`).offset().top - 120,
                                });
                                setTimeout(() => scrolling = false, 100);

                                scrollActiveLinkIntoView();
                            })
                        )
                        .appendTo($sectionLinks);
                });

                $(window).on('scroll', function() {
                    if (scrolling) return;

                    clearTimeout(scrollTimeout);
                    scrollTimeout = setTimeout(() => {
                        let currentId = '';

                        $($sections.get().reverse()).each(function() {
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
                toggleSectionNav(false);
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
    </script>
    @yield('js')
    @stack('js')
    <script>
        $('#callback-form').on('submit', function(event) {
            event.preventDefault(); // prevent page refresh

            const formData = new FormData(this);

            const newEntry = {
                name: formData.get('name'),
                phoneNumber: formData.get('phoneNumber'),
                email: formData.get('email'),
                message: formData.get('message'),
            };

            $.ajax({
                url: this.action,
                type: 'POST',
                data: {
                    data: [{
                        details: newEntry
                    }]
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                  alert(response.message);
                  location.reload();
                },
                error: function(error) {
                    console.log(error);
                    alert('Error saving!');
                }
            });
        });


        $(window).on('load', function() {
            adjustMainMargin();
            console.log('window loaded, adjusting margins');
        });
    </script>
</body>

</html>
