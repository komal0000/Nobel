@extends('front.layout.app')

@section('title', 'Case Study | Nobel Hospital')

@section('meta_title', 'Case Studies | Nobel Hospital')
@section('meta_description', 'All case studies section available in Nobel Hospital')
@section('meta_keywords', 'case study')


@section('content')
@endsection
@includeIf('front.cache.knowledge.casestudy')
@section('js')
    <script>
        $(document).ready(function() {
            const selectWrap = $('#select-wrap');
            const defaultSelect = $('#default-select');
            const searchInput = $('#search-input');
            const caseStudyItems = $('.case-study-item');

            defaultSelect.on('click', function(e) {
                e.stopPropagation();
                selectWrap.toggleClass('active');
            });

            $('#select-list li').on('click', function() {
                let selectedText = $(this).text();
                let selectedContent = $(this).data('content');
                let selectedTarget = $(this).data('target');

                // Set the displayed text in the dropdown
                $('.default-item').text(selectedText);

                // Store the selected value (prioritize content over target)
                let selectedValue = selectedContent || selectedTarget || 'All';
                $('#find-case-study-input').val(selectedValue);

                selectWrap.removeClass('active');

                // Apply filtering when option is selected
                filterItems();
            });

            $(document).on('click', function() {
                selectWrap.removeClass('active');
            });

            // Pagination variables
            const cardsPerPage = 9;
            let currentPage = 1;
            let filteredItems = caseStudyItems;

            function filterItems() {
                const searchTerm = searchInput.val().toLowerCase();
                const selectedCategory = $('#find-case-study-input').val();

                filteredItems = caseStudyItems.filter(function() {
                    const title = $(this).find('.title').text().toLowerCase();
                    const speciality = $(this).find('.speciality').text().toLowerCase();
                    const itemContent = $(this).data('content') || '';

                    // Match search term (title or speciality contains search term)
                    const matchesSearch = title.includes(searchTerm) ||
                        speciality.includes(searchTerm);

                    // Match category filter
                    let matchesCategory = true;
                    if (selectedCategory && selectedCategory !== 'All') {
                        matchesCategory = itemContent === selectedCategory;
                    }

                    return matchesSearch && matchesCategory;
                });

                // Update counts and UI elements
                const totalItems = filteredItems.length;
                const totalPages = Math.ceil(totalItems / cardsPerPage);

                // Display message if no results found
                if (totalItems === 0) {
                    $('#case-study-list').append(
                        '<div class="col-12 text-center my-5"><h3>No case studies found</h3></div>');
                }

                // Reset to first page after filtering
                currentPage = 1;

                // Recreate pagination buttons
                createPaginationButtons(totalPages);

                // Show first page of filtered results
                showPage(1);
            }

            function showPage(page) {
                // Remove any "no results" message
                $('#case-study-list .col-12.text-center').remove();

                // Hide all items first
                caseStudyItems.hide();

                // Show only the filtered items for current page
                filteredItems.slice((page - 1) * cardsPerPage, page * cardsPerPage).show();

                // If no items to show and no message displayed, show message
                if (filteredItems.length === 0) {
                    $('#case-study-list').append(
                        '<div class="col-12 text-center my-5"><h3>No case studies found</h3></div>');
                }

                updatePaginationButtons(page);
            }

            function createPaginationButtons(totalPages) {
                const paginationContainer = $('#paginationButtons').empty();

                // Only create pagination if there are multiple pages
                if (totalPages > 1) {
                    for (let i = 1; i <= totalPages; i++) {
                        $('<button>', {
                            text: i,
                            class: 'page-button mx-1 px-3 py-1' + (i === currentPage ? ' active' : ''),
                            click: function(event) {
                                event.stopPropagation();
                                event.preventDefault();
                                $(this).blur();
                                currentPage = i;
                                showPage(currentPage);
                                return false;
                            }
                        }).appendTo(paginationContainer);
                    }
                }
            }

            function updatePaginationButtons(page) {
                const totalPages = Math.ceil(filteredItems.length / cardsPerPage);

                // Update active state
                $('.page-button').removeClass('active');
                $(`.page-button:contains(${page})`).addClass('active');

                // Enable/disable prev/next buttons
                $('#prevPage').prop('disabled', page === 1);
                $('#nextPage').prop('disabled', page === totalPages || totalPages === 0);

                // Show/hide pagination container based on results
                $('.pagination-container').toggle(filteredItems.length > cardsPerPage);
            }

            // Event listeners for pagination
            $('#prevPage').on('click', function(event) {
                event.stopPropagation();
                event.preventDefault();
                $(this).blur();
                if (currentPage > 1) {
                    showPage(--currentPage);
                }
                return false;
            });

            $('#nextPage').on('click', function(event) {
                event.stopPropagation();
                event.preventDefault();
                $(this).blur();
                const totalPages = Math.ceil(filteredItems.length / cardsPerPage);
                if (currentPage < totalPages) {
                    showPage(++currentPage);
                }
                return false;
            });

            // Search input event
            searchInput.on('input', filterItems);

            // Initial setup
            createPaginationButtons(Math.ceil(caseStudyItems.length / cardsPerPage));
            showPage(1);
        });
    </script>
@endsection
