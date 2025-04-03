@extends('front.layout.app')

@section('title', 'Home')
@section('meta', 'Home page for the website')

@section('content')
 @includeIf('front.cache.career.jobcategory');
@endsection
@push('js')
    <script>
        // Wait for the document to be ready
        $(document).ready(function() {
            // Configuration
            const itemsPerPage = 5;
            let currentPage = 1;
            let filteredJobs = [];

            // Initialize the system
            initializeJobsSystem();

            function initializeJobsSystem() {
                // Get all jobs initially
                filteredJobs = $('.job').toArray();

                // Set up event listeners
                setupFilterListeners();
                setupPaginationListeners();

                // Initial display
                filterItems();
            }

            function setupFilterListeners() {
                // Select dropdown functionality
                const selectWrap = $('#select-wrap');
                const defaultSelect = $('#default-select');

                defaultSelect.on('click', function(e) {
                    e.stopPropagation();
                    selectWrap.toggleClass('active');
                });

                // Close dropdown when clicking elsewhere
                $(document).on('click', function() {
                    selectWrap.removeClass('active');
                });

                // Handle filter selection
                $('#select-list li').on('click', function() {
                    let selectedText = $(this).text();
                    let selectedTarget = $(this).data('target');

                    // Set the displayed text in the dropdown
                    $('.default-item').text(selectedText);

                    // Store the selected value
                    $('#find-job-input').val(selectedTarget || 'all');

                    // Reset to first page when changing filter
                    currentPage = 1;

                    // Apply filtering
                    filterItems();
                });
            }

            function setupPaginationListeners() {
                // Previous page button
                $('#prevPage').on('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        updateDisplay();
                    }
                });

                // Next page button
                $('#nextPage').on('click', function() {
                    const totalPages = Math.ceil(filteredJobs.length / itemsPerPage);
                    if (currentPage < totalPages) {
                        currentPage++;
                        updateDisplay();
                    }
                });

                // Page number buttons will be added dynamically
                $('#paginationButtons').on('click', '.page-number', function() {
                    currentPage = parseInt($(this).text());
                    updateDisplay();
                });
            }

            function filterItems() {
                const selectedFilter = $('#find-job-input').val() || 'all';

                // Apply filter
                if (selectedFilter === 'all') {
                    filteredJobs = $('.job').toArray();
                } else {
                    filteredJobs = $(`.job[data-content="${selectedFilter}"]`).toArray();
                }

                // Always reset to first page when filtering
                currentPage = 1;

                // Update display with filtered items
                updateDisplay();
            }

            function updateDisplay() {
                // Hide all jobs first
                $('.job').hide();

                // Calculate start and end indices for current page
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage - 1, filteredJobs.length - 1);

                // Show only jobs for current page
                for (let i = startIndex; i <= endIndex; i++) {
                    $(filteredJobs[i]).show();
                }

                // Update pagination UI
                updatePaginationUI();
            }

            function updatePaginationUI() {
                const totalPages = Math.ceil(filteredJobs.length / itemsPerPage);
                const paginationButtons = $('#paginationButtons');

                // Clear previous buttons
                paginationButtons.empty();

                // Create pagination buttons
                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = $('<button></button>')
                        .addClass('page-number mx-1')
                        .text(i);

                    // Highlight current page
                    if (i === currentPage) {
                        pageButton.addClass('active');
                    }

                    paginationButtons.append(pageButton);
                }

                // Hide/show navigation buttons based on current page
                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages || totalPages === 0);

                // Show message if no results
                if (filteredJobs.length === 0) {
                    // Create a no results message if it doesn't exist
                    if ($('.no-results-message').length === 0) {
                        const noResultsMsg = $('<div></div>')
                            .addClass('no-results-message text-center my-4')
                            .text('No matching jobs found.');
                        $('.job-list').after(noResultsMsg);
                    } else {
                        $('.no-results-message').show();
                    }
                } else {
                    $('.no-results-message').hide();
                }
            }
        });
    </script>
@endpush
