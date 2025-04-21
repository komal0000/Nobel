@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.download')
@endsection

@section('content')
    @includeIf('front.cache.download.index')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Modal functionality
            $('.download-card').click(function(e) {
                if (!$(e.target).closest('a').length) {
                    $('#disease-modal').modal('show');
                }
            });

            // Tab switching functionality
            $('.tab').click(function() {
                $('.tab').removeClass('active');
                $(this).addClass('active');

                const target = $(this).data('target');
                filterContent(target);

                // Apply search filter after changing tabs
                const searchText = $('input[name="name"]').val().toLowerCase();
                if (searchText) {
                    applySearch(searchText);
                }
            });

            function debounce(func, wait) {
                let timeout;
                return function() {

                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        func.apply(context, args);
                    }, wait);
                };
            }

            // Apply debounce to search input
            $('input[name="name"]').on('keyup', debounce(function() {
                const searchText = $(this).val().toLowerCase();
                applySearch(searchText);
            }, 300)); // 300ms debounce time - adjust as needed

            // Function to filter content based on tab selection
            function filterContent(target) {
                if (!target) {
                    // "All" tab selected
                    $('.card-row > div').show();
                } else {
                    // Specific tab selected
                    $('.card-row > div').hide();
                    $(`.card-row > div[data-content="${target}"]`).show();
                }
            }

            // Function to apply search filter
            function applySearch(searchText) {
                const activeTab = $('.tab.active').data('target');

                // If searchText is empty, just apply the tab filter
                if (!searchText) {
                    filterContent(activeTab);
                    return;
                }

                // Start by hiding all items
                $('.card-row > div').hide();

                // Select which elements to search through based on active tab
                let selector;
                if (!activeTab) {
                    // "All" tab is active
                    selector = '.card-row > div';
                } else {
                    // Specific tab is active
                    selector = `.card-row > div[data-content="${activeTab}"]`;
                }

                // Show items that match the search
                $(selector).each(function() {
                    const title = $(this).find('.title').text().toLowerCase();
                    const date = $(this).find('.date').text().toLowerCase();

                    if (title.includes(searchText) || date.includes(searchText)) {
                        $(this).show();
                    }
                });
            }
        });
    </script>
@endsection
