document.addEventListener('DOMContentLoaded', function() {
    // Function to equalize card heights
    function equalizeCardHeight(selector) {
        let maxHeight = 0;
        const elements = document.querySelectorAll(selector);

        elements.forEach(el => {
            el.style.height = 'auto';
            maxHeight = Math.max(maxHeight, el.offsetHeight);
        });

        elements.forEach(el => {
            el.style.height = maxHeight + 'px';
        });
    }

    // Read More functionality
    const $para = $('.para-wrap');
    const $btn = $('.read-more-btn');

    if ($para.length && $btn.length) {
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
            $(this).html($para.hasClass('collapsed') ?
                'Read More <i class="bi bi-chevron-down"></i>' :
                'Read Less <i class="bi bi-chevron-up"></i>'
            );
        });
    }

    // Custom Tab Navigation
    $('.custom-tab').on('click', function(e) {
        e.preventDefault();

        $('.custom-tab').removeClass('active');
        $('.custom-tab-panel').removeClass('active');

        $(this).addClass('active');
        $($(this).attr('href')).addClass('active');
    });

    $('.custom-tab-panel .custom-tab').on('click', function(e) {
        e.preventDefault();
        $('.custom-tab-panel').removeClass('active');
        $(this).closest('.custom-tab-panel').toggleClass('active');
    });

    // Type-2 Tab Navigation
    $(document).on('click', '.type-2-tab', function() {
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

    // Toggle navbar
    $('#toggle-navbar').click(function() {
        $('#navbar').toggleClass('show-navbar').css('transform', 'scale(1)');
    });
});

// Menu functions
function extendSubMenu(el) {
    if ($(el).hasClass('active-list')) {
        $(el).removeClass('active-list');
        return;
    }
    $('.navbar-item').removeClass('active-list');
    $(el).addClass('active-list');
}

function extendKnowledgeSubMenu(el, event) {
    event.stopPropagation();
    $(el).toggleClass('active-knowledge');
}

function expand(el) {
    $(el).toggleClass('active');
}
