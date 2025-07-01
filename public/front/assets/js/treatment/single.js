document.addEventListener('DOMContentLoaded', function () {

    $('.treatmentSlider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
        nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: { slidesToShow: 2 }
            },
            {
                breakpoint: 650,
                settings: { slidesToShow: 1 }
            }
        ]
    });


    // Read more/less functionality
    const $para = $('.para-wrap');
    const $btn = $('.read-more-btn');

    if ($para.length) {
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
        }

        $btn.on('click', function () {
            $para.toggleClass('collapsed');
            $(this).html($para.hasClass('collapsed')
                ? 'Read More <i class="bi bi-chevron-down"></i>'
                : 'Read Less <i class="bi bi-chevron-up"></i>');
        });
    }

    // Tab navigation
    $('.custom-tab').on('click', function (e) {
       // Find the parent component container
       const componentContainer = $(this).closest('.type-2');

       // Remove active states within this specific component
       componentContainer.find('.type-2-tab').removeClass('active-btn');
       componentContainer.find('.type-2-tabs').removeClass('active');

       // Add active state to clicked button
       $(this).addClass('active-btn');

       // Get the target content ID
       const targetId = $(this).data('target');

       // Activate the corresponding content
       const targetContent = componentContainer.find(`.type-2-tabs[data-content="${targetId}"]`);

       if (targetContent.length) {
          targetContent.addClass('active');
          targetContent.find('.type-2-tab').addClass('active-btn');
       }
    });

    $('.custom-tab-panel .custom-tab').on('click', function (e) {
        e.preventDefault();
        $('.custom-tab-panel').removeClass('active');
        $(this).closest('.custom-tab-panel').toggleClass('active');
    });

    // Type-2 tabs
    $(document).on('click', '.type-2-tab', function () {
        const componentContainer = $(this).closest('.type-2');
        componentContainer.find('.type-2-tab').removeClass('active-btn');
        componentContainer.find('.type-2-tabs').removeClass('active');

        $(this).addClass('active-btn');
        const targetId = $(this).data('target');
        const targetContent = componentContainer.find(`.type-2-tabs[data-content="${targetId}"]`);

        if (targetContent.length) {
            targetContent.addClass('active');
            targetContent.find('.type-2-tab').addClass('active-btn');
        }
    });

    
    // Initialize slick slider if it exists
    if ($.fn.slick && $('.slider-67e3f2e85d90a').length) {
        $('.slider-67e3f2e85d90a').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
            nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 2 }
                },
                {
                    breakpoint: 650,
                    settings: { slidesToShow: 1 }
                }
            ]
        });
    }
});

function expand(el) {
    $(el).toggleClass('active');
}
