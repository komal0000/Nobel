@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.doctor.doctor')
@endsection

@section('content')
    @includeIf('front.cache.doctor.index')
@endsection
@section('js')
<script>
    $(document).ready(function () {
        // Pagination variables
        const cardsPerPage = 12;
        let totalCards = $('.doctor-card').length;
        let totalPages = Math.ceil(totalCards / cardsPerPage);
        let currentPage = 1;
        let filteredValue = null; // Track current filter

        // Function to show cards for current page with filtering
        function showPage(page, filterValue = null) {
            // Hide all cards first
            $('.doctor-card-col').hide();

            // Apply filter if specified
            let $visibleCards;
            if (filterValue && filterValue !== 'All Specialities') {
                // Filter by text in specialization list items
                $visibleCards = $('.doctor-card-col').filter(function () {
                    let found = false;
                    $(this).find('.for-specialization li').each(function () {
                        const text = $(this).text().trim().toLowerCase();
                        if (text.includes(filterValue.toLowerCase())) {
                            found = true;
                            return false; // Break the each loop once found
                        }
                    });
                    return found;
                });
            } else {
                $visibleCards = $('.doctor-card-col'); // Show all cards if no filter
            }

            // Update total count for pagination based on filtered cards
            totalCards = $visibleCards.length;
            totalPages = Math.ceil(totalCards / cardsPerPage);

            // Adjust current page if needed
            if (page > totalPages && totalPages > 0) {
                page = totalPages;
                currentPage = page;
            }

            // Calculate start and end index for current page
            const startIndex = (page - 1) * cardsPerPage;
            const endIndex = startIndex + cardsPerPage;

            // Show only cards for current page that match the filter
            $visibleCards.slice(startIndex, endIndex).show();

            // Update pagination buttons
            createPaginationButtons();
            updatePaginationButtons(page);

            // Scroll to the top of the doctor list section
            $('html, body').scrollTop($('#doctor-list').offset().top);
        }

        // Function to create pagination buttons dynamically
        function createPaginationButtons() {
            const paginationContainer = $('#paginationButtons');
            paginationContainer.empty();

            // Hide pagination if no pages
            if (totalPages <= 1) {
                $('.pagination-container').hide();
                return;
            } else {
                $('.pagination-container').show();
            }

            for (let i = 1; i <= totalPages; i++) {
                const button = $('<button>', {
                    text: i,
                    class: 'page-button mx-1 px-3 py-1' + (i === currentPage ? ' active' : '')
                }).on('click', function (event) {
                    // Completely stop event propagation and prevent default
                    event.stopPropagation();
                    event.preventDefault();

                    // Prevent scrolling
                    $(this).blur();

                    currentPage = i;
                    showPage(currentPage, filteredValue);

                    // Return false to further prevent any default actions
                    return false;
                });
                paginationContainer.append(button);
            }
        }

        // Function to update pagination buttons' active state
        function updatePaginationButtons(page) {
            // Remove active class from all pagination buttons
            $('.page-button').removeClass('active');

            // Add active class to the current page button
            $('.page-button').eq(page - 1).addClass('active');

            // Disable/enable prev and next buttons
            $('#prevPage').prop('disabled', page === 1);
            $('#nextPage').prop('disabled', page === totalPages);
        }

        // Previous page button
        $('#prevPage').on('click', function (event) {
            event.stopPropagation();
            event.preventDefault();
            $(this).blur();

            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage, filteredValue);
            }

            return false;
        });

        // Next page button
        $('#nextPage').on('click', function (event) {
            event.stopPropagation();
            event.preventDefault();
            $(this).blur();

            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage, filteredValue);
            }

            return false;
        });

        // Filter functionality
        $('.select-list li').click(function () {
            let selectedText = $(this).text();
            let selectedValue = $(this).data('target');

            // Update dropdown display
            $('.default-item').text(selectedText);
            $('.select-wrap').removeClass('active');
            $('#find-doc-speciality-input').val(selectedValue);

            // Set filter value based on selection
            filteredValue = selectedValue === 'all' ? null : selectedText;
            currentPage = 1;
            console.log(filteredValue, 'filter');

            showPage(currentPage, filteredValue);
        });

        // Dropdown toggle
        $('.default-select').click(function () {
            $('.select-wrap').toggleClass('active');
        });

        // Tab functionality
        $('.tab').click(function () {
            let card = $(this).closest('.doctor-card');
            card.find('.tab').removeClass('active');
            card.find('.tab-panel').removeClass('active');

            $(this).addClass('active');

            let index = $(this).index();
            card.find('.tab-panel').eq(index).addClass('active');
        });

        // Close dropdown when clicking outside
        $(document).on('click', function (event) {
            if (!$(event.target).closest('.select-field').length) {
                $('.select-wrap').removeClass('active');
            }
        });

        // Initial setup
        createPaginationButtons();
        showPage(1);
    });
</script>
@endsection
