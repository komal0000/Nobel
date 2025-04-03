<section id="knowledge">
    <div class="main-container">
        <div class="heading text-center mb-4">
            Knowledge Center
        </div>
        <div class="knowledge-tabs d-flex justify-content-center gap-3 mb-4">
            <div class="tab blogs active" data-tab="tab-1"><button>Blogs</button></div>
            <div class="tab videos" data-tab="tab-2"><button>Videos</button></div>
            <div class="tab studies" data-tab="tab-3"><button>Case Studies</button></div>
        </div>
        <div class="tab-content">
            @includeIf('front.cache.health.knowledge.blogs')
            @includeIf('front.cache.health.knowledge.videos')

            <div class="tab-panel" id="tab-3">
                <div class="tab-slider">
                    <div class="each-card">
                        <div class="img-wrapper">
                            <img src="{{ asset('front/img/health-library/case-study.webp') }}" alt="Blog">
                        </div>
                        <div class="body">
                            <div class="type mb-2">Cardiac Science</div>
                            <div class="heading-xs mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Corporis,
                                labore?</div>
                            <x-hoverBtn class="para-wrap">Continue Reading</x-hoverBtn>
                        </div>
                    </div>

                    <div class="each-card">
                        <div class="img-wrapper">
                            <img src="{{ asset('front/img/health-library/case-study.webp') }}" alt="Blog">
                        </div>
                        <div class="body">
                            <div class="type mb-2">Oncology</div>
                            <div class="heading-xs mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Corporis,
                                labore?</div>
                            <x-hoverBtn class="para-wrap">Continue Reading</x-hoverBtn>
                        </div>
                    </div>
                    <div class="each-card">
                        <div class="img-wrapper">
                            <img src="{{ asset('front/img/health-library/case-study.webp') }}" alt="Blog">
                        </div>
                        <div class="body">
                            <div class="type mb-2">Radiology</div>
                            <div class="heading-xs mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Corporis,
                                labore?</div>
                            <x-hoverBtn class="para-wrap">Continue Reading</x-hoverBtn>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
    <script>
        $(document).ready(function() {
             const lightBox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true
            });
            function initSlider(tabId) {
                $("#" + tabId)
                    .find(".tab-slider")
                    .not(".slick-initialized")
                    .slick({
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: true,
                        prevArrow: '<button class="slick-prev left-arrow"><img src="{{ asset('front/img/vector-left.png') }}" alt="Left Arrow"></button>',
                        nextArrow: '<button class="slick-next right-arrow"><img src="{{ asset('front/img/vector-right.png') }}" alt="Right Arrow"></button>',
                        responsive: [{
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 2
                            }
                        }, {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                centerMode: true
                            }
                        }]
                    });
            }

            $(".tab").on("click", function() {
                let tabId = $(this).data('tab');
                console.log(tabId);


                $(".tab").removeClass("active");
                $(this).addClass("active");

                $(".tab-panel").removeClass("active").hide();
                $("#" + tabId).addClass("active").fadeIn();

                // Reinitialize Slick on the selected tab
                initSlider(tabId);
            });

            // Initialize first tab slider
            initSlider("tab-1");
        });
    </script>
@endpush
