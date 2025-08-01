@extends('front.layout.app')

@section('metaData')
    @includeIf('front.cache.meta.event.' . $slug)
@endsection


@section('content')
    @includeIf('front.cache.event.' . $slug)
@endsection
@section('js')
<script>
   $(document).ready(function () {
    const searchInput = $('#search-input');
    const caseStudyItems = $('.case-study-item');

    $(document).on('click', function () {
        selectWrap.removeClass('active');
    });

    // Pagination variables
    const cardsPerPage = 9;
    let currentPage = 1;
    let filteredItems = caseStudyItems;

    function filterItems() {
        const searchTerm = searchInput.val().toLowerCase();

        filteredItems = caseStudyItems.filter(function () {
            const title = $(this).find('.title').text().toLowerCase();
            const speciality = $(this).find('.speciality').text().toLowerCase();

            // Match search term (title or speciality contains search term)
            const matchesSearch = title.includes(searchTerm) ||
                speciality.includes(searchTerm);

            return matchesSearch;
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
                    click: function (event) {
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
    $('#prevPage').on('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        $(this).blur();
        if (currentPage > 1) {
            showPage(--currentPage);
        }
        return false;
    });

    $('#nextPage').on('click', function (event) {
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