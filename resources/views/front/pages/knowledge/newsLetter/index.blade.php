@extends('front.layout.app')

@section('title', 'News Letter')
@section('meta', 'News Letter page for the website')

@section('content')
@includeIf('front.cache.knowledge.newsLetter')
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Hide all content sections except the active one initially
            $('.letter-row > [data-content]').hide();
            $('.letter-row > [data-content="exchange"]').show();

            // Pagination variables
            const itemsPerPage = 4;
            let currentPage = 1;

            // Set up click handlers for tabs
            $('.custom-tabs ul li a').on('click', function(e) {
                e.preventDefault();

                // Remove active class from all tabs
                $('.custom-tabs ul li').removeClass('active');

                // Add active class to clicked tab
                $(this).parent('li').addClass('active');

                // Get the data-title attribute value
                const tabContent = $(this).data('title');

                // Hide all content sections
                $('.letter-row > [data-content]').hide();

                // Show the corresponding content
                $(`.letter-row > [data-content="${tabContent}"]`).show();

                // Reset pagination to first page when switching tabs
                currentPage = 1;
                showPage(currentPage, tabContent);
                updatePaginationButtons(tabContent);
            });

            // Initialize pagination
            initializePagination('exchange');

            function initializePagination(tabContent) {
                showPage(1, tabContent);
                updatePaginationButtons(tabContent);

                // Set up event listeners for pagination buttons
                $('#prevPage').on('click', function() {
                    const activeTab = $('.custom-tabs ul li.active a').data('title');
                    const totalPages = Math.ceil($(
                            `.letter-row > [data-content="${activeTab}"] .letter-card`).length /
                        itemsPerPage);

                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage, activeTab);
                        updatePaginationButtons(activeTab);
                    }
                });

                $('#nextPage').on('click', function() {
                    const activeTab = $('.custom-tabs ul li.active a').data('title');
                    const totalPages = Math.ceil($(
                            `.letter-row > [data-content="${activeTab}"] .letter-card`).length /
                        itemsPerPage);

                    if (currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage, activeTab);
                        updatePaginationButtons(activeTab);
                    }
                });

                // Event delegation for numbered pagination buttons
                $(document).on('click', '.page-btn', function() {
                    const activeTab = $('.custom-tabs ul li.active a').data('title');
                    currentPage = parseInt($(this).text());
                    showPage(currentPage, activeTab);
                    updatePaginationButtons(activeTab);
                });
            }

            function showPage(page, tabContent) {
                currentPage = page;
                const cards = $(`.letter-row > [data-content="${tabContent}"] .letter-card`);

                // Hide all cards
                cards.hide();

                // Calculate start and end indices for the current page
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                // Show only the cards for the current page
                cards.slice(startIndex, endIndex).show();
            }

            function updatePaginationButtons(tabContent) {
                const totalCards = $(`.letter-row > [data-content="${tabContent}"] .letter-card`).length;
                const totalPages = Math.ceil(totalCards / itemsPerPage);

                // Clear existing pagination buttons
                $('#paginationButtons').empty();

                // Don't show pagination if there are fewer items than itemsPerPage
                if (totalCards <= itemsPerPage) {
                    $('.pagination-container').hide();
                    return;
                } else {
                    $('.pagination-container').show();
                }

                // Generate numbered page buttons
                for (let i = 1; i <= totalPages; i++) {
                    const button = $(
                        `<button class="page-btn mx-1 ${i === currentPage ? 'active' : ''}">${i}</button>`);
                    $('#paginationButtons').append(button);
                }

                // Enable/disable prev/next buttons based on current page
                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages);
            }
        });
    </script>
@endpush
